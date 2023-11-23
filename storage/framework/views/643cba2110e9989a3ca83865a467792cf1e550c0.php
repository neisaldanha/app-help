

<?php $__env->startSection('title', 'Cadatro-Usuário'); ?>

<?php $__env->startSection('content_header'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Main content -->

<div id="main-wrapper">
    <div class="row">
        <form method="post" action="<?php echo e(url('adm/store')); ?>" enctype="multipart/form-data">
            <div class="panel-heading clearfix">

            </div>
            <div class="col-md-4">
                <!-- Profile Image -->
                <div class="panel panel-white">
                    <div class="panel-body">
                        <div id="profile-container" class="text-center">
                            <a href="#"><img id="profileImage" class="profile-user-img img-fluid img-circle" src=" <?php if(isset($user->FOTO)): ?> <?php echo e(asset('/storage/'.$user->FOTO)); ?>  <?php else: ?> <?php echo e(asset('/imagens/user_default.png')); ?> <?php endif; ?>" width="268" height="268" alt="User"></a>
                            <span><i class="fa fa-pencil"> Clique na imagem para Edita-la</i></span>
                        </div>
                        <input id="imageUpload" type="file" style="display: none;" value="<?php if(isset($user->FOTO)): ?> <?php echo e(asset('/storage/'.$user->FOTO)); ?>  <?php else: ?> <?php echo e(asset('/imagens/user_default.png')); ?> <?php endif; ?>" name="arquivo" placeholder="Photo" capture>
                        <h3 class="profile-username text-center"><?php echo e(isset($user) ? $user->USU_LOGIN :''); ?></h3>
                        <p class="text-muted text-center"><?php if($user->USU_NIVEL == 'A'): ?> Administrador <?php elseif($user->USU_NIVEL == "C"): ?> Comum <?php elseif($user->USU_NIVEL == "S"): ?> Supervisor <?php endif; ?></p>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
            <div class="col-md-8">
                <div class="panel panel-white">
                    <div class="panel-heading clearfix">
                        <h4 class="panel-title"><?php echo e(isset($user) ? 'Editando '.$user->USU_LOGIN : 'Cadastrar Novo Usuário'); ?></h4>
                    </div>
                    <div class="panel-body">

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
                        <input type="hidden" hidden class="form-control" placeholder="id" id="id" value="<?php echo e(isset($user) ? $user->ID_USUARIO  : 0); ?>" name="id">
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <label for="select1">Nome</label>
                                <?php if($logado->USU_NIVEL == 'A'): ?>
                                    <input type="text" value="<?php echo e(isset($user) ? $user->USU_LOGIN  :''); ?>" class="form-control" id="name" name="name" placeholder="Nome Completo">
                                <?php else: ?>
                                    <input type="text" readonly value="<?php echo e(isset($user) ? $user->USU_LOGIN  :''); ?>" class="form-control" id="name" name="name" placeholder="Nome Completo">
                                <?php endif; ?>
                            </div>
                            <div class="col-sm-4">
                                <label for="select1">CPF</label>
                                <?php if($logado->USU_NIVEL == 'A'): ?>
                                    <input type="text" value="<?php echo e(isset($user) ? $user->CPF :''); ?>" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                <?php else: ?>
                                    <input type="text" readonly value="<?php echo e(isset($user) ? $user->CPF :''); ?>" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label for="select1">Email</label>
                                <input type="email" value="<?php echo e(isset($user) ? $user->EMAIL :''); ?>" class="form-control" id="email" name="email" placeholder="seuemail@provedor.com">
                            </div>
                            <?php if($logado->USU_NIVEL == 'A'): ?>
                                <div class="col-sm-6">
                                    <label for="select1">Tipo de acesso</label>
                                    <select class="form-control select2" name="tipo" id="selects">
                                        <?php if(isset($user) && $user->USU_NIVEL == "A"): ?>
                                        <option selected="true" value="<?php echo e($user->USU_NIVEL); ?>">Administrador</option>
                                        <option value="S">Supervisor</option>
                                        <option value="C">Comum</option>
                                        <?php elseif(isset($user) && $user->USU_NIVEL == "C"): ?>
                                        <option selected="true" value="<?php echo e($user->USU_NIVEL); ?>">Comum</option>
                                        <option value="A">Administrador</option>
                                        <option value="S">Supervisor</option>
                                        <?php elseif(isset($user) && $user->USU_NIVEL == "S"): ?>
                                        <option selected="true" value="<?php echo e($user->USU_NIVEL); ?>">Supervisor</option>
                                        <option value="A">Administrador</option>
                                        <option value="C">Comum</option>
                                        <?php else: ?>
                                        <option value="">Selecione</option>
                                        <option value="A">Administrador</option>
                                        <option value="S">Supervisor</option>
                                        <option value="C">Comum</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            <?php endif; ?>
                            <div class="col-sm-6">
                                <label for="select1">Senha</label>
                                <input type="password" value="<?php echo e(isset($user) ? $user->SENHA :''); ?>" class="form-control" id="password" name="password" placeholder="*********">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class=" col-sm-10">
                                <button type="submit" class="btn btn-danger"><?php echo e(isset($user) ? 'Atualizar': 'Cadastar'); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- /.row -->
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-diploma\resources\views/adm/register-user.blade.php ENDPATH**/ ?>