<?php
require_once '../dao/PermisosDAO.php';

class PermisosModel{
    
    public function obtenerPermisos(){
        
        try {
            
            $dao=new PermisosDAO();
            $rec=$dao->obtenerPermisos();
            
            return $rec;
            
        } catch (Exception $ex){
            throw $ex;
        }
    }
    
            
}


?>

