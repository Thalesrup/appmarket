<?php

namespace Source\Controller;

require 'CoreCrud.php';

class Core extends CoreCrud {

    private $conexao;
    private $tabelaSelecionada;
    private $dbName                  = 'mercado';
    private $dbUser                  = 'root';
    private $dbPassword              = '';
    private $dbHost                  = 'localhost';
    private $contagemprodutos        = 0;
    private $nomeMercado;
    private $prazoValidade;
    private $responsavelMercado;
    private $tabelaSalvarImagensBlob = 'imagens_blob';

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

    public function inserir(string $tabela, array $data, $blob = false)
    {

        $metodoCrud = $this->definirCRUD($data);

        if($metodoCrud == 'insert'){

            $dataInsert  = $this->salvarImagem($data, $tabela, $blob);
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

    public function queryLogin($table, $dataPost)
    {
        $dataPost = is_array($dataPost) ? (object)$dataPost : $dataPost;
        $query    = "SELECT * FROM $table WHERE login = '$dataPost->login' AND senha = '$dataPost->senha'";
        return $this->conexao->getRecordFromQueryCustom($query);
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
        $result     = $this->conexao->getRecordFromQueryCustom($query, $resetArray);

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
            $this->nomeMercado        = $query['nomeMercado'] ?? 'Defina o Nome do Mercado em Configurações';
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

    public function getImagemBLOB($nomeTable, $idWhere)
    {
        $query = $this->conexao->getRecordFromQueryCustom("SELECT * FROM $nomeTable WHERE id = $idWhere", true);
        if(!empty($query)){
            return $query;
        }

        return false;
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

    public function imagemPlataforma(string $diretorio)
    {
        if($diretorio == 'parametros'){
            return "/storage/imagens/plataforma/logo/";
        }
        if($diretorio == 'produtos'){
            return "/storage/imagens/produtos/";
        }

    }

    public function salvarImagem(array $dataPost, string $tabela, $blob = false)
    {
        if(!$blob){
            define ('SITE_ROOT', realpath(dirname(__DIR__).'/../'));
            $colunaImagemTabela = $this->validaColunaImg($tabela);
            $arrayDadosImagem   = $dataPost[$colunaImagemTabela];
            $nomeArquivo        = $arrayDadosImagem['name'];
            $dirTempArquivo     = $arrayDadosImagem["tmp_name"];
            $setDiretorioImagem = $this->imagemPlataforma($tabela);

            if(!empty($nomeArquivo)){

                if(!move_uploaded_file($dirTempArquivo,
                    SITE_ROOT.$setDiretorioImagem. $nomeArquivo)){
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
        } else {
            return $this->salvarImagemBLOB($dataPost, $tabela);
        }

    }

    public function salvarImagemBLOB(array $dataPost, string $tabela)
    {
        $menssagemErrorCustom = ['error' => true ,'message' => 'Selecione Uma Outra Imagem'];
        $colunaImagemTabela   = $this->validaColunaImg($tabela);
        $arrayDadosImagem     = $dataPost[$colunaImagemTabela];
        $arquivo              = $arrayDadosImagem["tmp_name"];
        $tamanhoArquivo       = $arrayDadosImagem["size"];
        $tipoArquivo          = getimageSize($arquivo);
        $nomeArquivo          = $arrayDadosImagem["name"];
        $validaExtensao       = pathinfo($nomeArquivo, PATHINFO_EXTENSION);
        $extensaoArquivo      = is_bool($this->validaExtensaoImagem($validaExtensao)) ? explode("/", $tipoArquivo)[1] : $validaExtensao;
//die(var_dump($dataPost));
        if(is_uploaded_file($arquivo)){
            $conteudo   = file_get_contents($arquivo);

            $dataInsert = array_combine(['extensao_imagem', 'nome_imagem', 'tipo_imagem', 'arquivo_imagem'],
                                        [$extensaoArquivo, $nomeArquivo, $tipoArquivo['mime'], $conteudo]);

                $insert  = $this->conexao->insert($this->tabelaSalvarImagensBlob, $dataInsert, $returnCustom = 'id', $menssagemErrorCustom);
                unset($dataPost[$colunaImagemTabela]);
                $dataPost['id_imagens_blob'] = $insert;
                return $dataPost;

        }
    }

    public function validaExtensaoImagem(string $extensaoImagem)
    {
        $tabelaExtensoesValidas = [
            'jpg',
            'jpeg',
            'jpe',
            'gif',
            'bmp',
            'png'
        ];

        return array_search($extensaoImagem, $tabelaExtensoesValidas);
    }

    public function validaColunaImg(string $tabela)
    {
        if($tabela == 'produtos'){
            return 'srcImagemProduto';
        }
        if($tabela == 'parametros'){
            return 'imgLogoMercado';
        }
        if($tabela == 'usuario'){
            return 'imgPerfilUsuarioBlob';
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

    public function getLogin(string $table,array $dataPost)
    {
        $query      = "SELECT * FROM $nomeTabela WHERE email = {$dataPost->email} AND senha = {$dataPost->senha}";
        $result     = $this->conexao->getRecordFromQueryCustom($query, true);

        if(!$result){
            echo $this->msgCallback(true, "Usuário ou Senha Incorretos");
            exit;
        }

        return $result;
    }

}
