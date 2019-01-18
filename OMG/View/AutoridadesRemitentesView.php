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
                <script src="../../js/fAutoridadesRemitentesView.js" type="text/javascript"></script>
                <script src="../../js/fGridComponent.js" type="text/javascript"></script>    
                
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
            .modal-body{color:#888;max-height: calc(100vh - 110px);overflow-y: auto;}                    
            .modal-lg{width: 100%;}
            .modal {/*En caso de que quieras modificar el modal*/z-index: 1050 !important;}
            body{overflow:hidden;}
        </style>              
                
 			 
</head>

        
<body class="no-skin">

       

<?php

require_once 'EncabezadoUsuarioView.php';

?>

             
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;"> 

    <button type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#crea_autoridad">
        Agregar Autoridad
    </button>

    <button type="button" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i>   
    </button>
    
</div>

<br><br><br>

<div id="jsGrid"></div>

<!-- Inicio de Seccion Modal -->
<div class="modal draggable fade" id="crea_autoridad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
            <h4 class="modal-title" id="myModalLabel">Crear Nueva Autoridad Remitente</h4>
          </div>

          <div id="validacion_empleado" class="modal-body">
                    <!--<form data-toggle="validator" action="api/create.php" method="POST">-->
                        <!--<form data-toggle="validator"  >-->
                        <div id="ok"></div>
                            <div class="form-group">
                                            <label class="control-label" for="title">Clave Autoridad Remitente:</label>
                                            <input type="text"  id="CLAVE_AUTORIDAD" class="form-control" data-error="Ingrese Autoridad" required />
                                            <div id="mensaje1" class="help-block with-errors" ></div>
                                    </div>

                                    <div class="form-group">
                                            <label class="control-label" for="title">Descripcion:</label>
                                            <textarea  id="DESCRIPCION" class="form-control" data-error="Ingrese Descripcion" required></textarea>
                                            <div id="mensaje2"class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                            <label class="control-label" for="title">Direccion:</label>
                                            <textarea  id="DIRECCION" class="form-control" data-error="Ingrese Direccion" required></textarea>
                                            <div id="mensaje3" class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                            <label class="control-label" for="title">Telefono:</label>
                                            <textarea  id="TELEFONO" class="form-control" data-error="Ingrese Telefono" required></textarea>
                                            <div id="mensaje4" class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                            <label class="control-label" for="title">Extension:</label>
                                            <textarea  id="EXTENSION" class="form-control" data-error="Ingrese Extension" required></textarea>
                                            <div id="mensaje5"class="help-block with-errors"></div>
                                    </div>
                        
                                    <div class="form-group">
                                            <label class="control-label" for="title">Email:</label>
                                            <textarea  id="EMAIL" class="form-control" data-error="Ingrese Email" required></textarea>
                                            <div id="mensaje6"class="help-block with-errors"></div>
                                    </div>
                        
                                    <div class="form-group">
                                            <label class="control-label" for="title">Direccion Web:</label>
                                            <textarea  id="DIRECCION_WEB" class="form-control" data-error="Ingrese Direccion Web" required></textarea>
                                            <div id="mensaje7"class="help-block with-errors"></div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" style="width:49%" id="btn_guardar"  class="btn crud-submit btn-info botones_vista_tabla">Guardar</button>
                                        <button type="submit" style="width:49%" id="btn_limpiar"  class="btn crud-submit btn-info botones_vista_tabla">Limpiar</button>
                                    </div>

                    <!--</form>-->

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

var customsFieldsGridData=[
    {field:"customControl",my_field:MyCControlField},
//        {field:"porcentaje",my_field:porcentajesFields},
//    {field:"comboEmpleados",my_field:MyComboEmpleados},
];

estructuraGrid= [
    { name: "id_principal",visible:false},
    { name:"no",title:"No",width:50,editing: false},
    { name: "clave_autoridad",title:"Clave de la Autoridad", type: "textarea", validate: "required", width:120},
    { name: "descripcion",title:"Descripción", type: "textarea", validate: "required" },
    { name: "direccion",title:"Dirección", type: "textarea", validate: "required" },
    { name: "telefono",title:"Teléfono", type: "textarea", validate: "required" },
    { name: "extension",title:"Extensión", type: "textarea", validate: "required" },
    { name: "email",title:"Email", type: "textarea", validate: "required" },
    { name: "direccion_web",title:"Dirección Web", type: "textarea"},
    { name:"delete", title:"Opción", type:"customControl",sorting:"", width:100}
],
        
construirGrid();

inicializarFiltros().then((resolve)=>
{
    construirFiltros();
    listarDatos();
},(error)=>
{
    growlError("Error!","Error al construir la vista, recargue la página");
});


</script>
    
    <!--Bootstrap-->
    <script src="../../assets/probando/js/bootstrap.min.js" type="text/javascript"></script>
    <!--Para abrir alertas del encabezado-->
    <script src="../../assets/probando/js/ace-elements.min.js"></script>
    <script src="../../assets/probando/js/ace.min.js"></script>
            
    </body>
     
</html>




