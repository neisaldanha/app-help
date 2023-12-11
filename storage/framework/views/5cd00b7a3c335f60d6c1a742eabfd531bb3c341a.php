<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>
<h1>Painéis Rotativo</h1>
<meta charset="utf-8">

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div id="main-wrapper">
    <div class="container-fluid">
        <?php if(Session::has('error2')): ?>
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Você não pode acessa a pagina solicitada.
            <?php if(count($errors) > 0): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php echo csrf_field(); ?>
    </div>
    <div class="container-fluid">
        <?php if(Session::has('error')): ?>
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Ocorreu um erro ao Fechar chamado.
            <?php if(count($errors) > 0): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>
        <?php if(Session::has('success')): ?>
        <div class="alert alert-success alert-dismissible bg-success" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Sucesso!</strong> Registro salvo com sucesso.
            <?php if(count($errors) > 0): ?>
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php endif; ?>
        </div>
        <?php endif; ?>

        <?php echo csrf_field(); ?>
    </div>
    <!-- Main content -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="form-group col-10">
                        <a href="<?php echo e(url('painel/form-chamado')); ?>" class="btn btn-success"><i class="fa fa-user-plus"> Novo</i>
                        </a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="panel-body">
                                <div class="table">
                                    <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                                        <thead>
                                            <tr>
                                                <th>CHAMADO</th>
                                                <th>TITULO</th>
                                                <th>Abertura</th>
                                                <th>Usuario</th>
                                                <th>STATUS</th>
                                                <th>VISUALIZADO</th>
                                                <th>Atendente</th>
                                                <th>Prioridade</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chamado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <input hidden="" type="text" value=" <?php echo e($diferenca = strtotime(date('Y-m-d H:i:s')) - strtotime($chamado->DATA_ABERTURA)); ?>">
                                            <input hidden="" type="text" value=" <?php echo e($dias = floor($diferenca / (60 * 60 * 24))); ?>">

                                            <?php if($dias > 7 && $chamado->STATUS != 'F'): ?>
                                            <tr style="color: red;">
                                                <?php elseif($dias <= 7 && $dias> 4 && $chamado->STATUS != 'F'): ?>
                                            <tr style="color: orange;">
                                                <?php elseif($dias <= 4 && $chamado->STATUS != 'F'): ?>
                                            <tr style="color: green;">
                                                <?php else: ?>
                                            <tr>
                                                <?php endif; ?>
                                                <th><?php echo e($chamado->NM_CHAMADO); ?></th>
                                                <th title="<?php echo e($chamado->d_descricao); ?>"><?php echo e(mb_strimwidth($chamado->d_descricao, 0, 10,"...")); ?></th>
                                                <th><?php echo e(date('d/m/Y', strtotime($chamado->DATA_ABERTURA))); ?></th>
                                                <td><?php echo e($chamado->USU_LOGIN); ?></td>
                                                <td title="<?php if($chamado->STATUS == 'A'): ?> Aberto <?php elseif($chamado->STATUS == 'E'): ?> Em Atendimento <?php else: ?> Finalizado <?php endif; ?>"><?php if($chamado->STATUS == 'A'): ?> Aberto <?php elseif($chamado->STATUS == 'E'): ?> Em Atend... <?php else: ?> Finalizado <?php endif; ?></td>
                                                <?php if($chamado->VIEW == 'S'): ?>
                                                <td style="color: green;"><?php if($chamado->VIEW == 'S'): ?> SIM <?php endif; ?></td>
                                                <?php else: ?>
                                                <td style="color: red;"><?php if($chamado->VIEW == 'N'): ?> Não <?php endif; ?></td>
                                                <?php endif; ?>
                                                <td><?php echo e($chamado->ATENDENTE); ?></td>
                                                <td><?php if($chamado->PRIORIDADE == '1'): ?> Alta <?php elseif($chamado->PRIORIDADE == '2'): ?> Média <?php else: ?> Baixa <?php endif; ?></td>
                                                <?php if($chamado->PRINT == 1): ?>
                                                <td style="background-color: #00FA9A;">
                                                    <?php else: ?>
                                                <td>
                                                    <?php endif; ?>
                                                    <!--<a href="<?php echo e(url('painel/edit-chamado',$chamado->ID_CHAMADO)); ?>" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fas fa-user-edit"></i>  </a>-->

                                                    <button type="button" title="Visualizar" data-toggle="modal" data-target="#editar-<?php echo e($chamado->ID_CHAMADO); ?>" class="btn btn-success btn-xs"><i class="fa icon-pencil"></i></i></button>
                                                    <a title="Interação" href="<?php echo e(url('painel/create-interacao',$chamado->ID_CHAMADO)); ?>" class="btn btn-primary btn-xs"><i class="fa fa-camera"></i></a>
                                                    <!--<a href="<?php echo e(url('painel/atende-chamado',$chamado->ID_CHAMADO)); ?>" title="Atender Chamado" value="" class="btn btn-primary btn-xs"><i class="far fa-hand-paper"></i></a>-->
                                                    <?php if($chamado->STATUS == 'F'): ?>
                                                    <button type="button" title="Reabrir chamado" class="btn btn-success btn-xs" data-toggle="modal" data-target="#encerrar-<?php echo e($chamado->ID_CHAMADO); ?>">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <?php else: ?>
                                                    <button type="button" title="Encerrar chamado" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#encerrar-<?php echo e($chamado->ID_CHAMADO); ?>">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                            <div class="modal fade" id="encerrar-<?php echo e($chamado->ID_CHAMADO); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle"><?php if(($chamado->STATUS =='E') || ($chamado->STATUS =='A')): ?>Você deseja ENCERRRA o chamado <?php else: ?> Você deseja REABRIR o chamado <?php endif; ?> <strong> <?php echo e($chamado->d_descricao); ?></strong> ?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <a href="<?php echo e(url('painel/chamado/encerra',$chamado->ID_CHAMADO)); ?>">
                                                                <button type="button" class="btn btn-danger">Sim</button>
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade bs-example-modal-lg print_div" id="editar-<?php echo e($chamado->ID_CHAMADO); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title"><?php echo e($chamado->d_descricao); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <div class="card-header p-2">
                                                                        <ul class="nav nav-pills">
                                                                            <li class="nav-item"><a class="btn btn-primary nav-link active" href="#activity-<?php echo e($chamado->ID_CHAMADO); ?>" data-toggle="tab">Chamado</a></li>
                                                                            <li class="nav-item"><a class="btn btn-warning nav-link" href="#timeline-<?php echo e($chamado->ID_CHAMADO); ?>" data-toggle="tab">Interação</a></li>
                                                                            <li class="nav-item"><a class="btn btn-info nav-link" href="#newInter-<?php echo e($chamado->ID_CHAMADO); ?>" data-toggle="tab">Nova Interação</a></li>
                                                                            <li class="nav-item"><a href="<?php echo e(url('painel/atende-chamado',$chamado->ID_CHAMADO)); ?>" title="Atender Chamado" value="" class="btn btn-success">Atender <i class="far fa-hand-paper"></i></a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div>

                                                                <div class="card-body ">
                                                                    <form method="get" action="<?php echo e(url('painel/update-chamado',$chamado->ID_CHAMADO)); ?>" enctype="multipart/form-data">
                                                                        <div class="tab-content">
                                                                            <div class="active tab-pane" id="activity-<?php echo e($chamado->ID_CHAMADO); ?>">
                                                                                <!-- Post -->
                                                                                <div class="post">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-8">
                                                                                            <div class="form-group">
                                                                                                <label>TITULO</label>
                                                                                                <input value="<?php echo e($chamado->d_descricao); ?>" type="text" class="form-control" placeholder="Enter ..." disabled>
                                                                                            </div>
                                                                                        </div>
                                                                                        <?php if($nivel == "A" || $nivel == "S"): ?>
                                                                                        <div class="col-sm-4">
                                                                                            <div class="form-group">
                                                                                                <label for="select1">Prioridade</label>
                                                                                                <select class="form-control select2" name="prioridade">
                                                                                                    <?php if($chamado->PRIORIDADE == "1"): ?>
                                                                                                    <option selected="true" value="<?php echo e($chamado->PRIORIDADE); ?>"> Alta </option>
                                                                                                    <option value="3">Baixa</option>
                                                                                                    <option value="2">Média</option>
                                                                                                    <?php elseif($chamado->PRIORIDADE == "2"): ?>
                                                                                                    <option selected="true" value="<?php echo e($chamado->PRIORIDADE); ?>"> Média </option>
                                                                                                    <option value="3">Baixa</option>
                                                                                                    <option value="1">Alta</option>
                                                                                                    <?php elseif($chamado->PRIORIDADE == "3"): ?>
                                                                                                    <option selected="true" value="<?php echo e($chamado->PRIORIDADE); ?>"> Baixa </option>
                                                                                                    <option value="1">Alta</option>
                                                                                                    <option value="2">Média</option>
                                                                                                    <?php else: ?>
                                                                                                    <option value="3">Baixa</option>
                                                                                                    <option value="2">Média</option>
                                                                                                    <option value="1">Alta</option>
                                                                                                    <?php endif; ?>
                                                                                                </select>
                                                                                            </div>
                                                                                            <?php endif; ?>
                                                                                        </div>
                                                                                        <div class="row">
                                                                                            <!--
                                                                                            <div class="col-sm-8">
                                                                                                <label for="select1">Departamento</label>
                                                                                                <select class="form-control select2" name="dpto">
                                                                                                    <?php $__currentLoopData = $dptos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                    <?php if($chamado->ID_DPTO == $dpto->ID_DPTO ): ?>
                                                                                                    <option selected="true" value="<?php echo e($chamado->ID_DPTO); ?>"><?php echo e($chamado->DEPARTAMENTO); ?></option>
                                                                                                    <?php else: ?>
                                                                                                    <option value="<?php echo e($dpto->ID_DPTO); ?>"><?php echo e($dpto->DESCRICAO); ?></option>
                                                                                                    <?php endif; ?>
                                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                </select>
                                                                                            </div>
                                                                                        -->

                                                                                        </div>

                                                                                        <div id="grid-gallery" class="grid-gallery" class="card-primary filter-container p-0 row">
                                                                                            <?php $__currentLoopData = $imgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                            <?php if($chamado->NM_CHAMADO == $img->NM_CHAMADO): ?>
                                                                                            <div id="grid-gallery" class="grid-gallery col-sm-1">
                                                                                                 <?php if($img->IMAGEM): ?>
                                                                                                    <a href="<?php echo e(asset('/storage/'.$img->IMAGEM)); ?>" data-toggle="lightbox" data-title="<?php echo e($img->IMAGEM); ?>" target="_blank">
                                                                                                        <img class="img-fluid mb-1" src="<?php echo e(asset('/storage/'.$img->IMAGEM)); ?>" width="120" height="100">
                                                                                                    </a>
                                                                                                <?php else: ?>
                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                            <?php endif; ?>
                                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                            <div class="col-sm-12">
                                                                                                <div class="form-group">
                                                                                                    <label>DESCRIÇÃO</label>
                                                                                                    <textarea class="form-control" rows="10" placeholder="Enter ..." disabled> <?php echo e($chamado->DESCRICAO); ?></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer justify-content-between">
                                                                                        <button type="submit" class="btn btn-success">OK</button>
                                                                                        <a href="<?php echo e(url('painel/gera-pdf-descricao',$chamado->ID_CHAMADO)); ?>" target="_blank" class="btn btn-primary">Imprimir</a>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="tab-pane" id="timeline-<?php echo e($chamado->ID_CHAMADO); ?>">
                                                                                <?php $__currentLoopData = $int; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <div class="timeline-item">
                                                                                    <?php if($chamado->ID_CHAMADO == $inter->ID_CHAMADO): ?>
                                                                                    <section class="content">
                                                                                        <div class="row">
                                                                                            <div class="col-12" id="accordion">
                                                                                                <div class="card card-primary card-outline">
                                                                                                    <a class="d-block w-100" data-toggle="collapse" href="#int-<?php echo e($inter->ID_INTERACAO_CHAMADO); ?>">
                                                                                                        <div class="card-header">
                                                                                                            <h4 class="card-title w-100"><?php echo e($inter->USU_LOGIN); ?></h4>
                                                                                                        </div>
                                                                                                    </a>
                                                                                                    <div id="int-<?php echo e($inter->ID_INTERACAO_CHAMADO); ?>" class="collapse" data-parent="#accordion">
                                                                                                        <div class="card-body">
                                                                                                            <?php echo e($inter->INT_DESC_CHAMADO); ?>

                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </section>
                                                                                    <?php endif; ?>
                                                                                </div>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </div>
                                                                    </form>
                                                                    <!-- Nova Interação -->
                                                                    <div class="tab-pane" id="newInter-<?php echo e($chamado->ID_CHAMADO); ?>">
                                                                        <form method="get" action="<?php echo e(url('painel/interacao/chamado',$chamado->ID_CHAMADO)); ?>" enctype="multipart/form-data">
                                                                            <div hidden>
                                                                                <select class="form-control select2" name="dpto">
                                                                                    <?php $__currentLoopData = $dptos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <?php if($chamado->ID_DPTO == $dpto->ID_DPTO ): ?>
                                                                                    <option hidden selected="true" value="<?php echo e($chamado->ID_DPTO); ?>"><?php echo e($chamado->DEPARTAMENTO); ?></option>
                                                                                    <?php else: ?>
                                                                                    <option value="<?php echo e($dpto->ID_DPTO); ?>"><?php echo e($dpto->DESCRICAO); ?></option>
                                                                                    <?php endif; ?>
                                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </select>
                                                                            </div>
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label>Interacao</label>
                                                                                        <textarea class="form-control" name="interacao" rows="3" placeholder="Interacao"></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <input hidden type="tesxt" value="<?php echo e($chamado->ID_CHAMADO); ?>" name="id">
                                                                                <button type="submit" class="btn btn-success">Cadastrar</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
</div>
<!-- /.content -->
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/lista-chamados-clientes.blade.php ENDPATH**/ ?>