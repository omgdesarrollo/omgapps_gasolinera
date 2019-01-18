<?php
        session_start();
        require_once '../util/Session.php';

$Usuario = Session::getSesion("user"); 
        // $listadoUrls= Session::getSesion("getUrlsArchivos");
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

                <!-- ace styles -->
                <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

                <link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />

                <!-- CHECAR SI FUNCIONA -->
                <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                
                <script src="../../js/jquery.js" type="text/javascript"></script>
                <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>

                <!-- <script src="../../assets/probando/js/bootstrap.min.js"></script> -->
                <script src="../../js/fechas_formato.js" type="text/javascript"></script>

                <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>

                <!-- <link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
                <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/> -->

                <!-- cargar archivo -->
                <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
                <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
                <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
                <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">

                <!-- <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
                <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
                <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script> -->
                <!--LIBRERIA SWEET ALERT 2-->
                <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
                <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
                <!--END LIBRERIA SWEET ALERT 2-->
                <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
                <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
                <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
                <!-- <script src="../../js/tools.js" type="text/javascript"></script> -->
                <!-- <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script> -->

                <!-- <script src="../../js/fCatalogoProduccionView.js" type="text/javascript"></script> -->
                <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
                <script src="../../js/fDocumentoEntradaView.js" type="text/javascript"></script>
                <script src="../../js/fGridComponent.js" type="text/javascript"></script>

            <style>
                .jsgrid-header-row>.jsgrid-header-cell
                {
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
              
                .validar_formulario{
                background: blue; 
                width: 100%; 
                color: white; 
                }
                  
                </style>
 
                    
	</head>

        <body class="no-skin" >
<?php

require_once 'EncabezadoUsuarioView.php';

?>
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">

        <button onClick="DocumentoArchivoAgregarModalF();" type="button" class="btn btn-success btn_agregar" data-toggle="modal" data-target="#create-item">
		Agregar Documento de Entrada
        </button>
    
        <button id="btnAgregarDocumentoEntradaRefrescar" type="button" class="btn btn-info btn_refrescar" onclick="refresh();" >
                <i class="glyphicon glyphicon-repeat"></i> 
        </button>
</div>

<br><br><br>
<!-- <div style="height: 50px"></div> -->

<div id="jsGrid"></div>


<!-- Inicio de Seccion Modal Archivos-->
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

                        <div class="form-group" method="post" >
                            <button type="submit" id="subirArchivos"  class="btn crud-submit btn-info botones_vista_tabla" style="width: 100%;">Adjuntar Archivo</button>
                        </div>
                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->

<!-- Inicio de Seccion Modal Crear nueva Entrada-->
<div class="modal draggable fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
		        <h4 class="modal-title" id="myModalLabel">Crear Nueva Entrada</h4>
		      </div>

		        <div class="modal-body">
                                    
                                <div class="form-group">
                                        <label class="control-label" for="title"><?php echo "Contrato: ".Session::getSesion("s_cont"); ?></label>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarContratoModal" ></div>
                                </div>    
                
                                <div class="form-group">
                                        <label class="control-label" for="title">Referencia:</label>
                                        <input type="text"  id="FOLIO_REFERENCIA" class="form-control" data-error="Ingrese el Folio de referencia" required />
                                        <div class="help-block with-errors"></div>
                                </div>

                                <div class="form-group">
                                        <label class="control-label" for="title">Folio de Entrada:</label>
                                        <textarea  id="FOLIO_ENTRADA" class="form-control" data-error="Ingrese el folio de entrada" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarFolioEntradaModal" ></div>
                                </div>
                        
                                <div class="form-group-">
                                        <label class="control-label" for="title">Fecha Recepcion:</label>
                                        <input type="date" id="FECHA_RECEPCION" class="form-control" 
                                        data-error="Ingrese la Fecha de Recepcion" required/>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarFechaRecepcionModal" ></div>
                                </div>
                        
                                <div class="form-group">
                                        <label class="control-label" for="title">Asunto:</label>
                                        <textarea  id="ASUNTO" class="form-control" data-error="Ingrese el Asunto" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarAsuntoModal" ></div>
                                </div>
                        
                                <div class="form-group">
                                        <label class="control-label" for="title">Remitente:</label>
                                        <textarea  id="REMITENTE" class="form-control" data-error="Ingrese el Remitente" required></textarea>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarRemitenteModal" ></div>
                                </div>
                                
                                <div class="form-group">
                                        <label class="control-label" for="title">Autoridad Remitente:</label>
                                        <select id="ID_AUTORIDADMODAL" class="select">
                                        </select>
                                        <!--<div class="help-block with-errors"></div>-->
                                </div>
                
                                <div class="form-group">
                                        <label class="control-label" for="title">Tema:</label>
                                        
                                        <select   id="ID_TEMAMODAL" class="select">
                                        </select>
                                        
                                </div>
                                        
                                <div class="form-group">
                                        <label class="control-label" for="title">Clasificacion:</label>
                                        <select id="CLASIFICACION">
                                        <option value="1">Con Limite de Tiempo</option>
                                        <option value="2">Sin Limite de Tiempo</option>
                                        <option value="3">Informativo</option>
                                        </select>
                                </div>
                        
                                <div class="form-group">
                                        <label class="control-label" for="title">Status:</label>
                                        <select id="STATUS_DOC" onchange="CambioStatusDocumentoEntrada()">
                                        <option value="1">En proceso</option>
                                        <option value="2">Suspendido</option>
                                        <option value="3">Terminado</option>
                                        </select>
                                </div>
                
                                <div class="form-group-">
                                        <label class="control-label" for="title">Fecha Asignacion:</label>
                                        <input type="date" id="FECHA_ASIGNACION" class="form-control" data-error="Ingrese la Fecha de Asignacion" required/>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarFechaAsignacionModal" ></div>
                                </div>
                                
                                <div class="form-group-">
                                        <label class="control-label" for="title">Fecha Limite de Atencion:</label>
                                        <input type="date" id="FECHA_LIMITE_ATENCION" class="form-control" data-error="Ingrese la Fecha Limite de Atencion" required/>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarFechaLimiteAtencionModal" ></div>
                                </div>

                                <div class="form-group-">
                                        <label class="control-label" for="title">Fecha Alarma:</label>
                                        <input type="date" id="FECHA_ALARMA" class="form-control" data-error="Ingrese la Fecha de Alarma" required/>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarFechaAlarmaModal" ></div>
                                </div>

                                <div class="form-group">
                                        <label class="control-label" for="title">Mensaje para Alarma:</label>
                                        <textarea  id="MENSAJE_ALERTA" class="form-control"></textarea>
                                        <div class="help-block with-errors"></div>
                                        <div id="ValidarMensajeAlarmaModal" ></div>
                                </div>

                                <div id="DocumentoEntradaAgregarModal"></div>

                                
                                <div class="form-group">
                                        <label class="control-label" for="title">Observaciones:</label>
                                        <textarea  id="OBSERVACIONES" class="form-control" data-error="Ingrese las observaciones" required></textarea>
                                        <div class="help-block with-errors"></div>
                                </div>
                                <div class="form-group" method="post" style="text-align:center">
                                        <button style="width:49%" type="submit" id="btn_guardar"  class="btn crud-submit btn-info botones_vista_tabla">Guardar</button>
                                        <button style="width:49%" type="submit" id="btn_limpiar"  class="btn crud-submit btn-info botones_vista_tabla">Limpiar</button>
                                </div>
		      </div>
		    </div>

		  </div>
		</div>
       <!--Final de Seccion Modal--> 
             
<script>

var DataGrid=[];
var dataListado=[];
var filtros=[];
var db={};
var gridInstance;

var id_documento_entrada;
var cualmodificar;
var dataListado;
var thisTemas=[];
var thisAutoridad=[];
$("#create-item").draggable();
$("#create-itemUrls").draggable();

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

var MyComboAutoridad = function(config)
{
    jsGrid.Field.call(this, config);
};
 
MyComboAutoridad.prototype = new jsGrid.Field
({
        align: "center",
        sorter: function(date1, date2)
        {
                // console.log("haber cuando entra aqui");
                // console.log(date1);
                // console.log(date2);
        },
        itemTemplate: function(value)
        {
                var res = "";
                value != "" ?
                $.each(thisAutoridad,(index,val)=>{
                        if(val.id_autoridad == value)
                                res = val.clave_autoridad;
                })
                : res = "SIN SELECCIÓN";
                return res;
        },
        insertTemplate: function(value)
        {},
        editTemplate: function(value,todo)
        {
                var temp = "";
                var temp2 = "";
                var temp3 = "";
                $.each(thisAutoridad,(index,val)=>
                {
                        if(val.id_autoridad == value)
                        {
                                temp += "<option value='"+val.id_autoridad+"' selected>"+val.clave_autoridad+"</option>";
                                temp2 = val.clave_autoridad;
                                temp3 = val.id_autoridad;
                        }
                        else
                                temp += "<option value='"+val.id_autoridad+"'>"+val.clave_autoridad+"</option>";
                })
                this._inputDate = $("<select>").attr({style:"margin:-5px;width:145px"});
                $(this._inputDate[0]).append(temp);

                if(todo.id_documento_entrada!=-1)
                {
                        this._inputDate[0] = temp2;
                        this._inputDate[1] = temp3;
                }
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

var MyComboTemas= function(config)
{
    jsGrid.Field.call(this, config);
};
 
MyComboTemas.prototype = new jsGrid.Field
({
        align: "center",
        sorter: function(date1, date2)
        {
                // console.log("haber cuando entra aqui");
                // console.log(date1);
                // console.log(date2);
        },
        itemTemplate: function(value)
        {
                var res = "";
                value != "" ?
                $.each(thisTemas,(index,val)=>{
                        if(val.id_tema == value)
                                res = val.no;
                })
                : res = "SIN SELECCIÓN";
                return res;
        },
        insertTemplate: function(value)
        {},
        editTemplate: function(value,todo)
        {
                var temp = "";
                var temp2 = "";
                var temp3 = "";
                $.each(thisTemas,(index,val)=>
                {
                        if(val.id_tema == value)
                        {
                                temp += "<option value='"+val.id_tema+"' selected>"+val.no+"</option>";
                                temp2 = val.no;
                                temp3 = val.id_tema;
                        }
                        else
                                temp += "<option value='"+val.id_tema+"'>"+val.no+"</option>";
                })
                this._inputDate = $("<select>").attr({style:"margin:-5px;width:145px"});
                $(this._inputDate[0]).append(temp);

                if(todo.id_documento_entrada!=-1)
                {
                        this._inputDate[0] = temp2;
                        this._inputDate[1] = temp3;
                }
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
        {field:"date",my_field:MyDateField},
        {field:"comboAutoridad",my_field:MyComboAutoridad},
        {field:"comboTemas",my_field:MyComboTemas},
];

// function inicializarEstructuraGrid()
// {
//         return new Promise((resolve,reject)=>{
                estructuraGrid = [
                        { name: "id_principal", visible:false },
                        { name: "folio_referencia", title: "Referencia", type: "text", width:150},
                        { name: "folio_entrada", title: "Folio Entrada", type: "text", width:150},
                        // { name: "fecha_recepcion", title: "Fecha Recepción", type: "text", width, validate: "required" },
                        { name: "fecha_recepcion", title: "Fecha Recepción", type: "date", width:160},

                        { name: "asunto", title: "Asunto", type: "text", width:140},
                        { name: "remitente", title: "Remitente", type: "text", width:150},

                        // { name: "id_autoridad", title: "Autoridad Remitente", type: "select",width:110,
                        //         items:thisAutoridad,
                        //         valueField:"id_autoridad",
                        //         textField:"clave_autoridad"
                        //         },
                        { name: "id_autoridad", title: "Autoridad Remitente", type: "comboAutoridad",width:110},

                        // { name: "id_tema", title: "Numero Tema", type: "select",width:110,
                        //         items:thisTemas,
                        //         valueField:"id_tema",
                        //         textField:"no"},
                        { name: "id_tema", title: "Numero Tema", type: "comboTemas", width:110},

                        { name: "nombre", title: "Nombre Tema", type: "text", width:140, editing:false },
                        { name: "nombre_empleado", title: "Responsable Tema", type: "text", width:140, editing:false },

                        { name: "clasificacion", title: "Clasificación", type: "select", width:140,valueField:"clasificacion",textField:"descripcion",
                                items:[{"clasificacion":"1","descripcion":"Con limite de tiempo"},{"clasificacion":"2","descripcion":"Sin limite de tiempo"},{"clasificacion":"3","descripcion":"Informativo"}]
                        },

                        { name: "status_doc", title:"Estatus", type: "select", width:130,valueField:"status_doc",textField:"descripcion",
                                items:[{"status_doc":"1","descripcion":"PROCESO"},{"status_doc":"2","descripcion":"SUSPENDIDO"},{"status_doc":"3","descripcion":"TERMINADO"}]
                        },

                        { name: "fecha_asignacion", title: "Fecha Asignación", type: "date", width:160},
                        { name: "fecha_limite_atencion", title: "Fecha Limite Atención", type: "date", width:190},
                        { name: "fecha_alarma", title: "Fecha Alarma", type: "date", width:160},
                        { name: "adjuntar_archivo", title: "Adjuntar Archivos", type: "text", width:100, validate: "required", editing:false},
                        { name: "observaciones", title: "Observaciones", type: "text", width:150},
                        { name:"delete", title:"Opción", type:"customControl",sorting:""},
                        // {type:"control",editButton: true}
                ];
                // resolve();
        // });
// }

ultimoNumeroGrid=0;
construirGrid();
async function inicioDocumentoEntrada()
{
        $("#btnAgregarDocumentoEntradaRefrescar").attr("disabled",true);
        try
        {
                let doble = await Promise.all([listarTemas(),listarAutoridades()]);
                inicializarFiltros().then(()=>
                {
                        construirFiltros();
                        listarDatos().then((listD)=>{ $("#btnAgregarDocumentoEntradaRefrescar").removeAttr("disabled"); });
                });
        }catch(error)
        {
                growlError("Error","Error "+error);
                $("#btnAgregarDocumentoEntradaRefrescar").removeAttr("disabled");
        }
}

inicioDocumentoEntrada();

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
        {% if(t == 1){ if( $('#tempInputIdDocumento').length > 0 ) { var ID_DOCUMENTO = $('#tempInputIdDocumento').val(); mostrar_urls(ID_DOCUMENTO); actualizarDocumentoEntrada(ID_DOCUMENTO); }else{ $('#btnAgregarDocumentoEntradaRefrescar').click(); } } %}
</script>
                
                
                <!--Inicia para el spiner cargando-->
                <script src="../../js/loaderanimation.js" type="text/javascript"></script>
                <!--Termina para el spiner cargando-->
                
                <script src="../../assets/probando/js/bootstrap.min.js" type="text/javascript"></script>

                <!--jquery-->
                <!-- <script src="../../js/jquery-ui.min.js" type="text/javascript"></script> -->

                <!--Bootstrap-->
                <!--Aqui abre el modal de insertar-->
                <!--Aqui cierra para abrir el modal de insertar-->
                <!-- <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script> -->

                <!--Para abrir alertas del encabezado-->
                <script src="../../assets/probando/js/ace-elements.min.js"></script>
                
                <!-- si quitan esta libreria no se veran las notificaciones -->
                <script src="../../assets/probando/js/ace.min.js"></script>
		<!-- <script src="../../assets/probando/js/ace-extra.min.js"></script>      -->
          

                <!-- js cargar archivo -->
                 <!--<script src="../../assets/FileUpload/js/jquery.min.js"></script>-->
                <!--<script src="../../assets/FileUpload/js/jquery-ui.min.js"></script>--> 
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
                <!-- <script src="../../assets/FileUpload/js/main.js"></script> -->
	</body>
        
        
        
</html>


