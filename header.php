<?php

use Source\Controller\Core;
require_once ('Source\Controller\Core.php');

$core               = new Core();
$quantidadeProdutos = $core->contagemProdutosTotais()['total'];
$core->getParametros('parametros');
$totalDeVendas      = 0;
$nomeMercado        = $core->getNomeMercado();
$prazoValidade      = $core->getValidade();
$responsavelMercado = $core->getResponsavelMercado();
$produtosExpirando  = $core->getProdutosValidade('produtos', true);
$quantidadeProdutosExpirando = $core->getProdutosValidade('produtos', false);
$produtosVencidosExpirando   = $core->getProdutosValidadeVencidos('produtos');

$paginas            = count($produtosVencidosExpirando) / 10;

$page   = '1';
$offset = 10;

$limit = ($page - 1) * 10;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo $nomeMercado; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="Sistema Web Gestão Mini-Mercado">
    <meta name="msapplication-tap-highlight" content="no">
    <link href="main.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" href="./assets/css/loadin_ajax.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
    <script src="./assets/scripts/quagga.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//wurfl.io/wurfl.js"></script>
</head>
