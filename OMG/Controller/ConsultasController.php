<?php
session_start();
require_once '../Model/ConsultasModel.php';
require_once '../util/Session.php';

$Op=$_REQUEST["Op"];
$model=new ConsultasModel();


switch ($Op) {
    case 'Listar':
        $Lista = $model->listarConsultas(Session::getSesion("s_cont"));
        // var_dump($Lista);
        $Lista = $model->calcular($Lista);
        $Lista = $model->limpiar($Lista);
        header('Content-type: application/json; charset=utf-8');
        // $Lista = array();
        echo json_encode($Lista);
        break;

    default:
        break;
}


?>

