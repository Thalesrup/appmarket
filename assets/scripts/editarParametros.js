$(document).ready(function(){
    var inputImagemLogo = $('#imgLogoMercado');
    var descartar       = $('.card-descartar');
    var cardPrevia      = $('.card-previa');
    console.log(inputImagemLogo);
    console.log(descartar);
    console.log(cardPrevia);

    inputImagemLogo.change(function(){
        var input = $(this);
        console.log(input[0].files[0]);
        if (input[0].files && input[0].files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#previaImgEscolhida')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            $('.card-previa').removeAttr('hidden', true);
            reader.readAsDataURL(input[0].files[0]);
        }
    });

    descartar.click(function(evento){
        evento.preventDefault();
        inputImagemLogo.val('');
        cardPrevia.attr('hidden', true);
    });

});