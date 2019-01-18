<?php

class AutoridadRemitentePojo {

     //put your code here
    private $id_autoridad;
    private $clave_autoridad='';
    private $descripcion='';
    private $direccion='';
    private $telefono='';
    private $extension='';
    private $email='';
    private $direccion_web='';


    function getId_autoridad() {
        return $this->id_autoridad;
    }
    function setId_autoridad($id_autoridad) {
        $this->id_autoridad = $id_autoridad;
    }

    function getClave_autoridad() {
        return $this->clave_autoridad;
    }
    function setClave_autoridad($clave_autoridad) {
        $this->clave_autoridad = $clave_autoridad;
    }

    function getDescripcion() {
        return $this->descripcion;
    }
     function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    function getDireccion() {
        return $this->direccion;
    }
    function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    function getTelefono() {
        return $this->telefono;
    }
    function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    function getExtension() {
        return $this->extension;
    }
    function setExtension($extension) {
        $this->extension = $extension;
    }

    function getEmail() {
        return $this->email;
    }
    function setEmail($email) {
        $this->email = $email;
    }

    function getDireccion_web() {
        return $this->direccion_web;
    }
    function setDireccion_web($direccion_web) {
        $this->direccion_web = $direccion_web;
    }


}
