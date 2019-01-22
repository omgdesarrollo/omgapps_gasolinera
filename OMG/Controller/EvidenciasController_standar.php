<?php

session_start();
require_once '../Model/EvidenciasModel.php';
require_once '../Pojo/EvidenciasPojo.php';
require_once '../Model/DocumentoModel.php';
require_once '../util/Session.php';
require_once '../Model/AdminModel.php';
require_once '../Model/ArchivoUploadModel.php';

$Op = $_REQUEST["Op"];
$model = new EvidenciasModel();
$modelAdmin =new AdminModel();
$modelArchivo = new ArchivoUploadModel();
$pojo = new EvidenciasPojo();

$modelDocumento=new DocumentoModel();


switch ($Op)
{
    case 'Listar':
        $USUARIO = Session::getSesion("user");
        $CONTRATO = Session::getSesion("s_cont");

        $Lista=$model->listarEvidencias($USUARIO["ID_USUARIO"],$CONTRATO);
        foreach($Lista as $key => $value)
        {
            $url = $_REQUEST["URL"].$value["id_evidencias"];
            $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
        }

    	Session::setSesion("listarOperaciones",$Lista);//no se de que es esto JR
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
    break;

    case 'ListarEvidencia':
        $USUARIO = Session::getSesion("user");
        $CONTRATO = Session::getSesion("s_cont");
        $Lista = $model->listarEvidencia($_REQUEST['ID_EVIDENCIA'],$USUARIO["ID_USUARIO"]);

        foreach($Lista as $key => $value)
        {
            $url = $_REQUEST["URL"].$value["id_evidencias"];
            $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
    break;
        
    case 'EliminarEvidencia':  
        $data = $model->eliminarEvidencia($_REQUEST['ID_EVIDENCIA']);
        echo $data;
    break;
    
    case 'getClavesDocumentos':
        $Lista=$model->getClavesDocumentos($_REQUEST["CADENA"]);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
		break;
            
    case 'MostrarRegistrosPorDocumento':
        
        $id_documento=$_REQUEST["ID_DOCUMENTO"];
        $lista=$modelDocumento->obtenerRegistrosPorDocumento($id_documento);
        Session::setSesion("obtenerRegistrosPorDocumento",$lista);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
        
        break;
    case 'CrearEvidencia':
        $usuario = Session::getSesion("user");
        $CONTRATO = Session::getSesion("s_cont");

        $res = $model->crearEvidencia($usuario["ID_USUARIO"],$_REQUEST["ID_REGISTRO"],$_REQUEST["FECHA_CREACION"]);
        if($res>=0)
        {
            $res = $model->listarEvidencia($res,$usuario["ID_USUARIO"]);
        }
        foreach($res as $key => $value)
        {
            $url = $_REQUEST["URL"].$value["id_evidencias"];
            $res[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($res);
        break;
    
    case 'iniciarEnVacio':
        $res = $model->iniciarEnVacio($_REQUEST["ID_EVIDENCIAS"]);
        echo $res;
        break;
    
    case 'ModificarColumna':

		$data = $model->actualizarPorColumna($_REQUEST["COLUMNA"],$_REQUEST["ID_CONTEXTO"],$_REQUEST["ID_EVIDENCIA"],$_REQUEST["VALOR"]);
		// header('Content-type: application/json; charset=utf-8');
		echo $data;
	break;

    case 'BuscarTema':
        $USUARIO = Session::getSesion("user");
        $lista = $model->listarTemas($_REQUEST['CADENA'],$USUARIO["ID_USUARIO"], Session::getSesion("s_cont"));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    break;

    case 'BuscarRegistro':
        $lista = $model->listarRegistros($_REQUEST['CADENA'],$_REQUEST['ID_TEMA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    break;

    case 'MandarAccionCorrectiva':
        $exito = $model->mandarAccionCorrectiva($_REQUEST["ID_EVIDENCIA"],$_REQUEST["MENSAJE"],$_REQUEST["COLUMNA"]);
        echo $exito;
    break;

    case 'ChecarDisponiblidad':
        // $exito = $model->mandarAccionCorrectiva($_REQUEST["ID_EVIDENCIA"],$_REQUEST["MENSAJE"],$_REQUEST["COLUMNA"]);
        $disponiblidad = $model->checarDisponiblidad($_REQUEST["ID_REGISTRO"],$_REQUEST["FECHA"]);
        echo $disponiblidad;
    break;

    case 'especialComponerTemas':
        $resp = $model->componerTablaTemas();
        echo $resp;
    break;

    case 'IniciarConformidad':
        $resp = $model->iniciarConformidad($_REQUEST["ID_EVIDENCIA"],$_REQUEST["VALOR"]);
        echo 1;
    break;

    case 'ObtenerParticipantesUsuarios':
        $USUARIO = Session::getSesion("user");
        $CONTRATO = -1;
        $lista = $model->obtenerParticipantesUsuarios($_REQUEST["R_TEMA"],$_REQUEST["R_EVIDENCIA"]);
        foreach($lista as $key => $value)
        {
            $url = "filePerfilesUsuario/".$value["id_usuario"];
            $lista[$key]["archivosUpload"] = $modelArchivo->listar_urls($CONTRATO,$url);
        }
        foreach($lista as $key => $value)
        {
            if($value["id_usuario"]==$USUARIO["ID_USUARIO"])
            {
                $lista[$key]["usuario"] = 1;
            }
        }
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    break;

    case 'ObtenerMensajes':
        header('Content-type: application/json; charset=utf-8');
        $USUARIO = Session::getSesion("user");
        $lista = $model->obtenerMensajes($_REQUEST["ID_EVIDENCIA"]);
        echo json_encode(json_decode($lista,true));
    break;

    case 'AgregarMensaje':
        header('Content-type: application/json; charset=utf-8');
        $USUARIO = Session::getSesion("user");
        $exito = $model->agregarMensaje($USUARIO["ID_USUARIO"],$_REQUEST["ID_EVIDENCIA"],trim($_REQUEST["MENSAJE"]),$_REQUEST["FECHA"]);
        echo json_decode($exito);
    break;

	default:
		echo false;
        break;
}


?>
