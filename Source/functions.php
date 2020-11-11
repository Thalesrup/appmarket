<?php


function msgCallback(bool $error,string $menssagem)
{
        $callback['error']   = $error;
        $callback['message'] = $menssagem;

        return json_encode($callback);
}

function imagemPlataforma(string $diretorio)
{
    if($diretorio == 'parametros'){
        return "/storage/imagens/plataforma/logo/";
    }
    if($diretorio == 'produtos'){
        return "/storage/imagens/produtos/";
    }
    if($diretorio == 'usuario'){
        return "/storage/imagens/plataforma/perfil/";
    }
}

