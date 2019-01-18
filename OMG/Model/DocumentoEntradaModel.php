<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once '../dao/DocumentoEntradaDAO.php';
require_once '../Pojo/DocumentoEntradaPojo.php';
class DocumentoEntradaModel{
    
    public function getFechaAlarma()
    {
        try
        {
            $dao = new DocumentoEntradaDAO();
            $rec = $dao->getFechaAlarma();
            return $rec;
        }catch(Exception $e)
        {
            throw $e;
        }
    }

    public function  listarDocumentosEntrada($CONTRATO){
        try
        {
            $dao=new DocumentoEntradaDAO();
            $rec=$dao->mostrarDocumentosEntrada($CONTRATO);    
            return $rec;
        }  catch (Exception $e){
            throw  $e;
        }
    }

    public function  listarDocumentoEntrada($ID_DOCUMENTO_ENTRADA){
        try
        {
            $dao=new DocumentoEntradaDAO();
            $rec=$dao->listarDocumentoEntrada($ID_DOCUMENTO_ENTRADA);
            return $rec;
        }  catch (Exception $e){
            throw  $e;
        }
    }
    
    public function  listarCumplimientoPorId_Entrada($id_entrada){
    try{
            $dao=new DocumentoEntradaDAO();
            $rec=$dao->listarCumplimientoPorId_Entrada($id_entrada);
            
            
            return $rec;
    }  catch (Exception $e){
        throw  $e;
    }
    }
    
    
    public function  listarDocumentosEntradaComboBox($CONTRATO){
        try{
            $dao=new DocumentoEntradaDAO();
            $rec=$dao->mostrarDocumentosEntradaComboBox($CONTRATO);
            
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
    
    
    public function verificarSiExisteFolioEntrada($registro,$cualverificar){
        try{
            $dao= new DocumentoEntradaDAO();
//            if($cualverificar=="clavedocumento"){
                $rec=$dao->verificarSiExisteFolioEntrada($registro,$cualverificar);
//            }
            
            return $rec;
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
    
    public function traer_ultimo_insertado(){
        try{
             $dao=new DocumentoEntradaDAO();
             $rec=$dao->traer_ultimo_insertado();
             return $rec;
        } catch (Exception $ex) {

        }
    }
    
    
    public function loadAutoComplete($cadena){
     
     try{
         $dao= new DocumentoEntradaDAO();
         $rec=$dao->loadAutoComplete($cadena);
         return $rec;
     } catch (Exception $ex) {

     }
     
     
 }
    
    public function insertar($pojo){
        $data=array();        
        try{
            $dao=new DocumentoEntradaDAO();
            // //$carpeta ='enerin-omgapps.com/enerin-omg/archivos/files/'.$pojo->getIdCumplimiento();
            //  $carpeta ='../../archivos/files/'.$pojo->getIdCumplimiento();
            // if(!file_exists($carpeta))
            // {
            //     mkdir($carpeta,0777,true);
            // }
            $exito_inserccion=$dao->insertarDocumentosEntrada($pojo->getIdCumplimiento(),$pojo->getFolioReferencia(),
                   $pojo->getFolioEntrada(),$pojo->getFechaRecepcion(),$pojo->getAsunto(),$pojo->geRemitente(),
                   $pojo->getIdAutoridad(),$pojo->getIdTema(),$pojo->getClasificacion(),$pojo->getStatusDoc(),
                   $pojo->getFechaAsignacion(),$pojo->getFechaLimiteAtencion(),$pojo->getFechaAlarma(),
                   $pojo->getDocumento(),$pojo->getObservaciones(),$pojo->getMensajeAlerta());
                
            // $id_nuevo=$dao->traer_ultimo_insertado();
            // $carpeta = $carpeta."/".$id_nuevo;
            // if(!file_exists($carpeta))
            // {
            //     mkdir($carpeta,0777,true);
            // }
            // $data[0]=$pojo->getIdCumplimiento();
            // $data[1]=$id_nuevo;
            return $exito_inserccion;
        }catch (Exception $ex)
        {
                throw $ex;
                return -1;
        }
        return $data;
    }
    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_DOCUMENTO_ENTRADA){
        try{
            $dao=new DocumentoEntradaDAO();
            $rec= $dao->actualizarDocumentoEntradaPorColumna($COLUMNA, $VALOR, $ID_DOCUMENTO_ENTRADA);
            return $rec;
        } catch (Exception $ex) {

        }
    }
    
    
    
//    public function eliminar(){
//        try{
//            $dao= new ClausulaDAO();
//            $pojo= new ClausulaPojo();
//            $dao->eliminarClausula($pojo->getIdClausula());
//        } catch (Exception $ex) {
//            throw $ex;
//        }
//    }
    
    public function getIdCumplimiento($ID_DOCUMENTO_ENTRADA)
    {
        try
        {
            $dao= new DocumentoEntradaDAO();
            return $dao->getIdCumplimiento($ID_DOCUMENTO_ENTRADA);
        }catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    
    public function eliminarDocumentoEntrada($ID_DOCUMENTO_ENTRADA){
        try{
            $dao= new DocumentoEntradaDAO();
            $documentoSalida= $dao->verificarExistenciadeDocumentoEntradaEnDocumentoSalida($ID_DOCUMENTO_ENTRADA);
//            $validacion= $dao->verificarSiDocumentoEstaValidado($ID_DOCUMENTO);
            $exito=false;
            if($documentoSalida==0)
            {
//                if($validacion==0)
//                {
                    $exito= $dao->eliminarDocumentoEntrada($ID_DOCUMENTO_ENTRADA);                     
//                }
            } 
            
            return $exito;            
        } catch (Exception $ex) {
            throw $ex;
            return -1;
        }
    }
    
    
    
}

?>