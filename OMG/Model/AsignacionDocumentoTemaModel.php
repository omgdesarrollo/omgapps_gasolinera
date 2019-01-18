<?php

require_once '../dao/AsignacionDocumentoTemaDAO.php';
require_once '../Pojo/AsignacionDocumentoTemaPojo.php';

class AsignacionDocumentoTemaModel {
    //put your code here
    
    public function  listarAsignacionDocumentosTemas(){
        try{
            $dao=new AsignacionDocumentoTemaDAO();
            $rec=$dao->mostrarAsignacionDocumentosTemas();
            
            /*if($rec==NULL){
            throw new Exception("Usuario no existe !!!!!");
            }
            if($rec["CONTRA"]!=$clave){
            throw  new Exception("Clave Incorrecta!!!!!");
            }*/           
            return $rec;
    }  catch (Exception $e){
        throw  $e;
    }
    }
 
    
    
    
    public function insertar($pojo){
        try{
            $dao=new AsignacionDocumentoTemaDAO();
//            $pojo=new EmpleadoPojo();
            
           $dao->insertarAsignacionDocumentoTema($pojo->getId_documento(),$pojo->getId_asignacion_tema_requisito());
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    
    
    public function actualizar($pojo){
        try{
            $dao= new AsignacionDocumentoTemaDAO();
//            $pojo= new EmpleadoPojo();
//            $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(),$pojo->getNombreEmpleado(),$pojo->getApellidoPaterno(),$pojo->getApellidoMaterno(), $pojo->getCategoria(),$pojo->getCorreo());
//        $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(), $pojo->getCorreo());
        $dao->actualizarAsignacionDocumentoTema($pojo->getId_asignacion_documento_tema(),$pojo->getId_documento(),$pojo->getId_asignacion_tema_requisito());
//            return $rec;
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_ASIGNACION_DOCUMENTO_TEMA){
        try{
            $dao=new AsignacionDocumentoTemaDAO();
            $rec= $dao->actualizarAsignacionDocumentoTemaPorColumna($COLUMNA, $VALOR, $ID_ASIGNACION_DOCUMENTO_TEMA);
            
        } catch (Exception $ex) {

        }
    }
    
    
    public function eliminar(){
        try{
            $dao= new AsignacionDocumentoTemaDAO();
            $pojo= new AsignacionDocumentoTemaPojo();
            $dao->eliminarAsignacionDocumentoTema($pojo->getId_asignacion_documento_tema());
//            return $rec;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function buscarDocumento($CADENA,$CONTRATO)
    {
        try{
            $dao = new AsignacionDocumentoTemaDAO();
            $lista = $dao->buscarDocumento($CADENA,$CONTRATO);
           return $lista;
        } catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
}
