<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentoEntradaPojo
 *
 * @author usuario
 */
class DocumentoEntradaPojo {
    //put your code here
    
    private $id_documento_entrada;       
    private $id_cumplimiento='';
    private $folio_referencia='';
    private $folio_entrada='';
    private $fecha_recepcion='';
    private $asunto='';
    private $remitente='';
    private $id_tema='';
    private $id_autoridad='';
    private $clasificacion='';
    private $status_doc='';
    private $fecha_asignacion='';
    private $fecha_limite_atencion='';
    private $fecha_alarma='';
    private $documento='';
    private $observaciones='';
    private $mensaje_alerta='';
    
    
    public function getMensajeAlerta()
    {
        return $this->mensaje_alerta;
    }
    public function setMensajeAlerta($mensaje_alerta)
    {
        $this->mensaje_alerta = $mensaje_alerta;
    }
    
    public function getIdDocumentoEntrada(){
        return $this->Id_Documento_Entrada;
    } 
    public function setIdDocumentoEntrada($id_documento_entrada){
        $this->Id_Documento_Entrada=$id_documento_entrada;
    }


    
    public function getIdCumplimiento(){
        return $this->Id_Cumplimiento;
    }
    public function setIdCumplimiento($id_cumplimiento){
        $this->Id_Cumplimiento=$id_cumplimiento;
    }


    public function getFolioReferencia(){
        return $this->Folio_Referencia;
    }
    public function setFolioReferencia($folio_referencia){
       $this->Folio_Referencia=$folio_referencia;
    }


    public function getFolioEntrada(){
        return $this->Folio_Entrada;
    }
    public function setFolioEntrada($folio_entrada){
       $this->Folio_Entrada=$folio_entrada;
    }


    public function getFechaRecepcion(){
        return $this->Fecha_Recepcion;
    }
    public function setFechaRecepcion($fecha_recepcion){
       $this->Fecha_Recepcion=$fecha_recepcion;
    }


    public function getAsunto(){
        return $this->Asunto;
    }
    public function setAsunto($asunto){
       $this->Asunto=$asunto;
    }


    public function geRemitente(){
        return $this->Remitente;
    }
    public function setRemitente($remitente){
       $this->Remitente=$remitente;
    }

    
    public function getIdTema(){
        return $this->Id_Tema;
    }
    public function setIdTema($id_tema){
       $this->Id_Tema=$id_tema;
    }

    
    public function getIdAutoridad(){
        return $this->Id_Autoridad;
    }
    public function setIdAutoridad($id_autoridad){
       $this->Id_Autoridad=$id_autoridad;
    }
    
    
    public function getClasificacion(){
        return $this->Clasificacion;
    }
    public function setClasificacion($clasificacion){
       $this->Clasificacion=$clasificacion;
    }

    public function getStatusDoc(){
        return $this->Status_Doc;
    }
    public function setStatusDoc($status_doc){
       $this->Status_Doc=$status_doc;
    }

    public function getFechaAsignacion(){
        return $this->Fecha_Asignacion;
    }
    public function setFechaAsignacion($fecha_asignacion){
       $this->Fecha_Asignacion=$fecha_asignacion;
    }

    public function getFechaLimiteAtencion(){
        return $this->Fecha_Limite_Atencion;
    }
    public function setFechaLimiteAtencion($fecha_limite_atencion){
       $this->Fecha_Limite_Atencion=$fecha_limite_atencion;
    }

    public function getFechaAlarma(){
        return $this->Fecha_Alarma;
    }
    public function setFechaAlarma($fecha_alarma){
       $this->Fecha_Alarma=$fecha_alarma;
    }

    public function getDocumento(){
        return $this->Documento;
    }
    public function setDocumento($documento){
       $this->Documento=$documento;
    }

    public function getObservaciones(){
        return $this->Plazo;
    }
    public function setObservaciones($observaciones){
       $this->Plazo=$observaciones;
    }    
}
