<?php

namespace Source\Controller;

class Tabelas {

    private $tabelaSelecionada;

    public function __construct(string $nomeTabela)
    {
        $this->tabelaSelecionada = $nomeTabela;
    }

    public function resgatarTabela()
    {
        if($this->tabelaSelecionada == 'produtos'){
            return $this->tabelaProdutos();
        } else {
            echo msgCallback(true, 'Tabela Informada Não Encontrada');
        }

    }

    public function tabelaProdutos()
    {
        $colunasTabela = 'nome, id_categoria, dataCompra, dataValidade, srcImagemProduto, valorUnitario, quantidade, codigoBarras, descricao';
        return $colunasTabela;
    }

}
