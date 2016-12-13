<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-user"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li><a href="{{APPDIR}}auth/editar/id/{{$userLoggedIn['id']}}">
                                <i class="fa fa-user fa-fw">{{$userLoggedIn['name']}}</i>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{APPDIR}}auth/logout/"><i class="fa fa-remove fa-fw"></i> Logout</a></li>
                    </ul>
                </li>

                <li role="presentation" class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-tasks"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul id="menu1" class="dropdown-menu list-unstyled msg_list" role="menu">
                        <i class="fa fa-user"></i> <i class="fa fa-caret-down"></i>                   
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /top navigation -->