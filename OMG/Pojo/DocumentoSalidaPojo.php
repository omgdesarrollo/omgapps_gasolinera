<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DocumentoSalidaPojo
 *
 * @author usuario
 */
class DocumentoSalidaPojo {    

    //put your code here
    private $id_documento_salida;     
    private $id_documento_entrada='';
    private $folio_salida='';
    private $fecha_envio='';
    private $asunto='';
    private $destinatario='';
    private $observaciones='';

    
    function getId_documento_salida() {
        return $this->id_documento_salida;
    }
    function setId_documento_salida($id_documento_salida) {
        $this->id_documento_salida = $id_documento_salida;
    }
    
    
    function getId_documento_entrada() {
        return $this->id_documento_entrada;
    }
    function setId_documento_entrada($id_documento_entrada) {
        $this->id_documento_entrada = $id_documento_entrada;
    }

    
    function getFolio_salida() {
        return $this->folio_salida;
    }
    function setFolio_salida($folio_salida) {
        $this->folio_salida = $folio_salida;
    }

    
    function getFecha_envio() {
        return $this->fecha_envio;
    }
    function setFecha_envio($fecha_envio) {
        $this->fecha_envio = $fecha_envio;
    }

    
    function getAsunto() {
        return $this->asunto;
    }
    function setAsunto($asunto) {
        $this->asunto = $asunto;
    }

    
    function getDestinatario() {
        return $this->destinatario;
    }
    function setDestinatario($destinatario) {
        $this->destinatario = $destinatario;
    }


    function getObservaciones() {
        return $this->observaciones;
    }
    function setObservaciones($observaciones) {
        $this->observaciones = $observaciones;
    }
    
}

 