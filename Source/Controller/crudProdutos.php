<?php

namespace Source\Controller;
require 'Core.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $acaoRequisicao = empty($_FILES) ? $_POST : array_merge($_POST, $_FILES);
    $core           = new Core();

    $retorno        = $core->inserir('produtos', $acaoRequisicao);
    return $retorno;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    setAcao($_GET);
}

function setAcao($acao)
{
    if(array_key_exists ('pagina', $acao)){
        paginator(addslashes($acao['pagina']), 'produto');
    }
    if(array_key_exists('update', $acao)){
        getDadosById($acao['update']);
    }
    if(array_key_exists('paginaHome', $acao)){
        paginator($acao['paginaHome'], 'home');
    }
    if(array_key_exists('deletarProduto', $acao)){
        delete($acao);
    }
}

function paginator($pagina, $local)
{
    $core               = new Core();

    if($local == 'produto'){
        $quantidadeProdutos = $core->contagemProdutosTotais()['total'];
        $paginas            = $quantidadeProdutos / 10;

        $page   = $pagina;
        $offset = 10;

        $limit  = ($page - 1) * 10;

        $resultado = $core->listarProdutos($limit, $offset);
        renderListaProdutos($resultado);
    }

    if($local == 'home'){

        $core->getParametros('parametros');
        $produtosVencidosExpirando   = $core->getProdutosValidadeVencidos('produtos');
        $paginas                     = count($produtosVencidosExpirando) / 10;

        $page   = $pagina;
        $offset = 10;

        $limit  = ($page - 1) * 10;

        $resultado = $core->listarProdutosVencidosExpirando($limit, $offset);

    }

}

function getDadosById($id)
{
    $core         = new Core();
    $dadosProduto = $core->getById('produtos', $id);

    if(empty($dadosProduto)){
        echo $core->msgCallback(true, "Não Foram Encontrados Dados sobre este produto");
        return;
    }

    renderizaModalUpdate($dadosProduto);
}

function renderListaProdutos(array $listaProdutos)
{
    $tabela = '';
    foreach($listaProdutos as $produto){
        $tabela .= '<tr>
                                <th scope="row">'.$produto['id'].'</th>
                                <td class="text-center">'.$produto['nome'].'</td>
                                <td class="text-center">'.$produto['id_categoria'].'</td>
                                <td class="text-center">'.$produto['dataCompra'].'</td>
                                <td class="text-center">'.$produto['dataValidade'].'</td>
                                <td class="text-center">'.$produto['valorUnitario'].'</td>
                                <td class="text-center">
                                    <button type="button" onclick="editarProduto('.$produto['id'].')" id="btn-editar-produto"  data-value="'.$produto['id'].'" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-editar-produto">Editar</button>
                                    <button type="button" onclick="excluirProduto('.$produto['id'].')" id="btn-excluir-produto" data-value="'.$produto['id'].'" class="mb-2 mr-2 btn-transition btn btn-outline-danger btn-excluir-produto">Excluir</button>
                                </td>
                            </tr>';
    }
    echo json_encode($tabela);
    return;
}

function renderizaModalUpdate($arrayDadosProduto)
{
    $modal = '';
    foreach($arrayDadosProduto as $produto){
        $modal .= '<div class="modal-header">
                            <h4 class="modal-title">Editar Produto '.$produto['nome'].'</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label" for="nomeProduto">Nome</label>
                                                <input  name="nome" id="nomeProduto" value="'.$produto['nome'].'" type="text" class="form-control" placeholder="Nome Produto..." />
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="categoriaProduto">Categoria</label>
                                                <select name="id_categoria" id="categoriaProduto" class="form-control">
                                                    <option value="'.$produto['id_categoria'].'">Bebidas</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="imgProduto">Imagem</label>
                                                <input name="srcImagemProduto" type="file" class="form-control-file" id="imgProduto">
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valorProduto">Valor Unitário</label>
                                                <input name="valorUnitario" value="'.$produto['valorUnitario'].'" id="valorProduto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control"/>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="dataCompra">Data Compra</label>
                                                <input name="dataCompra" value="'.$produto['dataCompra'].'" type="date" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="codigoBarras">Cod. Barras</label>
                                                <input name="codigoBarras" value="'.$produto['descricao'].'" type="text" class="form-control" style="min-width:370px;">
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="qtdProduto">Quantidade</label>
                                                <input name="quantidade" value="'.$produto['quantidade'].'" id="qtdProduto" type="number" placeholder="" class="form-control" value="1"/>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="dataValidade">Validade</label>
                                                <input name="dataValidade" value="'.$produto['dataValidade'].'" type="date" class="form-control">
                                            </div>

                                        </div>

                                            <div class="col-md-6 offset-md-5">
                                                <label class="form-label" for="descricao">Descrição</label>
                                                <textarea name="descricao" value="'.$produto['descricao'].'" class="form-control" id="descricao" rows="3"></textarea>
                                            </div>
                                            <input name="id" value="'.$produto['id'].'" hidden>
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Fechar">
                            <button id="btn-atualizar-produto" class="btn btn-atualizar-produto btn-danger">
                                Atualizar
                            </button>
                        </div>';
    }

    echo json_encode($modal);
    return;
}

function renderListaVencidosExpirando(array $arrayVencidosExpirados)
{
    $tabela = '';
    foreach($arrayVencidosExpirados as $produto){
        $tabela .= '<tr>
                                <th scope="row">'.$produto['id'].'</th>
                                <td class="text-center">'.$produto['nome'].'</td>
                                <td class="text-center">'.$produto['id_categoria'].'</td>
                                <td class="text-center">'.$produto['dataCompra'].'</td>
                                <td class="text-center">'.$produto['dataValidade'].'</td>
                                <td class="text-center">'.$produto['valorUnitario'].'</td>
                                <td class="text-center">
                                    <button type="button" onclick="editarProduto('.$produto['id'].')" id="btn-editar-produto"  data-value="'.$produto['id'].'" id="btn-editar-produto" class="mb-2 mr-2 btn-transition btn btn-outline-primary btn-editar-produto">Editar</button>
                                    <button type="button" id="btn-excluir-produto" data-value="'.$produto['id'].'" class="mb-2 mr-2 btn-transition btn btn-outline-danger btn-excluir-produto">Excluir</button>
                                </td>
                            </tr>';
    }

    echo json_encode($tabela);
    return;
}



