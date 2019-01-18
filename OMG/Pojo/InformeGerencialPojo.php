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
class InformeGerencialPojo {    
    
        //put your code here
    
    private $id_informe_gerencial;       
    private $id_documento_entrada='';
    
    
    
    function getId_informe_gerencial() {
        return $this->id_informe_gerencial;
    }
    
    function setId_informe_gerencial($id_informe_gerencial) {
        $this->id_informe_gerencial = $id_informe_gerencial;
    }

    
    
    function getId_documento_entrada() {
        return $this->id_documento_entrada;
    }

    function setId_documento_entrada($id_documento_entrada) {
        $this->id_documento_entrada = $id_documento_entrada;
    }

    
    
}
