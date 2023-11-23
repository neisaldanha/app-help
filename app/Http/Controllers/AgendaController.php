<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tab_usuarios;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Agenda;

class AgendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();

        $id =  Arr::pluck($data,'ID_PESSOA')[0];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
       
        $listaAgenda = DB::table('tab_agenda')->get();

        return view('painel/agenda')->with([
            
                'agendas'=>$listaAgenda,
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                //'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=> $nivel,
                //'dptos'=> $dptos,
                'logado'=>$userLogado,
                'qtdeUsers'=>$qtdUsers,
        ]);
        
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

        $id =  Arr::pluck($data,'ID_PESSOA')[0];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
       
        $listaAgenda = DB::table('tab_agenda')->get();

        return view('painel/agenda-demanda')->with([
            
                'agenda'=>$listaAgenda,
                'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                //'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                'imagem' =>Arr::pluck($data,'FOTO'),
                'nivel'=> $nivel,
                //'dptos'=> $dptos,
                'logado'=>$userLogado,
                'qtdeUsers'=>$qtdUsers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            //Validate requests
        $input = $request->all();


        $rules = [
            'titulo'=>'required',
            'descricao'=>'required',
            'data_agenda'=>'required',
            'cor'=>'required',
        ];

        $nomes = [
            'titulo'=>'Titulo',
            'descricao'=>'Descrição',
            'data_agenda'=>'Data da Agenda',
            'cor'=>'Cor',

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

        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        $user = Arr::pluck($data,'USU_LOGIN')[0];

        //Insert data into database
        $agenda = new Agenda;

        $agenda->titulo = $request->titulo;
        $agenda->descricao = $request->descricao;
        $agenda->data_agenda = $request->data_agenda;
        $agenda->cor = $request->cor;
        $agenda->user = $user;

        $save = $agenda->save();

        
        if($save){
            Session::flash('success', true);
            return back()->with([
                    'success','Usuário cadastrado com sucesso',
                    'data'=> Arr::pluck($data,'USU_LOGIN'),
                    'iduser'=>Arr::pluck($data,'ID_USUARIO'),
                    'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
                    'imagem' =>Arr::pluck($data,'FOTO'),
                    'nivel'=>$nivel,

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $deleta = $agenda->delete();
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
