<?php
require_once '../ds/AccesoDB.php';
class ValidacionDocumentoDAO{

    public function listarValidacionDocumentos($USUARIO,$CONTRATO){
        try{
            $query="SELECT DISTINCT tbdocumentos.id_documento,tbdocumentos.clave_documento,tbdocumentos.documento, tbempleados.id_empleado id_empleadoD,tbusuarios.id_usuario id_usuarioD,
            CONCAT (tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)AS responsable_documento,
            tbusua2.id_usuario id_usuarioT, tbemplea2.id_empleado id_empleadoT,
            CONCAT (tbemplea2.nombre_empleado,' ',tbemplea2.apellido_paterno,' ',tbemplea2.apellido_materno)AS responsable_tema,tbtemas.nombre nombre_tema,
            IF(tbempleados.id_empleado=tbemplea2.id_empleado,1,0) AS permiso_total,
            IF( tbusua2.id_usuario=$USUARIO,1,0 ) AS soy_responsable,
            tbvalidacion_documento.id_validacion_documento,tbvalidacion_documento.validacion_documento_responsable,
            tbvalidacion_documento.validacion_tema_responsable,tbvalidacion_documento.plan_accion,
            tbvalidacion_documento.desviacion_mayor,tbvalidacion_documento.documento_archivo
            FROM documentos tbdocumentos
            JOIN validacion_documento tbvalidacion_documento ON tbvalidacion_documento.id_documento = tbdocumentos.id_documento
            LEFT JOIN usuarios tbusuarios ON tbusuarios.id_empleado = tbdocumentos.id_empleado
            LEFT JOIN empleados tbempleados ON tbempleados.id_empleado = tbdocumentos.id_empleado
            LEFT JOIN registros tbregistros ON tbregistros.id_documento = tbdocumentos.id_documento
            LEFT JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_registro = tbregistros.id_registro
            LEFT JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito = tbrequisitos_registros.id_requisito
            LEFT JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos ON
            tbasignacion_tema_requisito_requisitos.id_requisito = tbrequisitos.id_requisito
            LEFT JOIN asignacion_tema_requisito tbasignacion_tema_requisito 
            ON tbasignacion_tema_requisito.id_asignacion_tema_requisito = tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito
            LEFT JOIN temas tbtemas ON tbtemas.id_tema = tbasignacion_tema_requisito.id_tema
            LEFT JOIN empleados tbemplea2 ON tbemplea2.id_empleado = tbtemas.id_empleado
            LEFT JOIN usuarios tbusua2 ON tbusua2.id_empleado = tbemplea2.id_empleado
            WHERE tbdocumentos.id_documento!=-1 AND tbtemas.contrato=$CONTRATO AND 
                IF(tbusuarios.id_usuario = $USUARIO,
                        tbusuarios.id_usuario = $USUARIO AND
                        tbdocumentos.id_empleado = tbusuarios.id_empleado,
                        tbusua2.id_usuario = $USUARIO AND
                        tbtemas.id_empleado = tbusua2.id_empleado
                )";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function listarValidacionDocumento($USUARIO,$CONTRATO,$ID_VALIDACION_D)
    {
        try{
            $query="SELECT DISTINCT tbdocumentos.id_documento,tbdocumentos.clave_documento,tbdocumentos.documento, tbempleados.id_empleado id_empleadoD,tbusuarios.id_usuario id_usuarioD,
            CONCAT (tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)AS responsable_documento,
            tbusua2.id_usuario id_usuarioT, tbemplea2.id_empleado id_empleadoT,
            CONCAT (tbemplea2.nombre_empleado,' ',tbemplea2.apellido_paterno,' ',tbemplea2.apellido_materno)AS responsable_tema,

            -- tbtemas.nombre nombre_tema,
            ( SELECT tbtemas2.nombre FROM temas tbtemas2 WHERE tbtemas2.id_tema = tbtemas.padre_general ) as nombre_tema,

            IF(tbempleados.id_empleado=tbemplea2.id_empleado,1,0) AS permiso_total,
            IF( tbusua2.id_usuario=$USUARIO,1,0 ) AS soy_responsable,
            tbvalidacion_documento.id_validacion_documento,tbvalidacion_documento.validacion_documento_responsable,
            tbvalidacion_documento.validacion_tema_responsable,tbvalidacion_documento.plan_accion,
            tbvalidacion_documento.desviacion_mayor,tbvalidacion_documento.documento_archivo
            FROM documentos tbdocumentos
            JOIN validacion_documento tbvalidacion_documento ON tbvalidacion_documento.id_documento = tbdocumentos.id_documento
            LEFT JOIN usuarios tbusuarios ON tbusuarios.id_empleado = tbdocumentos.id_empleado
            LEFT JOIN empleados tbempleados ON tbempleados.id_empleado = tbdocumentos.id_empleado
            LEFT JOIN registros tbregistros ON tbregistros.id_documento = tbdocumentos.id_documento
            LEFT JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_registro = tbregistros.id_registro
            LEFT JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito = tbrequisitos_registros.id_requisito
            LEFT JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos ON
            tbasignacion_tema_requisito_requisitos.id_requisito = tbrequisitos.id_requisito
            LEFT JOIN asignacion_tema_requisito tbasignacion_tema_requisito 
            ON tbasignacion_tema_requisito.id_asignacion_tema_requisito = tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito
            LEFT JOIN temas tbtemas ON tbtemas.id_tema = tbasignacion_tema_requisito.id_tema
            LEFT JOIN empleados tbemplea2 ON tbemplea2.id_empleado = tbtemas.id_empleado
            LEFT JOIN usuarios tbusua2 ON tbusua2.id_empleado = tbemplea2.id_empleado
            WHERE tbdocumentos.id_documento!=-1 AND tbvalidacion_documento.id_validacion_documento=$ID_VALIDACION_D AND tbtemas.contrato=$CONTRATO AND 
                IF(tbusuarios.id_usuario = $USUARIO,
                        tbusuarios.id_usuario = $USUARIO AND
                        tbdocumentos.id_empleado = tbusuarios.id_empleado,
                        tbusua2.id_usuario = $USUARIO AND
                        tbtemas.id_empleado = tbusua2.id_empleado
                )";
            // echo $query;
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerInfoPorIdValidacionDocumento($id_validacion_documento)
    {
        try
        {
         $query="SELECT tbvalidacion_documento.id_validacion_documento, tbdocumentos.id_documento, tbdocumentos.clave_documento,
                    tbdocumentos.documento,
		 
                    tbempleados.id_empleado id_empleado_documento, tbempleados.nombre_empleado nombre_empleado_documento,
                    tbempleados.apellido_paterno apellido_paterno_documento, tbempleados.apellido_materno apellido_materno_documento,

                    tbclausulas.clausula, tbclausulas.descripcion_clausula,

                    tbclausulas.id_empleado id_empleado_tema, tbempleados_tema.nombre_empleado nombre_empleado_tema,
                    tbempleados_tema.apellido_paterno apellido_paterno_tema, tbempleados_tema.apellido_materno apellido_materno_tema,

                    tbvalidacion_documento.documento_archivo, 
                    tbvalidacion_documento.validacion_documento_responsable, tbvalidacion_documento.observacion_documento,
                    tbvalidacion_documento.validacion_tema_responsable, tbvalidacion_documento.observacion_tema,
                    tbvalidacion_documento.plan_accion, tbvalidacion_documento.desviacion_mayor

                    FROM validacion_documento tbvalidacion_documento


                    JOIN documentos tbdocumentos ON 
                    tbdocumentos.id_documento=tbvalidacion_documento.id_documento

                    JOIN asignacion_tema_requisito tbasignacion_tema_requisito ON
                    tbasignacion_tema_requisito.id_documento=tbdocumentos.id_documento

                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumentos.id_empleado

                    JOIN clausulas tbclausulas ON tbclausulas.id_clausula=tbasignacion_tema_requisito.id_clausula


                    JOIN empleados tbempleados_tema ON tbempleados_tema.id_empleado=tbclausulas.id_empleado 
                    WHERE tbvalidacion_documento.ID_VALIDACION_DOCUMENTO=$id_validacion_documento";
         
         
         
         
         
     } catch (Exception $ex) {
         throw $ex;
     }
         
    }
 
    public function obtenerTemayResponsable($ID_DOCUMENTO,$CONTRATO)
    {
        try{
            $query="SELECT DISTINCT tbusuarios.id_usuario,
            -- tbtemas.nombre,
            CONCAT (tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)AS responsable_tema,
            ( SELECT tbtemas2.nombre FROM temas tbtemas2 WHERE tbtemas2.id_tema = tbtemas.padre_general ) as nombre

            FROM validacion_documento tbvalidacion_documento
            JOIN documentos tbdocumentos ON tbdocumentos.id_documento=tbvalidacion_documento.id_documento
            JOIN registros tbregistros ON tbregistros.id_documento=tbdocumentos.id_documento
            JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_registro=tbregistros.id_registro
            JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbrequisitos_registros.id_requisito
            JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos ON
            tbasignacion_tema_requisito_requisitos.id_requisito=tbrequisitos.id_requisito
            JOIN asignacion_tema_requisito tbasignacion_tema_requisito ON 
            tbasignacion_tema_requisito.id_asignacion_tema_requisito=tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito
            JOIN temas tbtemas ON tbtemas.id_tema=tbasignacion_tema_requisito.id_tema
            JOIN empleados tbempleados ON tbempleados.id_empleado = tbtemas.responsable_general
            JOIN usuarios tbusuarios ON tbusuarios.id_empleado = tbempleados.id_empleado
            WHERE tbdocumentos.id_documento=$ID_DOCUMENTO AND tbtemas.contrato=$CONTRATO";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;            
        } catch (Exception $ex){
            throw $ex;
            return false;
        }
    }
    
    public function obtenerRequisitosporDocumento($id_documento)
    {
        try
        {
            
            $query="SELECT tbrequisitos.id_requisito, tbrequisitos.requisito

                    FROM documentos tbdocumentos

                    JOIN registros tbregistros ON tbregistros.id_documento=tbdocumentos.id_documento
                    JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_registro=tbregistros.id_registro
                    JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbrequisitos_registros.id_requisito
                    WHERE tbdocumentos.id_documento=$id_documento GROUP BY tbrequisitos.requisito";
         
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        }  catch (Exception $ex){
            throw $ex;
            return false;
        }
    }

    public function obtenerRegistrosPorDocumento($id_documento)
    {
        try
        {
            
            $query="SELECT tbregistros.id_registro, tbregistros.registro

                    FROM documentos tbdocumentos
                    JOIN registros tbregistros ON tbregistros.id_documento=tbdocumentos.id_documento
                    WHERE tbdocumentos.id_documento=$id_documento GROUP BY tbregistros.registro";
         
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        }  catch (Exception $ex){
            throw $ex;
            return false;
        }
    }
    
    public function insertar($id_documento_entrada)//Checar este insertar para que es
    {
        try{
             $query_obtenerMaximo_mas_uno="SELECT max(id_seguimiento_entrada)+1 as id_seguimiento_entrada FROM seguimiento_entrada";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo_seguimiento_entrada=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo_seguimiento_entrada= $value["id_seguimiento_entrada"];
            }
            
            if($id_nuevo_seguimiento_entrada==NULL){
                $id_nuevo_seguimiento_entrada=0;
            }                                                                                                                           
            
            $query="INSERT INTO seguimiento_entrada (id_seguimiento_entrada,id_documento_entrada,id_empleado)VALUES"
                    . "($id_nuevo_seguimiento_entrada,$id_documento_entrada,0)";
            
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
         } catch (Exception $ex) {

        }
    }
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_VALIDACION_DOCUMENTO)
    {
        try{
            $query="UPDATE validacion_documento SET ".$COLUMNA."='".$VALOR."'  "
                 . "WHERE id_validacion_documento=$ID_VALIDACION_DOCUMENTO";
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
            return $result;
        }catch (Exception $ex)
        {
           throw $ex;
           return false;
        }
    }

    public function eliminarValidacionDocumento($id_validacion_documento)
    {
        try{
            $query="DELETE FROM validacion_documento WHERE id_validacion_documento=$id_validacion_documento";
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
                throw $ex;
        }
    }

    public function getValidacionTema($ID_VALIDACION_D)//listo
    {
        try
        {
            $query="SELECT if(tbvalidacion_documento.validacion_tema_responsable='true',true,false) AS response
            FROM validacion_documento tbvalidacion_documento 
            WHERE tbvalidacion_documento.id_validacion_documento = $ID_VALIDACION_D";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista[0]["response"];
        }
        catch(Exception $e)
        {
            return -1;
        }
    }

    public function getValidacionDocumento($ID_VALIDACION_D)//listo
    {
        try
        {
            $query="SELECT if(tbvalidacion_documento.validacion_documento_responsable='true',true,false) AS response
            FROM validacion_documento tbvalidacion_documento 
            WHERE tbvalidacion_documento.id_validacion_documento = $ID_VALIDACION_D";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista[0]["response"];
        }
        catch(Exception $e)
        {
            return -1;
        }
    }

    public function getExisteArchivo($ID_VALIDACION_D)//listo
    {
        try
        {
            $query="SELECT if(tbvalidacion_documento.documento_archivo = 0,false,true) AS response
            FROM validacion_documento tbvalidacion_documento 
            WHERE tbvalidacion_documento.id_validacion_documento = $ID_VALIDACION_D";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista[0]["response"];
        }
        catch(Exception $e)
        {
            return -1;
        }
    }

    public function modificarArchivos($ID_VALIDACION_D,$VALOR)
    {
        try
        {
            $query="UPDATE validacion_documento tbvalidacion_documento set tbvalidacion_documento.documento_archivo = 
            (tbvalidacion_documento.documento_archivo + $VALOR)
            WHERE tbvalidacion_documento.id_validacion_documento = $ID_VALIDACION_D";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQueryUpdate($query);
            return $lista;
            
        }catch(Exception $e)
        {
            return -1;
        }
    }

    public function listarObservaciones($ID_VALIDACION_D)
    {
        try
        {
            $query="SELECT tbvalidacion_documento.observaciones
            FROM validacion_documento tbvalidacion_documento
            WHERE tbvalidacion_documento.id_validacion_documento = $ID_VALIDACION_D";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista[0]["observaciones"];
        }catch(Exception $e)
        {
            return -1;
        }
    }
    public function getNombreUSuario($ID_USUARIO)
    {
        try
        {
            $query="SELECT CONCAT (tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)AS nombre
            FROM empleados tbempleados
            JOIN usuarios tbusuarios ON tbusuarios.id_empleado = tbempleados.id_empleado
            WHERE tbusuarios.id_usuario = $ID_USUARIO";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista[0]["nombre"];
        }catch(Exception $e)
        {
            return -1;
        }
    }
    public function enviarObservacion($ID_VALIDACION_DOCUMENTO,$MENSAJE)
    {
        try
        {
            $query="UPDATE validacion_documento tbvalidacion_documento 
            SET tbvalidacion_documento.observaciones = IF(tbvalidacion_documento.observaciones!='',CONCAT(tbvalidacion_documento.observaciones,',','$MENSAJE'),'$MENSAJE')
            WHERE tbvalidacion_documento.id_validacion_documento = $ID_VALIDACION_DOCUMENTO";
            $db = AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            return $exito;
        }catch(Exception $e)
        {
            return -1;
        }
    }
}

?>
