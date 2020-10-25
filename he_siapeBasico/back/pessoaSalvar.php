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

date_default_timezone_set("Brazil/East");
//$dataAtual = date("d/m/Y");
//$dataAtual = date("Y-m-d");
//$dataAtualHora = date("Y-m-d-G-i");
//$horaAtual = date('h:i:s');

// Variaveis temporárias. REMOVER APÒS CONFIGURAÇÂO DAS FUNCÕES NO SISTEMA
$idHospital = "1";
$medicoAgenda = "29"; // Maria Claudia (NO SISTEMA DO MCM)
$nAgenda = "5000";
$nFamilia = "0";


/*
 Receber informações passadas do formulário
*/

/* DATA e HORA do cadastro */
//$dataCadastro = (isset($_POST['dt_cadastro']) ? $_POST['dt_cadastro'] : null);
//$dataCadastro = "2020-08-02";
$dataCadastro = date("Y-m-d");

//$horaCadastro = (isset($_POST['hora_cadastro']) ? $_POST['hora_cadastro'] : null);
//$horaCadastro = "07:59:00";
$horaCadastro = date('h:i:s');

$dataHoraCadastro = organizaData($dataCadastro) . " " . $horaCadastro;
//$dataCadastro = '02/08/2020 07:59:00';


/* Dados pessois */

// Tipo do paciente
//$tipoPaciente = (apenasLetras(mb_strtoupper(isset($_POST['tipoPac']) ? $_POST['tipoPac'] : null)));
$tipoPaciente = (apenasLetras(mb_strtoupper("presencial")));

//Prioridade
//sem prioridade - 0
//prioridade inicial - 1
//crianças - 2
//idosos - 3
//gestante - 4
//outras - 5
$tipoPrioridade = (apenasLetras(mb_strtoupper(isset($_POST['sitAtual']) ? $_POST['sitAtual'] : null)));
//$tipoPrioridade = (apenasLetras(mb_strtoupper("semPrioridade")));

$nomePessoa = (apenasLetras(mb_strtoupper(isset($_POST['nNomePessoa']) ? $_POST['nNomePessoa'] : null)));
//$nomePessoa = (apenasLetras(mb_strtoupper("DANILO AUGUSTO MENEZES EEEEE")));

$sexoPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nsexoPessoa']) ? $_POST['nsexoPessoa'] : null)));
//$sexoPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("M")));

$dataNascimento = (organizaData(isset($_POST['nDataNascPessoa']) ? $_POST['nDataNascPessoa'] : null));
//$dataNascimento = (organizaData('1983-08-27'));
//$dataNascimento = "26/08/1983";
$idade = idade($dataNascimento);

$nacionalidadePessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nNacionalidadePessoa']) ? $_POST['nNacionalidadePessoa'] : null)));
//$nacionalidadePessoa = (RemoveCaracteresEspeciais(mb_strtoupper("010")));

$profissaoPessoa = (apenasLetras(mb_strtoupper(isset($_POST['nProfissaoPessoa']) ? $_POST['nProfissaoPessoa'] : null)));
//$profissaoPessoa = (apenasLetras(mb_strtoupper("ADM sistemas")));

$rgPessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nRGPessoa']) ? $_POST['nRGPessoa'] : null)));
//$rgPessoa = (RemoveCaracteresEspeciais(apenasNumero("5696444")));
$rgOrgao = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRGOrgaoPessoa']) ? $_POST['nRGOrgaoPessoa'] : null)));
//$rgOrgao = (RemoveCaracteresEspeciais(mb_strtoupper("SSP")));
$rgUF = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRGUFPessoa']) ? $_POST['nRGUFPessoa'] : null)));
//$rgUF = (RemoveCaracteresEspeciais(mb_strtoupper("PE")));

$religiaoPessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nReligiaoPessoa']) ? $_POST['nReligiaoPessoa'] : null)));
//$religiaoPessoa = (RemoveCaracteresEspeciais(apenasNumero("1")));

$nomeMaePessoa = (apenasLetras(mb_strtoupper(isset($_POST['nomeMaePessoa']) ? $_POST['nomeMaePessoa'] : null)));
//$nomeMaePessoa = (apenasLetras(mb_strtoupper("Maria Felisberta Menezes Clemente")));

// Para pacientes desencarnados
$dataObito = (organizaData(isset($_POST['ndataObitoPaciente']) ? $_POST['ndataObitoPaciente'] : null));
//$dataObito = null;

// Informações de contato - Endereço - Email - Telefone*/
$cepPessoa = (apenasNumero(isset($_POST['nCepPessoa']) ? $_POST['nCepPessoa'] : null));
//$cepPessoa = (apenasNumero("50930000"));

$ruaPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRuaPessoa']) ? $_POST['nRuaPessoa'] : null)));
//$ruaPessoa = (trocaNome(RemoveCaracteresEspeciais(ucwords(mb_strtolower("Av. Dr. JOsé Rufino")))));

$numPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nNumPessoa']) ? $_POST['nNumPessoa'] : null)));
//$numPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("2984")));

$compPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nCompPessoa']) ? $_POST['nCompPessoa'] : null)));
//$compPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("Bloco B, apt. 503")));

$bairroPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nBairroPessoa']) ? $_POST['nBairroPessoa'] : null)));
//$bairroPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("Tejipió")));

$cidadePessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nCidadePessoa']) ? $_POST['nCidadePessoa'] : null)));
//$cidadePessoa = (RemoveCaracteresEspeciais(mb_strtoupper("RECIFEEE")));

$ufPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nUFPessoa']) ? $_POST['nUFPessoa'] : null)));
//$ufPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("PE")));

$emailPessoa = (removeCaracteresEmail(mb_strtolower(isset($_POST['nEmailPessoa']) ? $_POST['nEmailPessoa'] : null)));
//$emailPessoa = (removeCaracteresEmail(mb_strtolower("damclemente@gmail.com")));

$dddTelPessoa = (apenasNumero(strtoupper(isset($_POST['ndddTelPessoa']) ? $_POST['ndddTelPessoa'] : null)));
//$dddTelPessoa = (apenasNumero(strtoupper("081")));

$telPessoa = (apenasNumero(strtoupper(isset($_POST['nTelPessoa']) ? $_POST['nTelPessoa'] : null)));
//$telPessoa = (apenasNumero(mb_strtoupper("981020890")));

//name="nPais"
$paisPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPaisPessoa']) ? $_POST['nPaisPessoa'] : null)));
//$paisPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("011")));
//


// Dados dos responsável
$idRespPessoa = (apenasNumero(isset($_POST['nRespPessoa']) ? $_POST['nRespPessoa'] : null));
//$idRespPessoa = (mb_strtoupper("2"));
$rgRespPessoa = (RemoveCaracteresEspeciais(apenasNumero(isset($_POST['nRGRespPessoa']) ? $_POST['nRGRespPessoa'] : null)));
//$rgRespPessoa = (RemoveCaracteresEspeciais(apenasNumero("56934467")));
$rgOrgaoRespPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRGOrgaoRespPessoa']) ? $_POST['nRGOrgaoRespPessoa'] : null)));
//$rgOrgaoRespPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("SSP")));
$rgUFRespPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nRGUFRespPessoa']) ? $_POST['nRGUFRespPessoa'] : null)));
//$rgUFRespPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("PB")));
$sexoRespPessoa = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nsexoRespPessoa']) ? $_POST['nsexoRespPessoa'] : null)));
//$sexoPessoa = (RemoveCaracteresEspeciais(mb_strtoupper("M")));
$dataNascimentoRespPessoa = (organizaData(isset($_POST['nDataNascRespPessoa']) ? $_POST['nDataNascRespPessoa'] : null));
//$dataNascimentoRespPessoa = (organizaData('1983-08-23'));


/* Características do paciente */
$pessoaMedControlada = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaMedControlada']) ? $_POST['nPessoaMedControlada'] : null)));
//$pessoaMedControlada = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaFuma = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaFuma']) ? $_POST['nPessoaFuma'] : null)));
//$pessoaFuma = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaBebe = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaBebe']) ? $_POST['nPessoaBebe'] : null)));
//$pessoaBebe = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaTratOutraInst = (RemoveCaracteresEspeciais(mb_strtoupper(isset($_POST['nPessoaTratOutraInst']) ? $_POST['nPessoaTratOutraInst'] : null)));
//$pessoaTratOutraInst = (RemoveCaracteresEspeciais(mb_strtoupper("N")));

$pessoaNomeInst = (apenasLetras(mb_strtoupper(isset($_POST['nPessoaNomeInstituicao']) ? $_POST['nPessoaNomeInstituicao'] : null)));
//$pessoaNomeInst = (apenasLetras(mb_strtoupper("DANILO")));
//$pessoaNomeInst = null;


// Motivo da consulta
$motivoConsultaPaciente = (apenasLetras(mb_strtoupper(isset($_POST['nmotivoConsultaPaciente']) ? $_POST['nmotivoConsultaPaciente'] : null)));
//$motivoConsultaPaciente = (apenasLetras(mb_strtoupper("Problemas na perna")));


$acaoBotao = (isset($_POST['acao']) ? $_POST['acao'] : null);
//$acaoBotao = "Inserir";
//$acaoBotao = "Atualizar";

// Valida acao
$acaoCheck = false;
if ($acaoBotao !== null) {
    if ($acaoBotao === "Atualizar" || $acaoBotao === "Inserir") {
        $acaoCheck = true;
    }
}
if ($acaoCheck == false) {
    $retorno = array('codigo' => 1, 'mensagem' => "SAINDO DA CHECAGEM COM ERRO: Ação $acaoBotao");
    echo json_encode($retorno);
    exit();
}

///*
//    Validacoes dos campos
//*/
// NAO PODEM SER VAZIOS
//$sexoPessoa
//$dataNascimento
//$rgPessoa
//$rgOrgao
//$rgUF
//$nomeMaePessoa

// Nome da pessoa
//$tamanhoMinimoCampo = 9;
//if ($nomePessoa === null || (strlen($nomePessoa) < $tamanhoMinimoCampo)) {
//    $retorno = array('codigo' => 1, 'mensagem' => "O nome não está completo ou é menor que o permitido. O nome precisa conter mais de $tamanhoMinimoCampo caracteres.");
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


// Tipo do paciente
if ($tipoPaciente !== null) {
    if ($tipoPaciente === "PRESENCIAL" || $tipoPaciente === "DISTANCIA") {
        $condicaoPaciente = "1";
    } elseif ($tipoPaciente == "DESENCARNADO") {
        $condicaoPaciente = "2";
    } else {
        $retorno = array('codigo' => 1, 'mensagem' => "SAINDO DA CHECAGEM DO TIPO DE PACIENTE: Tipo de paciente: $tipoPaciente");
        echo json_encode($retorno);
        exit();
    }
} else {
    $retorno = array('codigo' => 1, 'mensagem' => "SAINDO DA CHECAGEM DO TIPO DE PACIENTE: Tipo de paciente = NULL");
    echo json_encode($retorno);
    exit();
}

// Prioridade
switch ($tipoPrioridade) {
    case "SEMPRIORIDADE":
        $prioridade = "0";
        //echo "A PRIORIDADE é $prioridade<br />";
        break;
    case "INICIAL":
        $prioridade = "1";
        break;
    case "CRIANCA":
        $prioridade = "2";
        break;
    case "IDOSO":
        $prioridade = "3";
        break;
    case "GESTANTE":
        $prioridade = "4";
        break;
    case "ESPECIAIS":
        $prioridade = "5";
        break;
    default:
        $retorno = array('codigo' => 1, 'mensagem' => "SAINDO DA CHECAGEM DO TIPO DE PRIORIDADE: Tipo de prioridade: $tipoPrioridade");
        echo json_encode($retorno);
        exit();
}

/*
 * INICIO DE CHECAGEM DA CIDADE
 */
//1) Checa a cidade e pega o codigo
// Checa de o estado é igual
//Se não achar codigo, verificar pais. Se for brasil (Erro, cidade errada). Se vor outro, adiciona na tabela de municipio (SE DER, PROCURA NA INTERNET).

// Valida Cidade
//$tamanhoMinimoCampo = 0;
//$validaCampo = validaCampoTamanhoPost($cidadeHospital, $tamanhoMinimoCampo);
if (empty($cidadePessoa) || $cidadePessoa === null) {
    $retorno = array('codigo' => 1, 'mensagem' => "A cidade não foi informada ou apresenta algum erro. Contacte o administrador.");
    echo json_encode($retorno);
    exit();
} else {
    try {
        // Checa se a cidade existe na tabela
        $pdo = conectar(); // Inicia conexao com banco e faz o select
        $sqlMunicipio = 'SELECT MUN_IBGE, MUN_UF FROM TB_MUNICIPIO WHERE MUN_NOME = :cidadePessoa ';
        $selectMunicipio = $pdo->prepare($sqlMunicipio);
        $selectMunicipio->bindParam(':cidadePessoa', $cidadePessoa);
        $selectMunicipio->execute();
    } catch (PDOException $e) {
        // Verifica se devemos debugar
        if (DEBUG === true) {
            echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
        }
    } // Fecha catch
}

if ($selectMunicipio->fetchColumn() != "") { // Validar se existe Cidade
    $selectMunicipio->execute();
    foreach ($selectMunicipio as $row) {
        $codCidadePessoa = trim($row[0]);
        $estadoMunicipioPessoa = trim($row[1]);
    }
    if ($paisPessoa == "010" && $ufPessoa != $estadoMunicipioPessoa) {
        // Verificar se o estado passadoconfere com o colhido na tabela
//        if ($ufPessoa != $estadoMunicipioPessoa) {
            $retorno = array('codigo' => 1, 'mensagem' => "CIDADE: $codCidadePessoa. ESTADO: $estadoMunicipioPessoa. A cidade não consta na lista para este estado. Por favor, validar as informações ou contactar o administrador.");
            echo json_encode($retorno);
            exit();
//        }
    }
} else {
    // CIDADE NAO ENCONTRADA - CHEGANDO PAIS
    if ($paisPessoa != "010") {
        // Colhe a informação sobre ultimo numero do registro
        try {
            $sqlCodMunicipio = "SELECT FIRST 1 MUN_IBGE FROM TB_MUNICIPIO WHERE MUN_UF = '**' order by MUN_IBGE DESC";
            foreach ($pdo->query($sqlCodMunicipio) as $row) {
                //echo "$row[0]<br />";
                $codCidadePessoa = sprintf("%06s",trim($row[0]) + 1);
            }
        } catch (PDOException $e) {
            // Verifica se devemos debugar
            if (DEBUG === true) {
                echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
                exit();
            } else {
                $retorno = array('codigo' => 1, 'mensagem' => "Erro ao descobrir próximo número do codigo do município. Contact o administrador" . $e->getMessage());
                echo json_encode($retorno);
                exit();
            }
        }
        // Insere dados na tabela TB_MUNICIPIO
        try {
            $sqlInsertMunicipio = "INSERT INTO  TB_MUNICIPIO (MUN_IBGE, MUN_NOME, MUN_UF) VALUES (:MUN_IBGE, :MUN_NOME, '**')";
            $insertMunicipioPessoa = $pdo->prepare($sqlInsertMunicipio);
            $insertMunicipioPessoa->bindParam(':MUN_IBGE', $codCidadePessoa);
            $insertMunicipioPessoa->bindParam(':MUN_NOME', $cidadePessoa);
            $insertMunicipioPessoa->execute();
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

        if ($insertMunicipioPessoa->rowCount() == 0) {
            // Se insert do motivo da consulta foi OK, coleta ENCERRA
            $retorno = array('codigo' => 1, 'mensagem' => "Erro ao adicionar a cidade na tabela de minicípio. Contact o administrador.");
            echo json_encode($retorno);
            exit();
        }
    } else {
        $retorno = array('codigo' => 1, 'mensagem' => "A cidade não encontrada. Por favor, verifique a grafia da cidade, estado e país.");
        echo json_encode($retorno);
        exit();
    }
}

/*
 * FIM CHECAGEM CIDADE
 */


//
//// TESTE. SAINDO ANTES DE INSERIR MOTIvo CONSULTA
//$retorno = array('codigo' => 1, 'mensagem' => "HORA CADASTRO: $dataHoraCadastro <br />
//PRIORIDADE: $prioridade<br />
//NOME: $nomePessoa<br />
//SEXO: $sexoPessoa<br />
//Nascimento: $dataNascimento<br />
//idade: $idade<br />
//NACIONALIDADE: $nacionalidadePessoa<br />
//PROFISSAO: $profissaoPessoa<br />
//RG: $rgPessoa - $rgOrgao - $rgUF<br />
//RELIGIAO: $religiaoPessoa<br />
//NOME MAE: $nomeMaePessoa<br />
//DATA OBITO: $dataObito<br />
//END: $cepPessoa - $ruaPessoa - $numPessoa - $compPessoa -  $bairroPessoa - $cidadePessoa - $ufPessoa  <br />
//EMAIL: $emailPessoa - $dddTelPessoa - $telPessoa <br />
//PAIS: $paisPessoa<br />
//RESP: $idRespPessoa - $rgRespPessoa - $rgOrgaoRespPessoa - $rgUFRespPessoa - $sexoRespPessoa - $dataNascimentoRespPessoa<br />
//MED_CONT: $pessoaMedControlada - Fuma: $pessoaFuma - Bebe: $pessoaBebe - Trat: $pessoaTratOutraInst - QUAL: $pessoaNomeInst<br />
//MOTIVO: $motivoConsultaPaciente<br />
//BOTAO: $acaoBotao");
//echo json_encode($retorno);
//exit();

/*
    Campos que podem ser vazios
*/

// DATA OBITO
if (empty($dataObito)) {
    $dataObito = NULL;
}

// PROFISSAO
if (empty($profissaoPessoa)) {
    $profissaoPessoa = NULL;
}

// NACIONALIDADE
if (empty($nacionalidadePessoa)) {
    $nacionalidadePessoa = NULL;
}

// EMAIL - TELEFONE
if (empty($emailPessoa)) {
    $emailPessoa = NULL;
}
if (empty($telPessoa)) {
    $telPessoa = NULL;
}

// NOME OUTRA INSTITUICAO
if (empty($pessoaNomeInst)) {
    $pessoaNomeInst = NULL;
}


// ENDERECO
if (empty($cepPessoa)) {
    $cepPessoa = NULL;
}
if (empty($ruaPessoa)) {
    $ruaPessoa = NULL;
}
if (empty($numPessoa)) {
    $numPessoa = NULL;
}
if (empty($compPessoa)) {
    $compPessoa = NULL;
}
if (empty($bairroPessoa)) {
    $bairroPessoa = NULL;
}
if (empty($cidadePessoa)) {
    $cidadePessoa = NULL;
}
if (empty($ufPessoa)) {
    $ufPessoa = NULL;
}
if (empty($paisPessoa)) {
    $paisPessoa = NULL;
}

// RESPONSAVEL
if (empty($idRespPessoa)) {
    $idRespPessoa = NULL;
}
if (empty($rgRespPessoa)) {
    $rgRespPessoa = NULL;
}
if (empty($rgOrgaoRespPessoa)) {
    $rgOrgaoRespPessoa = NULL;
}
if (empty($rgUFRespPessoa)) {
    $rgUFRespPessoa = NULL;
}
if (empty($sexoRespPessoa)) {
    $sexoRespPessoa = NULL;
}
if (empty($dataNascimentoRespPessoa)) {
    $dataNascimentoRespPessoa = NULL;
}

/*
 * VERIFICAR SE EXISTE AGENDA ABERTA PARA A DATA ATUAL
 */


/*
 * AJUSTAR AINDA COMO INSERIR O RESPONSAVEL
 *             - TABELA RESPONSAVEL
//            $idRespPessoa
//            $rgRespPessoa
//            $rgOrgaoRespPessoa
//            $rgUFRespPessoa
//            $sexoRespPessoa
//            $dataNascimentoRespPessoa
 */

/*
    Inicia insert
*/

try {
    // Inicia conexao com banco e faz o select
//    $pdo = conectar();
    // Verifica se já existe Pessoa cadastrada e pega o ID
//    select nreg from ficha where no_usuario = 'DANILO AUGUSTO MENEZES CLEMENTE'  and DT_NASCIMENTO = '26.08.1984' or (nr_identidade = '5693498');
    //echo "INICIANDO SELECT PARA VER SE EXISTE PESSOA <br />";
    $sqlPessoa = 'SELECT count(nreg) FROM FICHA WHERE no_usuario = :nomePessoa AND DT_NASCIMENTO = :dataNascimento OR (nr_identidade = :rgPessoa)';
    //$sqlPessoa = "SELECT nreg FROM FICHA WHERE no_usuario = 'DANILO AUGUSTO MENEZES CLEMENTE' AND DT_NASCIMENTO = '26.08.1983' OR (nr_identidade = '5693478')";
    //$sqlPessoa = "SELECT nreg FROM FICHA WHERE no_usuario = 'Teste02' AND DT_NASCIMENTO = '26.08.1983' OR (nr_identidade = '5693478')";
    $selectPessoa = $pdo->prepare($sqlPessoa);
    $selectPessoa->bindParam(':nomePessoa', $nomePessoa);
    $selectPessoa->bindParam(':dataNascimento', $dataNascimento);
    $selectPessoa->bindParam(':rgPessoa', $rgPessoa);
    $selectPessoa->execute();
    //$selectHospital->closeCursor();
} catch (PDOException $e) {
    // Verifica se devemos debugar
    if (DEBUG === true) {
        echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
    }
} // Fecha catch


// Validar qual ação a ser tomada
if ($acaoBotao == "Inserir") {

    //$teste = $selectPessoa->rowCount();
    //$teste = $selectPessoa->fetchColumn();

    //echo "$teste </br>";
    if ($selectPessoa->fetchColumn() == 0) { // Validar se existe Pessoa
        //echo "PASSOU CHECAGEM DE PESSOA. ANTES DE INSERIR <br />";


        try {
            $sqlInsertPessoa = "INSERT INTO FICHA (NO_USUARIO, DT_NASCIMENTO, IN_SEXO, NO_MAE, NR_IDENTIDADE, CD_SIGLA_UF_IDENTIDADE, CD_NACIONALIDADE, MUNI_CD_COD_IBGE_RESID, NO_LOGRADOURO, NR_LOGRADOURO, NO_COMPL_LOGRADOURO, NO_BAIRRO, CD_CEP, NR_DDD, NR_TELEFONE, DATA_CADASTRO, EMAIL_PCNTE, CO_RELIGIAO, MEDICACAO_CONTROLADA, BEBE, FUMA, TRATAMENTO_EM_OUTRA_INSTITUICAO, QUAL_INSTITUICAO_SE_TRATA, CONDICAO_DO_PACIENTE, RESPONSAVEL, CD_ORGAO_EMISSOR_IDENTIDADE, ID_CBOR, UF_RESIDENCIA,PRIORIDADE, NAC_CODIGO, HOSPITAL, DATA_OBITO, FAMILIA) VALUES (:nomePessoa, :dataNascimento, :sexoPessoa, :nomeMaePessoa, :rgPessoa, :rgUF, :paisPessoa, :cidadePessoa, :ruaPessoa, :numPessoa, :compPessoa, :bairroPessoa, :cepPessoa, :dddTelPessoa, :telPessoa, :dataCadastro, :emailPessoa, :religiaoPessoa, :pessoaMedControlada, :pessoaBebe, :pessoaFuma, :pessoaTratOutraInst, :pessoaNomeInst, :condicaoPaciente, :idRespPessoa, :rgOrgao, :profissaoPessoa, :ufPessoa ,:prioridade, :nacionalidadePessoa, :idHospital, :dataObito, :nFamilia)";

            $insertPessoa = $pdo->prepare($sqlInsertPessoa);
            $insertPessoa->bindParam(':nomePessoa', $nomePessoa);
            $insertPessoa->bindParam(':dataNascimento', $dataNascimento);
            $insertPessoa->bindParam(':sexoPessoa', $sexoPessoa);
            $insertPessoa->bindParam(':nomeMaePessoa', $nomeMaePessoa);
            $insertPessoa->bindParam(':rgPessoa', $rgPessoa);
            $insertPessoa->bindParam(':rgUF', $rgUF);
            $insertPessoa->bindParam(':paisPessoa', $paisPessoa);
            $insertPessoa->bindParam(':cidadePessoa', $codCidadePessoa);
            $insertPessoa->bindParam(':ruaPessoa', $ruaPessoa);
            $insertPessoa->bindParam(':numPessoa', $numPessoa);
            $insertPessoa->bindParam(':compPessoa', $compPessoa);
            $insertPessoa->bindParam(':bairroPessoa', $bairroPessoa);
            $insertPessoa->bindParam(':cepPessoa', $cepPessoa);
            $insertPessoa->bindParam(':dddTelPessoa', $dddTelPessoa);
            $insertPessoa->bindParam(':telPessoa', $telPessoa);
            $insertPessoa->bindParam(':dataCadastro', $dataHoraCadastro);
            $insertPessoa->bindParam(':emailPessoa', $emailPessoa);
            $insertPessoa->bindParam(':religiaoPessoa', $religiaoPessoa);
            $insertPessoa->bindParam(':pessoaMedControlada', $pessoaMedControlada);
            $insertPessoa->bindParam(':pessoaBebe', $pessoaBebe);
            $insertPessoa->bindParam(':pessoaFuma', $pessoaFuma);
            $insertPessoa->bindParam(':pessoaTratOutraInst', $pessoaTratOutraInst);
            $insertPessoa->bindParam(':pessoaNomeInst', $pessoaNomeInst);
            $insertPessoa->bindParam(':condicaoPaciente', $condicaoPaciente);
            $insertPessoa->bindParam(':idRespPessoa', $idRespPessoa);
            $insertPessoa->bindParam(':rgOrgao', $rgOrgao);
            $insertPessoa->bindParam(':profissaoPessoa', $profissaoPessoa);
            $insertPessoa->bindParam(':ufPessoa', $ufPessoa);
            //$insertPessoa->bindParam(':cadastrador', $cadastrador);
            $insertPessoa->bindParam(':prioridade', $prioridade);
            $insertPessoa->bindParam(':nacionalidadePessoa', $nacionalidadePessoa);
            $insertPessoa->bindParam(':idHospital', $idHospital);
            $insertPessoa->bindParam(':dataObito', $dataObito);
            $insertPessoa->bindParam(':nFamilia', $nFamilia);
            //$resultInsertPessoa = $insertPessoa->execute();
            $insertPessoa->execute();
//            $insertPessoa->debugDumpParams();

        } catch (PDOException $e) {
            // Verifica se devemos debugar
            if (DEBUG === true) {
                echo "Erro: " . $e->getMessage(); // Mostra a mensagem de erro
            } else {
                $retorno = array('codigo' => 1, 'mensagem' => "Erro no insert da pessoa." . $e->getMessage());
                echo json_encode($retorno);
                exit();
            }

        } // Fecha catch

        //if ($resultInsertPessoa) {
        if ($insertPessoa->rowCount() > 0) {
            //echo "PESSOA INSERIDA, VERIFICANDO O NREG<br />";
            // Se insert de pessoa foi OK, coleta NREG
            //$nregPessoa = ''; // Define a varivel para ser usado no try
            try {
                // Pegar o ID do usuario adicionado
                $sqlNregPessoa = 'SELECT gen_id(GERA_NREG_FICHA,0) FROM ficha';
                //$sqlNregPessoa = $pdo->query("select gen_id(GERA_NREG_FICHA,0) from ficha");
                $selectNreg = $pdo->prepare($sqlNregPessoa);
                $selectNreg->execute();
                //$sqlNreg = $selectNreg->execute();
                //$result as $row $nreg =$row[0];
                //global $nregPessoa; // define variavel como global para ser usada fora do try
                foreach ($selectNreg as $row) {
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
                //echo "$codeBarPessoa </br >";

                try {
                    $sqlInsertCodBarras = "UPDATE FICHA SET PRONTUARIO = :codigoBarra  WHERE nreg = :nreg";

                    $insertCodBarras = $pdo->prepare($sqlInsertCodBarras);
                    $insertCodBarras->bindParam(':codigoBarra', $codeBarPessoa);
                    $insertCodBarras->bindParam(':nreg', $nregPessoa);
                    $insertCodBarras->execute();

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

                if ($insertCodBarras->rowCount() > 0) {
                    // Código de barras atualizado. Iniciando inserção do motivo da consulta na tabela FICHA_ATENDIMENTO
                    try {
                        $sqlInsertMotivo = "INSERT INTO FICHA_ATENDIMENTO (DATA_ATENDIMENTO, IDADE, MEDICO, PACIENTE, RESPONSAVEL, MOTIVO_DA_CONSULTA, AGENDA, PRIORIDADE, HOSPITAL, PRONTUARIO) VALUES (:dataHoraCadastro, :idade, :medicoAgenda, :nregPessoa, :idRespPessoa, :motivoConsultaPaciente, :nAgenda, :prioridade, :idHospital, :codeBarPessoa)";
                        $insertMotivoPessoa = $pdo->prepare($sqlInsertMotivo);
                        $insertMotivoPessoa->bindParam(':dataHoraCadastro', $dataHoraCadastro);
                        $insertMotivoPessoa->bindParam(':idade', $idade);
                        $insertMotivoPessoa->bindParam(':medicoAgenda', $medicoAgenda);
                        $insertMotivoPessoa->bindParam(':nregPessoa', $nregPessoa);
                        $insertMotivoPessoa->bindParam(':idRespPessoa', $idRespPessoa);
                        $insertMotivoPessoa->bindParam(':motivoConsultaPaciente', $motivoConsultaPaciente);
                        $insertMotivoPessoa->bindParam(':nAgenda', $nAgenda);
                        $insertMotivoPessoa->bindParam(':prioridade', $prioridade);
                        $insertMotivoPessoa->bindParam(':idHospital', $idHospital);
                        $insertMotivoPessoa->bindParam(':codeBarPessoa', $codeBarPessoa);
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

                    if ($insertMotivoPessoa->rowCount() > 0) {
                        // Se insert do motivo da consulta foi OK, coleta ENCERRA
                        $retorno = array('codigo' => 0, 'mensagem' => "Usuário inserido com sucesso");
                        echo json_encode($retorno);
                        exit();
                    }

                } else { // Não tem atualizacao de codigo de barras
                    $retorno = array('codigo' => 1, 'mensagem' => "Update de codigo de barras apresentou problemas. Não foi cadastrado o código de barras. Por favor, contactar administrador do sistema.");
                    echo json_encode($retorno);
                    exit();
                } // Fim execução de veririficação de updade do codigo de barras

            } else { // Não pegou numero de registro
                $retorno = array('codigo' => 1, 'mensagem' => "Número de registro não validado. Por favor, contactar administrador do sistema.");
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

} else if ($acaoBotao == "Atualizar") { // Passos de ATUALIZACAO da pessoa
    // Gera codigo de erro para JSON
    $retorno = array('codigo' => 1, 'mensagem' => "Ainda não foi configuração a ação de atualizar");
    echo json_encode($retorno);
    exit();

} else { // Erro na identificação da ação

    // Gera codigo de erro para JSON
    $retorno = array('codigo' => 1, 'mensagem' => "Algum erro na identificação da ação");
    echo json_encode($retorno);
    exit();
}

