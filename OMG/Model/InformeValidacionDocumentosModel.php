<?php
require_once '../dao/InformeValidacionDocumentosDAO.php';

class InformeValidacionDocumentosModel{
        
    public function listarValidaciones($v)
    {
        try
        {
            $dao=new InformeValidacionDocumentosDAO();
            $rec["info"]= $dao->listarValidaciones($v);
            
            foreach ($rec["info"] as $key => $value) 
            {
                $rec["info"][$key]["temas_responsables"]= $dao->obtenerTemayResponsable($value["id_documento"]);
                $rec["info"][$key]["requisitos"]= $dao->obtenerRequisitosporDocumento($value["id_documento"]);
            }            
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function obtenerTemayResponsable($id_documento){
        try{
            $dao=new InformeValidacionDocumentosDAO();
            $rec=$dao->obtenerTemayResponsable($id_documento);
            
            return $rec;
            
        } catch (Exception $ex){            
            throw $ex;
            return false;
        }
        
        
    }
    
    
    public function  obtenerRequisitosporDocumento($id_documento)
    {
        try
        {
            $dao=new InformeValidacionDocumentosDAO();
            $rec=$dao->obtenerRequisitosporDocumento($id_documento);
         
            return $rec;
        } catch (Exception $ex){
            throw  $ex;
            return false;
        }
    }
    
    public function obtenerRegistrosPorDocumento($id_documento)
    {
        try
        {
            $dao=new InformeValidacionDocumentosDAO();
            $rec=$dao->obtenerRegistrosPorDocumento($id_documento);
            
            return $rec;
            
        } catch (Exception $ex){
            throw $ex;
            return false;
        }
    }
//    NO BORRAR AQUI PARA ABAJO SI SE HACE CONSULTAR PARA SABER SI NO LE AFECTA EN OTRAS PARTES 
      
     public function obtenerTodosLosEmpleadosQueSonResponsableDelDocumento(){
         try{
            $informeValidacionDocumentosDAO= new InformeValidacionDocumentosDAO();
            return $informeValidacionDocumentosDAO->obtenerTodosLosEmpleadosQueSonResponsableDelDocumento();          
         } catch (Exception $ex) {

         }
     }   
    
}

?>

