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
$horaAtual=date('h:i:s');


?>

<br/>
<br/>


<div id="iCadPessoa" style="display: block">
    <form id="formCadPessoa" method="POST" enctype="multipart/form-data">

        <div class="container" id="divMensagens" style="display: block">
            <div id="divMensagemOK" class="alert alert-info col-sm-11" style="display: none">
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                <span id="mensagemOK" style="font-size:15px;text-indent:5px; text-align:justify;"></span>
            </div>
            <div id="divMensagemNOK" class="alert alert-danger col-sm-11" style="display: none">
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                <span id="mensagemNOK" style="font-size:15px;text-indent:5px; text-align:justify;"></span>
            </div>
        </div>
        <section id=isectionCadPessoa>

            <div class="container col-sm-12" id="divCadPessoa">
                <div class="form-group input-group-sm">
                    <label>Data e Hora</label>
                    <input name="dt_cadastro" readonly="true" type="date"
                           value='<?php echo "$dataAtual" ?>'>
                    <input name="hora_cadastro" readonly="true"
                           type="time" value='<?php echo "$horaAtual" ?>'>
                </div>
                <br>

                <div class="form-group input-group-sm">
                    <label>Nome Pessoa *</label>
                    <input type="text" class="form-control" id="iNomePessoa" name="nNomePessoa"
                           placeholder="Digite o nome do Pessoa" required>
                </div>

                <div class="form-group input-group-sm">
                    <label>Data de nascimento *</label>
                    <input type="date" class="form-control" id="iDataNascPessoa" name="nDataNascPessoa" placeholder="dd/mm/aaaa"  onblur="checaAniversario(this.value)" required>
                </div>


                <div class="form-group input-group-sm" id="divResponsavel" style="display: none">
                    <label for="respPessoa">Responsável do Pessoa</label>
                    <select class="form-control" id="iRespPessoa" name="nRespPessoa">
                        <?php
                        $pdo=conectar();
                        $buscarResponsavel=$pdo->prepare("SELECT  * FROM RESPONSAVEL  ORDER BY NREG");
                        $buscarResponsavel->execute();
                        $respResponsavel=$buscarResponsavel->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($respResponsavel as $item) {
                            echo "<option value='". $item['NREG'] ."'"; if ($item['NREG'] == "2") { echo "selected";} echo ">". $item['NO_RESPONSAVEL'] ."</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group input-group-sm">
                    <label for="condicaoPessoa">Condição do Pessoa *</label>
                    <select class="form-control" name="nCondicaoPessoa" id="iCondicaoPessoa" onchange="validaCondicao(this.value)">
                        <option value="0">Não Informado</option>
                        <option value="1">Encarnado</option>
                        <option value="2">Desencarnado</option>
                    </select>
                </div>

                <div class="form-group input-group-sm" id="divDataObito" style="display: none">
                    <label>Data do óbito</label>
                    <input type="date" class="form-control" id="iDataObito" name="nDataObito" placeholder="dd/mm/aaaa">
                </div>

                <!-- NR_IDENTIDADE -->
                <div class="form-group input-group-sm">
                    <label for="RG">(RG) Identidade</label>
                    <input type="text" class="form-control" id="iRGPessoa" name="nRGPessoa" onKeyPress="MascaraRG(form1.nvRG);" maxlength="14" placeholder="">
                </div>


                <!-- CD_orgao_emissor_identidade -->
                <div class="form-group input-group-sm">
                    <label for="Orgao">Orgão</label>
                    <select class="form-control" name="nRGOrgao" id="iRGOrgao">
                        <option value="NÃO INFORMADO" default>NÃO INFORMADO</option>
                        <option value="SDS">SDS</option>
                        <option value="SSP">SSP</option>
                        <option value="MB">MB</option>
                        <option value="EB">EB</option>
                        <option value="AE">AE</option>
                        <option value="PF">PF</option>
                    </select>
                </div>

                <!-- cd_sigla_uf_identidade -->
                <div class="form-group input-group-sm">
                    <label for="UF">UF</label>
                    <input type="text" class="form-control" id="iRGUF" name="nRGUF" placeholder="">
                </div>

                <div class="form-group input-group-sm">
                    <label for="Sexo">Sexo *</label>
                    <select class="form-control" name="nsexoPessoa" id="isexoPessoa">
                        <option value="0">Não Informado</option>
                        <option value="M">Masculino</option>
                        <option value="F">Feminino</option>
                    </select>
                </div>


                <div class="form-group input-group-sm">
                    <label>Nome da mãe *</label>
                    <input type="text" class="form-control" id="iNomeMae" name="nNomeMae"
                           placeholder="Digite o nome da mãe" required>
                </div>


                <div class="form-group input-group-sm">
                    <label for="religao">Religião</label>
                    <select class="form-control" id="iReligiaoPessoa" name="nReligiaoPessoa">
                        <?php
                        $pdo=conectar();
                        $buscarReligiao=$pdo->prepare("SELECT NREG,DESCRICAO FROM TIPO_RELIGIAO  ORDER BY descricao");
                        $buscarReligiao->execute();
                        $respReligiao=$buscarReligiao->fetchAll(PDO::FETCH_ASSOC);
                        echo "<option value='NAO INFORMADO' selected>NÃO INFORMADO</option>";
                        foreach ($respReligiao as $item) {
                            echo "<option value='". $item['NREG'] ."'>". $item['DESCRICAO'] ."</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group input-group-sm">
                    <label for="religicaoOutra">Outra Religião</label>
                    <input type="text" class="form-control" id="iReligiaoOutra" name="nReligiaoOutra"
                           placeholder="Outras">
                </div>
                <div class="form-group input-group-sm">
                    <br>
                    <button type="button" onclick="">Inserir Religião</button>
                </div>


                <div class="form-group input-group-sm">
                    <label>Profissão</label>
                    <input type="text" class="form-control" id="iProfissaoPessoa" name="nProfissaoPessoa"
                           placeholder="Digite a profissão">
                </div>


                <div class="form-group input-group-sm">
                    <label for="nacionalidade">Nacionalidade</label>
                    <select class="form-control" id="iNacionalidadePessoa" name="nNacionalidadePessoa">
                        <?php
                        $pdo=conectar();
                        $buscarReligiao=$pdo->prepare("SELECT  NAC_CODIGO, NAC_DESCRICAO FROM TB_NACIONALIDADE  ORDER BY NAC_DESCRICAO");
                        $buscarReligiao->execute();
                        $respReligiao=$buscarReligiao->fetchAll(PDO::FETCH_ASSOC);
                        foreach ($respReligiao as $item) {
                            echo "<option value='". $item['NAC_CODIGO'] ."'"; if ($item['NAC_DESCRICAO'] == 'Brasil') { echo "selected";} echo ">". $item['NAC_DESCRICAO'] ."</option>";
                        }
                        ?>
                    </select>
                </div>


                <div class="form-group input-group-sm">
                    <label for="familia">Família</label>
                    <select class="form-control" id="iFamiliaPessoa" name="nFamiliaPessoa">
                        <?php
                        $pdo=conectar();
                        $buscarFamilia=$pdo->prepare("SELECT NREG FROM FAMILIA  ORDER BY NREG");
                        $buscarFamilia->execute();
                        $respFamilia=$buscarFamilia->fetchAll(PDO::FETCH_ASSOC);
                        echo "<option value='0' selected>0</option>";
                        foreach ($respFamilia as $item) {
                            echo "<option value='". $item['NREG'] ."'>". $item['NREG'] ."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group input-group-sm">
                    <br>
                    <button type="button" onclick="">Criar Família</button>
                </div>


                <span>Diagnóstico do Pessoa</span>
                    Selecione as Opções
                    <br />
                    <p>Faz uso de bebida alcólica?</p>
                    <input type="radio" name="nPessoaBebe" id="iPessoaBebeS" value="S"/>
                    <label for="iPessoaBebeS">Sim</label>
                    <input type="radio" name="nPessoaBebe" id="iPessoaBebeN" value="N" checked/>
                    <label for="iPessoaBebeN">Não</label><br>

                <p>Faz uso de cigarro?</p>
                        <input type="radio" name="nPessoaFuma" id="iPessoaFumaS" value="S"/>
                        <label for="iPessoaFumaS">Sim</label>
                        <input type="radio" name="nPessoaFuma" id="iPessoaFumaN" value="N" checked/>
                        <label for="iPessoaFumaN">Não</label><br>

                <p>Primeira vez?</p>
                        <input type="radio" name="nPessoaPrimeiraVez" id="iPessoaPrimeiraVezS" value="S"/>
                        <label for="iPessoaPrimeiraVezS">Sim</label>
                        <input type="radio" name="nPessoaPrimeiraVez" id="iPessoaPrimeiraVezN" value="N" checked/>
                        <label for="iPessoaPrimeiraVezN">Não</label><br>


                <p>Faz uso de medicação conrolada?</p>
                        <input type="radio" name="nPessoaMedControlada" id="iPessoaMedControladaS" value="S"/>
                        <label for="iPessoaMedControladaS">Sim</label>
                        <input type="radio" name="nPessoaMedControlada" id="iPessoaMedControladaN" value="N" checked/>
                        <label for="iPessoaMedControladaN">Não</label><br>

                <p>Faz Tratamento em outra Instituição?</p>
                        <input type="radio" name="nPessoaTratOutraInst" id="iPessoaTratOutraInstS" value="S" onclick="$('#iPessoaNomeInstituicao').show();"/>
                        <label for="iPessoaTratOutraInstS">Sim</label>
                        <input type="radio" name="nPessoaTratOutraInst" id="iPessoaTratOutraInstN" value="N" checked onclick="$('#iPessoaNomeInstituicao').hide();"/>
                        <label for="iPessoaTratOutraInstN">Não</label><br>
                        <br>

                <p>Nome da instituição</p>
                        <input type="text" class="form-control" id="iPessoaNomeInstituicao" name="nPessoaNomeInstituicao" style="display: none">







                <br />
                <br />
                <br />
                <br />
                <br />
                <br />



                <!-- TIPO LOGRADOURO - id_tipo_logradouro -->

                <!-- cd_cep -->
                <div class="form-group input-group-sm">
                    <label>CEP</label>
                    <input type="text" class="form-control" id="iCepPessoa" name="nCepPessoa"
                           onKeyPress="MascaraCep(form1.cep);" onblur="pesquisacep(this.value);" maxlength="10"
                           placeholder="Digite o CEP">
                </div>

                <!-- no_logradouro -->
                <div class="form-group input-group-sm">
                    <label for="rua">Logradouro</label>
                    <input name="rua" type="text" class="form-control" id="rua" placeholder="Rua, Qd, Lote, Sitio">
                </div>

                <!-- nr_logradouro -->
                <div class="form-group input-group-sm">
                    <label for="numero">Número</label>
                    <input name="nNum" type="numero" class="form-control" id="iNum" placeholder="Digite o nº">
                </div>

                <!-- no_complemento_logradouro -->
                <div class="form-group input-group-sm">
                    <label for="complemento">Complemento</label>
                    <input type="text" class="form-control" id="iComp" name="nComp" placeholder="Casa, aptº">
                </div>

                <!-- no_bairro -->
                <div class="form-group input-group-sm">
                    <label for="bairro">Bairro</label>
                    <input name="bairro" type="text" class="form-control" id="bairro" placeholder="Digite o bairro">
                </div>

                <!--MUNICIPIO COLOCA O CÓDIGO -->
                <div class="form-group input-group-sm">
                    <label for="cidade">Cidade</label>
                    <input name="cidade" type="text" class="form-control" id="cidade" placeholder="Digite a cidade">
                </div>

                <!-- uf_residencia -->
                <div class="form-group input-group-sm">
                    <label for="estado">Estado (Sigla)</label>
                    <input name="uf" type="text" class="form-control" id="uf" placeholder="Estado">
                </div>


                <div class="form-group input-group-sm">
                    <label for="pais">País</label>
                    <input name="nPais" type="text" class="form-control" id="iPais" placeholder="Brasil">
                </div>

                <!-- email_pcnte -->
                <div class="form-group input-group-sm">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="iEmail" name="nEmail"
                           placeholder="Digite um Email válido">
                </div>

                <!-- nr_ddd -->

                <!-- nr_celular -->
                <div class="form-group input-group-sm">
                    <label for="Telefone1">Telefone</label>
                    <input type="text" class="form-control" id="iTelPessoa" name="nTelPessoa" maxlength="15"
                           placeholder="(00)-90000-0000">
                </div>


                <div class="col-xs-4 col-xs-offset-4 col-sm-4 col-md-offset-5" style="display: block">
                    <input type="button" value="InserirPessoa" id="btInserirPessoa" onclick="salvarPessoa(this.value)"
                           class="btn btn-primary" style="display: block">
                    <input type="button" value="AtualizarPessoa" id="btAtualizarPessoa" onclick="salvarPessoa(this.value)"
                           class="btn btn-primary" style="display: block">
                    <input type="reset" value="Limpar" id="btLimpar" onclick="history.go(0)" class="btn btn-danger"
                           style="display: block">
                </div>
            </div>
        </section>
    </form>
</div>

