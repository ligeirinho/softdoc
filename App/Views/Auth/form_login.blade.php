@extends('layout.blank')

@section('title', 'Área de login')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-lock"></i> Área de login</h3>
                </div>
                <div class="panel-body">
                    <div class="resultado"></div>

                    <div class="alert alert-info" role="alert">
                        <i class="fa fa-user"></i> Username: <strong>admin</strong><br>
                        <i class="fa fa-key"></i> Password: <strong>admin123</strong><br>
                        <i class="fa fa-level-up"></i> Level: <strong>1 - Administrador</strong>
                    </div>

                    <div class="alert alert-danger" role="alert">
                        <i class="fa fa-user"></i> Username: <strong>teste</strong><br>
                        <i class="fa fa-key"></i> Password: <strong>teste123</strong><br>
                        <i class="fa fa-level-up"></i> Level: <strong>2 - Normal</strong><br>
                        <i class="fa fa-ban"></i><strong> Bloqueado</strong><br>
                    </div>

                    <form role="form" id="form" action="{{$controller}}autentica" method="post">
                        {!!$token!!}
                        <fieldset>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </span>
                                <input type="text"
                                       name="username"
                                       id="username"
                                       class="form-control"
                                       placeholder="Login"
                                       required>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </span>
                                <input type="password"
                                       name="password"
                                       id="password"
                                       class="form-control"
                                       placeholder="Senha"
                                       required>
                            </div>
                            <input type="submit" value="Entrar" class="btn btn-lg btn-success btn-block">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection