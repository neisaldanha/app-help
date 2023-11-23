 <?php $__env->startSection('title', 'Usuários'); ?>


<?php $__env->startSection('content'); ?>



<div id="main-wrapper">
    <div class="container-fluid">
        <?php if(Session::has('error')): ?>
        <div class="alert alert-danger alert-dismissible bg-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>OPS!</strong> Ocorreu um erro ao Deletar.
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
            <strong>Sucesso!</strong> Usuário deletado com sucesso.
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
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading clearfix">
                    <div class="form-group col-10">
                        <a href="<?php echo e(url('adm/register-user',0)); ?>" class="btn btn-success"><i class="fa fa-user-plus"> Usuário</i>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>Nome</th>
                                    <th>EMAIL</th>
                                    <th>NIVEL</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>EMAIL</th>
                                <th>NIVEL</th>
                                <th>Ações</th>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $use): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th>
                                        <img src=" <?php if($use->FOTO): ?> <?php echo e(asset('/storage/'.$use->FOTO)); ?>  <?php else: ?> <?php echo e(asset('plugin/imagens/facisb_logo.png')); ?> <?php endif; ?>" width="64px">
                                    </th>
                                    <th><?php echo e($use->USU_LOGIN); ?></th>
                                    <td><?php echo e($use->EMAIL); ?></td>
                                    <td><?php if($use->USU_NIVEL == "A"): ?> Administrador <?php elseif($use->USU_NIVEL == "C"): ?> Comum <?php else: ?> Supervisor <?php endif; ?> </td>
                                    <td>
                                        <a href="<?php echo e(url('adm/ver/user',$use->ID_USUARIO)); ?>" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fa icon-pencil"></i> </a>
                                        <a href="#" title="Visualizar" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ver-<?php echo e($use->ID_USUARIO); ?>"><i class="fa fa-camera"></i></a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#editar-<?php echo e($use->ID_USUARIO); ?>">
                                            <i class="fa  fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                <div class="modal fade" id="editar-<?php echo e($use->ID_USUARIO); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Você vai excluir <strong> <?php echo e($use->USU_LOGIN); ?></strong> ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo e(url('adm/user/delete',$use->ID_USUARIO)); ?>" title="Excluir">
                                                    <button type="button" class="btn btn-danger">Sim</button>
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Visualizar usuário -->
                                <div class="modal fade" id="ver-<?php echo e($use->ID_USUARIO); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title" id="exampleModalLongTitle" align="center"><strong> <?php echo e($use->USU_LOGIN); ?></strong> </h3>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Tipo de Acesso: <strong><ins><?php if($use->USU_NIVEL == 'A'): ?> Administrador <?php elseif($use->USU_NIVEL == "C"): ?> Comum <?php elseif($use->USU_NIVEL == "S"): ?> Supervisor <?php endif; ?></ins></strong><br>
                                                E-mail: <strong><ins><?php echo e($use->EMAIL); ?></ins></strong><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-diploma\resources\views/adm/usuarios.blade.php ENDPATH**/ ?>