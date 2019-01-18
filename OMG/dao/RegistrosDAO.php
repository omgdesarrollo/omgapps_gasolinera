<?php
require_once '../ds/AccesoDB.php';

class RegistrosDAO
{
    
    public function mostrarRegistros ($cadena)
    {
        try
        {
            $query="SELECT tbregistros.id_registro, tbregistros.registro

                    FROM registros tbregistros

                    WHERE tbregistros.registro like '%$cadena%'";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerRequisitos($id_asignacion)
    {
        try
        {
            $query="SELECT tbrequisitos.id_requisito, tbrequisitos.requisito

                    FROM asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos

                    JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbasignacion_tema_requisito_requisitos.id_requisito 

                    WHERE tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito=$id_asignacion";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
        
    }
    
    
    public function obtenerRegistros($id_requisito)
    {
        try
        {
            $query="SELECT tbregistros.id_registro, tbregistros.registro

FROM requisitos_registros tbrequisitos_registros

JOIN registros tbregistros ON tbregistros.id_registro=tbrequisitos_registros.id_registro
 
WHERE tbrequisitos_registros.id_requisito=$id_requisito";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

        public function insertarRegistros($registro)
    {
        try
        {
            $query="INSERT INTO registros(id_registro,registro)

                    VALUES (null,'$registro');";
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    
}


?>
