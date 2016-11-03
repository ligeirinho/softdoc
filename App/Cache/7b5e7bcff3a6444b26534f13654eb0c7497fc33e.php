            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo e(APPDIR); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Usuários<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>auth/"><i class="fa fa-cogs fa-fw"></i> Gerenciar Usuários</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>auth/novo/"><i class="fa fa-plus-circle fa-fw"></i> Novo Registro</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-book fa-fw"></i> Documentos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>documentos/"><i class="fa fa-cogs fa-fw"></i> Gerenciar Documentos</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>documentos/novo/"><i class="fa fa-plus-circle fa-fw"></i> Novo Documento</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list-alt fa-fw"></i> Classificação<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>classificacao/"><i class="fa fa-cogs fa-fw"></i> Gerenciar Classificação</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>classificacao/novo/"><i class="fa fa-plus-circle fa-fw"></i> Nova Classificação</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-list-ol fa-fw"></i> Tipos<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>tipos/"><i class="fa fa-cogs fa-fw"></i> Gerenciar Tipos</a>
                                </li>
                                <li>
                                    <a href="<?php echo e(APPDIR); ?>tipos/novo/"><i class="fa fa-plus-circle fa-fw"></i> Novo Tipo</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->