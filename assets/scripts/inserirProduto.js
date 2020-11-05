$(document).ready(function(){
    $('#valorProduto').mask('#.##0,00', {reverse: true});
    var btnEnviarDados = $('#btnEnviar');

    btnEnviarDados.click(function(evento){

        var file     = $('#imgProduto')[0].files[0];

        $('#ajax_form').validate({
            rules: {
                nome: {
                    minlength: 2,
                    required: true
                },
                id_categoria: {
                    required: true
                },
                dataCompra: {
                    required: true
                },
                valorUnitario: {
                    required: true
                },
                quantidade: {
                    minlength: 1,
                    required: true
                }
            },
            messages: {
                nome: "Necessário Digitar o Nome do Produto",
                id_categoria: "Necessário Escolher uma Categoria",
                dataCompra: "Informe a Data de Compra deste Produto",
                valorUnitario: "Informe um Valor, não é Necessário pontuação",
                quantidade: "Informe a Quantidade"
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            success: function (element) {
                var target;
                if(element[0].control !== null && element[0].control !== undefined){
                    target = $(element[0].control);
                } else {
                    target = $(element[0].previousSibling);
                }

                target.addClass('is-valid');
                target.removeClass('is-invalid');

            },
            submitHandler: function(){
                evento.preventDefault();
                var formData = new FormData(document.getElementById("ajax_form"));
                var action   = "Source/Controller/crudProdutos.php";
                $.ajax({
                    type: 'POST',
                    url: action,
                    data: formData,
                    contentType: false,
                    // cache: false,
                    processData:false,
                    dataType: 'json',
                    beforeSend: function(){
                        load("open");
                    },
                    success: function(callback){
                        if (callback.error){
                            msgErro('Falha', callback.message);
                        }
                        if (!callback.error){
                            limpaFormularioProdutos();
                            msgSucesso('Sucesso', callback.message);
                        }
                    },
                    complete: function(){
                        load("close");
                    }
                });
            }
        });

    });

    function msgSucesso(title ,msgBody){
        $.confirm({
            title: title,
            content: msgBody,
            type: 'blue',
            buttons: {
                sim: {
                    text: 'Ok',
                    btnClass: 'btn-info',
                    action: function(){

                    }
                }
            }
        });
    }

    function msgErro(title ,msgBody){
        $.dialog({
            title: title,
            content: msgBody,
            type: 'red',
        });
    }

    function load(action){
        var load_div = $(".ajax_load");
        if (action === "open") {
            load_div.fadeIn().css("display", "flex");
        } else {
            load_div.fadeOut();
        }
    }

    function limpaFormularioProdutos(){
        $('#ajax_form').each(function(){
            $('input').removeClass('is-valid');
            this.reset();
        });
    }

});