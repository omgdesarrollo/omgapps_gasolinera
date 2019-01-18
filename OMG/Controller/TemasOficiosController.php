<?php

//este controlador solo atiende un requerimiento
//el requerimiento que atiende es el de inicio de sesion
session_start();
require_once '../Model/TemaModel.php';
require_once '../Pojo/TemaPojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new TemaModel();
$pojo= new TemaPojo();

switch ($Op) {
	case 'Listar':

            $Lista=$model->mostrarTemas("oficios", Session::getSesion("s_cont"));                  
            header('Content-type: application/json; charset=utf-8'); 
            echo json_encode($Lista);
            return $Lista;

         break;
     
     
        case 'mostrarCombo':
            $Lista=$model->listarTemasComboBox("oficios", Session::getSesion("s_cont"));
            // Session::setSesion("listarTemasComboBox",$Lista);
            header('Content-type: application/json; charset=utf-8'); 
            echo json_encode($Lista);
            return $Lista;
        break;
	
	case 'ListarHijos':
            
            $Lista= $model->listarHijos("oficios", Session::getSesion("s_cont"), $_REQUEST['ID']);
            header('Content-type: application/json; charset=utf-8'); 
            echo json_encode($Lista);
            return $Lista;
            
		break;
            
        case'ListarDetalles':
            
            $Lista= $model->listarDetallesSeleccionados($_REQUEST['ID_TEMA']);
            header('Content-type: application/json; charset=utf-8'); 
            echo json_encode($Lista);
            return $Lista;
            
            break;
        

	case 'GuardarNodo':
		# code...
         
                $Lista= $model->insertarNodo($_REQUEST['NO'],$_REQUEST['NOMBRE'],$_REQUEST['DESCRIPCION'],$_REQUEST['PLAZO'],$_REQUEST['NODO'],$_REQUEST['ID_EMPLEADOMODAL'],"oficios",Session::getSesion("s_cont"));
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
            $Lista= $model->eliminarNodoParaOficios($_REQUEST['ID']);
            header('Content-type: application/json; charset=utf-8'); 
            echo json_encode($Lista);
            return $Lista;
            
		break;
            
        case'verificarSiExisteTema':
            $Lista= $model->verificarSiTemaEstaEnDocumentoDeEntrada($ID_TEMA);
            break;


	default:
		# code...
		break;
}
?>


