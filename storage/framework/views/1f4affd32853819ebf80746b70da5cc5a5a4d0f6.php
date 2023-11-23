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
                <strong>OPS!</strong> Ocorreu um erro.
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
                <strong>Sucesso!</strong> Operação realizada com sucesso.
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
                        <button type="button" title="Novo Departamento" data-toggle="modal" data-target="#novo" class="btn btn-success "><i class="fa fa-plus"> Novo</i></button>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="panel-body">
                            <div class="form-group col-12">
                            <div class="modal fade" id="novo" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Criar novo Departamento</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form class="card-body " method="get" action="<?php echo e(url('admin/novo-departamento')); ?>" enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group">
                                                            <label>DESCRIÇÃO</label>
                                                            <input  name="descricao" type="text" palceholder="Novo Departamento..." class="form-control">
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

                            <div class="table">
                                <table id="example" class="display  table" style="width: 100%; cellspacing: 0;">
                                    <thead>
                                        <tr>
                                            <th>Departamento</th>
                                            <th>Data Cadastro</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $dptos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <th><?php echo e($dpto->DESCRICAO); ?></th>
                                                <th><?php echo e(date('d/m/Y', strtotime($dpto->DATA_CAD))); ?></th>
                                                <td>
                                                    <button type="button" title="Editar" data-toggle="modal" data-target="#editar-<?php echo e($dpto->ID_DPTO); ?>" class="btn btn-success btn-xs"><i class="fa icon-pencil"></i></button>
                                                    <button type="button" title="Exckuir" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#excluir-<?php echo e($dpto->ID_DPTO); ?>">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <!-- Modal nunca deve ficar dentro da <tr> pq não aparece no modo mobile e trava a tela -->
                                            <div class="modal fade" id="excluir-<?php echo e($dpto->ID_DPTO); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Você deseja encerrar o chamado <strong> <?php echo e($dpto->DESCRICAO); ?></strong> ?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <a href="<?php echo e(url('admin/exclui-departamento',$dpto->ID_DPTO)); ?>" >
                                                                <button type="button" class="btn btn-danger">Sim</button>
                                                            </a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="editar-<?php echo e($dpto->ID_DPTO); ?>" >
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Editanto <?php echo e($dpto->DESCRICAO); ?></h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="card-body " method="get" action="<?php echo e(url('admin/edita-departamento',$dpto->ID_DPTO)); ?>" enctype="multipart/form-data">
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group">
                                                                            <label>DESCRIÇÃO</label>
                                                                            <input  name="descricao" value="<?php echo e($dpto->DESCRICAO); ?>" type="text" class="form-control" ">
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
    <!-- /.content -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script> console.log('Hi!'); </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/lista-departamentos.blade.php ENDPATH**/ ?>