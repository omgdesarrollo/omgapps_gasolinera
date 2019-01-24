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
        <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>

        <script src="../../js/jquery.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>

		<link async href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>

        <script src="../../assets/chart/loader.js" type="text/javascript"></script>
        
        
        
        <!-- ace styles -->
		<link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!-- <link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" /> -->
		<link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
                
                <!--Inicia para el spiner cargando-->
        <!-- <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/> -->
                <!--Termina para el spiner cargando-->
                
        <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>

        <!-- <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script> -->

        <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
        <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>

        <script src="../../js/fechas_formato.js" type="text/javascript"></script>
        <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
        <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
        <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
        <!-- <script src="../../js/tools.js" type="text/javascript"></script> marca un error al agregarse -->
        <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>

        <script src="../../js/fInformeEvidenciasView.js?v=1" type="text/javascript"></script>
        <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
        <script src="../../js/fGridComponent.js" type="text/javascript"></script>
        <script src="../../js/fChartComponent.js" type="text/javascript"></script>
        <!-- <link href="../../css/estilosToolTip.css" rel="stylesheet" type="text/css"/> -->
        <!-- <script src="../../js/toolsToolTip.js" type="text/javascript"></script> -->
        <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
        
        <style>
            .jsgrid-header-row>.jsgrid-header-cell {
                background-color:#307ECC ;      /* orange */
                font-family: "Roboto Slab";
                font-size: 1.2em;
                color: white;
                font-weight: normal;
            }
            .modal-body{color:#888;max-height: calc(100vh - 110px);overflow-y: auto;}                    
            .modal-lg{width: 100%;}
            .modal {/*En caso de que quieras modificar el modal*/z-index: 1050 !important;}
            body{overflow:hidden;}

            .jsgrid-cell
            {
                word-wrap: break-word;
            }


        </style>              
                
 			 
</head>

        
    <body class="no-skin">
       

<?php
    // require_once 'EncabezadoUsuarioView.php';
?>

             
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">    
    <button type="button" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i>   
    </button>
    
    <div class="pull-right">
        <button onClick="graficarPrincipal()" title="Graficar Circular" type="button" class="btn btn-success style-filter" data-toggle="modal" data-target="#Grafica">
            <i class="fa fa-pie-chart"></i>
        </button>

        <button style="width:48px;height:42px" type="button"  class="btn_agregar" id="toExcel">
            <img src="../../images/base/_excel.png" width="30px" height="30px">
        </button>
    </div>
    
</div>
<br><br><br>
    <div id="jsGrid"></div>
               
<!-- Inicio modal Tema y Responsable -->
<div class="modal draggable fade" id="mostrar-temaresponsable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">                
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Lista Tema y Responsable</h4>
        </div>

        <div class="modal-body">
          
            <div id="TemayResponsableListado"></div>
  
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

               
<!-- Inicio modal Requisitos -->
<div class="modal draggable fade" id="mostrar-requisitos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">                
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Lista Requisitos</h4>
        </div>

        <div class="modal-body">
          
            <div id="RequisitosListado"></div>
  
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal Requisitos-->



<!-- Inicio modal Registros -->
<div class="modal draggable fade" id="mostrar-registros" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">                
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Lista Registros</h4>
        </div>

        <div class="modal-body">
          
            <div id="RegistrosListado"></div>
  
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal Requisitos-->

<!-- Inicio modal adjuntar documento -->
<div class="modal draggable fade" id="create-itemUrls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">                
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Archivos Adjuntos</h4>
        </div>

        <div class="modal-body">
          <div id="DocumentolistadoUrl"></div>
  
          <div class="form-group">
                  <div id="DocumentolistadoUrlModal"></div>
          </div>
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->

<div class="modal draggable fade" id="MandarNotificacionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <!-- <div id="loaderModalMostrar"></div> -->
		<div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
                <h4 class="modal-title" id="myModalLabelMandarNotificacion">Enviar Notificación</h4>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label id="areaMensaje" class="control-label" for="title">Mensaje:</label>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal draggable fade" id="Grafica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="closeLetra">X</span>
                </button>
		        <h4 class="modal-title" id="myModalLabelNuevaEvidencia">Indicador de Cumplimiento</h4>
            </div>

            <div class="modal-body">
                <div id="graficaPie" ></div>

                <div class="form-group" method="post" style="text-align:center" id="BTNS_GRAFICAMODAL">
                    <button type="submit" id="BTN_ANTERIOR_GRAFICAMODAL" class="btn crud-submit btn-info" style="width:90%" >Recargar</button>
                </div>
            </div>
            
        </div>
    </div>
</div> -->
<div id="jsChart"></div>
<div class="modal draggable fade" id="mostrar_notificaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document" style="text-align:-webkit-center">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content" style="max-width:640px;">
        <div class="modal-header" style="border-bottom:0px">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Notificaciones</h4>
        </div>
        <div class="modal-body" style="padding:0px 15px 0px 15px">
            <div class="div-observacion-msjs" id="usuarios_notificaciones">
            </div>
            <div class="row" style="border:2px solid #3399cc;height:300px;padding-top:5px;background:#c0c0c0b0;overflow-y:auto">
                <div id="mensajes_notificaciones" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                </div>
            </div>

            <div class="row">
                <!-- <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="padding:0px">
                    <textarea id="mensajeTexto_notificaciones" class="area-observaciones" placeholder="Escribe tu mensaje" style="border:2px solid #3399cc;width:100%;background:#c0c0c0b0;color:black;resize:none"></textarea>
                </div> -->
                <!-- <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2" style="padding:0px">
                    <button onClick="enviarMensajes()" class="btn-observaciones" style="background:#3399cc;border:2px solid #3399cc;font-size:xx-large;width:100%;height:56px;margin-bottom:1px"><i class="fa fa-paper-plane" style="color:#ffffff;border-radius:100%"></i></button>
                </div> -->
            </div>
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

<!-- <div class="modal draggable fade" id="Grafica" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog sizeChart" role="document" style="text-align: -webkit-center;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="closeLetra">X</span>
                </button>
                <h4 class="modal-title" id="myModalLabelNuevaEvidencia">Indicador</h4>
            </div>
            <div class="modal-body">
                <div id="graficaPie" ></div>
            </div>
            <div class="form-group" method="post" style="text-align:center" id="BTNS_GRAFICAMODAL">
                <button type="submit" id="BTN_ANTERIOR_GRAFICAMODAL" class="btn crud-submit btn-info" style="width:90%" >Recargar</button>
            </div>
        </div>
    </div>
</div> -->

<script>

google.charts.load('current', {packages: ['corechart', 'line']});
// google.charts.setOnLoadCallback(drawLineColors);

// $(function(){
//     $("td").mouseenter((event)=>{
//         console.log(event);
//     });
// });

    var DataGrid = [];
    var dataListado = [];
    var filtros = [];
    var db = {};
    var gridInstance;
    var ultimoNumeroGrid = 0;
    var DataGridExcel=[];
    var origenDeDatosVista="informeEvidencias";

    var activeChart = -1;
    var chartsCreados = [];
    // var chartsFunciones = [()=>{graficar()},(dataNextGrafica,concepto)=>{graficar2(dataNextGrafica,concepto)},(dataNextGrafica,concepto)=>{graficar3(dataNextGrafica,concepto)}];
    // var chartsFunciones = [()=>{graficar()},(dataNextGrafica,concepto)=>{graficar2(dataNextGrafica,concepto)},
    // (dataNextGrafica,concepto)=>{graficar3(dataNextGrafica,concepto)}];
                
    var frecuenciaData = [
        {frecuencia:"ANUAL"},
        {frecuencia:"BIMESTRAL"},
        {frecuencia:"DIARIO"},
        {frecuencia:"INDEFINIDO"},
        {frecuencia:"MENSUAL"},
        {frecuencia:"POR EVENTO"},
        {frecuencia:"SEMANAL"},

    ];        
    
    var estatusFiltro = [
        {estatus:"EN PROCESO",des_estatus:"NO CONFORME"},{estatus:"VALIDADO",des_estatus:"CONFORME"}
    ];

    var estructuraGrid = [
        { name: "id_principal", type: "text",visible:false },
        { name: "no", title:"No",type: "text", width: 50, editing:false },
        { name: "nombre",title:"Tema", type: "text", width: 150, editing:false },
        { name: "nombre_empleado", title:"Usuario", type: "text", width:250, editing:false },
        { name: "registro",title:"Registro", type: "text", width: 150, editing:false  },
        { name: "fecha_logica",title:"Fecha Actualización", type: "text", width: 160, editing:false },
        { name: "fecha_fisica",title:"Fecha Corte", type: "text", width: 160, editing:false },
        { name: "ext_anterior", title:"Exist. Anterior", type: "text", width: 100, editing:false },
        { name: "cantidad_comprada",title:"Cant. Comprada", type: "text", width: 150, editing:false},
        { name: "cantidad_vendida",title:"Cant. Vendida", type: "text", width: 110, editing:false },
        { name: "ext_actual",title:"Exist. Actual", type: "text", width: 100, editing:false},
        { name: "adjuntos",title:"Adjuntos", type: "text", width: 100, editing:false},
    ];

    var customsFieldsGridData=[
            // {field:"customControl",my_field:MyCControlField},
            // {field:"porcentaje",my_field:porcentajesFields},
        ];

    construirGrid();
    inicializaChartjs();
    inicializarFiltros().then((resolve2)=>
    {
        construirFiltros();
        listarDatos();
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


