@extends('layout.blank')

@section('title', 'Detalhes do Livro')

@section('content')


<div class="container">

    <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-xs-12 col-sm-9">
            <div class="alert alert-danger">
                <h2>
                    <i class="fa fa-meh-o"></i> Não foi possível localizar a publicação ...
                </h2>
            </div>
        </div><!--/.col-xs-12.col-sm-9-->

    </div><!--/row-->

    <hr>
    <footer>
        <p>&copy; Secretaria de Planejamento do Estado do Pará.</p>
    </footer>

</div><!--/.container-->
@endsection

