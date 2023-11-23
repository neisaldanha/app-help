@extends('layout.adm')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
<!-- Main content -->
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
<div id="main-wrapper">
    <div class="container-fluid">
        <div class="">
            <div class="col-12">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h3 class="card-title">Gerar Relatório por Setor</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group col-10"></div>
                    <form class="panel-body" target="_blank" method="get" action="{{url('painel/graficos-demandas')}}" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>Departamentos</label>
                                    <select class="form-control select2" name="dpto">
                                        @foreach($dptos as $dpto)
                                        <option value="{{$dpto->ID_DPTO}}">{{$dpto->DESCRICAO}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="select1">Cliente</label>
                                <select class="form-control select2" name="cliente" id="cliente">
                                    @foreach($clientes as $cliente)
                                        @if(isset($user) && $user->CLIENTE == $cliente->ID_CLIENTE )
                                            <option selected value="{{$user->CLIENTE}}" >{{ $cliente->NOME}}</option>
                                        @else
                                        <option value="{{$cliente->ID_CLIENTE}}" >{{$cliente->NOME}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div style="margin-top:25px;" class="form-group">
                                <button type="submit" class="btn btn-success">Gerar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop
