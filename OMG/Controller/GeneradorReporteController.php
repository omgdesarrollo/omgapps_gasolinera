<?php
//este controlador solo atiende un requerimiento
//el requerimiento que atiende es el de inicio de sesion
session_start();
require_once '../util/Session.php';
require_once '../Model/GeneradorReporteModel.php';
$Op=$_REQUEST["Op"];
$modelGenerador=new GeneradorReporteModel();
switch ($Op) {
	case 'GenerarReporteCalculoDeTodosLosDiariosRangoFechas':
	$Lista= $modelGenerador->listarReportesporFecha($_REQUEST['FECHA_INICIO'],$_REQUEST['FECHA_FINAL'],Session::getSesion("s_cont"));
      header('Content-type: application/json; charset=utf-8');
        echo json_encode($Lista);     
	break;	
	case  'GenerarReporteTodosLosDiarios':
	    $Lista= $modelGenerador->listarReportesDiariosFechaInicioaFechaFinal($_REQUEST['FECHA_INICIO'],$_REQUEST['FECHA_FINAL'],Session::getSesion("s_cont"));
	    header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
	break;
    
        case 'ListByMonthAndYear':
            $Lista= $modelGenerador->listarReportePorMonthAndYear($_REQUEST['MONTH'], $_REQUEST['YEAR'],Session::getSesion("s_cont"),$_REQUEST["REGION_FISCAL"]);
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
        
        case 'ListByMonthAndYearCalculo':
            $Lista= $modelGenerador->sumaByMonthAndYear($_REQUEST['MONTH'], $_REQUEST['YEAR'],Session::getSesion("s_cont"),$_REQUEST["REGION_FISCAL"]); 
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
        
        case 'ListSumaReportesDiariosCaluloMensualConAnualCombinado':
            $Lista= $modelGenerador->sumaDereportesDiariosByMonthAndYear($_REQUEST['MONTH'], $_REQUEST['YEAR'],Session::getSesion("s_cont"));
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
        
        case 'guardarPorcentajesMolaresMes':
            $Lista= $modelGenerador->insertarPorcentajesMolares
            (
                $_REQUEST['MES'],$_REQUEST['ANO'],$_REQUEST['omg2c1'],$_REQUEST['omg2c2'],$_REQUEST['omg2c3'],
                $_REQUEST['omg2c4'],$_REQUEST['omg2c5'],$_REQUEST['omg2c6'],$_REQUEST['omg2c7'],$_REQUEST['omg2c8'],
                $_REQUEST['omg2c9'],$_REQUEST['omg2c10'],$_REQUEST['omg2c11'],Session::getSesion("s_cont"));
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
        
        case 'ListPorcentajesMolaresMes':
            $Lista= $modelGenerador->porcentajesMolaresByMonthAndYear($_REQUEST['MES'], $_REQUEST['ANO'], Session::getSesion("s_cont"));
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);    
            break;
        
        case 'actualizarPorcentajesMolares':
            //Para verificar si funciona el controller
            //$Lista= $modelGenerador->actualilzarPorcentajeMolar(array("omg2c1"=>3,"omg2c2"=>5), 1);
            $Lista= $modelGenerador->actualilzarPorcentajeMolar($_REQUEST['COLUMNAS'],$_REQUEST['ID']);
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
        
        case 'verificarExistenciaMolaresConMesYAno':
            $Lista= $modelGenerador->verificarSiExisteReporteMolarByMonthAndYear($_REQUEST['MES'], $_REQUEST['ANO'], Session::getSesion("s_cont"));
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
           
        case 'faltantesPorMes':
            $Lista= $modelGenerador->reportesFaltantesByMonthAndYear($_REQUEST['MES'], $_REQUEST['YEAR'], Session::getSesion("s_cont"));
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
            
        case 'faltantesPorRangos':
            $Lista= $modelGenerador->reportesFaltantesPorRangos($_REQUEST['FECHA_INICIAL'], $_REQUEST['FECHA_FINAL'], Session::getSesion("s_cont"));
            header('Content-type: application/json; charset=utf-8');
	    echo json_encode($Lista);
            break;
        
        
        
        default:
            -1;
}

?>


