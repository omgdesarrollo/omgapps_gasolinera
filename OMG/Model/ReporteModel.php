<?php
require_once '../dao/ReporteDao.php';
  class ReporteModel{
      
    public function listarReportes($CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->listarReportes($CONTRATO);   
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function listarReporte($ID_REPORTE, $CONTRATO)
    {
        try 
        {
            $dao=new ReporteDao();
            $rec= $dao->listarReporte($ID_REPORTE, $CONTRATO);
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw  $ex;
            return -1;
        }
    }


    public function listarReportesporFecha($FECHA_INICIO, $FECHA_FINAL, $CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $rec= $dao->listarReportesporFecha($FECHA_INICIO, $FECHA_FINAL, $CONTRATO);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function buscarID($CONTRATO, $CADENA)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->buscarID($CONTRATO, $CADENA);
            if(sizeof($lista)==0)
                $lista = 0;
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarRegionesFiscales($CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->buscarRegionesFiscales($CONTRATO);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerTagPatin($UBICACION,$CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->obtenerTagPatin($UBICACION,$CONTRATO);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerTagMedidor($TAG_PATIN, $CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->obtenerTagMedidor($TAG_PATIN, $CONTRATO);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerTipoMedidor($TAG_MEDIDOR, $CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->obtenerTipoMedidor($TAG_MEDIDOR, $CONTRATO);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;        
        } 
    }
    
    public function insertarReporte($FECHA_CREACION, $ID_CATALOGOP, $USUARIO,$CONTRATO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista=array();
            $contador=0;
            $exito=0;
            $TAG_MEDIDOR= $dao->verificarTagMedidor($ID_CATALOGOP);
//            echo "Este es el tagMedidor: ".json_encode($TAG_MEDIDOR);
            $VERIFICAR= $dao->verificarSiExisteElTagMedidorPorFecha($TAG_MEDIDOR, $FECHA_CREACION);
//            echo "Este es el resultado: ".json_encode($VERIFICAR);
            $datosDiaAnterior= $dao->datosDiaAnterior();
            
            if($datosDiaAnterior==null)
            {
               $datosDiaAnterior[0]["omgc5"]=0;
               $datosDiaAnterior[0]["omgc6"]=0;
               $datosDiaAnterior[0]["omgc7"]=0;
               $datosDiaAnterior[0]["omgc8"]=0;
               $datosDiaAnterior[0]["omgc10"]=0;
               $datosDiaAnterior[0]["omgc11"]=0;
               $datosDiaAnterior[0]["omgc12"]=0;
            }
            
            if($VERIFICAR == "0")
            {
                $exito= $dao->insertarReporte($FECHA_CREACION, $ID_CATALOGOP, $USUARIO, $datosDiaAnterior[0]);
                
                if($exito >= 0)
                {
                    $rec= $dao->listarReporte($exito,$CONTRATO);
                foreach ($rec as $value)
                {
                $lista[$contador]= array(
                    "id_reporte"=>$value["id_reporte"],
                    "clave_contrato"=>$value["clave_contrato"],
                    "region_fiscal"=>$value["region_fiscal"],
                    "ubicacion"=>$value["ubicacion"],
                    "tag_patin"=>$value["tag_patin"],
                    "tipo_medidor"=>$value["tipo_medidor"],
                    "tag_medidor"=>$value["tag_medidor"],
                    "clasificacion"=>$value["clasificacion"],
                    "hidrocarburo"=>$value["hidrocarburo"],
                    "omgc1"=>$value["omgc1"],
                    "omgc2"=>$value["omgc2"],
                    "omgc3"=>$value["omgc3"],
                    "omgc4"=>$value["omgc4"],
                    "omgc5"=>$value["omgc5"],
                    "omgc6"=>$value["omgc6"],
                    "omgc7"=>$value["omgc7"],
                    "omgc8"=>$value["omgc8"],
                    "omgc9"=>$value["omgc9"],
                    "omgc10"=>$value["omgc10"],
                    "omgc11"=>$value["omgc11"],
                    "omgc12"=>$value["omgc12"],
                    "omgc13"=>$value["omgc13"],
                    "omgc14"=>$value["omgc14"],
                    "omgc15"=>$value["omgc15"],
                    "omgc16"=>$value["omgc16"],
                    "omgc17"=>$value["omgc17"],
                    "omgc18"=>$value["omgc18"]
                    );
                    $contador++;
                }

                return $lista;
                }
                else
                    return $lista;
            }
            else
                return $exito;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
     public function insertarReporte2($FECHA_CREACION, $ID_CATALOGOP, $USUARIO)
    {
        try
        {
            $dao=new ReporteDao();
            $lista= $dao->insertarReporte($FECHA_CREACION, $ID_CATALOGOP, $USUARIO);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
}
?>
