@extends('layout.adm') @section('title', 'Lista-Agenda')

@section('content_header') @stop @section('content')

 <!-- Logo pequeno  -->
    <link rel="shortcut icon" href="{{asset('imagens/grau_certo_logo.jpg')}}">

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
                        <button type="button" title="Novo Evento" data-toggle="modal" data-target="#novo" class="btn btn-success "><span class="item">
                            <span aria-hidden="true" class="icon-notebook"></span>&nbsp; Novo</span></button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="modal fade" id="novo" >
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Criar novo Evento</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="card-body " method="get" action="{{url('painel/create')}}" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-8"><label for="exampleFormControlInput1" class="form-label">Evento</label>
                                                <input type="text" name="titulo" class="form-control" id="exampleFormControlInput1" placeholder="Titulo do evento" autocomplete="off">
                                            </div>
                                           <div class="col-sm-4">
                                            <label class="form-label">Data</label>
                                               <input type="date" class="form-control" name="data_agenda" id="">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm mt-3">
                                                <label for="exampleFormControlInput1" class="form-label">Sinalizador</label> <br>
                                                <label class="radio-inline">
                                                    <input type="radio" name="cor" value="VD" checked>&nbspVerde&nbsp
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="cor" value="A">&nbspAmarelo&nbsp
                                                </label>
                                                <label class="radio-inline">
                                                    <input type="radio" name="cor" value="V">&nbspVermelho&nbsp
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm mt-3">
                                                <div class="form-group">
                                                    <label for="exampleFormControlTextarea1">Descrição</label>
                                                    <textarea class="form-control" name="descricao" id="exampleFormControlTextarea1" rows="4"></textarea>
                                                </div>
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
                    <div class="panel-body">
                        <div class="table">
                            <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                                <thead>
                                    <tr>
                                        <th>TITULO</th>
                                        <th>DESCRICAO</th>
                                        <th>DATA</th>
                                        <th>COR</th>
                                        <th>USUÁRIO</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agendas as $agenda)
                                        <tr>
                                            <th>{{$agenda->titulo}}</th>
                                            <th title="{{$agenda->descricao}}">{{mb_strimwidth($agenda->descricao, 0, 10,"...")}}</th> 
                                            <th>{{date('d/m/Y', strtotime($agenda->data_agenda))}}</th>
                                            @if($agenda->cor == 'V') <td style="color:red;"> Crítico  @elseif($agenda->cor == 'A') <td style="color:yellow;">Moderado @else <td style="color:green;"> Sem Urgência  @endif</td>
                                            <td>{{$agenda->user}}</td>
                                            <td>
                                                <!--<button type="button" title="Visualizar" data-toggle="modal" data-target="#editar-{{$agenda->id_agenda}}" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></button>-->
                                                <button type="button" title="Excluir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#encerrar-{{$agenda->id_agenda}}"><i class="fa fa-trash"></i></button>
                                            </td>
                                        </tr>
                                        <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                        <div class="modal fade" id="encerrar-{{$agenda->id_agenda}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Você deseja Excluir <strong style="color: red;"> {{$agenda->titulo}}</strong> ?</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                        
                                                    <div class="modal-footer">
                                                        <a href="{{url('painel/agenda/excluir',$agenda->id_agenda)}}" >
                                                            <button type="button" class="btn btn-danger">Sim</button>
                                                        </a>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
    </div><!-- Row -->
</div><!-- Main Wrapper -->

@stop

@section('css')
   
@stop

@section('js')
  
@stop


