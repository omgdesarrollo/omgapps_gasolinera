<?php
//este controlador solo atiende un requerimiento
//el requerimiento que atiende es el de inicio de sesion
session_start();
require_once '../Model/AsignacionDocumentoTemaModel.php';
require_once '../Pojo/AsignacionDocumentoTemaPojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new AsignacionDocumentoTemaModel();
$pojo= new AsignacionDocumentoTemaPojo();

switch ($Op) {
	case 'Listar':

		$Lista=$model->listarAsignacionDocumentosTemas();
    	Session::setSesion("listarAsignacionDocumentosTemas",$Lista);
//    	$tarjet="../view/principalmodulos.php";
                
        header('Content-type: application/json; charset=utf-8');
//               echo json_encode(array("data" => $Lista)); 
                echo json_encode($Lista);           
		//header("location: login.php");
//echo $json = json_encode(array("n" => "".$Lista.NOMBRE_EMPLEADO, "a" => "apellido",  "c" => "test"));
		return $Lista;
		break;
	
	case 'Nuevo':
		# code...
		break;	

	case 'Guardar':
                  
		# code...
                $pojo->setId_documento($_REQUEST['ID_DOCUMENTO']);
                $pojo->setId_asignacion_tema_requisito($_REQUEST['ID_ASIGNACION_TEMA_REQUISITO']);
                

                $model->insertar($pojo);
            
            
		break;

	case 'Modificar':
		# code...
		/*			
                  $pojo->setIdClausula($_REQUEST['ID_CLAUSULA']);
                  $pojo->setClausula($_REQUEST['CLAUSULA']);
                  $pojo->setSubClausula($_REQUEST['SUB_CLAUSULA']);
                  $pojo->setDescripcionClausula($_REQUEST['DESCRIPCION_CLAUSULA']);
                  $pojo->setDescripcionSubClausula($_REQUEST['DESCRIPCION_SUB_CLAUSULA']);
                  $pojo->setTextoBreve($_REQUEST['TEXTO_BREVE']);
                  $pojo->setDescripcion($_REQUEST['DESCRIPCION']);
                  $pojo->setPlazo($_REQUEST['PLAZO']);
                  
                  $model->actualizar($pojo);                 
                 */  
            
//                  $msg=$exito['mensaje'];
//                  if($exito['Error']==0){
//                      header('Content-type: application/json; charset=utf-8');
//                      echo json_encode(array("data" => $msg));
//                  }
                //$model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );
//                     $valorcombo = $_REQUEST["Combo"];
            $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );
            
                   
            
//                    if($valorcombo == 'false'){
//                        
//                  $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );
//                    }
                    
                    
//                    if($valorcombo == 'true'){
//                        
//                  $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );
//                    }
                break;

	case 'Eliminar':
		# code...
		break;

	case 'BuscarDocumento':
		$contrato = Session::getSesion("s_cont");
		$lista = $model->buscarDocumento($_REQUEST["CADENA"],$contrato);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($lista);
		break;

	default:
		# code...
		break;
}

?>




