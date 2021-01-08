<?php
/**
 * Created by PhpStorm.
 * User: Thales Ruppenthal
 * Date: 03/11/2020
 */

$postData         = filter_input_array(INPUT_POST, FILTER_DEFAULT);
$nomeArquivoBanco = 'mercado.sql';

$action = $postData['action'];
unset($postData['action']);

switch ($action) {
    case 'connect_db':

        try {
            $dsn = 'mysql:host=' . $postData['host'] . ';dbname=' . $postData['name'];
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];

            $connect = new PDO($dsn, $postData['user'], $postData['password'], $options);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $json['error'] = $e->getMessage();
            break;
        }

        if(!file_exists($nomeArquivoBanco)){
            $json['error'] = "O arquivo {$nomeArquivoBanco} não está presente no diretório de instalação!";
            break;
        }

        $tempLinha = '';
        $fileDump = file($nomeArquivoBanco);

        try {
            foreach ($fileDump as $linha) {
                // Pula Os Comentários Evitando Erros
                if (substr($linha, 0, 2) == '--' || $linha == '')
                    continue;

                    $tempLinha .= $linha;

                if (substr(trim($linha), -1, 1) == ';') {
                    $connect->query($templine);
                    $tempLinha = '';
                }
            }
        } catch (PDOException $e) {
            $json['error'] = $e->getMessage();
            break;
        }

        $contentFile = "<?php " . PHP_EOL . PHP_EOL . "define('HOST', '{$postData['host']}');" . PHP_EOL . "define('USER', '{$postData['user']}');" . PHP_EOL . "define('PASS', '{$postData['password']}');" . PHP_EOL . "define('NAME', '{$postData['name']}');" . PHP_EOL;

        file_put_contents('../dbconn.php', $contentFile);

        $json['success'] = true;
        break;

    case 'create_user':

        require_once __DIR__ . '/../dbconn.php';

        try {
            $dsn = 'mysql:host=' . HOST . ';dbname=' . NAME;
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];

            $connect = new PDO($dsn, USER, PASS, $options);
            $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $json['error'] = $e->getMessage();
            break;
        }

        try {
            $connect->exec("INSERT INTO users (user_name, user_email, user_password) VALUES ('{$postData['user_name']}', '{$postData['user_email']}', '{$postData['user_password']}')");
        } catch (PDOException $e) {
            $json['error'] = $e->getMessage();
            break;
        }

        $json['success'] = true;
        break;
}

echo json_encode($json);