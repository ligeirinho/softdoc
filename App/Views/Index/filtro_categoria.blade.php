@extends('layout.default')

@section('title', 'Lista de Documentos')

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
                            <td>{{$value['titulo']}}</td>
                            <td>{{$value['name']}}</td>
                            <td>{{$value['extensao']}}</td>
                            <td>{{$value['tamanho']}}</td>
                            <td>{{$value['departamento']}}</td>
                            <td>{{$value['classificacao']}}</td>
                            <td>
                                <a href="{{$controller}}ler/id/{{$value['id']}}" class="btn btn-success">
                                    <i class="fa fa-eye"></i> Ler
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
