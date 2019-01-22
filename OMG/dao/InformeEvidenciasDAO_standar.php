<?php
require_once '../ds/AccesoDB.php';

class InformeEvidenciasDAO{
    
    public function listarEvidencias($CONTRATO)
    {
        // $query_concat="";
        // if($v["param"]["v"]=="true"){
            
        //     $query_concat.="AND( tbevidencias.validacion_supervisor='true'";
        //     if($v["param"]["n_v"]=="true"){
        //                 $query_concat.="   or tbevidencias.validacion_supervisor='false')";
        //     }else{
        //          $query_concat.=")";
        //     }
        // }
        // if($v["param"]["n_v"]=="true"){
        //     $query_concat.=" AND tbevidencias.validacion_supervisor='false'";            
        // }
        
        try
        {
            $query="SELECT tbtemas.id_tema,
            -- tbtemas.no no_tema,
            --  tbtemas.nombre tema,
             tbusuarios.id_empleado id_empleado_tema, tbusuarios.id_usuario id_usuario_tema,
            (SELECT CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) ) as tema_responsable,
            tbrequisitos.id_requisito,tbrequisitos.requisito, tbregistros.id_registro,tbregistros.registro,tbregistros.frecuencia,
            tbdocumentos.id_documento, tbdocumentos.clave_documento, tbdocumentos.id_empleado id_empleado_documento,

            (SELECT tbtemas2.nombre FROM temas tbtemas2 WHERE tbtemas2.id_tema = tbtemas.padre_general ) AS tema,
            (SELECT tbtemas2.no FROM temas tbtemas2 WHERE tbtemas2.id_tema = tbtemas.padre_general ) AS no_tema,
            
            (select concat(tbempleados2.nombre_empleado,' ',tbempleados2.apellido_paterno,'',tbempleados2.apellido_materno) from empleados tbempleados2
            where tbdocumentos.id_empleado = tbempleados2.id_empleado) as documento_responsable,
            tbevidencias.id_evidencias,tbevidencias.id_usuario,
            
            (select concat(tbempleados3.nombre_empleado,'',tbempleados3.apellido_paterno,'',tbempleados3.apellido_materno) from empleados tbempleados3 
            join usuarios tbusuarios2 on tbusuarios2.id_empleado = tbempleados3.id_empleado
            where tbevidencias.id_usuario = tbusuarios2.id_usuario) as resp,
            
            tbevidencias.accion_correctiva,tbevidencias.fecha_creacion,
            tbevidencias.desviacion, if(tbevidencias.validacion_supervisor='1','VALIDADO','EN PROCESO') estatus
            
            FROM temas tbtemas
            LEFT JOIN asignacion_tema_requisito tbasignacion_tema_requisito ON tbasignacion_tema_requisito.id_tema=tbtemas.id_tema
            LEFT JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos
            ON tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito = tbasignacion_tema_requisito.id_asignacion_tema_requisito
            JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito = tbasignacion_tema_requisito_requisitos.id_requisito
            JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_requisito = tbrequisitos.id_requisito
            JOIN registros tbregistros ON tbregistros.id_registro = tbrequisitos_registros.id_registro
            JOIN evidencias tbevidencias ON tbevidencias.id_registro = tbregistros.id_registro
            JOIN empleados tbempleados ON tbempleados.id_empleado = tbtemas.responsable_general
            JOIN usuarios tbusuarios ON tbusuarios.id_empleado = tbempleados.id_empleado
            JOIN documentos tbdocumentos ON tbdocumentos.id_documento = tbregistros.id_documento
            
            WHERE tbtemas.contrato=$CONTRATO AND tbregistros.registro<>'NULL' AND tbevidencias.validacion_supervisor<>'NULL'";
            
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerTemayResponsable ($ID_DOCUMENTO,$CONTRATO)
    {
        try
        {
            $query="SELECT tbasignacion_tema_requisito.id_tema, tbtemas.no, tbempleados.id_empleado, tbempleados.nombre_empleado, 
                    tbempleados.apellido_paterno, tbempleados.apellido_materno
                    FROM evidencias tbevidencias
                    JOIN registros tbregistros ON tbregistros.id_registro=tbevidencias.id_registro
                    JOIN documentos tbdocumentos ON tbdocumentos.id_documento=tbregistros.id_documento
                    JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_registro=tbregistros.id_registro
                    JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbrequisitos_registros.id_requisito
                    JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos 
                    ON tbasignacion_tema_requisito_requisitos.id_requisito=tbrequisitos.id_requisito
                    JOIN asignacion_tema_requisito tbasignacion_tema_requisito 
                    ON tbasignacion_tema_requisito.id_asignacion_tema_requisito=tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito
                    JOIN temas tbtemas ON tbtemas.id_tema=tbasignacion_tema_requisito.id_tema
                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
                    WHERE tbdocumentos.id_documento=$ID_DOCUMENTO AND tbdocumentos.contrato=$CONTRATO GROUP BY tbtemas.no";
//            echo json_encode($query);
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerRequisitosporDocumento($ID_DOCUMENTO,$CONTRATO)
    {
        try
        {
            $query="SELECT tbrequisitos.id_requisito, tbrequisitos.requisito
                    FROM documentos tbdocumentos
                    JOIN registros tbregistros ON tbregistros.id_documento=tbdocumentos.id_documento
                    JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_registro=tbregistros.id_registro
                    JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbrequisitos_registros.id_requisito
                    WHERE tbdocumentos.id_documento=$ID_DOCUMENTO AND tbdocumentos.contrato=$CONTRATO GROUP BY tbrequisitos.requisito";
            
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function obtenerRegistrosporDocumento($ID_DOCUMENTO,$CONTRATO)
    {
        try
        {
            $query="SELECT tbregistros.id_registro, tbregistros.registro
                    FROM documentos tbdocumentos
                    JOIN registros tbregistros ON tbregistros.id_documento=tbdocumentos.id_documento
                    WHERE tbdocumentos.id_documento=$ID_DOCUMENTO AND tbdocumentos.contrato=$CONTRATO GROUP BY tbregistros.registro";
            
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function avancePlanPorcentaje($ID_EVIDENCIAS)
    {
        try 
        {
            $query="SELECT SUM(tbgantt_evidencias.progress)/COUNT(tbgantt_evidencias.progress) AS total_avance
                    FROM gantt_evidencias tbgantt_evidencias
                    WHERE tbgantt_evidencias.id_evidencias=$ID_EVIDENCIAS AND tbgantt_evidencias.parent=0";
            
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]["total_avance"];            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
}

?>


