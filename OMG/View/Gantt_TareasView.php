<?php
session_start();
require_once '../util/Session.php';
$dataGanttDescripcion="";
if(isset($_REQUEST["id_tarea"])){
   Session::setSesion("dataGantt_id_tarea",$_REQUEST["id_tarea"]);
    //    echo "el seguimiento de entrada linkeado al de doc de entrada y al folio de entrada   ".$dataGantt=Session::getSesion("dataGantt");;
    echo "<h2><center></center><h2>";
}else{
    $dataGantt=Session::getSesion("dataGantt_id_tarea");
}

if(isset($_REQUEST["descripcion"])){
   Session::setSesion("dataGantt_descripcion",$_REQUEST["descripcion"]);
   $dataGanttDescripcion=Session::getSesion("dataGantt_descripcion");
    //    echo "el seguimiento de entrada linkeado al de doc de entrada y al folio de entrada   ".$dataGantt=Session::getSesion("dataGantt");;
}else{
    $dataGanttDescripcion=Session::getSesion("dataGantt_descripcion");
    echo "en el else";
}




//Session::setSesion("dataGantt",$_REQUEST["id_documento_entrada"]);
//  Session::setSesion("dataGantt",":(");
?>


<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <!--<meta charset="UTF-8" name="viewport" content="width=500, initial-scale=1, maximum-scale=1">-->
        <title></title>
        
    <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <!--Para abrir alertas de aviso, success,warning, error--> 
    <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>  
<!--        <script src="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.js"></script>
  <link href="https://cdn.dhtmlx.com/gantt/edge/dhtmlxgantt.css" rel="stylesheet">
  <script src="../../assets/dhtmlxGantt/api.js" type="text/javascript"></script>-->
        <link  href="../../assets/gantt_5.1.2_com/codebase/dhtmlxgantt.css" rel="stylesheet" type="text/css"/>
        <script src="../../assets/gantt_5.1.2_com/codebase/dhtmlxgantt.js" type="text/javascript"></script>
        <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_auto_scheduling.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_auto_scheduling.js.map"></a>-->
    <!--<script src="../../js/jquery.js" type="text/javascript"></script>-->
   
    <!--<link id="skin" href="../../assets/gantt_5.1.2_com/codebase/skins/dhtmlxgantt_terrace.css" rel="stylesheet" type="text/css"/>-->
    <script src="../../js/jquery.min.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
    
    
    
    <!-- cargar archivo -->
<!--    <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
    <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">-->
    
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_critical_path.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_critical_path.js.map"></a>-->
    
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_csp.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_csp.js.map"></a>-->
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_fullscreen.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_fullscreen.js.map"></a>-->
    <script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_grouping.js" type="text/javascript"></script>
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_grouping.js.map"></a>-->
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_keyboard_navigation.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_keyboard_navigation.js.map"></a>-->
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_marker.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_marker.js.map"></a>-->
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_multiselect.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_multiselect.js.map"></a>-->
    
    <!--aqui empieza para hacer aparecer la ventanita cuando seleccionas--> 
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_quick_info.js" type="text/javascript"></script>-->
    <!--aqui cierra-->
    <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_quick_info.js.map"></a>-->
    <!--<script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_smart_rendering.js" type="text/javascript"></script>-->
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_smart_rendering.js.map"></a>-->
    <script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_tooltip.js" type="text/javascript"></script>
<!--    <a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_tooltip.js.map"></a>-->
    <script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_undo.js" type="text/javascript"></script>
    <!--<a href="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_undo.js.map"></a>-->
    <script src="../../assets/gantt_5.1.2_com/codebase/locale/locale_es.js" type="text/javascript"></script>
    <script src="https://export.dhtmlx.com/gantt/api.js?v=20180322"></script>
    
    <script src="../../assets/gantt_5.1.2_com/codebase/ext/dhtmlxgantt_fullscreen.js" type="text/javascript"></script>
         
      
   <!--<script src="../../codebase/ext/dhtmlxgantt_smart_rendering.js"></script>-->
   
   <script src="../../assets/gantt_5.1.2_com/codebase/sources/ext/dhtmlxgantt_keyboard_navigation.js" type="text/javascript"></script>
   
   <link href="../../assets/gantt_5.1.2_com/codebase/skins/dhtmlxgantt_meadow.css" rel="stylesheet" type="text/css"/>
   
    
   <link href="../../assets/gantt_5.1.2_com/samples/common/third-party/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
   <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
   <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>

    
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <!--<link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->
    <script src="../../assets/probando/js/bootstrap.min.js" type="text/javascript"></script>

    
    
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/>
    
    <link href="../../assets/dhtmlxSuite_v51_std/skins/material/dhtmlx.css" rel="stylesheet" type="text/css"/>
    <!--<link href="../../assets/dhtmlxSuite_v51_std/skins/skyblue/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
    <!--<link href="../../assets/dhtmlxSuite_v51_std/skins/terrace/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
    <!--<link href="../../assets/dhtmlxSuite_v51_std/skins/web/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
    
    
    <!--aqui empieza librerias qe no son del gantt en funcionalidad y presentacion-->
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/18.1.6/css/dx.common.css" />
    <link rel="dx-theme" data-theme="generic.light" href="https://cdn3.devexpress.com/jslib/18.1.6/css/dx.light.css" />
    <script src="https://cdn3.devexpress.com/jslib/18.1.6/js/dx.all.js"></script>
    <link href="../../css/PersonalizacionVistasGantt.css" rel="stylesheet" type="text/css"/>
    <!--aqui termina las librerias que no son del gantt-->
    <!--<link href="../../css/notasgantt.css" rel="stylesheet" type="text/css"/>-->
    
   
 <style type="text/css">
    html, body{
      height: 100%;
      overflow: visible;
    }
    a{
        color: #337ab7;
        text-decoration: none;
        font-size: 15;
    }        
    /*tareas padres -->*/
         .gantt_task_line.gantt_dependent_task {
			background-color: #65c16f;
                        /*background-color:  #0042e9;*/
			/*border: 1px solid #3c9445;*/
		}   
       /*<--*/         
                
.gantt_task_line.gantt_dependent_task .gantt_task_progress {
			background-color: #46ad51;
		}
                
       .gantt_task_progress {
			text-align: left;
			padding-left: 10px;
			box-sizing: border-box;
			color: black;
			font-weight: bold;
               
                        
		}
                /*estilos para ocultar el texto de la barra*/ 
/*                .gantt_task_content {
                    display: none;
                }   */
                .completed_task {
		border: 1px solid #94AD94;
                }
                .completed_task .gantt_task_progress {
                    background: #0000cc;
                }
                .task_suspendida .gantt_task_progress{
                    background:yellow; 
                }
                
                .text_tarea_terminada_Azul{
                    color: white;
                }
                .text_tarea_suspendida_amarilla{
                    color: black;
                }
                
                .summary-row,
		.summary-row.odd {
			background-color: #EEEEEE;
			font-weight: bold;
		}

		.gantt_grid div,
		.gantt_data_area div {
			font-size: 12px;
		}
		.summary-bar {
			opacity: 0.4;
		}
               
 .dx-treelist-borders > 
 .dx-treelist-pager, 
 .dx-treelist-borders > 
 .dx-treelist-headers,
 .dx-treelist-borders > 
 .dx-treelist-filter-panel{
            background-color:#307ECC ; 
            font-family: "Roboto Slab";
            font-size: 1.2em;
            font-weight: normal;
            }
          .dx-header-row > td > .dx-treelist-text-content {
    white-space: normal;
    vertical-align: top;
    color: white;
}               
#dx {
    /*width: 60% !important ;*/
}

/*.configTable{width:95% !important;height:60% ;position: fixed;z-index: 2;};*/

 .modal-lg{width: 100%;}
 .modal-lgfile{width: 50%;}
 .modal-body{position:relative;padding:0px}
 .modal-title {
    text-align: center;
}
#mydiv {
    position: fixed;
    z-index: 9;
    padding-left: 5%;
    /*background-color: #f1f1f1;*/
    text-align: center;
    /*border: 1px solid #d3d3d3;*/
    width: 100%;
}

#mydivheader {
    padding: 10px;
    cursor: move;
    font-size: 10px;
    z-index: 10;
    background-color: #2196F3;
    color: #fff;
}
/*start encabezado seccion carga archivo-->*/
th {
    text-align: center;
    width: 38%;
    /*padding-left: 10px;*/
}
/*<--end*/

/*#DocumentolistadoUrl {*/
    /*padding-left: 15%;*/
    /* text-align: center; */
/*}*/
.fileinput-button {
    /*padding-left: 33%;*/
     text-align: center;
     height: 3%;
}
.form-group {
    /*margin-bottom: 15px;*/
    text-align: center;
}
table {
    background-color: blanchedalmond;
}
table {
    background-color: blanchedalmond;
    width: 100%;
}
td, th {
    padding: 0;
    text-align: center;
}
tbody {
/*  border: black 2px solid;*/
  width: 100%;
}
.btn-info:focus {
    background-color: #2786c5!important;
    border-color: #6FB3E0;
}

/*.btn_agregar {
    border-radius: 3px;
    border: 3px #49986d solid;
    height: 44px;
    background-color: #87B87F!important;
    border-color: #87B87F;
}*/

.btn_agregar{
    background-color: #6FB3E0!important;
    border-color: #87B87F;
    border-radius: 3px;
    border: 3px #49986d solid;
    height: 44px;
    border-radius: 5px;
    border: 3px #3399cc solid;
    color: white;
    font-size: 15px;
    width: 70%
}


</style> 	
		    
  </head>
    <body>
 
<!-- Draggable DIV -->


<div class="accordion" id="accordionExample">


    
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h5 class="mb-0">
        <button id="btnMostrarOcultar" class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            <div id="textoMostrar_o_Ocultar_Menu"> Ocultar</div>
        </button>
      </h5>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
          
          <div style="height: 35px;">
          <div id="toolbarObj"></div>
          </div>
          <!--<div>-->

<!--	<input value="deshacer" type="button" onclick='gantt.undo()' style='font-size: 10px'>
	<input value="Rehacer" type="button" onclick='gantt.redo()' style='font-size: 10px'>-->
          </div>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">
          
      </div>
    </div>
  </div>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">
          
<div id="mydiv">
  <!-- Include a header DIV with the same name as the draggable DIV, followed by "header" -->
  
  <div  class="configtable" id="detallesInformacion" >
                <div id="mydivheader" style="position: absolute">Click Para Mover</div>   
                <!--<div class="" id="tree-list"  >-->
                    <div id="dx" ></div>
                                      <!--</div>-->
  </div>
</div>  
      </div>
    </div>
  </div>
</div>                 
      </div>
    </div>
  </div>



 <div class="" id="gantt_here" style='width: 100%;height: 95%;position: absolute'> 
 </div>

 
 
 
    
<script>
//Make the DIV element draggagle:
dragElement(document.getElementById("mydiv"));

function dragElement(elmnt) {
  var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
  if (document.getElementById(elmnt.id + "header")) {
    /* if present, the header is where you move the DIV from:*/
    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
  } else {
    /* otherwise, move the DIV from anywhere inside the DIV:*/
    elmnt.onmousedown = dragMouseDown;
  }

  function dragMouseDown(e) {
    e = e || window.event;
    e.preventDefault();
    // get the mouse cursor position at startup:
    pos3 = e.clientX;
    pos4 = e.clientY;
    document.onmouseup = closeDragElement;
    // call a function whenever the cursor moves:
    document.onmousemove = elementDrag;
  }

  function elementDrag(e) {
    e = e || window.event;
    e.preventDefault();
    // calculate the new cursor position:
    pos1 = pos3 - e.clientX;
    pos2 = pos4 - e.clientY;
    pos3 = e.clientX;
    pos4 = e.clientY;
    // set the element's new position:
    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
  }

  function closeDragElement() {
    /* stop moving when mouse button is released:*/
    document.onmouseup = null;
    document.onmousemove = null;
  }
}
</script>

  
    
<!-- Inicio de Seccion Modal Archivos-->
<div class="modal draggable fade" id="create-itemUrls" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lgfile" role="document">
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
                                <button type="submit" id="subirArchivos"  class="btn_agregar">Adjuntar Archivo</button>
                        </div>
                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->    
    
    
<!-- Inicio de Seccion Modal Informe-->
<div class="modal draggable fade" id="detalles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
            <div id="loaderModalMostrar"></div>
		<div class="modal-content">
                        
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="font-size:inherit" aria-hidden="true" class="closeLetra">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Detalles</h4>
		      </div>

		      <div class="modal-body">
                    
                           <!--<div id="tree-list">-->
<!--                             <div id="dx"></div>-->
                            <!--</div>-->
                          <div id="tabPanel"></div>
                                <!--<div sty></div>-->
                        <!--<div id=""></div>-->
                      </div><!-- cierre div class-body -->
                </div><!-- cierre div class modal-content -->
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->




    
<!-- Inicio de Seccion Modal Informe-->
<div class="modal draggable fade" id="edicionNotas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog modal-lg" role="document">
            <div id="loaderModalMostrar"></div>
		<div class="modal-content">
                        
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span style="font-size:inherit" aria-hidden="true" class="closeLetra">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Notas</h4>
		      </div>

		      <div class="modal-body">
                        <div id="seccionNotas" style="">


                        </div>
                       </div>
<!--                     <div id="seccionNotas" style="">


                        </div>-->
                          
                </div><!-- cierre div class modal-content -->
                <!--<button id="btnenviarnotas" class="btn btn-info">Enviar Nota</button>-->
                
                
        </div><!-- cierre div class="modal-dialog" -->
</div><!-- cierre del modal -->











  <script type="text/javascript">  
  var dxtreeList;
   
  
  
//empieza para definir como mostrar las tareas si por dia,semana,mes,año
	function setScaleConfig(value) {
		switch (value) {
			case "1":
				gantt.config.scale_unit = "day";
				gantt.config.step = 1;
				gantt.config.date_scale = "%d %M";
				gantt.config.subscales = [];
				gantt.config.scale_height = 27;
				gantt.templates.date_scale = null;
				break;
			case "2":
				var weekScaleTemplate = function (date) {
					var dateToStr = gantt.date.date_to_str("%d %M");
					var startDate = gantt.date.week_start(new Date(date));
					var endDate = gantt.date.add(gantt.date.add(startDate, 1, "week"), -1, "day");
					return dateToStr(startDate) + " - " + dateToStr(endDate);
				};

				gantt.config.scale_unit = "week";
				gantt.config.step = 1;
				gantt.templates.date_scale = weekScaleTemplate;
//				gantt.config.subscales = [
//					{unit: "day", step: 1, date: "%D"}
//				];
                                gantt.config.subscales = [
					{unit: "week", step: 1, date: "%j"}
				];
				gantt.config.scale_height = 50;
				break;
			case "3":
				gantt.config.scale_unit = "month";
				gantt.config.date_scale = "%F, %Y";
//				gantt.config.subscales = [
//					{unit: "day", step: 1, date: "%j, %D"}
//				];
                                
                                
                                gantt.config.subscales = [
					{unit: "month", step: 1, date: "%M"}
				];
                                
                                
				gantt.config.scale_height = 50;
				gantt.templates.date_scale = null;
				break;
			case "4":
				gantt.config.scale_unit = "year";
				gantt.config.step = 1;
				gantt.config.date_scale = "%Y";
				gantt.config.min_column_width = 50;

				gantt.config.scale_height = 90;
				gantt.templates.date_scale = null;


				gantt.config.subscales = [
					{unit: "month", step: 1, date: "%M"}
				];
				break;
		}
	}
setScaleConfig('1');

//termina de definir si sera por dia,semana,mes ,año que se mostrara las tareas

//empieza para darle tamaño pantalla completa 
//termina para darle tamaño pantalla completa

	function showGroups(listname) {
//            alert("c");
var listResponsables_con_tareas_asignadas=[];
var listTemporalResponsables=gantt.serverList(listname);
var listaLocalOficialResponsables=[];
var existeResponsableIngresado=false;

var banderaIngresarElPrimerResponsable=true;
            console.log("gan  ",gantt);
           
            gantt.eachTask(function (task) {
                            console.log("e",task);
//                             listResponsables_con_tareas_asignadas.push({key:value.id_empleado,label:value.nombre_completo});
                            $.each(listTemporalResponsables,function (index,value){
                              if(task.user==value["key"]){
                                        if(banderaIngresarElPrimerResponsable==true)
                                             listaLocalOficialResponsables.push({key:value.key,label:value.label});
                                         
                                    $.each(listaLocalOficialResponsables,function(index,value){
                                        if(task.user==value["key"]){
                                            existeResponsableIngresado=true;
                                        }
                                    })
                                      if(banderaIngresarElPrimerResponsable==false){
                                        if(existeResponsableIngresado==false){
                                             listaLocalOficialResponsables.push({key:value.key,label:value.label});
                                        }
                                    }
                                        banderaIngresarElPrimerResponsable=false;
                                        existeResponsableIngresado=false;
//                                      listaLocalOficialResponsables.push({key:value.key,label:value.label});
                                    }  
                            })
                                    
                            })

            
//            console.log("datos ",gantt.serverList(listname));
		if (listname) {
			gantt.groupBy({
				groups:listaLocalOficialResponsables ,
				relation_property: listname,
				group_id: "key",
				group_text: "label"
			});
			gantt.sort("start_date");
		} else {
			gantt.groupBy(false);

		}
	}
        





	(function dynamicTaskType() {
		var delTaskParent;

		function checkParents(id) {
			setTaskType(id);
                        
			var parent = gantt.getParent(id);
			if (parent != gantt.config.root_id) {
				checkParents(parent);
			}
		}

		function setTaskType(id) {
                
			id = id.id ? id.id : id;
			var task = gantt.getTask(id);
			var type = gantt.hasChild(task.id) ? gantt.config.types.project : gantt.config.types.task;
			if (type != task.type) {
				task.type = type;
				gantt.updateTask(id);
			}
		}

		gantt.attachEvent("onParse", function () {
			gantt.eachTask(function (task) {
				setTaskType(task);
			});
//                        gantt.updateTask(id)
		});

		gantt.attachEvent("onAfterTaskAdd", function onAfterTaskAdd(id) {
			gantt.batchUpdate(checkParents(id));
		});

		gantt.attachEvent("onBeforeTaskDelete", function onBeforeTaskDelete(id, task) {
//			alert("antes");
//                       gantt.refreshData();
                        delTaskParent = gantt.getParent(id);
                      
                       var desc=false;
                        $.ajax({
                                url:"../Controller/GanttTareasController.php?Op=descendencia&deleteidtarea="+id,
                                async:false,
                                success:function (res)
                                {
                                 
                                    if(res==true){                                        
                                         desc=false;
                                    }else{
                                        if(res==false){
                                             desc=true;
                                    }
                                    }
                                }
                              });
			return desc;
		});

		gantt.attachEvent("onAfterTaskDelete", function onAfterTaskDelete(id, task) {
                             $.ajax({
                                url:"../Controller/GanttTareasController.php?Op=EliminarTarea&deleteidtarea="+id,
                                success:function (res){

                                }
           
                              });
                                 
                                if (delTaskParent != gantt.config.root_id) {
				gantt.batchUpdate(checkParents(delTaskParent));       
                         }
		});
	})();            
      	(function dynamicProgress() {

		function calculateSummaryProgress(task) {
			if (task.type != gantt.config.types.project){
				return task.progress;
                            }
			var totalToDo = 0;
			var totalDone = 0;
			gantt.eachTask(function (child) {
				if (child.type != gantt.config.types.project) {
                                    
//					totalToDo += child.duration;
                                          totalToDo += (child.porcentaje_por_actividad/100);
//					totalDone += (child.progress || 0) * child.duration;
                                          totalDone += (child.progress || 0) * (child.porcentaje_por_actividad/100);
				}
			}, task.id);
			if (!totalToDo) return 0;
			else return totalDone / totalToDo;
                        
		}

		function refreshSummaryProgress(id, submit) {
			if (!gantt.isTaskExists(id)){
				return;
                            }

			var task = gantt.getTask(id);
			task.progress = calculateSummaryProgress(task);
			if (!submit) {
				gantt.refreshTask(id);
			} else {
				gantt.updateTask(id);
			}

			if (!submit && gantt.getParent(id) !== gantt.config.root_id) {
				refreshSummaryProgress(gantt.getParent(id), submit);
			}
		}
                
		gantt.attachEvent("onParse", function () {          
                   
			gantt.eachTask(function (task) {
				task.progress = calculateSummaryProgress(task);
			});
		});
		gantt.attachEvent("onAfterTaskUpdate", function (id,item) {

                    if(item.progress==1){
                        gantt.getTask(id).readonly = true;
                        gantt.getTask(id).status = 3;
                    }
                    
//                    if(item.status==2){
////                        gantt.getTask(id).readonly = true;
//                    }

                    if(item.status==3){
                        gantt.getTask(id).readonly = true;
                        gantt.getTask(id).progress = 1;
//                        gantt.getTask(id).status = 3;

                    }
                    
                   
//                    if(banderaPrincipioCheckeoParent){
//                        
//                        if(item.parent==0){
//                            if(item.user){
//                                
//                            }
//                             elpadrecoincideConElUsuarioLogeado
//                        }
                       if(item.$level==0){
//                           console.log(item);
                          
                         if(item.manipulacion_tarea=="false"){
                             if(item.user=="0"){
//                               alert();
                                  gantt.getTask(id).readonly = false;
                           }else{
                              gantt.getTask(id).readonly = true;
                           }
                              
                         }else{
                             elpadrecoincideConElUsuarioLogeado=true;
                         }
                             
                           
                       }
                       else{
//                           alert("else");
                            if(item.manipulacion_tarea=="false"){
                               
                                if(elpadrecoincideConElUsuarioLogeado==false){
                                      gantt.getTask(id).readonly = true;
                                        
                                }else{
                                    if(item.user==0){
                                        gantt.getTask(id).readonly = false;
                                      }else{
//                                          gantt.getTask(id).readonly = true;
                                      }
                                    
                                }
                              
                                
                              
                         }
                       }
                       
                       
//                        if(item.manipulacion_tarea=="false"){
//                            gantt.getTask(id).readonly = true;
//                        }
                        
//                        console.log(gantt.getTaskTop(id));
//                        console.log(gantt);
                    
//                    alert();
                    console.log(item)
                    
//                    if(item.manipulacion_tarea=="false"){
//                        alert();
//                          gantt.getTask(id).readonly = true;
//                    }
//                    if(item.status==2){
//                        gantt.getTask(id).readonly = true;
//                        gantt.getTask(id).progress = 1;
//                        gantt.getTask(id).status = 3;

//                    }
                    
//                    console.log("entro en ");
                    
                    
//			gantt.updateTask(id)
                    
                    
//                    console.log(gantt.getTask(id));
			refreshSummaryProgress(gantt.getParent(id), true);
		});

		gantt.attachEvent("onTaskDrag", function (id) {
			refreshSummaryProgress(gantt.getParent(id), false);
		});
		gantt.attachEvent("onAfterTaskAdd", function (id) {
			refreshSummaryProgress(gantt.getParent(id), true);
		});

		(function () {
			var idParentBeforeDeleteTask = 0;
			gantt.attachEvent("onBeforeTaskDelete", function (id) {
				idParentBeforeDeleteTask = gantt.getParent(id);
			});
			gantt.attachEvent("onAfterTaskDelete", function () {
				refreshSummaryProgress(idParentBeforeDeleteTask, true);
			});
		})();
	})();
        
//esta seccion es cuando abre seleccionas la tarea con click  te trae la informacion de esa tarea--->
        gantt.attachEvent("onBeforeLightbox", function(id) {
//console.log(gantt.getTask(id));
            var task = gantt.getTask(id);
//            if (task.progress == 1) {
//			gantt.message({text: "La tarea esta completada", type: "completed"});
//			return false;
//		}
//            var task;
            task.my_template ="<span id='title2'>Progreso: </span>"+Math.round(task.progress*100) +" %";
            return true;
           
        });
 //<----

        
        gantt.templates.grid_row_class =
		gantt.templates.task_row_class = function (start, end, task) {
//                    console.log("entro");
			if (task.$virtual)
				return "summary-row"
		};
//        console.log(gantt.templates);



            gantt.templates.progress_text = function (start, end, task) {
//        if(Math.round(task.progress * 100)==100){
//            $(".gantt_task_line.gantt_dependent_task .gantt_task_progress ").css("background-color","red");
//        }
//                $("#taskid").css("background-color:","red");
//		return "<span style='text-align:left;'>" + Math.round(task.progress * 100) + "% </span>";
                return "";
            };
            
//            gantt.templates.rightside_text = function (start, end, task) {
//		return "ID: #" + task.id;
//            };

//            gantt.templates.leftside_text = function (start, end, task) {
//                    return task.duration + " dias";
//            };
            
            

gantt.templates.task_class = function (start, end, task) {
		if(task.type == gantt.config.types.project){
//                    console.log("entro ");
			return "hide_project_progress_drag";
                }
                if (task.$virtual)
			return "summary-bar";
                
//                if(task.status == 2){
////                    console.log("entro ");
//			return "hide_project_progress_drag";
//                }
//                console.log(task);
                if(task.status==3){
                    return "completed_task";
                }
//                si es igual a suspendido
                if(task.status==2){
//                    alert("d");
                    return "task_suspendida";
                }
                
                
                    if(task.progress==1){
                        return "completed_task";
                    }else{
                        return "";
                    }
                
	};
        
        gantt.templates.task_text=function (t,e,task) {
            
             var taskLocal = gantt.getTask(task.id);
      
//            if(task.type != gantt.config.types.project){
//                if(task.status==1)
//                taskLocal ="<span id='title2'><div class='text_tarea_terminada_Azul'>"+Math.round(task.progress*100) +" % </div>"+"</span>";
//                if(task.status==2)
//                taskLocal ="<span id='title2'><div class='text_tarea_suspendida_amarilla'>"+Math.round(task.progress*100) +" % </div>"+"</span>"; 
                if(task.status==3){
                    taskLocal ="<span id='title2'><div class='text_tarea_terminada_Azul'>"+Math.round(task.progress*100) +" % </div>"+"</span>";
                    return taskLocal;
                 }
//            }else{
                  if(task.progress==undefined){
                   taskLocal ="<span id='title2'></span>0 %";
                    return taskLocal; 
                  }
                  taskLocal ="<span id='title2'></span>"+Math.round(task.progress*100) +" %";
                  return taskLocal; 
//            }
        }
     gantt.templates.tooltip_text = function(start,end,task){
  	if(task.type == gantt.config.types.project){
            return "Tarea Principal:"+task.text;
        }
  
        return "<b>Tarea:</b> "+task.text+"<br/><b>Start date:</b> " + 
        gantt.templates.tooltip_date_format(start)+ 
        "<br/><b>End date:</b> "+gantt.templates.tooltip_date_format(end);
    };   
        
        
        
     var dataEmpleados=[];
//     var data
        obtenerEmpleados();
        gantt.serverList("user",dataEmpleados); 

	gantt.locale.labels.column_owner ="Responsable";
        gantt.locale.labels.section_owner = "Responsable";
        
        gantt.locale.labels.section_statusname="Estatus";
        gantt.locale.labels.column_statusname="Estatus";
        gantt.locale.labels.section_notas="Notas";
        
        
        gantt.locale.labels.section_template = "Detalles"
        
        gantt.config.scale_height = 50;
        gantt.config.order_branch = true;
        
        gantt.config.branch_loading = true;
        gantt.config.order_branch_free = true;


        	gantt.config.open_tree_initially = true;
//        	para cerrar las carpetas por default desde el principio

	function byId(list, id) {
		for (var i = 0; i < list.length; i++) {
			if (list[i].key == id)
				return list[i].label || "";
		}
		return "";
	}
        
 var responsableQueTienenTareas=[];
 var textEditor = {type: "text", map_to: "text"};   
gantt.config.columns=[
//    {name:"id",   label:"id",   align:"center"},
		{name: "text", label: "Descripcion", tree: true,resize: true,
                        template: function (item) {
//                            console.log("datos de text ",item);
                            if(item.progress==undefined){
                                
//                                responsableQueTienenTareas.push({item.user});
                                      item.tiene_tareas_asignadas="no"
                                      return item.text;
                                }else{
                                      item.tiene_tareas_asignadas="si"
                                    return item.text;
                                }
                            
                           
                        }
                },
                {
			name: "progress", label: "Progreso", width: '*', align: "center",resize: true,
			template: function (item) {
				if (item.progress >= 1)
					return "Completa";
				if (item.progress == 0)
					return "No Iniciada";
                                if(item.progress==undefined){
                                    return "";
                                }
//                                console.log(item);
                                
				return Math.round(item.progress * 100) + "%";
			}
		},
		{
			name: "status", label: "Estatus", width: '*', align: "center",resize: true,
			template: function (item) {
                                if (item.status == undefined)
                                    return "";
				if (item.status == 1)
					return "En Proceso";
				if (item.status == 2)
					return "Suspendido";
                                if(item.status==3)
                                        return  "Terminado";
                                    return "En Proceso";
			}
		},
		{
                    name: "owner", width: '*', align: "center",resize: true, template: function (item) {
				return byId(dataEmpleados, item.user);
                    }
		},
                
                
                
                {name: "start_date", label: "Fecha de Inicio",
                        template: function (item) {
//                            console.log("datos de text ",item);
                            if(item.progress==undefined){
//                                      return "sin fecha";
                                       return item.start_date;
                                }else{
                                    return item.start_date;
                                }
                            
                           
                        } 
                },
//                {name: "status", label: "Status",resize: true},
		{name: "add", width: 40}
	];
//console.log(gantt);

//var status=[];
var opcionstatus=[
    { key: 1, label: 'En Proceso' },
    { key: 2, label: 'Suspendido' },
    { key: 3, label: 'Terminado'}
];


        gantt.locale.labels["section_progress"] = "Progreso";
        gantt.locale.labels["section_notificacion_porcentaje_programado"] = "Alerta por Avance";
        gantt.locale.labels["section_parent"] = "Seleccione Tarea Padre";
        gantt.config.lightbox.sections = [
		{name: "description", height: 38, map_to: "text", type: "textarea", focus: true},
                {name: "statusname", height: 38, map_to: "status", type: "select", options:opcionstatus},
//                {name: "notas", height: 38, map_to: "notas", type: "textarea"},
		{name: "owner", height: 33, map_to: "user", type: "select", options:dataEmpleados},
                  {
			name: "notificacion_porcentaje_programado", height: 33, map_to: "notificacion_porcentaje_programado", type: "select", options: [
                                {key: "-1", label: "Seleccione el Porcentaje"},
				{key: "50", label: "50%"},
				{key: "60", label: "60%"},
				{key: "70", label: "70%"},
				{key: "80", label: "80%"},
				{key: "90", label: "90%"}
			]
		},
//                {
//			name: "progress", height: 33, map_to: "progress", type: "select", options: [
//				{key: "0", label: "No Iniciada"},
//				{key: "0.1", label: "10%"},
//				{key: "0.2", label: "20%"},
//				{key: "0.3", label: "30%"},
//				{key: "0.4", label: "40%"},
//				{key: "0.5", label: "50%"},
//				{key: "0.6", label: "60%"},
//				{key: "0.7", label: "70%"},
//				{key: "0.8", label: "80%"},
//				{key: "0.9", label: "90%"},
//				{key: "1", label: "Completa"}
//			]
//		},
                 {name:"template", height:16, type:"template", map_to:"my_template"}, 
		{name: "time",  height: 50, type: "duration", map_to: "auto"}
	];




	var weekScaleTemplate = function (date) {
		var dateToStr = gantt.date.date_to_str("%d %M");
		var endDate = gantt.date.add(gantt.date.add(date, 1, "week"), -1, "day");
		return dateToStr(date) + " - " + dateToStr(endDate);
	};
gantt.config.subscales = [
//		{unit: "week", step: 1, template: weekScaleTemplate},
		{unit: "day", step: 1, date: "%j, %D"}
	];

//inicia para expandir o colapsar


//        termina para expandir o colapsar

gantt.config.scale_unit = "month";
gantt.config.step = 1;
gantt.config.date_scale = "%F, %Y";
//antt.config.date_grid = "%m/%d/%Y";
gantt.config.min_column_width = 50;
gantt.config.order_branch = true;
gantt.config.order_branch_free = true;
gantt.config.branch_loading = true;
gantt.config.fit_tasks = true; 
gantt.config.work_time = false;
gantt.config.auto_scheduling = true;
gantt.config.autosize=false; 
gantt.config.grid_width = 680;



gantt.config.autoscroll = true;
gantt.config.auto_scheduling_strict = true;

gantt.config.sort = true;
//gantt.config.readonly = true;
gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";



    gantt.init("gantt_here");
    gantt.load("../Controller/GanttTareasController.php?Op=ListarTodasLasTareasPorId");


var dp = new gantt.dataProcessor("../Controller/GanttTareasController.php?Op=Modificar");
dp.init(gantt);




    function obtenerEmpleados(){     
        $.ajax({
//           url:"../Controller/GanttController.php?Op=ListarEmpleados",
            url:"../Controller/GanttTareasController.php?Op=empleadosNombreCompleto",
//           url:"../Controller/EmpleadosController.php?Op=nombresCompletos",
           data:"",
           async:false,
           success:function (res){
               
               $.each(res,function(index,value){
//                   dataEmpleados.push({key:value.id_empleado,label:value.nombre_empleado});
                   dataEmpleados.push({key:value.id_empleado,label:value.nombre_completo});
             });
           }
           
        });
    }

        

    var datosTreeList=[]; 
    var ventana_detalles_abierta=false;
    var banderaPrincipioCheckeoParent=true;
    var elpadrecoincideConElUsuarioLogeado=false;
    var mostrar_ocultar_menu=true;
    $(function (){
        
      $("#btnMostrarOcultar").click(function(){
     
         if(mostrar_ocultar_menu==true){
             $("#textoMostrar_o_Ocultar_Menu").html("Ocultar");
             mostrar_ocultar_menu=false;
         }else{
             if(mostrar_ocultar_menu==false){
                 $("#textoMostrar_o_Ocultar_Menu").html("Mostrar");
                 mostrar_ocultar_menu=true;
             }
         }
         
         
      });
       $("#btnMostrarOcultar").trigger("click");
      
      
      
      
//      var db = firebase.database();  
//       db.ref('notasgantttareas-temas').on('child_added', function(data){
//            console.log(data.val());
//       });
      
      
      
      
//       $('#btnenviarnotas').on('click', function(){
//            console.log("Funciona!");
//            var notas=$("#notas").val();
//            console.log(notas);
////            set es para actualizar
//            db.ref('notasgantttareas-temas').push({
//             id:"2536253625",
//             id_padre_de_todas_las_tareas_de_gantt:"2",
//             notas:notas,
//             origendequegantt:"temas",
//             responsable:"2"
//            });
//            
//        });
        
        
       cargarMenuArriba();
        var myToolbar;
		function cargarMenuArriba() {
			myToolbar = new dhtmlXToolbarObject({
				parent: "toolbarObj",
				icons_path: "../../images/base/"
			});    

                        myToolbar.addButton("detalles", 3, "Detalles", "File_Table.png", "save_dis.gif");
                         myToolbar.addButton("notas", 3, "Notas", "registrarTareas.png", "save_dis.gif");
                         myToolbar.addButton("refresh", 3, "Recargar", "refresh.png");
			myToolbar.addSeparator("sep1", 3);
                        
                        var agrupacionesCampos=Array(	Array('agrupar_descripcion', 'obj', 'Descripcion', '661.png'),
						Array('agrupar_responsables','obj', 'Responsables' , '659.png'));
                        
                        myToolbar.addButtonSelect("agrupar_descripcion", 13, "Filtrar", agrupacionesCampos, "691.png");

			myToolbar.addSeparator("sep3", 8);
                        var visualizacionBarras=Array(	Array('tiempodia', 'obj', 'Dia', '663.png'),
						Array('tiemposemana','obj', 'Semana' , '663.png'),
                                                Array('tiempomes','obj', 'Mes' , '663.png'),
                                                Array('tiempoaño','obj', 'Año' , '663.png'));
                        
                        
                        myToolbar.addButtonSelect("visualizacionTiempo", 13, "Periodo de visualizacion", visualizacionBarras, "670.png");
                        
                        myToolbar.addSeparator("sep4", 8);
                        
                        var printOpts = [	['exportar_excel', 'obj', 'Excel', '_excel.png'],
						['exportar_pdf','obj', 'Pdf' , 'pdf.png'],
						['exportar_png',  'obj', 'Png'  , 'image.png']
                                        ];
//						Array('print_cfg',  'obj', 'MS Proyect'   , ''));
			console.log(printOpts);
			myToolbar.addButtonSelect("exportar", 13, "Exportar", printOpts, "descargar.png");
                   
                        myToolbar.addSeparator("sep5", 8);                     
                          
                                  
                        
//                        obtenerDescripcionDEnDondeSeEstanCargandoLasTareas().then(function (){
                                myToolbar.addButton("descripcion", 8, "<?php echo $dataGanttDescripcion; ?>", "infodescripciongantt.png");
//                        })
                        
			
                }
                
                myToolbar.attachEvent("onClick", function(id){
//                       console.log(id);
                       switch(id){
                           case "detalles":
                               
                               if(ventana_detalles_abierta==false){
                                    $("#multiCollapseExample2").show();
                                    ventana_detalles_abierta=true;
                                }
                                else{
                                     if(ventana_detalles_abierta==true){
                                        $("#multiCollapseExample2").hide();
                                        ventana_detalles_abierta=false;
                                     }
                                }
                           break;
                           case "notas":
                                $('#edicionNotas').draggable();
//                                window.open("Ganttnotastipochat.php",'_blank');
                                 $('#edicionNotas').modal({
                                    show: 'true'
                                 });
//                                 $("#seccionNotas").load("Ganttnotastipochat.php");
                                    $("#seccionNotas").html('<iframe src="Ganttnotastipochat.php" width="100%" height="100%"></iframe>');
//                                   $("#sidebarObjV").load('InyectarVistasView.php #temas');
                                
                                
                           break;
                          
                           case "refresh":
                               refrescarDatosGantt();
                           break;
                           case "agrupar_descripcion":
                               showGroups();
                           break;
                           case "agrupar_responsables":
                               showGroups('user');
                           break;
                            case "tiempodia":
                                setScaleConfig("1");
                                gantt.render();
                                
                            break;
                             case "tiemposemana":
                                  setScaleConfig("2");
                                  gantt.render();
                            break;
                             case "tiempomes":
                                 setScaleConfig("3");
                                  gantt.render();
                            break;
                             case "tiempoaño":
                                 setScaleConfig("4");
                                  gantt.render();
                            break;
                            case "exportar_excel":
                                alert("g");
                            gantt.exportToExcel({
                                name:"document.xlsx", 
//                                columns:[
//                                    { id:"text",  header:"Descripcion", width:200 },
//                                    { id:"progress",  header:"Progreso", width:100 }
////                                    { id:"start_date",  header:"Fecha de Inicio", width:50, type:"date" }
//                                ],
                                server:"https://export.dhtmlx.com/gantt",
                                visual:true,
                                cellColors:true
                            });
//                            gantt.exportToExcel();
                            break;
                            case "exportar_pdf":
                                gantt.exportToPDF();
                            break;
                            case "exportar_png":
                                gantt.exportToPNG()
                            break;
                            case "exportar_MSProyect":
                                gantt.exportToMSProject();
                            break;
                           
                        }
                });
obtenerTareas().then(function (){
construirTreeList();

});




    })

    
    
    function obtenerTareas(){
        return new Promise(function (resolve,reject){
                id_tarea= <?php echo Session::getSesion("dataGantt_id_tarea")?>;
                URL = 'gantt/gantt_tareas/'+id_tarea+'/';
                $.ajax({
                                        url:"../Controller/GanttTareasController.php?Op=ListarTodasLasTareasDetallesPorSuId",
                                        type:"POST",
                                        data: 'URL='+URL+'&SIN_CONTRATO=',
                                        async:false,
                                        success:function (res)
                                        {
                                            datosTreeList=[];
                                            datosTreListTemp=[];
                                            
                                            $.each(res.data,function(index,value){
                                                console.log("Este es el value",value);
                                                datosTreeObj={};
                                                datosTreeObj["id"]= value.id;
                                                datosTreeObj["parent"]= value.parent;
                                                datosTreeObj["text"]= value.text;
                                                datosTreeObj["user"]= value.user;
//                                                datosTreeObj["notasname"]= value.notas;
                                                datosTreeObj["porcentaje_por_actividad"]= value.porcentaje_por_actividad;
                                                
//                                                 datosTreeObj["pt"]= "<input type='text' style=' width:100%;background:transparent !important;border:none'  name='porcentajexactividad' value='"+value.porcentaje_por_actividad+"' > ";
                                                
                                                datosTreeObj["ponderado_real"]= "value.ponderado_real";
                                                datosTreeObj["avance"]=Math.round(value.progress*100);
                                                if(value.archivosUpload[0].length==0)
                                                {
                                                    datosTreeObj["archivo_adjunto"]= "<button onClick='mostrar_urls("+value.id+")' type='button' class='btn btn-info botones_vista_tabla' data-toggle='modal' data-target='#create-itemUrls'>";
                                                    datosTreeObj["archivo_adjunto"] += "<i class='fa fa-cloud-upload' style='font-size: 20px'></i> Adjuntar - "+value.archivosUpload[0].length+"</button>";
                                                }else{
                                                    datosTreeObj["archivo_adjunto"]= "<button onClick='mostrar_urls("+value.id+")' type='button' class='btn btn-danger botones_vista_tabla2' data-toggle='modal' data-target='#create-itemUrls'>";
                                                    datosTreeObj["archivo_adjunto"] += "<i class='fa fa-cloud-upload' style='font-size: 20px'></i> Adjuntar - "+value.archivosUpload[0].length+"</button>";
                                                }
                                                
                                                datosTreeObj["status"]= value.status;
                                                datosTreListTemp.push(datosTreeObj);
                                                datosTreeList.push(datosTreeObj);
                                                
//                                                return datosTreListTemp
                                            });
                                         resolve(datosTreListTemp);
                                        }
                                      });
                                      
                                  })
        }  
  function construirTreeList(){
  console.log("empezo el contruir el tree list");
   dxtreeList= $("#dx").dxTreeList({
        dataSource: datosTreeList,
//        dataSource:{
//            load:function (options){
//                console.log("teiene options",options);
//                this.datasource.load=function (){
//                    return obtenerTareas();
//                }
//                return obtenerTareas();
//            }
//            
//        },
        keyExpr: "id",
//        parentIdExpr: "Head_ID",
         parentIdExpr: "parent",
        showRowLines: true,
        showBorders: true,
        autoExpandAll: false,
        allowColumnResizing: true,
//        columnAutoWidth: true,
        allowColumnReordering: true,
        height:700,
//        max-width:1500,
        columnChooser: {
        allowSearch: false,
        emptyPanelText: "Seleccionar Columna ",
        enabled: false,
        height: 360,
        mode: "dragAndDrop",
        searchTimeout: 500,
        title: "Columna A Ocultar",
        width: 100
        },
        columnResizingMode: "nextColumn",
        columnFixing: {
        enabled: false,
        texts: {
            fix: "Fix",
            leftPosition: "To the left",
            rightPosition: "To the right",
            unfix: "Unfix"
        },
        },
        editing: {
            mode: "cell",
            allowUpdating: true,
//            allowDeleting: false,
//            allowAdding: false
//            texts:{
//              editRow: "Editar",
//              saveRowChanges: "Guardar",
//              cancelRowChanges: "Cancelar",
//            }
        },
        filterRow: {
        applyFilter: "auto",
        applyFilterText: "Apply filter",
        betweenEndText: "End",
        betweenStartText: "Start",
        operationDescriptions: {
        between: "Between",
        contains: "Contains",
        endsWith: "Ends with",
        equal: "Equals",
        greaterThan: "Greater than",
        greaterThanOrEqual: "Greater than or equal to",
        lessThan: "Less than",
        lessThanOrEqual: "Less than or equal to",
        notContains: "Does not contain",
        notEqual: "Does not equal",
        startsWith: "Starts with"   
        },
        resetOperationText: "Reset",
        showAllText: "",
        showOperationChooser: true,
        visible: true
        },
        noDataText: "No Hay Datos",
        paging: {
            enabled: true,
            pageSize: 10
        },
        pager: {
        allowedPageSizes: null,
        infoText: "Pagina {0} de {1}",
        showInfo: true,
        showNavigationButtons: true,
        showPageSizeSelector: true,
        visible: true
        },
        searchPanel: {
        highlightCaseSensitive: false,
        highlightSearchText: true,
        placeholder: "Search...",
        searchVisibleColumnsOnly: false,
        text: "",
        visible: true,
        },
        loadPanel: {
        enabled: true,
        height: 90,
        indicatorSrc: "",
        showIndicator: true,
        showPane: true,
        text: "Loading...",
        },
        onRowClick:(args)=>{
            console.log("row click ",args);
        },
        onCellClick:(args)=>{
//            console.log("cell click ",args);
            
            
           console.log("la instancia de dxtreelist  ",dxtreeList);
        },
        onRowUpdated:function (args){
//            console.log(args);
//            if( args.data.hasOwnProperty('notasname') ) {
//                actualizarDeTablaDetalles("notas",args.data["notasname"],args.key);   
//            }
//            if( args.data.hasOwnProperty('user') ) {
//                actualizarDeTablaDetalles("user",args.data["user"],args.key);
//            }
//            if(args.data.hasOwnProperty('status')){
//                actualizarDeTablaDetalles("status",args.data["status"],args.key);
//            }
            if(args.data.hasOwnProperty('porcentaje_por_actividad')){
                saberSiSumanPorcentajePonderadoProgramado100loshijos(args);
            }    
        },
        columns:[
            {
                dataField: "id",
                caption: "ID",
                allowEditing:false,
            },
            {
                dataField: "text",
                caption: "Descripcion de la Tarea",
                allowEditing:false,
                width:500
            },
            
            { 
                dataField: "user",
                caption: "Responsable",
                allowEditing:false,
                lookup: {
                    dataSource:dataEmpleados,
                    valueExpr: "key",
                    displayExpr: "label"
                }
            },
            
            { 
                dataField: "porcentaje_por_actividad",
                caption: "Peso de la Actividad",
                allowEditing:true
            },
//            { 
//                dataField: "pt",
//                caption: "pt",
//                cellTemplate:ptCellTemplate,
//                allowEditing:false
//            },
             { 
                dataField: "avance",
                caption: "Avance (%)",
                allowEditing:false,
                width:80
            },
            { 
                dataField: "status",
                caption: "Estatus",
                allowEditing:false,
                lookup: {
                    dataSource:opcionstatus,
                    valueExpr: "key",
                    displayExpr: "label"
                }
            },
             { 
                dataField: "archivo_adjunto",
                 captbion: "Archivo Adjunto",
                cellTemplate:archivoAdjuntoCellTemplate,
                  allowEditing:false
                  
            }
        ],
//        ,
//        onCellPrepared: function(e) {
//            console.log(e);
//            if(e.column.command === "edit") {
//                e.cellElement.children(".dx-link-add").remove();
//            }
//        },
//        onEditorPreparing: function(e) {
//            console.log("pre");
//            console.log(e);
//            console.log("termine pre");
//            if(e.dataField === "parent" && e.row.data.id === 1) {
//                e.cancel = true;
//            }
//        },
//        onInitNewRow: function(e) {
//            e.data.parent = 1;
//        },
        expandedRowKeys: [1, 2, 3, 4, 5]
    });
    
    
    }
   var archivoAdjuntoCellTemplate= function(container, options) 
   {       
//       console.log(options);
      return container.context.innerHTML=options.data.archivo_adjunto;
   };
   var ptCellTemplate=function (container, options){
       console.log("con    ",container);
       
       
       
       
     return container.context.innerHTML=options.data.pt;  
   };
//console.log("ptcell  ",ptCellTemplate);

    function refrescarDatosGantt()
    {
        gantt.refreshData();
        gantt.init('gantt_here');
        obtenerTareas().then(function (){
            construirTreeList();
        });
//        $.when(gantt.load("../Controller/GanttTareasController.php?Op=ListarTodasLasTareasPorId")).then(function(){
//                
//                dxtreeList.context.location.reload(function (){
//                  console.log("re  ");  
//                });
//            obtenerTareas().then(function (){
//                construirTreeList();
//
//            });        
//        });
//                dxtreeList[0].datasource.load();
//    dxtreeList.context.onload=function(){
//    
//}
//dxtreeList.context.onload();
//        console.log("dxtree list  ",dxtreeList);
//    }
    }
    
    function refreshDetallesGantt(){
        obtenerTareas().then(function (){
            construirTreeList();
        });
    }
    function detallesActividadesCompletasGantt(){
        if( $("#detallesInformacion").css("display")!="none"){
                 $("#detallesInformacion").css("display","none");               
        }else{
            $("#detallesInformacion").css("display","");
        }
} 
    var datosModificadosActividadesPonderado_ProgramadoTemp=[];
    var id_padreTareaPonderado_programadoTemp=-1;
    function saberSiSumanPorcentajePonderadoProgramado100loshijos(args)
    {
        var bandera=1;
        var key = args.key;
        var sumatoria = 0;
        var dataFinal=[];
        $.each(datosTreeList,(index,value)=>
        {
            if(value.id == key)
            {
                if(value.parent != id_padreTareaPonderado_programadoTemp)
                {
                    datosModificadosActividadesPonderado_ProgramadoTemp=[];
                    id_padreTareaPonderado_programadoTemp = value.parent;
//                    console.log("reiniciado");
                }
            }
        });
            $.each(datosModificadosActividadesPonderado_ProgramadoTemp,(index,value)=>{
                if(value.key == key)
                {
                    datosModificadosActividadesPonderado_ProgramadoTemp[index] = args;
                    bandera=0;
                }
            });
        // }
        if(bandera==1)
            datosModificadosActividadesPonderado_ProgramadoTemp.push(args);
        
        $.each(datosTreeList,(index,value)=>
        {
            // console.log(value); 
            if(id_padreTareaPonderado_programadoTemp == value.parent)
            {
                sumatoria += parseFloat(value.porcentaje_por_actividad);
            }
            
        });
//        console.log(datosModificadosActividadesPonderado_ProgramadoTemp);
        if(sumatoria>=100 && sumatoria<=100.5)
        {
            alert("Correcto");
//            console.log(args);
//console.log(datosModificadosActividadesPonderado_ProgramadoTemp);
            $.each(datosModificadosActividadesPonderado_ProgramadoTemp,(index,value)=>{
                dataFinal.push({id:parseInt(value.key),ponderado_programado:value.data.porcentaje_por_actividad});
            });
            $.ajax({
                url:'../Controller/GanttTareasController.php?Op=GuardarPonderado',
                type:"POST",
                data: "DATA="+JSON.stringify(dataFinal),
                success:(res)=>
                {
                    if(typeof(res)=="number" && res==1)
                        alert("Modificado en la base de datos con "+parseFloat((sumatoria-100).toString().slice(0,4))+" de mas");
                    else
                        alert(res);
                },
                error:()=>
                {
                    console.log("Error en el servidor");
                }
            })
        }
        else
        {
            if(sumatoria<100){
                alert("El total es menor al 100% del ponderado de la tarea padre  su sumatoria es "+sumatoria +" y su restante es de "+(100-sumatoria)+" no se guardo ");
                
            }else
            alert("El total es mayor al 100% del ponderado de la tarea padre no se guardo ");
        }
    }
    
    
    
    function actualizarDeTablaDetalles(COLUMNA,VALUE,ID_TAREA){
//    console.log(data);
     $.ajax({
                url:'../Controller/GanttTareasController.php?Op=actualizardetabladetalles',
                type:"POST",
                data:"COLUMNA="+COLUMNA+"&VALUE="+VALUE+"&ID_TAREA="+ID_TAREA,
                success:(res)=>
                {
                   
                   
                   
                },
                error:()=>
                {
                    console.log("Error en el servidor");
                }
            })
    
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

    function mostrar_urls(id)
    {
            id_tarea= <?php echo Session::getSesion("dataGantt_id_tarea")?>;
            var tempDocumentolistadoUrl = "";
            URL = 'gantt/gantt_tareas/'+id_tarea+'/'+id;
            $.ajax({
                    url: '../Controller/ArchivoUploadController.php?Op=listarUrls',
                    type: 'GET',
                    data: 'URL='+URL+'&SIN_CONTRATO=',
                    success: function(todo)
                    {
                            if(todo[0].length!=0)
                            {
                                    tempDocumentolistadoUrl = "<table class='tbl-qa'><tr><th class='table-header' >Fecha de subida</th><th class='table-header'>Nombre</th><th class='table-header'>Opcion</th></tr><tbody>";
                                    $.each(todo[0], function (index,value)
                                    {
                                            nametmp = value.split("^-O-^-M-^-G-^");
                                            fecha = new Date(nametmp[0]*1000);
                                            fecha = fecha.getDate() +" "+ months[fecha.getMonth()] +" "+ fecha.getFullYear() +" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();

                                            tempDocumentolistadoUrl += "<tr class='table-row'><td>"+fecha+"</td><td>";
                                            tempDocumentolistadoUrl += "<a href=\""+todo[1]+"/"+value+"\" download='"+nametmp[1]+"'>"+nametmp[1]+"</a></td>";
                                            tempDocumentolistadoUrl += "<td><button style=\"font-size:x-large;color:#39c;background:transparent;border:none;\"";
                                            tempDocumentolistadoUrl += "onclick='borrarArchivo(\""+URL+"/"+value+"\");'>";
                                            tempDocumentolistadoUrl += "<i class=\"fa fa-trash\"></i></button></td></tr>";
                                    });
                                    tempDocumentolistadoUrl += "</tbody></table>";
                            }
                            if(tempDocumentolistadoUrl == " ")
                            {
                                    tempDocumentolistadoUrl = " No hay archivos agregados ";
                            }
                            tempDocumentolistadoUrl = tempDocumentolistadoUrl + "<br><input id='tempInputIdDocumento' type='text' style='display:none;' value='"+id+"'>";
                            // alert(tempDocumentolistadoUrl);
                            $('#DocumentoEntradaAgregarModal').html(" ");
                            $('#DocumentolistadoUrlModal').html(ModalCargaArchivo);
                            $('#DocumentolistadoUrl').html(tempDocumentolistadoUrl);
                            // $('#fileupload').fileupload();
                            $('#fileupload').fileupload({
                            url: '../View/',
                            });
                    }
            });
    }
    
    
    function agregarArchivosUrl()
    {
            id_tarea= <?php echo Session::getSesion("dataGantt_id_tarea")?>;
            var ID = $('#tempInputIdDocumento').val();
            url = 'gantt/gantt_tareas/'+id_tarea+'/'+ID,
            $.ajax({
                    url: "../Controller/ArchivoUploadController.php?Op=CrearUrl",
                    type: 'GET',
                    data: 'URL='+url+'&SIN_CONTRATO=',
                    success:function(creado)
                    {
                            if(creado==true)
                                    $('.start').click();
                    },
                    error:function()
                    {
                            swalError("Error del servidor");
                    }
            });
    }
    
    
    function borrarArchivo(url)
    {

        swal({
                title: "ELIMINAR",
                text: "Confirme para eliminar el Archivo",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: false,
                showLoaderOnConfirm: true
                }, function()
                {
                        var ID = $('#tempInputIdDocumento').val();
                        $.ajax({
                                url: "../Controller/ArchivoUploadController.php?Op=EliminarArchivo",
                                type: 'GET',
                                data: 'URL='+url+'&SIN_CONTRATO=',
                                success: function(eliminado)
                                {
                                        // eliminar = eliminado;
                                        if(eliminado)
                                        {
                                                mostrar_urls(ID);
//                                                refresh();
                                                swal("","Archivo eliminado");
                                                setTimeout(function(){swal.close();},1000);
                                        }
                                        else
                                                swal("","Ocurrio un error al eliminar el archivo", "error");
                                },
                                error:function()
                                {
                                        swal("","Ocurrio un error al elimiar el archivo", "error");
                                }
                        });
                });
    }

    
  </script>
  
  
  
<!--<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>-->
<script>
  // Initialize Firebase
//  var config = {
//    apiKey: "AIzaSyAhszpIRh8BBXtzSbu1yhGziYX-uT5pPak",
//    authDomain: "notasgantttareas-temas.firebaseapp.com",
//    databaseURL: "https://notasgantttareas-temas.firebaseio.com",
//    projectId: "notasgantttareas-temas",
//    storageBucket: "notasgantttareas-temas.appspot.com",
//    messagingSenderId: "1061411526028"
//  };
//  firebase.initializeApp(config);
</script>
  
  
  
  
  
  
  
    </body> 
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
        {% if(t == 1){ if( $('#tempInputIdDocumento').length > 0 ) { var ID = $('#tempInputIdDocumento').val(); mostrar_urls(ID);}else{ $('#btnAgregarDocumentoEntradaRefrescar').click(); } } %}
</script>

    <!--Para abrir alertas de aviso, success,warning, error-->       
    <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>
  
    
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
  
  
</html>
