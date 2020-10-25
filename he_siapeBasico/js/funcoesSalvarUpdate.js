function salvarPessoa(bt){
    let data = $("#formCadPessoa").serializeArray();
    let urlPessoaSalvar = back+"/pessoaSalvar.php";
    let acao = "";
    //console.log(bt);
    if (bt === "InserirPessoa" ) {
        acao = "Inserir";
        //console.log(acao);
    } else if (bt === "AtualizarPessoa") {
        acao = "Atualizar"
        //console.log(acao);
    } else {
        acao = "ERRO"
        //console.log(acao);
    }

    // Adicionando a acao no serialize
    data.push({name: 'acao', value: acao});


    $.ajax({

        type: "POST",
        url: urlPessoaSalvar,
        dataType: 'json',
        data: data,
        success :  function(response){
            if(response.codigo === 0){
                //var qtdSemPresenca = response.countSemPresenca;
                //var semPresencaId = response.semPresencaId;

                // Reseta as informações do form
                //$("#cadAlunoForm")[0].reset();
                // Sobe a tela
                $('html,body').scrollTop(0);
                // Mostra mensagem de alerta
                $("#divMensagemNOK").hide();
                $("#divMensagemOK").show();
                $("#mensagemOK").html('<strong>Sucesso! </strong>'+ response.mensagem);
                //$("#isectionCadHosp").hide();
                //setTimeout(function(){ $("#divMensagemOK").hide();}, 5000);
                setTimeout(function(){ $("#divMensagemOK").hide(); location.reload();}, 5000);
                //setTimeout(function(){ location.reload(); }, 6000);

            }
            else{
                $("#divMensagemOK").hide();
                $("#divMensagemNOK").show();
                $("#mensagemNOK").html('<strong>Erro! </strong>'+ response.mensagem);
                $('html,body').scrollTop(0);
                setTimeout(function(){ $("#divMensagemNOK").hide(); }, 6000);
            }
        }
    });
}

function salvarAgenda(bt){
    let data = $("#formCadAgenda").serializeArray();
    let urlAgendaSalvar = back+"/agendaSalvar.php";
    let acao ="";

    if (bt === "Inserir" ) {
        let acao = "Inserir";
    } else if (bt === "Atualizar") {
        let acao = "Atualizar"
    } else {
        let acao = "ERRO"
    }

    // Adicionando a acao no serialize
    data.push({name: 'acao', value: acao});


    $.ajax({

        type: "POST",
        url: urlAgendaSalvar,
        dataType: 'json',
        data: data,
        success :  function(response){
            if(response.codigo === "0"){
                //var qtdSemPresenca = response.countSemPresenca;
                //var semPresencaId = response.semPresencaId;

                // Reseta as informações do form
                //$("#cadAlunoForm")[0].reset();
                // Sobe a tela
                //$('html,body').scrollTop(0);
                // Mostra mensagem de alerta
                $("#divMensagemNOK").hide();
                $("#divMensagemOK").show();
                $("#mensagemOK").html('<strong>Sucesso! </strong>'+ response.mensagem+ '. A  paginá fará reaload automático');
                //$("#isectionCadHosp").hide();
                //setTimeout(function(){ $("#divMensagemOK").hide(); location.reload();}, 5000);
                //setTimeout(function(){ location.reload(); }, 6000);

            }
            else{
                $("#divMensagemOK").hide();
                $("#divMensagemNOK").show();
                $("#mensagemNOK").html('<strong>Erro! </strong>'+ response.mensagem);
                //$('html,body').scrollTop(0);
                //setTimeout(function(){ $("#divMensagemNOK").hide(); }, 6000);
            }
        }
    });
}