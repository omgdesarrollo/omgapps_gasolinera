<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TemaPojo
 *
 * @author francisco
 */
class TemaPojo {
    //put your code here
    
    private $Id_Temas;
    private $Codigo_Tema;
    private $Tema;
    
    public function  getIdTemas(){
        return $this->getIdTemas();
    }
    public function setIdTemas($Id_Temas){
        $this->Id_Temas=$Id_Temas;
    }
    public function getCodigoTema(){
        return $this->getCodigoTema();
    }
    public function setCodigoTema($Codigo_Tema){
        $this->Codigo_Tema=$Codigo_Tema;
    }
    public function getTema(){
        return $this->getTema();
    }
    public function setTema($Tema){
        $this->Tema=$Tema;
    }
}
