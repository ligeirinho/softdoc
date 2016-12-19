@extends('layout.default')

@section('title', 'Lista de Documentos')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Categorias</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @foreach ($resultClassificacao as $value)
    <!-- price element -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="pricing">
            <a href="{{APPDIR}}index/filtroCategoria/id/{{$value['classificacao_id']}}/Categoria/{{$value['nome_classificacao']}}">
                <div class="title">
                    <h2>{{$value['departamento']}}</h2>
                    <h1>{{$value['nome_classificacao']}}</h1>
                </div>
            </a>
            <div class="x_content">
                <div style="padding: 5px;">
                    <ul class="list-unstyled text-left">
                        <li>
                            <span class="badge">{{$value['quantidade']}}</span>
                            <strong>{{$value['quantidade'] > 1 ? 'Documentos registrados' : 'Documento registrado'}}</strong>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- price element -->
    @endforeach

</div>
@endsection