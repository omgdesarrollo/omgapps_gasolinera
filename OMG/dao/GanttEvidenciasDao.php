<?php

require_once '../ds/AccesoDB.php';
class GanttEvidenciasDao {
    //put your code here
    
    
    
    public function obtenerT($v){
        try
        { 
           $query="SELECT tbevidencias.user, tbevidencias.id, tbevidencias.text, tbevidencias.start_date, tbevidencias.duration, tbevidencias.progress,tbevidencias.parent,  
                  tbevidencias.ponderado_programado,tbevidencias.notas,tbevidencias.status FROM gantt_evidencias tbevidencias WHERE tbevidencias.id_evidencias=".$v['id_evidencia'];
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
            
          } catch (Exception $ex) {
              throw $ex;
              return false;
        }
    }
    
    public function verificarsitienedescendencia($v){
         try
        { 
           $query="SELECT if(count(*)=0,'false','true') as t
               FROM gantt_evidencias tbevidencias WHERE tbevidencias.parent=".$v["id"];
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista[0]["t"];
            
          } catch (Exception $ex) {
              throw $ex;
              return false;
        }
    }
    
    
    
     public function totalDeDiasPorTarea($VALUE)
    {
        try 
        {
            // $query="SELECT SUM(tbgantt_tareas.duration) AS total	
            //         FROM gantt_tareas tbgantt_tareas
            //         WHERE tbgantt_tareas.id_tarea=$VALUE AND tbgantt_tareas.parent !=0";

            $query="SELECT distinct tbgantt_evidencias.parent id
                FROM gantt_evidencias tbgantt_evidencias
                WHERE tbgantt_evidencias.id_evidencias=$VALUE";
            
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
                FROM gantt_evidencias tbgantt_evidencias
                WHERE tbgantt_evidencias.id_evidencias=$VALUE and tbgantt_evidencias.parent = 0";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]["totalPadre"];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    public function insertarTareasGantt($value){
        try{
           $query="INSERT INTO gantt_evidencias(gantt_evidencias.id,gantt_evidencias.text,gantt_evidencias.start_date,
                   gantt_evidencias.duration,gantt_evidencias.progress,gantt_evidencias.parent,gantt_evidencias.user,gantt_evidencias.id_evidencias,gantt_evidencias.ponderado_programado,gantt_evidencias.notas,gantt_evidencias.status)

                   VALUES('".$value["id"]."','".$value["text"]."','".$value["start_date"]."','".$value["duration"]."',
                          '".$value["progress"]."','".$value["parent"]."','".$value["user"]."','".$value["id_evidencia"]."',-1,'".$value["notas"]."','".$value["status"]."');";
           
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
      public static function actualizarGanttTareasConstruccionQuery($COLUMNAS,$ID)
    {
        try
        {
            $dao=new Gantt_TareaDao();
            $query= "UPDATE gantt_tareas SET";
            $index=0;
            foreach ($COLUMNAS as $key => $value) 
            { 
                if($index!=0)
                {
                    $query.=" , ";
                }
                
                $query .= " $key = '$value'";
                $index++;
            }
            
            $query.= "WHERE id = $ID";
            $update= $dao->actualizarGanttTareas($query);
            return ($update!=0)?1:0;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
    
    
    
//    public function insertarTareasConFolioEntrada_de_seguimiento_entrada($value){
//        try{
//            $query="INSERT INTO gantt_seguimiento_entrada(gantt_seguimiento_entrada.ID_GANTT,gantt_seguimiento_entrada.id_seguimiento_entrada,gantt_seguimiento_entrada.id_empleado) "
//                    . "VALUES('".$value["id"]."','".$value["id_seguimiento_entrada"]."','".$value["id_empleado"]."');";
////            echo "query de tareas  ".$query;
//            
//            $db= AccesoDB::getInstancia();
//            $db->executeQueryUpdate($query);
//        } catch (Exception $ex) {
//            throw  $ex;
//        }
//    }
    //esta funcion actualiza en la tabla llamada gantt_seguimiento_entrada por id gantt
//    public function updateTareasId_EmpleadoXIdGantt_En_Tabla_Seguimiento_entrada($value){
//        try{
//            
//        $query="UPDATE gantt_seguimiento_entrada set gantt_seguimiento_entrada.id_empleado='".$value["user"]."' where gantt_seguimiento_entrada.id_gantt='".$value['id']."'";
//        $db= AccesoDB::getInstancia();
//        $db->executeQueryUpdate($query);
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
    public function verificarTareaExiste($value){
        try{
            $query="select count(*) as cantidad from gantt_evidencias tb_gantt_evidencias  where tb_gantt_evidencias.id='".$value["id"]."'";
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
        $query="UPDATE gantt_evidencias set gantt_evidencias.text='".$value["text"]."',gantt_evidencias.start_date='".$value["start_date"]."',
		 gantt_evidencias.duration='".$value["duration"]."',gantt_evidencias.progress='".$value["progress"]."',
		 gantt_evidencias.parent='".$value["parent"]."',gantt_evidencias.user='".$value["user"]."' where gantt_evidencias.id='".$value['id']."'";
        
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
            $query="delete from  gantt_evidencias  where gantt_evidencias.id='".$value["id"]."'";
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
    
    
//    public function deleteTareasDe_Gantt_Seguimiento_Entrada($value){
//        try{
//            $query="delete from gantt_seguimiento_entrada where gantt_seguimiento_entrada.id_gantt='".$value["id"]."'";
//            $db= AccesoDB::getInstancia();
//            $list=$db->executeQueryUpdate($query);
//        } catch (Exception $ex) {
//            throw  $ex;
//        }
//    }
//    public function obtenerFolioEntradaSeguimiento ($ID_SEGUIMIENTO)
//    {
//        try
//        {
//            $query="SELECT tbdocumento_entrada.folio_entrada,
//		           tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno	
//
//                    FROM seguimiento_entrada tbseguimiento_entrada
//
//                    JOIN documento_entrada tbdocumento_entrada ON 
//                         tbdocumento_entrada.id_documento_entrada=tbseguimiento_entrada.id_documento_entrada
//
//                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbseguimiento_entrada.id_empleado
// 
//                    WHERE tbseguimiento_entrada.id_seguimiento_entrada=$ID_SEGUIMIENTO";
//            
//            $db= AccesoDB::getInstancia();
//            $list= $db->executeQueryUpdate($query);
//            
//            return $list;
//            
//        } catch (Exception $ex)
//        {
//            throw $ex;
//            return $ex;
//        }
//    }
    public function deleteTareasAjax($value){
        try{
             $query="delete from  gantt_evidencias  where gantt_evidencias.id='".$value["id"]."'";
            $db= AccesoDB::getInstancia();
          $db->executeQueryUpdate($query);
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    
//    public function calculoAvanceProgramaGeneral($id_seguimiento_que_lleva_al_folio_de_entrada)
//    {
//        try
//        {
//           $query="SELECT SUM(tbgantt_tasks.progress)/COUNT(tbgantt_tasks.progress) AS total_avance_programa 		
//                   FROM gantt_seguimiento_entrada tbgantt_seguimiento_entrada
//
//                   JOIN gantt_tasks tbgantt_tasks ON tbgantt_tasks.id=tbgantt_seguimiento_entrada.id_gantt  
//
//                   WHERE tbgantt_seguimiento_entrada.id_seguimiento_entrada='".$id_seguimiento_que_lleva_al_folio_de_entrada."' AND tbgantt_tasks.parent=0";
//           $db= AccesoDB::getInstancia();
//           $list= $db->executeQuery($query);
//           
//           return $list;
//           
//        } catch (Exception $ex)
//        {
//            throw $ex;
//            return false;
//        }
//    }
    
   public function updateAvanceProgramaGeneral($value){
        try{
            $query="update databaseomg.seguimiento_entrada set databaseomg.seguimiento_entrada.AVANCE_PROGRAMA='".$value["avance_programa"]."' where databaseomg.seguimiento_entrada.ID_SEGUIMIENTO_ENTRADA='".$value["id_seguimiento"]."'";
            $db= AccesoDB::getInstancia();
            $list= $db->executeQueryUpdate($query);
            
        } catch (Exception $ex) {
            throw $ex;
        }
   }
   
   
   public function obtenerValidacionSupervisorEvidencias($v)
   {
       try
       {
           $query="SELECT tbevidencias.validacion_supervisor,tbevidencias.id_usuario
                   FROM evidencias tbevidencias
                   WHERE tbevidencias.id_evidencias=".$v["id_evidencias"];

            $db= AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            
            return $lista[0]["validacion_supervisor"];
           
       } catch (Exception $ex)
       {
           throw $ex;
           return false;
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
            $query="UPDATE gantt_evidencias SET notas=$status
                    WHERE gantt_evidencias.id=$id";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
}

?>