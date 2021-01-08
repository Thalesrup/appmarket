$(document).ready(function(){
    console.log('teste');
    $('#form-login').submit(function (e) {

        e.preventDefault();
        $('#form-login').validate({
            rules: {
                login: {
                    minlength: 2,
                    required: true
                },
                senha: {
                    required: true
                },
            },
            messages: {
                nome: "Necessário Digitar o Nome do Usuário",
                senha: "Necessário Digitar a Senha"
            },
            highlight: function (element) {
                $(element).addClass('is-invalid');
            },
            success: function (element) {
                var target;
                if (element[0].control !== null && element[0].control !== undefined) {
                    target = $(element[0].control);
                } else {
                    target = $(element[0].previousSibling);
                }

                target.addClass('is-valid');
                target.removeClass('is-invalid');

            },
            submitHandler: function () {
                e.preventDefault();
                var formData = new FormData(document.getElementById("form-login"));
                var action = "Source/Controller/AuthController.php";

                $.ajax({
                    type: 'POST',
                    url: action,
                    data: {action: login, formData},
                    contentType: false,
                    processData: false,
                    dataType: 'json',
                    beforeSend: function () {
                        load("open");
                    },
                    success: function (callback) {
                        if (callback.error) {
                            msgErro('Falha', callback.message);
                        }
                        if (!callback.error) {
                            window.location.href = 'index.php';
                        }
                    },
                    complete: function () {
                        load("close");
                    }
                });
            }
        });
    });

    function load(action) {
        var load_div = $(".ajax_load");
        if (action === "open") {
            load_div.fadeIn().css("display", "flex");
        } else {
            load_div.fadeOut();
        }
    }

    function msgSucesso(title, msgBody) {
        $.confirm({
            title: title,
            content: msgBody,
            type: 'blue',
            buttons: {
                sim: {
                    text: 'Ok',
                    btnClass: 'btn-info',
                    action: function () {

                    }
                }
            }
        });
    }

    function msgErro(title, msgBody) {
        $.dialog({
            title: title,
            content: msgBody,
            type: 'red',
        });
    }
});