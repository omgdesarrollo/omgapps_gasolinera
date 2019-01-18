<?php

require_once '../dao/InformeGerencialDAO.php';
require_once '../Pojo/InformeGerencialPojo.php';
class InformeGerencialModel{
    
    public function  listarInformeGerencial(){
        try{
            $dao=new InformeGerencialDAO();
            $rec=$dao->listarInformeGerencial();
            
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


            if($value["status_doc"]== 1){
                $rec[$key]["status_doc"]="En proceso";
                
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
              
            if($value["status_doc"]== 2){
                    $rec[$key]["status_doc"]="Suspendido";
                    $rec[$key]["condicion"]="Suspendido";
            } //Segundo If
            
            if($value["status_doc"]== 3){
                $rec[$key]["status_doc"]="Terminado";
                $rec[$key]["condicion"]="Terminado";
            } //Tercer If, Termina Status Logico
            
            }//FOREACH
             
            return $rec;
    }  catch (Exception $e){
        throw  $e;
    }
    }
    
    

    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_INFORME_GERENCIAL){
        try{
            $dao=new InformeGerencialDAO();
            $rec= $dao->actualizarInformeGerencialPorColumna($COLUMNA, $VALOR, $ID_INFORME_GERENCIAL);
            
        } catch (Exception $ex) {

        }
    }
    
    
    
    public function eliminar(){
        try{
            $dao= new InformeGerencialDAO();
            $pojo= new InformeGerencialPojo();
            $dao->eliminarInformeGerencial($pojo->getId_informe_gerencial());
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

?>