<?php

require_once '../ds/AccesoDB.php';

class AsignacionDocumentoTemaDAO {
    //put your code here
    public function mostrarAsignacionDocumentosTemas(){
        try{
//            $query="SELECT TBASIGNACION_DOCUMENTO_TEMA.ID_ASIGNACION_DOCUMENTO_TEMA, TBDOCUMENTOS.ID_DOCUMENTO, 
//                    TBDOCUMENTOS.CLAVE_DOCUMENTO, TBDOCUMENTOS.DOCUMENTO,
//                    TBASIGNACION_TEMA_REQUISITO.ID_ASIGNACION_TEMA_REQUISITO, TBASIGNACION_TEMA_REQUISITO.ID_CLAUSULA,
//                    TBCLAUSULAS.CLAUSULA,TBCLAUSULAS.DESCRIPCION_CLAUSULA,
//                    TBASIGNACION_TEMA_REQUISITO.REQUISITO FROM ASIGNACION_DOCUMENTO_TEMA TBASIGNACION_DOCUMENTO_TEMA
//
//                    JOIN DOCUMENTOS TBDOCUMENTOS ON TBASIGNACION_DOCUMENTO_TEMA.ID_DOCUMENTO=TBDOCUMENTOS.ID_DOCUMENTO
//
//                    JOIN ASIGNACION_TEMA_REQUISITO TBASIGNACION_TEMA_REQUISITO ON
//                    TBASIGNACION_DOCUMENTO_TEMA.ID_ASIGNACION_TEMA_REQUISITO=TBASIGNACION_TEMA_REQUISITO.ID_ASIGNACION_TEMA_REQUISITO
//
//                    JOIN CLAUSULAS TBCLAUSULAS ON TBCLAUSULAS.ID_CLAUSULA=TBASIGNACION_TEMA_REQUISITO.ID_CLAUSULA";
            
            $query="SELECT tbasignacion_documento_tema.id_asignacion_documento_tema, tbdocumentos.id_documento, 
                    tbdocumentos.clave_documento, tbdocumentos.documento,
                    tbasignacion_tema_requisito.id_asignacion_tema_requisito, tbasignacion_tema_requisito.id_clausula,
                    tbclausulas.clausula,tbclausulas.descripcion_clausula,
                    tbasignacion_tema_requisito.requisito FROM asignacion_documento_tema tbasignacion_documento_tema

                    JOIN documentos tbdocumentos ON tbasignacion_documento_tema.id_documento=tbdocumentos.id_documento

                    JOIN asignacion_tema_requisito tbasignacion_tema_requisito ON
                    tbasignacion_documento_tema.id_asignacion_tema_requisito=tbasignacion_tema_requisito.id_asignacion_tema_requisito

                    JOIN clausulas tbclausulas ON tbclausulas.id_clausula=tbasignacion_tema_requisito.id_clausula
";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            

            return $lista;
    }  catch (Exception $ex){
        //throw $rec;
        throw $ex;
    }
    }
    
    
    public function insertarAsignacionDocumentoTema($id_documento,$id_asignacion_tema_requisito){
        
        try{
            
//            $query_obtenerMaximo_mas_uno="SELECT max(ID_ASIGNACION_DOCUMENTO_TEMA)+1 as ID_ASIGNACION_DOCUMENTO_TEMA from ASIGNACION_DOCUMENTO_TEMA";
            $query_obtenerMaximo_mas_uno="SELECT max(id_asignacion_documento_tema)+1 as id_asignacion_documento_tema FROM asignacion_documento_tema";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_asignacion_documento_tema"];
            }
            
            
            $query="INSERT INTO asignacion_documento_tema (id_asignacion_documento_tema,id_documento,id_asignacion_tema_requisito) VALUES ($id_nuevo,$id_documento,$id_asignacion_tema_requisito)";
            
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
                throw $ex;
        }   
    }
    
    
    
    
    
    public function actualizarAsignacionDocumentoTemaPorColumna($COLUMNA,$VALOR,$ID_ASIGNACION_DOCUMENTO_TEMA){
         
        try{
            $query="UPDATE asignacion_documento_tema SET ".$COLUMNA."='".$VALOR."'  "
                 . "WHERE id_asignacion_documento_tema=$ID_ASIGNACION_DOCUMENTO_TEMA";
            
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    
    
    public function eliminarAsignacionDocumentoTema($ID_ASIGNACION_DOCUMENTO_TEMA){
        try{
            $query="DELETE FROM asignacion_documento_tema WHERE id_asignacion_documento_tema=$ID_ASIGNACION_DOCUMENTO_TEMA";
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
                throw $ex;
        }
    }

    public function buscarDocumento($CADENA,$CONTRATO)
    {
        try{
            $query="SELECT tbdocumentos.id_documento, tbdocumentos.clave_documento,tbdocumentos.documento,
                CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) AS nombre_empleado
                FROM documentos tbdocumentos
                JOIN empleados tbempleados ON tbdocumentos.id_empleado = tbempleados.id_empleado
                WHERE tbdocumentos.contrato = $CONTRATO AND ( LOWER(tbdocumentos.clave_documento) LIKE '%$CADENA%'
                OR LOWER(tbdocumentos.documento) LIKE '%$CADENA%' )";
                
            $db =  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
        }catch(Exception $ex)
        {
                throw $ex;
                return false;
        }
    }
    
}
