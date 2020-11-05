<script>

    $(document).ready(function(){

        var btnInserirProduto = $('#btn-inserir-produto');
        var btnListarProduto  = $('#btn-listar-produto');
        var btnInserirUsuario = $('#btn-inserir-usuario');
        var btnListarUsuarios = $('#btn-listarUsuarios');
        var btnIndex   = $('#btn-index');
        var divApp     = $('#teste');

        btnInserirProduto.click(function(evento){
            evento.preventDefault();
            removerEfeitoNegritoOpcaoSelecionada();
            $(this).addClass("mm-active");
            divApp.load("inserirProduto.php");
        });

        btnListarProduto.click(function(evento){
            evento.preventDefault();
            removerEfeitoNegritoOpcaoSelecionada();
            $(this).addClass("mm-active");
            divApp.load("listarProdutos.php");
        });

        function removerEfeitoNegritoOpcaoSelecionada(){
            console.log('Limpar Negrito da Anterior');
            var botoes = $('a');
            botoes.removeClass("mm-active");
        }


    });

</script>
<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                        <span>
                            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Painel</li>
                <li>
                    <a id="btn-index" href="index.php" class="mm-active">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Home
                    </a>
                </li>
                <li class="app-sidebar__heading">Categorias</li>
                <li>
                    <a id="btn-inserir-categorias" href="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Inserir
                    </a>
                </li>
                <li>
                    <a id="btn-listar-categorias" href="">
                        <i class="metismenu-icon pe-7s-rocket"></i>
                        Listar
                    </a>
                </li>
                <li class="app-sidebar__heading">Produtos</li>
                <li>
                    <a  id="btn-inserir-produto" href="">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Inserir
                    </a>
                </li>
                <li>
                    <a id="btn-listar-produto" href="">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Listar
                    </a>
                </li>
                <li class="app-sidebar__heading">Usuários</li>
                <li>
                    <a id="btn-inserir-usuario" href="">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Inserir
                    </a>
                </li>
                <li>
                    <a id="btn-listar-usuarios" href="">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Listar
                    </a>
                </li>
                <li class="app-sidebar__heading">Relatórios</li>
                <li>
                    <a id="btn-gerar-relatorios" href="">
                        <i class="metismenu-icon pe-7s-display2"></i>
                        Gerar
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>