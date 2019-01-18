<?php


session_start();
require_once '../Model/NotificacionesTareasModel.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new NotificacionesTareasModel();


switch ($Op) {
            
        
        case 'tareasVencidas':
            $Lista= $model->tareasVencidas();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            return $Lista;
            
            break;

	default:
		# code...
		break;
}
?>




