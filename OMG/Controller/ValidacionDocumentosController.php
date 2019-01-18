<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require_once '../Model/ValidacionDocumentoModel.php';
require_once '../Pojo/ValidacionDocumentoPojo.php';
require_once '../Model/AsignacionTemaRequisitoModel.php';
require_once '../Model/DocumentoModel.php';
require_once '../Model/ArchivoUploadModel.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new ValidacionDocumentoModel();
$modelAsignacionTemaRequisito=new AsignacionTemaRequisitoModel();
$modelDocumento=new DocumentoModel();
$modelArchivo = new ArchivoUploadModel();
$pojo= new ValidacionDocumentoPojo();

switch ($Op) {
	case 'ListarTodo':
		$USUARIO = Session::getSesion("user");
		$CONTRATO = Session::getSesion("s_cont");
		$Lista=$model->listarValidacionDocumentos($USUARIO["ID_USUARIO"],$CONTRATO);
		foreach($Lista as $key => $value)
		{
			$url = $_REQUEST["URL"].$value["id_validacion_documento"];
			$Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($Lista);
	break;

	case 'ListarUno':
		$USUARIO = Session::getSesion("user");
		$CONTRATO = Session::getSesion("s_cont");
		$Lista=$model->listarValidacionDocumento($USUARIO["ID_USUARIO"],$CONTRATO,$_REQUEST["ID_VALIDACION_DOCUMENTO"]);
		foreach($Lista as $key => $value)
		{
			$url = $_REQUEST["URL"].$value["id_validacion_documento"];
			$Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
		}
		header('Content-type: application/json; charset=utf-8');
		echo json_encode( $Lista);
	break;
            
	case 'ObtenerTemayResponsable':
		$CONTRATO = Session::getSesion("s_cont");
		$Lista=$model->obtenerTemayResponsable($_REQUEST['ID_DOCUMENTO'],$CONTRATO);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($Lista);
		return $Lista;
	break;
            
        case 'MostrarRequisitosPorDocumento':
            
                
                $Lista= $model->obtenerRequisitosporDocumento($_REQUEST['ID_DOCUMENTO']);
//                Session::setSesion("obtenerRequisitosporDocumento",$Lista);        
                header('Content-type: application/json; charset=utf-8');
				echo json_encode( $Lista);
                return $Lista;
		break;	
	  
            
        case 'MostrarRegistrosPorDocumento':
                  
                $Lista= $model->obtenerRegistrosPorDocumento($_REQUEST['ID_DOCUMENTO']);
//                Session::setSesion("obtenerRegistrosPorDocumento",$Lista);                 
                header('Content-type: application/json; charset=utf-8');
                echo json_encode($Lista);
                return $Lista;
            
		break;    

	case 'Modificar':
                echo $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );         
	break;

	case 'Eliminar':
		# code...
		break;
	
	case "AlmacenarArchivosServer":
			$existe=false;
			$id_validacion=$_REQUEST["ID_VALIDACION"];
			if($_FILES["imagen"]["name"][0])
			{        
				$carpetaDestino = "../../archivos/filesValidacionDocumento/".$id_validacion;
				if(!file_exists($carpetaDestino))
				{
					mkdir($carpetaDestino,0777,true);
				}
			// echo "carpeta:  ".$carpetaDestino;
				for($i=0;$i<count($_FILES["imagen"]["name"]);$i++)
				{
					$origen = $_FILES["imagen"]["tmp_name"][$i];
					$destino = $carpetaDestino."/".$_FILES["imagen"]["name"][$i];
					move_uploaded_file($origen,$destino);
					$existe=file_exists($destino);
				}
			}
			header('Content-type: application/json; charset=utf-8');
			echo json_encode($existe);
	break;

	case 'GetValidacionTema':
		$valor = $model->getValidacionTema($_REQUEST["ID_VALIDACION_DOCUMENTO"]);
		echo $valor;
	break;

	case 'GetValidacionDocumento':
		$valor = $model->getValidacionDocumento($_REQUEST["ID_VALIDACION_DOCUMENTO"]);
		echo $valor;
	break;

	case 'GetExisteArchivo':
		$valor = $model->getExisteArchivo($_REQUEST["ID_VALIDACION_DOCUMENTO"]);
		echo $valor;
	break;

	case 'ModificarColumna':
		echo $model->actualizarPorColumna($_REQUEST["COLUMNA"],$_REQUEST["VALOR"],$_REQUEST["ID_VALIDACION_DOCUMENTO"]);
	break;

	case 'ModificarArchivos':
		$res=$model->modificarArchivos($_REQUEST["ID_VALIDACION_DOCUMENTO"],$_REQUEST["VALOR"]);
		echo $res;
	break;

	case 'ListarObservaciones':
		$lista["idUsuario"] = Session::getSesion("user")["ID_USUARIO"];
		$lista["observaciones"]=$model->listarObservaciones($_REQUEST["ID_VALIDACION_DOCUMENTO"]);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($lista);
	break;

	case 'EnviarObservacion':
		date_default_timezone_set("America/Mexico_city");
		$FECHA = strftime("%d/%B/%y %X");
		$ID_USUARIO = Session::getSesion("user")["ID_USUARIO"];
		$NOMBRE = $model->getNombreUSuario($ID_USUARIO);
		$MENSAJE = trim($_REQUEST["MENSAJE"],"\n");
		$MENSAJE2 = str_replace("\n","<br>",$MENSAJE);

		$exito["data"] = $model->enviarObservacion($_REQUEST["ID_VALIDACION_DOCUMENTO"],$MENSAJE2,$ID_USUARIO,$NOMBRE,$FECHA);
		$exito["idUsuario"] = $ID_USUARIO;
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($exito);
	break;

	default:
		return -1;
	break;

}

?>


