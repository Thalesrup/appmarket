<?php

namespace Source\Controller;

class Tabela
{
    protected $conexao;

    public function __construct()
    {
        try {
            $conn = new \mysqli('localhost', 'root', '', 'mercado');
            $this->conexao = $conn;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
    }
}