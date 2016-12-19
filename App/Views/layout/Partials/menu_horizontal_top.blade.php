<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="#user" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{APPDIR}}auth/editar/id/{{$userLoggedIn['id']}}">
                                <i class="fa fa-user fa-fw"> {{$userLoggedIn['name']}}</i>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a onclick="confirmar('Deseja sair do sistema?', '{{APPDIR}}auth/logout/')" href="#sair"><i class="fa fa-remove fa-fw"></i> Sair</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->