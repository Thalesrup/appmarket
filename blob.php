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
    $cuzin = $exComando->fetchAll(\PDO::FETCH_ASSOC)[0];
//        var_dump($cuzin);
        $tipo     = $cuzin['tipo_imagem'];
        $conteudo = $cuzin['arquivo_imagem'];
        header("Content-type: " . $cuzin['tipo_imagem']);
        echo $conteudo;

} catch (PDOException $erro) {
    echo("Errrooooo! foi esse: " . $erro->getMessage());
}

