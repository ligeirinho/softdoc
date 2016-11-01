<?php $__env->startSection('title', 'Home do sistema'); ?>

<?php $__env->startSection('content'); ?>
<style>
@font-face {
    font-family: "TrendexLightSSi";
    src: url("<?=ATTACH?>fonts/TrendexLightSSi.ttf");
}
.title {
    font-family: "TrendexLightSSi";
    font-size: 64px;
}
.sub-title {
    font-size: 28px;
}
</style>
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12 title" style="margin-top: 10%; text-align: center;">
            <span class="title">HTR Firebird Framework<br>
                <span class="sub-title">
                    Laus Deo - Programming est ars
                </span>
            </span>
        </div>
        <!-- /.col-lg-12 -->
    </div>
</div>
<!-- /.container-fluid -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.blank', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>