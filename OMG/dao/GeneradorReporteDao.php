<?php
require_once '../ds/AccesoDB.php';
class GeneradorReporteDao {
        public function listarReportesporFecha($FECHA_INICIO,$FECHA_FINAL,$CUMPLIMIENTO)
    {
            
        try
        {
            $query="SELECT 
                 tbasignaciones_contrato.region_fiscal,tbasignaciones_contrato.clave_contrato,tbcatalogoproduccion.ubicacion,
                 tbcatalogoproduccion.tag_patin,tbcatalogoproduccion.tipo_medidor,tbcatalogoproduccion.tag_medidor,tbcatalogoproduccion.clasificacion,
                 tbcatalogoproduccion.hidrocarburo,  tbomg_reporte_produccion.omgc1,
        		 sum(tbomg_reporte_produccion.omgc2)/count(*) as omgc2,sum(tbomg_reporte_produccion.omgc3)/count(*) as omgc3, sum(tbomg_reporte_produccion.omgc4) as omgc4,sum(tbomg_reporte_produccion.omgc5)/count(*) as omgc5,
        		 sum(tbomg_reporte_produccion.omgc6)/count(*) as omgc6, tbomg_reporte_produccion.omgc7, tbomg_reporte_produccion.omgc8, sum(tbomg_reporte_produccion.omgc9) as omgc9,
        		 sum(tbomg_reporte_produccion.omgc10)/count(*) as omgc10,sum(tbomg_reporte_produccion.omgc11)/count(*) as omgc11, sum(tbomg_reporte_produccion.omgc12)/count(*) as omgc12,sum(tbomg_reporte_produccion.omgc13)/count(*) as omgc13,
        		 sum(tbomg_reporte_produccion.omgc14)/count(*) as omgc14,sum(tbomg_reporte_produccion.omgc15)/count(*) as omgc15,sum(tbomg_reporte_produccion.omgc16)/count(*) as omgc16,tbomg_reporte_produccion.omgc17,
        		 tbomg_reporte_produccion.omgc18               
                 FROM omg_reporte_produccion tbomg_reporte_produccion
                 JOIN catalogo_produccion tbcatalogoproduccion ON tbcatalogoproduccion.ID_CATALOGOP=tbomg_reporte_produccion.ID_CATALOGOP
                 JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.ID_ASIGNACION=tbcatalogoproduccion.ID_ASIGNACION
                 WHERE tbomg_reporte_produccion.omgc1 BETWEEN '$FECHA_INICIO' AND '$FECHA_FINAL'  AND
                 tbasignaciones_contrato.CONTRATO=$CUMPLIMIENTO"
                    . ""
                    . "  group by tbcatalogoproduccion.TAG_MEDIDOR";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    public function listarReportesDiariosFechaInicioaFechaFinal($FECHA_INICIO,$FECHA_FINAL,$CUMPLIMIENTO)
    {
         
        try {
            $query="SELECT tbasignaciones_contrato.region_fiscal,tbasignaciones_contrato.clave_contrato,tbcatalogoproduccion.ubicacion,
        tbcatalogoproduccion.tag_patin,tbcatalogoproduccion.tipo_medidor,tbcatalogoproduccion.tag_medidor,tbcatalogoproduccion.clasificacion,
        tbcatalogoproduccion.hidrocarburo,  tbomg_reporte_produccion.omgc1,
		 tbomg_reporte_produccion.omgc2,tbomg_reporte_produccion.omgc3 , tbomg_reporte_produccion.omgc4,tbomg_reporte_produccion.omgc5,
		 tbomg_reporte_produccion.omgc6, tbomg_reporte_produccion.omgc7, tbomg_reporte_produccion.omgc8, tbomg_reporte_produccion.omgc9,
		 tbomg_reporte_produccion.omgc10,tbomg_reporte_produccion.omgc11, tbomg_reporte_produccion.omgc12,tbomg_reporte_produccion.omgc13,
		tbomg_reporte_produccion.omgc14,tbomg_reporte_produccion.omgc15,tbomg_reporte_produccion.omgc16,tbomg_reporte_produccion.omgc17,
		 tbomg_reporte_produccion.omgc18
                FROM omg_reporte_produccion tbomg_reporte_produccion
                 JOIN catalogo_produccion tbcatalogoproduccion ON tbcatalogoproduccion.ID_CATALOGOP=tbomg_reporte_produccion.ID_CATALOGOP
                 JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.ID_ASIGNACION=tbcatalogoproduccion.ID_ASIGNACION
                 WHERE tbomg_reporte_produccion.omgc1 BETWEEN '$FECHA_INICIO' AND '$FECHA_FINAL'  AND
                 tbasignaciones_contrato.CONTRATO=$CUMPLIMIENTO";
                     
                     $db=  AccesoDB::getInstancia();
                     $lista = $db->executeQuery($query);
                     return $lista;
        } catch (Exception $e) {
            throw $ex;
            return -1;
        }   
    }
    
    public function listarReportePorMonthAndYear($MONTH,$YEAR,$CONTRATO,$REGION_FISCAL)
    { 
        $query_concat="";      
        if($REGION_FISCAL!="null"){
              $query_concat.="AND tbasignaciones_contrato.region_fiscal='$REGION_FISCAL'";
        }
        try
        {
            $query="SELECT tbasignaciones_contrato.region_fiscal,tbasignaciones_contrato.clave_contrato,tbcatalogo_produccion.ubicacion,
                           tbcatalogo_produccion.tag_patin,tbcatalogo_produccion.tipo_medidor,tbcatalogo_produccion.tag_medidor,
                           tbcatalogo_produccion.clasificacion,tbcatalogo_produccion.hidrocarburo,tbomg_reporte_produccion.omgc1,
                           tbomg_reporte_produccion.omgc2,tbomg_reporte_produccion.omgc3 , tbomg_reporte_produccion.omgc4,
                           tbomg_reporte_produccion.omgc5,tbomg_reporte_produccion.omgc6,tbomg_reporte_produccion.omgc7, tbomg_reporte_produccion.omgc8, 
                           tbomg_reporte_produccion.omgc9,tbomg_reporte_produccion.omgc10,tbomg_reporte_produccion.omgc11, tbomg_reporte_produccion.omgc12,
                           tbomg_reporte_produccion.omgc13,tbomg_reporte_produccion.omgc14,tbomg_reporte_produccion.omgc15,tbomg_reporte_produccion.omgc16,
                           tbomg_reporte_produccion.omgc17,tbomg_reporte_produccion.omgc18
                           FROM omg_reporte_produccion tbomg_reporte_produccion
                           JOIN catalogo_produccion tbcatalogo_produccion ON tbcatalogo_produccion.id_catalogop=tbomg_reporte_produccion.id_catalogop
                           JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.id_asignacion=tbcatalogo_produccion.id_asignacion
                           WHERE MONTH(tbomg_reporte_produccion.omgc1) = $MONTH AND YEAR(tbomg_reporte_produccion.omgc1) = $YEAR 
                           AND tbasignaciones_contrato.contrato =$CONTRATO"."   ".$query_concat ;
              
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function sumaByMonthAndYear($MONTH,$YEAR,$CONTRATO,$REGION_FISCAL)
    {
        
        
         $query_concat="";
//        
        if($REGION_FISCAL!="null"){
              $query_concat.="AND tbasignaciones_contrato.region_fiscal='$REGION_FISCAL'";
        }
        try
        {
            $query="SELECT tbasignaciones_contrato.region_fiscal,tbasignaciones_contrato.clave_contrato,tbcatalogo_produccion.ubicacion,
                    tbcatalogo_produccion.tag_patin,tbcatalogo_produccion.tipo_medidor,tbcatalogo_produccion.tag_medidor,tbcatalogo_produccion.clasificacion,
                    tbcatalogo_produccion.hidrocarburo,
                    tbomg_reporte_produccion.omgc1,
                    SUM(tbomg_reporte_produccion.omgc2)/COUNT(*) AS omgc2, SUM(tbomg_reporte_produccion.omgc3)/COUNT(*) AS omgc3,
                    SUM(tbomg_reporte_produccion.omgc4) as omgc4, SUM(tbomg_reporte_produccion.omgc5)/COUNT(*) AS omgc5,
                    SUM(tbomg_reporte_produccion.omgc6)/COUNT(*) AS omgc6, SUM(tbomg_reporte_produccion.omgc7)/COUNT(*) AS omgc7,
                    SUM(tbomg_reporte_produccion.omgc8)/COUNT(*) AS omgc8, SUM(tbomg_reporte_produccion.omgc9) as omgc9,
                    SUM(tbomg_reporte_produccion.omgc10)/COUNT(*) AS omgc10, SUM(tbomg_reporte_produccion.omgc11)/COUNT(*) omgc11,
                    SUM(tbomg_reporte_produccion.omgc12)/COUNT(*) AS omgc12, SUM(tbomg_reporte_produccion.omgc13) as omgc13,
                    SUM(tbomg_reporte_produccion.omgc14)/COUNT(*) AS omgc14, SUM(tbomg_reporte_produccion.omgc15)/COUNT(*) AS omgc15,
                    SUM(tbomg_reporte_produccion.omgc16)/COUNT(*) AS omgc16, tbomg_reporte_produccion.omgc17,
                    tbomg_reporte_produccion.omgc18
                    FROM omg_reporte_produccion tbomg_reporte_produccion
                    JOIN catalogo_produccion tbcatalogo_produccion ON tbcatalogo_produccion.id_catalogop=tbomg_reporte_produccion.id_catalogop
                    JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.id_asignacion=tbcatalogo_produccion.id_asignacion
                    WHERE MONTH(tbomg_reporte_produccion.omgc1) = $MONTH AND YEAR(tbomg_reporte_produccion.omgc1) = $YEAR 
                    AND tbasignaciones_contrato.contrato =$CONTRATO"."   ".$query_concat."   GROUP BY tbcatalogo_produccion.TAG_MEDIDOR";
                    ;           
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function  sumaDereportesDiariosByMonthAndYear($MONTH,$YEAR,$CONTRATO)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM omg_reporte_produccion tbomg_reporte_produccion
                    JOIN catalogo_produccion tbcatalogo_produccion ON tbcatalogo_produccion.id_catalogop=tbomg_reporte_produccion.id_catalogop 
                    JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.id_asignacion=tbcatalogo_produccion.id_asignacion
                    WHERE MONTH(tbomg_reporte_produccion.omgc1) = $MONTH AND YEAR(tbomg_reporte_produccion.omgc1) = $YEAR 
                    AND tbasignaciones_contrato.CONTRATO = $CONTRATO";  
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista[0]['resultado'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function insertarPorcentajesMolares($MONTH,$YEAR,$OMG2C1,$OMG2C2,$OMG2C3,$OMG2C4,$OMG2C5,$OMG2C6,$OMG2C7,$OMG2C8,$OMG2C9,$OMG2C10,$OMG2C11,$CONTRATO)
    {
        try
        {
            $query="INSERT INTO porcentajes_molares(mes,ano,omg2c1,omg2c2,omg2c3,omg2c4,omg2c5,omg2c6,omg2c7,omg2c8,omg2c9,omg2c10,omg2c11,contrato)
                    VALUES($MONTH,$YEAR,$OMG2C1,$OMG2C2,$OMG2C3,$OMG2C4,$OMG2C5,$OMG2C6,$OMG2C7,$OMG2C8,$OMG2C9,$OMG2C10,$OMG2C11,$CONTRATO)";
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeQueryUpdate($query);
            return $exito;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function porcentajesMolaresByMonthAndYear($MONTH,$YEAR,$CONTRATO)
    {
        try
        {
            $query="SELECT tbporcentajes_molares.id_porcentaje, tbporcentajes_molares.mes, tbporcentajes_molares.ano,
                    tbporcentajes_molares.omg2c1,tbporcentajes_molares.omg2c2,tbporcentajes_molares.omg2c3,tbporcentajes_molares.omg2c4,
                    tbporcentajes_molares.omg2c5,tbporcentajes_molares.omg2c6,tbporcentajes_molares.omg2c7,tbporcentajes_molares.omg2c8,
                    tbporcentajes_molares.omg2c9,tbporcentajes_molares.omg2c10,tbporcentajes_molares.omg2c11,contrato	
                    FROM porcentajes_molares tbporcentajes_molares
                    WHERE tbporcentajes_molares.mes = $MONTH AND tbporcentajes_molares.ano = $YEAR 
                    AND tbporcentajes_molares.contrato = $CONTRATO";
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
     
    public function actualilzarPorcentajeMolar($QUERY)
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
    
    public function verificarSiExisteReporteMolarByMonthAndYear($MONTH,$YEAR,$CONTRATO)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM porcentajes_molares tbporcentajes_molares
                    WHERE tbporcentajes_molares.mes = $MONTH AND tbporcentajes_molares.ano = $YEAR AND tbporcentajes_molares.contrato = $CONTRATO";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]['resultado'];            
        } catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function reportesFaltantesByMonthAndYear($MONTH,$YEAR,$CONTRATO)
    {
        try
        {
            $query="SELECT TIMESTAMPDIFF(DAY,MAX(tbomg_reporte_produccion.omgc1), CURDATE()) AS resultado
                    FROM omg_reporte_produccion tbomg_reporte_produccion
                    JOIN catalogo_produccion tbcatalogo_produccion ON tbcatalogo_produccion.id_catalogop=tbomg_reporte_produccion.id_catalogop
                    JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.id_asignacion=tbcatalogo_produccion.id_asignacion
                    WHERE MONTH(tbomg_reporte_produccion.omgc1) = $MONTH AND YEAR(tbomg_reporte_produccion.omgc1)= $YEAR
                    AND tbasignaciones_contrato.contrato = $CONTRATO";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]['resultado']; 
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function reportesFaltantesPorRangos($FECHA_INICIAL,$FECHA_FINAL,$CONTRATO)
    {
        try
        {
            $query="SELECT (SELECT TIMESTAMPDIFF(DAY,'$FECHA_INICIAL', '$FECHA_FINAL'))-COUNT(*) AS resultado
                    FROM omg_reporte_produccion tbomg_reporte_produccion
                    JOIN catalogo_produccion tbcatalogo_produccion ON tbcatalogo_produccion.id_catalogop=tbomg_reporte_produccion.id_catalogop
                    JOIN asignaciones_contrato tbasignaciones_contrato ON tbasignaciones_contrato.id_asignacion=tbcatalogo_produccion.id_asignacion
                    WHERE tbomg_reporte_produccion.omgc1 BETWEEN '$FECHA_INICIAL' AND '$FECHA_FINAL' AND tbasignaciones_contrato.CONTRATO = $CONTRATO";
            
            $db=  AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista[0]['resultado'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
        
    }
    
}
