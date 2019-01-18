<?php
require_once '../ds/AccesoDB.php';
class DocumentoEntradaDAO{

    public function getFechaAlarma()
    {
        try
        {
            
            $query = "SELECT tbdocumento_entrada.folio_entrada,tbcumplimientos.clave_cumplimiento,
            tbdocumento_entrada.fecha_limite_atencion,tbdocumento_entrada.fecha_alarma, tbdocumento_entrada.mensaje_alerta
            FROM documento_entrada tbdocumento_entrada
            
            JOIN cumplimientos tbcumplimientos ON tbcumplimientos.id_cumplimiento = tbdocumento_entrada.id_cumplimiento where tbdocumento_entrada.status_doc = 1";

            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        }
        catch(Exception $ex)
        {
            throw $ex;
        }
    }
    
    public function mostrarDocumentosEntrada($CONTRATO){
        try{
            $query="SELECT
                    tbdocumento_entrada.id_documento_entrada, tbdocumento_entrada.folio_referencia,
                    tbdocumento_entrada.folio_entrada, tbdocumento_entrada.fecha_recepcion,
                    tbdocumento_entrada.asunto, tbdocumento_entrada.remitente,
                    tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad,
                    tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion,       
                    tbempleados.nombre_empleado,tbempleados.apellido_paterno, tbempleados.apellido_materno,       
                    tbdocumento_entrada.clasificacion, tbdocumento_entrada.status_doc,
                    tbdocumento_entrada.fecha_asignacion, tbdocumento_entrada.fecha_limite_atencion,
                    tbdocumento_entrada.fecha_alarma, tbdocumento_entrada.documento,
                    tbdocumento_entrada.observaciones,
                    ( SELECT COUNT(*) AS resultado FROM documento_salida tbdocumento_salida
                        WHERE tbdocumento_salida.id_documento_entrada = tbdocumento_entrada.id_documento_entrada
                    ) AS salida,
                    
                    IF( ( SELECT COUNT(*)
                            FROM seguimiento_entrada tbseguimiento_entrada
                            JOIN gantt_seguimiento_entrada tbgantt_seguimiento_entrada ON
                            tbgantt_seguimiento_entrada.id_seguimiento_entrada = tbseguimiento_entrada.id_seguimiento_entrada
                            WHERE tbseguimiento_entrada.id_documento_entrada = tbdocumento_entrada.id_documento_entrada) > 0,1,0
                    ) AS gantt

                    FROM documento_entrada tbdocumento_entrada
                    JOIN cumplimientos tbcumplimientos ON tbcumplimientos.id_cumplimiento=tbdocumento_entrada.id_cumplimiento
                    JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
                    JOIN temas tbtemas ON tbtemas.id_tema=tbdocumento_entrada.id_tema
                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
                    WHERE tbcumplimientos.id_cumplimiento=$CONTRATO AND tbdocumento_entrada.id_documento_entrada!=-1"; 
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function listarDocumentoEntrada($ID_DOCUMENTO_ENTRADA){
        try{
            $query="SELECT tbdocumento_entrada.id_documento_entrada, tbdocumento_entrada.folio_referencia,
            tbdocumento_entrada.folio_entrada, tbdocumento_entrada.fecha_recepcion,
            tbdocumento_entrada.asunto, tbdocumento_entrada.remitente,
            tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad,
            tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion,       
            tbempleados.nombre_empleado,tbempleados.apellido_paterno, tbempleados.apellido_materno,       
            tbdocumento_entrada.clasificacion, tbdocumento_entrada.status_doc,
            tbdocumento_entrada.fecha_asignacion, tbdocumento_entrada.fecha_limite_atencion,
            tbdocumento_entrada.fecha_alarma, tbdocumento_entrada.documento,
            tbdocumento_entrada.observaciones,
            ( SELECT COUNT(*) AS resultado FROM documento_salida tbdocumento_salida
                        WHERE tbdocumento_salida.id_documento_entrada = tbdocumento_entrada.id_documento_entrada
                    ) AS salida,
                    
            IF( ( SELECT COUNT(*)
                    FROM seguimiento_entrada tbseguimiento_entrada
                    JOIN gantt_seguimiento_entrada tbgantt_seguimiento_entrada ON
                    tbgantt_seguimiento_entrada.id_seguimiento_entrada = tbseguimiento_entrada.id_seguimiento_entrada
                    WHERE tbseguimiento_entrada.id_documento_entrada = tbdocumento_entrada.id_documento_entrada) > 0,1,0
            ) AS gantt
            FROM documento_entrada tbdocumento_entrada
            JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
            JOIN temas tbtemas ON tbtemas.id_tema=tbdocumento_entrada.id_tema
            JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
            WHERE tbdocumento_entrada.id_documento_entrada = $ID_DOCUMENTO_ENTRADA";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function listarCumplimientoPorId_Entrada($id_entrada){
        try{
            
        
            $query="documento_entrada.id_cumplimiento from documento_entrada  where documento_entrada.id_documento_entrada=$id_entrada";


            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            

            return $lista;
            } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    
    public function mostrarDocumentosEntradaComboBox($CONTRATO)
    {
        try{
           
            $query="SELECT tbdocumento_entrada.id_documento_entrada, tbdocumento_entrada.folio_entrada
                    FROM documento_entrada tbdocumento_entrada
                    WHERE tbdocumento_entrada.id_cumplimiento=$CONTRATO OR tbdocumento_entrada.id_documento_entrada=-1";
            
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            /*$rec = NULL;
            if (count($lista)==1){
                $rec=$lista[0];
            }
            return $rec;*/

            return $lista;
    }  catch (Exception $ex){
        //throw $rec;
        throw $ex;
    }
    }
    
    
    public function verificarSiExisteFolioEntrada($cadena,$cualverificar){
        try{
           $query="SELECT tbdocumento_entrada.folio_entrada  FROM documento_entrada tbdocumento_entrada WHERE tbdocumento_entrada.$cualverificar ='$cadena'";

            
//            $query="SELECT ID_EMPLEADO  FROM EMPLEADOS";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista;
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    
    public function loadAutoComplete($cadena){
    try{
            $query="SELECT tbdocumento_entrada.remitente FROM documento_entrada tbdocumento_entrada WHERE tbdocumento_entrada.id_documento_entrada = '$cadena'";

            
//            $query="SELECT ID_EMPLEADO  FROM EMPLEADOS";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista;
            
    } catch (Exception $ex) {

    }
}
    
    
    public function traer_ultimo_insertado(){
         $query_obtenerMaximo_mas_uno="SELECT max(id_documento_entrada) as id_documento_entrada FROM documento_entrada";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_documento_entrada"];
            }
            
            
            if($id_nuevo==null){
                $id_nuevo=0;
            } 
            return $id_nuevo; 
    }
    
    
    
    public function insertarDocumentosEntrada($id_cumplimiento,$folio_referencia,$folio_entrada,$fecha_recepcion,$asunto,$remitente,$id_autoridad,
                                             $id_tema,$clasificacion,$status_doc,$fecha_asignacion,$fecha_limite_atencion,$fecha_alarma,
                                             $documento,$observaciones,$mensaje_alerta){
        
        try{
            
            $query_obtenerMaximo_mas_uno="SELECT max(id_documento_entrada)+1 as id_documento_entrada from documento_entrada";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_documento_entrada"];
            }
            
            if($id_nuevo==NULL){
                $id_nuevo=0;
            }
            
                                                   
            $query="INSERT INTO documento_entrada (id_documento_entrada,id_cumplimiento,folio_referencia,folio_entrada,fecha_recepcion,asunto,remitente,
					           id_autoridad,id_tema,clasificacion,status_doc,fecha_asignacion,fecha_limite_atencion,fecha_alarma,
					           documento,observaciones,mensaje_alerta)

                    
                                    VALUES($id_nuevo,$id_cumplimiento,'$folio_referencia','$folio_entrada','$fecha_recepcion','$asunto','$remitente',$id_autoridad,
                                           $id_tema,'$clasificacion','$status_doc','$fecha_asignacion','$fecha_limite_atencion',
                                          '$fecha_alarma','$documento','$observaciones','$mensaje_alerta');";
            
            $db=  AccesoDB::getInstancia();
//            try{
           $exito_inserccion= $db->executeQueryUpdate($query); 
//            } catch (Exception $ex) {
//
//            }
           
           
        } catch (Exception $ex) {
                throw $ex;
        }
        return $exito_inserccion;
    }
    
    /*
    public function actualizarClausula($id_clausula,$clausula,$sub_clausula,$descripcion_clausula,$descripcion_sub_clausula,$texto_breve,$descripcion,$plazo){
        try{
             $query="UPDATE CLAUSULAS SET CLAUSULA='$clausula', SUB_CLAUSULA='$sub_clausula', DESCRIPCION_CLAUSULA='$descripcion_clausula', DESCRIPCION_SUB_CLAUSULA='$descripcion_sub_clausula', TEXTO_BREVE='$texto_breve', DESCRIPCION='$descripcion',PLAZO='$plazo' WHERE ID_CLAUSULA=$id_clausula";
     
            $db= AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
           throw $ex; 
        }
        
    }*/
    
    
    public function actualizarDocumentoEntradaPorColumna($COLUMNA,$VALOR,$ID_DOCUMENTO_ENTRADA){
         
        try{
            $query="UPDATE documento_entrada SET ".$COLUMNA."='".$VALOR."'  "
                 . "WHERE id_documento_entrada=$ID_DOCUMENTO_ENTRADA";
            
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
            // echo $result;
           return $result;
        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    
    
//    public function eliminarClausula($id_clausula)
//    {
//        try{
//            $query="DELETE FROM documento_entrada WHERE id_documento_entrada=$id_clausula";
//            $db=  AccesoDB::getInstancia();
//            $db->executeQueryUpdate($query);
//        } catch (Exception $ex) {
//                throw $ex;
//        }
//    }
    
    
    public function eliminarDocumentoEntrada($ID_DOCUMENTO_ENTRADA){
        try{
            $query="DELETE FROM documento_entrada WHERE id_documento_entrada=$ID_DOCUMENTO_ENTRADA";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);

            return $lista;
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }
    }
    
    
    public function verificarExistenciadeDocumentoEntradaEnDocumentoSalida($ID_DOCUMENTO_ENTRADA)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM documento_salida tbdocumento_salida
                    WHERE tbdocumento_salida.id_documento_entrada=$ID_DOCUMENTO_ENTRADA";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['resultado'];
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
        
    }
    
    
    
    public function getIdCumplimiento($ID_DOCUMENTO_ENTRADA)
    {
        try
        {
            $query = "SELECT documento_entrada.ID_CUMPLIMIENTO FROM documento_entrada WHERE id_documento_entrada = $ID_DOCUMENTO_ENTRADA";
            $db= AccesoDB::getInstancia();
            $dato = $db->executeQuery($query);
            
            return $dato[0];
        } catch(Exception $ex)
        {
            throw $ex;
        }
    }
}

?>
