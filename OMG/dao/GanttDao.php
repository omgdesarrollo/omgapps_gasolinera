<?php

require_once '../ds/AccesoDB.php';
class GanttDao {
    //put your code here
    
    
    
    public function obtenerTareasCompletasPorFolioEntrada($VALUE){
        try
        { 
           $query="SELECT tbempleados.id_empleado user, tbgantt_tasks.id, tbgantt_tasks.text, tbgantt_tasks.start_date, tbgantt_tasks.duration,
 		   tbgantt_tasks.progress, tbgantt_tasks.parent, tbgantt_tasks.ponderado_programado, tbgantt_tasks.notas, tbgantt_tasks.status  
                   FROM gantt_seguimiento_entrada tbgantt_seguimiento_entrada
                   JOIN gantt_tasks tbgantt_tasks ON tbgantt_tasks.id=tbgantt_seguimiento_entrada.id_gantt
                   JOIN empleados tbempleados ON tbempleados.id_empleado=tbgantt_seguimiento_entrada.id_empleado
                   WHERE tbgantt_seguimiento_entrada.id_seguimiento_entrada=$VALUE";
           
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
            
          } catch (Exception $ex) {
              throw $ex;
              return false;
        }
    }
    
    
    public function insertarTareasGantt($value){
        try{
           $query="INSERT INTO gantt_tasks(id, text, start_date, duration, progress, parent, ponderado_programado, notas, status)
                   VALUES('".$value["id"]."','".$value["text"]."','".$value["start_date"]."','".$value["duration"]."','".$value["progress"]."',
                          '".$value["parent"]."',-1,'".$value["notas"]."','".$value["status"]."')";
//            echo "d  ".$query;
            $db= AccesoDB::getInstancia();
            $exito=$db->executeQueryUpdate($query);
            
            return $exito;
        } catch (Exception $ex) {
            throw $ex;
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
    

    
    public function insertarTareasConFolioEntrada_de_seguimiento_entrada($value){
        try{
            $query="INSERT INTO gantt_seguimiento_entrada(gantt_seguimiento_entrada.ID_GANTT,gantt_seguimiento_entrada.id_seguimiento_entrada,gantt_seguimiento_entrada.id_empleado) "
                    . "VALUES('".$value["id"]."','".$value["id_seguimiento_entrada"]."','".$value["id_empleado"]."');";
//            echo "query de tareas  ".$query;
            
            $db= AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
            throw  $ex;
        }
    }
    
    
    
    
    
    
    //esta funcion actualiza en la tabla llamada gantt_seguimiento_entrada por id gantt
    public function updateTareasId_EmpleadoXIdGantt_En_Tabla_Seguimiento_entrada($value){
        try{
            
        $query="UPDATE gantt_seguimiento_entrada set gantt_seguimiento_entrada.id_empleado='".$value["user"]."' where gantt_seguimiento_entrada.id_gantt='".$value['id']."'";
        $db= AccesoDB::getInstancia();
        $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function verificarTareaExiste($value){
        try{
            $query="select count(*) as cantidad from gantt_tasks tble_gantt_task  where tble_gantt_task.id='".$value["id"]."'";
            $db= AccesoDB::getInstancia();
            $list=$db->executeQuery($query);
//            echo ($list[0]["cantidad"]);
//            echo json_encode($list[0]["cantidad"]);
            return $list;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function updateTareas($value){
        try{
        $query="UPDATE gantt_tasks set gantt_tasks.text='".$value["text"]."',gantt_tasks.start_date='".$value["start_date"]."',gantt_tasks.duration='".$value["duration"]."',gantt_tasks.progress='".$value["progress"]."',gantt_tasks.parent='".$value["parent"]."',gantt_tasks.status='".$value["status"]."' where gantt_tasks.id='".$value['id']."'";
            $db= AccesoDB::getInstancia();
            $list=$db->executeQueryUpdate($query);
//            echo "s  ".$list;
            return $list;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    public function deleteTareas($value){
        try{
            $query="delete from  gantt_tasks  where gantt_tasks.id='".$value["id"]."'";
            $db= AccesoDB::getInstancia();
            $list=$db->executeQueryUpdate($query);
            return $list;
        } catch (Exception $ex) {
            throw  $ex;
        }
    }
//    public function deleteTareasHijas($value){
//        try{
//            $query="delete from  gantt_tasks  where gantt_tasks.parent='".$value["id"]."'";
//            $db= AccesoDB::getInstancia();
//            $list=$db->executeQueryUpdate($query);
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
    
    
    public function deleteTareasDe_Gantt_Seguimiento_Entrada($value){
        try{
            $query="delete from gantt_seguimiento_entrada where gantt_seguimiento_entrada.id_gantt='".$value["id"]."'";
            $db= AccesoDB::getInstancia();
            $list=$db->executeQueryUpdate($query);
        } catch (Exception $ex) {
            throw  $ex;
        }
    }
    public function obtenerFolioEntradaSeguimiento ($ID_SEGUIMIENTO)
    {
        try
        {
            $query="SELECT tbdocumento_entrada.folio_entrada,
		           tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno	

                    FROM seguimiento_entrada tbseguimiento_entrada

                    JOIN documento_entrada tbdocumento_entrada ON 
                         tbdocumento_entrada.id_documento_entrada=tbseguimiento_entrada.id_documento_entrada

                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbseguimiento_entrada.id_empleado
 
                    WHERE tbseguimiento_entrada.id_seguimiento_entrada=$ID_SEGUIMIENTO";
            
            $db= AccesoDB::getInstancia();
            $list= $db->executeQueryUpdate($query);
            
            return $list;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return $ex;
        }
    }
    public function deleteTareasAjax($value){
        try{
             $query="delete from  gantt_tasks  where gantt_tasks.id='".$value["id"]."'";
            $db= AccesoDB::getInstancia();
          $db->executeQueryUpdate($query);
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    
    public function calculoAvanceProgramaGeneral($id_seguimiento_que_lleva_al_folio_de_entrada)
    {
        try
        {
           $query="SELECT SUM(tbgantt_tasks.progress)/COUNT(tbgantt_tasks.progress) AS total_avance_programa 		
                   FROM gantt_seguimiento_entrada tbgantt_seguimiento_entrada

                   JOIN gantt_tasks tbgantt_tasks ON tbgantt_tasks.id=tbgantt_seguimiento_entrada.id_gantt  

                   WHERE tbgantt_seguimiento_entrada.id_seguimiento_entrada='".$id_seguimiento_que_lleva_al_folio_de_entrada."' AND tbgantt_tasks.parent=0";
           $db= AccesoDB::getInstancia();
           $list= $db->executeQuery($query);
           
           return $list;
           
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
   public function updateAvanceProgramaGeneral($value){
        try{
            $query="update databaseomg.seguimiento_entrada set databaseomg.seguimiento_entrada.AVANCE_PROGRAMA='".$value["avance_programa"]."' where databaseomg.seguimiento_entrada.ID_SEGUIMIENTO_ENTRADA='".$value["id_seguimiento"]."'";
            $db= AccesoDB::getInstancia();
            $list= $db->executeQueryUpdate($query);
            
        } catch (Exception $ex) {
            throw $ex;
        }
   }
   
   public function listarEmpleadosNombreCompleto()
    {
        try
       {
            $query="SELECT empleados.id_empleado, CONCAT(empleados.nombre_empleado,' ',empleados.apellido_paterno,' ',empleados.apellido_materno) 
                    AS nombre_completo FROM empleados";

            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        }  catch (Exception $ex){
            throw $ex;
            return false;
        }
    }
    
    
    public function totalDeDiasPorTarea($VALUE)
    {
        try 
        {
            $query="SELECT distinct 
 		   tbgantt_tasks.parent id  
                   FROM gantt_seguimiento_entrada tbgantt_seguimiento_entrada
                   JOIN gantt_tasks tbgantt_tasks ON tbgantt_tasks.id=tbgantt_seguimiento_entrada.id_gantt             
                   WHERE tbgantt_seguimiento_entrada.id_seguimiento_entrada=$VALUE";
//            $query="SELECT distinct tbgantt_tareas.parent id
//                FROM gantt_task tbgantt_task
//                WHERE tbgantt_task.id_tarea=$VALUE";
            
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
               $query="SELECT count(*) as totalPadre 
                   FROM gantt_seguimiento_entrada tbgantt_seguimiento_entrada
                    JOIN gantt_tasks tbgantt_tasks ON tbgantt_tasks.id=tbgantt_seguimiento_entrada.id_gantt
                   WHERE tbgantt_seguimiento_entrada.id_seguimiento_entrada=$VALUE and tbgantt_tasks.parent = 0";

//            $query="SELECT count(*) as totalPadre 
//                FROM gantt_tareas tbgantt_tareas
//                WHERE tbgantt_tareas.id_tarea=$VALUE and tbgantt_tareas.parent = 0";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]["totalPadre"];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
}

?>