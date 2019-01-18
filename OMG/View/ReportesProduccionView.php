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
    <!-- ace styles Para Encabezado-->
    <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <!--jquery-->
    <script src="../../js/jquery.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
    <!--Para abrir alertas de aviso, success,warning, error-->
    <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
    <!--jgrowl-->
    <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
    
    <link async href="../../css/modal.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
    <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>
    <script src="../../js/fReportesView.js" type="text/javascript"></script>
    <script src="../../js/fGridComponent.js" type="text/javascript"></script>

    <style>
/*        .dhxcombo_select_img{
            background-image: "../../images/base/loader.gif";
        }*/
            .jsgrid-header-row>.jsgrid-header-cell 
            {
                background-color:#307ECC ;      /* orange */
                font-family: "Roboto Slab";
                font-size: 1.2em;
                color: white;
                font-weight: normal;
            }
            
            div.combo_info
            {
                color: gray;
                font-size: 11px;
                padding-bottom: 5px;
                padding-left: 2px;
                font-family: Tahoma;
            }
            
        .modal-body{color:#888;max-height: calc(100vh - 110px);overflow-y: auto;}                    
        .modal-lg{width: 50%;}
        .modal {z-index: 1050 !important;}En caso de que quieras modificar el modal
        body{overflow:hidden;}
         div#myventana{
                  /*position: relative;*/
                    height:400px; 
                }
        fieldset {padding: 1px;}
		.readonly{ background: #F2F2F2 }
		td { margin: 2px; padding: 2px; }
		.inputhdr{font-weight: bold;padding-left: 5px;}

        </style>

</head>

<body class="no-skin" >
    
<?php
    require_once 'EncabezadoUsuarioView.php';
?>
    

<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;"> 

    <button type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#nuevoReporteModal">
        Agregar Reporte Diario
    </button>

    <button type="button" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i>   
    </button>
    
</div>

<!--    <div class="row"></div>-->
<br><br><br><!--esta linea no deberia ir hacerlo con boostrap-->

<div id="jsGrid"></div>

<!--Modal Crear nueva Evidencia-->
<div class="modal draggable fade" id="nuevoReporteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="closeLetra">X</span>
                </button>
		        <h4 class="modal-title" id="myModalLabelNuevaEvidencia">Crear Nuevo Reporte</h4>
            </div>

            <div class="modal-body">
                <fieldset><legend><b>Seleccionar Datos</b></legend></fieldset>
                
                <div class='form-group'>
                    <label class='control-label'>Fecha: </label>
                    <!--<div id='INPUT_FECHA_NUEVOREGISTRO' style='witdth:100%'></div>-->
                    <input type="date" id="INPUT_FECHA_NUEVOREGISTRO" class="form-control" style='width:22%'>
                </div>
                
                <div class='form-group'>
                    <label class='control-label'>Región Fiscal: </label>
                    <div id='INPUT_REGIONFISCAL_NUEVOREGISTRO' style='witdth:100%'></div>                            
                </div>
                
                <div class="form-group">
                    <label class="control-label">ID de Contrato o Asignación: </label>
                    <div id="INPUT_CONTRATO_NUEVOREGISTRO" style='width:43%'></div>
                </div>
                
                <div class="form-group">
                    <label class="control-label">Ubicacion: </label>
                    <div id="INPUT_UBICACION_NUEVOREGISTRO" style="witdth:100%;"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Tag del Patín: </label>
                    <div id="INPUT_TAGPATIN_NUEVOREGISTRO" style="witdth:100%;"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Tag del Medidor: </label>
                    <div id="INPUT_TAGMEDIDOR_NUEVOREGISTRO" style="witdth:100%;"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Tipo de Medidor: </label>
                    <div id="INPUT_TIPOMEDIDOR_NUEVOREGISTRO" style='width:43%'></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Clasificacion: </label>
                    <div id="INPUT_CLASIFICACION_NUEVOREGISTRO" style='width:43%'></div>
                </div>

                <div class="form-group">
                    <label class="control-label">Tipo de Hidrocarburo: </label>
                    <div id="INPUT_HIDROCARBURO_NUEVOREGISTRO" style='width:43%'></div>
                </div>
                
                <div class="form-group" method="post">
                        <button type="submit" style="width:49%" id="btn_guardar_reportediario" class="btn crud-submit btn-info botones_vista_tabla">Crear Reporte</button>
                        <button type="submit" style="width:49%" id="btn_limpiar"  class="btn crud-submit btn-info botones_vista_tabla">Limpiar</button>

                </div>
                
            </div>
        </div>
    </div>
</div>



<script>
var DataGrid=[];
var dataListado=[];
var filtros=[];
var db={};
var gridInstance;
var ultimoNumeroGrid=0;

var customsFieldsGridData=[
    {field:"customControl",my_field:MyCControlField},
];

estructuraGrid=[
    { name:"id_principal", visible:false},
    { name:"no",title:"No",width:50},
    { name:"clave_contrato", title: "ID del Contrato o Asignación", type: "text", width: 250, validate: "required", "editing": false},
    { name:"region_fiscal", title: "Región Fiscal", type: "text", width: 200, validate: "required", "editing": false},
    { name:"ubicacion", title: "Ubicación del Punto de Medición", type: "text", width: 250, validate: "required", "editing": false},
    { name:"tag_patin", title: "Tag del Patín de Medición", type: "text", width: 250, validate: "required","editing": false },
    { name:"tipo_medidor", title: "Tipo de Medidor", type: "text", width: 200, validate: "required", "editing": false},    
    { name:"tag_medidor", title: "Tag del Medidor", type: "text", width: 130, validate: "required", "editing": false},
    { name:"clasificacion", title: "Clasificación del Sistema de Medición", type: "text", width: 300, validate: "required", "editing": false},
    { name:"hidrocarburo", title: "Tipo de Hidrocarburo", type: "text", width: 250, validate: "required", "editing": false},
    { name:"omgc1", title: "Fecha [dd/mm/aaaa]", type: "text", width: 120, validate: "required", "editing": false},
    { name:"omgc2", title: "Presión [kg/cm2]", type: "textarea", width: 120},
    { name:"omgc3", title: "Temperatura [°C]", type: "textarea", width: 120},
    { name:"omgc4", title: "Producción de Petróleo Medido Neto [bls]", type: "textarea", width: 200},
    { name:"omgc5", title: "°API", type: "textarea", width: 150},
    { name:"omgc6", title: "%S", type: "textarea", width: 150},
    { name:"omgc7", title: "Sal [lb/mbls]", type: "text", width: 100},
    { name:"omgc8", title: "%H20", type: "textarea", width: 180},
    { name:"omgc9", title: "Producción de Condensado Medido Neto", type: "textarea", width: 200},
    { name:"omgc10", title: "°API", type: "textarea", width: 150},
    { name:"omgc11", title: "%S", type: "textarea", width: 150},
    { name:"omgc12", title: "%H20", type: "textarea", width: 180},
    { name:"omgc13", title: "Producción de Gas Medido [mmpc]", type: "textarea", width: 250},
    { name:"omgc14", title: "Poder Calorífico de Gas [btu/pc]", type: "textarea", width: 220},
    { name:"omgc15", title: "Peso Molecular de Gas [lb/mol]", type: "textarea", width: 220},
    { name:"omgc16", title: "Energía de Gas [mmbtu]", type: "textarea", width: 150},
    { name:"omgc17", title: "Eventos", type: "textarea", width: 150},
    { name:"delete", title:"Opción", type:"customControl",sorting:"", width:100}    
],

construirGrid();
buscarRegionesFiscales();    

inicializarFiltros().then((resolve)=>
{
    construirFiltros();
    listarDatos();
},
(error)=>
{
    growlError("Error!","Error al construir la vista, recargue la página");    
});

  
</script>
  
    <!--Bootstrap-->
    <script src="../../assets/probando/js/bootstrap.min.js"></script>

    <!--Para abrir alertas del encabezado-->
    <script src="../../assets/probando/js/ace-elements.min.js"></script>
    <script src="../../assets/probando/js/ace.min.js"></script>
</body>
</html>



