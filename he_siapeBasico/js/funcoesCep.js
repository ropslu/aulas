/* Script para CEP  */

function limpa_formulário_cep() {
    //Limpa valores do formulário de cep.
    document.getElementById('iRuaPessoa').value = ("");
    document.getElementById('iBairroPessoa').value = ("");
    document.getElementById('iCidadePessoa').value = ("");
    document.getElementById('iUFPessoa').value = ("");
}

function meu_callback(conteudo) {
    if (!("erro" in conteudo)) {
        //Atualiza os campos com os valores.
        document.getElementById('iRuaPessoa').value = (conteudo.logradouro);
        document.getElementById('iBairroPessoa').value = (conteudo.bairro);
        document.getElementById('iCidadePessoa').value = (conteudo.localidade);
        document.getElementById('iUFPessoa').value = (conteudo.uf);
    } //end if.
    else {
        //CEP não Encontrado.
        limpa_formulário_cep();
        alert("CEP não encontrado.");
    }
}

function pesquisacep(valor) {

    //Nova variável "cep" somente com dígitos.
    var cep = valor.replace(/\D/g, '');

    //Verifica se campo cep possui valor informado.
    if (cep != "") {

        //Expressão regular para validar o CEP.
        var validacep = /^[0-9]{8}$/;

        //Valida o formato do CEP.
        if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            document.getElementById('iRuaPessoa').value = "...";
            document.getElementById('iBairroPessoa').value = "...";
            document.getElementById('iCidadePessoa').value = "...";
            document.getElementById('iUFPessoa').value = "...";

            //Cria um elemento javascript.
            var script = document.createElement('script');

            //Sincroniza com o callback.
            script.src = 'https://viacep.com.br/ws/' + cep + '/json/?callback=meu_callback';

            //Insere script no documento e carrega o conteúdo.
            document.body.appendChild(script);

        } //end if.
        else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
        }
    } //end if.
    else {
        //cep sem valor, limpa formulário.
        limpa_formulário_cep();
    }
};
