<!--
 * @view  documentos/form_editar.blade.php
 * @created  at 03-11-2016 12:49:39
 * - Criado Automaticamente pelo HTR Assist
 -->



<?php $__env->startSection('title', 'Inserção de Documentos'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de edição de Documentos</h4>
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-table fa-fw"></i> Formulário de Edição
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="resultado"></div>
                        <form action="<?php echo e($controller); ?>altera/" method="post" id="form">
                            <?php echo $token; ?>

                            <input type="hidden" name="id" value="<?php echo e($result['id']); ?>">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text"
                                           id="titulo"
                                           name="titulo"
                                           placeholder="Título"
                                           class="form-control"
                                           value="<?php echo e($result['titulo']); ?>"
                                           maxlength="70"
                                           required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <select
                                           id="departamento"
                                           name="departamento"
                                           class="form-control"
                                           required>
                                           <?php $__currentLoopData = $resultDepartamento; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                           <option value="<?php echo e($value['id']); ?>"
                                               <?php if($result['departamento'] == $value['id']): ?>
                                                   selected
                                               <?php endif; ?>
                                               >
                                               <?php echo e($value['nome']); ?>

                                           </option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Classificação</label>
                                    <select
                                           id="classificacao_id"
                                           name="classificacao_id"
                                           class="form-control"
                                           required>
                                           <?php $__currentLoopData = $resultClassificacao; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                                           <option value="<?php echo e($value['id']); ?>"
                                               <?php if($result['classificacao_id'] == $value['id']): ?>
                                                   selected
                                               <?php endif; ?>
                                               >
                                               <?php echo e($value['nome_classificacao']); ?>

                                           </option>
                                           <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                                    </select>
                                </div>
                                
                            </div>

                            <div class="col-lg-6">
                                
                                <div class="form-group">
                                    <label>Opções de publicação</label>
                                    <input type="radio" name="change_publicacao" value="arquivo" class="change_publicacao" checked=""> Arquivo |
                                    <input type="radio" name="change_publicacao" value="link" class="change_publicacao"> Link
                                </div>
                                <div class="form-group set-arquivo">
                                    <label>Arquivo para publicação</label>
                                    <input type="file" name="arquivo" class="form-control">
                                </div>

                                <div class="form-group set-link" style="display: none">
                                    <label>Link de arquivo externo</label>
                                    <input type="url"
                                           id="link"
                                           name="link"
                                           placeholder="URL do arquivo externo"
                                           class="form-control"
                                           value="<?php echo e($result['link']); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <br>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> Registrar</button>
                                    <a href="<?php echo e($controller); ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Voltar</a>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    $('.change_publicacao').click(function() {

        var value = $(this).val();

        if (value == 'arquivo') {
            $('.set-link').hide();
            $('.set-arquivo').show();
        }

        if (value == 'link') {
            $('.set-link').show();
            $('.set-arquivo').hide();
        }
    });

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>