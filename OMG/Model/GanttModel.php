<?php

require_once '../dao/GanttDao.php';
require_once '../Pojo/GanttPojo.php';
class GanttModel {
    //put your code here
    
    
    public function obtenerTareasCompletasPorFolioEntrada($folio_entrada){
        try{
            $dao= new GanttDao();
            $rec=$dao->obtenerTareasCompletasPorFolioEntrada($folio_entrada);
            
            $duracionTotal=0;
            // $id_tarea = array();
            $bandera=1;
            $array = array();
            $cont=0;
            $id_tarea = $dao->totalDeDiasPorTarea($folio_entrada);//obtener todo s los padres
            $totalPadreCero = $dao->totalPadreCero($folio_entrada);
 
            if($totalPadreCero!=0)
            {
                foreach($id_tarea as $key => $value)
                {
                    $bandera=1;
                    foreach($rec as $k => $v)
                    {
                        if($bandera==1)
                        {
                            $id_tarea[$key]["duracion_total"] = 0;
                            $bandera=0;
                        }
                        if($v["parent"]==$value["id"] && $v["parent"]!=0 )
                        {
                            $id_tarea[$key]["duracion_total"] += $v["duration"];
                        }
                    }
                }
                // foreach($id_tarea as $k => $val)
                // {
                    foreach($rec as $key => $value)
                    {
                        if($value["parent"]!=0)
                        //  && $val["id"]==$value["parent"])
                        {
                            // $index = array_search($value["parent"],$id_tarea,true);
                            // echo $id_tarea[$index]["duracion_total"];
                            foreach($id_tarea as $k => $v)
                            {
                                if($value["parent"]==$v["id"])
                                $value["ponderado_programado"]==-1 ?
                                    $rec[$key]["porcentaje_por_actividad"]= round($value["duration"]*100/$v["duracion_total"],2) : 
                                    $rec[$key]["porcentaje_por_actividad"]= round($value["ponderado_programado"],2);
                                // $value["ponderado_programado"]==-1 ?
                                //     $rec[$key]["porcentaje_por_actividad"]= $value["duration"]*100/$v["duracion_total"] : 
                                //     $rec[$key]["porcentaje_por_actividad"]= $value["ponderado_programado"];
                            }
                        }
                        else
                        {
                            $value["ponderado_programado"]!=-1 ?
                                $rec[$key]["porcentaje_por_actividad"] = round($value["ponderado_programado"],2) :
                                $rec[$key]["porcentaje_por_actividad"] = round(100/$totalPadreCero,2);

                            // $value["ponderado_programado"]!=-1 ?
                            //     $rec[$key]["porcentaje_por_actividad"] = $value["ponderado_programado"] :
                            //     $rec[$key]["porcentaje_por_actividad"] = 100/$totalPadreCero;
                        }
                    }
            }
            
            
            
            
            
            
            
            
            return $rec;
            
        } catch (Exception $ex) {
            throw $ex;
            return false;
        }
    }
    
    public function insertarTareasGantt($data,$id_seguimiento_que_lleva_al_folio_de_entrada){
       
        try{
            $inserccion;
            $lista_tareas_verificadas;
            $dao= new GanttDao();
            $modelGantt= new GanttModel();
            $lista_tareas_verificadas=self::verificarTareasExiste($data);
            foreach ($data as $value) {
                if (isset($value["id"])) {
                   foreach ($lista_tareas_verificadas as $value2) {
                        if($value["id"]==$value2["id"]){
                            
                                if($value2["cantidad"]==0){
                                    if($value["parent"]!=""){
                                         $value["progress"]=0;
                                         $value["id_empleado"]=$value["user"];
                                         $value["id_seguimiento_entrada"]=$id_seguimiento_que_lleva_al_folio_de_entrada;
                                         $dao->insertarTareasGantt($value);
                                         $dao->insertarTareasConFolioEntrada_de_seguimiento_entrada($value);
                                    }
                                }
                                else{
                                    
                                     if($value["!nativeeditor_status"]=='deleted'){
                                         echo "entro a eliminar la tarea";
                                         $dao->deleteTareas($value);
                                         $dao->deleteTareasDe_Gantt_Seguimiento_Entrada($value);
                                            
                                    }else{
                                       if (!isset($value["progress"])) {
                                             $value["progress"]=0;
                                         } 
//                                         if(isset($value["status"])){
                                             
//                                            self::actualizarGanttTareas(array("text"=>$value["text"],"start_date"=>$value["start_date"],"duration"=>$value["duration"],"progress"=>$value["progress"],"parent"=>$value["parent"],"notas"=>$value["notas"],"status"=>$value["status"]), $value["id"]);
                                            
//                                         }else{
//                                            self::actualizarGanttTareas(array("text"=>$value["text"],"start_date"=>$value["start_date"],"duration"=>$value["duration"],"progress"=>$value["progress"],"parent"=>$value["parent"],"notas"=>$value["notas"]), $value["id"]);
//                                         }
//                                         echo js
                                         $dao->updateTareas($value); 
                                         $dao->updateTareasId_EmpleadoXIdGantt_En_Tabla_Seguimiento_entrada($value);
                                    }
                                }
                        }
                    }
                }
            }
         
         
          $modelGantt->calculoAvanceProgramaGeneral($id_seguimiento_que_lleva_al_folio_de_entrada);
            
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
       public static function actualizarGanttTareas($COLUMNAS,$ID)
    {
        try
        {
            $dao=new GanttDao();
            $query= "UPDATE gantt_task SET";
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
    
    public static function verificarTareasExiste($array){
        try{
            $dao= new GanttDao();
            $numeroenlistaposicion=0;
            $lista_tarea_verificada_si_existe;
            foreach ($array as $value) {
                if (isset($value["id"])) {
                    $lista_tarea_verificada_si_existe[$numeroenlistaposicion]["id"]= $value["id"];
                    $lista_tarea_verificada_si_existe[$numeroenlistaposicion]["cantidad"]=$dao->verificarTareaExiste($value)[0]["cantidad"];
                    $numeroenlistaposicion++;
                }
            }
            return $lista_tarea_verificada_si_existe;
        } catch (Exception $ex) {
            throw  $ex;
        }
    }
    
    
    public function obtenerFolioEntradaSeguimiento($ID_SEGUIMIENTO)
    {
        try
        {
            $dao=new GanttDao();
            $rec= $dao->obtenerFolioEntradaSeguimiento($ID_SEGUIMIENTO);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function deleteTareaajax($value)
    {
        try{
            $dao= new GanttDao();
            $dao->deleteTareasAjax($value);
            
        } catch (Exception $ex) {

        }
    }
    
    public  function calculoAvanceProgramaGeneral($id_seguimiento_que_lleva_al_folio_de_entrada)
    {
        try
        {
            $dao=new GanttDao();
             $rec= $dao->calculoAvanceProgramaGeneral($id_seguimiento_que_lleva_al_folio_de_entrada);
             echo "s  : ".$rec[0]["total_avance_programa"];
             $value["id_seguimiento"]=$id_seguimiento_que_lleva_al_folio_de_entrada;
             $value["avance_programa"]=$rec[0]["total_avance_programa"];
            $dao->updateAvanceProgramaGeneral($value);
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function updateAvanceProgramaGeneral($value){
        try{
            
            $dao= new GanttDao();
//            $dao= 
            
            
        } catch (Exception $ex) {
            throw  $ex;
        }
    }
    
    
    public function listarEmpleadosNombreCompleto()
    {
       try
       {
           $dao=new GanttDao();
           $rec= $dao->listarEmpleadosNombreCompleto();
           
           return $rec;
       } catch (Exception $ex)
       {
           throw $ex;
           return -1;
       }
    }
}
