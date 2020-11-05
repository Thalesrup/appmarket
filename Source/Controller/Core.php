<?php

namespace Source\Controller;
use phpDocumentor\Reflection\Types\Boolean;

require 'CoreCrud.php';

class Core {

    protected $conexao;
    protected $tabelaSelecionada;
    protected $dbName             = 'mercado';
    protected $dbUser             = 'root';
    protected $dbPassword         = '';
    protected $dbHost             = 'localhost';
    protected $contagemprodutos   = 0;
    protected $nomeMercado;
    protected $prazoValidade;
    protected $responsavelMercado;

    public function __construct()
    {
        $dsn	= 	"mysql:dbname=".$this->dbName.";host=".$this->dbHost."";
        $pdo	=	"";
        try {
            $pdo = new \PDO($dsn, $this->dbUser, $this->dbPassword);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            return null;
        }
        $this->conexao = new CoreCrud($pdo);
    }

    public function fecharConexao() {
        try {
            mysqli_close($this->conexao);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    public function inserir(string $tabela, array $data)
    {

        $metodoCrud = $this->definirCRUD($data);

        if($metodoCrud == 'insert'){

            $dataInsert  = $this->salvarImagem($data, $tabela);
            $insert      = $this->conexao->insert($tabela, $dataInsert);

            if(!$insert){
                echo $this->msgCallback(true, "Erro Ao Salvar Produto");
                return;
            }

            echo $this->msgCallback(false,"Registro Salvo com Sucesso");
            return;

        }

        if($metodoCrud == 'update'){

            $id          = $data['id'];
            $dataInsert  = $this->salvarImagem($data, $tabela);
            $update      = $this->conexao->update($tabela, $dataInsert, ['id' => $id]);

            if(!$update){
                echo $this->msgCallback(true, "Erro Ao Salvar Produto");
                return;
            }

            echo $this->msgCallback(false,"Registro Atualizado com Sucesso");
            return;

        }

        $this->fecharConexao();
        
    }

    public function listarProdutos($limit = 0, $offset = 10)
    {
        $listagemProdutos =	$this->conexao->getRecordsForPagination('*','produtos','', $limit, $offset);
        return $listagemProdutos;
    }

    public function getById($nomeTabela, $idProduto)
    {
        $retorno = $this->conexao->getDataById($nomeTabela, $idProduto);
        return $retorno;
    }

    public function listarProdutosVencidosExpirando($limit = 0, $offset = 10)
    {
        $dataAtual  = (new \DateTime())->format('Y-m-d');
        $dataFiltro = (new \DateTime())->add(new \DateInterval('P'.$this->prazoValidade.'D'))->format('Y-m-d');
        $where      = "WHERE dataValidade BETWEEN '$dataAtual' AND '$dataFiltro'";

        $listagemProdutos =	$this->conexao->getRecordsForPagination('*','produtos',$where, $limit, $offset);
        return $listagemProdutos;
    }

    public function contagemProdutosTotais()
    {
         return $this->contagemprodutos = $this->conexao->getQueryCount('produtos', 'id');
    }

    public function getProdutosValidade(string $nomeTabela,bool $resetArray)
    {
        $dataAtual  = (new \DateTime())->format('Y-m-d');
        $dataFiltro = (new \DateTime())->add(new \DateInterval('P'.$this->prazoValidade.'D'))->format('Y-m-d');

        $query      = "SELECT * FROM $nomeTabela WHERE dataValidade BETWEEN '$dataAtual' AND '$dataFiltro'";
        $result = $this->conexao->getRecordFromQueryCustom($query, $resetArray);

        return $result;

    }

    public function getProdutosValidadeVencidos(string $nomeTabela)
    {
        $dataAtual  = (new \DateTime())->format('Y-m-d');
        $dataFiltro = (new \DateTime())->add(new \DateInterval('P'.$this->prazoValidade.'D'))->format('Y-m-d');

        $query      = "SELECT * FROM $nomeTabela WHERE dataValidade BETWEEN '$dataAtual' AND '$dataFiltro' OR dataValidade <= '$dataAtual'";

        $resultadoQuery = $this->conexao->getRecordFromQueryCustom($query);
        $validaVencidos = $this->validaVencidos($resultadoQuery);

        return $validaVencidos;
    }

    public function validaVencidos(array $dadosProdutos)
    {
        $dataAtual  = (new \DateTime())->format('Y-m-d');

        foreach($dadosProdutos as $chave => $produtos){
            if(is_array($produtos)){
                foreach($produtos as $coluna => $valor){
                    if($coluna == 'dataValidade'){
                        if(strtotime($valor) <= strtotime($dataAtual)){
                            $dadosProdutos[$chave]['vencido'] = true;
                        }
                    }
                }
            }
        }

        return $dadosProdutos;

    }

    public function getParametros(string $nomeTabela,$retornoQuery = false)
    {
        $query = $this->conexao->getRecordFromQueryCustom("SELECT * FROM $nomeTabela", true);

        if(!empty($query) && !$retornoQuery){
            $this->nomeMercado        = $query['nomeMercado'] ?? 'Nome Não Informado';
            $this->prazoValidade      = $query['filtroValidade'] ?? '';
            $this->responsavelMercado = $query['usuarioResponsavel'] ?? 'Responsável Não Informado';
        }

        if($retornoQuery && !empty($query)){
            return $query;
        }

    }

    public function getAllUsuarios(string $nomeTabela)
    {
        $query = $this->conexao->getRecordFromQueryCustom("SELECT * FROM $nomeTabela", false);

        if(!empty($query)){
            return $query;
        }

        echo $this->msgCallback(true, "Erro Ao Obter Lista de Usuários ");
        return;

    }


    public function getValidade()
    {
        return $this->prazoValidade;
    }

    public function getNomeMercado()
    {
        return $this->nomeMercado;
    }

    public function getResponsavelMercado()
    {
        return $this->responsavelMercado;
    }

    public function salvarImagem(array $dataPost, string $tabela)
    {
        define ('SITE_ROOT', realpath(dirname(__DIR__).'/../'));
        $colunaImagemTabela = $this->validaColunaImg($tabela);
        $arrayDadosImagem   = $dataPost[$colunaImagemTabela];
        $nomeArquivo        = $arrayDadosImagem['name'];
        $dirTempArquivo     = $arrayDadosImagem["tmp_name"];

        if(!empty($nomeArquivo)){

            if(!move_uploaded_file($dirTempArquivo,
                SITE_ROOT.'/storage/imagens/produtos/'. $nomeArquivo)){
                return false;
            }

            unset($dataPost[$colunaImagemTabela]);
            $dataPost[$colunaImagemTabela] = $nomeArquivo;

            return $dataPost;

        } else {

            unset($dataPost[$colunaImagemTabela]);
            $dataPost[$colunaImagemTabela] = null;

            return $dataPost;
        }

    }

    public function validaColunaImg(string $tabela)
    {
        if($tabela == 'produtos'){
            return 'srcImagemProduto';
        }
        if($tabela == 'parametros'){
            return 'imgLogoMercado';
        }
    }

    public function definirCRUD(array $data)
    {

        if(array_key_exists('id', $data)){
            return 'update';
        } else {
            return 'insert';
        }
    }


    public function tabelaProdutos()
    {
        $colunasTabela = 'nome, id_categoria, dataCompra, dataValidade, valorUnitario, quantidade, codigoBarras, descricao, srcImagemProduto';
        return $colunasTabela;
    }

    public function msgCallback(bool $error,string $menssagem)
    {
        $callback['error']   = $error;
        $callback['message'] = $menssagem;

        return json_encode($callback);
    }

}
