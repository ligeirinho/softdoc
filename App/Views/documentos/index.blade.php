<!--
 * @view documentos/index.blade.php
 * @created at 03-11-2016 12:49:36
 * - Criado Automaticamente pelo HTR Assist
-->

@extends('layout.default')

@section('title', 'Lista de Documentos')

@section('style')
<link href="{{APPDIR}}font/flaticon.css" rel="stylesheet">
@endsection

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3>Documentos</h3>
                <i class="fa fa-list"></i> Lista de Documentos<br>
                <a href="{{$controller}}novo/" class="btn btn-info">
                    <i class="fa fa-plus"></i> Novo Registro
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Usuário</th>
                            <th>Extensão</th>
                            <th>Tamanho</th>
                            <th>Departamento</th>
                            <th>Classificação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $value)
                        <tr>
                            <td>
                                <a href="{{APPDIR}}index/ler/id/{{$value['id']}}">
                                    <i class='fa fa-external-link'></i> {{$value['titulo']}}
                                </a>
                            </td>
                            <td>
                                <a href="{{APPDIR}}auth/editar/id/{{$userLoggedIn['id']}}">
                                    {{$value['name']}}
                                </a>
                            </td>
                            <td>
                                <i class="flaticon-{{$value['extensao']}}-file-format text-primary"></i>
                            </td>
                            <td>
                                <?= $value['tamanho'] ? round(number_format($value['tamanho'], 2, '', '.')) . 'KB' : '<span class="badge">link</span>'; ?>
                            </td>
                            <td>
                                {{$value['departamento']}}
                            </td>
                            <td>
                                {{$value['classificacao']}}
                            </td>
                            <td>
                                <a href="{{$controller}}editar/id/{{$value['id']}}" class="btn btn-success">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#"
                                   onclick="confirmar('Deseja REMOVER este registro?', '{{$controller}}eliminar/id/{{$value['id']}}')"
                                   class="btn btn-danger">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if (isset($btn['link'][1]))
                <nav>
                    <ul class="pagination">
                        <li>
                            <a href="{{$controller}}visualizar/pagina/{{$btn['previus']}}" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        @foreach ($btn['link'] as $value)
                        <li><a href="{{$controller}}visualizar/pagina/{{$value}}">{{$value}}</a></li>
                        @endforeach
                        <li>
                            <a href="{{$controller}}visualizar/pagina/{{$btn['next']}}" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                @endif

            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
@endsection