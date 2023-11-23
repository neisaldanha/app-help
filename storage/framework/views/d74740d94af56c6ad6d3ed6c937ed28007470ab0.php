<?php $__env->startSection('title', 'Cadatro-Usuário'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

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

<?php $__env->startSection('content'); ?>
 <!-- Main content -->
    <div id="main-wrapper">
        <div class="row">
            <div class="panel panel-white">
                <div class="col-10">
                    <div class="panel-body"">
                        <div class="card-header">
                            <h3 class="card-title">Interacao com o chamado - <?php echo e($chamados->NM_CHAMADO); ?></h3>
                        </div>
                        <form class="card-body " method="POST" action="<?php echo e(url('painel/inter-chamado-anexo')); ?>" enctype="multipart/form-data">
                            <div class="container-fluid">
                                <?php if(Session::has('error')): ?>
                                <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <strong>OPS!</strong> Ocorreu um erro ao salvar.
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
                            <input hidden="" type="text" name="dpto" value="<?php echo e($dpto); ?>" />
                            <div id="imagem" class="row">
                                <div class="">
                                    <input  type='file'  name='arquivo[]' multiple>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Interacao</label>
                                        <textarea class="form-control" name="interacao" rows="3" placeholder="Interacao" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input hidden type="tesxt" value="<?php echo e($chamados->ID_CHAMADO); ?>" name="id">
                                <button type="submit" class="btn btn-success">Cadastrar</button>
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



<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/create-interacao.blade.php ENDPATH**/ ?>