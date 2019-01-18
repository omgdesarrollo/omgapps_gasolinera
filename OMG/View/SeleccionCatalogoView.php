<?php
session_start();
require_once '../util/Session.php';
$Usuario=  Session::getSesion("user");
?>


<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>OMG APPS</title>
		<meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <script src="../../js/jquery.js" type="text/javascript"></script>           
                <!--LIBRERIA SWEET ALERT 2-->
                <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
                <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
                <!--END LIBRERIA SWEET ALERT 2-->
                <!--LIBRERIA DE JGROWL--> 
                 <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
                 <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
                 <!--END LIBRERIA JGROWL-->
                 <script src="../../js/Seleccion_Catalogo&&Reporte.js" type="text/javascript"></script>
                <!--<script src="../../js/tools.js" type="text/javascript"></script>-->           
                 <style>
                    .swal2-modal .swal2-validationerror{
                        background-color:#d5e1ee;
                    }
                 </style>
        </head>
<body class="no-skin" onload="">
<script>
//var urls={detectarVistaCatalogo:"detectarVistaCatalogo",detectarVistaReportes:"detectarVistaReporte"};
var catalogo_reporte="";
 $.getJSON("../../js/Seleccion_Catalogo&&Reporte.json", function(json) {
       catalogo_reporte=json.dataCatalogoReportes[0].detectarVistaCatalogo;
 });
seleccionConcepto();

 
</script>
</body>
     
</html>