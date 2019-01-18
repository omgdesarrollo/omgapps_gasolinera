<?php


class EvidenciasPojo {

    private $id_evidencias;       
    private $id_documento='';    
    private $clasificacion='';       
    private $desviacion='';    
    private $accion_correctiva='';    
    private $validacion_supervisor='';    
    private $plan_accion='';    
    private $ingresar_oficio_atencion='';
    private $oficio_atencion='';
    
    
    
    function getId_evidencias() {
        return $this->id_evidencias;
    }
    function setId_evidencias($id_evidencias) {
        $this->id_evidencias = $id_evidencias;
    }
    
    
    function getId_documento() {
        return $this->id_documento;
    }
    function setId_documento($id_documento) {
        $this->id_documento = $id_documento;
    }

    
    function getClasificacion() {
        return $this->clasificacion;
    }
    function setClasificacion($clasificacion) {
        $this->clasificacion = $clasificacion;
    }
    

    function getDesviacion() {
        return $this->desviacion;
    }
    function setDesviacion($desviacion) {
        $this->desviacion = $desviacion;
    }

    
    function getAccion_correctiva() {
        return $this->accion_correctiva;
    }
    function setAccion_correctiva($accion_correctiva) {
        $this->accion_correctiva = $accion_correctiva;
    }
    

    function getValidacion_supervisor() {
        return $this->validacion_supervisor;
    }
    function setValidacion_supervisor($validacion_supervisor) {
        $this->validacion_supervisor = $validacion_supervisor;
    }
    

    function getPlan_accion() {
        return $this->plan_accion;
    }
    function setPlan_accion($plan_accion) {
        $this->plan_accion = $plan_accion;
    }
    

    function getIngresar_oficio_atencion() {
        return $this->ingresar_oficio_atencion;
    }
    function setIngresar_oficio_atencion($ingresar_oficio_atencion) {
        $this->ingresar_oficio_atencion = $ingresar_oficio_atencion;
    }
    

    function getOficio_atencion() {
        return $this->oficio_atencion;
    }
    function setOficio_atencion($oficio_atencion) {
        $this->oficio_atencion = $oficio_atencion;
    }

    
    
}
