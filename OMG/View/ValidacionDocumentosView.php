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
                <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>

		<!-- ace styles -->
		<link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!-- <link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" /> -->
		<link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
                
        <!--Inicia para el spiner cargando-->
        <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
        <!--Termina para el spiner cargando-->
        
        <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
        <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
        <script src="../../js/jquery.js" type="text/javascript"></script>

        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>

        <script src="../../js/fechas_formato.js" type="text/javascript"></script>

        <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
        <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>

        <!-- <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
        <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script> -->

        <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
        <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
        <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
        <!-- <script src="../../js/tools.js" type="text/javascript"></script> -->
        <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>

        <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
        <script src="../../js/fGridComponent.js" type="text/javascript"></script>
        <script src="../../js/fValidacionDocumentosView.js" type="text/javascript"></script>
        <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
                
                
<style>
/* .jsgrid-header-row>.jsgrid-header-cell 
{ */
    /* background-color:#307ECC ; */
          /* orange */
    /* font-family: "Roboto Slab";
    font-size: 1.2em;
    color: white;
    font-weight: normal;
} */
.div-observacion-msjs
{
    width: 100%;
    height: 250px;
    overflow: auto;
}
.div-observacion-btn
{
    height: 50px;
    max-height: 50px;
    min-height: 50px;
    border-top: 1px silver solid;
    width: 100%;
    /* margin: -5px; */
}
.area-observaciones {
    min-width: 87%;
    max-width: 87%;
    min-height: 100%;
    max-height: 100%;
    text-decoration: none;
    border: none;
    float: left;
    border-top:3px solid #49986d;
}
textarea:hover
{
    border-top:3px solid #49986d;
    /* border-color:6px solid #49986d; */
}

textarea:focus
{
    border-top:3px solid #49986d;
    /* border-color:6px solid #49986d; */
}

.btn-observaciones
{
    width: 13%;
    height: 100%;
    float: left;
    border-radius: 3px;
    border: 3px #49986d solid;
    background-color: #87B87F!important;
    color:black;
}
 /* 5 - setting height and scrolling */
.table-container {
    max-height: 70vh; /* 5 */
    overflow-y: auto; /* 5 */
        
        /* 6 - same styling as for thead th */
        &:before {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        min-height: 2.5em;             /* 6 */
        border-bottom: 2px solid #DDD; /* 6 */
        background: #f1f1f1;           /* 6 */
    }
}
/*Finaliza estilos para mantener fijo el header*/                    
                                      
                    
                </style>
                
                    
                
 			 
	</head>

        
<body>
       
<?php
require_once 'EncabezadoUsuarioView.php';

if(isset($_REQUEST["accion"]))
            $accion = $_REQUEST["accion"];
        else
            $accion = -1;
?>

             
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">

    <button type="button" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
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

<!-- <div style="height: 40px"></div> -->
               
<!-- Inicio modal adjuntar documento -->
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

          <div class="form-group" method="post">
                  <button type="submit" id="subirArchivos"  class="btn crud-submit btn-info btn-block">Adjuntar Archivo</button>
          </div>
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->

               
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
            <div class="table-container">
                <table class="tbl-qa" id="idTable" style="width:100%;">
                    <tr>
                        <th class="table-header">Tema</th>
                        <th class="table-header">Responsable</th>
                    </tr>
                    <tbody id="tbodyValidacionDocumentosModal">
                    </tbody>
                </table>
            </div>
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

<div class="modal draggable fade" id="mostrar-observaciones" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
        <div id="loaderModalMostrar"></div>
		<div class="modal-content" style="width: 500px;">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"  class="closeLetra">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Observaciones</h4>
        </div>
        <div class="modal-body" style="padding:10px 1px 1px 1px">
            <div class="div-observacion-msjs" id="observacion_msjs"></div>

            <div id="div_observacion_btn" class="div-observacion-btn">
                <textarea class="area-observaciones"></textarea>
                <button click="enviarObservacion()" class="btn-observaciones">Enviar</button>
            </div>
        </div><!-- cierre div class-body -->
      </div><!-- cierre div class modal-content -->
    </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal-->

                
<script>
                    
    var id_validacion_documento, columna, objetocheckbox, si_hay_cambio=false;
    var DataGrid=[], dataListado=[], filtros=[];
    var db={};
    var gridInstance, ultimoNumeroGrid=0;
    var DataGridExcel=[],origenDeDatosVista="validacionDocumentos";

    var customsFieldsGridData=[
        // {field:"customControl",my_field:MyCControlField},
        // {field:"porcentaje",my_field:porcentajesFields},
        {field:"FValidacionDocumento",my_field:fieldValidacionDocumento},
        {field:"FValidacionTema",my_field:fieldValidacionTema},
        
        
    ];

    idUsuario = <?php echo $Usuario["ID_USUARIO"] ?>

    estructuraGrid = [
        { name:"id_principal", visible:false},
        { name:"no", title:"No",width:50},
        { name: "clave_documento", title:"Clave Documento", type: "text", width: 130,editing:false},
        { name: "documento", title:"Documento", type: "text", width: 110,editing:false},
        { name: "responsable_documento", title:"Responsable Documento", type: "text", width: 120,editing:false},
        { name: "tema_responsableBTN", title:"Temas y Responsables", type: "text", width: 110, editing:false},
        { name: "mostrar_urlsBTN", title:"Archivo Adjunto", type: "text", width: 90, editing:false},
        { name: "requisitosBTN", title:"Requisitos", type: "text", width: 90, editing:false},
        { name: "registrosBTN", title:"Registros", type: "text", width: 90, editing:false},
        { name: "validacion_documento_responsable", title:"Validación Responsable Documento", type: "FValidacionDocumento", width: 100, editing:false},
        { name: "validacion_tema_responsable", title:"Validación Responsable Tema", type: "FValidacionTema", width: 100, editing:false},
        { name: "observaciones", title:"Observación", type: "text", width: 110, editing:false},
        // { name: "desviacion_mayor", title:"Desviación Mayor", type: "text", width: 90, editing:false},

        // { name:"delete", title:"Opción", type:"customControl",sorting:""},
    ];

    // filtros = 
    // [
    //     {'name':'Clave Documento','id':'clave_documento',type:'text'},
    //     {'name':'Documento','id':'documento',type:'text'},
    //     {'name':'Responsable Documento','id':'responsable_documento',type:'text'},
    //     {'name':'Validacion Documento Responsable','id':'validacion_documento_responsable',type:'combobox',data:construirValidacionDCombo(),descripcion:"descripcion"},
    //     {'name':'Validacion Tema Responsable','id':'validacion_tema_responsable',type:'combobox',data:construirValidacionTCombo(),descripcion:"descripcion"},
    // ];

    // construirFiltros();
    // listarDatos();

    function construirValidacionDCombo()
    {
        return [{ validacion_documento_responsable:"true",descripcion:"Validado"},{validacion_documento_responsable:"false",descripcion:"No Validado"}];
    }
    function construirValidacionTCombo()
    {
        return [{ validacion_tema_responsable:"true",descripcion:"Validado"},{validacion_tema_responsable:"false",descripcion:"No Validado"}];
    }

    $(function()
    {
        // $("#mostrar-observaciones").close();
        // $("#mostrar-observaciones").on("shown.bs.modal", function (){ 
        //     alert('Hi');
        // });
        // $("#mostrar-observaciones").modal('show');

        // $("#mostrar-observaciones").on("hide.bs.modal",function(){
        //     alert("modal cerrado");
        // });


        $('.checkboxDocumento').on('change', function()
        {          
          var chekeado=$(objetocheckbox).filter('[type=checkbox]')[0]['checked'];
//          alert(chekeado);
            $.ajax({
                url: "../Controller/ValidacionDocumentosController.php?Op=Modificar",
                type: "POST",
                data:'column='+columna+'&editval='+chekeado+'&id='+id_validacion_documento,
                success: function(data)
                {
                    if(data==true)
                    {
                        (chekeado)?
                        swal("","Documento validado"):swal("","Documento no validado");

                        setTimeout(function(){swal.close();},1000);
//                        if(columna=="desviacion_mayor")
//                        {
//                          enviar_notificacion(columna,chekeado,id_validacion_documento);
//                          
//                        }
                    }
                }                
                });
        });
        
        
        var $btnDLtoExcel = $('#toExcel'); 
        $btnDLtoExcel.on('click', function () 
        {   
            __datosExcel=[]
            $.each(dataListado,function (index,value)
                {
                    console.log("Entro al datosExcel");
                    __datosExcel.push( reconstruirExcel(value,index+1) );
                });
                DataGridExcel= __datosExcel;
//            console.log("Entro al excelexportHibrido");
            $("#listjson").excelexportHibrido({
                containerid: "listjson"
                , datatype: 'json'
                , dataset: DataGridExcel
                , columns: getColumns(DataGridExcel)
            });
        });      
    
   
    });//CIERRA $(function()) 

    function listarValidacionDocumentos()//listo
    {
        tempData="";
        $.ajax({
            url: '../Controller/ValidacionDocumentosController.php?Op=ListarTodo',
            type:'POST',
            async:false,
            success:function(documentos)
            {
                $.each(documentos,function(index,value)
                {
                    tempData += "<tr id='registroDocumento_"+value.id_validacion_documento+"'>"+construirValidacionDocumento(value,index++)+"</tr>";
                });
                $("#tbodyValidacionDocumentos").html(tempData);
            },
            error:function()
            {
                swalError("Error en el servidor");
            }
        });
        moverA();
    }

    

    // function construirValidacionDocumento(documento,numero)//listo
    // {
    //     no = "fa-times-circle-o";
    //     yes = "fa-check-circle-o";
    //     tempData="<td>"+numero+"</td>";
    //     tempData+="<td>"+documento.clave_documento+"</td>";
    //     tempData+="<td>"+documento.documento+"</td>";
    //     tempData+="<td>"+documento.responsable_documento+"</td>";

    //     tempData+="<td><button onClick='mostrarTemaResponsable("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-temaresponsable'>";
    //     tempData+="<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";
        
    //     if(documento.permiso_total == 0)
    //     {
    //         if(documento.soy_responsable==1)
    //             tempData+="<td><button onClick='mostrar_urls("+documento.id_validacion_documento+",\"true\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";
    //         else
    //             tempData+="<td><button onClick='mostrar_urls("+documento.id_validacion_documento+",\""+documento.validacion_documento_responsable+"\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";
    //     }
    //     else
    //         tempData+="<td><button onClick='mostrar_urls("+documento.id_validacion_documento+",\"false\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";

    //     tempData+="<i class='fa fa-cloud-upload' style='font-size: 20px'></i>Adjuntar</button></td>";
    //     tempData+="<td><button onClick='mostrarRequisitos("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-requisitos'>";
    //     tempData+="<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";
    //     tempData+="<td><button onClick='mostrarRegistros("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-registros'>";
    //     tempData+="<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";

    //     tempData+="<td>";
    //     if(documento.validacion_documento_responsable=="true")
    //     {
    //         tempData+="<i class='fa "+yes+"' style='color:#02ff00;";
    //     }
    //     else
    //     {
    //         tempData+="<i class='fa "+no+"' style='color:red;";
    //     }
    //     tempData+="font-size: xx-large;cursor:pointer' aria-hidden='true'";
    //     if(documento.permiso_total==1)
    //         tempData+="onClick='validarDocumentoR(this,\"validacion_documento_responsable\","+documento.id_validacion_documento+","+documento.id_documento+")'";
    //     else
    //     {
    //         if(documento.soy_responsable==0)
    //             tempData+="onClick='validarDocumentoR(this,\"validacion_documento_responsable\","+documento.id_validacion_documento+","+documento.id_documento+")'";
    //         else
    //             tempData+="onClick='noAcceso(this)'";
    //     }
    //     tempData+="></i></td>";

    //     tempData+="<td>";
    //     if(documento.validacion_tema_responsable=="true")
    //     {
    //         tempData+="<i class='fa "+yes+"' style='color:#02ff00;";
    //     }
    //     else
    //     {
    //         tempData+="<i class='fa "+no+"' style='color:red;";
    //     }
    //     tempData+="font-size: xx-large;cursor:pointer' aria-hidden='true'";
    //     if(documento.soy_responsable==1)
    //         tempData+="onClick='validarTemaR(this,\"validacion_tema_responsable\","+documento.id_validacion_documento+","+documento.id_documento+","+documento.id_usuarioD+")'";
    //     else
    //         tempData+="onClick='noAcceso(this)'";
    //     tempData+="></i></td>";

    //     tempData+="<td>";
    //     tempData+="<i data-toggle='modal' data-target='#mostrar-observaciones' onClick='mostrarObservacionesInicio("+documento.id_validacion_documento+")' class='ace-icon fa fa-comments' style='font-size:20px;cursor:pointer'></i></td>";
    //     tempData+="<td>X</td>";
    //     return tempData;
    // }

    // function construir(documento,numero)
    // {
    //     no = "fa-times-circle-o";
    //     yes = "fa-check-circle-o";
    //     tempData = new Object();

    //     tempData["no"] = numero;
    //     tempData["id_principal"] = [{"id_documento":documento.id_documento}];
    //     // tempData="<td>"+numero+"</td>";
    //     tempData["clave_documento"] = documento.id_documento;
    //     // tempData+="<td>"+documento.clave_documento+"</td>";
    //     tempData["documento"] = documento.documento;
    //     // tempData+="<td>"+documento.documento+"</td>";
    //     tempData["responsable_documento"] = documento.responsable_documento;
    //     // tempData+="<td>"+documento.responsable_documento+"</td>";

    //     tempData["tema_responsableBTN"] = "<button onClick='mostrarTemaResponsable("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-temaresponsable'>";
    //     tempData["tema_responsableBTN"] += "<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button>";

    //     // tempData+="<td><button onClick='mostrarTemaResponsable("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-temaresponsable'>";
    //     // tempData+="<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";
        
    //     if(documento.permiso_total == 0)
    //     {
    //         if(documento.soy_responsable==1)
    //             // tempData+="<td><button onClick='mostrar_urls("+documento.id_validacion_documento+",\"true\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";
    //             tempData["mostrar_urlsBTN"] = "<button onClick='mostrar_urls("+documento.id_validacion_documento+",\"true\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";
    //         else
    //             tempData["mostrar_urlsBTN"] = "<button onClick='mostrar_urls("+documento.id_validacion_documento+",\""+documento.validacion_documento_responsable+"\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";
    //         // tempData+="<td><button onClick='mostrar_urls("+documento.id_validacion_documento+",\""+documento.validacion_documento_responsable+"\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";
    //     }
    //     else
    //         tempData["mostrar_urlsBTN"] = "<button onClick='mostrar_urls("+documento.id_validacion_documento+",\"false\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>"
    //         // tempData+="<button onClick='mostrar_urls("+documento.id_validacion_documento+",\"false\");' type='button' class='btn btn-primary' data-toggle='modal' data-target='#create-itemUrls'>";

    //     tempData["mostrar_urlsBTN"] += "<i class='fa fa-cloud-upload' style='font-size: 20px'></i>Adjuntar</button>";
    //     // tempData+="<i class='fa fa-cloud-upload' style='font-size: 20px'></i>Adjuntar</button></td>";

    //     tempData["requisitosBTN"] = "<button onClick='mostrarRequisitos("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-requisitos'>";
    //     tempData["requisitosBTN"] += "<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button>";
    //     // tempData+="<td><button onClick='mostrarRequisitos("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-requisitos'>";
    //     // tempData+="<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";

    //     tempData["registrosBTN"] = "<button onClick='mostrarRegistros("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-registros'>";
    //     // tempData+="<td><button onClick='mostrarRegistros("+documento.id_documento+");' type='button' class='btn btn-success' data-toggle='modal' data-target='#mostrar-registros'>";
    //     tempData["registroBTN"] += "<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";
    //     // tempData+="<i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button></td>";

    //     // tempData+="<td>";
    //     if(documento.validacion_documento_responsable=="true")
    //     {
    //         tempData["validacion_documento_responsable"] = "<i class='fa "+yes+"' style='color:#02ff00;";
    //     }
    //     else
    //     {
    //         tempData["validacion_documento_responsable"] = tempData+="<i class='fa "+no+"' style='color:red;";
    //     }
    //     tempData["validacion_documento_responsable"] += "font-size: xx-large;cursor:pointer' aria-hidden='true'";
    //     if(documento.permiso_total==1)
    //         tempData["validacion_documento_responsable"] += "onClick='validarDocumentoR(this,\"validacion_documento_responsable\","+documento.id_validacion_documento+","+documento.id_documento+")'";
    //     else
    //     {
    //         if(documento.soy_responsable==0)
    //         tempData["validacion_documento_responsable"] += "onClick='validarDocumentoR(this,\"validacion_documento_responsable\","+documento.id_validacion_documento+","+documento.id_documento+")'";
    //         else
    //         tempData["validacion_documento_responsable"] += "onClick='noAcceso(this)'";
    //     }
    //     tempData["validacion_documento_responsable"] += "></i>";

    //     // tempData+="<td>";
    //     if(documento.validacion_tema_responsable=="true")
    //     {
    //         tempData["validacion_tema_responsable"] += "<i class='fa "+yes+"' style='color:#02ff00;";
    //     }
    //     else
    //     {
    //         tempData["validacion_tema_responsable"] += "<i class='fa "+no+"' style='color:red;";
    //     }
    //     tempData["validacion_tema_responsable"] += "font-size: xx-large;cursor:pointer' aria-hidden='true'";
        
    //     if(documento.soy_responsable==1)
    //         tempData["validacion_tema_responsable"] += "onClick='validarTemaR(this,\"validacion_tema_responsable\","+documento.id_validacion_documento+","+documento.id_documento+","+documento.id_usuarioD+")'";
    //     else
    //         tempData["validacion_tema_responsable"] += "onClick='noAcceso(this)'";
    //     tempData+="></i>";

    //     // tempData+="<td>";
    //     tempData["observaciones"] += "<i data-toggle='modal' data-target='#mostrar-observaciones' onClick='mostrarObservacionesInicio("+documento.id_validacion_documento+")' class='ace-icon fa fa-comments' style='font-size:20px;cursor:pointer'></i>";
    //     tempData["desviacion_mayor"] += "X";
    //     return tempData;
    // }

    intervalObservaciones = setInterval(0);
    // clearInterval(intervalObservaciones);

    function mostrarObservaciones(idDocumento)
    {
        clearInterval(intervalObservaciones);
        tempData = "";
        $.ajax({
            url:'../Controller/ValidacionDocumentosController.php?Op=ListarObservaciones',
            type:'GET',
            data:'ID_VALIDACION_DOCUMENTO='+idDocumento,
            success:function(observaciones)
            {
                // console.log(observaciones);
                $.each(JSON.parse(observaciones.observaciones),function(index,value)
                {
                    tempData += construirObservacion(value,observaciones.idUsuario);   
                });
                $("#observacion_msjs").html(tempData);
                // $("#observacion_msjs").fadeOut(2000, function(){
                // setTimeout(function(){$("#observacion_msjs").scrollTop($("#observacion_msjs")[0].scrollHeight);},500);
                // // setTimeout(function(){mostrarObservaciones(idDocumento);},2000);
                // intervalObservaciones = setInterval(function()
                // {
                //     if($("#observacion_msjs")[0].scrollHeight == 0 )
                //     {
                //         clearInterval(intervalObservaciones);
                //     }
                //     else
                //         mostrarObservaciones(idDocumento);
                // },2000);
                    // $("#observacion_msjs").fadeIn(2000);
                // });
            },
            error:function()
            {
                swalError("Error en el servidor al cargar las observaciones")
            }
        });
    }

    function mostrarObservacionesInicio(idDocumento)
    {
        $("#mostrar-observaciones").modal();
        $("#div_observacion_btn").html("<textarea id='textarea_msj' class='area-observaciones'></textarea><button onClick='enviarObservacion("+idDocumento+")' class='btn-observaciones'>Enviar</button>");
        mostrarObservaciones(idDocumento);
    }
    
    // $.when(mostrarObservaciones()).then(alert("A"));


    function construirObservacion(value,idUsuario)
    {
        tempData = "<div class='container' style='width:100%;padding-bottom:5px'><div style='";
        if(idUsuario == value.idU)//flotar a la derecha
        {
            tempData+="float:right;border-radius: 20px 0px 0px 20px;background: #6FB3E0;padding-left:15px'>";
            tempData+= "<h5 style='color:black;float:right;margin:2px'>"+value.msj+"</h5><br>";
            tempData+= "<h6 style='color:white;float:right;margin:2px'>"+getFechaFormatoH(value.fecha)+"</h6>";
        }
        else//flotar izquierda
        {
            tempData+="float:left;border-radius: 0px 20px 20px 0px;background: #dfdfdf;padding-right:15px'>";
            tempData+= "<h5 style='float:left;margin:2px'>"+value.nombre;
            tempData+= " : "+value.msj+"</h5><br>";
            tempData+= "<h6 style='color:;margin:2px'>"+getFechaFormatoH(value.fecha)+"</h6>";
        }
        // console.log(new Date(value.fecha));
        // console.log(value);
        tempData += "</div></div>";
        // tempData += "<h1><br></h1>";
        return tempData;
    }

    function enviarObservacion(idValidacionDocumento)
    {
        msj = $("#textarea_msj").val();
        msj = msj.trim();
        if(msj!="")
        {
            $.ajax({
                url:'../Controller/ValidacionDocumentosController.php?Op=EnviarObservacion',
                type:'POST',
                data:'ID_VALIDACION_DOCUMENTO='+idValidacionDocumento+'&MENSAJE='+msj,
                success:function(exito)
                {
                    if(exito.data!=false)
                    {
                        tempData="";
                        // console.log(JSON.parse(exito.data));
                        $.each(JSON.parse(exito.data),function(index,value)
                        {
                            tempData = construirObservacion(value,exito.idUsuario);
                        });
                        $("#observacion_msjs").append(tempData);
                        $("#textarea_msj").val("");
                        $("#observacion_msjs").scrollTop($("#observacion_msjs")[0].scrollHeight);
                        // a=100;
                        // $(".div-observacion-msjs").animate({ scrollTop: a+"px";a+=100;}, 1000);
                    }
                    else
                    swalError("Error al enviar la observación");
                },
                error:function()
                {
                    swalError("Error en el servidor");
                }
            });
        }
    }
    // function enviar_notificacion(columna,chekeado,id_validacion_documento)
    // {
    //     var u=$("#user").val();
    //     $.ajax({
    //         url:"../Controller/NotificacionesController.php?Op=enviarNotificacionDesviacionAResponsableContrato",
    //         data:"columna="+columna+"&checkeado="+chekeado+"&id_validacion_documento="+id_validacion_documento,
    //         success:function(response)
    //         {
    //             envioCorreo("desarrollador.frv@gmail.com","el asunto ","el mensaje");
    //         }
            
    //     });
    // }

    

    function envioCorreo (para,asunto,mensaje)
    {
        $.ajax({
                url:"../Controller/EmailController.php?Op=envioCorreo",
                data:"para="+para+"&asunto="+asunto+"&mensaje="+mensaje,
                success:function(response){
                        $("#loader").hide();
                },
                beforesend:function(){
                    $("#loader").show();
                },
                error:function (){
                    
                }
                
                });
    }
      
    // function saveCheckBoxToDataBase(checkbox,column,id)
    // {
    //     id_validacion_documento=id;
    //     columna=column;
    //     objetocheckbox=checkbox;
    // }
                
    // function showEdit(editableObj)
    // {
    //     $(editableObj).css("background","#FFF");
    // }
     
    // function saveToDatabase(editableObj,column,id)
    // {
    //     if(si_hay_cambio==true)
    //     {
    //         $("#btnrefrescar").prop("disabled",true);            
    //         $(editableObj).css("background","#FFF url(../../images/base/loaderIcon.gif) no-repeat right");
    //         $.ajax({
    //                 url: "../Controller/ValidacionDocumentosController.php?Op=Modificar",
    //                 type: "POST",
    //                 data:'column='+column+'&editval='+editableObj.innerHTML+'&id='+id,
    //                 success: function(data)
    //                     {
    //                         $(editableObj).css("background","#FDFDFD");
    //                         swal("Actualizacion Exitosa!", "Ok!", "success");
    //                         setTimeout(function(){swal.close();},1000);
    //                         $("#btnrefrescar").prop("disabled",false);
    //                         si_hay_cambio=false;
    //                     }
    //                 });
    //     }
    // }
    
    // function saveComboToDatabase(column,id)
    // {
    //   id_seguimiento_entrada=id;
    // }
    
    // function detectarsihaycambio()
    // {
    //     si_hay_cambio=true;
    // }
    
    // function consultarInformacion(url)
    // {
    //     $("#loader").show();
    //     $.ajax({  
    //         url: ""+url,  
    //       success: function(r)
    //       {
    //           $("#idTable").load("ValidacionDocumentosView.php #idTable");
    //           $("#loader").hide();
    //         },
    //         beforeSend:function(r)
    //         {

    //         },
    //         error:function()
    //         {
    //             $("#loader").hide();
    //         }
    //   });  
    // }
 
    // function refresh()
    // {
    //     ejecutarPrimeraVez=false;
    //     ejecutando=false;
    //     clearInterval(intervalA);
    //     clearTimeout(timeOutA);
    //     listarValidacionDocumentos();
    // }
    
    // function loadSpinner()
    // {
    //   myFunction();
    // }
    
    function cargadePrograma(foliodeentrada)
    {
      window.location.href=" GanttView.php?folio_entrada="+foliodeentrada;
    }
    
    var ModalCargaArchivo = "<form id='fileupload' method='POST' enctype='multipart/form-data'>";
        ModalCargaArchivo += "<div class='fileupload-buttonbar'>";
        ModalCargaArchivo += "<div class='fileupload-buttons'>";
        ModalCargaArchivo += "<span class='fileinput-button'>";
        ModalCargaArchivo += "<span><a >Agregar Archivos(Click o Arrastrar)...</a></span>";
        ModalCargaArchivo += "<input type='file' name='files[]' multiple></span>";
        ModalCargaArchivo += "<span class='fileupload-process'></span></div>";
        ModalCargaArchivo += "<div class='fileupload-progress' >";
        // ModalCargaArchivo += "<div class='progress' role='progressbar' aria-valuemin='0' aria-valuemax='100'></div>";
        ModalCargaArchivo += "<div class='progress-extended'>&nbsp;</div>";
        ModalCargaArchivo += "</div></div>";
        ModalCargaArchivo += "<table role='presentation'><tbody class='files'></tbody></table></form>";
    
    $("#subirArchivos").click(function()
    {
      agregarArchivosUrl();
    });
    months = ["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic"];
    
    
    
    
    // function agregarArchivosUrl()//listo
    // {
    //   var ID_VALIDACION_DOCUMENTO = $('#tempInputIdValidacionDocumento').val();
    //   url = 'filesValidacionDocumento/'+ID_VALIDACION_DOCUMENTO,
    //   $.ajax({
    //     url: "../Controller/ArchivoUploadController.php?Op=CrearUrl",
    //     type: 'GET',
    //     data: 'URL='+url,
    //     success:function(creado)
    //     {
    //       if(creado)
    //         $('.start').click();
    //     },
    //     error:function()
    //     {
    //       swal("","Error del servidor","error");
    //     }
    //   });
    // }

    // function borrarArchivo(url)
    // {
    //   swal({
    //       title: "ELIMINAR",
    //       text: "Confirme para eliminar el documento",
    //       type: "warning",
    //       showCancelButton: true,
    //       closeOnConfirm: false,
    //       showLoaderOnConfirm: true
    //     },function()
    //     {
    //       var ID_VALIDACION_DOCUMENTO = $('#tempInputIdValidacionDocumento').val();
    //       $.ajax({
    //         url: "../Controller/ArchivoUploadController.php?Op=EliminarArchivo",
    //         type: 'POST',    //         data: 'URL='+url,
    //         success: function(eliminado)
    //         {
    //           if(eliminado)
    //           {
    //             modificarArchivos(ID_VALIDACION_DOCUMENTO,-1);
    //             mostrar_urls(ID_VALIDACION_DOCUMENTO);
    //             swal("","Archivo eliminado");
    //             setTimeout(function(){swal.close();},1000);
    //           }
    //           else
    //             swal("","Ocurrio un error al elimiar el documento", "error");
    //         },
    //         error:function()
    //         {
    //           swal("","Ocurrio un error al elimiar el documento", "error");
    //         }
    //       });
    //     });
    // }

    
    // function validarDocumentoR(Obj,columna,idValidacionDocumento,idDocumento,no)//listo
    // {
    //     GetValidacionTema = ({
    //         url:'../Controller/ValidacionDocumentosController.php?Op=GetValidacionTema',
    //         type:'GET',
    //         data:'ID_VALIDACION_DOCUMENTO='+idValidacionDocumento,
    //     });

    //     GetExisteArchivo = ({
    //         url:'../Controller/ValidacionDocumentosController.php?Op=GetExisteArchivo',
    //         type:'GET',
    //         data:'ID_VALIDACION_DOCUMENTO='+idValidacionDocumento,
    //     });
        
    //     $.ajax(GetValidacionTema).done(function(validado)
    //     {
    //         if(validado==false)
    //         {
    //                 $.ajax(GetExisteArchivo).done(function(existenArchivos)
    //                 {
    //                     if(existenArchivos==true)
    //                     {
    //                         validarR = validar(idValidacionDocumento,columna,Obj,no);
    //                         $.ajax({
    //                             url:'../Controller/ValidacionDocumentosController.php?Op=ObtenerTemayResponsable',
    //                             type:'GET',
    //                             data:'ID_DOCUMENTO='+idDocumento,
    //                             success:function(responsables)
    //                             {
    //                                 $.each(responsables,function(index,value)
    //                                 {
    //                                     (validarR)?
    //                                     enviar_notificacion("Ha sido validado un documento por el responsable del documento",value.id_usuario,0,false,"ValidacionDocumentosView.php?accion="+idValidacionDocumento)//msj,para,tipomsj,atendido,asunto
    //                                     :
    //                                     enviar_notificacion("Ha sido desvalidado un documento por el responsable del documento",value.id_usuario,0,false,"ValidacionDocumentosView.php?accion="+idValidacionDocumento);//msj,para,tipomsj,atendido,asunto
    //                                 });
    //                             }
    //                         });
    //                     }
    //                     if(existenArchivos==false)
    //                     {
    //                         swal("","Debe de adjuntar un archivo antes de Validar","info");
    //                     }
    //                     if(validado==-1)
    //                     {
    //                         swalError("Error en el servidor");
    //                     }
    //                 });
    //         }
    //         if(validado==true)
    //             swalError("Imposible desvalidar");
    //         if(validado==-1)
    //             alert("Error en el servidor");
    //     })
    //     .fail(function()
    //     {
    //         swalError("Error en el servidor");
    //     });
    // }


    // function validarTemaR(Obj,columna,idValidacionDocumento,idDocumento,idPara)//listo
    // {
    //     GetValidacionTema = $.ajax({
    //         url:'../Controller/ValidacionDocumentosController.php?Op=GetValidacionDocumento',
    //         type:'GET',
    //         data:'ID_VALIDACION_DOCUMENTO='+idValidacionDocumento,
    //     });
        
    //     GetValidacionTema.done(function(validado)
    //     {
    //         if(validado==true)
    //         {
    //             validarR = validar(idValidacionDocumento,columna,Obj);
    //             (validarR)?(
    //             enviar_notificacion("Ha sido validado un documento por el responsable de Tema",idPara,0,false,"ValidacionDocumentosView.php?accion="+idValidacionDocumento)//msj,para,tipomsj,atendido,asunto
    //             ):(
    //             enviar_notificacion("Ha sido desvalidado un documento por el responsable de Tema",idPara,0,false,"ValidacionDocumentosView.php?accion="+idValidacionDocumento)
    //             );//msj,para,tipomsj,atendido,asunto

    //             $.ajax({
    //                 url:'../Controller/ValidacionDocumentosController.php?Op=ObtenerTemayResponsable',
    //                 type:'GET',
    //                 data:'ID_DOCUMENTO='+idDocumento,
    //                 success:function(responsables)
    //                 {
    //                     $.each(responsables,function(index,value)
    //                     {
    //                         if(value.id_usuario!=idUsuario)
    //                         {
    //                             (validarR)?
    //                             enviar_notificacion("Ha sido validado un documento por el responsable de Tema",value.id_usuario,0,false,"ValidacionDocumentosView.php?accion="+idValidacionDocumento)//msj,para,tipomsj,atendido,asunto
    //                             :
    //                             enviar_notificacion("Ha sido desvalidado un documento por el responsable de Tema",value.id_usuario,0,false,"ValidacionDocumentosView.php?accion="+idValidacionDocumento);//msj,para,tipomsj,atendido,asunto
    //                         }                                
    //                     });
    //                 }
    //             });
    //         }
    //         if(validado==false)
    //             swalError("Esperando validacion Responsable del documento");
    //         if(validado==-1)
    //             alert("Error en el servidor");
    //     })
    //     .fail(function()
    //     {
    //         swalError("Error en el servidor");
    //     });
    // }

    // function validar(idValidacionDocumento,columna,Obj,no)//listo
    // {
    //     no = "fa-times-circle-o";
    //     yes = "fa-check-circle-o";
    //     valor=false;
    //     ($(Obj).hasClass(no))?valor=true:valor=false;
    //     exitoT=false;
    //     $.ajax({
    //             url: '../Controller/ValidacionDocumentosController.php?Op=ModificarColumna',
    //             type: 'POST',
    //             data: 'ID_VALIDACION_DOCUMENTO='+idValidacionDocumento+'&COLUMNA='+columna+'&VALOR='+valor,
    //             async:false,
    //             success:function(exito)
    //             {
    //                 exitoT = valor;
    //                 if(exito)
    //                 {
    //                     // $(Obj).removeClass( (valor)?no:yes );
    //                     // $(Obj).addClass( (valor)?yes:no );
    //                     // $(Obj).css("color", (valor)?"#02ff00":"red" );
    //                     // swalSuccess("Cambio aceptado");
    //                     // listarValidacionDocumento(idValidacionDocumento,no);
    //                     //aqui mandar notificacion
    //                 }
    //             },
    //             error:function()
    //             {
    //                 swalError("Error en el servidor");
    //             }
    //         });
    //     return exitoT;
    // }

    // function noAcceso(Obj)
    // {
    //     no = "fa-times-circle-o";
    //     yes = "fa-check-circle-o";
    //     valor=false;
    //     ($(Obj).hasClass(no))?valor=false:valor=true;
    //     swalInfo( ((valor)?"Validado por el responsable del documento":"Esperando la validación del responsable del documento") );
    // }

    

    intervalA="";
    timeOutA="";
    mover = '<?php echo $accion; ?>';
    cambio=1;
    ejecutando=false;
    ejecutarPrimeraVez=true;
    function moverA()
    {
        if(mover!="-1" && ejecutando==false && ejecutarPrimeraVez==true)
        {
            if($("#registroDocumento_"+mover)[0]!=undefined)
            {
                ejecutando=true;
                window.location = "#registroDocumento_"+mover;
                ObjB = $("#registroDocumento_"+mover)[0];
                css = $(ObjB).css("background");
                intervalA = setInterval(function()
                {
                    if(cambio==1)
                    {
                        $(ObjB).css("background","#02ff00");
                        cambio=0;
                    }
                    else
                    {
                        $(ObjB).css("background",css);
                        cambio=1;
                    }
                },500);
                timeOutA = setTimeout(function(){
                    clearInterval(intervalA);
                    $(ObjB).css("background",css);
                    ejecutando=false;
                    ejecutarPrimeraVez=false;
                },10000);
            }
            else
            {
                swalInfo("El registro al que desea acceder no existe");
            }
        }
    }

    construirGrid();
    inicializarFiltros().then((resolve2)=>
    {
        construirFiltros();
    });
    listarDatos();

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
  {% if(t == 1){ if( $('#tempInputIdValidacionDocumento').length > 0 ) { var ID_VALIDACION_DOCUMENTO = $('#tempInputIdValidacionDocumento').val(); mostrar_urls(ID_VALIDACION_DOCUMENTO);} } var ID_VALIDACION_DOCUMENTO = $('#tempInputIdValidacionDocumento').val(); modificarArchivos(ID_VALIDACION_DOCUMENTO,1);  %}
</script>
            
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
    

                <!--Para cargar archivos-->
<!--                <script src="../../assets/FileUpload/js/jquery.min.js"></script>
                <script src="../../assets/FileUpload/js/jquery-ui.min.js"></script>-->
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
                <script src="../../assets/FileUpload/js/main.js"></script>
                <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
                <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
                <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
                <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">
                
	</body>
     
</html>


