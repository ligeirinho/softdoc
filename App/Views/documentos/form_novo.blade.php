<!--
 * @view documentos/form_novo.blade.php
 * @created at 03-11-2016 12:49:38
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
                <h4 class="page-header">Formulário de cadastro de Documentos</h4>
                
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
                                    <label>Título</label>
                                    <input type="text"
                                           id="titulo"
                                           name="titulo"
                                           placeholder="Título"
                                           class="form-control"
                                           maxlength="70"
                                           required>
                                </div>
                                
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <select 
                                           id="departamento"
                                           name="departamento"
                                           class="form-control"
                                           required>
                                           @foreach ($resultDepartamento as $value)
                                           <option value="{{$value['id']}}">
                                               {{$value['nome']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Classificação</label>
                                    <select 
                                           id="classificacao_id"
                                           name="classificacao_id"
                                           class="form-control"
                                           required>
                                           @foreach ($resultClassificacao as $value)
                                           <option value="{{$value['id']}}">
                                               {{$value['nome_classificacao']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Opções de publicação</label>
                                    <input type="radio" name="change_publicacao" value="arquivo" class="change_publicacao" checked=""> Arquivo |
                                    <input type="radio" name="change_publicacao" value="link" class="change_publicacao"> Link
                                </div>
                                <div class="form-group set-arquivo">
                                    <label>Arquivo para publicação</label>
                                    <input type="file" name="arquivo" class="form-control">
                                </div>

                                <div class="form-group set-link" style="display: none">
                                    <label>Link de arquivo externo</label>
                                    <input type="url"
                                           id="link"
                                           name="link"
                                           placeholder="URL do arquivo externo"
                                           class="form-control">
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

@section('scripts')

    $('.change_publicacao').click(function() {

        var value = $(this).val();

        if (value == 'arquivo') {
            $('.set-link').hide();
            $('.set-arquivo').show();
        }

        if (value == 'link') {
            $('.set-link').show();
            $('.set-arquivo').hide();
        }
    });

@endsection