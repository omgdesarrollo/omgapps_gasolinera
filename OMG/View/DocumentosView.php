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
                <script src="../../js/fDocumentosView.js" type="text/javascript"></script>
                <script src="../../js/fGridComponent.js" type="text/javascript"></script>
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
    
    <button onclick="listarEmpleados()" type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#crea_documento">
        Agregar Documento
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


<!-- Inicio de Seccion Modal Nuevo Documento-->
<div class="modal draggable fade" id="crea_documento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
                <h4 class="modal-title" id="myModalLabel">Crear Nuevo Documento</h4>
              </div>

              <div class="modal-body">



                                        <div class="form-group">
                                                <label class="control-label" for="title">Clave del Documento:</label>
                                                <textarea  id="CLAVE_DOCUMENTO" class="form-control" data-error="Ingrese la Clave del Documento" required></textarea>
                                                <div class="help-block with-errors"></div>
                                                <div id="msgerrorclave" ></div>
                                        </div>

                                        <div class="form-group">

                                                <label class="control-label" for="title">Documento:</label>
                                                <textarea  id="DOCUMENTO" class="form-control " data-error="Ingrese el Documento" required></textarea>
                                                <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label" for="title">Responsable del Documento:</label>
                                            <select id="ID_EMPLEADOMODAL" class="select2">
                                            </select>
                                            <div class="help-block with-errors"></div>
                                        </div>


                                        <div class="form-group">
                                            <button type="submit" style="width:49%" id="btn_guardar"  class="btn crud-submit btn-info botones_vista_tabla">Guardar</button>
                                            <button type="submit" style="width:49%" id="btn_limpiar"  class="btn crud-submit btn-info botones_vista_tabla">Limpiar</button>
                                        </div>


              </div>
            </div>

          </div>
        </div>
<!--Final de Seccion Modal-->
       

<script>
    
var DataGrid = [];
var dataListado = [];
//var EmpleadosCombobox=[];
//var thisEmpleados=[]; 
var filtros=[];
var db={};
var gridInstance;
var ultimoNumeroGrid=0;
var thisEmpleados=[];
var DataGridExcel=[];
var origenDeDatosVista="documentos";

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

estructuraGrid =  [
    { name: "id_principal",visible:false},
    { name:"no",title:"No",width:50},
    { name: "clave_documento",title:"Clave del Documento",type: "textarea", validate: "required" },
    { name: "documento",title:"Documento",type: "textarea", validate: "required" },
    { name: "id_empleado", title: "Responsable del Documento", type: "comboEmpleados", width:150},
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
          
                
	</body>
     
</html>


