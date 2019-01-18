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
class DocumentoPojo {    
   
    
    //put your code here
    private $id_documento;
    private $clave_documento='';
    private $documento='';
    private $id_empleado='';
    
    
    
    public function getId_documento() {
        return $this->id_documento;
    }
    public  function setId_documento($id_documento) {
        $this->id_documento = $id_documento;
    }
    
    
    
    public function getClave_documento() {
        return $this->clave_documento;
    }
    public function setClave_documento($clave_documento) {
        $this->clave_documento = $clave_documento;
    }
    
    
    public function getDocumento() {
        return $this->documento;
    }
    public function setDocumento($documento) {
        $this->documento = $documento;
    }
    
    
    
    public function getId_empleado() {
        return $this->id_empleado;
    }
    public function setId_empleado($id_empleado) {
        $this->id_empleado = $id_empleado;
    }
     
    
    
}
