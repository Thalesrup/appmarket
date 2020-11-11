<?php require __DIR__ . "./vendor/autoload.php"; ?>
<?php include_once("header.php"); ?>

<body>
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" >

        <?php include_once("indexHome.php"); ?>
        <!---- Modal do Update de Produtos ---->
        <div id="modalUpdateProduto" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-update-produto" method="post" enctype="multipart/form-data">

                    </form>
                </div>
            </div>
        </div>
        <!---- Fim Modal do Update de Produtos ---->

        <!---- Modal Parametros ---->
        <div id="modalParametros" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="form-parametros" method="" enctype="multipart/form-data">

                    </form>
                </div>
            </div>
        </div>
        <!---- Fim Modal Parametros ---->

        <div id="divApp" class="app-main">

            <div class="app-main__inner">
                <?php include_once("menu.php"); ?>
        <div id="teste" class="app-main">
                <?php include_once("dashboardHome.php"); ?>
        </div>
            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
            <script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
            <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
            <script src="./assets/scripts/editarProduto.js"></script>
            </div>
    </div>
<script type="text/javascript" src="./assets/scripts/main.js"></script>
    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <div class="ajax_load_box_title">Aguarde, carregando!</div>
        </div>
    </div>
</body>

