$(document).ready(function(){
    let pagina;

    window.editarProduto = function(idProduto) {
        console.log('Id Produto :'+idProduto);
        var action   = "Source/Controller/crudProdutos.php?update="+idProduto;

        $.ajax({
            type: 'GET',
            url: action,
            contentType: false,
            // cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function(){
                load('open');
            },
            success: function(callback){
                console.log(callback);
                $('#form-update-produto').html(callback);
                $('#modalUpdateProduto').modal('show');
            },
            complete: function(){
                load('close');
            }
        });
    }

    window.excluirProduto = function(idProduto){
        console.log(idProduto);
    }

    $('.page-link').on('click', function(evento){
        evento.preventDefault();
        pagina      = $(this).data().value;
        var target  = $(this);

        $('li').removeClass('active');
        target.parent().addClass('active');

        var action   = "Source/Controller/crudProdutos.php?pagina="+pagina;

        $.ajax({
            type: 'GET',
            url: action,
            contentType: false,
            // cache: false,
            processData:false,
            dataType: 'json',
            beforeSend: function(){
                load('open');
            },
            success: function(callback){
                $('#corpo-tabela-produtos').html('');
                $('#corpo-tabela-produtos').html(callback);
            },
            complete: function(){
                load('close');
                $('#btn-editar-produto').unbind("click")
            }
        });

    });

    function load(action){
        var load_div = $(".ajax_load");
        if (action === "open") {
            load_div.fadeIn().css("display", "flex");
        } else {
            load_div.fadeOut();
        }
    }


});