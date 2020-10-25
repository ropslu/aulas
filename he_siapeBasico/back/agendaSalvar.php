<?php
// Checa se o arquivo está sendo acessivel direto pela URL
//if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
//    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
//    die( header( 'location: /error.php' ) );
//}

//session_start();
include_once("../conf/variaveis.php");
include_once("../conf/conexao.php");
include_once("../fnc/fnc.validacoes.php");

//date_default_timezone_set("Brazil/East");
//$dataAtual = date("Y-m-d");



/*
 Receber informações passadas do formulário
*/

$hospitaAgenda = '1';
/* DATA e HORA do cadastro */
//$dataAgenda = (organizaData(isset($_POST['dataAgenda']) ? $_POST['dataAgenda'] : null));
$dataAgenda = (organizaData("2020-08-02"));

//$horaAgenda = (isset($_POST['nHoraAgenda']) ? $_POST['nHoraAgenda'] : null);
$horaAgenda = "07:59";

/* Dados pessois */
//$situacaoAgenda = (apenasLetras(mb_strtoupper(isset($_POST['nSituacaoAgenda']) ? $_POST['nSituacaoAgenda'] : null)));
$situacaoAgenda = (apenasLetras(mb_strtoupper("A")));

//$medicoAgenda = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nMedicoAgenda']) ? $_POST['nMedicoAgenda'] : null)));
$medicoAgenda = '29';


//$acaoBotao = (isset($_POST['acao']) ? $_POST['acao'] : null);
$acaoBotao = "Inserir";
//$acaoBotao = "Atualizar";

// Valida acao
$acaoCheck = false;
if ($acaoBotao !== null) {
    if ($acaoBotao == "Atualizar" || $acaoBotao == "Inserir") {
        $acaoCheck = true;
    }
}
if ($acaoCheck == false) {
    $retorno = array('codigo' => 1, 'mensagem' => "SAINDO DA CHECAGEM COM ERRO: Ação $acaoBotao");
    echo json_encode($retorno);
    exit();
}


/*
 * VERIFICAR SE EXISTE AGENDA ABERTA PARA A DATA ATUAL
 */

try {
    echo "$dataAgenda e $horaAgenda";
    $pdo = conectar();
    $sqlAgenda = "SELECT count(nreg) FROM AGENDA WHERE AGENDA.DATA = :dataAgenda AND HORA = :horaAgenda";
    $selectAgenda = $pdo->prepare($sqlAgenda);
    $selectAgenda->bindParam(':dataAgenda',$dataAgenda);
    $selectAgenda->bindParam(':horaAgenda',$horaAgenda);
    $selectAgenda->execute();

}catch (PDOException $e){
    // Verifica se devemos debugar
    if ( DEBUG === true ) {
        echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
    }
}


// Inserir cadastro
if ($acaoBotao == "Inserir") {

    if ($selectAgenda->fetchColumn() == 0) { // Se a ação for inserir e não tiver agenda
        try{
            $sqlInserirAgenda = "INSERT INTO AGENDA (HOSPITAL, AGENDA.DATA, MEDICO, SITUACAO, HORA) VALUES (:hospital, :dataAgenda, :medicoAgenda, :situacao, :horaAgenda)";
            $insertAgenda = $pdo->prepare($sqlInserirAgenda);
            $insertAgenda->bindParam(':hospital',$hospitaAgenda);
            $insertAgenda->bindParam(':dataAgenda',$dataAgenda);
            $insertAgenda->bindParam(':medicoAgenda',$medicoAgenda);
            $insertAgenda->bindParam(':situacao',$situacaoAgenda);
            $insertAgenda->bindParam(':horaAgenda',$horaAgenda);
            $insertAgenda->execute();

        } catch (PDOException $e) {
            // Verifica se devemos debugar
            if (DEBUG === true) {
                echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
                exit();
            } else {
                $retorno = array('codigo' => 1, 'mensagem' => "Erro no select do da agenda." . $e->getMessage());
                echo json_encode($retorno);
                exit();
            }
        }
        if ($insertAgenda->rowCount() > 0) { // Verifica se houvem linhas inseridas no banco
            $retorno = array('codigo' => 0, 'mensagem' => "Agenda criada com sucesso.");
            echo json_encode($retorno);
            exit();

        } else { // Erro na contagem da agenda. Foi solicitado insert mas não foi adicionado.

            // Gera codigo de erro para JSON
            $retorno = array('codigo' => 1, 'mensagem' => "Algo errado no insert da agenda. Conctacte o administrador.");
            echo json_encode($retorno);
            exit();
        } // Fecha erro na contagem do hospital.

    } else { // Caso haja agenda e opção foi inserir
        $retorno = array('codigo' => 1, 'mensagem' => "Foi solicitado criar agenda mas já existe agenda para essa data e hora.");
        echo json_encode($retorno);
        exit();
    }


} else if ($acaoBotao == "Atualizar") { // Passos de ATUALIZACAO do hospital




} else { // Erro na identificação da ação
    // Gera codigo de erro para JSON
    $retorno = array('codigo' => 1, 'mensagem' => "Algum erro na identificação da ação");
    echo json_encode($retorno);
    exit();
}




