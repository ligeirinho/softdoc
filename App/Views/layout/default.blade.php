<!DOCTYPE html>
<html lang="pt-br">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="Service Desk" content="">
        <meta name="Paulo Henrique" content="Paulo Henrique">
        <title>@yield('title') :: {{APPNAM}} {{APPVER}} ::</title>

        @include('layout.Common.styles')
    </head>

    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                <div class="col-md-3 left_col">
                    <div class="left_col scroll-view">
                        <div class="navbar nav_title" style="border: 0;">
                            <a href="{{APPDIR}}index" class="site_title">
                                <i class="fa fa-book fa-flip-horizontal"></i>
                                <span style="font-size: 14px !important;">{{APPNAM}}</span>
                            </a>
                        </div>

                        <div class="clearfix"></div>

                        @include('layout.Partials.menu_vertical')

                    </div>
                </div>
                @include('layout.Partials.menu_horizontal_top')
                <div class="right_col" role="main">
                    <div class="">
                        
                     @yield('content')   
                        
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
        @include('layout.Common.scripts') 
    </body>

</html>