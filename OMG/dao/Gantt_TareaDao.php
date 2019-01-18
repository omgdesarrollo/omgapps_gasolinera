<?php
require_once '../ds/AccesoDB.php';
class Gantt_TareaDao {
    public function listarRegistrosGanttTareas($VALUE) 
    {
        $usuario=Session::getSesion("user")["ID_USUARIO"];
        try
        {
            $query="SELECT tbgantt_tareas.user,tbgantt_tareas.id, tbgantt_tareas.text, tbgantt_tareas.start_date, tbgantt_tareas.duration,
            tbgantt_tareas.progress, tbgantt_tareas.parent, tbgantt_tareas.ponderado_programado,tbgantt_tareas.notas,tbgantt_tareas.status,tbgantt_tareas.notificacion_porcentaje_programado,
            tbusuarios.id_usuario, IF(tbusuarios.ID_USUARIO=$usuario,'true','false')  as manipulacion_tarea
            FROM gantt_tareas tbgantt_tareas
            
            JOIN usuarios tbusuarios  ON tbusuarios.ID_EMPLEADO=tbgantt_tareas.user
            WHERE tbgantt_tareas.id_tarea= $VALUE";

            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }        
    }
    
    
    public function listarTareaGantt($ID)
    {
        try 
        {
            $query="SELECT tbgantt_tareas.id,tbgantt_tareas.text,tbgantt_tareas.start_date,tbgantt_tareas.duration,tbgantt_tareas.progress,
                    tbgantt_tareas.parent,tbgantt_tareas.user,tbgantt_tareas.id_tarea,tbgantt_tareas.notas,tbgantt_tareas.status,tbgantt_tareas.notificacion_porcentaje_programado 	
                    FROM gantt_tareas tbgantt_tareas
                    WHERE tbgantt_tareas.id=$ID";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    


    public function insertarGanttTareas($VALUES)
    {
        try
        {
            $query="INSERT INTO gantt_tareas (id,text,start_date,duration,progress,parent,user,id_tarea,ponderado_programado,notas,status,notificacion_porcentaje_programado)
                    VALUES('".$VALUES["id"]."','".$VALUES["text"]."','".$VALUES["start_date"]."','".$VALUES["duration"]."',
                    '".$VALUES["progress"]."','".$VALUES["parent"]."','".$VALUES["user"]."','".$VALUES["id_tarea"]."',-1,'campo no se usa','".$VALUES["status"]."',".$VALUES["notificacion_porcentaje_programado"].")";
//            echo "values: ".json_encode($query);
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
        
    }
    
    
    public function actualizarGanttTareas($QUERY)
    {
        try
        {
            $db=  AccesoDB::getInstancia();
            $update = $db->executeUpdateRowsAfected($QUERY);       

            return $update;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function actualizarExisteProgramaTareas($VALUES)
    {
        try
        {
            $query="UPDATE tareas SET existe_programa=".$VALUES["existeprograma"]."  WHERE id_tarea=".$VALUES["id_tarea"]."";
            
            $db=  AccesoDB::getInstancia();
            $update = $db->executeUpdateRowsAfected($query);
            return $update;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    
    public function actualizarAvanceProgramaTareas($VALUES)
    {
        try
        {
            $query="UPDATE tareas SET avance_programa= ".$VALUES["avance"]."  WHERE id_tarea= ".$VALUES["id_tarea"]."";
            
            $db=  AccesoDB::getInstancia();
            $update = $db->executeUpdateRowsAfected($query);
            
            return $update;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function eliminarGanttTareas($VALUES)
    {
        try
        {
            $query="DELETE FROM gantt_tareas WHERE gantt_tareas.id=$VALUES";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQueryUpdate($query);
            
//            echo "este es query eliminar: ".json_encode($query);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerDatosParaEliminarTarea($id)
    {
        try 
        {
            $query="SELECT tbgantt_tareas.id, tbgantt_tareas.text, tbgantt_tareas.user, tbgantt_tareas.id_tarea
                    FROM gantt_tareas tbgantt_tareas
                    WHERE tbgantt_tareas.id=$id";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
//            echo "este es el query obtener: ".json_encode($query);
        return $lista[0];            
        } catch (Exception $ex) 
        {
            
        }
    }
    
    public function verificarTareaExiste($VALUES)
    {
        try
        {
            $query="SELECT COUNT(*) as cantidad 
                    FROM gantt_tareas tbgantt_tareas  
                    WHERE tbgantt_tareas.id= '".$VALUES["id"]."'";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function verificarParentHijoEnTarea($VALUES)
    {
        try
        {
            $query="SELECT if(count(*)=0,'false','true') as t 
                    FROM gantt_tareas tbgantt_tareas  
                    WHERE tbgantt_tareas.parent='".$VALUES['id']."'";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]["t"];
        } catch (Exception$ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function AvanceProgramaTareas($VALUES)
    {
        try
        {
            $query="SELECT SUM(tbgantt_tareas.progress)/COUNT(tbgantt_tareas.progress) AS total_avance
                    FROM gantt_tareas tbgantt_tareas
                    WHERE tbgantt_tareas.id_tarea= ".$VALUES['id_tarea']."";
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
     
    public function verificarSiExisteIDTareaEnGanttTareas($VALUES)
    {
        try
        {
            $query="SELECT IF(COUNT(*)=0,'false','true') AS existe_tarea
                    FROM gantt_tareas tbgantt_tareas
                    WHERE tbgantt_tareas.id_tarea= '".$VALUES['id_tarea']."'";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]["existe_tarea"];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function listarEmpleadosNombreCompleto()
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
        }  catch (Exception $ex){
        }   
    }   
    
    public function guardarNotificacionResponsable($id_usuario,$id_para,$mensaje,$tipo,$atendido,$asunto,$CONTRATO)
    {
        try
        {

            $query="INSERT INTO notificaciones  (id_de,id_para,id_contrato,tipo_mensaje,mensaje,atendido,asunto)
            VALUES($id_usuario,$id_para,$CONTRATO,$tipo,'$mensaje','$atendido','$asunto')";

            $db= AccesoDB::getInstancia($query);
            $lista=$db->executeQueryUpdate($query);

            return $lista;
        } catch (Exception $ex) {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerDatosTema($id_tema)
    {
        try 
        {
            $query="SELECT tbtareas.tarea
                    FROM tareas tbtareas
                    WHERE tbtareas.id_tarea=$id_tema";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['tarea'];            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }


//    public function calcularPorcentajePorActividad($VALUE)
//    {
//        try 
//        {
//            $query="SELECT tbgantt_tareas.id, tbgantt_tareas.text,tbgantt_tareas.duration	                 
//                    FROM gantt_tareas tbgantt_tareas
//                    WHERE tbgantt_tareas.id_tarea=$VALUE AND tbgantt_tareas.parent !=0";
//            
//            $db=  AccesoDB::getInstancia();
//            $lista=$db->executeQuery($query);
//
//            return $lista[0]; 
////            return $lista; 
//        } catch (Exception $ex) 
//        {
//            throw $ex;
//            return -1;
//        }
//    }
    
    public function totalDeDiasPorTarea($VALUE)
    {
        try 
        {
            // $query="SELECT SUM(tbgantt_tareas.duration) AS total	
            //         FROM gantt_tareas tbgantt_tareas
            //         WHERE tbgantt_tareas.id_tarea=$VALUE AND tbgantt_tareas.parent !=0";

            $query="SELECT distinct tbgantt_tareas.parent id
                FROM gantt_tareas tbgantt_tareas
                WHERE tbgantt_tareas.id_tarea=$VALUE";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    public function totalPadreCero($VALUE)
    {
        try 
        {
            // $query="SELECT SUM(tbgantt_tareas.duration) AS total	
            //         FROM gantt_tareas tbgantt_tareas
            //         WHERE tbgantt_tareas.id_tarea=$VALUE AND tbgantt_tareas.parent !=0";

            $query="SELECT count(*) as totalPadre 
                FROM gantt_tareas tbgantt_tareas
                WHERE tbgantt_tareas.id_tarea=$VALUE and tbgantt_tareas.parent = 0";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]["totalPadre"];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    public function guardarPonderados($id,$ponderado_programado)
    {
        try
        {
            $query = "update gantt_tareas set ponderado_programado = $ponderado_programado where id = $id";
            $db = AccesoDB::getInstancia();
            $res = $db->executeUpdateRowsAfected($query);

            return $res;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function guardarNota($Lista)
    {
        try 
        {
            $cadena= $Lista['notas'];
            $id= $Lista['id'];
            $query="UPDATE gantt_tareas SET notas='$cadena'
                    WHERE gantt_tareas.id=$id";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function guardarStatus($Lista)
    {
        try 
        {
            $status= $Lista['status'];
            $id= $Lista['id'];
            $query="UPDATE gantt_tareas SET notas=$status
                    WHERE gantt_tareas.id=$id";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
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
    
    public function obtenerIdDelEmpleadoResponsableDelTema($id_tarea)
    {
        try 
        {
            $query="SELECT tbtareas.id_empleado
                    FROM tareas tbtareas
                    JOIN gantt_tareas tbgantt_tareas ON tbgantt_tareas.id_tarea=tbtareas.id_tarea
                    WHERE tbgantt_tareas.id=$id_tarea";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista[0]['id_empleado'];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
    //area de notas historicas por actividad
    public function notasHistoricas($value){
        
        try{

           $query=" SELECT  tbgantt_notas_historico_temas.historico_notas,tbgantt_notas_historico_temas.id_tarea, tbgantt_notas_historico_temas.fecha_creacion_nota,
		    tbgantt_notas_historico_temas.quien_introdujo_el_registro, tbusuario.nombre_usuario as nombre_usario_quien_creo_la_nota   
                    FROM gantt_tareas tbgantt_tareas       
                    JOIN gantt_notas_historico_temas tbgantt_notas_historico_temas ON tbgantt_notas_historico_temas.id_tarea=tbgantt_tareas.id
                    JOIN usuarios tbusuario ON tbusuario.ID_USUARIO=tbgantt_notas_historico_temas.quien_introdujo_el_registro
                    WHERE tbgantt_tareas.id_tarea=".$value["id_tarea_general_externa"]."  and tbgantt_notas_historico_temas.id_tarea=".$value["id_tarea_gantt_actividad"]."     order by tbgantt_notas_historico_temas.fecha_creacion_nota DESC";
            
            
            //            $parametros=array("id_usuario"=>$value["id_usuario"],"id_tarea_general_externa"=>$value["id_tarea_general_externa"]);
            $db=  AccesoDB::getInstancia();

            $lista=$db->executeQuery($query);
//              $lista=$db->executeQuery(AccesoDB::prepararConsulta($query, $parametros));
            return $lista;
        } catch (Exception $ex) {
            throw $ex;
            return -1;
        }
   
    } 
     public function insertarNotasHistoricas($VALUES)
    {
        try
        {
            $query="INSERT INTO gantt_notas_historico_temas (id_tarea,historico_notas,quien_introdujo_el_registro)
                    VALUES('".$VALUES["id_actividad"]."','".$VALUES["nota"]."','".$VALUES["quiencreolanota"]."')";

            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
    
    
}

?>