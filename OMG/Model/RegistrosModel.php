<?php

require_once '../dao/RegistrosDAO.php';
require_once '../dao/AsignacionTemaRequisitoDAO.php';
require_once '../dao/TemaDAO.php';

class RegistrosModel{
    
    public function  listarRegistros($cadena)
    {
        try
        {
            $dao=new RegistrosDAO();
            $rec= $dao->mostrarRegistros($cadena);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function generarDatosArbol($id_asignacion,$id_tema_and_subtema)
    {
  
        try
        {
            $datosArbol = array();
            $dao=new RegistrosDAO();
            $daoA= new AsignacionTemaRequisitoDAO();
            $daoT=new TemaDAO();
//            $rec= $daoT->listarDetallesSeleccionados($id_asignacion);
//            $existeTemasAndSubtema=$daoA->verificarSiExistenTemasSubtemasandEnTemaRequisito(array("id_tema_and_subtema"=>$id_tema_and_subtema));
//            if($existeTemasAndSubtema[0]["cantidad"]==0){
//                 $daoA->insertarTemasSubtemasSiNoExitenEnTemaRequisito(array("id_tema_and_sub"=>$id_tema_and_subtema));
//            }
                
//            $daoA->insertarTemasSubtemasSiNoExitenEnTemaRequisito(array("id_tema_and_sub"=>$id_asignacion));
            
            $requisitos["data"]= $dao->obtenerRequisitos($id_asignacion);
            foreach($requisitos["data"] as $index=>$resultado)
            {
                $requisitos["data"][$index][0] = $dao->obtenerRegistros($resultado['id_requisito']);
            }
            
        $id_tema=$daoA->obtenerIdTema($id_asignacion);
         $requisitos["detallesTema"]=$daoT->listarDetallesSeleccionados($id_tema);
            
            return $requisitos;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function insertarTemasSubtemasSiNoExitenEnTemaRequisito($value){
        
        try{
            $daoATR= new AsignacionTemaRequisitoDAO();
            return $daoATR->insertarTemasSubtemasSiNoExitenEnTemaRequisito($value);
            
        } catch (Exception $ex) {
             throw $ex;
            return false;
        }
        
        
    }
    
    

    

    public function insertar($registro)
    {
        try
        {
            $dao=new RegistrosDAO();
            $dao->insertarRegistros($registro);
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
}    

?>
