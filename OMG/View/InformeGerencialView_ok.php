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
                
                <!--Libreria local, para grafica-->
                <script src="../../assets/chart/loader.js" type="text/javascript"></script>
                <!--Libreria web, para grafica-->
                <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->

                
                <script src="../../js/jquery.js" type="text/javascript"></script>
                <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
                
                <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <script src="../../js/jqueryblockUI.js" type="text/javascript"></script>
                
<!--                <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
                <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>-->
                
                <!-- <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script> -->
                
                <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
                <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
                <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
                <script src="../../js/tools.js" type="text/javascript"></script>
                <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>
                <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
                <script src="../../js/fInformeGerencialView.js" type="text/javascript"></script>
                <script src="../../js/fGridComponent.js" type="text/javascript"></script>
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
             .jsgrid-row:hover{
                background-color: red;
            }
            /*.jsgrid-selected-row>*/
/*            .jsgrid-cell:hover{
                background-color: #ccccff;
                 cursor: cell;
            }*/
            
            .display-none
            {
                display:none;
            }
            
            .modal-body{color:#888;max-height: calc(100vh - 110px);overflow-y: auto;}                    
            .modal-lg{width: 50%;}
            .modal {/*En caso de que quieras modificar el modal*/z-index: 1050 !important;}
            body{overflow:hidden;}
        </style>              
                
 			 
</head>

        
<body class="no-skin">     

<?php

require_once 'EncabezadoUsuarioView.php';

?>

<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">             

<!--    <button onClick="loadChartView(true);" type="button" id="btn_informe" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#informe_gerencial">
        Informe
    </button>    -->

    <button type="button" id="btnAgregarDocumentoEntradaRefrescar" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i>   
    </button>

    <div class="pull-right">    
    <!--<button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Excel'">
        <img src="../../images/base/_excel.png" width="30px" height="30px">
    </button>
    <button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Word'">
        <img src="../../images/base/word.png" width="30px" height="30px"> 
    </button>
    <button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Pdf'">
        <img src="../../images/base/pdf.png" width="30px" height="30px"> 
    </button>       -->
        <button onClick="loadChartView(true)" title="Informe" type="button" class="btn btn-success style-filter" data-toggle="modal" data-target="#informe_gerencial">
            <i class="fa fa-pie-chart"></i>
        </button>
        <button style="width:48px;height:42px" type="button" class="btn_agregar" id='toExcel'>
            <img src="../../images/base/_excel.png" width="35px" height="auto">
        </button>
    </div>  
</div>

<br><br><br>

<div id="jsGrid"></div>

<!-- Inicio de Seccion Modal Informe-->
<div class="modal draggable fade" id="informe" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">
                        
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="font-size:inherit" aria-hidden="true" class="closeLetra">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Informe Tareas</h4>
		      </div>

		      <div class="modal-body">
                          
                        <div id="graficaTareas"></div>

                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->


<!-- Inicio de Seccion Modal Informe-->
<div class="modal draggable fade" id="informe_gerencial" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">
                        
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="font-size:inherit" aria-hidden="true" class="closeLetra">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Informe Gerencial</h4>
		      </div>

		      <div class="modal-body">
                          
                        <div id="graficaInformeGerencial"></div>

                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->



<script>

var DataGrid = [];
var dataListado = [];
var filtros=[];
var db={};
var gridInstance;
var ultimoNumeroGrid=0;
var DataGridExcel=[];
var origenDeDatosVista="informeGerencial";
var customsFieldsGridData=[
        // {field:"customControl",my_field:MyCControlField},
//        {field:"porcentaje",my_field:porcentajesFields},
];


estructuraGrid = [
//        { name: "id_principal",visible:false},
        { name:"no",title:"No",width:40},
        { name: "folio_entrada",title:"Folio de Entrada", type: "text",width:180,editing:false},
        { name: "clave_autoridad",title:"Autoridad Remitente", type: "text",width:160,editing:false},
        { name: "asunto",title:"Asunto", type: "text",editing:false},
        { name: "nombre_completo",title:"Responsable del Tema", type: "text",width:220,editing:false},
        { name: "fecha_asignacion",title:"Fecha de Asignacion", type: "text",width:180,editing:false},
        { name: "fecha_limite_atencion",title:"Fecha Limite de Atencion", type: "text",width:200,editing:false},
        { name: "fecha_alarma",title:"Fecha de Alarma", type: "text",width:140,editing:false},
        { name: "status_doc",title:"Status", type: "text",editing:false},
        { name: "condicion",title:"Condición", type: "text",width:140,editing:false},
        { title:"Opción", type:"",sorting:""},
        
    ];


construirGrid();

inicializarFiltros().then((resolve2)=>
{
    construirFiltros();
    listarDatos();
},
(error)=>
{
    growlError("Error!","Error al construir la vista, recargue la página");
});

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

            
	</body>
     
</html>




