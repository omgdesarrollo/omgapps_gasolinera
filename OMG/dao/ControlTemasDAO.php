<?php

require_once '../ds/AccesoDB.php';
class ControlTemasDAO {
    //put your code here
    public function listarTemas($CONTRATO,$CADENA)
    {
        try 
        {
            // -- tbasignacion_tema_requisito.id_asignacion_tema_requisito,tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito,
            // -- tbrequisitos.id_requisito,tbregistros.id_registro, tbevidencias.id_evidencias,
            $query="SELECT DISTINCT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion, tbtemas.fecha_inicio, tbcumplimientos.modo_trabajo, tbevidencias.fecha_fisica,
            IF( (SELECT count(*) FROM evidencias tbevidencias2 WHERE tbevidencias2.id_registro = tbregistros.id_registro) = 0,0,1) as estado
            FROM temas tbtemas
            LEFT JOIN asignacion_tema_requisito tbasignacion_tema_requisito ON tbasignacion_tema_requisito.id_tema = tbtemas.id_tema
            LEFT JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos
            on tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito = tbasignacion_tema_requisito.id_asignacion_tema_requisito
            LEFT JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito = tbasignacion_tema_requisito_requisitos.id_requisito
            LEFT JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_requisito = tbrequisitos.id_requisito
            LEFT JOIN registros tbregistros ON tbregistros.id_registro = tbrequisitos_registros.id_registro
            LEFT JOIN evidencias tbevidencias ON tbevidencias.id_registro = tbregistros.id_registro
            JOIN cumplimientos tbcumplimientos ON tbcumplimientos.id_cumplimiento = tbtemas.contrato
            WHERE tbtemas.padre= 0 AND tbtemas.contrato = $CONTRATO AND tbtemas.identificador LIKE '%catalogo%'
            AND tbevidencias.fecha_fisica != '0000-00-00' order by tbevidencias.fecha_fisica ASC";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    public function actualizar($ID_TEMA,$FECHA)
    {
        try
        {
            $query = "UPDATE temas set fecha_inicio = '$FECHA' WHERE id_tema = $ID_TEMA";
            $db = AccesoDB::getInstancia();
            // echo $query;
            $exito = $db->executeUpdateRowsAfected($query);
            return $exito;
        }catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function iniciarTematica($ID_TEMA, $FECHA)
    {
        try
        {
            $query = "UPDATE temas set fecha_inicio = '$FECHA' WHERE id_tema = $ID_TEMA";
            $db = AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            return $exito;
        }catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
}

?>
