// Funcao para abrir conteudo do menu na parte home da aplicação

$(document).ready(function () {
    $('.btn-menu').click(function () {
        let carregaUrl;
        let idMenu = this.id;
        if ( idMenu === 'btMenuHome'){
            carregaUrl = home+"/home.php";
        } else if ( idMenu === 'btMenuTriagem'){
            carregaUrl = home+"/triagem.php";
        } else if ( idMenu === 'btMenuTriagem02'){
            carregaUrl = home+"/triagem02.php";
        }



        $.ajax({
            async: true,
            url: carregaUrl,
            method : "POST",
            dataType: "html",
            success: function (html) {
                $('#divConteudoInterno').html(html);
            },

        });

    })

});

