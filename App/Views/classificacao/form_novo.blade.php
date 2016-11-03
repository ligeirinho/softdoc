<!--
 * @view classificacao/form_novo.blade.php
 * @created at 03-11-2016 12:51:02
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Inserção de Classificacao')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de cadastro de Classificacao</h4>
                
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
                                    <label>Classificação</label>
                                    <input type="text"
                                           id="nome_classificacao"
                                           name="nome_classificacao"
                                           placeholder="Classificação"
                                           class="form-control"
                                           maxlength="40"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text"
                                           id="departamento"
                                           name="departamento"
                                           placeholder="Departamento"
                                           class="form-control"
                                           maxlength="5"
                                           required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Criado</label>
                                    <input type="text"
                                           id="criado"
                                           name="criado"
                                           placeholder="Criado"
                                           class="form-control"
                                           maxlength="15"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Alterado</label>
                                    <input type="text"
                                           id="alterado"
                                           name="alterado"
                                           placeholder="Alterado"
                                           class="form-control"
                                           maxlength="15"
                                           >
                                </div>
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <input type="text"
                                           id="usuario_id"
                                           name="usuario_id"
                                           placeholder="Usuário"
                                           class="form-control"
                                           maxlength="5"
                                           required>
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