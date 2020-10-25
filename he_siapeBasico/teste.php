<?php

//$dataNascimento = '1983-12-20';
//$date = new DateTime($dataNascimento );
//$interval = $date->diff( new DateTime( date('Y-m-d') ) );
//echo $interval->format( '%Y anos' );

echo "chamando a funcao da data<br />";
include_once "fnc/fnc.validacoes.php";
$dataNascimento = "1983-12-20";
//$dataNascimento = "26/08/1983";
echo "Data apresentada ".$dataNascimento.".<br />";
$idade = idade("$dataNascimento");
echo "$idade";

$dataCadastro = date("Y-m-d");

//$horaCadastro = (isset($_POST['hora_cadastro']) ? $_POST['hora_cadastro'] : null);
//$horaCadastro = "07:59:00";
$horaCadastro = date('h:i:s');

$dataHoraCadastro = organizaData($dataCadastro) . " " . $horaCadastro;
echo "<br/>No php: $dataHoraCadastro";
echo "<br />No banco: 30/06/2019 10:45:13";

