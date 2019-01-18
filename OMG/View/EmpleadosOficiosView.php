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
                <!--JQUERY-->
                <script src="../../js/jquery.js" type="text/javascript"></script>
                <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
                <!--JGROWL-->
                <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
                <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>                
                <script src="../../js/fEmpleadosOficiosView.js" type="text/javascript"></script>
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

    <button type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#crea_empleado">
        Agregar Personal
    </button>

    <button type="button" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i>   
    </button>
    
    <div class="pull-right">    
        <button style="width:48px;height:42px" type="button"  class="btn_agregar" id="toExcel">
            <img src="../../images/base/_excel.png" width="30px" height="30px">
        </button>
    </div>    
</div>

<br><br><br>

<div id="jsGrid"></div>

<!-- Inicio de Seccion Modal -->
<div class="modal draggable fade" id="crea_empleado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Nuevo Personal</h4>
            </div>

            <div id="validacion_empleado" class="modal-body">
                <div id="ok"></div>
                    <div class="form-group">
                        <label class="control-label" for="title">Nombre:</label>
                        <input type="text"  id="NOMBRE_EMPLEADO" class="form-control" data-error="Ingrese Nombre" required />
                        <div id="mensaje1" class="help-block with-errors" ></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">Apellido Paterno:</label>
                        <textarea  id="APELLIDO_PATERNO" class="form-control" data-error="Ingrese Apellido Paterno." required></textarea>
                        <div id="mensaje2"class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">Apellido Materno:</label>
                        <textarea  id="APELLIDO_MATERNO" class="form-control" data-error="Ingrese Apellido Materno." required></textarea>
                        <div id="mensaje3" class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">Puesto:</label>
                        <textarea  id="CATEGORIA" class="form-control" data-error="Ingrese Categoria." required></textarea>
                        <div id="mensaje4" class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">Email:</label>
                        <textarea  id="CORREO" class="form-control" data-error="Ingrese Email" required></textarea>
                        <div id="mensaje5"class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <button type="submit" style="width:49%" id="btn_crearEmpleado" disabled class="btn crud-submit btn-info botones_vista_tabla">Guardar</button>
                        <button type="submit" style="width:49%" id="btn_limpiarEmpleado"  class="btn crud-submit btn-info botones_vista_tabla">Limpiar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Final de Seccion Modal-->

<script>
var DataGrid = [];
var dataListado=[];
var filtros=[];
var db={};
var gridInstance;
var ultimoNumeroGrid=0;
var DataGridExcel=[];
var origenDeDatosVista="empleados";


var customsFieldsGridData=[
         {field:"customControl",my_field:MyCControlField},
//        {field:"porcentaje",my_field:porcentajesFields},
];

 
estructuraGrid = [
    { name: "id_principal",visible:false},
    { name:"no",title:"No",width:50},
    { name: "nombre_empleado",title:"Nombre", type: "textarea", width: 150, validate: "required" },
    { name: "apellido_paterno",title:"Apellido Paterno", type: "textarea", width: 150, validate: "required" },
    { name: "apellido_materno",title:"Apellido Materno", type: "textarea", width: 150, validate: "required" },
    { name: "categoria",title:"Categoría", type: "textarea", width: 150, validate: "required" },
    { name: "correo",title:"Correo Electrónico", type: "textarea", width: 150, validate: "required" },
    { name: "fecha_creacion",title:"Fecha Creación", type: "text", width: 150, validate: "required",editing: false},
//    {name:"cancel", type:"control"}
    { name: "delete", title: "Opción", type: "customControl", width:100}
],

construirGrid();

promesaInicializarFiltros = inicializarFiltros();

promesaInicializarFiltros.then((resolve2)=>
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
    <!--<script src="../../js/loaderanimation.js" type="text/javascript"></script>-->
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




