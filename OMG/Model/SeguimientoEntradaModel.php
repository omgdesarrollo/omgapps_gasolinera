<?php


require_once '../dao/SeguimientoEntradaDAO.php';
require_once '../Pojo/SeguimientoEntradaPojo.php';
require_once '../dao/GanttDao.php';
date_default_timezone_set("America/Mexico_city");

class SeguimientoEntradaModel{
    
    public function listarSeguimientoEntradas()
    {
        try
        {
            $dao= new SeguimientoEntradaDAO();
            $rec=$dao->mostrarSeguimientoEntradas();
            
            foreach ($rec as $key => $value) 
            {
            
                $alarm = new Datetime($value['fecha_alarma']);
                $alarm = strftime("%d-%B-%y",$alarm -> getTimestamp());
                $alarm = new Datetime($alarm);

                $flimite = new Datetime($value['fecha_limite_atencion']);// Guarda en una variable la fecha de la base de datos
                $flimite = strftime("%d-%B-%y",$flimite -> getTimestamp());// Esta da el formato: dia. mes y año, sin guardar las horas 
                $flimite = new Datetime($flimite);//Se guarda en este formato y se reinicializan las horas a 00.

                $hoy = new Datetime();
                $hoy = strftime("%d - %B - %y");
                $hoy = new Datetime($hoy);


                if($value["status_doc"]== 1)
                {

                    if ($flimite <= $hoy){

                        if($flimite == $hoy){

                            $rec[$key]["condicion"]="Tiempo Limite";
                        } else {

                            $rec[$key]["condicion"]="Tiempo Vencido";
                        }

                    } else{

                      if ($alarm <= $hoy){

                            $rec[$key]["condicion"]="Alarma Vencida";
                      } else {

                            $rec[$key]["condicion"]="En Tiempo";
                          }                                           
                    }
                } //Primer If 
              
                if($value["status_doc"]== 2)
                {

                        $rec[$key]["condicion"]="Suspendido";
                } //Segundo If
            
                if($value["status_doc"]== 3){

                    $rec[$key]["condicion"]="Terminado";
                } //Tercer If, Termina Status Logico
            
            }//FOREACH
              
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function listarSeguimientoDeEntrada($ID_SEGUIMIENTO_ENTRADA)
    {
        try
        {
            $dao= new SeguimientoEntradaDAO();
            $rec=$dao->listarSeguimientoDeEntrada($ID_SEGUIMIENTO_ENTRADA);
            
            foreach ($rec as $key => $value) 
            {
            
                $alarm = new Datetime($value['fecha_alarma']);
                $alarm = strftime("%d-%B-%y",$alarm -> getTimestamp());
                $alarm = new Datetime($alarm);

                $flimite = new Datetime($value['fecha_limite_atencion']);// Guarda en una variable la fecha de la base de datos
                $flimite = strftime("%d-%B-%y",$flimite -> getTimestamp());// Esta da el formato: dia. mes y año, sin guardar las horas 
                $flimite = new Datetime($flimite);//Se guarda en este formato y se reinicializan las horas a 00.

                $hoy = new Datetime();
                $hoy = strftime("%d - %B - %y");
                $hoy = new Datetime($hoy);


                if($value["status_doc"]== 1)
                {

                    if ($flimite <= $hoy){

                        if($flimite == $hoy){

                            $rec[$key]["condicion"]="Tiempo Limite";
                        } else {

                            $rec[$key]["condicion"]="Tiempo Vencido";
                        }

                    } else{

                      if ($alarm <= $hoy){

                            $rec[$key]["condicion"]="Alarma Vencida";
                      } else {

                            $rec[$key]["condicion"]="En Tiempo";
                          }                                           
                    }
                } //Primer If 
              
                if($value["status_doc"]== 2)
                {

                        $rec[$key]["condicion"]="Suspendido";
                } //Segundo If
            
                if($value["status_doc"]== 3){

                    $rec[$key]["condicion"]="Terminado";
                } //Tercer If, Termina Status Logico
            
            }//FOREACH
              
            return $rec;   
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function nombresCompletosCombobox()
    {
       try
       {
           $dao=new SeguimientoEntradaDAO();
           $rec= $dao->nombresCompletosCombobox();
           
           return $rec;
       } catch (Exception $ex)
       {
           throw $ex;
           return -1;
       }
    }
    
    public function responsablePlan()
    {
        try 
        {
            $dao=new SeguimientoEntradaDAO();
            $rec= $dao->responsablePlan();
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    
    public function insertar($id_documento_entrada){
        try{
                $dao=new SeguimientoEntradaDAO();
                $dao->insertar($id_documento_entrada);
        }catch (Exception $ex) {
                 throw  $ex;
        }
    }

    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_SEGUIMIENTO_ENTRADA){
        try{
            $dao=new SeguimientoEntradaDAO();
            $rec= $dao->actualizarSeguimientoEntradaPorColumna($COLUMNA, $VALOR, $ID_SEGUIMIENTO_ENTRADA);
            
        } catch (Exception $ex) {

        }
    }
    
    
    
    public function eliminar(){
        try{
            $dao= new SeguimientoEntradaDAO();
            $pojo= new SeguimientoEntradaPojo();
            $dao->eliminarSeguimientoEntrada($pojo->getIdSeguimientoEntrada());
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
}

?>