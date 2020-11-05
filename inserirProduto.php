
<div class="app-main__outer">
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-display1 icon-gradient bg-premium-dark">
                        </i>
                    </div>
                    <div>Inserir Produto
                        <div class="page-title-subheading">Produto
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content">
            <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                <div class="row">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Cadastrar Produto</h5>
                                <form id="ajax_form" action="" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label" for="nomeProduto">Nome</label>
                                                <input  name="nome" id="nomeProduto" type="text" class="form-control" placeholder="Nome Produto..."/>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="categoriaProduto">Categoria</label>
                                                <select name="id_categoria" id="categoriaProduto" class="form-control">
                                                    <option value="1">Bebidas</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="imgProduto">Imagem</label>
                                                <input name="srcImagemProduto" type="file" class="form-control-file" id="imgProduto">
                                                <br>
                                                <div class="card card-previa" style="width: 15rem;" hidden>
                                                    <div class="card-body">
                                                        <h4>Prévia</h4>
                                                        <img id="previaImgEscolhida" src="#" alt="Imagem Selecionada" />
                                                        <p></p>
                                                        <a href="" class="card-link card-descartar">Descartar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="valorProduto">Valor Unitário</label>
                                                <input name="valorUnitario" id="valorProduto" onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="text" class="form-control"/>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="dataCompra">Data Compra</label>
                                                <input name="dataCompra" type="date" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="codigoBarras">Cod. Barras</label>
                                                <input name="codigoBarras" type="text" class="form-control" style="min-width:378px;">
                                            </div>


                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label" for="qtdProduto">Quantidade</label>
                                                <input name="quantidade" id="qtdProduto" type="number" placeholder="" class="form-control" value="1"/>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="dataValidade">Validade</label>
                                                <input name="dataValidade" type="date" class="form-control">
                                            </div>

                                        </div>

                                            <div class="col-md-6 offset-md-5">
                                                <label class="form-label" for="descricao">Descrição</label>
                                                <textarea name="descricao" class="form-control" id="descricao" rows="3"></textarea>
                                            </div>

                                    </div>
                                    <button id="btnEnviar" class="mt-1 btn btn-primary">Cadastrar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="./assets/scripts/inserirProduto.js"></script>
<script>
    $(document).ready(function(){
        var imagemInput    = $('#imgProduto');
        var descartar      = $('.card-descartar');
        var cardPrevia     = $('.card-previa');

        imagemInput.change(function(){
            var input = $(this);
            console.log(input[0].files[0]);
            if (input[0].files && input[0].files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#previaImgEscolhida')
                        .attr('src', e.target.result)
                        .width(200)
                        .height(200);
                };

                $('.card-previa').removeAttr('hidden', true);
                reader.readAsDataURL(input[0].files[0]);
            }
        });

        descartar.click(function(evento){
            evento.preventDefault();
            imagemInput.val('');
            cardPrevia.attr('hidden', true);
        });

    });
</script>
