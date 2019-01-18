<?php

session_start();
require_once '../Model/InformeGerencialModel.php';
require_once '../Pojo/InformeGerencialPojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new InformeGerencialModel();
$pojo= new InformeGerencialPojo();

switch ($Op) {
	case 'Listar':

		$Lista=$model->listarInformeGerencial();
                Session::setSesion("listarInformeGerencial",$Lista);
                header('Content-type: application/json; charset=utf-8');
		echo json_encode( $Lista);
		return $Lista;
                
		break;
            
	case 'Nuevo':
		# code...
		break;	

	case 'Guardar':
                  
		# code...
		break;

	case 'Modificar':
		# code...
   					
//                  $pojo->setIdDocumentoEntrada($_REQUEST['ID_DOCUMENTO_ENTRADA']);
//                  $pojo->setIdCumplimiento($_REQUEST['ID_CUMPLIMIENTO']);
//                  $pojo->setFolioReferencia($_REQUEST['FOLIO_REFERENCIA']);
//                  $pojo->setFolioEntrada($_REQUEST['FOLIO_ENTRADA']);
//                  $pojo->set($_REQUEST['FECHA_RECEPCION']);
//                  $pojo->setAsunto($_REQUEST['ASUNTO']);
//                  $pojo->setRemitente($_REQUEST['REMITENTE']);
//                  $pojo->setIdEntidad($_REQUEST['ID_ENTIDAD']);
//                  $pojo->setIdClausula($_REQUEST['ID_CLAUSULA']);
//                  $pojo->setClasificacion($_REQUEST['CLASIFICACION']);
//                  $pojo->setStatusDoc($_REQUEST['STATUS_DOC']);
//                  $pojo->setFechaAsignacion($_REQUEST['FECHA_ASIGNACION']);
//                  $pojo->setFechaLimiteAtencion($_REQUEST['FECHA_LIMITE_ATENCION']);
//                  $pojo->setFechaAlarma($_REQUEST['FECHA_ALARMA']);
//                  $pojo->setDocumento($_REQUEST['DOCUMENTO']);
//                  $pojo->setObservaciones($_REQUEST['OBSERVACIONES']);
//                  
//                  
//                  
//                  
//                  $model->actualizar($pojo);
//                  $msg=$exito['mensaje'];
//                  if($exito['Error']==0){
//                      header('Content-type: application/json; charset=utf-8');
//                      echo json_encode(array("data" => $msg));
//                  }
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


