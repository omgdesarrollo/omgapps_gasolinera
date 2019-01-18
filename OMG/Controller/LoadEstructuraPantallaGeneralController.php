<?php
session_start();
require_once '../Pojo/UsuarioPojo.php';
require_once '../util/Session.php';
require_once '../Model/AdminModel.php';
$Op=$_REQUEST["Op"];


$modelAdmin= new AdminModel();

switch ($Op) {
    case "VistasPorUsuarioLaCualTienePermisos":       
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($modelAdmin->listarUsuarioVistasAsignadasPorLoMenosUnTipoDePermisoParaMostrarVista(array("id_usuario"=> Session::getSesion("user")["ID_USUARIO"])));
    break;  
}
?>


