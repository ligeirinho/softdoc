<!--
 * @view Grouphasuser/form_novo.blade.php
 * @created at 27-03-2017 21:01:11
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Inserção de Grouphasuser')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de cadastro de Grouphasuser</h4>
                
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
                                    <label>Grupo</label>
                                    <select 
                                           id="grupo_id"
                                           name="grupo_id"
                                           class="form-control"
                                           required>
                                           @foreach ($resultGrupo as $value)
                                           <option value="{{$value['id']}}">
                                               {{$value['nome_grupo']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Usuário</label>
                                    <select 
                                           id="user_id"
                                           name="user_id"
                                           class="form-control"
                                           required>
                                           @foreach ($resultUsers as $value)
                                           <option value="{{$value['id']}}">
                                               {{$value['nome']}}
                                           </option>
                                           @endforeach
                                    </select>
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