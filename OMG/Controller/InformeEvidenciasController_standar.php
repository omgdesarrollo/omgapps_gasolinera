<?php
session_start();
require_once '../Model/InformeEvidenciasModel.php';
require_once '../dao/InformeEvidenciasDAO.php';
require_once '../util/Session.php';
require_once '../Model/ArchivoUploadModel.php';

$Op=$_REQUEST["Op"];
$model=new InformeEvidenciasModel();
$modelArchivo = new ArchivoUploadModel();

switch ($Op)
{
    case 'Listar':
        
        // $v["param"]["v"]=$_REQUEST["validado"];
        // $v["param"]["n_v"]=$_REQUEST["no_validado"];
        // $v["param"]["s_d"]=$_REQUEST["sin_documento"];
        $CONTRATO = Session::getSesion("s_cont");
        $Lista=$model->listarEvidencias($CONTRATO);
        $nuevo = array();
        foreach($Lista as $key => $value)
        {
            $url = $_REQUEST["URL"].$value["id_evidencias"];
            $archivos = $modelArchivo->listar_urls($CONTRATO,$url);
            if(sizeof($archivos[0])!=0)
            {
                $Lista[$key]["archivosUpload"] = $archivos;
                array_push($nuevo,$Lista[$key]);
            }
                // $Lista[$key]["archivosUpload"] = $archivos;
        }

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($nuevo);
        break;
    
    case 'MostrarTemayResponsable':
        $Lista=$model->obtenerTemayResponsable($_REQUEST['ID_DOCUMENTO'], Session::getSesion("s_cont"));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case'MostrarRequisitosPorDocumento':
        $Lista= $model->obtenerRequisitosporDocumento($_REQUEST['ID_DOCUMENTO'], Session::getSesion("s_cont"));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case'MostrarRegistrosPorDocumento':
        $Lista= $model->obtenerRegistrosporDocumento($_REQUEST['ID_DOCUMENTO'], Session::getSesion("s_cont"));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;

    default:
        break;
}


?>

