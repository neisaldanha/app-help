@extends('layout.adm')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Painéis Rotativo</h1>
    <meta charset="utf-8">

@stop

@section('content')
<div id="main-wrapper">
    <div class="container-fluid">
            @if(Session::has('error2'))
            <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>OPS!</strong> Você não pode acessa a pagina solicitada.
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

        <div class="container-fluid">
            @if(Session::has('error'))
            <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <strong>OPS!</strong> Ocorreu um erro.
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
                <strong>Sucesso!</strong> Operação realizada com sucesso.
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
    <!-- Main content -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="form-group col-10">
                        <button type="button" title="Novo Departamento" data-toggle="modal" data-target="#novo" class="btn btn-success "><i class="fa fa-plus"> Novo</i></button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="panel-body">
                            <div class="form-group col-12">
                            <div class="modal fade" id="novo" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Criar novo Cliente</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="card-body" method="get" action="{{url('admin/novo-cliente')}}" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="form-group col-md-8">
                                                        <label>DESCRIÇÃO</label>
                                                        <input  name="nome" type="text" palceholder="Novo cliente..." class="form-control">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label>CNPJ</label>
                                                        <input id="cnpj" name="cnpj" type="text" palceholder="CNPJ somente numeros" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table">
                                <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                                    <thead>
                                        <tr>
                                            <th>Cliente</th>
                                            <th>CNPJ</th>
                                            <th>Data Cadastro</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($clientes as $cliente)
                                            <tr>
                                                <th>{{$cliente->NOME}}</th>
                                                <th>{{$cliente->CNPJ}}</th>
                                                <th>{{date('d/m/Y', strtotime($cliente->DATA_CAD))}}</th>
                                                <td>
                                                    <button type="button" title="Editar" data-toggle="modal" data-target="#editar-{{$cliente->ID_CLIENTE}}" class="btn btn-success btn-xs"><i class="fa icon-pencil"></i></button>
                                                    <button type="button" title="Exckuir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#excluir-{{$cliente->ID_CLIENTE}}">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                            <div class="modal fade" id="excluir-{{$cliente->ID_CLIENTE}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Você deseja EXCLUIR o cliente <strong> {{$cliente->NOME}}</strong> ?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <a href="{{url('admin/exclui-cliente',$cliente->ID_CLIENTE)}}" >
                                                                <button type="button" class="btn btn-danger">Sim</button>
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="editar-{{$cliente->ID_CLIENTE}}" >
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editanto {{$cliente->NOME}}</h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="card-body " method="get" action="{{url('admin/edita-cliente',$cliente->ID_CLIENTE)}}" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="form-group col-md-8">
                                                                            <label>DESCRIÇÃO</label>
                                                                            <input  name="nome" value="{{$cliente->NOME}}" type="text" class="form-control">
                                                                        </div>
                                                                        <div class="form-group col-md-4">
                                                                            <label>DESCRIÇÃO</label>
                                                                            <input id="cnpj"  name="cnpj" value="{{$cliente->CNPJ}}" type="text" class="form-control">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="submit" class="btn btn-success">Salvar</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- /.content -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
@stop

@section('css')

@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
