<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EmpleadoPojo
 *
 * @author francisco
 */
class CumplimientoPojo {
    //put your code here
    private $id_cumplimiento;
    private $clave_cumplimiento='';
    private $cumplimiento='';
    
    
    public function getIdCumplimiento(){
        return $this->Id_Cumplimiento;
    } 
    public function setIdCumplimiento($id_cumplimiento){
        $this->Id_Cumplimiento=$id_cumplimiento;
    }
    public function getClaveCumplimiento(){
        return $this->Clave_Cumplimiento;
    }
    public function setClaveCumplimiento($clave_cumplimiento){
        $this->Clave_Cumplimiento=$clave_cumplimiento;
    }
    public function getCumplimiento(){
        return $this->Cumplimiento;
    }
    public function setCumplimiento($cumplimiento){
       $this->Cumplimiento=$cumplimiento;
    }

}
