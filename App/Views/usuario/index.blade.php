<!--
 * @view usuario/index.blade.php
 * @created at 16-03-2017 14:08:50
 * - Criado Automaticamente pelo HTR Assist
 -->

@extends('layout.default')

@section('title', 'Lista de Usuario')

@section('content')
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3>Usuario</h3>
                <i class="fa fa-list"></i> Lista de Usuario<br>
                <a href="{{$controller}}novo/" class="btn btn-info">
                    <i class="fa fa-plus"></i> Novo Registro
                </a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nome do Usuário</th>
                            <th>E-mail</th>
                            <th>Departamento</th>
                            <th>Ramal</th>
                            <th>Matrícula</th>
                            <th>Telefone</th>
                            <th>Celular</th>
                            <th>Criado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $value)
                        <tr>
                            <td>{{$value['nome']}}</td>
                            <td>{{$value['email']}}</td>
                            <td>{{$value['nome_departamento']}}</td>
                            <td>{{$value['ramal']}}</td>
                            <td>{{$value['matricula']}}</td>
                            <td>{{$value['telefone']}}</td>
                            <td>{{$value['celular']}}</td>
                            <td>{{date('d/m/Y H:i', $value['criado'])}}</td>
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