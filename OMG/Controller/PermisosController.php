<?php
session_start();
require_once '../Model/PermisosModel.php';
require_once '../util/Session.php';

$Op=$_REQUEST["Op"];
$model=new PermisosModel();

switch ($Op) {
    
    case 'obtenerPermisos':
        $Lista=$model->obtenerPermisos();
        Session::setSesion("obtenerPermisos",$Lista);
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);

        return $Lista;
    break;
    
    
}

?>

