<!--
 * @view  tipos/form_novo.blade.php
 * @created  at 03-11-2016 12:53:22
 * - Criado Automaticamente pelo HTR Assist
 -->



<?php $__env->startSection('title', 'Inserção de Tipos'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de cadastro de Tipos</h4>
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-table fa-fw"></i> Formulário de Cadastro
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="resultado"></div>
                        <form action="<?php echo e($controller); ?>registra/" method="post" id="form">
                            <?php echo $token; ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tipo</label>
                                    <input type="text"
                                           id="nome_tipo"
                                           name="nome_tipo"
                                           placeholder="Tipo"
                                           class="form-control"
                                           maxlength="30"
                                           required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Criado</label>
                                    <input type="text"
                                           id="criado"
                                           name="criado"
                                           placeholder="Criado"
                                           class="form-control"
                                           maxlength="15"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Atualizado</label>
                                    <input type="text"
                                           id="atualizado"
                                           name="atualizado"
                                           placeholder="Atualizado"
                                           class="form-control"
                                           maxlength="15"
                                           >
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
<?php echo $__env->make('layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>