@extends('layout.default')

@section('title', 'Lista de Documentos')

@section('content')
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Grupos de expertise</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

    @foreach ($resultGrupos as $value)
    <!-- price element -->
    <div class="form-group">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="pricing">
                <a href="{{APPDIR}}index/filtroGrupos/id/{{$value['id']}}/Categoria/{{$value['nome_grupo']}}">
                    <div class="title">
                        <h2>{{$value['nome_grupo']}}</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endforeach
    
</div>
@endsection