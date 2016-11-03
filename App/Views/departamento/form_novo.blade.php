<!--
 * @view departamento/form_novo.blade.php
 * @created at 03-11-2016 12:52:13
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Inserção de Departamento')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de cadastro de Departamento</h4>
                
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
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <input type="text"
                                           id="nome_departamento"
                                           name="nome_departamento"
                                           placeholder="Departamento"
                                           class="form-control"
                                           maxlength="200"
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