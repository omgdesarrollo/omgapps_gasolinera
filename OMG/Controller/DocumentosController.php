<?php


session_start();
require_once '../Model/DocumentoModel.php';
require_once '../Pojo/DocumentoPojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new DocumentoModel();
$pojo= new DocumentoPojo();


switch ($Op) {
	case 'Listar':

        $Lista=$model->listarDocumentos(Session::getSesion("s_cont"));         

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
                
		break;
            
        case'ListarDocumento':
            $CONTRATO= Session::getSesion("s_cont");
            $Lista= $model->listarDocumento($_REQUEST['ID_DOCUMENTO'], $CONTRATO);
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            return $Lista;
            break;
            
        case 'mostrarcombo':
		$Lista=$model->listarDocumentosComboBox();
//    	Session::setSesion("listarDocumentosComboBox",$Lista);
//    	$tarjet="../view/principalmodulos.php";
    	header('Content-type: application/json; charset=utf-8');
//		echo json_encode($Lista);
                echo json_encode($Lista);
//	$filas=array();	
//        foreach ($Lista as $filas)
//            //$sentencia="SELECT * FROM empleados";
//            //$resultado=mysql_query($sentencia);
//            //while($filas=mysql_fetch_assoc($resultado))
//              
//            {
//            echo json_encode($filas['ID_EMPLEADO']);	
//            }
		//header("location: login.php");
//echo $json = json_encode(array("n" => "".$Lista.NOMBRE_EMPLEADO, "a" => "apellido",  "c" => "test"));
		return $Lista;
		break;
            
        case 'nombresCompletos':   
            $Lista= $model->nombresCompletosCombobox();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            break;
        
        case 'responsableDocumento':   
            $Lista= $model->responsableDelDocumento();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            break; 
	
	case 'Nuevo':
		# code...
		break;	

	case 'Guardar':
		# code...
            header('Content-type: application/json; charset=utf-8');
            $data= json_decode($_REQUEST['documentoDatos'],true);
  
            $pojo->setClave_documento($data['clave_documento']);
            $pojo->setDocumento($data['documento']);
            $pojo->setId_empleado($data['id_empleado']);
            $contrato= Session::getSesion("s_cont");

            $Lista= $model->insertar($pojo,$contrato);
            echo json_encode($Lista);
            return $Lista;
		break;

	case 'Modificar':
		# code...
            echo "el val es g de  "+ $_REQUEST['editval'];
//            htmlspecialchars($_REQUEST['editval']);
        $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );
        
            
		break;
            
        
        case 'verificacionexisteregistro':
            
              $registro=$_REQUEST["registro"];
              $cualverificar=$_REQUEST["cualverificar"];
              
              $data= $model->verificacionExisteClaveandDocumento($registro,$cualverificar);
              
               	header('Content-type: application/json; charset=utf-8');
                echo json_encode($data);
            
                
                break;
    
    
	case 'Eliminar':
		# code...
//            header('Content-type: application/json; charset=utf-8'); 
//            $data = json_decode($_REQUEST['ID_DOCUMENTO'],true);
//            $Lista= $model->eliminarDocumento($data['id_documento']);
            $Lista= $model->eliminarDocumento($_REQUEST['ID_DOCUMENTO']);
            header('Content-type: application/json; charset=utf-8'); 
            echo json_encode($Lista);
            return $Lista;
		break;	


	default:
		# code...
		break;
}
?>


