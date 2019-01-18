<?php
session_start();
require_once '../Model/RegistrosModel.php';
require_once '../util/Session.php';

$Op= $_REQUEST["Op"];
$model=new RegistrosModel();


switch ($Op){
    
    case 'ListarRegistros':
        $Lista=$model->listarRegistros();
        Session::setSesion("listarRegistros",$Lista);
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);    
        // return $Lista;
    break;

    case 'GenerarArbol':
         header('Content-type: application/json; charset=utf-8');
        $data= json_decode($_REQUEST["ID_ASIGNACION"]);
        
        $Lista=$model->generarDatosArbol($data->id_asignacion,$data->id_tema_subtema);
        // Session::setSesion("generarDatosArbol",$Lista);
       
        echo json_encode($Lista);
        
        // return $Lista;
    break;

    case 'guardar':
        
        $data = $model->insertarRegistros($_REQUEST["REGISTRO"]);
		echo $data;
    break;

    default:
    # code...
    break;
    
    
}
?>