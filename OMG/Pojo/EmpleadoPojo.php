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
class EmpleadoPojo {    

        //put your code here
    private $idEmpleado;
    private $Nombre_Empleado='';
    private $Apellido_Paterno='';
    private $Apellido_Materno='';
    private $Categoria='';
    private $Correo='';
    private $identificador='';
    
    
    public function getIdEmpleado(){
        return $this->idEmpleado;
    } 
    public function setIdEmpleado($idEmpleado){
        $this->idEmpleado=$idEmpleado;
    }
    public function getNombreEmpleado(){
        return $this->Nombre_Empleado;
    }
    public function setNombreEmpleado($Nombre_Empleado){
        $this->Nombre_Empleado=$Nombre_Empleado;
    }
    public function getApellidoPaterno(){
        return $this->Apellido_Paterno;
    }
    public function setApellidoPaterno($Apellido_Paterno){
       $this->Apellido_Paterno=$Apellido_Paterno;
    }
    public function getApellidoMaterno(){
        return $this->Apellido_Materno;
    }
    public function setApellidoMaterno($Apellido_Materno){
        $this->Apellido_Materno=$Apellido_Materno;
    }
    public function getCategoria(){
        return $this->Categoria;
    }
    public function setCategoria($Categoria){
        $this->Categoria=$Categoria;
    }
    public function getCorreo(){
        return $this->Correo;
    }
    public function setCorreo($Correo){
        $this->Correo=$Correo;
    }
    
    function getIdentificador() {
        return $this->identificador;
    }
    function setIdentificador($identificador) {
        $this->identificador = $identificador;
    }
}
