
<div class="app-main__outer">
    <div class="app-main__inner imagem_bg">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-tools icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Dashboard <?php echo $nomeMercado; ?>
                        <div class="page-title-subheading">Painel para Gerenciar Vendas e Estoque
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Produtos</div>
                                <div class="widget-subheading">Total de Produtos</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-success"><?php echo $quantidadeProdutos ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Validade Expirando dentro de <?php echo $prazoValidade; ?></div>
                                <div class="widget-subheading">Total de Produtos com Este Filtro</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-warning"><?php echo count($quantidadeProdutosExpirando); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-4">
                <div class="card mb-3 widget-content">
                    <div class="widget-content-outer">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="widget-heading">Passarm da Validade</div>
                                <div class="widget-subheading">Quantidade de Produtos Vencidos</div>
                            </div>
                            <div class="widget-content-right">
                                <div class="widget-numbers text-danger"><?php echo count($produtosVencidosExpirando) - count($quantidadeProdutosExpirando);  ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">Listagem dos Produtos em Estoque Prestes a Vencer ou Vencidos</h5>
                    <table id="tabelaProdutos" class="mb-0 table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-center">Nome</th>
                            <th class="text-center remover">Categoria</th>
                            <th class="text-center remover">Data Compra</th>
                            <th class="text-center remover">Data Vencimento</th>
                            <th class="text-center remover">Valor Unitário</th>
                            <th class="text-center">Situação</th>
                        </tr>
                        </thead>
                        <tbody id="corpo-tabela-produtos-vencidos-expirando">
                        <?php
                        if(count($produtosVencidosExpirando) > 0){
                            $quantidadeProdutos = 0;
                            foreach($produtosVencidosExpirando as $produto){
                                $quantidadeProdutos++;
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $produto['id'] ?></th>
                                    <td class="text-center "><?php echo $produto['nome'] ?></td>
                                    <td class="text-center remover"><?php echo $produto['id_categoria'] ?></td>
                                    <td class="text-center remover"><?php echo $produto['dataCompra'] ?></td>
                                    <td class="text-center remover"><?php echo $produto['dataValidade'] ?></td>
                                    <td class="text-center remover"><?php echo $produto['valorUnitario'] ?></td>
                                    <td class="text-center ">
                                        <span class="badge <?php echo (isset($produto['vencido'])) ? 'badge-danger' : 'badge-warning';?>">
                                            <?php echo (isset($produto['vencido'])) ? 'Vencido' : 'Expirando' ; ?>
                                        </span>
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

        <div class="row">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-header">Usuários Ativos
                        <div class="btn-actions-pane-right"></div>
                    </div>
                    <div class="table-responsive">
                        <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Nome</th>
                                <th class="text-center">Cidade</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Ação</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-center text-muted">1</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    <img width="40" class="rounded-circle" src="assets/images/avatars/4.jpg" alt="">
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">Gustavo</div>
                                                <div class="widget-subheading opacity-7">Proprietário</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">Florianópolis</td>
                                <td class="text-center">
                                    <div class="badge badge-success">Ativo</div>
                                </td>
                                <td class="text-center">
                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Editar</button>
                                    <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm">Excluir</button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        let pagina;

        if (WURFL.is_mobile === true && WURFL.form_factor === "Smartphone") {
            console.log('acesso mobile');
            $('.remover').remove();
        } else {
            console.log('Acesso Web');
        }

        $('.page-link').on('click', function(evento){
            evento.preventDefault();
            pagina      = $(this).data().value;
            var target  = $(this);

            $('li').removeClass('active');
            target.parent().addClass('active');

            var action   = "Source/Controller/crudProdutos.php?paginaHome="+pagina;

            $.ajax({
                type: 'GET',
                url: action,
                contentType: false,
                // cache: false,
                processData:false,
                dataType: 'json',
                beforeSend: function(){
                    load('open');
                },
                success: function(callback){
                    $('#corpo-tabela-produtos-vencidos-expirando').html('');
                    $('#corpo-tabela-produtos-vencidos-expirando').html(callback);
                },
                complete: function(){
                    load('close');
                    $('#btn-editar-produto').unbind("click")
                }
            });

        });

        function load(action){
            var load_div = $(".ajax_load");
            if (action === "open") {
                load_div.fadeIn().css("display", "flex");
            } else {
                load_div.fadeOut();
            }
        }
    });
</script>
