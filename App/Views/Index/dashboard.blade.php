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
    <div class="row">
        @foreach ($resultClassificacao as $value)
        <a class="btn btn-lg btn-success" 
           href="{{APPDIR}}index/filtroCategoria/id/{{$value['id']}}/Categoria/{{$value['nome_classificacao']}}">
            <i class="fa fa-book fa-2x pull-left"></i> {{$value['nome_classificacao']}}
        </a>
        @endforeach
    </div>
</div>
@endsection