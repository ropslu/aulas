// Validar a condição do paciente para mostrar campo de data de óbito
function validaCondicao(valor) {
    if (valor == "0"){
        $("#divMensagemOK").hide();
        $("#divMensagemNOK").show();
        $("#mensagemNOK").html('<strong>Erro! </strong> A condição do paciente precisa ser escolhida.');
        setTimeout(function(){ $('#divMensagemNOK').hide(); }, 1000*8);
    } else if (valor == "1"){
        $("#divDataObito").hide();
    } else if (valor == "2") {
        $("#divDataObito").show();
    } else {
        $("#divMensagemOK").hide();
        $("#divMensagemNOK").show();
        $("#mensagemNOK").html('<strong>Erro! </strong> Aldo deu errado. Não consegui identificar a escolha da condição do paciente.');
        setTimeout(function(){ $('#divMensagemNOK').hide(); }, 1000*8);
    }
}

// Checagem se paciente é de menor para mostrar campo de responsável
//var de_menor = null; // Cria variavel para checagem do responsavel pelo botão Salvar
function checaAniversario(valor) {
    let dateString = valor;
    let myDate = new Date(dateString);
    let date = new Date();

    date.setMonth(date.getMonth() - 216);
    if (myDate > date ) {
        console.log("DE MENOR");
        $("#divResponsavel").show();
        //de_menor = '1';
    } else {
        console.log("DE MAIOR");
        $("#divResponsavel").hide();
        //de_menor = '0';
    }
    //document.getElementById("resp").disabled = true;
    //document.getElementById("resp").style.display = 'none'
}


function mostraOutraInstituicao() {
    // Get the checkbox
    let checkBox = document.getElementById("iPacienteTratamentoOutroLugar");
    // Get the output text
    let text = document.getElementById("iPacienteNomeInstituicao");

    // If the checkbox is checked, display the output text
    if (checkBox.checked === true){
        $("#iPacienteNomeInstituicao").show();
        //text.style.display = "block";
    } else {
        $("#iPacienteNomeInstituicao").hide();
        //text.style.display = "none";
    }
}
