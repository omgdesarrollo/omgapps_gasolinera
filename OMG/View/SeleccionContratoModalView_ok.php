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
                
                <!-- bootstrap & fontawesome -->
                <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
                <!--Para abrir alertas de aviso, success,warning, error-->       
                <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
                        <!--Para abrir alertas de aviso, success,warning, error-->       
                 <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>

		<!-- ace styles -->
		<link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<!--<link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" />-->
		<link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
                
                <!--Inicia para el spiner cargando-->
                <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
                <!--Termina para el spiner cargando-->
                
                
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/tabla.css" rel="stylesheet" type="text/css"/>

                 <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script>
                
                
                 <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
                 <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
                
                
                <script src="../../js/jquery.js" type="text/javascript"></script>
                
<style>
        .jsgrid-header-row>.jsgrid-header-cell {
                background-color:#307ECC ;      /* orange */
                font-family: "Roboto Slab";
                font-size: 1.2em;
                color: white;
                font-weight: normal;
            } 
.modal-body{
color:#888;
max-height: calc(100vh - 110px);
overflow-y: auto;
}                    

#sugerenciasclausulas {
width:350px;
height:5px;
overflow: auto;
}  
body{
overflow:hidden;     
}
  

</style>

                
</head>
    
    
    
    
<body class="no-skin" onload="loadSpinner()">

<div id="loader"></div>
          
<button type="button" id="btn-cont" class="btn btn-success" >
    Seleccione Opción
</button>


  <div class="jsgrid" id="jsGrid" style="position: relative; height: 300px; width: 100%;">
        <div class="jsgrid-grid-header jsgrid-header-scrollbar">
        <table  class="jsgrid-table">
            <tbody>
                <tr class="jsgrid-header-row"> 
				
                                <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 170px;">Clave</th>
                                  <th class="jsgrid-header-cell jsgrid-header-sortable" style="width: 170px;">Descripción</th>
    </tr>
 

            <tbody class="hideScrollBar"  id="contenido" >
                </tbody>
   <!--<div></div>-->

</table>
  

<!-- Inicio de Seccion Modal Tema-->
       <div class="modal draggable fade" id="change-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
		        <h4 class="modal-title" id="myModalLabel">Seleccionar Contrato</h4>
		      </div>
                        
		      <div class="modal-body">

                        <div id="contenidomodal" ></div>
		      
                      </div>
		    </div>

		  </div>
       </div>
       <!--Final de Seccion Modal-->
                                              
       
                        
                
<script>

    
    
    
    
    

function loadSpinner()
{
    myFunction();
}

</script>

        <script src="../../js/fSeleccionContratoModalView.js" type="text/javascript"></script>
        <!--Inicia para el spiner cargando-->
        <script src="../../js/loaderanimation.js" type="text/javascript"></script>
        <!--Termina para el spiner cargando-->
        <!--Bootstrap-->
        <script src="../../assets/probando/js/bootstrap.min.js"></script>

        
        <!--Para abrir alertas del encabezado-->
        <script src="../../assets/probando/js/ace-elements.min.js"></script>
        <script src="../../assets/probando/js/ace.min.js"></script>
    </body>
</html>
