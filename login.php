<?php

session_start();
require_once ('Source\Controller\Core.php');
use Source\Controller\Core;

$core               = new Core();
$core->getParametros('parametros');
$nomeMercado        = $core->getNomeMercado();

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Login App <?php echo $nomeMercado ?></title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link rel="apple-touch-icon" sizes="76x76" href="install/installer_full/install/assets/img/apple-icon.png" />
    <link rel="icon" type="image/png" href="assets/img/favicon.png" />

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <link href="install/installer_full/install/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="install/installer_full/install/assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">

    <link href="install/installer_full/install/assets/css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/loadin_ajax.css">

</head>

<body>

<div class="image-container set-full-height" style="background-image: url('install/installer_full/install/assets/img/market.jpg')">
    <a href="#" class="made-with-mk">
        <div class="brand">TR</div>
        <div class="made-with">Developer By <strong>ThalesRup</strong></div>
    </a>

    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-4">

                <div class="wizard-container">
                    <div class="card wizard-card" data-color="blue" id="wizard">
                        <form id="form-login" action="" method="POST">

                            <div class="wizard-header">
                                <h3 class="wizard-title">
                                    Login
                                </h3>
                                <h5>Informe os dados para Entrar na Plataforma</h5>
                                <div>
                                    <h3> <?php echo $nomeMercado; ?> </h3>
                                </div>
                            </div>
                            <div class="wizard-navigation">
                                <ul>
                                    <li><a href="#details" data-toggle="tab">Credenciais</a></li>
                                    <li><a href="#form-creat-acount" data-toggle="tab">Criar Conta</a></li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane" id="details">
                                    <div class="row">

                                        <div class="col-sm-10 col-sm-offset-1">

                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">record_voice_over</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Login <small>(required)</small></label>
                                                    <input id="login" name="login" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">password</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Senha <small>(required)</small></label>
                                                    <input id="senha" name="senha" type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="pull-right">
                                            <input type='button' id="btn-atualizar-login" class='btn btn-fill btn-info btn-wd' name='next' value='Entrar' />
                                        </div>
                                    </div>

                                </div>
                                <div class="tab-pane" id="form-creat-acount">
                                    <div class="row">
                                        <h4 class="info-text">Criar um Usuário para Acesso a Plataforma</h4>
                                        <div class="col-sm-4 col-sm-offset-1">
                                            <div class="picture-container">
                                                <div class="picture">
                                                    <img src="./assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
                                                    <input type="file" id="wizard-picture">
                                                </div>
                                                <h6>Escolha Sua Foto</h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">face</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Nome <small>(required)</small></label>
                                                    <input name="nome" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">record_voice_over</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Login <small>(required)</small></label>
                                                    <input name="login" type="text" class="form-control">
                                                </div>
                                            </div>

                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">password</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Senha <small>(required)</small></label>
                                                    <input name="senha" type="password" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-10 col-sm-offset-1">
                                            <div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons">email</i>
													</span>
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Email <small>(required)</small></label>
                                                    <input name="email" type="email" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wizard-footer">
                                        <div class="pull-right">
                                            <input id="btn-criar-conta" type='button' class='btn btn-fill btn-info btn-wd' name='login' value='Criar Conta' />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

</body>
<script src="install/installer_full/install/assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="install/installer_full/install/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="install/installer_full/install/assets/js/jquery.bootstrap.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="install/installer_full/install/assets/js/material-bootstrap-wizard.js"></script>

<script src="install/installer_full/install/assets/js/jquery.validate.min.js"></script>

<script>
    $(document).ready(function(){

        $("#btn-criar-conta").click(function(evento){
            evento.preventDefault();
            var formData = new FormData(document.getElementById("form-login"));
            var action   = "Source/Controller/AuthLoginLogout.php";
            var file     = $('#wizard-picture')[0].files[0];

            // console.log($('#wizardPicturePreview')[0].currentSrc);
            formData.append('imgPerfilUsuarioBlob', file);

            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                contentType: false,
                // cache: false,
                processData:false,
                dataType: 'json',
                success: function(callback){

                    if (callback.error){
                        msgErro('Falha', callback.message);
                    }
                    if (!callback.error){
                        msgSucesso('Sucesso', callback.message);
                    }
                },
            });
        });

        $('#btn-atualizar-login').click(function (e) {
            console.log('teste');

                    e.preventDefault();
                    var action   = "Source/Controller/AuthLoginLogout.php";
                    var login    = $("#login").val();
                    var senha    = $("#senha").val();
                    let data     = {
                        login: login,
                        senha: senha
                    }

                    $.ajax({
                        type: 'POST',
                        url: action,
                        data: data,
                        dataType: 'json',

                        success: function (callback) {

                            if (callback.error) {
                                msgErro('Falha', callback.message);
                            }
                            if (!callback.error) {
                                msgSucesso('Certo', "Proseeguir para Plataforma?");
                            }
                        }
                    });

                });

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
                            location.href='index';
                        }
                    }
                }
            });
        }

        function msgErro(title, msgBody) {
            $.dialog({
                title: title,
                content: msgBody,
                type: 'red'
            });
        }
    });
</script>
</html>
