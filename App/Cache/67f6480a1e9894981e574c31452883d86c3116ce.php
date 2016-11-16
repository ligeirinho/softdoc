<?php $__env->startSection('title', 'Área de login'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="row">
        
        <div class="login">
            <a class="hiddenanchor" id="signup"></a>
            <a class="hiddenanchor" id="signin"></a>

            <div class="login_wrapper">
                <div class="animate form login_form">
                    <section class="login_content">
                        <form role="form" id="form" action="<?php echo e($controller); ?>autentica" method="post">
                            <?php echo $token; ?>

                            <h1><i class="fa fa-lock"></i> Área de Login </h1>
                            <div class="resultado"></div>
                            <div>
                                <input type="text"
                                       name="username"
                                       id="username"
                                       class="form-control"
                                       placeholder="Login"
                                       required>
                            </div>
                            <div>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control"
                                       placeholder="Senha"
                                       required>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-default submit" >Entrar</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.blank', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>