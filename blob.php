<?php
$servidor = 'localhost';
$banco    = 'mercado';
$usuario  = 'root';
$senha    = '';


try {
    $conecta     = new \PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $consultaSQL = "SELECT * FROM imagens_blob WHERE id = 1";
    $exComando   = $conecta->prepare($consultaSQL);
    $exComando->execute();
    $c = $exComando->fetchAll(\PDO::FETCH_ASSOC)[0];
//        var_dump($c);
        $tipo     = $c['tipo_imagem'];
        $conteudo = $c['arquivo_imagem'];
        header("Content-type: " . $c['tipo_imagem']);
        echo $conteudo;

} catch (PDOException $erro) {
    echo("Errrooooo! foi esse: " . $erro->getMessage());
}

