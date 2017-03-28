<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">

        <ul class="nav side-menu">
            <li>
		<a href="{{APPDIR}}Index/dashboard/"><i class="fa fa-home"></i> Home</a>
            </li>
            <li>
                <a><i class="fa fa-book fa-fw"></i> Documentos<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{APPDIR}}documentos/">Gerenciar Documentos</a></li>
                    <li><a href="{{APPDIR}}documentos/novo/">Novo Documento</a></li>
                </ul>
                <!-- /.child_menu -->
            </li>
            <li>
                <a><i class="fa fa-list fa-fw"></i> Grupos de Usuários<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{APPDIR}}grouphasuser/">Gerenciar Usuário</a></li>
                </ul>
                <!-- /.child_menu -->
            </li>
            <li>
                <a><i class="fa fa-bank fa-fw"></i> Grupos<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{APPDIR}}grupo/">Gerenciar Grupos</a></li>
                    <li><a href="{{APPDIR}}grupo/novo/">Novo Departamento</a></li>
                </ul>
                <!-- /.child_menu -->
            </li>
            <li>
                <a>
                    <i class="fa fa-users fa-fw"></i> Usuários<span class="fa fa-chevron-down"></span>
                </a>
                <ul class="nav child_menu">
                    <li><a href="{{APPDIR}}usuario/">Gerenciar Usuários</a></li>
                    <li><a href="{{APPDIR}}usuario/novo/">Novo Registro</a></li>
                </ul>
                <!-- /.child_menu -->
            </li>
            <li>
				<a onclick="confirmar('Deseja sair do sistema?', '{{APPDIR}}auth/logout/')" href="#sair"><i class="fa fa-remove fa-fw"></i> Sair</a>
            </li>
        </ul>
    </div>
</div>
<!-- /sidebar menu -->