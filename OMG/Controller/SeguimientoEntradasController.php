<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../Model/SeguimientoEntradaModel.php';
require_once '../Pojo/SeguimientoEntradaPojo.php';
require_once '../util/Session.php';
require_once '../Model/ArchivoUploadModel.php';
$modelArchivo=new ArchivoUploadModel();

$Op=$_REQUEST["Op"];
$model=new SeguimientoEntradaModel();
$pojo= new SeguimientoEntradaPojo();
//$modelGantt=new GanttModel();

switch ($Op) {
	case 'Listar':
            $CONTRATO = Session::getSesion("s_cont");
            $Lista=$model->listarSeguimientoEntradas();
//                Session::setSesion("listarSeguimientoEntradas",$Lista);//Se esta ocupando para el modulo de informe gerencial
            foreach($Lista as $key => $value)
            {
                    $url = $_REQUEST["URL"].$value["id_documento_entrada"];
                    $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
            }
                
            header('Content-type: application/json; charset=utf-8');
            echo json_encode( $Lista);
            return $Lista;
            break;
            
        case'listarSeguimientoEntrada':
            $CONTRATO = Session::getSesion("s_cont");
            $Lista=$model->listarSeguimientoDeEntrada($_REQUEST['ID_SEGUIMIENTO_ENTRADA']);

            foreach($Lista as $key => $value)
            {
                    $url = $_REQUEST["URL"].$value["id_documento_entrada"];
                    $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
            }
                
            header('Content-type: application/json; charset=utf-8');
            echo json_encode( $Lista);
            return $Lista;
            break;
            
	case 'nombresCompletos':
		# code...
            $Lista= $model->nombresCompletosCombobox();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode( $Lista);
            return $Lista;    
		break;	
            
        case'responsablePlan':
            $Lista= $model->responsablePlan();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            return $Lista;
                break;    

	case 'Modificar':
		# code...
   					

                $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );  
                  
                  
	break;

	case 'Eliminar':
		# code...
		break;	
	default:
		# code...
		break;
}

?>


