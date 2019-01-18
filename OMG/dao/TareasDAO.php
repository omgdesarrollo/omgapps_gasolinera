<?PHP
require_once '../ds/AccesoDB.php';

class TareasDAO{
    
    
    public function listarTareas($id_empleado,$id_usuario,$cumplimiento,$checkBoxTerminados)
    {
        try
        {            
            $query="SELECT tbtareas.id_tarea, tbtareas.referencia, tbtareas.tarea, tbtareas.fecha_creacion, tbtareas.fecha_alarma,
                    tbtareas.fecha_cumplimiento, tbtareas.status_tarea, tbtareas.observaciones, tbtareas.existe_programa,
                    tbtareas.avance_programa, tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ', tbempleados.apellido_paterno,' ', tbempleados.apellido_materno) 
                    AS nombre_completo                    
                    FROM tareas tbtareas
                    LEFT JOIN empleados tbempleados ON tbempleados.id_empleado=tbtareas.id_empleado                  
                    LEFT JOIN gantt_tareas tbgantt_tareas ON tbgantt_tareas.id_tarea=tbtareas.id_tarea                    
                    WHERE (tbtareas.id_empleado=$id_empleado OR tbtareas.creador_tarea=$id_usuario OR tbgantt_tareas.user=$id_empleado) AND tbtareas.cumplimiento=$cumplimiento";
            
            if($checkBoxTerminados=="false")
            {
                $query.=" AND tbtareas.status_tarea!=3 GROUP BY tbtareas.tarea";
//                echo "entro al if: ". json_encode($query);
            }else
            {
                if($checkBoxTerminados=="true")
                {
                    $query.=" AND tbtareas.status_tarea=3 GROUP BY tbtareas.tarea";
//                    echo "entro al else: ". json_encode($query);
                }
            }
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function listarTarea($ID_TAREA)
    {
        try
        {
            // $query="SELECT tbtareas.id_tarea, tbtareas.referencia, tbtareas.tarea, tbtareas.fecha_creacion, tbtareas.fecha_alarma,
            //         tbtareas.fecha_cumplimiento, tbtareas.status_tarea, tbtareas.observaciones, tbtareas.existe_programa, tbtareas.avance_programa,		 
            //         tbempleados.id_empleado, tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno
            //         FROM tareas tbtareas
            //         JOIN empleados tbempleados ON tbempleados.id_empleado=tbtareas.id_empleado
            //         WHERE tbtareas.id_tarea=$ID_TAREA";

            $query="SELECT tbtareas.id_tarea, tbtareas.referencia, tbtareas.tarea, tbtareas.fecha_creacion, tbtareas.fecha_alarma,
            tbtareas.fecha_cumplimiento, tbtareas.status_tarea, tbtareas.observaciones, tbtareas.existe_programa,
            tbtareas.avance_programa, tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ', tbempleados.apellido_paterno,' ', tbempleados.apellido_materno) 
            AS nombre_completo                    
            FROM tareas tbtareas
            LEFT JOIN empleados tbempleados ON tbempleados.id_empleado=tbtareas.id_empleado                  
            LEFT JOIN gantt_tareas tbgantt_tareas ON tbgantt_tareas.id_tarea=tbtareas.id_tarea                    
            WHERE tbtareas.id_tarea = $ID_TAREA ";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
            
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
            $query="SELECT tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
                    AS nombre_completo
                    FROM usuarios tbusuarios
                    JOIN  empleados tbempleados ON tbempleados.id_empleado=tbusuarios.id_empleado";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
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
            $query="SELECT tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
                    AS nombre_completo
                    FROM usuarios tbusuarios
                    JOIN  empleados tbempleados ON tbempleados.id_empleado=tbusuarios.id_empleado";    
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;            
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
            $query="SELECT tbtareas.id_tarea, tbtareas.tarea, tbtareas.fecha_creacion, tbtareas.fecha_alarma, tbtareas.fecha_cumplimiento,
                    tbtareas.status_tarea
                    FROM tareas tbtareas";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function insertarTarea($tarea,$fecha_alarma,$fecha_cumplimiento,$status_tarea,$observaciones,$id_empleado,$creador_tarea,$contrato)
    {
        try
        {
            $query_obtenerMaximo_mas_uno="SELECT max(id_tarea)+1 as id_tarea FROM tareas";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_tarea"];
            }
             if($id_nuevo==NULL){
                $id_nuevo=0;
            }
            
            $query="INSERT INTO tareas(id_tarea,tarea,fecha_alarma,fecha_cumplimiento,status_tarea,observaciones,id_empleado,creador_tarea,cumplimiento)
				values($id_nuevo,'$tarea','$fecha_alarma','$fecha_cumplimiento',$status_tarea,'$observaciones',$id_empleado,$creador_tarea,$contrato)";
            
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            
//            echo "este es el query: ", json_encode($query);
            return ($exito != 0)?[0=>1,"id_nuevo"=>$id_nuevo]:[0=>0,"id_nuevo"=>$id_nuevo ];
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
            $query="DELETE FROM tareas
                    WHERE tareas.existe_programa=0 AND tareas.id_tarea=$ID_TAREA";
            
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return-1;
        }
    }
    
    public function obtenerUsuarioPorIdEmpleado($ID_EMPLEADO)
    {
        try
        {
            $query="SELECT tbusuarios.id_usuario
                    FROM usuarios tbusuarios
                    WHERE tbusuarios.id_empleado=$ID_EMPLEADO";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
//            echo "este es el query id_usuario: ".json_encode($query);
            return $lista[0]['id_usuario'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
        
    }
    
        public function obtenerEmpleadoPorIdUsuario($id_usuario)
    {
        try
        {
            $query="SELECT tbusuarios.id_empleado
                    FROM usuarios tbusuarios
                    WHERE tbusuarios.id_usuario=$id_usuario";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
//            echo "este es el query id_usuario: ".json_encode($query);
            return $lista[0]['id_empleado'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
        
    }
    
    public function verificarSiYaExisteLaTarea($cualverificar,$cadena)
    {
      try
      {
          $query="SELECT tbtareas.tarea
                  FROM tareas tbtareas
                  WHERE tbtareas.$cualverificar = '$cadena'";
          $db=  AccesoDB::getInstancia();
          $lista=$db->executeQuery($query);
            
        return $lista;          
      } catch (Exception $ex)
      {
          throw $ex;
          return -1;
      }
    }
    
//    SECCION NOTIFICACIONES 
    public function tareasEnAlarma()
    {
        try
        {
            $query="SELECT tbtareas.id_tarea, tbtareas.tarea, tbtareas.id_empleado
                    FROM tareas tbtareas
                    JOIN gantt_tareas tbgantt_tareas ON tbgantt_tareas.id_tarea = tbtareas.id_tarea
                    WHERE tbtareas.fecha_alarma<=CURDATE() AND tbtareas.fecha_cumplimiento>CURDATE() AND tbtareas.status_tarea=1";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;    
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function veriricarSiYaExisteLaNotificacion($MENSAJE)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM notificaciones tbnotificaciones
                    WHERE tbnotificaciones.mensaje = '$MENSAJE'";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
//            echo "este es el query resultado: ".json_encode($query);
            return $lista[0]['resultado'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerResponsablePlanTareaPadre($id_tarea)
    {
        try 
        {
            $query="SELECT tbgantt_tareas.user,tbgantt_tareas.fecha_creado 
                    FROM gantt_tareas tbgantt_tareas
                    WHERE fecha_creado  = (SELECT MIN(fecha_creado) FROM gantt_tareas WHERE gantt_tareas.id_tarea = $id_tarea)";
            // echo $query;
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
        //    echo $query;
        //    $tam = sizeof($lista);
        //    if($tam!=0)
                return $lista[0]['user'];
            // else
            //     return -2;
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
            $query="SELECT DISTINCT tbtareas.id_tarea, tbtareas.tarea, tbtareas.id_empleado
                    FROM tareas tbtareas
                    JOIN gantt_tareas tbgantt_tareas ON tbgantt_tareas.id_tarea = tbtareas.id_tarea
                    WHERE tbtareas.fecha_cumplimiento <= CURDATE() AND tbtareas.status_tarea = 1";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    

}

?>