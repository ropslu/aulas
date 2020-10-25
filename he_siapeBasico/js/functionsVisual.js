
function formatar(mascara, documento){
var i = documento.value.length;
var saida = mascara.substring(0,1);
var texto = mascara.substring(i);

if (texto.substring(0,1) != saida){
  documento.value += texto.substring(0,1);
}

}


//========= FIM DO FORMULARIO ==============================================================

// INÍCIO DAS FUNÇÕES RESPONSÁVEIS PELA COMUTAÇÃO DOS RADIOS BUTTONS 
// NO INÍCIO DO SISTEMA

function tipoPaciente (tipoPaciente){
  // alert (tipoPaciente);
  if (tipoPaciente == 'tipoPacDes'){
    document.getElementById('obito').style.display = 'block';    
    document.getElementById('sitAtualIdoso').checked = false;
    document.getElementById('sitAtualGestante').checked = false;
    document.getElementById('sitAtualCrianca').checked = false;
    document.getElementById('sitAtualCEspec').checked = false;   
    document.getElementById('divSitAtual').style.display = 'none';
    document.getElementById('responsavel').style.display = 'block';
  }

  if (tipoPaciente == 'tipoPacPres'){
    document.getElementById('obito').style.display = 'none';
    document.getElementById('divSitAtual').style.display = 'block';
    document.getElementById('responsavel').style.display = 'none';
  }

  if (tipoPaciente == 'tipoPacDist'){
    document.getElementById('obito').style.display = 'none';
    document.getElementById('divSitAtual').style.display = 'block';
    document.getElementById('responsavel').style.display = 'block';
  }
}

function sitPaciente (sitPaciente){
  document.getElementById('tipoPacDes').checked = false;
  if (sitPaciente == 'sitAtualCrianca' || sitPaciente == 'sitAtualCEspec'){

    document.getElementById('responsavel').style.display = 'block';
        
  } else {
    document.getElementById('responsavel').style.display = 'none';
  }
}


function tipoUsuario (tipoUsuario){
  document.getElementById('tipoPacDes').checked = false;
  if (tipoUsuario == 'tipoUserVis' || tipoUsuario == 'tipoUserAco'){

    document.getElementById('tipoPacPres').checked = true;
    document.getElementById('tpPaciente').style.display = 'none';
    document.getElementById('divSitAtual').style.display = 'none'; 
    document.getElementById('obito').style.display = 'none';
    document.getElementById('responsavel').style.display = 'none';
    document.getElementById('saude').style.display = 'none';
    document.getElementById('consulta').style.display = 'none';
    document.getElementById('sitAtualIdoso').checked = false;
    document.getElementById('sitAtualGestante').checked = false;
    document.getElementById('sitAtualCrianca').checked = false;
    document.getElementById('sitAtualCEspec').checked = false;    
  } else {
    document.getElementById('tpPaciente').style.display = 'block';
    document.getElementById('divSitAtual').style.display = 'block';
    document.getElementById('saude').style.display = 'block';
    document.getElementById('consulta').style.display = 'block';
    document.getElementById('tipoPacPres').checked = false;
    document.getElementById('obito').style.display = 'none'; 
  }
  if (tipoUsuario == 'tipoUserPac'){
    document.getElementById('sitAtualIdoso').checked = false;
    document.getElementById('sitAtualGestante').checked = false;
    document.getElementById('sitAtualCrianca').checked = false;
    document.getElementById('sitAtualCEspec').checked = false;
    document.getElementById('tipoPacDist').checked = false;
  }
}

/*
  Tela: Triagem
  Funcao: Controlar informações de Tipo de usuário - Paciente -  situação do paciente
 */

function tipoPaciente2 (tipoPaciente){
    // console.log(tipoPaciente);
    if (tipoPaciente === "visitante" || tipoPaciente === "acompanhante" ){
        $('#tipoPacPres').val('presencial');
        $('#sitAtualSemPrioridade').val('naoInformado').attr('disabled', true);
        $('#tipoPacPres').val('presencial').attr('disabled',true);
    } else {
        $('#sitAtualSemPrioridade').val('naoInformado').attr('disabled', false);
        $('#tipoPacPres').val('presencial').attr('disabled',false);
    }


    //
    //
    // document.getElementById('obito').style.display = 'block';
    // document.getElementById('sitAtualIdoso').checked = false;
    // document.getElementById('sitAtualGestante').checked = false;
    // document.getElementById('sitAtualCrianca').checked = false;
    // document.getElementById('sitAtualCEspec').checked = false;
    // document.getElementById('divSitAtual').style.display = 'none';
    // document.getElementById('responsavel').style.display = 'block';


}

function f2() {
    
}

function habilitaEndereco() {
    
}

// FIM DAS FUNÇÕES RESPONSÁVEIS PELA COMUTAÇÃO DOS RADIOS BUTTONS 
// NO INÍCIO DO SISTEMA

/*
  Tela: Triagem
  Funcao: Mostrar input de CEP para país = Brasil
 */
function enderecoPessoa(pais) {
  pais = pais.trim();
  if (pais === '010') {
    $("#idivCepPessoa").show();
  } else {
    $("#idivCepPessoa").hide();
  }
}