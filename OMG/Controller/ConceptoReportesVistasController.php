<?php
session_start();
require_once '../util/Session.php';
require_once '../Model/SeleccionConceptoReporteModel.php';
$Op=$_REQUEST["Op"];

$modelConceptoReporteVistas= new SeleccionConceptoReporteModel();

switch ($Op)
{
   
    case "detectarVistaCatalogo":
        $lista;
        if(Session::getSesion("token")===$_REQUEST["gom"]){
            $lista=$modelConceptoReporteVistas->evaluarVista($_REQUEST["idConcepto"],"catalogo");
             
        } else {
            $lista=array("mensajenotsesion"=>"hola intentaste acceder sin tener sesion  como lo vez intenta en otra ocasion te reto a pasar esta seguridad:D");
        }
           header('Content-type: application/json; charset=utf-8');
           echo json_encode($lista);
      
    break;
    case "detectarVistaReporte":
        $lista;
        if(Session::getSesion("token")==$_REQUEST["gom"]){
            $lista=$modelConceptoReporteVistas->evaluarVista($_REQUEST["idConcepto"],"reporte");
             
        } else {
            $lista=array("mensajenotsesion"=>"hola intentaste acceder sin tener sesion  como lo vez intenta en otra ocasion te reto a pasar esta seguridad:D");
        }
           header('Content-type: application/json; charset=utf-8');
           echo json_encode($lista);
      
    break;

    
    
    default:
        echo -1;
    break;
}


?>
