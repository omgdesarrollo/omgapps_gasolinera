<?php

require_once '../dao/GanttEvidenciasDao.php';
//require_once '../Pojo/GanttPojo.php';
class GanttEvidenciaModel {
    //put your code here
    
    
    public function obtenerT($v){
        try{
            $dao= new GanttEvidenciasDao();
            $rec=$dao->obtenerT($v);
            
            $duracionTotal=0;
            // $id_tarea = array();
            $bandera=1;
            $array = array();
            $cont=0;
            $id_tarea = $dao->totalDeDiasPorTarea($v["id_evidencia"]);//obtener todo s los padres
            $totalPadreCero = $dao->totalPadreCero($v["id_evidencia"]);
     
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
    
 
    
    public function verificarsitienedescendencia($v){
        try{
            $dao=new GanttEvidenciasDao();
            $rec=$dao->verificarsitienedescendencia($v);
            return $rec;
        } catch (Exception $ex) {
            throw $ex;
            return false;
        }
    }
    public function insertarTareasGantt($data,$id_evidencia){
       
        try{
//            $inserccion;
            $lista_tareas_verificadas;
            $dao= new GanttEvidenciasDao();
            $modelGantt= new GanttEvidenciaModel();
            $lista_tareas_verificadas=self::verificarTareasExiste($data);
//            echo "existen ".json_encode($lista_tareas_verificadas);
//            echo "d  :".$id_evidencia."  -fff";
//            echo "tareas verificadas : ".json_encode($lista_tareas_verificadas);
            foreach ($data as $value) {
                if (isset($value["id"])) {
                   foreach ($lista_tareas_verificadas as $value2) {
                        if($value["id"]==$value2["id"]){
                            
                                if($value2["cantidad"]==0){
                                    if(isset($value["parent"])!=""){
                                        echo "entro en parent";
                                         $value["progress"]=0;
                                         $value["id_empleado"]=$value["user"];
                                         $value["id_evidencia"]=$id_evidencia;
                                         $dao->insertarTareasGantt($value);
//                                         $dao->insertarTareasConFolioEntrada_de_seguimiento_entrada($value);
                                    }
                                }
                                else{
                                    
                                     if($value["!nativeeditor_status"]=='deleted'){
                                         echo "entro a eliminar la tarea";
                                         $dao->deleteTareas($value);
//                                         $dao->deleteTareasDe_Gantt_Seguimiento_Entrada($value);
                                            
                                    }else{
                                        
                                         if (!isset($value["progress"])) {
                                             $value["progress"]=0;
                                         }
                                        
                                         if(isset($value["status"])){
                                             
                                            self::actualizarGanttTareasConstruccionQuery(array("text"=>$value["text"],"start_date"=>$value["start_date"],"duration"=>$value["duration"],"progress"=>$value["progress"],"parent"=>$value["parent"],"user"=>$value["user"],"notas"=>$value["notas"],"status"=>$value["status"]), $value["id"]);
                                            
                                         }else{
                                            self::actualizarGanttTareasConstruccionQuery(array("text"=>$value["text"],"start_date"=>$value["start_date"],"duration"=>$value["duration"],"progress"=>$value["progress"],"parent"=>$value["parent"],"user"=>$value["user"],"notas"=>$value["notas"]), $value["id"]);
                                         }
                                     
//                                         $dao->updateTareasId_EmpleadoXIdGantt_En_Tabla_Seguimiento_entrada($value);
                                    }
                                }
                        }
                    }
                }
            }
       
            
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
     public static function actualizarGanttTareasConstruccionQuery($COLUMNAS,$ID)
    {
        try
        {
            $dao=new GanttEvidenciasDao();
            $query= "UPDATE gantt_evidencias SET";
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
            $dao= new GanttEvidenciasDao();
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
            $dao= new GanttEvidenciasDao();
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
    
    
    public function updateAvanceProgramaGeneral($value)
    {
        try{
            
            $dao= new GanttDao();
//            $dao= 
            
            
        } catch (Exception $ex) {
            throw  $ex;
        }
    }
    
    
    public function obtenerValidacionSupervisorEvidencias($v)
    {
        try
        {
            $dao=new GanttEvidenciasDao();
            $rec= $dao->obtenerValidacionSupervisorEvidencias($v);
            
            return $rec;
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
           $dao=new GanttEvidenciasDao();
           $rec= $dao->listarEmpleadosNombreCompleto();
           
           return $rec;
       } catch (Exception $ex)
       {
           throw $ex;
           return -1;
       }
    }
     public function guardarPonderados($LISTA)
    { 
        try
        {
            $dao=new GanttEvidenciasDao();
            $respuestas = array();
            $res = "";
            // var_dump($LISTA);
            foreach($LISTA as $key => $value)
            {
                $respuestas[$key]["id"] = $value["id"];
                $respuestas[$key]["res"] =self::actualizarGanttEvidencias(array("ponderado_programado"
                                          =>$value["ponderado_programado"]),$value["id"]);
//                        $dao->guardarPonderados($value["id"],$value["ponderado_programado"]);
            }
            foreach($respuestas as $key => $value)
            {
                if($value["res"]==0)
                {
                    $res .= "Error al actualizar la tarea con id = +".$value['id']." \n";
                }
            }
            return $res=="" ? 1 : $res;
        }
        catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
     public function guardarNota($Lista)
    {
        try 
        {
            $dao=new GanttEvidenciasDao();
            $rec= $dao->guardarNota($Lista);
            
            return $rec;
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
            $dao=new GanttEvidenciasDao();
            $rec= $dao->guardarStatus($Lista);
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
     public static function actualizarGanttEvidencias($COLUMNAS,$ID)
    {
        try
        {
            $dao=new GanttEvidenciasDao();
            $query= "UPDATE gantt_evidencias SET";
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
    
    
    
      public static function actualizarGanttEvidenciasDeTablaDetalles($COLUMNAS,$ID)
    {
        try
        {
            $dao=new GanttEvidenciasDao();
            $query= "UPDATE gantt_evidencias SET";
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
    
    
    
    
    
}
