<?php

/**
 * LAUS DEO
 * @author Edson Bruno <bruno.monteirodg@gmail.com>
 * @version 0.0.1
 */
use \App\Auth\Autenticacao;

$auth = new Autenticacao;
$auth->sincSessionId();


header('location: index.php');
