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
<!-- ========================================================================================== -->

<div class="container">

    <!-- ESTUDAR -->
    <!-- <div class="container w3-panel" id="divMensagens" style="display: block">
        <div id="divMensagemOK" class="alert alert-info w3-round-large w3-border w3-border-green"
             style="display: block">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span id="mensagemOK" style="font-size:15px;text-indent:5px; text-align:justify;"></span>
        </div>
        <div id="divMensagemNOK" class="alert alert-danger w3-round-large w3-border w3-border-green"
             style="display: block">
            <span class="glyphicon glyphicon-exclamation-sign"></span>
            <span id="mensagemNOK" style="font-size:15px;text-indent:5px; text-align:justify;"></span>
        </div>
    </div> -->
    <!-- ATÉ AQUI -->
    <form id="formCadPessoa" method="POST" enctype="multipart/form-data">
        <div class="w3-panel w3-round-large w3-light-grey">
            <h2 class="w3-text">TRIAGEM</h2>
            <span><small>(Nesta seção preencha todos os campos para efetivar o Cadastro no SIAP)</small></span>
        </div>
        <!-- ============================================================================= -->

        <!-- Início do primeiro bloco... -->
        <div class="w3-panel w3-round-large w3-light-grey">
            <div class="w3-panel w3-round-large w3-small">
                <header>
                    <h6><b> DADOS INICIAIS</b></h6><br>
                </header>
                <!-- Removi estes comandos para retirá-los do card
                <div class="row">  
                    <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card w3-light-grey border-success">
                            <div class="card-body">
                                <div class="card-title">Tipo de Usuário</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3"> -->
                <div class="w3-third ">
                    <label for="tipoUsuario">
                        <h6>Tipo de Usuário</h6>
                    </label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoUser" id="tipoUserPac" value="paciente" onclick="tipoUsuario(this.id)" checked>
                                    <label class="form-check-label" for="tipoUserPac">
                                        Paciente
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoUser" id="tipoUserVis" value="visitante" onclick="tipoUsuario(this.id)">
                                    <label class="form-check-label" for="tipoUserVis">
                                        Visitante
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoUser" id="tipoUserAco" value="acompanhante" onclick="tipoUsuario(this.id)">
                                    <label class="form-check-label" for="tipoUserAco">
                                        Acompanhante
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- </div>
                    </div> -->

                <!-- Removi estes comandos para retirá-los do card
                    <div class="col-sm-6 col-md-3 mb-3">
                        <div class="card w3-light-grey border-success">
                            <div class="card-body">
                                <div class="card-title">Tipo de Paciente</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3"> -->
                <div class="w3-third">
                    <label for="tipoPaciente">
                        <h6>Tipo de Paciente</h6>
                    </label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipoPac" id="tipoPacPres" value="presencial" onclick="tipoPaciente(this.id)">
                                    <label class="form-check-label" for="tipoPacPres">
                                        Presencial
                                    </label>
                                </div>
                                <div id="tpPaciente">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipoPac" id="tipoPacDist" value="distancia" onclick="tipoPaciente(this.id)">
                                        <label class="form-check-label" for="tipoPacDist">À Distância
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipoPac" id="tipoPacDes" value="desenccarnado" onclick="tipoPaciente(this.id)">
                                        <label class="form-check-label" for="tipoPacDes">
                                            Desencarnado
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--</div>
                    </div> -->

                <!-- Removi estes comandos para retirá-los do card
                    <div class="col-sm-12 col-md-6 mb-3" id="divSitAtual">
                        <div class="card w3-light-grey border-success">
                            <div class="card-body">
                                <div class="card-title">Situação Atual</div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-12 col-md-6"> -->
                <div class="w3-third" id="divSitAtual">
                    <label for="tipoPaciente">
                        <h6>Situação Atual</h6>
                    </label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sitAtual" id="sitAtualSemPrioridade" value="semPrioridade" onclick="sitPaciente(this.id)">
                                    <label class="form-check-label" for="sitAtualCEspec">
                                        Sem prioridade
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sitAtual" id="sitAtualPrioridadeInicial" value="inicial" onclick="sitPaciente(this.id)">
                                    <label class="form-check-label" for="sitAtualIdoso">
                                        Prioridade inicial
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sitAtual" id="sitAtualCrianca" value="crianca" onclick="sitPaciente(this.id)">
                                    <label class="form-check-label" for="sitAtualCrianca">
                                        Criança
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sitAtual" id="sitAtualIdoso" value="idoso" onclick="sitPaciente(this.id)">
                                    <label class="form-check-label" for="sitAtualIdoso">
                                        Idoso
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sitAtual" id="sitAtualGestante" value="gestante" onclick="sitPaciente(this.id)">
                                    <label class="form-check-label" for="sitAtualGestante">
                                        Gestante
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sitAtual" id="sitAtualCEspec" value="especiais" onclick="sitPaciente(this.id)">
                                    <label class="form-check-label" for="sitAtualCEspec">
                                        Cuidados Especiais
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div>
                </div>
            </div> -->


            <!-- Fim do primeiro bloco... -->
            <!-- ======================================================================================================= -->
            <!-- Início do segundo bloco... -->
            <!-- <div class="w3-row">  -->
            <!-- Comando retirado por não contribuir e nada -->
            <!--   <div class="w3-col"> -->
            <!-- Comando retirado por não contribuir e nada -->

            <div class="w3-panel mt-1 w3-round-large w3-small">
                <header>
                    <h6><strong> DADOS PESSOAIS</strong></h6>
                </header>
                <div class="w3-row-padding w3-small">
                    <div class="w3-col s12 m10 mb-2">
                        <label>Nome</label>
                        <input class="form-control form-control-sm" type="text" placeholder="" id="iNomePessoa" name="nNomePessoa">
                    </div>
                    <div class="w3-col s4 m2">
                        <div class="form-group">
                            <div class="row">
                                <legend class="col-form-label col-sm-4 col-lg-2"> Sexo</legend>
                                <div class="col-sm-10">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="nsexoPessoa" id="isexoPessoaM" value="M" checked>
                                        <label class="form-check-label" for="isexoPessoaM">
                                            Masculino
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="nsexoPessoa" id="isexoPessoaF" value="F">
                                        <label class="form-check-label" for="isexoPessoaF">
                                            Feminino
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="w3-col s8 m4">
                        <label for="uname">Data de nascimento</label>
                        <input class="form-control form-control-sm" type="date" id="iDataNascPessoa" name="nDataNascPessoa">
                    </div>
                    <div class="w3-third w3-col s12 m8">
                        <label>Nacionalidade</label>
                        <select class="form-control form-control-sm w3-round-large w3-border w3-border-green" id="iNacionalidadePessoa" name="nNacionalidadePessoa">
                            <?php
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
                            ?>
                        </select>
                    </div>
                    <div class="w3-col s12 m6">
                        <label>Profissão</label>
                        <input class="form-control form-control-sm" type="text" id="iProfissaoPessoa" name="nProfissaoPessoa">
                    </div>
                    <div class="w3-third w3-col s6 m3">
                        <label>RG</label>
                        <input class="form-control form-control-sm" type="text" placeholder="" id="iRGPessoa" name="nRGPessoa">
                    </div>
                    <div class="w3-third w3-col s6 m3">
                        <label>Expedidor</label>
                        <select class="form-control form-control-sm w3-round-large w3-small w3-border w3-border-green" name="nRGOrgaoPessoa" id="iRGOrgaoPessoa" placeholder="">
                            <option value="SDS">SDS</option>
                            <option value="SSP">SSP</option>
                            <option value="MB">MB</option>
                            <option value="EB">EB</option>
                            <option value="AE">AE</option>
                            <option value="PF">PF</option>
                        </select>
                    </div>
                    <div class="w3-row-padding w3-small">
                        <div class="w3-col s3 l2">
                            <label>UF</label>
                            <input class="form-control form-control-sm" type="text" placeholder="" id="iRGUFPessoa" name="nRGUFPessoa">
                        </div>
                        <div class="form-group w3-col s9 l4">
                            <label>Religião</label>
                            <select class="form-control form-control-sm w3-round-large w3-small w3-border w3-border-green" id="iReligiaoPessoa" name="nReligiaoPessoa">
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
                        <div class="w3-col s12 l6 mb-3">
                            <label>Nome da Mãe</label>
                            <input class="form-control form-control-sm" type="text" name="nomeMaePessoa" id="inomeMaePessoa">
                        </div>
                    </div>

                    <div class="obito" id="obito">
                        <div class="w3-col s6 m3 mb-3 mr-2 ml-2">
                            <label for="uname">Óbito</label>
                            <input class="form-control form-control-sm" type="date" id="idataObitoPaciente" name="ndataObitoPaciente">
                        </div>
                        <div class="w3-col s6 m3 mb-3 ml-3">
                            <label>Tempo Desencarne</label>
                            <input class="form-control form-control-sm" type="text" placeholder="Somente leitura" readonly>
                        </div>
                    </div>
                </div>
            </div>
            <!-- </div> -->
            <!-- Comando retirado por não contribuir e nada -->
            <!-- </div> -->
            <!-- Comando retirado por não contribuir e nada -->

            <!-- Início do bloco para contato -->
            <!-- <div class="row"> -->
            <!-- Comando retirado por não contribuir e nada -->
            <!-- <div class="w3-col s12"> -->
            <!-- Comando retirado por não contribuir e nada -->

            <div class="w3-panel w3-round-large w3-small">
                <header>
                    <h6><strong> INFORMAÇÕES PARA CONTATO</strong></h6>
                </header>
                <div class="w3-row-padding w3-small">
                    <form method="get" action="#">
                        <div class="w3-half w3-col s4 m4 mb-2">
                            <label>CEP</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" name="nCepPessoa" type="text" id="iCepPessoa" value="" size="10" maxlength="9" onblur="pesquisacep(this.value);">
                        </div>
                        <div class="w3-half w3-col s8 m8">
                            <label>País</label>
                            <select class="w3-select w3-round-large w3-border w3-small w3-border w3-border-green" name="nPaisPessoa" id="iPaisPessoa">
                                <?php
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
                                ?>
                            </select>
                        </div>
                        <div class="w3-third w3-col s10 mb-2">
                            <label>Logradouro</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" name="rua" type="text" placeholder="Rua, Av. " id="iRuaPessoa" size="60">
                        </div>
                        <div class="w3-third w3-col s2 m2 mb-2">
                            <label>Nº</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" type="text" placeholder="" name="nNumPessoa" id="iNumPessoa">
                        </div>
                        <div class="w3-third w3-col s6 m3 mb-2">
                            <label>Complemento</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" type="text" placeholder="Casa, Aptº nº" id="iCompPessoa" name="nCompPessoa">
                        </div>
                        <div class="w3-third w3-col s6 m9 mb-2">
                            <label>Bairro</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" name="nBairroPessoa" type="text" id="iBairroPessoa" size="40">
                        </div>
                        <div class="w3-third w3-col s10 mb-2">
                            <label>Cidade</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" name="nCidadePessoa" type="text" id="iCidadePessoa" size="40">
                        </div>
                        <div class="w3-quarter w3-col s2 mb-2">
                            <label>Estado</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" name="nUFPessoa" type="text" id="iUFPessoa" size="2">
                        </div>
                        <div class="w3-half w3-col s7 m8 mb-2">
                            <label>Email</label>
                            <input class="w3-input w3-round-large w3-border w3-small text-lowercase w3-border w3-border-green" type="text" placeholder="" id="iEmailPessoa" name="nEmailPessoa">
                        </div>
                        <div class="w3-half w3-col s5 m4 mb-2">
                            <label>Celular</label>
                            <input class="w3-input w3-round-large w3-border w3-small w3-border w3-border-green" type="text" placeholder="" id="iTelPessoa" name="nTelPessoa">
                        </div>
                </div><br>
            </div>



            <!-- <div class="w3-panel mt-1 w3-round-large w3-border w3-border-green">
                        <header>
                            <h6><strong> INFORMAÇÕES PARA CONTATO</strong></h6>
                        </header>
                        <div class="w3-row-padding w3-small">
                            <div class="w3-col s4 m2 mt-2">
                                <label>CEP</label>
                                <input class="form-control form-control-sm" type="text" id="iCepPessoa"
                                       name="nCepPessoa" size="10"
                                       maxlength="9" onblur="pesquisacep(this.value);">
                            </div>
                            <div class="w3-col s8 m3 mt-2">
                                <label>País</label>
                                <select class="form-control form-control-sm w3-round-large w3-border w3-border-green"
                                        id="iPaisPessoa" name="nPaisPessoa">
                                    <?php
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
                                    ?>
                                </select>
                            </div>
                            <div class="w3-col s12 m7 mt-2">
                                <label>Logradouro</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Rua, Av. "
                                       name="rua" id="iRuaPessoa" size="60">
                            </div>
                            <div class="w3-col s3 m1 mt-2">
                                <label>Nº</label>
                                <input class="form-control form-control-sm" type="text" placeholder="" name="nNumPessoa"
                                       id="iNumPessoa">
                            </div>
                            <div class="w3-col s9 m3 mt-2">
                                <label>Complemento</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Casa, Aptº nº"
                                       id="iCompPessoa" name="nCompPessoa">
                            </div>
                            <div class="w3-col s12 m4 mt-2">
                                <label>Bairro</label>
                                <input class="form-control form-control-sm" type="text" name="nBairroPessoa"
                                       id="iBairroPessoa">
                            </div>
                            <div class="w3-col s9 m4 mt-2">
                                <label>Cidade</label>
                                <input class="form-control form-control-sm" type="text" name="nCidadePessoa"
                                       id="iCidadePessoa">
                            </div>
                            <div class="w3-col s3 m1 mt-2">
                                <label>Estado</label>
                                <input class="form-control form-control-sm" type="text" name="nUFPessoa" id="iUFPessoa"
                                       size="2">
                            </div>
                            <div class="w3-col s12 m4 mt-2">
                                <label>Email</label>
                                <input class="form-control form-control-sm text-lowercase" type="text" placeholder=""
                                       id="iEmailPessoa" name="nEmailPessoa">
                            </div>
                            <div class="w3-col s4 m1 mt-2">
                                <label>DDD</label>
                                <input class="form-control form-control-sm" type="text" placeholder="" id="idddTelPessoa"
                                       name="ndddTelPessoa">
                            </div>
                            <div class="w3-col s8 m2 mt-2">
                                <label>Celular</label>
                                <input class="form-control form-control-sm" type="text" placeholder="" id="iTelPessoa"
                                       name="nTelPessoa">
                            </div>                            
                        </div>
                        <br>
                    </div> -->
            <!-- </div> -->
            <!-- Comando retirado por não contribuir e nada -->
            <!-- </div> -->
            <!-- Comando retirado por não contribuir e nada -->
            <!--  Fim do bloco para Contato -->
            <!-- ======================================================================================= -->
            <!-- <div class="row"> -->
            <div class="w3-col s12" id="saude">
                <div class="w3-panel w3-round-large w3-small">
                    <header>
                        <h6><strong> DADOS DE SAÚDE</strong></h6>
                    </header>
                    <div class="row">
                        <div class="col-sm-4 col-lg-4 mb-3">
                            <!-- <div class="card w3-light-grey border-success"> -->
                            <!-- <div class="card-body"> -->
                            <label for="tipoUsuario">
                                <h6>Toma Medicação Controlada?</h6>
                            </label>
                            <!-- <div class="card-title">Toma Medicação Controlada?</div> -->
                            <div class="form">
                                <label for="iPessoaMedControladaS" class="radio">
                                    <input type="radio" name="nPessoaMedControlada" id="iPessoaMedControladaS" value="S"> Sim </label>
                                <label class="radio" for="iPessoaMedControladaN">
                                    <input type="radio" name="nPessoaMedControlada" id="iPessoaMedControladaN" value="N" checked=""> Não </label>
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        <div class="col-sm-4 col-lg-4 mb-3">
                            <!-- <div class="card w3-light-grey border-success"> -->
                            <!-- <div class="card-body"> -->
                            <label for="tipoUsuario">
                                <h6>Fuma?</h6>
                            </label>
                            <!-- <div class="card-title">Fuma?</div> -->
                            <div class="form">
                                <label class="radio" for="iPessoaFumaS">
                                    <input type="radio" name="nPessoaFuma" id="iPessoaFumaS" value="S"> Sim
                                </label>
                                <label class="radio" for="iPessoaFumaN">
                                    <input type="radio" name="nPessoaFuma" id="iPessoaFumaN" value="N" checked=""> Não </label>
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        <div class="col-sm-4 col-lg-4 mb-3">
                            <!-- <div class="card w3-light-grey border-success"> -->
                            <!-- <div class="card-body"> -->
                            <label for="tipoUsuario">
                                <h6>Faz uso de Bebida Alcoólica?</h6>
                            </label>
                            <!-- <div class="card-title">Faz Uso de Bebida Alcoólica?</div> -->
                            <div class="form">
                                <label class="radio">
                                    <input for="iPessoaBebeS" type="radio" name="nPessoaBebe" id="iPessoaBebeS" value="S"> Sim </label>
                                <label for="iPessoaBebeN" class="radio">
                                    <input type="radio" name="nPessoaBebe" id="iPessoaBebeN" value="N" checked=""> Não </label>
                            </div>
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                        <div class="col-sm-12 mb-3">
                            <!-- <div class="card w3-light-grey border-success"> -->
                            <!-- <div class="card-body"> -->
                            <label for="tipoUsuario">
                                <h6>Faz tratamento espiritual em outra casa?</h6>
                            </label>
                            <!-- <div class="card-title">Faz tratamento espiritual em outra casa?</div> -->
                            <div class="form">
                                <label for="iPessoaTratOutraInstS" class="radio">
                                    <input type="radio" name="nPessoaTratOutraInst" id="iPessoaTratOutraInstS" value="S" onclick="$('#iPessoaNomeInstituicao').show();"> Sim </label>
                                <label for="iPessoaTratOutraInstN" class="radio">
                                    <input type="radio" name="nPessoaTratOutraInst" id="iPessoaTratOutraInstN" value="N" checked onclick="$('#iPessoaNomeInstituicao').hide();" checked> Não
                                </label>
                            </div>
                            <input type="text" class="form-control form-control-sm" placeholder="Qual?" id="iPessoaNomeInstituicao" name="nPessoaNomeInstituicao" style="display: none">
                            <!-- </div> -->
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- <===========================================================================> -->
            <div class="w3-col responsavel" id='responsavel'>
                <div class="w3-panel mt-1 w3-round-large w3-small">
                    <header>
                        <h6><strong> DADOS DO RESPONSÁVEL</strong></h6>
                    </header>

                    <div class="w3-row-padding w3-small">
                        <div class="row">
                            <div class="form-group input-group-sm col" id="divResponsavel">
                                <label for="respPessoa">Responsável</label>
                                <select class="form-control form-control-sm w3-small w3-round-large w3-border w3-border-green" id="iRespPessoa" name="nRespPessoa">
                                    <?php
                                    $pdo = conectar();
                                    $buscarResponsavel = $pdo->prepare("SELECT  * FROM RESPONSAVEL  ORDER BY NREG");
                                    $buscarResponsavel->execute();
                                    $respResponsavel = $buscarResponsavel->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($respResponsavel as $item) {
                                        echo "<option value='" . $item['NREG'] . "'";
                                        if ($item['NREG'] === "2") {
                                            echo "selected";
                                        }
                                        echo ">" . $item['NO_RESPONSAVEL'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-lg-3 mt-2">
                                <label>RG</label>
                                <input class="form-control form-control-sm" type="text" placeholder="" id="iRGRespPessoa" name="nRGRespPessoa">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 mt-2">
                                <label>Expedidor</label>
                                <select class="form-control form-cont rol-sm w3-round-large w3-small w3-border w3-border-green" name="nRGOrgaoRespPessoa" id="iRGOrgaoRespPessoa" placeholder="">
                                    <option value="SDS">SDS</option>
                                    <option value="SSP">SSP</option>
                                    <option value="MB">MB</option>
                                    <option value="EB">EB</option>
                                    <option value="AE">AE</option>
                                    <option value="PF">PF</option>
                                </select>
                            </div>
                            <div class="col-sm-3 col-lg-3 mt-2">
                                <label>UF</label>
                                <input class="form-control form-control-sm" type="text" placeholder="Sigla" id="iRGUFRespPessoa" name="nRGUFRespPessoa">
                            </div>
                            <div class="col-sm-4 col-lg-3 mt-2">
                                <div class="form-group">
                                    <legend class="col-form-label col-sm-6 col-lg-3 pt-0"> Sexo</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="nsexoRespPessoa" id="isexoRespPessoaM" value="M" checked>
                                            <label for="isexoPessoaM" class="form-check-label">Masculino</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input class="form-check-input" type="radio" name="nsexoRespPessoa" id="isexoRespPessoaF" value="F">
                                            <label for="isexoRespPessoaF" class="form-check-label">Feminino</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-lg-3 mb-3">
                                <label for="uname">Nascimento</label>
                                <input class="form-control form-control-sm" type="date" id="iDataNascRespPessoa" name="nDataNascRespPessoa">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fim do segundo bloco... -->

            <!-- INÍCIO DO CAMPO MOTIVO DA CONSULTA -->
            <div class="w3-col s12" id="consulta">
                <div class="w3-panel w3-round-large w3-small">
                    <header>
                        <h6><strong> MOTIVO DA CONSULTA</strong></h6>
                    </header>
                    <div class="form-group">
                        <label for="motivo"></label>
                        <textarea class="form-control" rows="5" name="nmotivoConsultaPaciente" id="imotivoConsultaPaciente" name="text"></textarea>
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
    </form>
</div>
<!-- ======================================================================================================= -->
<!-- Jquery.js, Popper.js e Bootstrap.js -->

<!-- ============================================================================================= -->

<!-- ============================================================================================= -->