<!--
 * @view  documentos/index.blade.php
 * @created  at 03-11-2016 12:49:36
 * - Criado Automaticamente pelo HTR Assist
-->



<?php $__env->startSection('title', 'Lista de Documentos'); ?>

<?php $__env->startSection('style'); ?>
<link href="<?php echo e(APPDIR); ?>font/flaticon.css" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3>Documentos</h3>
                <i class="fa fa-list"></i> Lista de Documentos<br>
                <a href="<?php echo e($controller); ?>novo/" class="btn btn-info">
                    <i class="fa fa-plus"></i> Novo Registro
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Usuário</th>
                            <th>Extensão</th>
                            <th>Tamanho</th>
                            <th>Departamento</th>
                            <th>Classificação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $result; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <tr>
                            <td>
                                <a href="<?php echo e(APPDIR); ?>index/ler/id/<?php echo e($value['id']); ?>">
                                    <i class='fa fa-external-link'></i> <?php echo e($value['titulo']); ?>

                                </a>
                            </td>
                            <td>
                                <a href="<?php echo e(APPDIR); ?>auth/editar/id/<?php echo e($userLoggedIn['id']); ?>">
                                    <?php echo e($value['name']); ?>

                                </a>
                            </td>
                            <td>
                                <i class="flaticon-<?php echo e($value['extensao']); ?>-file-format text-primary"></i>
                            </td>
                            <td>
                                <?= $value['tamanho'] ? round(number_format($value['tamanho'], 2, '', '.')) . 'KB' : '<span class="badge">link</span>'; ?>
                            </td>
                            <td>
                                <?php echo e($value['departamento']); ?>

                            </td>
                            <td>
                                <?php echo e($value['classificacao']); ?>

                            </td>
                            <td>
                                <a href="<?php echo e($controller); ?>editar/id/<?php echo e($value['id']); ?>" class="btn btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
                                   onclick="confirmar('Deseja REMOVER este registro?', '<?php echo e($controller); ?>eliminar/id/<?php echo e($value['id']); ?>')"
                                   class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                    </tbody>
                </table>

                <?php if(isset($btn['link'][1])): ?>
                <nav>
                    <ul class="pagination">
                        <li>
                            <a href="<?php echo e($controller); ?>visualizar/pagina/<?php echo e($btn['previus']); ?>" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php $__currentLoopData = $btn['link']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getFirstLoop(); ?>
                        <li><a href="<?php echo e($controller); ?>visualizar/pagina/<?php echo e($value); ?>"><?php echo e($value); ?></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getFirstLoop(); ?>
                        <li>
                            <a href="<?php echo e($controller); ?>visualizar/pagina/<?php echo e($btn['next']); ?>" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>