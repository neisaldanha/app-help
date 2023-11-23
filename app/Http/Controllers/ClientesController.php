<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use App\Models\tab_usuarios;
use App\Models\Tab_chamados;
use App\Models\Tab_clientes;
use App\Models\Tab_departamentos;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Session;
use Validator;

class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
        $clientes = DB::table('tab_clientes')->where('STATUS','A')->get();
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();

        if($nivel != 'A' ){
            //abort(403,"Acesso não autorizado");
            Session::flash('error2', true);
            return back()->with([
                    //'success','Usuário cadastrado com sucesso',
                    'data'=> Arr::pluck($data,'USU_LOGIN'),
                    'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                    'imagem' =>Arr::pluck($data,'FOTO'),
                    'nivel'=>$nivel,
                    'logado'=>$userLogado,
                    'qtdeUsers' => $qtdUsers,

            ]);

        }else{
            //dd($users);
            return view('painel/lista-clientes')->with([
                'clientes' => $clientes,
                'data'=>Arr::pluck($data,'USU_LOGIN'),
                'iduser'=> Arr::pluck($data,'ID_USUARIO'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=>$nivel,
                'logado'=>$userLogado,
                'qtdeUsers' => $qtdUsers,
            ]);
        }
        //'data'=>Arr::pluck($data,'nome');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
        $dptos = DB::table('tab_departamentos')->get();

        $id =  Arr::pluck($data,'ID_USUARIO')[0];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $cliente =  Arr::pluck($data,'CLIENTE')[0];
        $dpto = Arr::pluck($data,'ID_DPTO')[0];

        $chamadosCliente = DB::table('tab_chamados as C')
        ->leftjoin('tab_usuarios as U','C.ID_USUARIO','U.ID_USUARIO')
        ->leftjoin('tab_departamentos as D','C.ID_DPTO','D.ID_DPTO')
        ->leftJoin('tab_demandas as DE','DE.id_demanda','C.TITULO')
        ->leftJoin('tab_clientes as CL',function($join) {
            $join->on('C.ID_CLIENTE','CL.ID_CLIENTE')->where('U.CLIENTE','CL.ID_CLIENTE');
        })
        ->where('C.ID_CLIENTE',$cliente)
        ->select('CL.NOME','C.ID_DPTO','C.NM_CHAMADO','D.DESCRICAO AS DEPARTAMENTO',
                'C.ID_CHAMADO','C.TITULO','DE.d_descricao','C.DESCRICAO','C.DATA_ABERTURA','C.ATENDENTE',
                'C.STATUS','U.USU_LOGIN','C.PRIORIDADE','C.VIEW','C.PRINT')
        ->orderBy('C.DATA_ABERTURA','ASC')
        ->get();

        $inter = DB::table('tab_interacao_chamados as I')
        ->join('tab_chamados as C','C.ID_CHAMADO', 'I.ID_CHAMADO')
        ->leftJoin('tab_usuarios as U','U.ID_USUARIO','C.ID_USUARIO')
        ->select('U.ID_USUARIO','U.USU_LOGIN','C.ID_CHAMADO','C.NM_CHAMADO',
                'C.TITULO','C.DESCRICAO','I.ID_INTERACAO_CHAMADO','C.ATENDENTE',
                'I.INT_DESC_CHAMADO','C.PRIORIDADE')
        ->orderByDesc('ID_INTERACAO_CHAMADO')
        ->get();  // ->paginate(15);

        //dd($inter);
        $imgs = DB::table('tab_chamados as C')
        ->leftJoin('tab_imagens as I','C.NM_CHAMADO','I.NM_CHAMADO')
        ->select('C.NM_CHAMADO','I.IMAGEM')
        ->get();


        $dptos = DB::table('tab_departamentos')->get();


        if(($nivel == 'C') ){
            //abort(403,"Acesso não autorizado");
            Session::flash('error2', true);
            return back()->with([
                    //'success','Usuário cadastrado com sucesso',
                    'data'=> Arr::pluck($data,'USU_LOGIN'),
                    'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                    'imagem' =>Arr::pluck($data,'FOTO'),
                    'nivel'=>$nivel,
                    'logado'=>$userLogado,
                    'qtdeUsers' => $qtdUsers,
                    'dptos'=> $dptos,
                    'imgs'=>$imgs,
                    'int'=>$inter,
            ]);

        }else{
            //dd($users);
            return view('painel/lista-chamados-clientes')->with([
                'clientes' => $chamadosCliente,
                'data'=>Arr::pluck($data,'USU_LOGIN'),
                'iduser'=> Arr::pluck($data,'ID_USUARIO'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=>$nivel,
                'logado'=>$userLogado,
                'qtdeUsers' => $qtdUsers,
                'dptos'=> $dptos,
                'imgs'=>$imgs,
                'int'=>$inter,
            ]);
        }

        //dd($chamadosCliente);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $input = $request->all();

        $id = $request->pessoa;
        $rules = [
            'nome'=>'required',
            'cnpj'=>'required',
        ];

        $nomes = [
            'nome'=>'Nome',
            'cnpj'=>'CNPJ',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails()) {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        

         //Insert data into database
         $cliente = new Tab_clientes;
         
         $cliente->NOME = $request->nome;
         $cliente->CNPJ = $request->cnpj;
         $cliente->STATUS = 'A';
         $cliente->DATA_CAD = date('Y-m-d');

         $save = $cliente->save();

        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
         if($save){
            Session::flash('success', true);
            return back()->with([
                //'success','Usuário cadastrado com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=>$nivel,
                'logado'=>$userLogado,
                'qtdeUsers' => $qtdUsers,

                ]);
         }else{
            Session::flash('error', true);
             return back()->with('fail','Opss..., Algo deu errado');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $rules = [
            'nome'=>'required',
            'cnpj'=>'required',
        ];

        $nomes = [
            'nome'=>'Nome',
            'cnpj'=>'CNPJ',
        ];

        $messages = [];

        $validator = Validator::make($input, $rules, $messages);
        $validator->setAttributeNames($nomes);

        if ($validator->fails()) {
            Session::flash('error', true);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

         //Insert data into database
         $cliente =  Tab_clientes::findOrFail($id);;

         $cliente->NOME = $request->nome;
         $cliente->CNPJ = $request->cnpj;
         $cliente->STATUS = 'A';
         $cliente->DATA_UPDATE = date('Y-m-d');

         $save = $cliente->update();

        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
         if($save){
            Session::flash('success', true);
            return back()->with([
                //'success','Usuário cadastrado com sucesso',
                'data'=> Arr::pluck($data,'USU_LOGIN'),
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=>$nivel,
                'logado'=>$userLogado,
                'qtdeUsers' => $qtdUsers,

                ]);
         }else{
            Session::flash('error', true);
             return back()->with('fail','Opss..., Algo deu errado');
         }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clientes = DB::table('tab_clientes')->get();
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];

        if($nivel != 'A' ){
            abort(403,"Acesso não autorizado");

        }else{
            $cliente =  Tab_clientes::findOrFail($id);;
            //$deleta = $cliente->delete();
            $cliente->STATUS = 'I';
            $deleta = $cliente->update();
            $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
            if($deleta){
                Session::flash('success', true);
                return back()->with([
                    'data'=> Arr::pluck($data,'USU_LOGIN')]);
             }else{
                Session::flash('error', true);
                 return back()->with('fail','Opss..., Algo deu errado');
             }
        }
    }
}
