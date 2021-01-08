<?php

namespace Source\Controller;
require 'Core.php';

class AuthController
{
    private $table          = 'usuario';
    private $tableImageBLOB = 'imagens_blob';
    private $conexao;

    public function __construct()
    {
        $this->conexao = new Core();
    }

    public function login($dataPost)
    {
        $validaChavesDataPost = $this->validaColunasLogin($dataPost);

        if($validaChavesDataPost){
            $return = $this->conexao->queryLogin($this->table, $dataPost);

            return empty($return) ? $this->conexao->msgCallback(true,"Usuário ou Senhas Inválidos")
                                  : ['error' => false, 'data' => $return];
        }
    }

    public function validaColunasLogin($dataPost)
    {
        if(!array_key_exists('email', $dataPost) && !array_key_exists('senha',$dataPost)){
            echo $this->conexao->msgCallback(true, "Necessário Informar Email e Senha");
            return;
        }
        return true;
    }

    public function criarConta(array $dataPost)
    {
        $this->conexao->inserir($this->table, $dataPost, true);
    }

    public function getUsuarios()
    {
        return $this->conexao->getAllUsuarios($this->table);
    }

    public function getImgBlob($idImagemBlob)
    {
        return $this->conexao->getImagemBLOB($this->tableImageBLOB, $idImagemBlob);
    }
}