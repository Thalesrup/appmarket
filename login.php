<?php
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

    <link href="install/installer_full/install/assets/css/demo.css" rel="stylesheet" />
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
                                    </div>
                                </div>

                            </div>
                            <div class="wizard-footer">
                                <div class="pull-right">
                                    <input type='button' class='btn btn-finish btn-fill btn-info btn-wd' name='login' value='Entrar' />
                                </div>
                                <div class="clearfix"></div>
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

<script src="install/installer_full/install/assets/js/material-bootstrap-wizard.js"></script>

<script src="install/installer_full/install/assets/js/jquery.validate.min.js"></script>
</html>
