<style>
    img {
        width: 250px;
        height: 300px;
        object-fit: cover;
        display: block;
        margin-left: auto;
        margin-right: auto
    }
</style>
<!DOCTYPE>
<html lang="pt-br">
<head>
    <title>Instalador</title>
    <link rel="stylesheet" href="assets/css/install.css">
</head>
<body>

<div class="container-full bg-light-gray">
    <div class="container radius">

        <div class="connect_db">
            <img src="assets/img/logo_transparent.png">
            <p>Para iniciar o processo de instalação, insira os dados de conexão com o seu banco de dados.</p>

            <div class="error radius" style="display: none;"></div>

            <form action="" method="post" autocomplete="off" name="connect_db">
                <input type="text" name="host" class="radius" placeholder="Host" value="localhost">
                <input type="text" name="user" class="radius" placeholder="Usuário" value="root">
                <input type="password" name="password" class="radius" placeholder="Senha">
                <input type="text" name="name" class="radius" placeholder="Banco" value="play_installer">
                <button type="submit" class="radius">Validar Conexão</button>
            </form>
        </div>

        <div class="create_user" style="display: none;">
            <img src="assets/img/logo_transparent.png">
            <div class="success radius">
                <p>&check; Sucesso na conexão com o banco de dados! <br/>O próximo passo é criar o usuário do sistema.</p>
            </div>

            <p>Insira os seus dados no formulário abaixo:</p>

            <div class="error radius" style="display: none;">
                <p>Não foi possível conectar com o banco de dados!</p>
            </div>

            <form action="" method="post" autocomplete="off" name="create_user">
                <input type="text" name="user_name" class="radius" placeholder="Nome Completo" value="Administrador">
                <input type="email" name="user_email" class="radius" placeholder="E-mail" value="admin@admin.com">
                <input type="password" name="user_password" class="radius" placeholder="Senha" value="123">
                <button type="submit" class="radius">Criar usuário</button>
            </form>
        </div>

        <div class="all_done" style="display: none;">
            <p>Instalação foi executado com sucesso...</p>
            <a href="../" class="link_all_done radius">Acessar Sistema</a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="assets/js/install.js"></script>
</body>
</html>