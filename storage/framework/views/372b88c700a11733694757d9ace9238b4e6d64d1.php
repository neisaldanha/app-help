 <?php $__env->startSection('title', 'Histórico'); ?>


<?php $__env->startSection('content'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/customizado.css')); ?>">

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
                            <?php $__currentLoopData = $formando; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-sm-8">
                                <label for="select1">Nome</label>
                                <input type="text" readonly value="<?php echo e(isset($formado) ? $formado->nome  :''); ?>" class="form-control" id="name" name="name" placeholder="Nome Completo">
                            </div>
                            <div class="col-sm-4">
                                <label for="select1">CPF</label>
                                <input type="text" readonly value="<?php echo e(isset($formado) ? $formado->cpf :''); ?>" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <?php $__currentLoopData = $unidades; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $unidade): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <h3 class="panel-title" title="<?php echo e($unidade->unidade); ?>"><?php echo e(mb_strimwidth($unidade->unidade, 0, 33,"...")); ?></h3>
                            <div class="panel-control">
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Expand/Collapse" class="panel-collapse"><i class="icon-arrow-down"></i></a>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Reload" class="panel-reload"><i class="icon-reload"></i></a>
                                <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Remove" class="panel-remove"><i class="icon-close"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-5">
                                <label for="select1">Situação</label>
                                <input type="text" title="<?php echo e($unidade->situacao); ?>" readonly value="<?php echo e(isset($unidade) ? $unidade->situacao  :''); ?>" class="form-control" id="situacao" name="situacao" placeholder="situacao">
                            </div>
                            <div class="col-sm-4">
                                <label for="select1">Periodo</label>
                                <input type="text" readonly value="<?php echo e(isset($unidade) ? $unidade->ano.'-'.$unidade->semestre.'/'.$unidade->periodo :''); ?>" class="form-control" id="periodo" name="periodo" placeholder="periodo">
                            </div>
                            <div class="col-sm-3">
                                <label for="select1">Nota</label>
                                <input type="text" readonly value="<?php echo e(isset($unidade) ? $unidade->nota :''); ?>" class="form-control" id="nota" name="nota" placeholder="nota">
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div><!-- Row -->
        </div><!-- Sortable -->
    </div><!-- Main Wrapper -->

    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('css'); ?>
    <?php $__env->stopSection(); ?>
    <?php $__env->startSection('js'); ?>

    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-diploma\resources\views/painel/list-unidades.blade.php ENDPATH**/ ?>