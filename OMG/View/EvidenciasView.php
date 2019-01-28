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
    <!-- <link async href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/> -->
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
<!--     
    <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/> -->

    <!-- <script src="../../js/fechas_formato.js" type="text/javascript"></script> -->
    <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
    <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
    <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
    <!-- <script src="../../js/tools.js" type="text/javascript"></script> marca un error al agregarse -->
    <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>

    <script src="../../js/fEvidenciasView.js" type="text/javascript"></script>
    <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
    <script src="../../js/fGridComponent.js" type="text/javascript"></script>
    <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
   
    <style>
        /* .jsgrid-header-row>.jsgrid-header-cell
        { */
                /* background-color:#307ECC ;      orange */
                /* font-family: "Roboto Slab";
                font-size: 1.2em;
                color: white;
                font-weight: normal; */
        /* } */
            /* .modal-body{color:#888;max-height: calc(100vh - 110px);overflow-y: auto;}                    
            .modal-lg{width: 100%;}
            .modal {/*En caso de que quieras modificar el modal*/
                /* z-index: 1050 !important;} */
            /* body{overflow:hidden;} */
       
        
        .hideScrollBar{
        width: 100%;
        height: 100%;
        overflow: auto;
        margin-right: 14px;
        padding-right: 28px; /*This would hide the scroll bar of the right. To be sure we hide the scrollbar on every browser, increase this value*/
        padding-bottom: 15px; /*This would hide the scroll bar of the bottom if there is one*/
        }
        
        .validar_formulario{
            background: blue; 
            width: 120px; 
            color: white; 
        }

        @media screen and (min-width:876px)
        {
            span.fa-arrows-h
            {
                display:none;
            }
        }

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
    <!-- <div style="position: fixed;"> -->
    <!-- <button onClick="limpiarNuevaEvidenciaModal()" type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#nuevaEvidenciaModal">
        Agregar Nuevo Registro
    </button> -->

    <button id="btnAgregarEvidenciasRefrescar" type="button" class="btn btn-info btn_refrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i> 
    </button>
    
<!--    <div class="pull-right">    
        <button style="width:48px;height:42px" type="button"  class="btn_agregar" id="toExcel">
            <img src="../../images/base/_excel.png" width="30px" height="30px">
        </button>
    </div>-->
    
</div>

    <br><br><br>
    <div id="jsGrid"></div>

</body>


<!-- Inicio de Seccion Modal Crear nueva Evidencia-->
<div class="modal draggable fade" id="nuevaEvidenciaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="closeLetra">X</span>
                </button>
		        <h4 class="modal-title" id="myModalLabelNuevaEvidencia">Crear Nueva Evidencia</h4>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label class="control-label">Temas: </label>
                    <div class="dropdown">
                        <input style="width:100%" type="text" class="dropdown-toggle" id="NOMBRETEMA_NUEVAEVIDENCIA" data-toggle="dropdown" onkeyup="buscarTemas(this)" autocomplete="off"/>
                            <ul style="width:100%;cursor:pointer;" class="dropdown-menu" id="dropdownEventTemasEvidencia" role="menu" 
                            aria-labelledby="NOMBRETEMA_NUEVAEVIDENCIA">
                            <!-- <li role='presentation'><a role='menuitem' tabindex='-1'>jose</a></li>
                            <li role='presentation'><a role='menuitem' tabindex='-1'>jesus</a></li> -->
                            </ul>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label">Registro: </label>
                    <div class="dropdown">
                        <input style="width:100%" type="text" class="" id="NOMBREREGISTRO_NUEVAEVIDENCIA" data-toggle="dropdown" onkeyup="buscarRegistros(this)" autocomplete="off"/>
                            <ul style="width:100%;cursor:pointer;" class="dropdown-menu" id="dropdownEventRegistroEvidencia" role="menu" 
                            aria-labelledby="NOMBREREGISTRO_NUEVAEVIDENCIA">
                            <!-- <li role='presentation'><a role='menuitem' tabindex='-1'>JAJA</a></li>
                            <li role='presentation'><a role='menuitem' tabindex='-1'>JIJI</a></li> -->
                            </ul>
                    </div>
                </div>

                <!-- <div class="form-group"> -->
                    <!-- <label class="control-label">Fecha de la evidencia: </label> -->
                    <!-- <div class="dropdown"> -->
                        <!-- <input type="date" id="FECHA_NUEVAEVIDENCIAMODAL" /> -->
                    <!-- </div> -->
                    <!-- <input type="date" id="FECHA_ALARMA" class="form-control" data-error="Ingrese la Fecha de Alarma" required/> -->
                <!-- </div> -->

                <div class="form-group">
                    <strong>Frecuencia: </strong><label id="FRECUENCIA_NUEVAEVIDENCIAMODAL" class="control-label" for="title"></label>
                </div>
                <div class="form-group">
                    <strong>Documento: </strong><label id="DOCUMENTO_NUEVAEVIDENCIAMODAL" class="control-label" for="title"></label>
                </div>
                <div class="form-group">
                    <strong>Responsable del Documento: </strong><label id="NOMBRE_NUEVAEVIDENCIAMODAL" class="control-label" for="title"></label>
                </div>
                <div class="form-group">
                    <input id="ID_NUEVAEVIDENCIAMODAL" type="text" value="" style="display: none"/>
                    <input id="IDTEMA_NUEVAEVIDENCIAMODAL" type="text" value="" style="display: none"/>
                    <input id="IDREGISTRO_NUEVAEVIDENCIAMODAL" type="text" value="" style="display: none"/>
                </div>
                
                <div class="form-group" style="text-align:center" method="post">
                    <button style="width:100%" type="submit" id="BTN_CREAR_NUEVAEVIDENCIAMODAL" class="btn crud-submit btn-info botones_vista_tabla">Crear Evidencia</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Final de Seccion Modal-->

<!-- Inicio modal Registros -->
<div class="modal draggable fade" id="mostrarRegistrosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <!-- <div id="loaderModalMostrar"></div> -->
		<div class="modal-content">                
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabelMostrarRegistros">Lista Registros</h4>
        </div>

        <div class="modal-body">
            <div id="RegistrosListado"></div>
        </div> 
      </div> 
    </div> 
</div> 
<!--cierre del modal Registros-->

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
                    <button type="submit" id="subirArchivos"  class="btn crud-submit btn-info botones_vista_tabla" style="width:100%">Adjuntar Archivo</button>
                </div>
            </div><!-- cierre div class-body -->
        </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->

<!-- Inicio modal Mensaje -->
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
                    <label class="control-label" for="title">Mensaje:</label>
                    <textarea id="textAreaNotificacionModal" class="form-control" ></textarea>
                </div>
                <div class="form-group" method="post" id="BTNENVIAR_MANDARNOTIFICACIONMODAL"></div>
            </div>
        </div>
    </div>
</div>

<div class="modal draggable fade" id="evidenciasPrueba" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
        <!-- <div id="loaderModalMostrar"></div> -->
		<div class="modal-content">                
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabelMostrarRegistros">Lista Registros</h4>
        </div>

        <div class="modal-body">
            <div id="listadatosGrid"></div>
        </div> 
      </div> 
    </div> 
</div> 

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
                <!-- <div class="row" style="border:2px solid #3399cc;padding:5px 15px 5px 15px;background:tan">
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="background:red;padding:5px 10px 5px 10px;border-radius:25px 10px 10px 25px;float:left;background:#ffffff">
                        <img src="../../images/base/user.png" class="img-circle" style="height:35px;float:left">
                        <span>Humberto Tahuada Jimenez Gomez</span>
                    </div>
                    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" style="background:red;padding:5px 10px 5px 10px;border-radius:10px 25px 25px 10px;float:right;background:lightgreen">
                        <img src="../../images/base/user.png" class="img-circle" style="height:35px;float:right"></img>
                        <span>Humberto Tahuada Jimenez Gomez</span>
                    </div>
                </div> -->
            </div>
            <div class="row" style="border:2px solid #3399cc;height:300px;padding-top:5px;background:#c0c0c0b0;overflow-y:auto">
                <div id="mensajes_notificaciones" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <!-- <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="text-align:left;float:left">
                        <div style="background:#ffffff;padding:5px 10px 5px 10px;border-radius:3px 15px 15px 3px;float:left">
                            <span>AAAAAAAAA</span>
                            <br>
                            <span class="fecha_message" style="font-size:10px">24-AGO-2018 15:32:23</span>
                        </div>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="text-align:right;float:right">
                        <div style="background:lightgreen;padding:5px 10px 5px 10px;border-radius:15px 3px 3px 15px;float:right">
                            <span class="body_message" style="color:black">BBBBBBBBB</span>
                            <br>
                            <span class="fecha_message" style="font-size:10px">24-AGO-2018 15:32:23</span>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- </div> -->
            <!-- estilos en vista validacion documentos view php -->
            <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10" style="padding:0px">
                    <textarea id="mensajeTexto_notificaciones" class="area-observaciones" placeholder="Escribe tu mensaje" style="border:2px solid #3399cc;width:100%;background:#c0c0c0b0;color:black;resize:none"></textarea>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2" style="padding:0px">
                    <button onClick="enviarMensajes()" class="btn-observaciones" style="background:#3399cc;border:2px solid #3399cc;font-size:xx-large;width:100%;height:56px;margin-bottom:1px"><i class="fa fa-paper-plane" style="color:#ffffff;border-radius:100%"></i></button>
                </div>
            </div>
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

<div class="modal draggable fade" id="agregarExtAnterior" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document" style="text-align:-webkit-center">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content" style="max-width:640px;">
        <div class="modal-header" style="border-bottom:0px">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Existencia Anterior</h4>
        </div>
        <div class="modal-body" style="padding:0px 15px 0px 15px">
            <!-- <div class="row"> -->
                <!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding:0px"> -->
                    <div class="form-group">
                        <br>
                        <label class="control-label" for="title">Exist. Anterior:</label>
                        <input id="btn_extAnterior_modalAgregarExtAnterior" type="text" autocomplete="off"></input>
                        <!-- <textarea id="" class="form-control" ></textarea> -->
                    </div>

                    <div class="form-group" style="text-align:center" method="post">
                        <button type="submit" onClick="enviarExtAnterior()" class="btn crud-submit btn-info botones_vista_tabla">
                        OK</button>
                    </div>
                <!-- </div> -->
            <!-- </div> -->

        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

<div class="modal draggable fade" id="realizarCorte" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document" style="">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content" style="max-width:640px;">
        <div class="modal-header" style="border-bottom:0px">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Corte</h4>
        </div>
        <div class="modal-body" style="padding:0px 15px 0px 15px">
                    <br>
                    <div class="form-group">
                        <label class="control-label" for="title">Fecha Corte:</label>
                        <input id="input_fechaCorte_ModalRealizarCorte" type="date" autocomplete="off" 
                        style="width:100%;border:0px solid;border-bottom: 1px solid #3399cc;"
                        max="<?php $fecha = date('Y-m-j');
                            $nuevafecha = strtotime ( '+1 day' , strtotime ( $fecha ) ) ;
                            $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                            echo $nuevafecha ?>"></input>
                        <!-- <textarea id="" class="form-control" ></textarea> -->
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="title">Cantidad Comprada(Litros):</label>
                        <input id="input_cantidadComprada_ModalRealizarCorte" type="text" autocomplete="off" 
                        style="width:100%;border:0px solid;border-bottom: 1px solid #3399cc;"></input>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="title">Cantidad Vendida(Litros):</label>
                        <input id="input_cantidadVendida_ModalRealizarCorte" type="text" autocomplete="off" 
                        style="width:100%;border:0px solid;border-bottom: 1px solid #3399cc;"></input>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label" for="title">Ext. Actual:</label>
                        <input id="input_extActual_ModalRealizarCorte" type="text" autocomplete="off" 
                        style="width:100%;border:0px solid;border-bottom: 1px solid #3399cc;"></input>
                    </div> -->
                    <div class="form-group">
                        <form id='fileupload' method='POST' enctype='form-data'>
                        <div class='fileupload-buttonbar'>
                            <div class='fileupload-buttons'>
                                <span class='fileinput-button'>
                                    <span id='spanAgregarDocumento'><a >Agregar Archivos(Click o Arrastrar)...</a></span>
                                    <input type='file' name='files[]' multiple></span>
                                <span class='fileupload-process'></span>
                            </div>
                                <div class='fileupload-progress'>
                                    <div class='progress' role='progressbar' aria-valuemin='0' aria-valuemax='100'></div>
                                    <div class='progress-extended'>&nbsp;</div>
                                </div>
                        </div>
                        <table role='presentation'><tbody class='files'></tbody></table>
                        </form>
                    </div>

                    <div class="form-group" style="text-align:center" method="post">
                        <button type="submit" onClick="realizarCorte()" class="btn crud-submit btn-info botones_vista_tabla">
                        OK</button>
                    </div>
                <!-- </div> -->
            <!-- </div> -->

        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

<!--cierre del modal Mensaje-->
<script>
    // $("#input_fechaCorte_ModalRealizarCorte").attr("max",new Date());
    // construirFiltros();
    // construir();
    var DataGrid=[];
    var dataListado=[];
    var filtros=[];
    var db={};
    var gridInstance;
    var ws;
    var thisjGrowl;
    var DataGridExcel=[];
    var origenDeDatosVista="evidencias";

    var frecuenciaData = [
                {frecuencia:"ANUAL"},
                {frecuencia:"BIMESTRAL"},
                {frecuencia:"DIARIO"},
                {frecuencia:"INDEFINIDO"},
                {frecuencia:"MENSUAL"},
                {frecuencia:"POR EVENTO"},
                {frecuencia:"SEMANAL"},
            ];

    var estructuraGrid = [
        { name: "id_principal", type: "text",visible:false },
        { name: "validador", type: "text",visible:false },
        { name: "no", title:"No",type: "text", width: 50, editing:false },
        { name: "nombre",title:"Estación Servicio", type: "text", width: 140, editing:false },
        { name: "registro",title:"Producto", type: "text", width: 135, editing:false  },
        { name: "fecha_logica",title:"Fecha Actualización", type: "text", width: 160, editing:false },
        { name: "nombre_empleado", title:"Usuario", type: "text", width:220, editing:false },
        { name: "ext_anterior", title:"Exist. Anterior (Litros)", type: "text", width: 120, editing:false },
        { name: "cantidad_comprada",title:"Cant. Comprada (Litros)", type: "text", width: 120, editing:false},
        { name: "cantidad_vendida",title:"Cant. Vendida (Litros)", type: "text", width: 120, editing:false },
        { name: "ext_actual",title:"Exist. Actual (Litros)", type: "text", width: 120, editing:false},
        { name: "corte",title:"Realizar Corte", type: "text", width: 90, editing:false},
    ];

    var customsFieldsGridData=[
            // {field:"customControl",my_field:MyCControlField},
            // {field:"porcentaje",my_field:porcentajesFields},
        ];

    ultimoNumeroGrid=0;
    construirGrid();
    
    inicializarFiltros().then((resolve2)=>
    {
        construirFiltros();
        listarDatos();
    });

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
            {% if (!i && !o.options.autoUpload) { %}
                    <button class="start" style="display:none;padding: 0px 4px 0px 4px;" disabled>Start</button>
            {% } %}
            {% if (!i) { %}
                    <button class="cancel" style="padding: 0px 4px 0px 4px;color:white">Cancel</button>
            {% } %}
            </td>
        </tr>
    {% } %}
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
    {% if(t == 1){ %}
    {% $("#realizarCorte .close").click(); listarDatos(); %}
    {% } %}
</script>
<!-- {% if( $('#tempInputIdEvidenciaDocumento').length > 0 ) { %}
    {% var ID_EVIDENCIA_DOCUMENTO = $('#tempInputIdEvidenciaDocumento').val(); %}
    {% var ID_PARA_DOCUMENTO = $('#tempInputIdParaDocumento').val(); %}
    {% mostrar_urls(ID_EVIDENCIA_DOCUMENTO,'1',false,ID_PARA_DOCUMENTO); %}
    {% growlSuccess("Subir Archivo","Archivo Cargado");%}
    {% actualizarEvidencia(ID_EVIDENCIA_DOCUMENTO,1); } %} -->

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
    <!-- <script src="../../assets/FileUpload/js/main.js"></script> -->
</body>
</html>



