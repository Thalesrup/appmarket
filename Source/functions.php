<?php


function msgCallback(bool $error,string $menssagem)
{
        $callback['error']   = $error;
        $callback['message'] = $menssagem;

        return json_encode($callback);
}

