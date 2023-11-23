<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tab_usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Session;
use Validator;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function login()
    {

        return view('auth.login');
    }

    function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('/auth/login');
        }
    }

    public function check(Request $request)
    {

        //Validate requests
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:5|max:12'
        ]);
        // Verifica se o usuário passado no login, exite no banco de dados
        $userInfo = tab_usuarios::where('EMAIL', '=', $request->email)
            //->orWhere('CPF', '=', $request->email)
            ->where('USU_STATUS', '=', 'A')
            ->first(); //toSql();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();

        if (!$userInfo) {
            return back()->with('fail', 'Opss...Você não está cadastrado!');
        } else {

            //check password
            if (Hash::check($request->password, $userInfo->USU_SENHA)) {
                $request->session()->put('LoggedUser', $userInfo->ID_USUARIO);
                $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
                $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
                //dd($user->USU_LOGIN);
                $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
                return redirect('/adm/home')->with([
                    'logado' => $userLogado, //Usuário Logado
                    'qtdeUsers' => $qtdUsers, //Qtde de usuários ativos
                ]);
            } else {
                return back()->with('fail', 'Senha incorreta');
            }
        }
    }

    function dashboard()
    {

        $ano = date('Y') ;
        $data = ['LoggedUserInfo'=>tab_usuarios::where('ID_USUARIO','=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
         $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
        $id = Arr::pluck($data,'ID_USUARIO')[0];
        //$dpto = Arr::pluck($data,'ID_DPTO')[0];
        $chamados = DB::table('tab_chamados')->get();
        
        $qtdChamados = DB::table('tab_chamados')->count();
        $qtdMneusChamados = DB::table('tab_chamados')->where('ID_USUARIO',$id)->count();

        // Qtd Abertos no Mes
        $aJan = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
        $aFev = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
        $aMar = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
        $aAbr = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
        $aMai = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
        $aJun = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
        $aJul = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
        $aAgo = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
        $aSet = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
        $aOut = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
        $aNov = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
        $aDez = DB::table('tab_chamados')->where('STATUS','A')->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
        $abertos = [$aJan,$aFev,$aMar,$aAbr,$aMai,$aJun,$aJul,$aAgo,$aSet,$aOut,$aNov,$aDez];
        // Qtd Fechados no Mes
        $fJan = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
        $fFev = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
        $fMar = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
        $fAbr = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
        $fMai = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
        $fJun = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
        $fJul = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
        $fAgo = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
        $fSet = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
        $fOut = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
        $fNov = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
        $fDez = DB::table('tab_chamados')->where('STATUS','F')->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
        $fechados = [$fJan,$fFev,$fMar,$fAbr,$fMai,$fJun,$fJul,$fAgo,$fSet,$fOut,$fNov,$fDez];
        // Qtd EM Atendimento no Mes
        $eJan = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-01-01',$ano.'-01-31'])->count();
        $eFev = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-02-01',$ano.'-02-29'])->count();
        $eMar = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-03-01',$ano.'-03-31'])->count();
        $eAbr = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-04-01',$ano.'-04-30'])->count();
        $eMai = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-05-01',$ano.'-05-31'])->count();
        $eJun = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-06-01',$ano.'-06-30'])->count();
        $eJul = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-07-01',$ano.'-07-31'])->count();
        $eAgo = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-08-01',$ano.'-08-31'])->count();
        $eSet = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-09-01',$ano.'-09-30'])->count();
        $eOut = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-10-01',$ano.'-10-31'])->count();
        $eNov = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-11-01',$ano.'-11-30'])->count();
        $eDez = DB::table('tab_chamados')->where('STATUS','E')->whereBetween('DATA_ABERTURA',[$ano.'-12-01',$ano.'-12-31'])->count();
        $emAtendimento = [$eJan,$eFev,$eMar,$eAbr,$eMai,$eJun,$eJul,$eAgo,$eSet,$eOut,$eNov,$eDez];
                        
        $qtdSemAtendimmento = DB::table('tab_chamados')->where('STATUS','A')->count();
        $qtdMeusSemAtendimmento = DB::table('tab_chamados')->where('STATUS','A')->where('ID_USUARIO',$id)->count();

        $qtdEncerrados = DB::table('tab_chamados')->where('STATUS','F')->count();
        $qtdMeusEncerrados = DB::table('tab_chamados')->where('STATUS','F')->where('ID_USUARIO',$id)->count();
        
        $qtdEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->count();
        $qtdMeuEmAtendimento = DB::table('tab_chamados')->where('STATUS','E')->where('ID_USUARIO',$id)->count();

        $qtdUsuarios = DB::table('tab_usuarios')->where('USU_STATUS','A')->count();
        $percente = ($qtdEncerrados * 100)/$qtdChamados ;
        $nivel =  Arr::pluck($data,'USU_NIVEL')[0];
        if($nivel == "A"){
            $qtd = $qtdChamados;
            $encerrados = $qtdEncerrados;
            $atendidos =  $qtdEmAtendimento;
            $semAtendimento = $qtdSemAtendimmento;
        }else{
            $qtd = $qtdMneusChamados;
            $encerrados = $qtdMeusEncerrados;
            $atendidos = $qtdMeuEmAtendimento;
            $semAtendimento = $qtdMeusSemAtendimmento;
            
        }
        $fotoPessoa = DB::table('tab_pessoas')->where('ID_PESSOA', $id)->select('PESSOA_FOTO')->get();
        $foto = Arr::pluck($fotoPessoa, 'PESSOA_FOTO');
        //dd(Arr::pluck($foto, 'PESSOA_FOTO')[0]);
        $status = Arr::pluck($chamados,'STATUS');
        //dd($status);
        //dd(Arr::pluck($data,'ID_PESSOA'));
        return view('adm.home')->with([
            'data'=>Arr::pluck($data,'USU_LOGIN'),
            'iduser'=> Arr::pluck($data,'ID_USUARIO'),
            'idpessoa'=>Arr::pluck($data,'ID_PESSOA'),
            'imagem' =>$foto,
            'qtdChamados'=>$qtd,
            'qtdUsuarios'=>$qtdUsuarios,
            'qtdSemAtendimmento'=>$semAtendimento,
            'qtdEncerrados'=>$encerrados,
            'percente'=> number_format($percente, 2, ',', ''),
            'nivel'=>$nivel,
            'qtdEmAtendimento'=>$atendidos,
            // usa nos Graficos
            'chamados'=>$chamados,
            'abertos'=>$abertos,
            'fechados'=>$fechados,
            'emAtendimento'=>$emAtendimento,
            'logado'=>$userLogado,
            'qtdeUsers'=>$qtdUsers,
        ]);
    }

    public function index()
    {
        $users = DB::table('tab_usuarios')
            ->where('USU_STATUS', 'A')
            ->get();

        $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
        $foto = Arr::pluck($data, 'FOTO');
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
        //dd(($foto));
        $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
        if ($nivel != 'A') {
            //abort(403,"Acesso não autorizado");
            Session::flash('error2', true);
            return back()->with([
                'qtdeUsers' => $qtdUsers,  // Qtde de usuários ativos
                'logado' => $userLogado,   // Usuário Logado
                'data' => Arr::pluck($data, 'USU_LOGIN'),
                'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                'imagem' => $foto,
                'nivel' => $nivel,

            ]);
        } else {

            //dd($users);
            return view('adm/usuarios')->with([
                'users' => $users, // todos os usuários
                'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
                'logado' => $userLogado, //usuário logado
                'data' => Arr::pluck($data, 'USU_LOGIN'),
                'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                'imagem' => $foto,
                'nivel' => $nivel,
            ]);
        }
        //'data'=>Arr::pluck($data,'nome')
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
        $id = Arr::pluck($data, 'ID_USUARIO')[0];
        $foto = Arr::pluck($data, 'FOTO')[0];
        $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
        $dptos = DB::table('tab_departamentos')->select('ID_DPTO','DESCRICAO')->get();

        // Não deixa alterar se não for usuário Administrador
        /*
        if ($userLogado->USU_NIVEL != 'A' ) {
            //abort(403,"Acesso não autorizado");
            Session::flash('error2', true);
            return back()->with([
                'logado'=> $userLogado,//Usuário logado',
                'qtdeUsers'=>$qtdUsers, //Qtde Usuários ativos
                'data' => Arr::pluck($data, 'USU_LOGIN'),
                'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                'imagem' => $foto,
                'nivel' => $nivel,

            ]);
        } else {*/
        if ($request->id == 0) {

            $input = $request->all();

            $id = $request->pessoa;
            $rules = [
                'name' => 'required',
                'email' => 'required',
                'cpf' => 'required|unique:tab_usuarios',
                'password' => 'required|min:5|max:12',
                'tipo' => 'required',
                'arquivo' => 'required',

            ];

            $nomes = [
                'name' => 'Nome',
                'email' => 'E-mail',
                'cpf' => 'CPF',
                'password' => 'Senha',
                'tipo' => 'Tipo Acesso',
                'arquivo' => 'Imagem',
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
            $user = new tab_usuarios;

            $user->ID_DPTO = $request->dpto;
            $user->EMAIL = $request->email;
            $user->CPF = $request->cpf;
            $user->USU_NIVEL = $request->tipo;
            $user->USU_LOGIN = $request->name;
            $user->CLIENTE = $request->cliente;
            $user->SENHA = $request->password;
            $user->USU_STATUS = "A";
            $user->USU_DATA_CAD = date('Y-m-d H:i:s');
            $user->USU_DATA_UPDATE = date('Y-m-d H:i:s');

            $dataArq = date('Y-m-d H:i:s');

            // Define o valor default para a variável que contém o nome da imagem
            $nameFile = null;
            //$arq = file_get_contents($_FILES['arquivo']['tmp_name']);
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {

                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = time();

                // Recupera a extensão do arquivo
                $extension = $request->arquivo->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                // Faz o upload:
                $destino = public_path('storage');
                //dd($destino);
                $upload = $request->arquivo->move($destino, $nameFile);
                $imagem = $request->arquivo;
                $user->FOTO = $nameFile;

                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if (!$upload) {
                    return redirect()
                        ->back()
                        ->with('error', 'Falha ao fazer upload')
                        ->withInput();
                }
            }


            $user->USU_SENHA = Hash::make($request->password);
            $save = $user->save();
            //$save2 = $pessoausuario->update();
            $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
            $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
            $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
            //$dpto = DB::table('tab_departamentos')->select('ID_DPTO','DESCRICAO')->get();
            if ($save) {
                Session::flash('success', true);
                return back()->with([
                    'logado' => $userLogado, //'Usuário logado',
                    'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
                    'data' => Arr::pluck($data, 'USU_LOGIN'),
                    'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                    'idpessoa' => Arr::pluck($data, 'ID_PESSOA'),
                    'imagem' => $foto,
                    'nivel' => $nivel,
                    'dptos'=>$dptos,

                ]);
            } else {
                Session::flash('error', true);
                return back()->with('fail', 'Opss..., Algo deu errado');
            }
        } else {


            //Validate requests
            $input = $request->all();
            $id = $request->id;
            $user = tab_usuarios::findOrFail($id);
            
            $rules = [
                'name' => 'required',
                'cpf' => 'required',
                //'email'=>'required|EMAIL|unique:tab_usuarios',
                'password' => 'required|min:5|max:12',
                //'tipo' => 'required',
            ];


            $nomes = [
                'name' => 'Nome',
                'cpf' => 'CPF',
                'email' => 'email',
                'password' => 'Senha',
                //'tipo' => 'Tipo Acesso',
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

            if(!$request->tipo){
                $tipo = $user->USU_NIVEL;
            }else{
                $tipo = $request->tipo;
            }
           // dd( $tipo);

            //Insert data into database
           
            $user->ID_DPTO = $request->dpto;
            $user->USU_NIVEL = $tipo;
            $user->USU_LOGIN = $request->name;
            $user->SENHA = $request->password;
            $user->EMAIL = $request->email; 
            $user->CPF = $request->cpf;
            $user->CLIENTE = $request->cliente;
            $user->USU_DATA_UPDATE = date('Y-m-d H:i:s');

            $dataArq = date('Y-m-d H:i:s');

            // Define o valor default para a variável que contém o nome da imagem
            $nameFile = null;
            //$arq = file_get_contents($_FILES['arquivo']['tmp_name']);
            // Verifica se informou o arquivo e se é válido
            if ($request->hasFile('arquivo') && $request->file('arquivo')->isValid()) {

                // Define um aleatório para o arquivo baseado no timestamps atual
                $name = time();

                // Recupera a extensão do arquivo
                $extension = $request->arquivo->extension();

                // Define finalmente o nome
                $nameFile = "{$name}.{$extension}";

                // Faz o upload:
                $destino = public_path('storage');
                //dd($destino);
                $upload = $request->arquivo->move($destino, $nameFile);
                $imagem = $request->arquivo;
                $user->FOTO = $nameFile;
                if ($imagem) {
                    $user->FOTO = $nameFile;
                } else {
                    $user->FOTO = $user->FOTO;
                }

                // Verifica se NÃO deu certo o upload (Redireciona de volta)
                if (!$upload) {
                    return redirect()
                        ->back()
                        ->with('fail', 'Falha ao fazer upload');
                }
            }

            $user->USU_SENHA = Hash::make($request->password);
            $save = $user->update();
            $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
            $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
            $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
            if ($save) {
                Session::flash('success', true);
                return back()->with([
                    'logado' => $userLogado, // 'Usuário logado',
                    'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
                    'data' => Arr::pluck($data, 'USU_LOGIN'),
                    'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                    'imagem' => $foto,
                    'nivel' => $nivel,
                    'dptos'=>$dptos,
                ]);
            } else {
                Session::flash('error', true);
                return back()->with('fail', 'Opss..., Algo deu errado');
            }
        }
        //}

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
        $foto = Arr::pluck($data, 'FOTO');
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $dpto = DB::table('tab_departamentos')->select('ID_DPTO','DESCRICAO')->get();
        $clientes = DB::table('tab_clientes')->select('ID_CLIENTE','NOME')->get();
        $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];


        if ($id == 0) {

            $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
            $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
            //$user = tab_usuarios::findOrFail($id);
            return view('adm.register-user')->with([
                'logado' => $userLogado, // Usuário logado
                'qtdeUsers' => $qtdUsers, // Qtde Usuarios ativos
                'data' => Arr::pluck($data, 'USU_LOGIN'),
                'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                'imagem' => Arr::pluck($data, 'FOTO'),
                'dptos' => $dpto, // todos usuários
                'nivel' => $nivel,
                'clientes' => $clientes,
            ]);
        } else {

            $user = tab_usuarios::findOrFail($id);
            //dd($user->USU_NIVEL);
            $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();
            $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
            $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
            $clientes = DB::table('tab_clientes')->select('ID_CLIENTE','NOME')->get();

            return view('adm.register-user')->with([
                'logado' => $userLogado, //Usuário Logado
                'qtdeUsers' => $qtdUsers, //Qtde Usuários ativos
                'user' => $user, // todos usuários
                'data' => Arr::pluck($data, 'USU_LOGIN'),
                'iduser' => Arr::pluck($data, 'ID_USUARIO'),
                'imagem' => Arr::pluck($data, 'FOTO'),
                'nivel' => $user->USU_NIVEL,
                'dptos'=>$dpto,
                'clientes' => $clientes,
            ]);
        }
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
        $qtdUsers = DB::table('tab_usuarios')->where('USU_STATUS', 'A')->count();
        $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first();

        $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
        if ($nivel != 'A') {
            //abort(403,"Acesso não autorizado");
            Session::flash('error2', true);
            return back()->with([
                'logado' => $userLogado, // Usuário Logado
                'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
            ]);
        } else {
            $user = tab_usuarios::findOrFail($id);
            //exclui imagem da pasta
            /* $imagem = $user->avatar;
	        Storage::disk('public')->delete($imagem);
	        */
            $user->USU_STATUS = 'I';
            $user->USU_DATA_UPDATE = date('Y-m-d H:i:s');
            $inativado = $user->update();
            $data = ['LoggedUserInfo' => tab_usuarios::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
            if ($inativado) {
                Session::flash('success', true);
                return back()->with([
                    'logado' => $userLogado, // Usuário Logado
                    'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
                ]);
            } else {
                Session::flash('error', true);
                return back()->with('fail', 'Opss..., Algo deu errado');
            }
        }
    }
}
