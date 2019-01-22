<?php
 require_once '../dao/InformeEvidenciasDAO.php';

 class InformeEvidenciasModel{
     
     public function listarEvidencias($CONTRATO)
     {
         try
         {
             $dao=new InformeEvidenciasDAO();
             $rec= $dao->listarEvidencias($CONTRATO);
//             $lista=array();
//             $contador=0;
             
             foreach ($rec as $key => $value)
             {                 
                $resp = $dao->avancePlanPorcentaje($value["id_evidencias"]);
                $rec[$key]["avance_plan"] = $resp != null ? number_format($resp*100,2,'.','')."%" : "SIN PLAN";
             };
             
             return $rec;
         } catch (Exception $ex)
         {
             throw $ex;
             return false;
         }
     }
     
     public function obtenerTemayResponsable($ID_DOCUMENTO, $CONTRATO)
     {
         try
         {
             $dao=new InformeEvidenciasDAO();
             $lista= $dao->obtenerTemayResponsable($ID_DOCUMENTO, $CONTRATO);
             
             return $lista;
         } catch (Exception $ex)
         {
             throw $ex;
             return false;
         }
     }
     
     public function obtenerRequisitosporDocumento($ID_DOCUMENTO, $CONTRATO)
     {
         try
         {
             $dao=new InformeEvidenciasDAO();
             $lista= $dao->obtenerRequisitosporDocumento($ID_DOCUMENTO, $CONTRATO);
             
             return $lista;
         } catch (Exception $ex)
         {
             throw $ex;
             return false;
         }
     }
     
     public function obtenerRegistrosporDocumento ($ID_DOCUMENTO,$CONTRATO)
     {
         try
         {
             $dao=new InformeEvidenciasDAO();
             $lista= $dao->obtenerRegistrosporDocumento($ID_DOCUMENTO,$CONTRATO);
             
             return $lista;
         } catch (Exception $ex)
         {
             throw $ex;
             return false;
         }
     }
     
 }

?>

