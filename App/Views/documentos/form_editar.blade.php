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
                                    <label>Grupo</label>
                                    <select 
                                           id="grupo"
                                           name="grupo"
                                           class="form-control"
                                           required>
                                           @foreach ($resultGrupos as $value)
                                           <option value="{{$value['id']}}"
                                                @if ($result['grupo_id'] == $value['id'])
                                                selected
                                            @endif
                                            >
                                               {{$value['nome_grupo']}}
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
                                           class="form-control"
                                           value="{{$result['link']}}">
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