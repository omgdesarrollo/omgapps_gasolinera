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
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
                <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>
                <script src="../../js/fSeguimientoEntradaView.js" type="text/javascript"></script>
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
    
var DataGrid = [];
var dataListado = [];
var thisEmpleados=[];
var filtros=[];
var db={};
var gridInstance;
var ultimoNumeroGrid=0;
var DataGridExcel=[];
var origenDeDatosVista="Seguimiento";

var MyComboEmpleados = function(config)
{
    jsGrid.Field.call(this, config);
};
 
MyComboEmpleados.prototype = new jsGrid.Field
({
        align: "center",
        sorter: function(date1, date2)
        {
            
        },
        itemTemplate: function(value)
        {
                var res ="";
                value!=null ?
                $.each(thisEmpleados,(index,val)=>{
                        if(val.id_empleado == value)
                                res = val.nombre_completo;
                })
                : console.log();
                return res;
        },
        insertTemplate: function(value)
        {},
        editTemplate: function(value,todo)
        {
                var temp = "";
                
                $.each(thisEmpleados,(index,val)=>
                {
                        if(val.id_empleado == value)
                        {
                            temp += "<option value='"+val.id_empleado+"' selected>"+val.nombre_completo+"</option>";
                        }
                        else
                            temp += "<option value='"+val.id_empleado+"'>"+val.nombre_completo+"</option>";
                })
                this._inputDate = $("<select>").attr({style:"margin:-5px;width:145px"});
                $(this._inputDate[0]).append(temp);

                return this._inputDate[0];
                
        },
        insertValue: function()
        {},
        editValue: function()
        {
                if( this._inputDate[1] == undefined )
                        return $(this._inputDate[0]).val();
                else
                        return this._inputDate[1];
        }
});

var customsFieldsGridData=[
         {field:"customControl",my_field:MyCControlField},
//        {field:"porcentaje",my_field:porcentajesFields},
        {field:"comboEmpleados",my_field:MyComboEmpleados},
];

estructuraGrid=[
    { name: "id_principal",visible:false},
    { name:"no",title:"No",width:50},
    { name: "folio_entrada",title:"Folio de Entrada", type: "text", validate: "required",width:180,editing:false},
    { name: "clave_autoridad",title:"Autoridad Remitente", type: "text", validate: "required",width:180,editing:false},
    { name: "asunto",title:"Asunto", type: "text", validate: "required",width:180,editing:false},
    { name: "id_empleadotema",title:"Responsable del Tema", type: "text", validate: "required",width:250,editing:false},
    { name: "fecha_asignacion",title:"Fecha de Asignacion", type: "text", validate: "required",width:180,editing:false},            
    { name: "fecha_limite_atencion",title:"Fecha Limite de Atencion", type: "text", validate: "required",width:200,editing:false},            
    { name: "fecha_alarma",title:"Fecha de Alarma", type: "text", validate: "required",width:160,editing:false},
    { name: "status_doc",title:"Estatus", type: "text",width:110, validate: "required",editing:false},
    { name: "condicion",title:"Condición", type: "text", validate: "required",width:140,editing:false},
    { name: "id_empleado",title:"Responsable del Plan", type: "comboEmpleados",width:250,},
    { name: "archivo_adjunto",title:"Archivo Adjunto", type: "text", validate: "required",width:140, editing:false },            
    { name: "registrar_programa",title:"Programa", type: "text", validate: "required",width:110, editing:false },
    { name: "avance_programa",title:"Avance del Programa", type: "text", validate: "required",width:170,editing:false },           
    { name:"delete", title:"Opción", type:"customControl",sorting:"", width:100}
],

construirGrid();

inicializarFiltros().then((resolve)=>
{
    construirFiltros();
    listarThisEmpleados()
    listarDatos();
    
},
(error)=>
{
    growlError("Error!","Error al construir la vista, recargue la página");
});


</script>
           
            <!--Bootstrap-->
            <script src="../../assets/probando/js/bootstrap.min.js" type="text/javascript"></script>
            
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


