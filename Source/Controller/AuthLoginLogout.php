<?php

namespace Source\Controller;
require 'AuthController.php';
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
//die(var_dump($_POST, $_FILES));
    if(empty($_FILES)){
        login($_POST);
    } else {
        createUsuario(array_merge($_POST, $_FILES));
    }

}

function createUsuario($dataPost)
{
    $auth           = new AuthController();
    $usuario        = $auth->criarConta($dataPost);
}

function login($dataPost)
{
    $auth           = new AuthController();
    $usuario        = $auth->login($dataPost);

    if(is_array($usuario)){
        $_SESSION['logado'] = $usuario['data'][0];
        echo json_encode(['error' => false]);
        exit;
    }

    echo $usuario;
    exit;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    setAcao($_GET);
}

function setAcao($acao)
{

    if(array_key_exists('logout', $acao)){
        logout();
    }
    if(array_key_exists('listUsuarios', $acao)){
        getUsuariosRenderizar();
    }
    if(array_key_exists('getImgBlobUsuario', $acao)){
        getImagemBlobUsuario($acao);
    }

}

function getImagemBlobUsuario($dadosusuario)
{
    $idImagemBlob = $dadosusuario['getImgBlobUsuario'];

}

function getUsuariosRenderizar()
{
    $auth     = new AuthController();
    $usuarios = $auth->getUsuarios();
    if(empty($usuarios)){
        echo json_encode(['erros' => true, "message" => "Não Foram Encontrados Usuários"]);
        exit;
    }
    renderizarListausuarios($usuarios);
}

function logout()
{
    unset($_SESSION['logado']);
    echo json_encode(['error' => false]);
    exit;
}

function renderizarListausuarios($usuarios)
{
    $modal = '';
    foreach($usuarios as $usuario){
        $modal .= '<tr>
                                <td class="text-center text-muted">1</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                    '.getImagemBlob($usuario['id_imagens_blob']).'
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">'.$usuario['nome'].'</div>
                                                <div class="widget-subheading opacity-7">'.$usuario['cargo'].'</div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">"'.$usuario['cidade'].'"</td>
                                '.setStatus($usuario['status']).'
                                <td class="text-center">
                                    <button type="button" id="PopoverCustomT-1" class="btn btn-primary btn-sm">Editar</button>
                                    <button type="button" id="PopoverCustomT-1" class="btn btn-danger btn-sm">Excluir</button>
                                </td>
                            </tr>';
    }

    echo json_encode($modal);
    return;

}

function setStatus($string)
{
    return ($string == '1') ? '<td class="text-center">
                                    <div class="badge badge-success">Ativo</div>
                                </td>' : '<td class="text-center">
                                    <div class="badge badge-warning">Inativo</div>
                                </td>';
}

function getImagemBlob($idImagemBlob)
{
    if(is_null($idImagemBlob) || empty($idImagemBlob)){
        return '<img width="40" class="rounded-circle picture-src" src="assets/img/default-avatar.png" alt="">';
    } else {
        $auth         = new AuthController();
        $imagemInfo   = $auth->getImgBlob($idImagemBlob);
        $returnImgTag = '<img src = "data:image/png;base64,' . base64_encode($imagemInfo['arquivo_imagem']) . '" width = "40px" height = "40px"/>';
        return $returnImgTag;
    }

}
