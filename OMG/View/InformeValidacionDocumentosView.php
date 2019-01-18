<?php
    session_start();
    require_once '../util/Session.php';
    
    $Usuario=  Session::getSesion("user");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title></title>
    
    <!--Bootstrap y fontawesome-->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css"/>
    
    <script src="../../js/jquery.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>

    <link async href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    
    <!-- text fonts -->
	<!--<link rel="stylesheet" href=".../../assets/probando/css/fonts.googleapis.com.css" />-->
    <!-- ace styles -->
    <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <!--<link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" />-->
    <link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
    
    <!--Inicia para el spiner cargando-->
    <link async href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
    <!--Termina para el spiner cargando-->
                  
    <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
    <link async href="../../css/modal.css" rel="stylesheet" type="text/css"/>
<!--    <link href="../../css/tabla.css" rel="stylesheet" type="text/css"/>-->

    <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
    <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
    <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">
    

    <!--jquery-->
    
    <!-- <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script> -->

    <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
    <!-- <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script> -->
    
    <!-- <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/> -->
    <script src="../../assets/chart/loader.js" type="text/javascript"></script>

    <script src="../../js/fechas_formato.js" type="text/javascript"></script>
    <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
    <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
    <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
    <!-- <script src="../../js/tools.js" type="text/javascript"></script> marca un error al agregarse -->
    <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>

    <script src="../../js/fChartComponent.js" type="text/javascript"></script>
    <script src="../../js/fInformeValidacionDocumentosView.js" type="text/javascript"></script>
    <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
    <script src="../../js/fGridComponent.js" type="text/javascript"></script>
    <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
   
    <style>
        .jsgrid-header-row>.jsgrid-header-cell
        {
                background-color:#307ECC ;      /* orange */
                font-family: "Roboto Slab";
                font-size: 1.2em;
                color: white;
                font-weight: normal;
        }
            /* .modal-body{color:#888;max-height: calc(100vh - 110px);overflow-y: auto;}                     */
            /* .modal-lg{width: 100%;} */
            .modal {/*En caso de que quieras modificar el modal*/z-index: 1050 !important;}
            body{overflow:hidden;}

        </style>
</head>
<!-- <body> -->
<body class="no-skin" >
    <!--<div id="loader"></div>-->
    
<?php
    require_once 'EncabezadoUsuarioView.php';
    if(isset($_REQUEST["accion"]))
        $accion = $_REQUEST["accion"];
    else
        $accion = -1;

    // $titulosTable = 
        // array("No.","Requisito","Registro","Frecuencia","Clave Documento",
        //     "Adjuntar Evidencia","Fecha de Registro","Usuario","Acción Correctiva","Plan de Acción","Desviación","Validación","Opcion");
?>
    
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">
    <button id="btnAgregarEvidenciasRefrescar" type="button" class="btn btn-info btn_refrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i> 
    </button>

    <div class="pull-right">    
        <button onClick="graficar()" title="Graficar Circular" type="button" class="btn btn-success style-filter" data-toggle="modal" data-target="#Grafica">
            <i class="fa fa-pie-chart"></i>
        </button>
        
        <button style="width:48px;height:42px" type="button"  class="btn_agregar" id="toExcel">
            <img src="../../images/base/_excel.png" width="30px" height="30px">
        </button>
    </div>
</div>

    <br><br><br>
    <div id="jsGrid"></div>

</body>


<!-- Inicio modal listar tema y responsable -->
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




<!-- Inicio de Seccion Modal Archivos-->
<div class="modal draggable fade" id="create-itemUrls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog " role="document">
        <!-- <div id="loaderModalMostrar"></div> -->
		<div class="modal-content">
                        
                    
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
            <h4 class="modal-title" id="myModalLabelItermUrls">Archivos Adjuntos</h4>
            </div>

            <div class="modal-body">
                <div id="DocumentolistadoUrl"></div>

                    
                <div class="form-group">
                    <div id="DocumentolistadoUrlModal"></div>
                </div>

                <div class="form-group" method="post" >
                    <button type="submit" id="subirArchivos"  class="btn crud-submit btn-info">Adjuntar Archivo</button>
                </div>
            </div><!-- cierre div class-body -->
        </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->

<!--cierre del modal Mensaje-->

<!-- Modal grafica -->
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
<script>
    // construirFiltros();
    // construir();
    

    var DataGrid=[];
    var dataListado=[];
    var filtros=[];
    var db={};
    var gridInstance;
    var dataEmpleados=[];
    var DataGridExcel=[];
    var origenDeDatosVista="informeValidacionDocumentos";
    var ultimoNumeroGrid=0;

    var activeChart = -1;
    var chartsCreados = [];
    var chartsFunciones = [()=>{graficar()},(dataNextGrafica,concepto)=>{graficar2(dataNextGrafica,concepto)},
    (dataNextGrafica,concepto)=>{graficar3(dataNextGrafica,concepto)}];

    var estructuraGrid=[
        { name: "no",title:"No", type: "text", width: 50, editing:false },
        { name: "clave_documento", title:"Clave del documento",type: "text", width: 180, editing:false },
        { name: "documento", title:"Nombre del Documento", type: "text", width: 200, editing:false},
        { name: "nombrecompleto", title:"Responsable",type: "text", width: 180, editing:false },
        { name: "temasmodal", title:"Tema",type: "text", width: 90, editing:false},
        { name: "requisitosmodal",  title:"Requisito",type: "text", width: 90, editing:false },
        { name: "archivoAdjunto",title:"Archivo Adjunto", width: 100, editing:false },
        { name: "estatus",title:"Estatus", type: "text", width: 120, editing:false },
        // { name:"delete", title:"Opción", type:"customControl",sorting:"",editing:false}
];

    var customsFieldsGridData=[
            // {field:"customControl",my_field:MyCControlField},
            // {field:"porcentaje",my_field:porcentajesFields},
        ];

    construirGrid();
    inicializaChartjs();
    inicializarFiltros().then((resolve)=>
    {
        construirFiltros();
        listarDatos();
    })
    
    

</script>

<script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload" style="width:100%">
            <td>
            <span class="preview"></span>
            </td>
            <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error"></strong>
            </td>
            <td>
            <p class="size">Processing...</p>
            <!-- <div class="progress"></div> -->
            </td>
            <td>
            {% if (!i && !o.options.autoUpload) { if(noArchivo==0){ %}
                    <button class="start" style="display:none;padding: 0px 4px 0px 4px;" disabled>Start</button>
            {% } } %}
            {% if (!i) { %}
                    <button class="cancel" style="padding: 0px 4px 0px 4px;color:white">Cancel</button>
            {% } %}
            </td>
        </tr>
        {% if(i==0){ $('.fileupload-buttonbar').html(""); } %}
    {% noArchivo=1; } %}
</script>

<script id="template-download" type="text/x-tmpl">
    {% var t = $('#fileupload').fileupload('active'); var i,file;%}
    {% for (i=0,file; file=o.files[i]; i++) { %}
        <tr class="template-download">
            <td>
            <span class="preview">
                    {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                    {% } %}
            </span>
            </td>
            <td>
            <p class="name">
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
            </p>
            </td>
            <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
            </td>
            <!-- <td> -->
            <!-- <button class="delete" style="padding: 0px 4px 0px 4px;" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button> -->
            <!-- <input type="checkbox" name="delete" value="1" class="toggle"> -->
            <!-- </td> -->
        </tr>
    {% } %}
    {% if(t == 1){ if( $('#tempInputIdEvidenciaDocumento').length > 0 ) { var ID_VALIDACION_DOCUMENTO = $('#tempInputIdEvidenciaDocumento').val();var ID_PARA_DOCUMENTO = $('#tempInputIdParaDocumento').val(); mostrar_urls(ID_VALIDACION_DOCUMENTO,'1',false,ID_PARA_DOCUMENTO); growlSuccess("Subir Archivo","Archivo Cargado"); actualizarEvidencia(ID_VALIDACION_DOCUMENTO); noArchivo=0; } } %}
</script>

    <!--Inicia para el spiner cargando-->
    <script src="../../js/loaderanimation.js" type="text/javascript"></script>
    <!--Termina para el spiner cargando-->
    
    <!--Bootstrap-->
    <script src="../../assets/probando/js/bootstrap.min.js"></script>
    <!--Para abrir alertas de aviso, success,warning, error-->
    <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>

    <!--Para abrir alertas del encabezado-->
    <script src="../../assets/probando/js/ace-elements.min.js"></script>
    <script src="../../assets/probando/js/ace.min.js"></script>

    <!-- js cargar archivo -->
<!--    <script src="../../assets/FileUpload/js/jquery.min.js"></script>
    <script src="../../assets/FileUpload/js/jquery-ui.min.js"></script>-->
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
</body>
</html>



