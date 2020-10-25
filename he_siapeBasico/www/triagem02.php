<!-- ======================================================================== -->
<?php
//// Checa se o arquivo está sendo acessivel direto pela URL
//if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
//    header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
//    die( header( 'location: /error.php' ) );
//}

// Include header
include_once('../conf/variaveis.php');


// Include funcoes gerais
//include_once ('inc/');

// Variaveis utilizadas anteriormente de hora
// Variavel para data
date_default_timezone_set("Brazil/East");
//$dataAtual = date("d/m/Y");
$dataAtual = date("Y-m-d");
$dataAtualHora = date("Y-m-d-G-i");
$horaAtual = date('h:i:s');


?>

<!-- <div class="main"> -->
<main>
  <div class="w3-panel triagem">
    <section>
      <h3><b>TRIAGEM</b></h3>
      <span><sup><small>(Nesta página você poderá cadastrar novos Pacientes e Voluntários)</small></sup></span>
    </section>
  </div>
  <form>
    <div class="w3-panel main">
      <div class="w3-row-padding w3-small">
        <div class="w3-third" id="divSitAtual">
          <label for="tipoPaciente">
            <h6><b>TIPO DE USUÁRIO</b></h6>
          </label>
          <div class="form-group">
            <!-- <div class="row"> -->
            <div class="col-sm-12">
              <select class="w3-select w3-round-large w3-border w3-small" name="tipoUser" id="tipoUserPac" onchange="tipoPaciente2(this.value)">
                <option value="paciente" selected>PACIENTE</option>
                <option value="visitante">VISITANTE</option>
                <option value="acompanhante">ACOMPANHANTE</option>
              </select>
            </div>
            <!-- </div> -->
          </div>
        </div>

        <div class="w3-third" id="divSitAtual">
          <label for="tipoPaciente">
            <h6><b>TIPO DE PACIENTE</b></h6>
          </label>
          <div class="form-group">
            <!-- <div class="row"> -->
            <div class="col-sm-12">
              <select class="w3-select w3-round-large w3-border w3-small" name="tipoPac" id="tipoPacPres">
                <option value="presencial" selected>PRESENCIAL</option>
                <option value="distancia">À DISTÂNCIA</option>
                <option value="desenccarnado">DESENCARNADO</option>
              </select>
            </div>
            <!-- </div> -->
          </div>
        </div>

        <div class="w3-third" id="divSitAtual">
          <label for="tipoPaciente">
            <h6><b>SITUAÇÃO ATUAL</b></h6>
          </label>
          <div class="form-group">
            <!-- <div class="row"> -->
            <div class="col-sm-12">
              <select class="w3-select w3-round-large w3-border w3-small" name="sitAtual" id="sitAtualSemPrioridade">
                <option value="naoInformado" selected>NÃO INFORMADO</option>
                <option value="semPrioridade">SEM PRIORIDADE</option>
                <option value="crianca">CRIANÇA</option>
                <option value="idoso">IDOSO</option>
                <option value="gestante">GESTANTE</option>
                <option value="especiais">CUIADOS ESPECIAIS</option>
              </select>
            </div>
            <!-- </div> -->
          </div>
        </div>
      </div>


      <!-- ======================= Fim Dados Iniciais =================================== -->

      <div class="w3-panel w3-round-large w3-small">
        <label>
          <h6><b> DADOS PESSOAIS</b></h6>
        </label>
        <div class="w3-row-padding w3-small">
          <div class="w3-half w3-col s12 m6">
            <label>Nome</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="" id="iNomePessoa" name="nNomePessoa">
          </div>
          <div class="w3-quarter w3-col s6 m3">
            <label>Sexo</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="nsexoPessoa">
              <option value="M">MASCULINO</option>
              <option value="F">FEMININO</option>
            </select>
          </div>
          <div class="w3-quarter w3-col s6 m3">
            <label>Nascimento</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="date" id="iDataNascPessoa" name="nDataNascPessoa" placeholder="">
          </div>
        </div>
        <div class="w3-row-padding w3-small">
          <div class="w3-quarter w3-col s12 m5">
            <label>Nacionalidade</label>
            <select class="w3-select w3-round-large w3-border w3-small" type="select" name="nPaisPessoa" id="iPaisPessoa">
              <?php
              try {
                $pdo = conectar();
                $buscarReligiao = $pdo->prepare("SELECT  NAC_CODIGO, NAC_DESCRICAO FROM TB_NACIONALIDADE  ORDER BY NAC_DESCRICAO");
                $buscarReligiao->execute();
                $respReligiao = $buscarReligiao->fetchAll(PDO::FETCH_ASSOC);
                foreach ($respReligiao as $item) {
                  echo "<option value='" . $item['NAC_CODIGO'] . "'";
                  if ($item['NAC_DESCRICAO'] === 'BRASIL') {
                    echo "selected";
                  }
                  echo ">" . $item['NAC_DESCRICAO'] . "</option>";
                }
              } catch (PDOException $e) {
                echo "<option value='ERRO-PAIS'>ERRO AO CONECTAR DB</option>";
              }
              ?>
            </select>
          </div>

          <div class="w3-third w3-col s6 m3">
            <label>RG</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="">
          </div>
          <div class="w3-third w3-col s3 m2">
            <label>Expedidor</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="nRGOrgao" id="iRGOrgao" placeholder="">
              <option value="SDS">SDS</option>
              <option value="SSP">SSP</option>
              <option value="MB">MB</option>
              <option value="EB">EB</option>
              <option value="AE">AE</option>
              <option value="PF">PF</option>
            </select>
          </div>
          <div class="w3-third w3-col s3 m2">
            <label>UF</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="">
          </div>
        </div>
        <div class="w3-row-padding w3-small">
          <div class="w3-half">
            <label>Profissão</label>
            <input class="w3-input w3-round-large w3-border w3-small" name="profissao" type="text" id="profissao">
          </div>
          <div class="w3-half">
            <label>religião</label>
            <!-- <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder=""> -->
            <select class="w3-select w3-round-large w3-border w3-small" id="iReligiaoPessoa" name="nReligiaoPessoa">
              <?php
              $pdo = conectar();
              $buscarReligiao = $pdo->prepare("SELECT NREG,DESCRICAO FROM TIPO_RELIGIAO  ORDER BY descricao");
              $buscarReligiao->execute();
              $respReligiao = $buscarReligiao->fetchAll(PDO::FETCH_ASSOC);
              echo "<option value='NAO INFORMADO' selected>NÃO INFORMADO</option>";
              foreach ($respReligiao as $item) {
                echo "<option value='" . $item['NREG'] . "'>" . $item['DESCRICAO'] . "</option>";
              }
              ?>
            </select>
          </div>
        </div>
        <div class="w3-row-padding w3-small">
          <div class="w3-half w3-col s12 m6">
            <label>Nome da Mãe</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="">
          </div>
          <div class="obito" id="obito">
            <div class="w3-quarter w3-row-padding w3-small w3-col s6 m3">
              <label for="uname">Óbito</label>
              <input class="w3-input w3-round-large w3-border w3-small" type="date" id="dataObito" name="dataObito">
            </div>
            <div class="w3-quarter w3-row-padding w3-small w3-col s6 m3">
              <label>Desencarne</label>
              <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="Somente leitura" readonly>
            </div>
          </div>
        </div><br>
      </div>

      <!-- =============================================================================== -->

      <div class="w3-panel w3-round-large w3-small">
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <label>
          <h6><b> DADOS DE ENDEREÇO</b></h6>
        </label>
        <div class="w3-row-padding w3-small">
          <div class="w3-half w3-col s4 m2 mb-2">
            <label>CEP</label>
            <input class="w3-input w3-round-large w3-border w3-small" name="nCepPessoa" type="text" id="iCepPessoa" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);">
          </div>
          <div class="w3-half w3-col s8 m3">
            <label>País</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="nPaisPessoa" id="iPaisPessoa">
              <?php
              try {
                $pdo = conectar();
                $buscarReligiao = $pdo->prepare("SELECT  NAC_CODIGO, NAC_DESCRICAO FROM TB_NACIONALIDADE  ORDER BY NAC_DESCRICAO");
                $buscarReligiao->execute();
                $respReligiao = $buscarReligiao->fetchAll(PDO::FETCH_ASSOC);
                foreach ($respReligiao as $item) {
                  echo "<option value='" . $item['NAC_CODIGO'] . "'";
                  if ($item['NAC_DESCRICAO'] === 'BRASIL') {
                    echo "selected";
                  }
                  echo ">" . $item['NAC_DESCRICAO'] . "</option>";
                }
              } catch (PDOException $e) {
                echo "<option value='ERRO-PAIS'>ERRO AO CONECTAR DB</option>";
              }
              ?>
            </select>
          </div>
          <div class="w3-third w3-col s10 m4 mb-2 uppercase">
            <label>Logradouro</label>
            <input class="w3-input w3-round-large w3-border w3-small uppercase" name="rua" type="text" placeholder="Rua, Av. " id="iRuaPessoa" size="60">
          </div>
          <div class="w3-third w3-col s2 m1 mb-2">
            <label>Nº</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="" name="nNumPessoa" id="iNumPessoa">
          </div>
          <div class="w3-third w3-col s6 m2 mb-2">
            <label>Complemento</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="Casa, Aptº nº" id="iCompPessoa" name="nCompPessoa">
          </div>
          <div class="w3-third w3-col s6 m5 mb-2">
            <label>Bairro</label>
            <input class="w3-input w3-round-large w3-border w3-small" name="nBairroPessoa" type="text" id="iBairroPessoa" size="40">
          </div>
          <div class="w3-third w3-col s10 m5 mb-2">
            <label>Cidade</label>
            <input class="w3-input w3-round-large w3-border w3-small" name="nCidadePessoa" type="text" id="iCidadePessoa" size="40">
          </div>
          <div class="w3-quarter w3-col s2 m2 mb-2">
            <label>Estado</label>
            <input class="w3-input w3-round-large w3-border w3-small" name="nUFPessoa" type="text" id="iUFPessoa" size="2">
          </div>
        </div>
      </div>

      <!--   =================================================================================  -->
      <div class="w3-panel w3-round-large w3-small">
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <label>
          <h6><b> DADOS DE CONTATO</b></h6>
        </label>
        <div class="w3-row-padding w3-small">
          <div class="w3-col s12 m6 mb-2">
            <label>Email</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="email" placeholder="" id="iEmailPessoa" name="nEmailPessoa">
          </div>
          <div class="w3-half w3-col s6 m3 mb-2">
            <label>Telefone</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="" id="iTelPessoa" name="nTelPessoa">
          </div>
          <div class="w3-half w3-col s6 m3 mb-2">
            <label>Celular</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="" id="iTelPessoa" name="nTelPessoa">
          </div>
        </div>
      </div>

      <!--   =================================================================================  -->
      <div class="w3-panel w3-round-large w3-small">
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <label>
          <h6><B> DADOS DE SAÚDE</B></h6>
        </label>
        <div class="w3-row-padding w3-small">
          <div class="w3-third w3-col s12 m4">
            <label>USA MEDICAÇÃO CONTROLADA?</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="option">
              <option value="medControlSim">SIM</option>
              <option value="medControlNao" selected>NÃO</option>
            </select>
          </div>
          <div class="w3-third w3-col s6 m4">
            <label>FUMA?</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="option">
              <option value="fumaSim">SIM</option>
              <option value="fumaNao" selected>NÃO</option>
            </select>
          </div>
          <div class="w3-third w3-col s6 m4">
            <label>BEBE?</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="option">
              <option value="bebeSim">SIM</option>
              <option value="bebeNao" selected>NÃO</option>
            </select>
          </div>
          <div class="w3-col s12 m5">
            <label>FAZ TRATAMENTO EM OUTRA CASA ESPIRITA?</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="option">
              <option value="outraCasaSim">SIM</option>
              <option value="outraCasaNao" selected>NÃO</option>
            </select>
          </div>
          <div class="w3-col s12 m7 mt-4">
            <input type="text" class="w3-input w3-round-large w3-border w3-small" placeholder="Qual?">
          </div>
        </div>
      </div>
      <!--   =================================================================================  -->

      <!--   =================================================================================  -->
      <div class="w3-panel w3-round-large w3-small">
        <hr style="height:2px;border-width:0;color:gray;background-color:gray">
        <label>
          <h6><B> DADOS DO RESPONSÁVEL</B></h6>
        </label>
        <div class="w3-row-padding w3-small">
          <div class="w3-half">
            <label>Nome</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="">
          </div>
          <div class="w3-quarter w3-col s6 m3">
            <label>Sexo</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="option">
              <option value="1">MASCULINO</option>
              <option value="2">FEMININO</option>
            </select>
          </div>
          <div class="w3-quarter w3-col s6 m3">
            <label>Nascimento</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="date" placeholder="">
          </div>
        </div>
        <div class="w3-row-padding w3-small">
          <div class="w3-third w3-col s6 m3">
            <label>RG</label>
            <input class="w3-input w3-round-large w3-border w3-small" type="text" placeholder="">
          </div>
          <div class="w3-third w3-col s6 m3">
            <label>Expedidor</label>
            <select class="w3-select w3-round-large w3-border w3-small" name="nRGOrgao" id="iRGOrgao" placeholder="">
              <option value="SDS">SDS</option>
              <option value="SSP">SSP</option>
              <option value="MB">MB</option>
              <option value="EB">EB</option>
              <option value="AE">AE</option>
              <option value="PF">PF</option>
            </select>
          </div>
        </div>
      </div>

      <!--   =================================================================================  -->
      <!-- INÍCIO DO CAMPO MOTIVO DA CONSULTA -->
      <div class="w3-col s12" id="consulta">
        <div class="w3-panel w3-round-large w3-small">
          <hr style="height:2px;border-width:0;color:gray;background-color:gray">
          <label>
            <h6><b> MOTIVO DA CONSULTA</b></h6>
          </label>
          <div class="w3-panel w3-round-large w3-small mt-0">
            <label for="motivo"></label>
            <textarea class="form-control textarea" rows="5" name="nmotivoConsultaPaciente" type="text" id="imotivoConsultaPaciente" name="text"></textarea>
          </div>
        </div>
      </div>
      <!-- FIM DO CAMPO MOTIVO DA CONSULTA -->
      <!-- ================================================================================= -->

      <div class="w3-bar mb-3">
        <button class="w3-button w3-round-large w3-left w3-green" type="button" value="InserirPessoa" id="btInserirPessoa" onclick="salvarPessoa(this.value)">Cadastrar
        </button>
        <button class="w3-button w3-round-large w3-right w3-red" type="reset" value="Limpar" id="btLimpar" onclick="history.go(0)">Cancelar
        </button>
      </div>

    </div>
    </div>
  </form>
</main>
</div>
</div>