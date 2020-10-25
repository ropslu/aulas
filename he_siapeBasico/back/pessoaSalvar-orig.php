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

/* DATA e HORA do cadastro */
//$dataCadastro = (isset($_POST['dt_cadastro']) ? $_POST['dt_cadastro'] : null);
$dataCadastro = "2020-08-02";

//$horaCadastro = (isset($_POST['hora_cadastro']) ? $_POST['hora_cadastro'] : null);
$horaCadastro = "07:59:00";

$dataHoraCadastro = organizaData ($dataCadastro)." ".$horaCadastro;
//$dataCadastro = '02/08/2020 07:59:00';

/* Dados pessois */
//$nomePessoa = (apenasLetras(mb_strtoupper(isset($_POST['nNomePessoa']) ? $_POST['nNomePessoa'] : null)));
$nomePessoa = (apenasLetras(mb_strtoupper("Danilo Augusto Menezes Clementee")));
//$nomePessoa = (apenasLetras(mb_strtoupper('MARIA JULIA DA SILVA')));

//$dataNascimento = (organizaData(isset($_POST['nDataNascPessoa']) ? $_POST['nDataNascPessoa'] : null));
$dataNascimento = (organizaData('1983-08-24'));
//$dataNascimento = (organizaData('1950-04-12'));


$respPessoa = (mb_strtoupper(isset($_POST['nRespPaciente']) ? $_POST['nRespPaciente'] : null));
//$respPessoa = (mb_strtoupper("O(A) MESMO(A)"));

$condicaoPessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nCondicaoPessoa']) ? $_POST['nCondicaoPessoa'] : null)));
//$condicaoPaciente = (apenasNumero("1"));
$dataObito = (organizaData(isset($_POST['nDataObito']) ? $_POST['nDataObito'] : null));
//$dataObito = ("");

//$rgPessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nRGPessoa']) ? $_POST['nRGPessoa'] : null)));
$rgPessoa = (RemoveCaracteresEspeciais(apenasNumero("56934467")));

$rgOrgao = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRGOrgao']) ? $_POST['nRGOrgao'] : null)));
//$rgOrgao = (RemoveCaracteresEspeciais(mb_strtoupper("SSP")));
$rgUF = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRGUF']) ? $_POST['nRGUF'] : null)));
//$rgUF = (RemoveCaracteresEspeciais(mb_strtoupper("PB")));

$sexoPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nsexoPessoa']) ? $_POST['nsexoPessoa'] : null)));
//$sexoPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("M")));

$nomeMaePessoa = (apenasLetras(mb_strtoupper(isset($_POST['nNomeMae']) ? $_POST['nNomeMae'] : null)));
//$nomeMaePessoa = (apenasLetras(mb_strtoupper("DANILO")));

$religiaoPessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nReligiaoPessoa']) ? $_POST['nReligiaoPessoa'] : null)));
//$religiaoPessoa = (RemoveCaracteresEspeciais(apenasNumero("1")));

$profissaoPessoa = (apenasLetras(mb_strtoupper(isset($_POST['nProfissaoPessoa']) ? $_POST['nProfissaoPessoa'] : null)));
//$profissaoPessoa = (apenasLetras(mb_strtoupper("DANILO")));


$nacionalidadePessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nNacionalidadePessoa']) ? $_POST['nNacionalidadePessoa'] : null)));
//$nacionalidadePessoa = (RemoveCaracteresEspeciais(mb_strtoupper("Brasil das Américas")));



$emailPessoa = (removeCaracteresEmail(mb_strtolower(isset($_POST['nEmail']) ? $_POST['nEmail'] : null)));
//$emailPessoa = (removeCaracteresEmail(mb_strtolower("damclemente@gmail.com")));

$telPessoa = (apenasNumero(strtoupper(isset($_POST['nTelPessoa']) ? $_POST['nTelPessoa'] : null)));
//$telPessoa = (apenasNumero(mb_strtoupper("081981020890")));


/* Acho q nao tem sentido */
//name="nFamiliaPessoa"

/* Características do paciente */

$pessoaBebe = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaBebe']) ? $_POST['nPessoaBebe'] : null)));
//$pessoaBebe = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaFuma = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaFuma']) ? $_POST['nPessoaFuma'] : null)));
//$pessoaFuma = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaPrimeiraVez = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaPrimeiraVez']) ? $_POST['nPessoaPrimeiraVez'] : null)));
//$pessoaPrimeiraVez = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaMedControlada = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaMedControlada']) ? $_POST['nPessoaMedControlada'] : null)));
//$pessoaMedControlada = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaTratOutraInst = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaTratOutraInst']) ? $_POST['nPessoaTratOutraInst'] : null)));
//$pessoaTratOutraInst = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaNomeInst = (apenasLetras(mb_strtoupper(isset($_POST['nPessoaNomeInstituicao']) ? $_POST['nPessoaNomeInstituicao'] : null)));
//$pessoaNomeInst = (apenasLetras(mb_strtoupper("DANILO")));



/* Endereço */

$cepPessoa = (apenasNumero(isset($_POST['nCepPessoa']) ? $_POST['nCepPessoa'] : null));
//$cepPessoa = (apenasNumero("50930000"));

$ruaPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['rua']) ? $_POST['rua'] : null)));
//$ruaPessoa = (trocaNome(RemoveCaracteresEspeciais(ucwords(mb_strtolower("Av. Dr. JOsé Rufino")))));

$numPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nNum']) ? $_POST['nNum'] : null)));
//$numHospital = (RemoveCaracteresEspeciais(mb_strtoupper("2984")));

$compPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nComp']) ? $_POST['nComp'] : null)));
//$compHospital = (RemoveCaracteresEspeciais(mb_strtoupper("Bloco B, apt. 503")));

$bairroPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['bairro']) ? $_POST['bairro'] : null)));
//$bairroHospital = (RemoveCaracteresEspeciais(mb_strtoupper("Imbiribeira")));

$cidadePessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['cidade']) ? $_POST['cidade'] : null)));
//$cidadeHospital = (RemoveCaracteresEspeciais(mb_strtoupper("Camaragibe")));

$ufPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['uf']) ? $_POST['uf'] : null)));
//$ufHospital = (RemoveCaracteresEspeciais(mb_strtoupper("PB")));

//name="nPais"
$paisPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPais']) ? $_POST['nPais'] : null)));
//$paisHospital = (RemoveCaracteresEspeciais(mb_strtoupper("Brasil das Américas")));
//


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


// Converter data para padrão do firebird
//$n1 = substr($v_datanasc,0,4);
//$n2 = substr($v_datanasc,5,2);
//$n3 = substr($v_datanasc,8,2);
//$nasc = "$n3.$n2.$n1";

//
///*
//    Validacoes dos campos
//*/
//// Valida Razão social
//$tamanhoMinimoCampo = 10;
//if ($razaoSocialHospital === null || (strlen($razaoSocialHospital) < $tamanhoMinimoCampo)) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O valor da Razão social não está válido. O nome precisa conter mais de $tamanhoMinimoCampo caracteres.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida  sigla
//$tamanhoMinimoCampo = 4;
////$validaCampo = validaCampoTamanhoPost($siglaHospital, $tamanhoMinimoCampo);
//if ($siglaHospital === null || (strlen($siglaHospital) < $tamanhoMinimoCampo)) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O valor da Sigla não está válido. A sigla precisa conter mais de $tamanhoMinimoCampo caracteres.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida CNPJ
///*
//    PRECISA VALIDAR O CNPJ? OU DEIXA ISSO PARA JAVASCRIPT???
//*/
//if (strlen($cnpjHospital) <> 0) {
//    $tamanhoCampo = 14;
//    //$validaCampo = validaCampoTamanhoPost($cnpjHospital, $tamanhoMinimoCampo);
//    if ($cnpjHospital === null || (strlen($cnpjHospital) <> $tamanhoCampo)) {
//        $retorno = array('codigo' => 1, 'mensagem' => "O CNPJ não está válido. O CNPJ precisa conter $tamanhoCampo caracteres.");
//        echo json_encode($retorno);
//        exit();
//    }
//} else {
//    if ($cnpjHospital === null) {
//        $retorno = array('codigo' => 1, 'mensagem' => "O CNPJ não está válido.");
//        echo json_encode($retorno);
//        exit();
//    }
//}
//
//// Valida CEP
//if (strlen($cepHospital) <> 0) {
//    $tamanhoMinimoCampo = 8;
//    if ($cepHospital === null || (strlen($cepHospital) < $tamanhoMinimoCampo)) {
//        $retorno = array('codigo' => 1, 'mensagem' => "O CEP não está válido, precisa conter $tamanhoMinimoCampo caracteres.");
//        echo json_encode($retorno);
//        exit();
//    }
//} else {
//    //$tamanhoMinimoCampo = 0;
//    if ($cepHospital === null) {
//        $retorno = array('codigo' => 1, 'mensagem' => "O CEP não está válido.");
//        echo json_encode($retorno);
//        exit();
//    }
//}
//
//// Valida Rua
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($ruaHospital, $tamanhoMinimoCampo);
//if ($ruaHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O logradouro não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida Numero
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($numHospital, $tamanhoMinimoCampo);
//if ($numHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O número não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida Complemento
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($compHospital, $tamanhoMinimoCampo);
//if ($compHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O complemento não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida Bairro
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($bairroHospital, $tamanhoMinimoCampo);
//if ($bairroHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O bairro não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida Cidade
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($cidadeHospital, $tamanhoMinimoCampo);
//if ($cidadeHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "A cidade não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida UF
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($ufHospital, $tamanhoMinimoCampo);
//if ($ufHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O UF não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//
//// Valida Pais
////$tamanhoMinimoCampo = 0;
////$validaCampo = validaCampoTamanhoPost($paisHospital, $tamanhoMinimoCampo);
//if (!empty($paisHospital)) {
//    if ($paisHospital === null) {
//        $retorno = array('codigo' => 1, 'mensagem' => "O País não está válido.");
//        echo json_encode($retorno);
//        exit();
//    }
//}
//
//// Checa email
//if (!empty($emailHospital)) {
//    if (!filter_var($emailHospital, FILTER_VALIDATE_EMAIL)) {
//        $retorno = array('codigo' => 1, 'mensagem' => "E-mail inválido = $emailHospital");
//        echo json_encode($retorno);
//        exit();
//    }
//}
//
//// Valida Telefone
//if ($telHospital === null) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O telefone não está válido.");
//    echo json_encode($retorno);
//    exit();
//}
//


/*
    Ajuste para o FIREBIRD, nomento do SQL. Permite que campos vazios recebam NULL.
    Campos não vazios, recebem ''. Campos vazios, ficam normais
*/

/*
    Campos que podem ser vazios
*/

// DATA OBITO
if (empty($dataObito)){$dataObito = NULL; }

// RG
//if (empty($rgPessoa)){$rgPessoa = NULL; }
//if (empty($rgOrgao)){$rgOrgao = NULL; }
//if (empty($rgUF)){$rgUF = NULL; }

// SEXO
if (empty($sexoPessoa)){$sexoPessoa = NULL; }

// RELIGIAO
if (empty($religiaoPessoa)){$religiaoPessoa = NULL; }

// PROFISSAO
if (empty($profissaoPessoa)){$profissaoPessoa = NULL; }

// NACIONALIDADE
if (empty($nacionalidadePessoa)){$nacionalidadePessoa = NULL; }

// EMAIL - TELEFONE
if (empty($emailPessoa)){$emailPessoa = NULL; }
if (empty($telPessoa)){$telPessoa = NULL; }

// NOME OUTRA INSTITUICAO
if (empty($pessoaNomeInst)){$pessoaNomeInst = NULL; }


// ENDERECO
// CEP
if (empty($cepPessoa)){$cepPessoa = NULL; }
if (empty($ruaPessoa)){$ruaPessoa = NULL; }
if (empty($numPessoa)){$numPessoa = NULL; }
if (empty($compPessoa)){$compPessoa = NULL; }
if (empty($bairroPessoa)){$bairroPessoa = NULL; }
if (empty($cidadePessoa)){$cidadePessoa = NULL; }
if (empty($ufPessoa)){$ufPessoa = NULL; }
if (empty($paisPessoa)){$paisPessoa = NULL; }



/*
 * VERIFICAR SE EXISTE AGENDA ABERTA PARA A DATA ATUAL
 */



/*
    Inicia insert
*/

try{
    // Inicia conexao com banco e faz o select
    $pdo = conectar();
    // Verifica se já existe Pessoa cadastrada e pega o ID
//    select nreg from ficha where no_usuario = 'DANILO AUGUSTO MENEZES CLEMENTE'  and DT_NASCIMENTO = '26.08.1984' or (nr_identidade = '5693498');

    $sqlPessoa = 'SELECT count(nreg) FROM FICHA WHERE no_usuario = :nomePessoa AND DT_NASCIMENTO = :dataNascimento OR (nr_identidade = :rgPessoa)';
    //$sqlPessoa = "SELECT nreg FROM FICHA WHERE no_usuario = 'DANILO AUGUSTO MENEZES CLEMENTE' AND DT_NASCIMENTO = '26.08.1983' OR (nr_identidade = '5693478')";
    //$sqlPessoa = "SELECT nreg FROM FICHA WHERE no_usuario = 'Teste02' AND DT_NASCIMENTO = '26.08.1983' OR (nr_identidade = '5693478')";
    $selectPessoa = $pdo->prepare($sqlPessoa);
    $selectPessoa->bindParam(':nomePessoa', $nomePessoa);
    $selectPessoa->bindParam(':dataNascimento', $dataNascimento);
    $selectPessoa->bindParam(':rgPessoa', $rgPessoa);
    $selectPessoa->execute();
    //$selectHospital->closeCursor();
}catch (PDOException $e){
    // Verifica se devemos debugar
    if ( DEBUG === true ) {
        echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
    }
} // Fecha catch


// Validar qual ação a ser tomada
if ($acaoBotao == "Inserir") {

    //$teste = $selectPessoa->rowCount();
    //$teste = $selectPessoa->fetchColumn();

    //echo "$teste </br>";
    if ($selectPessoa->fetchColumn() == 0) { // Validar se existe Pessoa

        try{
            $sqlInsertPessoa = "INSERT INTO FICHA (NO_USUARIO, DT_NASCIMENTO, DATA_OBITO, IN_SEXO, CONDICAO_DO_PACIENTE, NO_MAE, CO_RELIGIAO, ID_CBOR, RESPONSAVEL, BEBE, FUMA, PRIMEIRA_VEZ, MEDICACAO_CONTROLADA, TRATAMENTO_EM_OUTRA_INSTITUICAO, QUAL_INSTITUICAO_SE_TRATA, NAC_CODIGO, NR_IDENTIDADE, CD_ORGAO_EMISSOR_IDENTIDADE, CD_SIGLA_UF_IDENTIDADE, EMAIL_PCNTE, NR_TELEFONE, CD_CEP, NO_LOGRADOURO, NR_LOGRADOURO, NO_COMPL_LOGRADOURO, NO_BAIRRO, MUNI_CD_COD_IBGE_RESID, UF_RESIDENCIA, DATA_CADASTRO) VALUES (:nomePessoa, :dataNascimento, :dataObito, :sexoPessoa, :condicaoPaciente, :nomeMaePessoa, :religiaoPessoa, :profissaoPessoa, :respPessoa, :pessoaBebe, :pessoaFuma, :pessoaPrimeiraVez, :pessoaMedControlada, :pessoaTratOutraInst, :pessoaNomeInst, :nacionalidadePessoa, :rgPessoa, :rgOrgao, :rgUF, :emailPessoa, :telPessoa, :cepPessoa, :ruaPessoa, :numPessoa, :compPessoa, :bairroPessoa, :cidadePessoa, :ufPessoa, :dataCadastro)";

            $insertPessoa = $pdo->prepare($sqlInsertPessoa);
            $insertPessoa->bindParam(':nomePessoa',$nomePessoa);
            $insertPessoa->bindParam(':dataNascimento', $dataNascimento);
            $insertPessoa->bindParam(':dataObito',$dataObito);
            $insertPessoa->bindParam(':sexoPessoa', $sexoPessoa);
            $insertPessoa->bindParam(':condicaoPaciente', $condicaoPessoa);
            $insertPessoa->bindParam(':nomeMaePessoa', $nomeMaePessoa);
            $insertPessoa->bindParam(':religiaoPessoa', $religiaoPessoa);
            $insertPessoa->bindParam(':profissaoPessoa', $profissaoPessoa);
            $insertPessoa->bindParam(':respPessoa', $respPessoa);
            $insertPessoa->bindParam(':pessoaBebe', $pessoaBebe);
            $insertPessoa->bindParam(':pessoaFuma', $pessoaFuma);
            $insertPessoa->bindParam(':pessoaPrimeiraVez', $pessoaPrimeiraVez);
            $insertPessoa->bindParam(':pessoaMedControlada', $pessoaMedControlada);
            $insertPessoa->bindParam(':pessoaTratOutraInst', $pessoaTratOutraInst);
            $insertPessoa->bindParam(':pessoaNomeInst', $pessoaNomeInst);
            $insertPessoa->bindParam(':nacionalidadePessoa', $nacionalidadePessoa);
            $insertPessoa->bindParam(':rgPessoa', $rgPessoa);
            $insertPessoa->bindParam(':rgOrgao', $rgOrgao);
            $insertPessoa->bindParam(':rgUF', $rgUF);
            $insertPessoa->bindParam(':emailPessoa', $emailPessoa);
            $insertPessoa->bindParam(':telPessoa', $telPessoa);
            $insertPessoa->bindParam(':cepPessoa', $cepPessoa);
            $insertPessoa->bindParam(':ruaPessoa', $ruaPessoa);
            $insertPessoa->bindParam(':numPessoa', $numPessoa);
            $insertPessoa->bindParam(':compPessoa', $compPessoa);
            $insertPessoa->bindParam(':bairroPessoa', $bairroPessoa);
            $insertPessoa->bindParam(':cidadePessoa', $cidadePessoa);
            $insertPessoa->bindParam(':ufPessoa', $ufPessoa);
            $insertPessoa->bindParam(':dataCadastro', $dataHoraCadastro);
//            $insertPessoa->bindParam(':dddTelPessoa', $dddTelPessoa);
//            $insertPessoa->bindParam(':cadastrador', $cadastrador);
            //$resultInsertPessoa = $insertPessoa->execute();
            $insertPessoa->execute();

        }catch (PDOException $e){
            // Verifica se devemos debugar
            if ( DEBUG === true ) {
                echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
            } else {
                $retorno = array('codigo' => 1, 'mensagem' => "Erro no insert da pessoa." . $e->getMessage());
                echo json_encode($retorno);
                exit();
            }

        } // Fecha catch

        //if ($resultInsertPessoa) {
            if ($insertPessoa->rowCount() > 0) {
            // Se insert de pessoa foi OK, coleta NREG
            //$nregPessoa = ''; // Define a varivel para ser usado no try
            try {
                // Pegar o ID do usuario adicionado
                $sqlNregPessoa = 'SELECT gen_id(GERA_NREG_FICHA,0) FROM ficha';
                //$sqlNregPessoa = $pdo->query("select gen_id(GERA_NREG_FICHA,0) from ficha");
                $selectNreg = $pdo->prepare($sqlNregPessoa);
                $sqlNreg = $selectNreg->execute();
                //$result as $row $nreg =$row[0];
                //global $nregPessoa; // define variavel como global para ser usada fora do try
                foreach ($sqlNreg as $row) {
                    $nregPessoa = $row[0];
                }
            } catch (PDOException $e) {
                // Verifica se devemos debugar
                if (DEBUG === true) {
                    echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
                    exit();
                } else {
                    $retorno = array('codigo' => 1, 'mensagem' => "Erro no select do NREG." . $e->getMessage());
                    echo json_encode($retorno);
                    exit();
                }
            }
                if ($nregPessoa != '') { // Validar se pegou o numero do registro

            // Chama a função do código de barras.
            require_once '../fnc/fnc.codigoBarras.php';
            //$codeBarPessoa = geraCodigoBarra($_SESSION['hospital_nreg'] . $nregPessoa); // Será usado quando tiver login
            $codeBarPessoa = geraCodigoBarra('1' . $nregPessoa);
            echo "$codeBarPessoa </br >";

            try {
                $sqlUpdatePessoa = "UPDATE FICHA SET PRONTUARIO = :codigoBarra  WHERE nreg = :nreg";

                $updatePessoa = $pdo->prepare($sqlUpdatePessoa);
                $updatePessoa->bindParam(':codigoBarra', $codeBarPessoa);
                $updatePessoa->bindParam(':nreg', $nregPessoa);
                $updatePessoa->execute();

            } catch (PDOException $e) {
                // Verifica se devemos debugar
                if (DEBUG === true) {
                    echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
                    exit();
                } else {
                    $retorno = array('codigo' => 1, 'mensagem' => "Erro no update do codigo de barras." . $e->getMessage());
                    echo json_encode($retorno);
                    exit();
                }
            }


            if ($updatePessoa->rowCount() > 0) {
                // Código de barras atualizado. Iniciando inserção do motivo da consulta na tabela FICHA_ATENDIMENTO
                try {

                    $sqlInsertMotivo = "INSERT INTO FICHA (NO_USUARIO, DT_NASCIMENTO, DATA_OBITO, IN_SEXO, CONDICAO_DO_PACIENTE, NO_MAE, CO_RELIGIAO, ID_CBOR, RESPONSAVEL, BEBE, FUMA, PRIMEIRA_VEZ, MEDICACAO_CONTROLADA, TRATAMENTO_EM_OUTRA_INSTITUICAO, QUAL_INSTITUICAO_SE_TRATA, NAC_CODIGO, NR_IDENTIDADE, CD_ORGAO_EMISSOR_IDENTIDADE, CD_SIGLA_UF_IDENTIDADE, EMAIL_PCNTE, NR_TELEFONE, CD_CEP, NO_LOGRADOURO, NR_LOGRADOURO, NO_COMPL_LOGRADOURO, NO_BAIRRO, MUNI_CD_COD_IBGE_RESID, UF_RESIDENCIA, DATA_CADASTRO) VALUES (:nomePessoa, :dataNascimento, :dataObito, :sexoPessoa, :condicaoPaciente, :nomeMaePessoa, :religiaoPessoa, :profissaoPessoa, :respPessoa, :pessoaBebe, :pessoaFuma, :pessoaPrimeiraVez, :pessoaMedControlada, :pessoaTratOutraInst, :pessoaNomeInst, :nacionalidadePessoa, :rgPessoa, :rgOrgao, :rgUF, :emailPessoa, :telPessoa, :cepPessoa, :ruaPessoa, :numPessoa, :compPessoa, :bairroPessoa, :cidadePessoa, :ufPessoa, :dataCadastro)";

                    $insertMotivoPessoa = $pdo->prepare($sqlInsertMotivo);
                    $insertMotivoPessoa->bindParam(':nomePessoa',$nomePessoa);
                    $insertMotivoPessoa->execute();



                } catch (PDOException $e) {
                    // Verifica se devemos debugar
                    if (DEBUG === true) {
                        echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
                        exit();
                    } else {
                        $retorno = array('codigo' => 1, 'mensagem' => "Erro no insert do motivo da consulta." . $e->getMessage());
                        echo json_encode($retorno);
                        exit();
                    }
                }


            } else { // Não tem atualizacao de codigo de barras
                $retorno = array('codigo' => 1, 'mensagem' => "Update de codigo de barras apresentou problemas. Não foi cadastrado o código de barras. Por favor, contactar administrador do sistema.");
                echo json_encode($retorno);
                exit();
            } // Fim execução de veririficação de updade do codigo de barras
        } else { //Execução do insert com problemas
            $retorno = array('codigo' => 1, 'mensagem' => "Execução do insert de pessoa apresentou problemas. Contacte o administrador.");
            echo json_encode($retorno);
            exit();
        }










    } else { // Erro na contagem da pessoa. Foi solicitado insert mas já existe pessoa com os dados passados

        // Gera codigo de erro para JSON
        $retorno = array('codigo' => 1, 'mensagem' => "Algo errado na verificação da ação. Solicitou inserir mas já existe uma pessoa com NOME e DATA DE NASCIMENTO OU RG cadastrados. Conctacte o administrador - Nome: $nomePessoa. Nasc:$dataNascimento. RG: $rgPessoa");
        echo json_encode($retorno);
        exit();
    } // Fecha erro na contagem do hospital.

} else if ($acaoBotao == "Atualizar") { // Passos de ATUALIZACAO do hospital

    if ($selectHospital->rowCount() == 1) { // Validar se existe hospital
        // Pega o ID do hospital
        try {
            while ($linha = $selectHospital->fetch(PDO::FETCH_ASSOC)) {
                $idHospital = $linha['id_hospital'];
            }
        } catch (PDOException $e) {
            // Verifica se devemos debugar
            if ( DEBUG === true ) {
                echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
            }
        } // Fecha catch

        // Inicia UPDATE
        try{
            // Realizando o UPDATE
            $sqlUpdateHospital = 'UPDATE tab_hospital SET razao_social_hospital=:nome, sigla_hospital=:sigla, cnpj_hospital=:cnpj, email_hospital=:email, telefone_hospital=:tel WHERE id_hospital=:id';
            $updateHospital = $pdo->prepare($sqlUpdateHospital);
            $updateHospital->bindParam(':id', $idHospital);
            $updateHospital->bindParam(':nome', $razaoSocialHospital);
            $updateHospital->bindParam(':sigla', $siglaHospital);
            $updateHospital->bindParam(':cnpj', $cnpjHospital);
            $updateHospital->bindParam(':email', $emailHospital);
            $updateHospital->bindParam(':tel', $telHospital);
            $resultUpdateHospital = $updateHospital->execute();

        }catch (PDOException $e){
            // Verifica se devemos debugar
            if ( DEBUG === true ) {
                echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
            }
        } // Fecha catch


        if ($resultUpdateHospital){ // Se atualização do hospital foi OK
            try {
                // Se update de hospital foi OK, update de endereço
                $sqlUpdateEndHospital = 'UPDATE tab_hopital_endereco SET cep_hospital=:cep, logradouro_hospital=:rua, numero_hospital=:num, complemento_hospital=:comp, bairro_hospital=:bairro, cidade_hospital=:cidade, estado_hospital=:uf, pais_hospital=:pais WHERE id_hospital=:id';
                $updateEndHospital = $pdo->prepare($sqlUpdateEndHospital);
                $updateEndHospital->bindParam(':id', $idHospital);
                $updateEndHospital->bindParam(':cep', $cepHospital);
                $updateEndHospital->bindParam(':rua', $ruaHospital);
                $updateEndHospital->bindParam(':num', $numHospital);
                $updateEndHospital->bindParam(':comp', $compHospital);
                $updateEndHospital->bindParam(':bairro', $bairroHospital);
                $updateEndHospital->bindParam(':cidade', $cidadeHospital);
                $updateEndHospital->bindParam(':uf', $ufHospital);
                $updateEndHospital->bindParam(':pais', $paisHospital);
                $resultUpdateEndHospital = $updateEndHospital->execute();

            } catch (PDOException $e){
                // Verifica se devemos debugar
                if ( DEBUG === true ) {
                    echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
                }
            } // Fecha catch

            if ($resultUpdateEndHospital) { // Se resultado do update endereco foi OK
                $updateEndHospital->closeCursor();

                $retorno = array('codigo' => 0, 'mensagem' => 'Update realizado com sucesso.');
                echo json_encode($retorno);
                exit();
            }  else { // Erro no update do endereco do hospital

                // Libera variaveis
                $updateEndHospital->closeCursor();

                // Gera codigo de erro para JSON
                $retorno = array('codigo' => 1, 'mensagem' => 'Algo errado o update do endereço do hospital. Conctacte o administrador.');
                echo json_encode($retorno);
                exit();
            } // Fecha update endereco

            // Fim de atualiza hospital
        } else { // Erro no update do hospital
            // Libera variaveis
            $updateHospital->closeCursor();

            // Gera codigo de erro para JSON
            $retorno = array('codigo' => 1, 'mensagem' => 'Algo errado o update do hospital. Conctacte o administrador');
            echo json_encode($retorno);
            exit();
        }
    } else { // Erro na contagem do hospital. Foi solicitado atualizar mas não existe hospital com os dados passados.

        // Libera variaveis
        $selectHospital->closeCursor();

        // Gera codigo de erro para JSON
        $retorno = array('codigo' => 1, 'mensagem' => 'Algo errado na verificação da ação. Solicitou atualizar mas não existe um hospital com essa Razão social e SIGLA informados. Não pode atualizar o Nome e SIGLA ao mesmo tempo. Se isso não foi o problema, conctacte o administrador');
        echo json_encode($retorno);
        exit();
    } //Fecha Atualiza hospital

} else { // Erro na identificação da ação

    // Libera variaveis
    $selectHospital->closeCursor();

    // Gera codigo de erro para JSON
    $retorno = array('codigo' => 1, 'mensagem' => "Algum erro na identificação da ação");
    echo json_encode($retorno);
    exit();
}

