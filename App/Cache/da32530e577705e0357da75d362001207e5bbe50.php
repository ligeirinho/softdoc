<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Service Desk" content="">
        <meta name="Paulo Henrique" content="Paulo Henrique">
        <title><?php echo $__env->yieldContent('title'); ?> :: <?php echo e(APPNAM); ?> <?php echo e(APPVER); ?> ::</title>

        <?php echo $__env->make('layout.Common.styles', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="<?php echo e(APPDIR); ?>Acesso/dashboard" class="site_title">
                                <i class="fa fa-fire fa-flip-horizontal"></i>
                                <span style="font-size: 14px !important;"><?php echo e(APPNAM); ?></span>
                            </a>
                        </div>

                        <div class="clearfix"></div>

                        <?php echo $__env->make('layout.Partials.menu_vertical', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

                    </div>
                </div>
                <?php echo $__env->make('layout.Partials.menu_horizontal_top', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <div class="right_col" role="main">
                    <div class="">
                        
                     <?php echo $__env->yieldContent('content'); ?>   
                        
                    </div>
                    
                </div>

                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <?php echo $__env->make('layout.Common.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
    </body>

</html>