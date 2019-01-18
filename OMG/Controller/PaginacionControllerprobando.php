<?php


require_once '../Model/AsignacionTemaRequisitoModel.php';
class PaginacionControllerprobando {
    //put your code here
    
    
    public static  function showRows($INICIO,$CANTIDAD){
        $model=new AsignacionTemaRequisitoModel();
        $lista=$model->listarAsignacionTemasRequisitos($INICIO, $CANTIDAD);
        return $lista;
    }
}
