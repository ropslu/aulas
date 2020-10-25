/**
 * Created by damcl on 28/05/2018.
 */
// JavaScript Document
//adiciona mascara de cnpj
function MascaraCNPJ(cnpj){
    if(mascaraInteiro(cnpj)==false){
        event.returnValue = false;
    }
    return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara de cep
function MascaraCep(cep){
    if(mascaraInteiro(cep)==false){
        event.returnValue = false;
    }
    return formataCampo(cep, '00.000-000', event);
}

//adiciona mascara de data
function MascaraData(data){
    if(mascaraInteiro(data) == false){
        event.returnValue = false;
    }
    return formataCampo(data, '00/00/0000', event);
}

//adiciona mascara ao telefone
function MascaraTelefone(tel){
    if(mascaraInteiro(tel) == false){
        event.returnValue = false;
    }
    checkFone01(tel);
    //return formataCampo(tel, '(00) 00000-0000', event);
}

//adiciona mascara ao CPF
function MascaraCPF(cpf){
    if(mascaraInteiro(cpf) == false){
        event.returnValue = false;
    }
        //return true;
    return formataCampo(cpf, '000.000.000-00', event);
}

//adiciona mascara ao RG
function MascaraRG(rg){
    if((rg) == false){
        event.returnValue = false;
    }
    return formataCampo(rg, '00.000.000-0', event);
}

//valida telefone
function ValidaTelefone(tel){
    var tel = tel.value;
    if (tel != "") {
    exp = /\(\d{2}\)\ \d{5}\-\d{4}/
    if(!exp.test(tel.value))
        alert('Numero de Telefone Invalido!');
    }
    checkFone01();
}

/*
//valida CEP
function ValidaCep(cep){
    exp = /\d{2}\.\d{3}\-\d{3}/
    if(!exp.test(cep.value))
        alert('Numero de Cep Invalido!');
}
*/

//valida data
function ValidaData(data){
    exp = /\d{2}\/?\d{2}\/?\d{4}/
    if(!exp.test(data.value)){
        //alert('Data Invalida!');
        //console.log ("ValidaData - INVALIDA"+data.value);
        return false;
    } else {
        //console.log ("ValidaData - VALIDA"+data.value);
        return true
    }
}

//valida o CPF digitado
/*
function ValidarCPF(Objcpf){
    var cpf = Objcpf.value;
    exp = /\.|\-/g
    cpf = cpf.toString().replace( exp, "" );
    var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
    var soma1=0, soma2=0;
    var vlr =11;

    for(i=0;i<9;i++){
        soma1+=eval(cpf.charAt(i)*(vlr-1));
        soma2+=eval(cpf.charAt(i)*vlr);
        vlr--;
    }
    soma1 = (((soma1*10)%11)==10 ? 0:((soma1*10)%11));
    soma2=(((soma2+(2*soma1))*10)%11);

    var digitoGerado=(soma1*10)+soma2;
    if(digitoGerado!=digitoDigitado)
        alert('CPF Invalido!');
}
*/

//valida numero inteiro com mascara
function mascaraInteiro(){
    if (event.keyCode < 48 || event.keyCode > 57){
        event.returnValue = false;
        return false;
    }
    return true;
}

//valida o CNPJ digitado
/*function ValidarCNPJ(ObjCnpj){
    var cnpj = ObjCnpj.value;
    var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
    var dig1= new Number;
    var dig2= new Number;

    exp = /\.|\-|\//g
    cnpj = cnpj.toString().replace( exp, "" );
    var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

    for(i = 0; i<valida.length; i++){
        dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);
        dig2 += cnpj.charAt(i)*valida[i];
    }
    dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
    dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

    if(((dig1*10)+dig2) != digito)
        alert('CNPJ Invalido!');

}
*/

//formata de forma generica os campos
function formataCampo(campo, Mascara, evento) {
    var boleanoMascara;

    var Digitato = evento.keyCode;
    exp = /\-|\.|\/|\(|\)| /g
    campoSoNumeros = campo.value.toString().replace( exp, "" );

    var posicaoCampo = 0;
    var NovoValorCampo="";
    var TamanhoMascara = campoSoNumeros.length;;

    if (Digitato != 8) { // backspace
        for(i=0; i<= TamanhoMascara; i++) {
            boleanoMascara  = ((Mascara.charAt(i) == "-") || (Mascara.charAt(i) == ".")
            || (Mascara.charAt(i) == "/"))
            boleanoMascara  = boleanoMascara || ((Mascara.charAt(i) == "(")
                || (Mascara.charAt(i) == ")") || (Mascara.charAt(i) == " "))
            if (boleanoMascara) {
                NovoValorCampo += Mascara.charAt(i);
                TamanhoMascara++;
            }else {
                NovoValorCampo += campoSoNumeros.charAt(posicaoCampo);
                posicaoCampo++;
            }
        }
        campo.value = NovoValorCampo;
        return true;
    }else {
        return true;
    }
}


function mascaraNome(){
    //32 - Epace bar
    // 65 - 90 - LETRAS MAISCULAS
    // 97 - 122 - LETRAS MINUSCULAS

    // 192 - 221 - ACENTUACAO MAISCULAS E Ç
    // 224 - 253 - ACENTUACAO MINUSCULA e ç

    // 177 - DELETE
    // 8 - BACK SPACE

    if (event.keyCode == 8 || event.keyCode == 177 || event.keyCode == 32 || (event.keyCode >= 65 && event.keyCode <= 90 ) || (event.keyCode >= 97 && event.keyCode <= 122) || (event.keyCode >= 192 && event.keyCode <= 221) || (event.keyCode >= 224 && event.keyCode <= 253) ){
        event.returnValue = true;
        return true;
    }
    event.returnValue = false;
    return false;
    
}

function mascaraLogin(){
    // Serao negados os seguintes caracters
    // 39 - 145 - 146 - '
    // 34 - "
    // 123 - 125 {}
    // 40 - 41 - ()
    // 58 - 63 - : ; < = > ?
    // 96 - `
    // 91 e 93 []
    //180 -´

    //https://www.ascii-code.com/

    if (event.keyCode == 39 || event.keyCode == 145 || event.keyCode == 146 || event.keyCode == 34 || (event.keyCode >= 123 && event.keyCode <= 125 ) || (event.keyCode >= 40 && event.keyCode <= 41) || (event.keyCode >= 58 && event.keyCode <= 63) || event.keyCode == 96 || event.keyCode == 91 || event.keyCode == 93 ||  event.keyCode == 180 ){
        event.returnValue = false;
        return false;
        
    }
    event.returnValue = true;
    return true;
    
}


// Valida Nome
function validaNome(data,idDiv,idMsn){
    var letras = /[^A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ\s]/;
    if(data.value.match(letras)){
        if (arguments.length > 1) { 
            //$('#'+data.id).focus();
            window.scrollBy(0,-200);
            $('#'+idDiv.id).show();
            $('#'+idMsn.id).html('Informar nome completo. Não pode haver números.');
            setTimeout(function(){ $('#'+idDiv.id).hide(); }, 1000*8);
        }
        return false;
    } else {
        return true
    }
}

// Valida CPF
function validaCPF(data,idDiv,idMsn){
    if (data.value != '') {
        var numbers = /[^0-9.-]/;
        if(data.value.match(numbers)){ 
            if (arguments.length > 1) { 
                //$('#'+data.id).focus();
                window.scrollBy(0,-200);
                $('#'+idDiv.id).show();
                $('#'+idMsn.id).html('O CPF deve conter apenas números.');
                setTimeout(function(){ $('#'+idDiv.id).hide(); }, 1000*8);
            }
            return false;
        } else {
            MascaraCPF(data);
            //console.log ("TUDO OK COM O numero - "+data.value);
            return true
        }
    }
}

//valida data
function validaData2(data,idDiv,idMsn){
    if (data.value != '') {
        var numbers = /[^0-9\/]/;
        var exp = /^(0[1-9]|1[0-9]|2[0-9]|3[0-1])\/?(0[1-9]|1[0-2])\/?(19[3-9]\d{1}|20[0-3]\d{1})$/
        if(data.value.match(numbers)){
            if (arguments.length > 1) {
                //$('#'+data.id).focus();    
                $('#'+idDiv.id).show();
                $('#'+idMsn.id).html('A data deve conter apenas números.');
                window.scrollBy(0,-200);
                setTimeout(function(){ $('#'+idDiv.id).hide(); }, 1000*5);
                
            }
            return false;
        } else {
            if(!exp.test(data.value)){
                if (arguments.length > 1) {
                    //$('#'+data.id).focus();
                    window.scrollBy(0,-200);
                    $('#'+idDiv.id).show();
                    $('#'+idMsn.id).html('Informe a data de Nascimento no formato DD/MM/AAAA.');
                    setTimeout(function(){ $('#'+idDiv.id).hide(); }, 8000);
                }
                return false;
            } else {
                MascaraData(data);
                return true
            }
        } 
    }
}