<?php

require_once 'Autenticacao.php';

$auth = new Access();
$auth->verificar();
echo '<pre>';
var_dump($auth->responseObject());

