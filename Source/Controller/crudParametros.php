<?php

namespace Source\Controller;
require 'Core.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $acaoRequisicao = empty($_FILES) ? $_POST : array_merge($_POST, $_FILES);
    $core           = new Core();

    $retorno        = $core->inserir('parametros', $acaoRequisicao);
    return $retorno;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    setAcao($_GET);
}

function setAcao($acao)
{
    if(array_key_exists('getParametros', $acao)){
        getParametrosRender();
    }

}

function getParametrosRender()
{
    $core            = new Core();
    $dadosParametros = $core->getParametros('parametros', true);

    renderizaModalParametros($dadosParametros);
}


function renderizaModalParametros($parametro)
{

        $selecOptions = getListUsuarios($parametro['usuarioResponsavel']);

        $modal        = '<div class="modal-header">
                            <h4 class="modal-title">Parametros Utilizados no Sistema</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                        <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="form-label" for="nomeMercado">Nome Mercado</label>
                                                <input  name="nomeMercado" id="nomeMercado" value="'.$parametro['nomeMercado'].'" type="text" class="form-control" placeholder="Nome Produto..." />
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="usuarioResponsavel">Responsável</label>
                                                <select name="usuarioResponsavel" id="usuarioResponsavel" class="form-control">
//                                                   '.$selecOptions.'
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="imgLogoMercado">Logo Mercado</label>
                                                <input name="imgLogoMercado" type="file" class="form-control-file" id="imgLogoMercado">
                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                        
                                            <div class="form-group">
                                                <label for="filtroValidade">Filtro Validade Minima (Dias)</label>
                                                <input name="filtroValidade" value="'.$parametro['filtroValidade'].'" id="filtroValidade" type="text" class="form-control"/>
                                            </div>

                                        </div>
                                            
                                    </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-fechar-parametros btn-default" data-dismiss="modal" value="Fechar">
                            <button id="btn-atualizar-parametros" class="btn btn-danger">
                                Atualizar Parametros
                            </button>
                        </div>';

    echo json_encode($modal);
    return;
}

function getListUsuarios($idUsuario)
{
    $core          = new Core();
    $dadosUsuarios = $core->getAllUsuarios('usuario');

    $selectOptionsUsusario = '';
    $selected              = 'selected';

    if(!empty($dadosUsuarios)){
        foreach($dadosUsuarios as $usuario){
            $selectOptionsUsusario .=
                '<option value="'.$usuario['usuario_id'].'" '.($usuario['usuario_id'] == $idUsuario ? $selected : '').'>'.$usuario['nome'].'</option>';
        }

        return $selectOptionsUsusario;
    }
     echo json_encode($dadosUsuarios);
     return;


}






