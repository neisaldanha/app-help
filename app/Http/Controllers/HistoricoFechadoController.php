<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\arq_alunos_historico_ordem_fechados;
use App\Models\tab_usuarios_diplomas;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;
use Session;
use Validator;


class HistoricoFechadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = ['LoggedUserInfo' => tab_usuarios_diplomas::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios_diplomas::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios_diplomas')->where('USU_STATUS', 'A')->count();
        $formandos = DB::table('arq_alunos as a')
        ->join('arq_alunos_historico_ordem_fechado as f', 'a.id', 'f.id_cadastro')
        ->select('a.nome', 'a.email', 'a.cpf','a.id','a.codigo','a.rg')
        ->groupby('a.nome', 'a.email','a.cpf', 'a.id','a.codigo', 'a.rg')
        ->orderby('a.nome')
        ->get();

        return view('painel/list-formandos')->with([
            'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
            'logado' => $userLogado, //usuário logado
            'formados' => $formandos, // Lista dos formados
        ]);

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //Query para trazer os dados do formado
        $formando = DB::table('arq_turma as t')
        ->join('arq_alunos_vinculos as v', 't.codigo_turma', 'v.turma')
        ->join('arq_alunos as a', 'a.codigo' , 'v.codigo')
        ->join('arq_alunos_historico_ordem_fechado as f', 'a.id' ,'f.id_cadastro')
        ->where('v.id_cadastro',$id)
        ->where('t.data_conclusao_curso', '<>', '0000-00-00')
        ->where('t.data_colacao_grau', '<>', '0000-00-00')
        ->where('f.periodo',12)
        ->select('a.nome','a.rg','a.sexo','a.cpf','a.enade_situacao','a.enade_condicao',
            'a.enade_edicao','a.NomePai','a.NomeMae','a.codigo','a.nacionalidade','a.cidade',
            'a.observacoes_enade','a.local','a.ingresso','a.data_sistema','a.estado','a.rg_orgao',
            'a.local_estado','a.nascimento','a.email','a.data_conclusao','a.data_colacao','v.id_cadastro',
            'v.codigo','v.nome','t.data_colacao_grau','v.ano','v.semestre','f.ano_corrente','f.semestre_corrente',
            'f.periodo','t.data_conclusao_curso','t.enade','t.codigo_turma','t.data_expedicao_historico','t.carga_horaria')
       
        ->orderby('a.nome')//->toSql();
        ->limit(1)->get();

        // Query para trazer o historico das unidades cursadas, aprovadas e aproveitadas.
        $hist = arq_alunos_historico_ordem_fechados::where('id_cadastro', $id)
        ->where('situacao','<>','Reprovado')->orderby('periodo')
        ->get();//toSql();
        
        // Query traz os dados do usuário ativo
        $users = DB::table('tab_usuarios_diplomas')
        ->where('USU_STATUS', 'A')
        ->get();

        $data = ['LoggedUserInfo' => tab_usuarios_diplomas::where('ID_USUARIO', '=', session('LoggedUser'))->first()];
        $userLogado = tab_usuarios_diplomas::where('ID_USUARIO', '=', session('LoggedUser'))->first();
        $qtdUsers = DB::table('tab_usuarios_diplomas')->where('USU_STATUS', 'A')->count();
        
        $nivel =  Arr::pluck($data, 'USU_NIVEL')[0];
        if ($nivel != 'A') {
            Session::flash('error2', true);
            return back()->with([
                'qtdeUsers' => $qtdUsers, // Qtde de usuários ativos
                'logado' => $userLogado, //Usuário Logado
                'unidades' => $hist, // unidades cursadas
                'formando'=>$formando, // dados do formando

            ]);
        } else {
            return view('painel/list-unidades')->with([
                'users' => $users, // todos os usuários
                'qtdeUsers' => $qtdUsers, // Qtde Usuários ativos
                'logado' => $userLogado, //usuário logado
                'unidades' => $hist, // unidades cursadas
                'formando' => $formando, // dados do formando
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
        //
    }
}
