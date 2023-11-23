 <?php $__env->startSection('title', 'Formados'); ?>


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

                    </div>
                </div>
                <div class="panel-body">
                    <div class="table">
                        <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th>Imagem</th>
                                    <th>RA</th>
                                    <th>NOME</th>
                                    <th>RG</th>
                                    <th>CPF</th>
                                    <th>CURSO</th>
                                    <th>Fuxo</th>
                                    <th>Conclusão</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th>Imagem</th>
                                <th>RA</th>
                                <th>NOME</th>
                                <th>RG</th>
                                <th>CPF</th>
                                <th>CURSO</th>
                                <th>Fuxo</th>
                                <th>Conclusão</th>
                                <th>Ações</th>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $formados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th>
                                        <!--<img src=" <?php if($formado->codigo): ?> <?php echo e(asset('/storage/'.$formado->codigo)); ?>  <?php else: ?> <?php echo e(asset('plugin/imagens/user_default.png')); ?> <?php endif; ?>" width="64px">-->
                                        <img src="https://sia.facisb.com.br/intranet/fotos/Alunos/<?php echo e($formado->codigo); ?>.jpg" width="64px">
                                    </th>
                                    <th><?php echo e($formado->codigo); ?></th>
                                    <th><?php echo e($formado->nome); ?></th>
                                    <td><?php echo e($formado->rg); ?></td>
                                    <td><?php echo e($formado->cpf); ?> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td>
                                    <td>
                                        <a href="<?php echo e(url('painel/list-unidades',$formado->id)); ?>" title="Editar" value="" class="btn btn-primary btn-xs"><i class="fa icon-pencil"></i> </a>
                                        <a href="#" title="Visualizar" class="btn btn-info btn-xs" data-toggle="modal" data-target="#ver-<?php echo e($formado->id); ?>"><i class="fa fa-camera"></i></a>
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#editar-<?php echo e($formado->id); ?>">
                                            <i class="fa  fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                <div class="modal fade" id="editar-<?php echo e($formado->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLongTitle">Você vai excluir <strong> <?php echo e($formado->nome); ?></strong> ?</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="<?php echo e(url('adm/user/delete',$formado->id)); ?>" title="Excluir">
                                                    <button type="button" class="btn btn-danger">Sim</button>
                                                </a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal Visualizar usuário -->
                                <div class="modal fade bs-example-modal-lg" id="ver-<?php echo e($formado->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myLargeModalLabel" align="center"><strong> <?php echo e($formado->nome); ?></strong> </h3>
                                            </div>
                                            <div class="modal-body">
                                                Teste: <strong><ins>Testando...</ins></strong><br>
                                                E-mail: <strong><ins><?php echo e($formado->email); ?></ins></strong><br>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/list-formandos.blade.php ENDPATH**/ ?>