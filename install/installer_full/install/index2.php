<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Instalador Sistema Web Market</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="assets/img/favicon.png" />

	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

	<link href="assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="assets/css/material-bootstrap-wizard.css" rel="stylesheet" />

	<link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
	<div class="image-container set-full-height" style="background-image: url('assets/img/market.jpg')">
		<a href="" class="made-with-mk">
			<div class="brand">TR</div>
			<div class="made-with">Developer By <strong>ThalesRup</strong></div>
		</a>

	    <div class="container">
	        <div class="row">
		        <div class="col-sm-8 col-sm-offset-2">

		            <div class="wizard-container">
		                <div class="card wizard-card" data-color="blue" id="wizard">
		                    <form action="" method="">

		                    	<div class="wizard-header">
		                        	<h3 class="wizard-title">
		                        		Instalação Banco do Dados
		                        	</h3>
									<h5>Informe os dados de conexão com o banco de dados</h5>
		                    	</div>
								<div class="wizard-navigation">
									<ul>
			                            <li><a href="#details" data-toggle="tab">Credenciais</a></li>
			                            <li><a href="#captain" data-toggle="tab">Importar Tabelas</a></li>
			                            <li><a href="#description" data-toggle="tab">Criar Acesso ao Sistema</a></li>
			                        </ul>
								</div>

		                        <div class="tab-content">
		                            <div class="tab-pane" id="details">
		                            	<div class="row">
			                            	<div class="col-sm-12">
			                                	<h4 class="info-text"> Informe Credenciais</h4>
			                            	</div>
		                                	<div class="col-sm-6">
												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Host</label>
			                                          	<input name="name" type="text" class="form-control" value="localhost">
			                                        </div>
												</div>

												<div class="input-group">
													<span class="input-group-addon">
														<i class="material-icons"></i>
													</span>
													<div class="form-group label-floating">
			                                          	<label class="control-label">Usuário</label>
			                                          	<input name="name2" type="text" class="form-control" value="root">
			                                        </div>
												</div>

		                                	</div>
		                                	<div class="col-sm-6">
		                                    	<div class="form-group label-floating">
		                                        	<label class="control-label">Nome Banco</label>
													<input name="name2" type="text" class="form-control" value="" required>
												</div>
												<div class="form-group label-floating">
		                                        	<label class="control-label">Senha Usuário</label>
													<input name="name2" type="text" class="form-control" value="">
												</div>
		                                	</div>
		                            	</div>
		                            </div>
		                            <div class="tab-pane" id="captain">
		                                <h4 class="info-text">Gerar Tabelas Necessárias </h4>
		                                <div class="row" style="padding-left: 250px">
		                                    <div class="col-sm-10 col-sm-offset-1">
		                                        <div class="col-sm-4  center-block">
		                                            <div class="choice" data-toggle="wizard-radio" rel="tooltip" title="Este Procedimento Irá gerar as tabelas necessárias">
		                                                <input type="radio" name="job" value="Design">
		                                                <div class="icon">
		                                                    <i class="material-icons">
																published_with_changes</i>
		                                                </div>
		                                                <h6>Iniciar Procedimento</h6>
		                                            </div>
		                                        </div>
		                                    </div>
		                                </div>
		                            </div>
		                            <div class="tab-pane" id="description">
										<div class="row">
											<h4 class="info-text"> Agora Vamos criar um Usuário para Realizar o primeiro Acesso a Plataforma</h4>
											<div class="col-sm-4 col-sm-offset-1">
												<div class="picture-container">
													<div class="picture">
														<img src="assets/img/default-avatar.png" class="picture-src" id="wizardPicturePreview" title=""/>
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
		                            </div>
		                        </div>
	                        	<div class="wizard-footer">
	                            	<div class="pull-right">
	                                    <input type='button' class='btn btn-next btn-fill btn-info btn-wd' name='next' value='Prosseguir' />
	                                    <input type='button' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finalizar' />
	                                </div>
	                                <div class="pull-left">
	                                    <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Voltar' />
	                                </div>
	                                <div class="clearfix"></div>
	                        	</div>
		                    </form>
		                </div>
		            </div>
		        </div>
	    	</div>
		</div>

	    <div class="footer">
	        <div class="container text-center">

	        </div>
	    </div>
	</div>

</body>

	<script src="assets/js/jquery-2.2.4.min.js" type="text/javascript"></script>
	<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="assets/js/jquery.bootstrap.js" type="text/javascript"></script>

	<script src="assets/js/material-bootstrap-wizard.js"></script>

	<script src="assets/js/jquery.validate.min.js"></script>
</html>
