<?php

/** O nome do banco de dados*/
define('DB_NAME', 'mercado');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'root');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', '');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** caminho absoluto para a pasta do sistema **/
if (!defined('FILEPATH')){
    define('FILEPATH', dirname(__FILE__) . '/');
}

/** caminho no server para o sistema **/
if (!defined('BASEURL')){
    define('BASEURL', '/mercadoweb/');
}

///** caminho do arquivo de banco de dados **/
//if (!defined('DBSITE')){
//    define('DBSITE', FILEPATH . 'database.php');
//}
