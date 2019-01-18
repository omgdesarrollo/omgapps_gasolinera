<?php
require_once '../ds/AccesoDB.php';

class CatalogoProduccionDAO{
    
    
    public function listarCatalogo($CONTRATO)//listo
    {
        try
        {
            $query="SELECT tbcatalogo_produccion.id_catalogoP, tbasignaciones_contrato.clave_contrato, tbasignaciones_contrato.region_fiscal,
            tbcatalogo_produccion.ubicacion, tbcatalogo_produccion.tag_patin, tbcatalogo_produccion.tipo_medidor,
            tbcatalogo_produccion.tag_medidor, tbcatalogo_produccion.clasificacion,
            tbcatalogo_produccion.hidrocarburo
            FROM catalogo_produccion tbcatalogo_produccion
            JOIN asignaciones_contrato tbasignaciones_contrato
            ON tbasignaciones_contrato.id_asignacion = tbcatalogo_produccion.id_asignacion
            WHERE tbasignaciones_contrato.contrato = $CONTRATO";
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    

    public function listarUno($ID_CONTRATO)
    {
        try
        {
            $query="SELECT tbcatalogo_produccion.id_catalogoP, tbasignaciones_contrato.clave_contrato, tbasignaciones_contrato.region_fiscal,
            tbcatalogo_produccion.ubicacion, tbcatalogo_produccion.tag_patin, tbcatalogo_produccion.tipo_medidor,
            tbcatalogo_produccion.tag_medidor, tbcatalogo_produccion.clasificacion,
            tbcatalogo_produccion.hidrocarburo
            FROM catalogo_produccion tbcatalogo_produccion
            JOIN asignaciones_contrato tbasignaciones_contrato
            ON tbasignaciones_contrato.id_asignacion = tbcatalogo_produccion.id_asignacion
            WHERE tbcatalogo_produccion.id_catalogop = $ID_CONTRATO";
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function listarPorAsignacion($ID_ASIGNACION)
    {
        try
        {
            $query="SELECT tbcatalogo_produccion.id_catalogoP, tbasignaciones_contrato.clave_contrato, tbasignaciones_contrato.region_fiscal,
            tbcatalogo_produccion.ubicacion, tbcatalogo_produccion.tag_patin, tbcatalogo_produccion.tipo_medidor,
            tbcatalogo_produccion.tag_medidor, tbcatalogo_produccion.clasificacion,
            tbcatalogo_produccion.hidrocarburo
            FROM catalogo_produccion tbcatalogo_produccion
            JOIN asignaciones_contrato tbasignaciones_contrato
            ON tbasignaciones_contrato.id_asignacion = tbcatalogo_produccion.id_asignacion
            WHERE tbcatalogo_produccion.id_asignacion = $ID_ASIGNACION";
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function guardarCatalogo($QUERY)
    {
        try
        {
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeQueryUpdate($QUERY);
            if($exito==1)
                $exito = $db->executeQuery("SELECT LAST_INSERT_ID()")[0]["LAST_INSERT_ID()"];
            else
                $exito = -2;
            return $exito;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarID($CADENA,$CONTRATO)//listo ahora si
    {
        try
        {
            $query="SELECT DISTINCT tbasignaciones_contrato.id_asignacion, tbasignaciones_contrato.clave_contrato, tbasignaciones_contrato.region_fiscal, tbcatalogo_produccion.ubicacion
            FROM asignaciones_contrato tbasignaciones_contrato
            LEFT JOIN catalogo_produccion tbcatalogo_produccion ON tbasignaciones_contrato.id_asignacion = tbcatalogo_produccion.id_asignacion
            WHERE tbasignaciones_contrato.contrato = $CONTRATO AND lower(tbasignaciones_contrato.region_fiscal) = lower('$CADENA')";
            $db = AccesoDB::getInstancia();
            $Lista = $db->executeQuery($query);
            return $Lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarID_asignacionPorID_Catalogo($ID_CATALOGOP)//listo
    {
        try
        {
            $query="SELECT tbcatalogo_produccion.id_asignacion
            FROM catalogo_produccion tbcatalogo_produccion
            JOIN asignaciones_contrato tbasignaciones_contrato 
            ON tbasignaciones_contrato.id_asignacion = tbcatalogo_produccion.id_asignacion
            WHERE tbcatalogo_produccion.id_catalogop = $ID_CATALOGOP";
            $db = AccesoDB::getInstancia();
            $Lista = $db->executeQuery($query);
            return $Lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarRegionesFiscales($CONTRATO)//listo
    {
        try
        {
            $query="SELECT tbasignaciones_contrato.region_fiscal
                    FROM asignaciones_contrato tbasignaciones_contrato
                    WHERE tbasignaciones_contrato.contrato = $CONTRATO";
            $db = AccesoDB::getInstancia();
            $exito = $db->executeQuery($query);
            return $exito;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarTagMedidor($CONTRATO,$TAG_MEDIDOR)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM catalogo_produccion tbcatalogo_produccion
                    JOIN asignaciones_contrato tbasignaciones_contrato ON
                    tbasignaciones_contrato.id_asignacion = tbcatalogo_produccion.id_asignacion
                    WHERE lower(tbcatalogo_produccion.tag_medidor) = lower('$TAG_MEDIDOR') AND tbasignaciones_contrato.contrato = $CONTRATO";
            $db = AccesoDB::getInstancia();
            $exito = $db->executeQuery($query);
            return $exito[0]["resultado"];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function permisoDeEliminar($ID_CONTRATO)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado FROM omg_reporte_produccion tbomg_reporte WHERE tbomg_reporte.id_catalogop = $ID_CONTRATO";
            $db = AccesoDB::getInstancia();
            $exito = $db->executeQuery($query);
            return $exito[0]["resultado"];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerConceptos($CUMPLIMIENTO){
        try{
            $query="SELECT tbconceptos_reportes.id_concepto_reportes,"
                  ."tbconceptos_reportes.concepto,tbconceptos_reportes.vista FROM concepto_reportes tbconceptos_reportes WHERE tbconceptos_reportes.cumplimientos=$CUMPLIMIENTO";
            $db = AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
//            echo utf8_encode($lista);
//            SELECT convert(cast(convert(content using latin1) as binary) using utf8) AS content
            return $lista;
        } catch (Exception $ex) {
            throw $ex;
//            return -1;
        }
    }
      public function obtenerVista_Concepto_Seleccionado($value){
        try{
            $query="SELECT tbconceptos_reportes.id_concepto_reportes,"
                  ."tbconceptos_reportes.concepto,tbconceptos_reportes.vista FROM concepto_reportes tbconceptos_reportes WHERE tbconceptos_reportes.id_concepto_reportes=$value";
            $db = AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            return $lista[0];
        } catch (Exception $ex) {
            throw $ex;
//            return -1;
        }
    }

    public function eliminarRegistro($ID_CONTRATO)
    {
        try
        {
            $query="DELETE FROM catalogo_produccion WHERE id_catalogop = $ID_CONTRATO";
            $db = AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            return $exito;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function actualizar($QUERY)
    {
        try 
        {
            $db=  AccesoDB::getInstancia();
            $update = $db->executeUpdateRowsAfected($QUERY);
            return $update;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    

}


?>

