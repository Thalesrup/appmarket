<div class="app-header header-shadow">
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
    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>
            <ul class="header-menu nav">
                <li class="nav-item">
                    <a href="javascript:void(0);" class="nav-link">
                        <i class="nav-link-icon fa fa-database"> </i>
                        Estatísticas
                    </a>
                </li>
                <li class="dropdown nav-item">
                    <a href="javascript:void(0);" class="nav-link btn-parametros">
                        <i class="nav-link-icon fa fa-cog"></i>
                        Configurações
                    </a>
                </li>
            </ul>        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    <img width="42" class="rounded-circle" src="assets/images/avatars/1.jpg" alt="">
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                    <button type="button" tabindex="0" class="dropdown-item">Perfil</button>
                                    <button type="button" tabindex="0" class="dropdown-item">Configurações</button>
                                    <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                    <button type="button" tabindex="0" class="dropdown-item">Ações</button>
                                    <div tabindex="-1" class="dropdown-divider"></div>
                                    <button type="button" tabindex="0" class="dropdown-item">Logs</button>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                Alina Mclourd
                            </div>
                            <div class="widget-subheading">
                                Área Usuário
                            </div>
                        </div>
                        <div class="widget-content-right header-user-info ml-3">
                            <button type="button" class="btn-shadow p-1 btn btn-primary btn-sm show-toastr-example">
                                <i class="fa text-white fa-calendar pr-1 pl-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var btnModalParametros  = $('.btn-parametros');
        var btnSalvarParametros = $('#btn-atualizar-parametros');
        var formParametros      = $('#form-parametros');
        var actionget           = "Source/Controller/crudParametros.php?getParametros";

        btnModalParametros.click(function(evento){
            evento.preventDefault();

            $.ajax({
                type: 'GET',
                url: actionget,
                contentType: false,
                // cache: false,
                processData:false,
                dataType: 'json',
                beforeSend: function(){
                    load('open');
                },
                success: function(callback){
                    $('#form-parametros').html(callback);
                    $('#modalParametros').modal('show');
                },
                complete: function(){
                    load('close');
                }
            });

        });

        formParametros.submit(function(evento){
            evento.preventDefault();
            var formData = new FormData(document.getElementById("form-parametros"));
            var action   = "Source/Controller/crudParametros.php";

            $.ajax({
                type: 'POST',
                url: action,
                data: formData,
                contentType: false,
                // cache: false,
                processData:false,
                dataType: 'json',
                beforeSend: function(){
                    load("open");
                },
                success: function(callback){

                    if (callback.error){
                        console.log(callback);
                        msgErro('Falha', callback.message);
                    }

                    if (!callback.error){
                        $('.btn-fechar-parametros').click(); // Gambiarra pra forçar fechar modal
                        msgSucesso('Sucesso', callback.message);
                    }
                },
                complete: function(){
                    load("close");
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

        function msgSucesso(title ,msgBody){
            $.confirm({
                title: title,
                content: msgBody,
                type: 'blue',
                buttons: {
                    sim: {
                        text: 'Ok',
                        btnClass: 'btn-info',
                        action: function(){

                        }
                    }
                }
            });
        }

        function msgErro(title ,msgBody){
            $.dialog({
                title: title,
                content: msgBody,
                type: 'red',
            });
        }

    });
</script>