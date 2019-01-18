<?php


require_once '../dao/ValidacionDocumentoDAO.php';
require_once '../Pojo/ValidacionDocumentoPojo.php';


class ValidacionDocumentoModel{
    
    public function  listarValidacionDocumentos($USUARIO,$CONTRATO){
        try{
            $dao=new ValidacionDocumentoDAO();
            
            $rec=$dao->listarValidacionDocumentos($USUARIO,$CONTRATO);
            
            $lista= self::construirListaValidacionDocumento($rec);//self porque la funcion es static
            
            foreach ($lista as $key => $value) 
            {
                $lista[$key]['detalles_excel'][0]['requisitos']= $dao->obtenerRequisitosporDocumento($value['id_documento']);
                $lista[$key]['detalles_excel'][1]['registros']= $dao->obtenerRegistrosPorDocumento($value['id_documento']);
            }
            
            return $lista; 
        }catch (Exception $ex)
        {
            throw  $ex;
            return -1;
        }
    }

    public function listarValidacionDocumento($USUARIO,$CONTRATO,$ID_VALIDACION_D)
    {
        try{
            $dao=new ValidacionDocumentoDAO();
            $rec=$dao->listarValidacionDocumento($USUARIO,$CONTRATO,$ID_VALIDACION_D);
            return self::construirListaValidacionDocumento($rec);
        }catch (Exception $e)
        {
            throw  $e;
        }
    }

    public static function construirListaValidacionDocumento($rec)
    {
        $idDocumento=-1;
        $lista=array();
        $contador=-1;
        $cont=0;
        foreach($rec as $key=>$value)
        {
            if($value["id_documento"]==$idDocumento)
            {
                $cont++;
                $lista[$contador]["temasResponsables"][$cont]=array("id_empleadoT"=>$value["id_empleadoT"],"responsable_tema"=>$value["responsable_tema"],"nombre_tema"=>$value["nombre_tema"],"id_usuarioT"=>$value["id_usuarioT"]);
            }
            else
            {
                $idDocumento=$value["id_documento"];
                $contador++;
                $lista[$contador]=$value;
                $lista[$contador]["temasResponsables"][$cont]=array("id_empleadoT"=>$value["id_empleadoT"],"responsable_tema"=>$value["responsable_tema"],"nombre_tema"=>$value["nombre_tema"],"id_usuarioT"=>$value["id_usuarioT"]);
                $cont=0;
            }
        }
        return $lista;
    }
    
    public function obtenerInfoPorIdValidacionDocumento($id_validacion_documento)
    {
        try{
             $dao=new ValidacionDocumentoDAO();
            $rec=$dao->obtenerInfoPorIdValidacionDocumento($id_validacion_documento);
            return $rec;
      
        } catch (Exception $ex) {

        }    
    }
    
    public function obtenerTemayResponsable($ID_DOCUMENTO,$CONTRATO)
    {
        try
        {
            $dao=new ValidacionDocumentoDAO();
            $rec=$dao->obtenerTemayResponsable($ID_DOCUMENTO,$CONTRATO);
            
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
            $dao=new ValidacionDocumentoDAO();
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
            $dao=new ValidacionDocumentoDAO();
            $rec=$dao->obtenerRegistrosPorDocumento($id_documento);
            
            return $rec;
            
        } catch (Exception $ex){
            throw $ex;
            return false;
        }
    }    
//    public function insert
    public function insertar($id_documento_entrada){
        try{
                $dao=new SeguimientoEntradaDAO();
                $dao->insertar($id_documento_entrada);
        }catch (Exception $ex) {
                 throw  $ex;
        }
    }

    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_VALIDACION_DOCUMENTO){
        try{
            $dao=new ValidacionDocumentoDAO();
            $rec= $dao->actualizarPorColumna($COLUMNA, $VALOR, $ID_VALIDACION_DOCUMENTO);
            
            return $rec;
        } catch (Exception $ex) {
            return false;
        }
    }

    public function eliminar(){
        try{
            $dao= new ValidacionDocumentoDAO();
            $pojo= new ValidacionDocumentoPojo();
            $dao->eliminarValidacionDocumento($pojo->getId_validacion_documento());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getValidacionTema($ID_VALIDACION_D)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $resp = $dao->getValidacionTema($ID_VALIDACION_D);
            return $resp;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function getValidacionDocumento($ID_VALIDACION_D)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $resp = $dao->getValidacionDocumento($ID_VALIDACION_D);
            return $resp;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function getExisteArchivo($ID_VALIDACION_D)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $resp = $dao->getExisteArchivo($ID_VALIDACION_D);
            return $resp;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function modificarArchivos($ID_VALIDACION_D,$VALOR)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $resp = $dao->modificarArchivos($ID_VALIDACION_D,$VALOR);
            return $resp;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function listarObservaciones($ID_VALIDACION_D)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $resp = $dao->listarObservaciones($ID_VALIDACION_D);
            return "[".$resp."]";
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function getNombreUSuario($ID_USUARIO)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $resp = $dao->getNombreUSuario($ID_USUARIO);
            return $resp;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function enviarObservacion($ID_VALIDACION_DOCUMENTO,$MENSAJE,$ID_USUARIO,$NOMBRE,$FECHA)
    {
        try{
            $dao= new ValidacionDocumentoDAO();
            $cadena = "{\"idU\":\"".$ID_USUARIO."\",\"msj\":\"".$MENSAJE."\",\"nombre\":\"".$NOMBRE."\",\"fecha\":\"".$FECHA."\"}";
            $exito = $dao->enviarObservacion($ID_VALIDACION_DOCUMENTO,$cadena);
            if($exito==1)
                return "[".$cadena."]";
            else
                return 0;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
}

?>