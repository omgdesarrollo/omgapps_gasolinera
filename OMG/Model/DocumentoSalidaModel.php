<?php

require_once '../dao/DocumentoSalidaDAO.php';
require_once '../Pojo/DocumentoSalidaPojo.php';

class DocumentoSalidaModel {
    //put your code here
    public function  listarDocumentosSalida($CONTRATO){
        try{
            $lista=[];
            $dao=new DocumentoSalidaDAO();
            $rec1=$dao->mostrarDocumentosSalida($CONTRATO);
            $rec2=$dao->mostrarDocumentosSalidaSinFolio($CONTRATO);
            $contador=0;
            foreach($rec1 as $key => $value)
            {
                $lista[$contador]=$value;
                $contador++;
            }
            foreach($rec2 as $key => $value)
            {
                $lista[$contador]=$value;
                $contador++;
            }
            return $lista;
        }  catch (Exception $e){
            throw  $e;
            return -1;
        }
    }

    public function listarDocumentoSalida($ID_DOCUMENTO_SALIDA,$TABLA)
    {
        try
        {
            $lista=[];
            $dao=new DocumentoSalidaDAO();
            if($TABLA == "documento_salida" )
            {
                $lista = $dao->mostrarDocumentoSalida($ID_DOCUMENTO_SALIDA);
            }
            else
            {
                $lista = $dao->mostrarDocumentosSalidaSinFolio($ID_DOCUMENTO_SALIDA);
            }
            return $lista;
        }catch(Exception $e)
        {
            throw $e;
            return -1;
        }
    }
    
    public function listarFoliosDeEntrada()
    {
        try{
            $dao=new DocumentoSalidaDAO();
            $rec=$dao->listarFoliosDeEntrada();
            
            
            return $rec;
        }  catch (Exception $ex){
            throw  $ex;
            return -1;
        }
        
    }

    public function insertar($pojo,$CONTRATO)
    {
        try{
            $rec = [];
            $dao=new DocumentoSalidaDAO();
            $lista=array();
            $contador=0;
            $tabla = $pojo->getId_documento_entrada() == -1 ? "documento_salida_sinfolio_entrada" :"documento_salida";

            $id1 = $dao->obtenermayorDocumentoSalidasSinFolio();
            $id2 = $dao->obtenermayorDocumentoSalidaConFolio();
            if($id1<$id2)
                $id1=$id2;
            if($id1==-1)
                $id1=0;
            $exito= $dao->insertarDocumentosSalida($tabla,$id1+1,$pojo->getId_documento_entrada(),$pojo->getFolio_salida(),$pojo->getFecha_envio(),
            $pojo->getAsunto(),$pojo->getDestinatario(),$pojo->getObservaciones(),$CONTRATO);

            if($exito[0] == 1)
            {
                $rec = $tabla == "documento_salida" ? $dao->mostrarDocumentoSalida($id1+1) : $dao->listarDocumentoSalidaSinFolio($id1+1);
            //    echo "valor rec: ".json_encode($rec);
    //             foreach($rec as $value)
    //             {
    //                 $lista[$contador] = array(
    //                     "id_documento_salida"=>$value["id_documento_salida"],
    //                     "id_documento_entrada"=>$value["id_documento_entrada"],
    //                     "documento"=>$value["documento"],
    //                     "folio_entrada"=>$value["folio_entrada"],
    //                     "folio_salida"=>$value["folio_salida"],
    //                     "fecha_envio"=>$value["fecha_envio"],
    //                     "asunto"=>$value["asunto"],
    //                     "clave_autoridad"=>$value["clave_autoridad"],
    //                     "destinatario"=>$value["destinatario"],
    //                     "nombre_empleado"=>$value["nombre_empleado"],
    //                     "apellido_paterno"=>$value["apellido_paterno"],
    //                     "apellido_materno"=>$value["apellido_materno"],
    //                     "documento"=>$value["documento"],
    //                     "observaciones"=>$value["observaciones"]    
    //                 );
    // //                $cont++;
    //                 $contador++;
                // }
                // return $lista;
            }
            else
               return $exito[0];
            // echo $rec;
            return $rec;
           
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }
    }
    
    
    
    public function actualizar($pojo){
        try{
            $dao= new ClausulaDAO();
        $dao->actualizarClausula($pojo->getIdClausula(),$pojo->getClausula(),$pojo->getSubClausula(),
                $pojo->getDescripcionClausula(),$pojo->getDescripcionSubClausula(),$pojo->getTextoBreve(),
                $pojo->getDescripcion(),$pojo->getPlazo());
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_DOCUMENTO_SALIDA){
        try{
            $dao=new DocumentoSalidaDAO();
            $rec= $dao->actualizarDocumentoSalidaPorColumna($COLUMNA, $VALOR, $ID_DOCUMENTO_SALIDA);
            
        } catch (Exception $ex) {

        }
    }
    
    
    
    public function eliminarDocumentoSalidaConFolio($ID_DOCUMENTO)
    {
        try
        {
            $dao=new DocumentoSalidaDAO();
            $rec= $dao->eliminarDocumentoSalidaConFolio($ID_DOCUMENTO);

            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function responsablesDelTemaCombobox()
    {
        try 
        {
            $dao=new DocumentoSalidaDAO();
            $rec= $dao->responsablesDelTemaCombobox();
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    
    public function responsableDelTemaParaFiltro($CONTRATO)
    {
        try 
        {
            $dao=new DocumentoSalidaDAO();
            $rec1= $dao->responsableDelTemaParaFiltroConFolio($CONTRATO);
            $rec2= $dao->responsableDelTemaParaFiltroSinFolio($CONTRATO);
            $resultado = array_merge($rec1, $rec2);
            $lista= array_unique($resultado, SORT_REGULAR);
                                              
            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    public function autoridadRemitenteParaFiltro($CONTRATO)
    {
        try 
        {
            $dao=new DocumentoSalidaDAO();
            $rec1= $dao->autoridadRemitenteParaFiltroConFolio($CONTRATO);
            $rec2= $dao->autoridadRemitenteParaFiltroSinFolio($CONTRATO);
            $resultado = array_merge($rec1, $rec2);
            $lista= array_unique($resultado, SORT_REGULAR);
                                              
            return $lista;
            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }



    //    AREA DEL DOCUMENTO DE SALIA SIN FOLIO DE ENTRADA
    
    public function eliminarDocumento($ID_DOCUMENTO)
    {
        try
        {
            $dao=new DocumentoSalidaDAO();
            $rec = $dao->eliminarDocumentoSalidaSinFolio($ID_DOCUMENTO);
            if($rec <= 0)
                $rec = $dao->eliminarDocumentoSalidaConFolio($ID_DOCUMENTO);
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
}

?>