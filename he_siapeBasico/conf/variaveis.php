<?php
// Checa se o arquivo está sendo acessivel direto pela URL
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: /error.php'));
}

define('ABSPATH', dirname(__FILE__));

// Variaveis de Titulo e versão

define('NOMEHOSPITAL', "Hospital Espiritual Maria Cláudia Martins");
define('TITULO',   "SIAP - Sistema Integrado de Apoio ao Paciente");
define('VERSAO',   "v0.1");

// Variavael para conversao de letras
mb_internal_encoding('UTF-8');

// Variavel para data
date_default_timezone_set("Brazil/East");
$dataAtual = date("Y-m-d");
$dataAtualHora = date("Y-m-d-G-i");


/*
 * VARIÁVEIS PARA ACESSO VIA GET
 */

define('LINK', ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://" . $_SERVER['HTTP_HOST']));
define('URL', LINK . "/siapbasico");

// Constante de CSS - JS - IMG
define('HOME', URL . "/www");
define('CSS', URL . "/css");
define('NODEMODULES', URL . "/node_modules");
define('JS', URL . "/js");
define('IMG', URL . "/img");
define('BACK', URL . "/back");




// MODULOS
//define('MODULOS',URL."/modulos");
//define('GERENCIADOR', MODULOS."/gerenciador");
//define('TRATAMENTO', MODULOS."/tratamento");



/*
 * VARIAVEIS PARA ACESSO VIA INC
 *
 * DESCOBRIR QUAL SISTEMA OPERACIONAL ESTA RODANDO, PARA DEFINIR O DELIMITADOR DE PASTAS
 */

//var_dump(PHP_OS);
//By default, we assume that PHP is NOT running on windows.
$isWindows = false;

//If the first three characters PHP_OS are equal to "WIN",
//then PHP is running on a Windows operating system.
if (strcasecmp(substr(PHP_OS, 0, 3), 'WIN') == 0) {
    $isWindows = true;
}

//If $isWindows is TRUE, then print out a message saying so.
if ($isWindows) {
    //echo "é windows";
    $s = "\\";
} else {
    $s = "/";
}


define('DBARRA', dirname(__DIR__, 1) . $s);

// VARIAVEIS DE INC
define('DINC', DBARRA . 'inc' . $s);
define('DFNC', DBARRA . 'fnc' . $s);
define('DCONF', DBARRA . 'conf' . $s);
define('DWWW', DBARRA . 'www' . $s);
define('DJS', DBARRA . "js" . $s);
//define('DIMG',DBARRA."fnc".$s);


/**
 * Configuração de Banco
 */

// Nome do host da base de dados
define('HOSTNAME', 'localhost');

// Nome do DB
//define('DB_NAME', 'C:\hospitalespiritual\dados\BANCO.GDB');
define('DB_NAME', 'C:\hospitalespiritual\dados\BANCO-OK.GDB');

// Usuário do DB
define('DB_USER', 'sysdba');

// Senha do DB
define('DB_PASS', 'masterkey');

// Charset da conexão PDO
define('DB_CHARSET', 'utf8');

// Se você estiver desenvolvendo, modifique o valor para true
define('DEBUG', true);
//define('DEBUG', false);


// Chama arquivo de funcao de conexao
include_once 'conexao.php';
