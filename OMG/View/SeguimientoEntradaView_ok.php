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

		<!-- ace styles Para Encabezado-->
		<link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
                
                <!--Inicia para el spiner cargando-->
                <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
                <!--Termina para el spiner cargando-->
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <script src="../../js/jquery.js" type="text/javascript"></script>
                <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
                <script src="../../js/jqueryblockUI.js" type="text/javascript"></script>

<!--                <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
                <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>-->

                <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script>
                
                <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
                <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
                <!--<script src="../../js/tools.js" type="text/javascript"></script>-->
                <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>
                <script src="../../js/fSeguimientoEntradaView.js" type="text/javascript"></script>
                <script src="../../js/fechas_formato.js" type="text/javascript"></script>
                <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
        <style>
            .jsgrid-header-row>.jsgrid-header-cell {
                background-color:#307ECC ;      /* orange */
                font-family: "Roboto Slab";
                font-size: 1.2em;
                color: white;
                font-weight: normal;
            }
            
            .display-none
            {
                display:none;
            }
       
        </style>              
                
 			 
</head>

        
<body class="no-skin">       

<?php

require_once 'EncabezadoUsuarioView.php';

?>

             
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">
    
<!--<button onclick="empleadosComboboxparaModal()" type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#crea_documento">
    Agregar Documento
</button>    -->
    
<button type="button" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
    <i class="glyphicon glyphicon-repeat"></i>   
</button>

<div class="pull-right">    
    <!--<button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Excel'">
        <img src="../../images/base/_excel.png" width="30px" height="30px">
    </button>-->
    <!--<button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Word'">
        <img src="../../images/base/word.png" width="30px" height="30px"> 
    </button>
    <button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Pdf'">
        <img src="../../images/base/pdf.png" width="30px" height="30px"> 
    </button>    -->
    <button style="width:48px;height:42px" type="button" class="btn_agregar" id='toExcel'>
         <img src="../../images/base/_excel.png" width="35px" height="auto">
    </button>
</div>
    
</div>    

<br><br><br>

<div id="jsGrid"></div>


<!-- Inicio de Seccion Modal Archivos-->
<div class="modal draggable fade" id="create-itemUrls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">
                        
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="font-size:inherit" aria-hidden="true" class="closeLetra">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Archivos Adjuntos</h4>
		      </div>

		      <div class="modal-body">
                        <div id="DocumentolistadoUrl"></div>

                        
                        <div class="form-group">
                                <div id="DocumentolistadoUrlModal"></div>
			</div>
                        
                        <!--No lleva el botton de agregar archivo porque en esta vista no se debe cargar archivos, solo mostrar-->

                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->

       

<script>
    
DataGrid = [];
dataListado = [];
EmpleadosCombobox=[];
filtros=[];
ultimoNumeroGrid=0;
DataGridExcel=[];
origenDeDatosVista="Seguimiento";


listarEmpleados();
listarDatos();
inicializarFiltros();
construirGrid();
construirFiltros();

</script>



            <!--Inicia para el spiner cargando-->
            <script src="../../js/loaderanimation.js" type="text/javascript"></script>
            <!--Termina para el spiner cargando-->
           
            <!--Bootstrap-->
            <script src="../../assets/probando/js/bootstrap.min.js" type="text/javascript"></script>
            <!--Para abrir alertas de aviso, success,warning, error-->       
            <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>
            
            <!--Para abrir alertas del encabezado-->
            <script src="../../assets/probando/js/ace-elements.min.js"></script>
            <script src="../../assets/probando/js/ace.min.js"></script>
            
            <script  src="../../assets/FileUpload/js/tmpl.min.js"></script>
            <script  src="../../assets/FileUpload/js/load-image.all.min.js"></script>
            <script  src="../../assets/FileUpload/js/canvas-to-blob.min.js"></script>
            <script  src="../../assets/FileUpload/js/jquery.blueimp-gallery.min.js"></script>
            <script  src="../../assets/FileUpload/js/jquery.iframe-transport.js"></script>
            <script  src="../../assets/FileUpload/js/jquery.fileupload.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-process.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-image.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-audio.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-video.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-validate.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-ui.js"></script>
            <script src="../../assets/FileUpload/js/jquery.fileupload-jquery-ui.js"></script>
            <script src="../../assets/FileUpload/js/main.js"></script>
            <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
            <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
            <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
            <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">
          
                
	</body>
     
</html>


