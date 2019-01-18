<?php

session_start();
require_once '../Model/ArchivoUploadModel.php';
require_once '../Model/DocumentoEntradaModel.php';
require_once '../util/Session.php';


$Op=$_REQUEST["Op"];

$model=new ArchivoUploadModel();
$modelDocumentoEntrada= new DocumentoEntradaModel();

switch ($Op) {
	case 'Guardar':
		// echo $urls;
		// foreach($urls as $url)
		// {
		// 	echo $url;
		// }
		// $urls = Session::getSesion("archivos_urls");
		// $total = Session::getSesion("archivos_urls_contador");
		// echo "total de registros: ".$total;
		$model->insertar_archivos($_REQUEST['ID_DOCUMENTO'],$urls);
		// $newArray = array();
		// Session::setSesion("archivos_urls",null);
		
		// header('Content-type: application/json; charset=utf-8');
		// echo json_encode( $Lista);
		
		// return $Lista;
		break;
		
	case 'listarUrls':
		$CONTRATO;
		if(isset($_REQUEST["SIN_CONTRATO"]))
		{
			$CONTRATO=-1;
		}
		else
			$CONTRATO = Session::getSesion("s_cont");
		$lista = $model->listar_urls($CONTRATO,$_REQUEST["URL"]);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($lista);
	break;
	
	case 'EliminarArchivo':
		$urlTemp = Session::getSesion("URLS");
		if(isset($_REQUEST["SIN_CONTRATO"]))
			$url = $urlTemp["fisica"].Session::getSesion("tipo")."/".$_REQUEST["URL"];
		else
		{
			$contrato = Session::getSesion("s_cont");
			$url = $urlTemp["fisica"].Session::getSesion("tipo")."/".$contrato."/".$_REQUEST["URL"];
		}

		$eliminado = $model->eliminar_archivoFisico($url);
		header('Content-type: application/json; charset=utf-8');
		echo $eliminado;
		break;

	case 'CrearUrl':
		$URL = $_REQUEST["URL"];
		if(isset($_REQUEST["SIN_CONTRATO"]))
			$url = $URL;
		else
		{
			$CONTRATO = Session::getSesion("s_cont");
//			$url = Session::getSesion("tipo")."/".$CONTRATO."/".$URL;
                        $url = $CONTRATO."/".$URL;
		}
                $url = Session::getSesion("tipo")."/".$url;
                
		$carpetaDestino = "../../archivos/".$url;
//                $carpetaDestino = "../../archivos/".Session::getSesion("tipo")."/".$url;
		$creado=true;
		if(!file_exists($carpetaDestino))
		{
			$creado = mkdir($carpetaDestino,0777,true);
		}
		if($creado)
		{
			Session::setSesion("newUrl",$url);
		}
		header('Content-type: application/json; charset=utf-8');
		echo $creado;

	default:
		header('Content-type: application/json; charset=utf-8');
		echo false;
	break;
}
?>