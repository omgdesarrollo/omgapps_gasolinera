<?php
require_once '../dao/NotificacionesTareasDAO.php';
require_once '../Model/NotificacionesModel.php';

class NotificacionesTareasModel {
    //put your code here

    
//    public function tareasConFechaCumplimientoProximoAVencer($CONTRATO)
//    {
//        try
//        {
//            $dao=new NotificacionesTareasDAO();
//            $rec= $dao->tareasConFechaCumplimientoProximoAVencer($CONTRATO);
//            
//            return $rec;
//        } catch (Exception $ex)
//        {
//            throw $ex;
//            return -1;
//        }
//    }
    
    
    public function tareasVencidas()
    {
        try
        {
            $CONTRATO= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";
            
            $dao=new NotificacionesTareasDAO();
            $model=new NotificacionesModel();
            
            $rec= $dao->tareasVencidas();
            
//            echo "este es el rec: ".json_encode($rec);
            foreach ($rec as $value)
            {
                $TAREA= $value['tarea'];
                $ID_EMPLEADO= $value['id_empleado'];
                $ID= $dao->obtenerUsuarioPorIdEmpleado($ID_EMPLEADO);
                $mensaje= "Tema: ".$TAREA." con Fecha de Cumplimiento Vencido";
                
                $resultado= $dao->veriricarSiYaExisteLaNotificacion($mensaje);
                
                if($resultado==0)
                {
                    $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $ID, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                }
            }
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
}

?>
