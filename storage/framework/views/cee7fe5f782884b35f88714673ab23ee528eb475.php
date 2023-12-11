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
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="panel panel-white">
               <div class="card-header">
                  <h3 class="panel-heading clearfix">Novo Chamado</h3>
                  <div class="card-tools">
                    <!--
                     <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                     </button>
                     <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                     </button>
                    -->
                  </div>
               </div>
               <form class="panel-body" method="post" action="<?php echo e(url('painel/cria-chamado/store')); ?>" enctype="multipart/form-data">
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

                  <div class="row">
                     <div class="col-sm-6">
                        <div class="form-group">
                           <label>TITULO</label>
                           <select class="form-control select2" name="demanda">
                              <?php $__currentLoopData = $demandas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $demanda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <option value="<?php echo e($demanda->id_demanda); ?>"><?php echo e($demanda->d_descricao); ?></option>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                           </select>
                        </div>
                     </div>
                     <!--
                     <div class="col-sm-6">
                        <label for="select1">Departamento</label>
                        <select class="form-control select2" name="dpto">
                           <?php $__currentLoopData = $dptos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dpto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <option value="<?php echo e($dpto->ID_DPTO); ?>"><?php echo e($dpto->DESCRICAO); ?></option>
                           <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                     </div>
                    -->
                    <label>Arquivo</label>
                    <div id="imagem" class="">
                        <div class="">
                            <input type='file' name='arquivo[]' multiple>
                        </div>
                    </div>
                  </div>
                  <br>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="form-group">
                           <label>DESCRIÇÃO</label>
                           <textarea class="form-control" name="descricao" rows="3" placeholder="Descrição do chamado"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
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

<?php echo $__env->make('layout.adm', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\app-help\resources\views/painel/create-chamado.blade.php ENDPATH**/ ?>