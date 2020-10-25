<?php

// remove todos os espaços antes e depois dos campos e tb espaços duplos. Está praticamente em todos as checagens - Descontinuado
function removeEspacos($valor){
    $valor = trim(preg_replace('/\s+/', ' ', $valor));
    return $valor;
}

// substitui os nomes pequenos para tudo minusculo
function trocaNome($valor){
    $searchValue = array("De ", "Do ", "Dos ", "Da ", "Das ");
    $replaceVaue = array("de ", "do ", "dos ", "da ", "das ");
    $result = str_replace($searchValue, $replaceVaue, $valor );
    return $result;
}

// Limpa valor, remove ". , - /" e espaços - Esse foi substituido pelos demais
function limpaValor($valor){
    $valor = trim($valor);
    $valor = preg_replace('/\s+/', ' ', $valor);
    $valor = str_replace(".", "", $valor);
    $valor = str_replace(",", "", $valor);
    $valor = str_replace("-", "", $valor);
    $valor = str_replace("/", "", $valor);
    return $valor;
}

// Organiza a data para o formato da data do banco dd/mm/aaaa
function organizaData($valor){
    $valor = trim($valor);
    $valor = str_replace("-", "/", $valor);
    //$orgDate = "17-07-2012";
    $newDate = date("d.m.Y", strtotime($valor));
    //echo "New date format is: ".$newDate. " (DD/MM/AAAA)";
    return $newDate;
}

// Remove CARACTERES ESPECIAIS
function RemoveCaracteresEspeciais($valor){
    $newValor = preg_replace("/[\'\"!@#$%¨&*\(\)\-_+=\[\{\]\}\/?:;>\.<,|\\\^\~\`\´]/", "", $valor);
    $newValor = trim(preg_replace('/\s+/', ' ', $newValor));
    return $newValor;
}

// Remove todos os caracteres que NÃO SAO LETRAS
function apenasLetras($valor){
    $newValor = preg_replace("/[^A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s]/", "", $valor);
    $newValor = trim(preg_replace('/\s+/', ' ', $newValor));
    return $newValor;
}

// Remove todos os caracteres que NÃO SAO NUMEROS
function apenasNumero($valor){
    $newValor = preg_replace("/[^0-9]/", "", $valor);
    $newValor = trim(preg_replace('/\s+/', ' ', $newValor));
    return $newValor;
}

// Valida data Nascimento - Permitindo apenas do ano 1900 até 2029
function validaDataNascimento($valor){
    $valor = trim(preg_replace('/\s+/', ' ', $valor));
    if (preg_match("/^(0[1-9]|1[0-9]|2[0-9]|3[0-1])[\.\-\/]?(0[1-9]|1[0-2])[\.\-\/]?(19[0-9]\d{1}|20[0-2]\d{1})$/", $valor)){
        $valor = organizaData($valor);
        return $valor;
    } else {
        return false;
    }
}

// Valida a Data
function validaData($valor){
    if (preg_match("/^(0[1-9]|1[0-9]|2[0-9]|3[0-1])[\.\-\/]?(0[1-9]|1[0-2])[\.\-\/]?(\d{4})$/", $valor)){
        $valor = organizaData($valor);
        return $valor;
    } else {
        return false;
        //exit();
    }
}

//valida CEP
function validaCep($cep){
    if (preg_match("/^(\d{2}\.?\d{3}\-?\d{3})$/", $cep)){
        return true;
    } else {
        return false;
    }
}

// "/^[A-Z0-9._%+-]+@(?:[A-Z0-9-]+\.)+[A-Z]{2,}$/"
// ^[\w.\-+]{2,40}+@(?:[\w-]+\.)

// Remove todos os caracteres que NÃO SAO LETRAS
function removeCaracteresEmail($valor){
    $newValor = preg_replace("/(-{2,})|\'|\"|#|!|#|$|%|¨|\||\*|\(|\)|\[|\{|\]|\}|\/|\?|:|;|>|<|\,|\^|\~|\`|\´|/", "", $valor);
    $newValor = trim(preg_replace('/\s+/', ' ', $newValor));
    return $newValor;
}


//
function validaCampoTamanhoPost ($campo,$tamanho){
    $isValid = false;
    if ($tamanho == '0') {
        if ($campo !== null) {
            $isValid = true;
        }
    } else {
        if ($campo !== null && (strlen($campo) >= $tamanho)) {
            $isValid = true;
        }
    }
    return $isValid;
}

// Funcao para validação do campo de Sexo
function validaSexo ($valor) {
    $valor = trim(preg_replace('/\s+/', ' ', $valor));
    if (preg_match("/^[M|F|m|f]$/", $valor)){
        return $valor;
    } else {
        return false;
    }
}


function idade ($data){
    //$dataNascimento = '1983-12-20';
    $data = str_replace("/", "-", $data);
    $date = new DateTime($data);
    $interval = $date->diff( new DateTime( date('d.m.Y') ) );
    //echo $interval->format( '%Y anos' );
    return $interval->format( '%Y' );

}
