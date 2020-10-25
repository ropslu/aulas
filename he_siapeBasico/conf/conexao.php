<?php

function conectar(){

// Tenta conectar
    try{
        $PDO = new PDO('firebird:host='.HOSTNAME.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASS);
        $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e){
        // Verifica se devemos debugar
        if ( DEBUG === true ) {
            // Mostra a mensagem de erro
            echo "Erro: " . $e->getMessage();
        }
        // Kills the script
        die();
    } // Fecha catch

    // Return conexao
    return $PDO;
} // Fecha function

/*
// Constantes
$hostname = "localhost";
$user = "root";
$password = "";
$database = "hene_siap";
// Cria conexao
$conn = mysqli_connect($hostname, $user, $password, $database) or die("Error " . mysqli_error($conn));
mysqli_set_charset( $conn, 'utf8');
// Checa conexao
//if(!$conn) {
//    print "Falha na conexão com o Banco de Dados";
//}

if (mysqli_connect_errno())
{
    #echo "Failed to connect to MySQL: " . mysqli_connect_error();
    echo "Failed to connect to DataBase ";
    exit ();
}

//mysqli_close($conn);
*/