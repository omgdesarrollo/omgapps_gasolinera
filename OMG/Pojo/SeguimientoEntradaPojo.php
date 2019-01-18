<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SeguimientoEntradaPojo
 *
 * @author usuario
 */
class SeguimientoEntradaPojo {    

    
        //put your code here
    
    private $id_seguimiento_entrada;       
    private $id_documento_entrada='';
    private $id_empleado='';
    private $avance_programa='';
    
    
    function getId_seguimiento_entrada() {
        return $this->id_seguimiento_entrada;
    }
    
    function setId_seguimiento_entrada($id_seguimiento_entrada) {
        $this->id_seguimiento_entrada = $id_seguimiento_entrada;
    }
       

    
    function getId_documento_entrada() {
        return $this->id_documento_entrada;
    }
    
    function setId_documento_entrada($id_documento_entrada) {
        $this->id_documento_entrada = $id_documento_entrada;
    }
    
    
    
    
    function getId_empleado() {
        return $this->id_empleado;
    }
    
    function setId_empleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }
    
    
    function getAvance_programa() {
        return $this->avance_programa;
    }
    function setAvance_programa($avance_programa) {
        $this->avance_programa = $avance_programa;
    }

    
}
