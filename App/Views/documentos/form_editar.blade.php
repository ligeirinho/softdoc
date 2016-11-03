<!--
 * @view documentos/form_editar.blade.php
 * @created at 03-11-2016 12:49:39
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Inserção de Documentos')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de edição de Documentos</h4>
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-table fa-fw"></i> Formulário de Edição
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="resultado"></div>
                        <form action="{{$controller}}altera/" method="post" id="form">
                            {!!$token!!}
                            <input type="hidden" name="id" value="{{$result['id']}}">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Título</label>
                                    <input type="text"
                                           id="titulo"
                                           name="titulo"
                                           placeholder="Título"
                                           class="form-control"
                                           value="{{$result['titulo']}}"
                                           maxlength="70"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <input type="text"
                                           id="user_id"
                                           name="user_id"
                                           placeholder="Usuário"
                                           class="form-control"
                                           value="{{$result['user_id']}}"
                                           maxlength="5"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Log</label>
                                    <input type="text"
                                           id="log_id"
                                           name="log_id"
                                           placeholder="Log"
                                           class="form-control"
                                           value="{{$result['log_id']}}"
                                           maxlength="5"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Extensão</label>
                                    <input type="text"
                                           id="extensao"
                                           name="extensao"
                                           placeholder="Extensão"
                                           class="form-control"
                                           value="{{$result['extensao']}}"
                                           maxlength="10"
                                           >
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Revisão</label>
                                    <input type="text"
                                           id="revisao"
                                           name="revisao"
                                           placeholder="Revisão"
                                           class="form-control"
                                           value="{{$result['revisao']}}"
                                           maxlength="11"
                                           >
                                </div>
                                <div class="form-group">
                                    <label>Tamanho</label>
                                    <input type="text"
                                           id="tamanho"
                                           name="tamanho"
                                           placeholder="Tamanho"
                                           class="form-control"
                                           value="{{$result['tamanho']}}"
                                           maxlength="20"
                                           >
                                </div>
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text"
                                           id="departamento"
                                           name="departamento"
                                           placeholder="Departamento"
                                           class="form-control"
                                           value="{{$result['departamento']}}"
                                           maxlength="5"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label>Classificação</label>
                                    <input type="text"
                                           id="classificacao_id"
                                           name="classificacao_id"
                                           placeholder="Classificação"
                                           class="form-control"
                                           value="{{$result['classificacao_id']}}"
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