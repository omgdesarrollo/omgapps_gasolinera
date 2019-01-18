<?php
session_start();
require_once '../Model/GeneralModel.php';
require_once '../util/Session.php';

$Op=$_REQUEST["Op"];
$model=new GeneralModel();
switch ($Op)
{
    case 'ModificarColumna':
//echo "entro en modicar controller";
    $resultado = $model->actualizarPorColumna($_REQUEST["TABLA"],$_REQUEST["COLUMNA"],$_REQUEST["VALOR"],$_REQUEST["ID"],$_REQUEST["ID_CONTEXTO"]);
    echo $resultado;
    break;

    case'updateColumnas':
        $resultado = $model->actualizarColumnas($_REQUEST['TABLA'],$_REQUEST['COLUMNAS'],$_REQUEST['ID'],Session::getSesion("s_cont")); 
        
        break;

    case 'Actualizar':
    // $CONTRATO = Session::getSesion("s_cont");
        header('Content-type: application/json; charset=utf-8'); 
        $COLUMNAS = json_decode($_REQUEST["COLUMNAS_VALOR"]);
        $ID = json_decode($_REQUEST["ID_CONTEXTO"]);
        $resultado = $model->actualizar($_REQUEST["TABLA"],$COLUMNAS,$ID);
        echo json_encode($resultado);
    break;

    default: 
        echo false;
    break;
}
?>