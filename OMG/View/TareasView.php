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
                <script src="../../assets/canvas/jcanvas.min.js" type="text/javascript"></script>

                <!--Para abrir alertas de aviso, success,warning, error--> 
                <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
                <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
                <!--jgrowl-->
                <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
                <!--Libreria local, para grafica-->
                <script src="../../assets/chart/loader.js" type="text/javascript"></script>
                <!--Libreria web, para grafica-->
                <!--<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>-->
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
                <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>
                <script src="../../js/fChartComponent.js" type="text/javascript"></script>
                <script src="../../js/fTareasView.js" type="text/javascript"></script>
                <script src="../../js/fGridComponent.js" type="text/javascript"></script>
                <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
                <script src="../../js/fechas_formato.js" type="text/javascript"></script>
    

                
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
            .modal-lg{width: 60%;}
            .modal {/*En caso de que quieras modificar el modal*/z-index: 1050 !important;}
            body{overflow:hidden;}
            
            /*semaforo*/
            .semaforoYellow {
              background: #e1e100;
              border-radius: 0.8em;
              -moz-border-radius: 0.8em;
              -webkit-border-radius: 0.8em;
              color: #FFFF00;
              display: inline-block;
              font-weight: bold;
              line-height: 2.5em;
              /*margin-right: 15px;*/
              text-align: center;
              width: 2.5em; 
              height: 2.5em;
            }

            .semaforoOrange {
              background: #FFA500;
              border-radius: 0.8em;
              -moz-border-radius: 0.8em;
              -webkit-border-radius: 0.8em;
              color: #FFA500;
              display: inline-block;
              font-weight: bold;
              line-height: 2.5em;
              /*margin-right: 15px;*/
              text-align: center;
              width: 2.5em; 
              height: 2.5em;
            }/*

*/          .semaforoBlue {
              background: #5178D0;
              border-radius: 0.8em;
              -moz-border-radius: 0.8em;
              -webkit-border-radius: 0.8em;
              color: #5178D0;
              display: inline-block;
              font-weight: bold;
              line-height: 2.5em;
              /*margin-right: 15px;*/
              text-align: center;
              width: 2.5em; 
              height: 2.5em;
            }
            
            /*

*/          .semaforoGreen {
              background: #5EA226;
              border-radius: 0.8em;
              -moz-border-radius: 0.8em;
              -webkit-border-radius: 0.8em;
              color: #5EA226;
              display: inline-block;
              font-weight: bold;
              line-height: 2.5em;
              /*margin-right: 15px;*/
              text-align: center;
              width: 2.5em; 
              height: 2.5em;
            }

            .semaforoRed {
              background: red;
               border-radius: 0.8em;
              -moz-border-radius: 0.8em;
              -webkit-border-radius: 0.8em;
              color: red;
              display: inline-block;
              font-weight: bold;
              line-height: 2.5em;
              /*margin-right: 15px;*/
              text-align: center;
              width: 2.5em;
              height: 2.5em;
            }
            
        </style>              
                
 			 
</head>

        
<body class="no-skin">     

<?php

require_once 'EncabezadoUsuarioView.php';

?>

<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">             

    <button onClick="archivoyComboboxparaModal();" type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#crea_tarea">
        Agregar
    </button>

    <button type="button" id="btnAgregarDocumentoEntradaRefrescar" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
        <i class="glyphicon glyphicon-repeat"></i>   
    </button>

    <div class="pull-right">        
        <!-- <label class="btn btn-info btn_checkbox" style="display: none"> -->
        <!--<label class="btn btn-info btn_checkbox">-->
            <!-- <input style="margin: 6px 0 0;" type="checkbox" name="" id="checkTerminados" autocomplete="off"> Terminados -->
        <!-- </label> -->
                
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

<!-- Inicio de Seccion Modal Crear Tarea -->
<div class="modal draggable fade" id="crea_tarea" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
                <h4 class="modal-title" id="myModalLabel">Crear Nuevo Tema</h4>
            </div>

            <div id="validacion_empleado" class="modal-body">
<!--                    <div class="form-group">
                        <label class="control-label" for="title">Referencia:</label>
                        <input type="text"  id="REFERENCIA" class="form-control" data-error="Ingrese el Contrato" required />
                        <div id="mensaje1" class="help-block with-errors" ></div>
                    </div>-->

                    <div class="form-group">
                        <label class="control-label" for="title"> Tema:</label>
                        <textarea  id="TAREA" class="form-control" data-error="Ingrese la Tarea" required></textarea>
                        <div id="mensaje2"class="help-block with-errors"></div>
                        <div id="msgerrorTarea" ></div>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label" for="title">Responsable:</label>
                        <select id="ID_EMPLEADOMODAL" class="select2">
                        </select>
                        <div class="help-block with-errors"></div>
                    </div>
                
<!--                    <div class="form-group">
                        <label class="control-label" for="title">Fecha de Creacion:</label>
                        <input type="date" id="FECHA_CREACION" class="form-control" data-error="Ingrese la Fecha de Recepcion" required>
                        <div id="mensaje3" class="help-block with-errors"></div>
                    </div>-->

                    <div class="form-group">
                        <label class="control-label" for="title">Fecha de Alarma:</label>                         
                        <input type="date" id="FECHA_ALARMA" class="form-control" data-error="Ingrese la Fecha de Alarma" required>
                        <div id="mensaje4" class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label" for="title">Fecha de Cumplimiento:</label>
                        <input type="date" id="FECHA_CUMPLIMIENTO" class="form-control" data-error="Ingrese la Fecha de Cumplimiento" required></textarea>
                        <div id="mensaje5"class="help-block with-errors"></div>
                    </div>
                
                    <div class="form-group">
                            <label class="control-label" for="title">Status:</label>
                            <select id="STATUS_TAREA">
                            <option value="1">En proceso</option>
                            <option value="2">Suspendido</option>
                            <option value="3">Terminado</option>
                            </select>
                    </div>
                
                    <div class="form-group">
                        <label class="control-label" for="title"> Observaciones:</label>
                        <textarea  id="OBSERVACIONES" class="form-control" data-error="Ingrese una observacion" required></textarea>
                        <div id="mensaje6"class="help-block with-errors"></div>
                    </div>
                
                    <!--<div id="DocumentoEntradaAgregarModal"></div>-->

                    <div class="form-group">
                        <button style="width:49%;" type="submit" id="btn_crearTarea" class="btn crud-submit btn-info botones_vista_tabla">Guardar</button>
                        <button style="width:49%;" type="submit" id="btn_limpiarModalTarea"  class="btn crud-submit btn-info botones_vista_tabla">Limpiar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Final de Seccion Modal Crear Tarea-->

<!-- Inicio de Seccion Modal Archivos-->
<div class="modal draggable fade" id="create-itemUrls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content">
                        
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="font-size:inherit" aria-hidden="true" class="closeLetra">X</span></button>
		        <h4 class="modal-title" id="myModalLabel">Archivos Adjuntos</h4>
		      </div>

		      <div class="modal-body">
                        <div id="DocumentolistadoUrl"></div>

                        
                        <div class="form-group">
                                <div id="DocumentolistadoUrlModal"></div>
			</div>

                        <div class="form-group" method="post" >
                            <button type="submit" id="subirArchivos"  class="btn crud-submit btn-info botones_vista_tabla" style="width: 100%;">Adjuntar Archivo</button>
                        </div>
                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->


<!-- Modal grafica -->
<div id="jsChart"></div>

<script>

// var canvasRed = document.getElementsByClassName("semaforoRed");
// var ctxRed = canvasRed.getContext("2d");
// console.log(ctxRed);

var DataGrid = [];
var dataListado = [];
var thisEmpleados=[];
var filtros=[];
var db={};
var gridInstance;
var ultimoNumeroGrid=0;
var DataGridExcel=[];
var origenDeDatosVista="tareas";

var activeChart = -1;
var chartsCreados = [];
var chartsFunciones = [()=>{graficar()},(dataNextGrafica,concepto)=>{graficar2(dataNextGrafica,concepto)},(dataNextGrafica,concepto)=>{graficar3(dataNextGrafica,concepto)}];

var opcionSeleccionadaComboBoxEstatus = 0;

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
        {
            
        },
        editValue: function()
        {
                if( this._inputDate[1] == undefined )
                        return $(this._inputDate[0]).val();
                else
                        return this._inputDate[1];
        }
});

var MyComboStatus = function(config)
{
    jsGrid.Field.call(this, config);
};

MyComboStatus.prototype = new jsGrid.Field
({
        align: "center",
        sorter: function(date1, date2)
        {
            
        },
        itemTemplate: function(value,todo)
        {
                fechaAlarma= todo.fecha_al.split("-");
                fechaAlarma= new Date(fechaAlarma[0],fechaAlarma[1]-1,fechaAlarma[2],0,0);
                fechaCumplimiento=  todo.fecha_cump.split("-");
                fechaCumplimiento= new Date(fechaCumplimiento[0],fechaCumplimiento[1]-1,fechaCumplimiento[2],0,0);
                hoy= new Date();
                hoy= new Date(hoy.getFullYear(), hoy.getMonth(), hoy.getDate(), 0, 0);
                
                var res ="";
                if(value==1)
                {
                    if(fechaCumplimiento <= hoy)
                    {
                        res= "VENC";                        
                    }else{
                        if(fechaAlarma <= hoy)
                        {
                            res= "ALAR";
                        }else{
                            res= "EPRO";
                        }
                    }
                }
                
                if(value==2)
                {
                    res= "SUSP";
                }
                
                if(value==3)
                {
                    res= "TERM"
                }
                return res;

        },
        insertTemplate: function(value)
        {
            
        },
        editTemplate: function(value,todo)
        {
               console.log(todo);
            //    console.log("value en editTemplate: ",value );
            //     console.log(this._MyComboStatus);
                var temp = "";
                if(value==1)
                {
                    temp += todo.status_grafica=="Alarma vencida"? "<option value='1' selected>ALAR</option>" : "<option value='1' selected>VENC</option>"; ;
                    temp += "<option value='2'>SUSP</option>";
                    temp += "<option value='3'>TERM</option>";
                }

                if(value==2)
                {
                    temp += "<option value='2' selected>SUSP</option>";
                    temp += "<option value='1'>EPRO</option>";
                    temp += "<option value='3'>TERM</option>";
                }
                
                if(value==3)
                {
                    temp += "<option value='3' selected>TERM</option>";
                    temp += "<option value='1'>EPRO</option>";
                    temp += "<option value='2'>SUSP</option>";
                }                
                
                this._inputStatus = $("<select>").attr({style:"margin:-5px;width:145px"});
                $(this._inputStatus[0]).append(temp);

                return this._inputStatus[0];
                
        },
        insertValue: function()
        {
            
        },
        editValue: function()
        {
            
                if( this._inputStatus[1] == undefined )
                        return $(this._inputStatus[0]).val();
                else
                        return this._inputStatus[1];
        }
});

var MySemaforoField = function(config)
{
    jsGrid.Field.call(this, config);
};
 
MySemaforoField.prototype = new jsGrid.Field
({
        align: "center",
        sorter: function(date1, date2)
        {},
        itemTemplate: function(value,todo)
        {
            let res ="";
            // console.log(value);
            // console.log(todo.status_grafica);
            if(value==1 && todo.status_grafica=="En tiempo")
                res = "<canvas title='En Proceso' class='semaforoGreen'>.</canvas>";
            if(value==1 && todo.status_grafica=="Alarma vencida")
                res = "<canvas title='Alarma Vencida' class='semaforoOrange'>.</canvas>";
            if(value==1 && todo.status_grafica=="Tiempo vencido")
                res = "<canvas title='Tiempo Vencido' class='semaforoRed'>.</canvas>";
            if(value==2)
                res = "<canvas title='Suspendido' class='semaforoYellow'>.</canvas>";
            if(value==3)
                res = "<canvas title='Terminado' class='semaforoBlue'>.</canvas>";
            return res;
        },
        insertTemplate: function(value)
        {
            gridInstance["customFunctionAuto"] = {fnCanvas:drawCanvasAll};
        },
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

var MyDateField = function(config)
{
    jsGrid.Field.call(this, config);
};
 
MyDateField.prototype = new jsGrid.Field
({
        css: "date-field",
        align: "center",
        sorter: function(date1, date2)
        {
                console.log("haber cuando entra aqui");
                console.log(date1);
                console.log(date2);
        },
        itemTemplate: function(value)
        {
            console.log(value);
                return getSinFechaFormato(value);
                // fecha="0000-00-00";
                // // console.log(this);
                // this[this.name] = value;
                // // console.log(data);
                // if(value!=fecha)
                // {
                //         date = new Date(value);
                //         fecha = date.getDate()+1 +" "+ months[date.getMonth()] +" "+ date.getFullYear().toString().slice(2,4);
                //         return fecha;
                // }
                // else
                //         return "Sin fecha";
        },
        insertTemplate: function(value)
        {},
        editTemplate: function(value)
        {
                // console.log(this);
                fecha="0000-00-00";
                if(value!=fecha)
                {
                        fecha=value;
                }
                return this._inputDate = $("<input>").attr({type:"date",value:fecha,style:"margin:-5px;width:145px"});
        },
        insertValue: function()
        {},
        editValue: function(val)
        {
                value = this._inputDate[0].value;
                if(value=="")
                        return "0000-00-00";
                else
                        return $(this._inputDate).val();
        }
});
 
 var customsFieldsGridData=[
    {field:"customControl",my_field:MyCControlField},
    {field:"comboEmpleados",my_field:MyComboEmpleados},
    {field:"comboStatus",my_field:MyComboStatus},
    {field:"date",my_field:MyDateField},
    // {field:"fieldSemaforo",my_field:MySemaforoField}
    
];
 
estructuraGrid= [
    { name: "id_principal",visible:false},
    { name: "fecha_al",visible:false},
    { name: "fecha_cump",visible:false},
//    { name:"no",title:"No",width:50},
//    { name: "referencia",title:"Referencia", type: "textarea",width:200},
    { name: "tarea",title:"Tema", type: "textarea", validate: "required",width:200 },
    { name: "id_empleado", title: "Responsable", type: "comboEmpleados", width:250},
//    { name: "fecha_creacion",title:"Fecha de Creación", type: "text", validate: "required", width:150,editing: false},
    { name: "fecha_alarma",title:"Fecha de Alarma", type: "date", validate: "required", width:160},
    { name: "fecha_cumplimiento",title:"Fecha de Cumplimiento", type: "text", validate: "required", width:190,editing: false},    
    { name: "status_tarea", title:"Estatus", type: "comboStatus", width:120},
//    { name: "status_tarea", title:"Estatus", type: "select", width:150,valueField:"status_tarea",textField:"descripcion",
//        items:[{"status_tarea":"1","descripcion":"En Proceso"},{"status_tarea":"2","descripcion":"Suspendido"},{"status_tarea":"3","descripcion":"Terminado"}]
//    },
    { name: "semaforo",title:"ID", type: "text", validate: "required", width:80,editing: false},
    { name: "observaciones",title:"Observaciones", type: "textarea", width:150,},
    { name: "archivo_adjunto",title:"Archivo Adjunto", type: "text", validate: "required",width:150,editing:false },
    { name: "registrar_programa",title:"Programa", type: "text", validate: "required",width:160, editing:false },
    { name: "avance_programa",title:"Avance", type: "text", validate: "required",width:150, editing:false },      
    { name:"delete", title:"Opción", type:"customControl",sorting:"", width:100}
], 
 
construirGrid();
inicializaChartjs();

inicializarFiltros().then((resolve)=>
{
    gridInstance["customFunctionAuto"] = {fnCanvas:drawCanvasAll};
    construirFiltros();
    listarThisEmpleados();
    listarDatos("");
},
(error)=>
{
    growlError("Error!","Error al construir la vista, recargue la página");
});

</script>



<!-- INICIA SECCION PARA CARGAR ARCHIVOS--> 
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
{% var t = $('#fileupload').fileupload('active'); var i,file; %}
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
        {% if(t == 1){ if( $('#tempInputIdDocumento').length > 0 ) { var ID_TAREA = $('#tempInputIdDocumento').val(); mostrar_urls(ID_TAREA);refresh();}else{ $('#btnAgregarDocumentoEntradaRefrescar').click(); } } %}
</script>
<!-- FINALIZA SECCION PARA CARGAR ARCHIVOS-->

    
    <!--Bootstrap-->
    <script src="../../assets/probando/js/bootstrap.min.js" type="text/javascript"></script>
    
    <!--Para abrir alertas del encabezado-->
    <script src="../../assets/probando/js/ace-elements.min.js"></script>
    <script src="../../assets/probando/js/ace.min.js"></script>
    
    <!-- js cargar archivo -->
    <script src="../../assets/FileUpload/js/tmpl.min.js"></script>
    <script src="../../assets/FileUpload/js/load-image.all.min.js"></script>
    <script src="../../assets/FileUpload/js/canvas-to-blob.min.js"></script>
    <script src="../../assets/FileUpload/js/jquery.blueimp-gallery.min.js"></script>
    <script src="../../assets/FileUpload/js/jquery.iframe-transport.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-process.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-image.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-audio.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-video.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-validate.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-ui.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-jquery-ui.js"></script>

    <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
    <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">
            
	</body>
     
</html>




