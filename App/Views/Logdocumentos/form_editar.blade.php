<!--
 * @view Logdocumentos/form_editar.blade.php
 * @created at 27-03-2017 21:02:00
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Inserção de Logdocumentos')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Formulário de edição de Logdocumentos</h4>
                
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
                                    <label>Documento</label>
                                    <select 
                                           id="documento_id"
                                           name="documento_id"
                                           class="form-control"
                                           required>
                                           @foreach ($resultSoftdocDocumentos as $value)
                                           <option value="{{$value['id']}}"
                                               @if ($result['documento_id'] == $value['id'])
                                                   selected
                                               @endif
                                               >
                                               {{$value['id']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>AcaoId</label>
                                    <select 
                                           id="acao_id"
                                           name="acao_id"
                                           class="form-control"
                                           required>
                                           @foreach ($resultSoftdocAcao as $value)
                                           <option value="{{$value['id']}}"
                                               @if ($result['acao_id'] == $value['id'])
                                                   selected
                                               @endif
                                               >
                                               {{$value['id']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>UserId</label>
                                    <select 
                                           id="user_id"
                                           name="user_id"
                                           class="form-control"
                                           required>
                                           @foreach ($resultUsers as $value)
                                           <option value="{{$value['id']}}"
                                               @if ($result['user_id'] == $value['id'])
                                                   selected
                                               @endif
                                               >
                                               {{$value['id']}}
                                           </option>
                                           @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Criado</label>
                                    <input type="text"
                                           id="criado"
                                           name="criado"
                                           placeholder="Criado"
                                           class="form-control"
                                           value="{{$result['criado']}}"
                                           maxlength="15"
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