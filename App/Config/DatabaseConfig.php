<?php
/**
 * @file DatabaseConfig.php
 * @version 0.2
 * - Class que configura as diretrizes para conexão com o Banco de Dados
 */

namespace App\Config;

class DatabaseConfig
{
    public $db = [
        'sgbd' => 'mysql',
        'server' => 'bG9jYWxob3N0',
        'dbname' => 'c29mdGRvYw==',
        'username' => 'cm9vdA==',
        'password' => '',
        'options' => [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
    ];
}
