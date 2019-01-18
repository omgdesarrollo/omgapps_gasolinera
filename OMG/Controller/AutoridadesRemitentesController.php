<?php
//este controlador solo atiende un requerimiento
//el requerimiento que atiende es el de inicio de sesion
session_start();
require_once '../Model/AutoridadRemitenteModel.php';
require_once '../Pojo/AutoridadRemitentePojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new AutoridadRemitenteModel();
$pojo= new AutoridadRemitentePojo();

switch ($Op) {
	case 'Listar':

		$Lista=$model->listarAutoridadesRemitentes();
                header('Content-type: application/json; charset=utf-8');       
                echo json_encode($Lista);        

		return $Lista;
		break;
            
        case 'listarAutoridad':
            
                $Lista=$model->listarAutoridadRemitente($_REQUEST['ID_AUTORIDAD']);
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($Lista);
            
            break;
            
            
        case 'mostrarCombo':
		$Lista=$model->listarAutoridadesRemitentesComboBox();
    	Session::setSesion("listarAutoridadesRemitentesComboBox",$Lista);
    	header('Content-type: application/json; charset=utf-8');
                echo json_encode($Lista);
                
		return $Lista;
		break;    
            
            
	
	case 'Nuevo':
		# code...
		break;	

	case 'Guardar':
		# code...
                header('Content-type: application/json; charset=utf-8');
                $data= json_decode($_REQUEST['autoridadDatos'],true);
            
                $pojo->setClave_autoridad($data['clave_autoridad']);
                $pojo->setDescripcion($data['descripcion']);
                $pojo->setDireccion($data['direccion']);
                $pojo->setTelefono($data['telefono']);
                $pojo->setExtension($data['extension']);
                $pojo->setEmail($data['email']);
                $pojo->setDireccion_web($data['direccion_web']);
                  
                $Lista= $model->insertar($pojo);
                echo json_encode($Lista);
                return $Lista;
                
		break;

	case 'Modificar':
		# code...
                                  
        $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] ); 
	
                break;

	case 'Eliminar':
		# code...
//                header('Content-type: application/json; charset=utf-8');
//                $data= json_decode($_REQUEST['ID_AUTORIDAD'],true);
//                        
//                $pojo->setId_autoridad($data['id_autoridad']);
                $Lista= $model->eliminarAutoridadRemitente($_REQUEST['ID_AUTORIDAD']);
                header('Content-type: application/json; charset=utf-8');                 
                echo json_encode($Lista);
                return $Lista;
            
		break;	
	default:
		# code...
		break;
}

?>
