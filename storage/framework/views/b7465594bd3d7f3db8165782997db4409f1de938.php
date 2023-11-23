<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->
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
                    <form class="panel-body" target="_blank" method="get" action="<?php echo e(url('painel/graficos-demandas')); ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>Departamentos</label>
                                    <select class="form-control select2" name="dpto">
                                        <?php $__currentLoopData = $dptos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($dpto->ID_DPTO); ?>"><?php echo e($dpto->DESCRICAO); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="select1">Cliente</label>
                                <select class="form-control select2" name="cliente" id="cliente">
                                    <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($user) && $user->CLIENTE == $cliente->ID_CLIENTE ): ?>
                                            <option selected value="<?php echo e($user->CLIENTE); ?>" ><?php echo e($cliente->NOME); ?></option>
                                        <?php else: ?>
                                        <option value="<?php echo e($cliente->ID_CLIENTE); ?>" ><?php echo e($cliente->NOME); ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/create-relatorios.blade.php ENDPATH**/ ?>