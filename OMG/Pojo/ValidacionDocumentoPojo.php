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
class ValidacionDocumentoPojo {

    private $id_validacion_documento;       
    private $id_asignacion_tema_requisito='';    
    private $documento_archivo='';       
    private $validacion_documento_responsable='';    
    private $observacion_documento='';    
    private $validacion_tema_responsable='';    
    private $observacion_tema='';    
    private $plan_accion='';    
    private $desviacion_mayor='';
    
    
    function getId_validacion_documento() {
        return $this->id_validacion_documento;
    }
    
    function setId_validacion_documento($id_validacion_documento) {
        $this->id_validacion_documento = $id_validacion_documento;
    }

    
    
    function getId_asignacion_tema_requisito() {
        return $this->id_asignacion_tema_requisito;
    }

    function setId_asignacion_tema_requisito($id_asignacion_tema_requisito) {
        $this->id_asignacion_tema_requisito = $id_asignacion_tema_requisito;
    }
    
    
    
    function getDocumento_archivo() {
        return $this->documento_archivo;
    }
    
    function setDocumento_archivo($documento_archivo) {
        $this->documento_archivo = $documento_archivo;
    }

    
    
    
    function getValidacion_documento_responsable() {
        return $this->validacion_documento_responsable;
    }
    
    function setValidacion_documento_responsable($validacion_documento_responsable) {
        $this->validacion_documento_responsable = $validacion_documento_responsable;
    }
    
    

    function getObservacion_documento() {
        return $this->observacion_documento;
    }
    
    function setObservacion_documento($observacion_documento) {
        $this->observacion_documento = $observacion_documento;
    }
    
    
    

    function getValidacion_tema_responsable() {
        return $this->validacion_tema_responsable;
    }
    
    function setValidacion_tema_responsable($validacion_tema_responsable) {
        $this->validacion_tema_responsable = $validacion_tema_responsable;
    }
    
    
    

    function getObservacion_tema() {
        return $this->observacion_tema;
    }
    
    function setObservacion_tema($observacion_tema) {
        $this->observacion_tema = $observacion_tema;
    }
    
    
    

    function getPlan_accion() {
        return $this->plan_accion;
    }
    
    function setPlan_accion($plan_accion) {
        $this->plan_accion = $plan_accion;
    }
    
    
    

    function getDesviacion_mayor() {
        return $this->desviacion_mayor;
    }
    
    function setDesviacion_mayor($desviacion_mayor) {
        $this->desviacion_mayor = $desviacion_mayor;
    }


    
}
