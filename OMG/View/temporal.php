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
 		 <!--Bootstrap y fontawesome-->
                <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css"/>
                <script src="../../js/jquery.js" type="text/javascript"></script>
                <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
                <link async href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
                <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
                <!--<link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" />-->
                <link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
                <script src="../../js/fechas_formato.js" type="text/javascript"></script>
                <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
                <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/>
                
                
                <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script>
                <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
                <script src="../../js/fGridComponent.js" type="text/javascript"></script>
    
</head>

        
        <body class="no-skin" >
             <div id="loader"></div>
<?php
require_once 'EncabezadoUsuarioView.php';
?>

   


<div style="height: 40px"></div>
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">
    <!-- <div style="position: fixed;"> -->
        <button onClick="limpiarNuevaEvidenciaModal()" type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#nuevaEvidenciaModal">
            Agregar Nuevo Registro
        </button>

        <button id="btnAgregarEvidenciasRefrescar" type="button" class="btn btn-info btn_refrescar" onclick="refresh();" >
            <i class="glyphicon glyphicon-repeat"></i> 
        </button>
</div>

<div style="height: 80px"></div>
<div id="jsGrid"></div>
               
<!-- Inicio moda -->
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


      <div class="modal draggable fade" id="modalgraficas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog modal-lg" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
		        <h4 class="modal-title" id="myModalLabel">Personalizacion Graficas </h4>
		      </div>
		      <div class="modal-body">

                          <div id="jsGridGrafico"></div>
		      </div>
                        
		    </div>

		  </div>
       </div>

                
<script>
//    dataListado = [];
//    listarDatos();
//    listarDatosGrafica();  
    
    var DataGrid=[];
    var dataListado=[];
    var filtros=[];
    var db={};
    var gridInstance;
    
    var fechaFields = function(config)
    {
        jsGrid.Field.call(this, config);
    };
    
    fechaFields.prototype = new jsGrid.Field
    ({
        css: "date-field",
        align: "center",
        sorter: function(date1, date2)
        {
            console.log("haber cuando entra aqui");
            console.log(date1);
            console.log(date2);
            // return 1;
        },
        itemTemplate: function(value,todo)
        {
            if(typeof(value)=="number")
                return value+" %";
            else
                return "X"
        },
        insertTemplate: function(value)
        {
        },
        editTemplate: function(value)
        {
            if(typeof(value)=="number")
                return value+" %";
            else
                return "X"
        },
        insertValue: function()
        {
        },
        editValue: function()
        {
        }
    });
     var customsFieldsGridData=[
            {field:"customControl",my_field:fechaFields},
            // {field:"porcentaje",my_field:porcentajesFields},
     ];
     var estructuraGrid=[
        { name: "No", type: "text", width: 80, validate: "required" },
        { name: "Clave del Documento", type: "text", width: 200, validate: "required" },
        { name: "Nombre del Documento", type: "text", width: 250, validate: "required" },
        { name: "Responsable del Documento", type: "text", width: 250, validate: "required" },
        { name: "Tema", type: "text", width: 150, validate: "required" },
        { name: "Requisitos", type: "text", width: 150, validate: "required" },
        { name: "Registros", type: "text", width: 150, validate: "required" },
        { name: "Status", type: "text", width: 150, validate: "required" }
];


function inicializarFiltros()
{
    return new Promise((resolve,reject)=>
    {
        filtros = [
            { id:"noneUno", type:"none"},
            { id: "tema",name:"Tema", type: "text"},
            { id: "registro",name:"Registro", type: "text"},
            { id: "frecuencia",name:"Frecuencia", type: "combobox",data:frecuenciaData,descripcion:"frecuencia"},
            { id: "clave_documento",name:"Clave Documento", type: "text"},
            { id: "fecha_creacion",name:"Fecha Creación", type: "date"},
            // { id: "adjuntar_evidencia",name:"Adjuntar Evidencia", type: "text"},
            { id:"noneDos", type:"none"},
            { id: "fecha_registro",name:"Fecha Registro", type: "date"},
            { id: "usuario",name:"Usuario", type: "text"},
            { id:"noneTres", type:"none"},
            { id:"noneCuatro", type:"none"},
            { id:"noneCinco", type:"none"},
            { id:"noneSeis", type:"none"},       
            {name:"opcion",id:"opcion",type:"opcion"}
        ];
        resolve();
    });
}
     
     
     
     
    construirGrid();
    
    
    
    
</script>

            
            <!--<script src="../../js/fReporteValidacionDocumentosView.js" type="text/javascript"></script>-->
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


