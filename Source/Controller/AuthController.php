<?php

namespace Source\Controller;
require 'Core.php';

class AuthController
{
    private $table   = 'usuario';
    private $conexap;

    public function __construct($table)
    {
        $this->conexap = new Core();
        $this->table   = $table;
    }

    public function login($dataPost)
    {
        $validaChavesDataPost = $this->validaColunasLogin($dataPost);

    }

    public function validaColunasLogin($dataPost)
    {
        if(!in_array('email', $dataPost) && !in_array('senha',$dataPost)){
            echo $this->conexap->msgCallback(true, "Necessário Informar Email e Senha");
            return;
        }
        return true;
    }

    public function criarConta(array $dataPost)
    {
        $userData = filter_var_array($dataPost, FILTER_SANITIZE_STRING);
        if (in_array("", $userData)){
            echo $this->conexap->msgCallback(true, "Necessário Preencher Todas as Informações")
            return;
        }

        $retorno = $this->conexap->inserir($this->table, $userData);

    }
}