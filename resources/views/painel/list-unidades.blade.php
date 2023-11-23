@extends('layout.adm') @section('title', 'Histórico')


@section('content')
<link rel="stylesheet" href="{{asset('css/customizado.css')}}">

<div id="main-wrapper">
    <h3 class="m-b-sm">Registro de Diploma</h3>
    <div class="sortable">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-white">
                    <div class="panel-heading">
                        <h3 class="panel-title"><strong align="center">Dados Pessoais</strong> </h3>
                        <div class="panel-control">
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Expand/Collapse" class="panel-collapse"><i class="icon-arrow-down"></i></a>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Reload" class="panel-reload"><i class="icon-reload"></i></a>
                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Remove" class="panel-remove"><i class="icon-close"></i></a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group row">
                            @foreach($formando as $formado)
                            <div class="col-sm-8">
                                <label for="select1">Nome</label>
                                <input type="text" readonly value="{{isset($formado) ? $formado->nome  :''}}" class="form-control" id="name" name="name" placeholder="Nome Completo">
                            </div>
                            <div class="col-sm-4">
                                <label for="select1">CPF</label>
                                <input type="text" readonly value="{{isset($formado) ? $formado->cpf :''}}" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @foreach($unidades as $unidade)
                <div class="col-md-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <h3 class="panel-title" title="{{$unidade->unidade}}">{{mb_strimwidth($unidade->unidade, 0, 33,"...")}}</h3>
                            <div class="panel-control">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Expand/Collapse" class="panel-collapse"><i class="icon-arrow-down"></i></a>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Reload" class="panel-reload"><i class="icon-reload"></i></a>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Remove" class="panel-remove"><i class="icon-close"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-5">
                                <label for="select1">Situação</label>
                                <input type="text" title="{{$unidade->situacao}}" readonly value="{{isset($unidade) ? $unidade->situacao  :''}}" class="form-control" id="situacao" name="situacao" placeholder="situacao">
                            </div>
                            <div class="col-sm-4">
                                <label for="select1">Periodo</label>
                                <input type="text" readonly value="{{isset($unidade) ? $unidade->ano.'-'.$unidade->semestre.'/'.$unidade->periodo :''}}" class="form-control" id="periodo" name="periodo" placeholder="periodo">
                            </div>
                            <div class="col-sm-3">
                                <label for="select1">Nota</label>
                                <input type="text" readonly value="{{isset($unidade) ? $unidade->nota :''}}" class="form-control" id="nota" name="nota" placeholder="nota">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div><!-- Row -->
        </div><!-- Sortable -->
    </div><!-- Main Wrapper -->

    @stop
    @section('css')
    @stop
    @section('js')

    @stop