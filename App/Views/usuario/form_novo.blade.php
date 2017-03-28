<!--
 * @view usuario/form_novo.blade.php
 * @created at 16-03-2017 14:08:50
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Inserção de Usuario')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de cadastro de Usuario</h4>
                
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
                        <form action="{{$controller}}registra/" method="post" id="form">
                            {!!$token!!}
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Nome do Usuário</label>
                                    <input type="text"
                                           id="nome"
                                           name="nome"
                                           placeholder="Nome do Usuário"
                                           class="form-control"
                                           maxlength="45"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>E-mail</label>
                                    <input type="text"
                                           id="email"
                                           name="email"
                                           placeholder="E-mail"
                                           class="form-control"
                                           maxlength="100"
                                           >
                                </div>
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <select 
                                           id="departamento"
                                           name="departamento"
                                           class="form-control"
                                           >
                                           @foreach ($resultBasDepartamento as $value)
                                           <option value="{{$value['id']}}">
                                               {{$value['nome_departamento']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Ramal</label>
                                    <input type="text"
                                           id="ramal"
                                           name="ramal"
                                           placeholder="Ramal"
                                           class="form-control"
                                           maxlength="15"
                                           >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Matrícula</label>
                                    <input type="text"
                                           id="matricula"
                                           name="matricula"
                                           placeholder="Matrícula"
                                           class="form-control"
                                           maxlength="10"
                                           >
                                </div>
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text"
                                           id="telefone"
                                           name="telefone"
                                           placeholder="Telefone"
                                           class="form-control"
                                           maxlength="15"
                                           >
                                </div>
                                <div class="form-group">
                                    <label>Celular</label>
                                    <input type="text"
                                           id="celular"
                                           name="celular"
                                           placeholder="Celular"
                                           class="form-control"
                                           maxlength="15"
                                           >
                                </div>
                                
                                <div class="form-group">
                                    <br>
                                    <button class="btn btn-primary"><i class="fa fa-check"></i> Registrar</button>
                                    <a href="{{$controller}}" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Voltar</a>
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
@endsection