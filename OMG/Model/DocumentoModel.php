<?php

require_once '../dao/DocumentoDAO.php';
require_once '../Pojo/DocumentoPojo.php';
require_once '../Model/EmpleadoModel.php';

class DocumentoModel{
    //valida los datos del usuario.
    //retorna el registro del usuario como un arreglo asociativo
    
    public function  listarDocumentos($contrato)
    {
        try{
            $dao=new DocumentoDAO();            
            $rec= $dao->mostrarDocumentos($contrato);
            $lista=array();
            $contador=0;
            
            foreach($rec as $value)
            {
                $lista[$contador]= array(
                    "id_documento"=>$value["id_documento"],
                    "clave_documento"=>$value["clave_documento"],
                    "documento"=>$value["documento"],
                    "id_empleado"=>$value["id_empleado"],
                    "nombre_empleado"=>$value["nombre_empleado"],
                    "apellido_paterno"=>$value["apellido_paterno"],
                    "apellido_materno"=>$value["apellido_materno"],
                    "reg"=>$dao->verificarExistenciadeDocumentoEnRegistros($value['id_documento']),
                    "validado"=>$dao->verificarSiDocumentoEstaValidado($value['id_documento'])                                       
                );
//                $cont++;
                $contador++;
            }
            
//            return $lista;
            return $lista;
        }  catch (Exception $e)
        {
            throw  $e;
            return -1;
        }
    }
    
    public function listarDocumento($ID_DOCUMENTO, $CONTRATO)
    {
        try 
        {
            $dao= new DocumentoDAO();
            $rec= $dao->mostrarDocumento($ID_DOCUMENTO, $CONTRATO);
            
            foreach ($rec as $key => $value) 
            {
                $rec[$key]['reg']= $dao->verificarExistenciadeDocumentoEnRegistros($value['id_documento']);
                $rec[$key]['validado']= $dao->verificarSiDocumentoEstaValidado($value['id_documento']);                
            }
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }




    public function  listarDocumentos2($contrato)
    {
        try{
            $dao=new DocumentoDAO();
            $model=new EmpleadoModel();
            
            $rec['doc']=$dao->mostrarDocumentos($contrato);
            $rec['empl']=$model->listarEmpleadosComboBox();
            
            return $rec;
        }  catch (Exception $e)
        {
        throw  $e;
        return -1;
        }
    }
    
    
    public function  listarDocumentosComboBox(){
        try{
            $dao=new DocumentoDAO();
            $rec=$dao->mostrarDocumentosComboBox();
            
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
    
    
    public function nombresCompletosCombobox()
    {
       try
       {
           $dao=new DocumentoDAO();
           $rec= $dao->nombresCompletosCombobox();
           
           return $rec;
       } catch (Exception $ex)
       {
           throw $ex;
           return -1;
       }
    }
    
    public function responsableDelDocumento()
    {
       try
       {
           $dao=new DocumentoDAO();
           $rec= $dao->responsableDelDocumento();
           
           return $rec;
       } catch (Exception $ex)
       {
           throw $ex;
           return -1;
       }
    }
    
    public function verificacionExisteClaveandDocumento($registro,$cualverificar){
        try{
            $dao= new DocumentoDAO();
//            if($cualverificar=="clavedocumento"){
                $rec=$dao->verificacionExisteClaveandDocumento($registro,$cualverificar);
//            }
            
            return $rec;
        } catch (Exception $ex) {
            throw $ex;
        }
        
    }
    
    
    public function insertar($pojo,$CONTRATO){
        try{
            $dao=new DocumentoDAO();
            $lista=array();
            $contador=0;
            
            $exito= $dao->insertarDocumentos($pojo->getClave_documento(),$pojo->getDocumento(),$pojo->getId_empleado(),$CONTRATO);
            
            if($exito[0] = 1)
            {
                $rec= $dao->mostrarDocumento($exito['id_nuevo'],$CONTRATO);
//                echo "valor rec: ".json_encode($rec);              
                foreach($rec as $value)
                {
                    $lista[$contador]= array(
                        "id_documento"=>$value["id_documento"],
                        "clave_documento"=>$value["clave_documento"],
                        "documento"=>$value["documento"],
                        "id_empleado"=>$value["id_empleado"],
                        "nombre_empleado"=>$value["nombre_empleado"],
                        "apellido_paterno"=>$value["apellido_paterno"],
                        "apellido_materno"=>$value["apellido_materno"],
                        "reg"=>$dao->verificarExistenciadeDocumentoEnRegistros($value['id_documento']),
                        "validado"=>$dao->verificarSiDocumentoEstaValidado($value['id_documento'])                                       
                    );
    //                $cont++;
                    $contador++;
                }
            return $lista;
            } 
            else
//                return $exito[0];
            return $lista;
            
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }
    }
    
    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_DOCUMENTO){
        try{
            $dao=new DocumentoDAO();
            $rec= $dao->actualizarDocumentoPorColumna($COLUMNA, $VALOR, $ID_DOCUMENTO);
            
        } catch (Exception $ex) {

        }
    }
    
    
    
    public function eliminarDocumento($ID_DOCUMENTO){
        try{
            $dao= new DocumentoDAO();
            $registros= $dao->verificarExistenciadeDocumentoEnRegistros($ID_DOCUMENTO);
            $validacion= $dao->verificarSiDocumentoEstaValidado($ID_DOCUMENTO);
            $exito=false;
            if($registros==0)
            {
                if($validacion==0)
                {
                    $exito= $dao->eliminarDocumento($ID_DOCUMENTO);                     
                }
            } 
//            echo "Registros: ".json_encode($registros);
//            echo "validacion: ".json_encode($validacion);
//            echo "valor exito: ".json_encode($exito);
            return $exito;            
        } catch (Exception $ex) {
            throw $ex;
            return -1;
        }
    }
    
    
    
    
    
    
}

?>