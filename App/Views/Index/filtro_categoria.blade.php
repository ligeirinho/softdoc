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
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Usuário</th>
                            <th>Ranking</th>
                            <th>Extensão</th>
                            <th>Tamanho</th>
                            <th>Grupo</th>
                            <th>Criado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $value)
                        <tr>
                            <td>
                                <a href="{{APPDIR}}index/ler/id/{{$value['id']}}" target="_blank">
                                    <i class='fa fa-external-link'></i> {{$value['titulo']}}
                                </a>
                            </td>
                            <td>{{$value['nome']}}</td>
                            <td>
                                <?php
                                $ran = false;
                                if (array_key_exists($value['id'], $ranking)) {
                                    $ran = ($ranking[$value['id']] / count($rankingTotal)) * 100;
                                }
                                ?>
                                @if ($ran)
                                    <div class="progress progress_sm">
                                        <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="{{$ran}}" aria-valuenow="{{$ran - 1}}" style="width: <?=$ran;?>%;"></div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <i class="flaticon-{{$value['extensao']}}-file-format text-primary"></i>
                            </td>
                            <td><?= $value['tamanho'] ? round(number_format($value['tamanho'], 2, '', '.')) . 'KB' : '<span class="badge">link</span>'; ?></td>
                            <td>{{$value['nome_grupo']}}</td>
                            <td>{{date('d-m-Y H:i:s',$value['criado'])}}</td>
                            <td>
                                <a href="{{$controller}}ler/id/{{$value['id']}}" class="btn btn-success" target="_blank">
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

