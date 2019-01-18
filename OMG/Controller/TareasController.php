<?php 

session_start();
require_once '../Model/TareasModel.php';
require_once '../util/Session.php';
require_once '../Model/ArchivoUploadModel.php';

$Op=$_REQUEST["Op"];
$model=new TareasModel();
$modelArchivo=new ArchivoUploadModel();

switch ($Op) {
    case 'Listar':
        
        $Lista= $model->listarTareas($_REQUEST['VALOR']);
//        echo "valor en el controler: ".json_encode($_REQUEST['VALOR']);
        foreach ($Lista as $key => $value) {
            $url= $_REQUEST['URL'].$value['id_tarea'];
            $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls(-1,$url);
        }
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;        
        break;
        
    case'ListarTarea':
        $Lista= $model->listarTarea($_REQUEST['ID_TAREA']);
        
        foreach ($Lista as $key => $value) {
            $url= $_REQUEST['URL'].$value['id_tarea'];
            $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls(-1,$url);
        }
        
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        break;
        
    case'empleadosConUsuario':
        $Lista= $model->empleadosConUsuario();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        break;
    
    case'responsableTarea':
        $Lista= $model->responsableTarea();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        break;
        
    case 'datosGrafica':
        $Lista= $model->datosParaGraficaTareas();
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case 'Guardar':
        header('Content-type: application/json; charset=utf-8');
        $data= json_decode($_REQUEST['tareaDatos'],true);
        $Lista= $model->insertarTarea(
//                $data['referencia'],
                $data['tarea'],
//                $data['fecha_creacion'],
                $data['fecha_alarma'],
                $data['fecha_cumplimiento'],
                $data['status_tarea'],
                $data['observaciones'],
                $data['id_empleado']
//                $data['mensaje'],
//                $data['reponsable_plan'],
//                $data['tipo_mensaje'],
//                $data['atendido']
                );
        
        foreach ($Lista as $key => $value) {
            $url= "Tareas/".$value['id_tarea'];
            $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls(-1,$url);
        }
        
        echo json_encode($Lista);
        return $Lista;
        break;
        
    case 'enviarNotificacionWhenUpdate':
        $Lista= $model->enviarNotificacionWhenUpdate($_REQUEST['ID_EMPLEADO'],$_REQUEST['TAREA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case'enviarNotificacionWhenCambioDeStatus':
        $Lista= $model->enviarNotificacionWhenCambioDeStatus($_REQUEST['ID_EMPLEADO'],$_REQUEST['TAREA'],$_REQUEST['STATUS_TAREA'],$_REQUEST['ID_TAREA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case 'enviarNotificacionWhenRemoveTarea':
        $Lista= $model->enviarNotificacionWhenRemoveTarea($_REQUEST['ID_EMPLEADO'],$_REQUEST['TAREA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case 'enviarNotificacionWhenRemoveTareaAlNuevoUsuario':
        $Lista= $model->enviarNotificacionWhenRemoveTareaAlNuevoUsuario($_REQUEST['ID_EMPLEADO'],$_REQUEST['TAREA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case 'enviarNotificacionWhenDeleteTarea':
        $Lista= $model->enviarNotificacionWhenDeleteTarea($_REQUEST['ID_EMPLEADO'],$_REQUEST['TAREA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        
        break;
    
    case 'tareas_EnAlarma_Venciadas':
        $Lista= $model->tareasEnAlarma();
        $Lista= $model->tareasVencidas();
        header('Content-type: application/json; charset=utf-8');
        echo "NO SE VERIFICA LA SALIDA";
        // echo json_encode($Lista);
        // return $Lista;

        break;
    
    case 'tareasVencidas':
        $Lista= $model->tareasVencidas();
        // header('Content-type: application/json; charset=utf-8');
        // echo json_encode($Lista);
        // return $Lista;

        break;
        
    case'verificarTarea':
        
        $cualverificar= $_REQUEST['cualverificar'];
        $cadena= $_REQUEST['cadena'];
        $Lista= $model->verificarSiYaExisteLaTarea($cualverificar, $cadena);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        break;
    
    
    case 'Eliminar':
//        $data= json_decode($_REQUEST['ID_TAREA'],true);
        $Lista= $model->eliminarTarea($_REQUEST['ID_TAREA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);
        return $Lista;
        break;

    default:
        break;
}


?>