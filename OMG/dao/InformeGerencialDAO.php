<?php
require_once '../ds/AccesoDB.php';
class InformeGerencialDAO{
    
    
    public function listarInformeGerencial()
    {
        try
        {
            $query="SELECT tbdocumento_entrada.id_documento_entrada, tbdocumento_entrada.folio_entrada, tbautoridad_remitente.clave_autoridad, tbdocumento_entrada.asunto,
                    tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ', tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) AS nombre_completo,
                    tbdocumento_entrada.fecha_asignacion, tbdocumento_entrada.fecha_limite_atencion, tbdocumento_entrada.fecha_alarma, 
                    tbdocumento_entrada.status_doc		 			 		
                    FROM seguimiento_entrada tbseguimiento_entrada
                    JOIN documento_entrada tbdocumento_entrada ON tbdocumento_entrada.id_documento_entrada=tbseguimiento_entrada.id_documento_entrada
                    JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
                    JOIN temas tbtemas ON tbtemas.id_tema=tbdocumento_entrada.id_tema
                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    
    }

    public function mostrarInformeGerencial(){
        try{
            
            $query="SELECT tbinforme_gerencial.id_informe_gerencial, tbdocumento_entrada.id_documento_entrada, tbdocumento_entrada.folio_entrada,
                    tbautoridad_remitente.clave_autoridad, 
                    tbdocumento_entrada.asunto, 
                    tbempleados.nombre_empleado, tbempleados.id_empleado,tbempleados.apellido_paterno, tbempleados.apellido_materno,
                    tbdocumento_entrada.fecha_asignacion, 
                    tbdocumento_entrada.fecha_limite_atencion, tbdocumento_entrada.fecha_alarma, tbdocumento_entrada.status_doc,tbdocumento_entrada.documento 
                    FROM informe_gerencial tbinforme_gerencial
                    JOIN   documento_entrada tbdocumento_entrada ON 
                    tbdocumento_entrada.id_documento_entrada=tbinforme_gerencial.id_documento_entrada
                    JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
                    JOIN temas tbtemas ON tbtemas.id_tema=tbdocumento_entrada.id_tema
                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado";

            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            

            return $lista;
    }  catch (Exception $ex){
        //throw $rec;
        throw $ex;
    }
    }
    
    
    
    
    public function actualizarInformeGerencialPorColumna($COLUMNA,$VALOR,$ID_INFORME_GERENCIAL){
         
        try{
            $query="UPDATE informe_gerencial SET ".$COLUMNA."='".$VALOR."'  "
                 . "WHERE id_informe_gerencial=$ID_INFORME_GERENCIAL";
            
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    
    
    public function eliminarInformeGerencial($ID_INFORME_GERENCIAL){
        try{
            $query="DELETE FROM informe_gerencial WHERE id_informe_gerencial=$ID_INFORME_GERENCIAL";
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
                throw $ex;
        }
    }
}

?>


