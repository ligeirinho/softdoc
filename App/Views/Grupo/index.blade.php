<!--
 * @view Grupo/index.blade.php
 * @created at 27-03-2017 21:04:36
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Lista de Grupo')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3>Grupo</h3>
                <i class="fa fa-list"></i> Lista de Grupo<br>
                <a href="{{$controller}}novo/" class="btn btn-info">
                    <i class="fa fa-plus"></i> Novo Registro
                </a>
                <table class="table" id="tableGrupo" class="display" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Classificação</th>
                            <th>Criado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Classificação</th>
                            <th>Criado</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($result as $value)
                        <tr>
                            <td>{{$value['nome_grupo']}}</td>
                            <td>{{date('d-m-Y H:i:s',$value['criado'])}}</td>
                            <td>
                                <a href="{{$controller}}editar/id/{{$value['id']}}" class="btn btn-success">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="#"
                                   onclick="confirmar('Deseja REMOVER este registro?', '{{$controller}}eliminar/id/{{$value['id']}}')"
                                   class="btn btn-danger">
                                    <i class="fa fa-trash"></i> Eliminar
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