<?php
require_once '../ds/AccesoDB.php';

class ConsultasDAO{

    public function listarConsultas($CONTRATO)
    {
        try
        {
          $query="SELECT distinct tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.fecha_inicio,tbtemas.id_empleado,
                concat (tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) as responsable,
                tbrequisitos.id_requisito, tbrequisitos.requisito,tbrequisitos.penalizacion,
                tbregistros.id_registro,tbregistros.registro, tbregistros.frecuencia, tbtemas.padre cumplimiento_requisito,
                (select count(*) as evidencias_validadas from evidencias tbevidencias where tbevidencias.validacion_supervisor ='1' and tbevidencias.id_registro = tbregistros.id_registro ) evidencias_validadas,
                (select count(*) as evidencias_validadas from evidencias tbevidencias where tbevidencias.id_registro = tbregistros.id_registro ) evidencias_totales
                from temas tbtemas
                join empleados tbempleados on tbempleados.id_empleado = tbtemas.responsable_general
                join asignacion_tema_requisito tbasignacion_tema_requisito
                on tbasignacion_tema_requisito.id_tema = tbtemas.id_tema
                join asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos
                on tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito = tbasignacion_tema_requisito.id_asignacion_tema_requisito
                join requisitos tbrequisitos on tbrequisitos.id_requisito = tbasignacion_tema_requisito_requisitos.id_requisito
                left join requisitos_registros tbrequisitos_registros on tbrequisitos_registros.id_requisito = tbrequisitos.id_requisito
                left join registros tbregistros on tbregistros.id_registro = tbrequisitos_registros.id_registro
                left join evidencias tbevidencias on tbevidencias.id_registro = tbregistros.id_registro
                where tbtemas.padre = 0 and tbtemas.fecha_inicio != '0000-00-00' and tbtemas.contrato = $CONTRATO order by tbtemas.no";
                // echo $query;
          $db=  AccesoDB::getInstancia();
          $lista=$db->executeQuery($query);
          return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function listarRequisitosConPenalizacion($ID_ASIGNACION_TEMA)
    {
        try
        {
            $query="SELECT if(COUNT(*)=0,'sin penalizacion','con penalizacion ') AS resultado
                    FROM requisitos tbrequisitos
                    JOIN asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos 
                    ON tbasignacion_tema_requisito_requisitos.id_requisito=tbrequisitos.id_requisito
                    WHERE tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito=$ID_ASIGNACION_TEMA AND tbrequisitos.penalizacion='true'";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
          
            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }


    
} 


?>

