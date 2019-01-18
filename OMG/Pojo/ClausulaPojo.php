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

class ClausulaPojo {
    //put your code here
    private $id_clausula;
    private $clausula='';
    private $sub_clausula='';
    private $descripcion_clausula='';
    private $descripcion_sub_clausula='';
    private $descripcion='';
    private $plazo='';
    private $id_empleado='';
     
    
    public function getIdClausula(){
        return $this->Id_Clausula;
    } 
    public function setIdClausula($id_clausula){
        $this->Id_Clausula=$id_clausula;
    }


    public function getClausula(){
        return $this->Clausula;
    }
    public function setClausula($clausula){
        $this->Clausula=$clausula;
    }


    public function getSubClausula(){
        return $this->Sub_Clausula;
    }
    public function setSubClausula($sub_clausula){
       $this->Sub_Clausula=$sub_clausula;
    }


    public function getDescripcionClausula(){
        return $this->DescripcionClausula;
    }
    public function setDescripcionClausula($descripcion_clausula){
       $this->DescripcionClausula=$descripcion_clausula;
    }


    public function getDescripcionSubClausula(){
        return $this->DescripcionSubClausula;
    }
    public function setDescripcionSubClausula($descripcion_sub_clausula){
       $this->DescripcionSubClausula=$descripcion_sub_clausula;
    }


    public function getDescripcion(){
        return $this->Descripcion;
    }
    public function setDescripcion($descripcion){
       $this->Descripcion=$descripcion;
    }


    public function getPlazo(){
        return $this->Plazo;
    }
    public function setPlazo($plazo){
       $this->Plazo=$plazo;
    }
 
       
    public function getIdEmpleado(){
        return $this->Id_Empleado;
    }
    public function setIdEmpleado($id_empleado){
       $this->Id_Empleado=$id_empleado;
    }

}
