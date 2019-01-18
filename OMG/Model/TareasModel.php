<?php
require_once '../dao/TareasDAO.php';
require_once '../Model/NotificacionesModel.php';

class TareasModel{
    
    public function listarTareas($checkBoxTerminados)
    {
        try
        {
            $id_usuario=Session::getSesion("user");
            $contrato= Session::getSesion("s_cont");
            $dao=new TareasDAO();
            
            $id_empleado= $dao->obtenerEmpleadoPorIdUsuario($id_usuario['ID_USUARIO']);
            $rec= $dao->listarTareas($id_empleado,$id_usuario['ID_USUARIO'],$contrato,$checkBoxTerminados);
            
            foreach ($rec as $key => $value) 
            {
//                echo "fecha alarma: ".json_encode($value['fecha_alarma']);
                $alarm = new Datetime($value['fecha_alarma']);
                $alarm = strftime("%d-%B-%y",$alarm -> getTimestamp());
                $alarm = new Datetime($alarm);
                
//                echo "fecha alarma: ".json_encode($alarm);

                $flimite = new Datetime($value['fecha_cumplimiento']);// Guarda en una variable la fecha de la base de datos
                $flimite = strftime("%d-%B-%y",$flimite -> getTimestamp());// Esta da el formato: dia. mes y año, sin guardar las horas 
                $flimite = new Datetime($flimite);//Se guarda en este formato y se reinicializan las horas a 00.

                $hoy = new Datetime();
                $hoy = strftime("%d - %B - %y");
                $hoy = new Datetime($hoy);
                
                if($value['status_tarea']==1)
                {
                    if($flimite <= $hoy)
                    {
                        $rec[$key]['status_grafica'] = "Tiempo vencido";
                    } else{
                        if($alarm <= $hoy)
                        {
                            $rec[$key]['status_grafica'] = "Alarma vencida";
                        } else{
                            $rec[$key]['status_grafica'] = "En tiempo";
                        }
                        
                    }
                    
                }
                
                if($value['status_tarea']==2)
                {
                    $rec[$key]['status_grafica'] = "Suspendido";
                }
                
                if($value['status_tarea']==3)
                {
                    $rec[$key]['status_grafica'] = "Terminado";
                }
                             
                $rec[$key]["avance_programa"]=self::avanceProgramaTareas(array("id_tarea"=>$value["id_tarea"]));   
            }
            
//            echo "valor que llega en model: ".json_encode($checkBoxTerminados);
            return $rec;            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
        
    public function listarTarea($ID_TAREA)
    {
        try 
        {
            $dao=new TareasDAO();
            $rec= $dao->listarTarea($ID_TAREA);
            
            foreach ($rec as $key => $value) 
            {
//                echo "fecha alarma: ".json_encode($value['fecha_alarma']);
                $alarm = new Datetime($value['fecha_alarma']);
                $alarm = strftime("%d-%B-%y",$alarm -> getTimestamp());
                $alarm = new Datetime($alarm);
                
//                echo "fecha alarma: ".json_encode($alarm);

                $flimite = new Datetime($value['fecha_cumplimiento']);// Guarda en una variable la fecha de la base de datos
                $flimite = strftime("%d-%B-%y",$flimite -> getTimestamp());// Esta da el formato: dia. mes y año, sin guardar las horas 
                $flimite = new Datetime($flimite);//Se guarda en este formato y se reinicializan las horas a 00.

                $hoy = new Datetime();
                $hoy = strftime("%d - %B - %y");
                $hoy = new Datetime($hoy);
                
                if($value['status_tarea']==1)
                {
                    if($flimite <= $hoy)
                    {
                        $rec[$key]['status_grafica'] = "Tiempo vencido";
                    } else{
                        if($alarm <= $hoy)
                        {
                            $rec[$key]['status_grafica'] = "Alarma vencida";
                        } else{
                            $rec[$key]['status_grafica'] = "En tiempo";
                        }
                        
                    }
                    
                }
                
                if($value['status_tarea']==2)
                {
                    $rec[$key]['status_grafica'] = "Suspendido";
                }
                
                if($value['status_tarea']==3)
                {
                    $rec[$key]['status_grafica'] = "Terminado";
                }
                             
                $rec[$key]["avance_programa"]=self::avanceProgramaTareas(array("id_tarea"=>$value["id_tarea"]));
            }
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }


    public function empleadosConUsuario()
    {
        try 
        {
            $dao=new TareasDAO();
            $rec= $dao->empleadosConUsuario();
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function responsableTarea()
    {
        try 
        {
            $dao=new TareasDAO();
            $rec= $dao->responsableTarea();
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    
    public function datosParaGraficaTareas()
    {
        try
        {
            $dao=new TareasDAO();
            $rec= $dao->datosParaGraficaTareas();
            
            foreach ($rec as $key => $value) 
            {
                $alarm = new Datetime($value['fecha_alarma']);
                $alarm = strftime("%d-%B-%y",$alarm -> getTimestamp());
                $alarm = new Datetime($alarm);

                $flimite = new Datetime($value['fecha_cumplimiento']);// Guarda en una variable la fecha de la base de datos
                $flimite = strftime("%d-%B-%y",$flimite -> getTimestamp());// Esta da el formato: dia. mes y año, sin guardar las horas 
                $flimite = new Datetime($flimite);//Se guarda en este formato y se reinicializan las horas a 00.

                $hoy = new Datetime();
                $hoy = strftime("%d - %B - %y");
                $hoy = new Datetime($hoy);
                
                if($value['status_tarea']==1)
                {
                    if($flimite <= $hoy)
                    {
                        $rec[$key]['status'] = "Tarea vencida";
                    } else{
                        if($alarm <= $hoy)
                        {
                            $rec[$key]['status'] = "Alarma vencida";
                        } else{
                            $rec[$key]['status'] = "En tiempo";
                        }
                        
                    }
                    
                }
                
                if($value['status_tarea']==2)
                {
                    $rec[$key]['status'] = "Suspendido";
                }
                
//                if($value['status_tarea']==3)
//                {
//                    $rec[$key]['status'] = "Terminado";
//                }
                
            }
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function insertarTarea($tarea,$fecha_alarma,$fecha_cumplimiento,$status_tarea,$observaciones,$id_empleado)
    {
        try
        {
            $contrato= Session::getSesion("s_cont");            
            $id_usuario=Session::getSesion("user");
            $dao=new TareasDAO();
            $exito= $dao->insertarTarea($tarea, $fecha_alarma, $fecha_cumplimiento,$status_tarea,$observaciones,$id_empleado,$id_usuario['ID_USUARIO'],$contrato);
            $tareasModel=new TareasModel();
            if($exito[0] = 1)
            {
                $lista = $dao->listarTarea($exito['id_nuevo']);
                $tareasModel->enviarNotificacionWhenInsert($id_empleado,$tarea);
            }
            else
                return $exito[0];
            
            return $lista;

        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }
    
    public function enviarNotificacionWhenInsert($id_empleado,$tarea)
    {
        try 
        {
            $contrato= Session::getSesion("s_cont");            
            $id_usuario=Session::getSesion("user");
            $dao=new TareasDAO();
            $mensaje= "Se le ha asignado el Tema: ".$tarea.", por el Usuario: ";
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";            
            $idParQuien= $dao->obtenerUsuarioPorIdEmpleado($id_empleado);
            $model=new NotificacionesModel();
            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idParQuien, $mensaje, $tipo_mensaje, $atendido,$asunto,$contrato);

            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }


    public function enviarNotificacionWhenUpdate($ID_EMPLEADO,$TAREA)
    {
        try
        {
            $contrato= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $dao=new TareasDAO();
            $mensaje= "Se ha actualizado el Tema: ".$TAREA.", por el Usuario: ";
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";
            $ID= $dao->obtenerUsuarioPorIdEmpleado($ID_EMPLEADO);
            $model=new NotificacionesModel();
            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $ID, $mensaje, $tipo_mensaje, $atendido,$asunto,$contrato);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }
    
    public function enviarNotificacionWhenCambioDeStatus($ID_EMPLEADO,$TEMA,$STATUS_TAREA,$ID_TAREA)
    {
        try
        {
            $contrato= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $dao=new TareasDAO();
            if($STATUS_TAREA==1)
              $STATUS_TAREA="En Proceso";
            if($STATUS_TAREA==2)
              $STATUS_TAREA="Suspendido";
            if($STATUS_TAREA==3)
              $STATUS_TAREA="Terminado";
            $mensaje= "El Tema: ".$TEMA." ha cambiado a Estatus: ".$STATUS_TAREA.", por el Usuario: ";
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";           
//            $idParaQuien= $dao->obtenerUsuarioPorIdEmpleado($ID_EMPLEADO);
            $id_empleado_plan= $dao->obtenerResponsablePlanTareaPadre($ID_TAREA);
            $idResponsablePlan= $dao->obtenerUsuarioPorIdEmpleado($id_empleado_plan);
            $model=new NotificacionesModel();
            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsablePlan, $mensaje, $tipo_mensaje, $atendido,$asunto,$contrato);
            
//            echo "este es el id: ".json_encode($ID_TAREA);
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }
    
    public function enviarNotificacionWhenRemoveTarea($ID_EMPLEADO,$TAREA)
    {
        try
        {
            $contrato= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $mensaje= "Se asigno a otro usuario el Tema: ".$TAREA.", por el Usuario: ";
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";
            $dao=new TareasDAO();
            $ID= $dao->obtenerUsuarioPorIdEmpleado($ID_EMPLEADO);
            $model=new NotificacionesModel();
            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $ID, $mensaje, $tipo_mensaje, $atendido,$asunto,$contrato);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }


    public function enviarNotificacionWhenRemoveTareaAlNuevoUsuario($ID_EMPLEADO,$TAREA)
    {
        try
        {
            $contrato= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $mensaje= "Se le asigno el Tema: ".$TAREA.", por el Usuario: ";
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";
            $dao=new TareasDAO();
            $ID= $dao->obtenerUsuarioPorIdEmpleado($ID_EMPLEADO);
            $model=new NotificacionesModel();
            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $ID, $mensaje, $tipo_mensaje, $atendido,$asunto,$contrato);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }
    
    
    public function enviarNotificacionWhenDeleteTarea($ID_EMPLEADO,$TAREA)
    {
        try
        {
            $contrato= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $mensaje= "El Tema: ".$TAREA." ha sido Eliminado, por el Usuario: ";
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";
            $dao=new TareasDAO();
            $ID= $dao->obtenerUsuarioPorIdEmpleado($ID_EMPLEADO);
            $model=new NotificacionesModel();
            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $ID, $mensaje, $tipo_mensaje, $atendido,$asunto,$contrato);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }
    
    public function tareasEnAlarma()
    {
        try
        {
            $CONTRATO= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $dao=new TareasDAO();
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";           
            $model=new NotificacionesModel();            
            $rec= $dao->tareasEnAlarma();
//            echo "Este es el rec: ".json_encode($rec);     
            // var_dump($rec);
            foreach ($rec as $value) 
            {                
                $TAREA= $value['tarea'];
                $id_empleado_tema= $value['id_empleado'];
                $idResponsableTema= $dao->obtenerUsuarioPorIdEmpleado($id_empleado_tema);
                $id_empleado_plan= $dao->obtenerResponsablePlanTareaPadre($value['id_tarea']);
                $idResponsablePlan= $dao->obtenerUsuarioPorIdEmpleado($id_empleado_plan);
                $mensaje= "El Tema: ".$TAREA." esta en Alarma, por el Usuario: ";
                $resultado= $dao->veriricarSiYaExisteLaNotificacion($mensaje);
//                echo "este es el resultado: ".$resultado;
                if($resultado==0)
                {
                    if($idResponsableTema==$idResponsablePlan)
                    {
                        if($idResponsableTema!=0)
                        {
                            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsableTema, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                        }    
                    }else{
                        if($idResponsableTema!=0)
                        {
                            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsableTema, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                        }
                        if($idResponsablePlan!=0)
                        {
                            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsablePlan, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                        }
                    }   
                }    
            }

            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function tareasVencidas()
    {
        try
        {
            $CONTRATO= Session::getSesion("s_cont");
            $id_usuario=Session::getSesion("user");
            $dao=new TareasDAO();
            $tipo_mensaje=0;
            $atendido= 'false';
            $asunto="";            
            $model=new NotificacionesModel();            
            $rec= $dao->tareasVencidas();
            
            // var_dump($rec);
            foreach ($rec as $value)
            {
                $TAREA= $value['tarea'];
                $id_empleado_tema= $value['id_empleado'];                
                $idResponsableTema= $dao->obtenerUsuarioPorIdEmpleado($id_empleado_tema);
                $id_empleado_plan= $dao->obtenerResponsablePlanTareaPadre($value['id_tarea']);
                $idResponsablePlan= $dao->obtenerUsuarioPorIdEmpleado($id_empleado_plan);                
                $mensaje = "El Tema: ".$TAREA." esta con Fecha de Cumplimiento Vencida, por el Usuario: ";
                $resultado = $dao->veriricarSiYaExisteLaNotificacion($mensaje);
                
                if($resultado==0)
                {
                    if($idResponsableTema==$idResponsablePlan)
                    {
                        if($idResponsableTema!=0)
                        {
                            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsableTema, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                        }    
                    }else{
                        if($idResponsableTema!=0)
                        {
                            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsableTema, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                        }
                        if($idResponsablePlan!=0)
                        {
                            $rec= $model->guardarNotificacionHibry($id_usuario['ID_USUARIO'], $idResponsablePlan, $mensaje, $tipo_mensaje, $atendido,$asunto,$CONTRATO);
                        }
                    }
                }
//                echo "responsables tema: ". json_decode($idResponsableTema);
//                echo "responsables plan: ". json_decode($idResponsablePlan);
            }
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function eliminarTarea($ID_TAREA)
    {
        try
        {
            $dao= new TareasDAO();
            $rec= $dao->eliminarTarea($ID_TAREA);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function verificarSiYaExisteLaTarea($cualverificar, $cadena)
    {
        try
        {
            $dao=new TareasDAO();
            $rec= $dao->verificarSiYaExisteLaTarea($cualverificar, $cadena);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
     public static function avanceProgramaTareas($VALUES)
    {
        try
        {
            $query="SELECT SUM(tbgantt_tareas.progress)/COUNT(tbgantt_tareas.progress) AS total_avance
                    FROM gantt_tareas tbgantt_tareas
                    WHERE tbgantt_tareas.id_tarea= ".$VALUES['id_tarea']."   and tbgantt_tareas.parent=0";
//            AND tbgantt_tareas.parent=0
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]["total_avance"];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
            
}


?>