@extends('layout.adm') @section('title', 'Formados')

@section('content')



<div id="main-wrapper">
    <div class="container-fluid">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Ocorreu um erro ao Deletar.
            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible bg-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sucesso!</strong> Usuário deletado com sucesso.
            @if (count($errors) > 0)
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            @endif
        </div>
        @endif

        @csrf
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="form-group col-10">

                    </div>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>RA</th>
                                    <th>NOME</th>
                                    <th>RG</th>
                                    <th>CPF</th>
                                    <th>CURSO</th>
                                    <th>Fuxo</th>
                                    <th>Conclusão</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>Imagem</th>
                                <th>RA</th>
                                <th>NOME</th>
                                <th>RG</th>
                                <th>CPF</th>
                                <th>CURSO</th>
                                <th>Fuxo</th>
                                <th>Conclusão</th>
                                <th>Ações</th>
                            </tfoot>
                            <tbody>
                                @foreach($formados as $formado)
                                <tr>
                                    <th>
                                        <!--<img src=" @if ($formado->codigo) {{asset('/storage/'.$formado->codigo)}}  @else {{asset('plugin/imagens/user_default.png')}} @endif" width="64px">-->
                                        <img src="https://sia.facisb.com.br/intranet/fotos/Alunos/{{$formado->codigo}}.jpg" width="64px">
                                    </th>
                                    <th>{{$formado->codigo}}</th>
                                    <th>{{$formado->nome}}</th>
                                    <td>{{$formado->rg}}</td>
                                    <td>{{$formado->cpf}} </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td>
                                        <a href="{{url('painel/list-unidades',$formado->id)}}" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fa icon-pencil"></i> </a>
                                        <a href="#" title="Visualizar" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ver-{{$formado->id}}"><i class="fa fa-camera"></i></a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#editar-{{$formado->id}}">
                                            <i class="fa  fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                <div class="modal fade" id="editar-{{$formado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Você vai excluir <strong> {{$formado->nome}}</strong> ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{url('adm/user/delete',$formado->id)}}" title="Excluir">
                                                    <button type="button" class="btn btn-danger">Sim</button>
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Visualizar usuário -->
                                <div class="modal fade bs-example-modal-lg" id="ver-{{$formado->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel" align="center"><strong> {{$formado->nome}}</strong> </h3>
                                            </div>
                                            <div class="modal-body">
                                                Teste: <strong><ins>Testando...</ins></strong><br>
                                                E-mail: <strong><ins>{{$formado->email}}</ins></strong><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->


@stop
@section('css')
@stop
@section('js')

@stop
