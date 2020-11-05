<?php

use Source\Controller\Core;
require 'Source\Controller\Core.php';

$core               = new Core();
$quantidadeProdutos = $core->contagemProdutosTotais()['total'];
$paginas            = $quantidadeProdutos / 10;

$page   = '1';
$offset = 10;

$limit = ($page - 1) * 10;

$listagemProdutos   = $core->listarProdutos($limit, $offset);

?>

<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-display1 icon-gradient bg-premium-dark">
                        </i>
                    </div>
                    <div>Listar Produtos
                        <div class="page-title-subheading"><?php echo "Total de Produtos : " .$quantidadeProdutos?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">Listagem dos Produtos em Estoque</h5>
                        <table id="tabelaProdutos" class="mb-0 table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th  class="text-center">Nome</th>
                                <th class="text-center">Categoria</th>
                                <th class="text-center">Data Compra</th>
                                <th class="text-center">Data Vencimento</th>
                                <th class="text-center">Valor Unitário</th>
                                <th class="text-center">Ações</th>
                            </tr>
                            </thead>
                            <tbody id="corpo-tabela-produtos">
                            <?php
                                if(count($listagemProdutos) > 0){
                                    $quantidadeProdutos = 0;
                                    foreach($listagemProdutos as $produto){
                                        $quantidadeProdutos++;
                            ?>
                            <tr>
                                <th scope="row"><?php echo $produto['id'] ?></th>
                                <td class="text-center"><?php echo $produto['nome'] ?></td>
                                <td class="text-center"><?php echo $produto['id_categoria'] ?></td>
                                <td class="text-center"><?php echo $produto['dataCompra'] ?></td>
                                <td class="text-center"><?php echo $produto['dataValidade'] ?></td>
                                <td class="text-center"><?php echo $produto['valorUnitario'] ?></td>
                                <td class="text-center">
                                    <button type="button" data-value="<?php echo $produto['id']; ?>" id="btn-editar-produto" onclick="editarProduto(<?php echo $produto['id']; ?>)" class="mb-2 mr-2 btn-transition btn btn-outline-primary">Editar</button>
                                    <button type="button" id="btn-excluir-produto" class="mb-2 mr-2 btn-transition btn btn-outline-danger">Excluir</button>
                                </td>
                            </tr>
                            <?php
                                }
                            } else {
                                ?>
                            <tr><td colspan="6" align="center">Não Foram Encontrados Registros</td></tr>
                            <?php
                                }
                            ?>
                            </tbody>
                        </table>
                        <br>
                        <nav>
                            <ul class="pagination justify-content-center">
                                <?php for($page = 0;$page<$paginas;$page++){
                                    echo '<li class="page-item"><a data-value="'.($page+1).'" class="page-link" href="">'.($page+1).'</a></li>';
                                } ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
         </div>
    </div>
</div>
<script src="./assets/scripts/listarProdutos.js"></script>
<script>
    $(document).ready(function(){
        if (WURFL.is_mobile === true && WURFL.form_factor === "Smartphone") {
            console.log('acesso mobile');
            $('#tabelaProdutos').addClass('table-responsive');
        } else {
            console.log('Acesso Web');
        }
    });
</script>