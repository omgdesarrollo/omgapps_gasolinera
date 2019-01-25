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
        <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

        <script src="../../js/jquery.js" type="text/javascript"></script>

        <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/>
        <!--<link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
        <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
        <link href="../../assets/dhtmlxSuite_v51_std/skins/web/dhtmlx.css" rel="stylesheet" type="text/css"/>
       
        
        
        <!--<script src="../../js/tools.js" type="text/javascript"></script>-->
      
        <script src="../../js/dhtmlxExtGrid.js" type="text/javascript"></script>
        <script src="../../js/dhtmlxFunctions.js" type="text/javascript"></script>
        <script src="../../js/dhtmlxdataprocessor.js" type="text/javascript"></script>
        <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
        
        <style>
            div#sidebarObj {
                    position: relative;
                    margin-left: 10px;
                    margin-top: 10px;
                    width: 900px;
                    height: 350px;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
            }
            div#layout_here {
            position: relative;
            width: 100%;
            height: 392px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
            /*margin: 0 auto;*/
            }

            div#treeboxbox_tree{
               height: 300px;
               box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
            }
            div#treeboxbox_treeIzquierda{
               height: 300px;
               box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
            }  
            .altotablascrollbar{
                     height: 320px;
                }   

            </style>    
                                               

	</head>

<body class="no-skin" >
    
<?php
    require_once 'EncabezadoUsuarioView.php';
?>

<!--Modal Requisitos-->    
<div class="modal draggable fade" id="create-itemRequisito" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
               <div class="modal-dialog" role="document">
                 <div class="modal-content">
                   <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
                       <h4 class="modal-title" id="myModalLabel">Crear Nuevo Requisito</h4>
                   </div>

                   <div class="modal-body">
                       <!--<form id="formRequisitos">-->

                                             <div class="form-group">
                                                     <label class="control-label" for="title">Requisito</label>
                                                     <textarea  id="REQUISITO" class="form-control" data-error="Ingrese la Descripcion del Sub-Tema" required></textarea>
                                                     <div class="help-block with-errors"></div>
                                             </div>

                                             <div class="form-group" style="display:none">
                                                 <div class="input-group">
                                                     <span style="border:none;background-color:transparent;" class="input-group-addon">Con Penalizacion</span>
                                                     <input type="checkbox" style="width: 40px; height: 40px" class="checkbox" id="checkPenalizado">

                                                 </div>							
                                             </div>    

                                             <div class="form-group">
                                                 <button type="submit" style="width:49%" id="btn_guardar_req"  class="btn crud-submit btn-info">Guardar</button>
                                                 <button type="submit" style="width:49%" id="btn_limpiar_req"  class="btn crud-submit btn-info">Limpiar</button>
                                             </div>
                       <!--</form>-->

                   </div>
                 </div>

               </div>
    </div>

<!--Modal Registros-->    
<div class="modal draggable fade" id="create-itemRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
            <h4 class="modal-title" id="myModalLabel"><div id="textoHeaderRegistro">Nuevo Registro</div></h4>
        </div>

        <div class="modal-body">
      <!--<form id="formRegistro">--> 
<div class="row">	  
          <div class="form-group  col-md-4">
              <label class="control-label" for="title">Registro</label>
              <!--<textarea  id="REGISTRO" class="form-control" data-error="Ingrese la Descripcion del Sub-Tema" required></textarea>-->
              
<!--	      <select class="form-control " id="REGISTRO" >
                  <option value="MAGNA">MAGNA</option>
                  <option value="DIESEL">DIESEL</option>
                  <option value="PREMIUM">PREMIUM</option>
              </select>-->
              
              <input class="form-control" list="list-productos" name="producto" id="REGISTRO">
                <datalist id="list-productos">
<!--                  <option value="MAGNA">
                  <option value="DIESEL">
                  <option value="PREMIUM">-->
                </datalist>
              
              
              
              
              <div class="help-block with-errors"></div>
		
          </div> 
		 
			<div class="form-group col-md-8">		  
				<label for="exampleTextarea">Descripcion</label>
				  <textarea class="form-control" id="descripcion_registro" rows="3"></textarea>
		    </div>
		</div>	
		<div class="row">
		
<!--		<div class="form-group col-md-5">	
		
				<label for="exampleTextarea"></label>
				<input class="form-group" type="text" value="">
				<div class="glyphicon glyphicon-plus"  id="agregarotrotipoproducto"></div>
		</div>-->
		<div class="form-group col-md-8">	
			
			
		</div>
		</div>
		
<!--          <div class="form-group">
              <label class="control-label">Clave/Descripcion: </label>
              <div class="dropdown">
                  <input onBlur="registroClaveEscritura()" style="width:100%" type="text" class="dropdown-toggle" 
                  id="CLAVEESCRITURA_AGREGARREGISTRO" data-toggle="dropdown" onKeyup="buscarDocumento(this)" autocomplete="off"/>
                  <ul style="width:100%;cursor:pointer;" class="dropdown-menu" id="dropdownEvent" role="menu" 
                  aria-labelledby="menu1"></ul>
              </div>
          </div>-->
         <div class="form-group" style="display: none">
              <label class="control-label">Frecuencia: </label>
              <select id="selectFrecuencia" >
                  <option value="INDEFINIDO">INDEFINIDO</option>
                  <option value="ANUAL">ANUAL</option>
                  <option value="BIMESTRAL">BIMESTRAL</option>
                  <option value="DIARIO">DIARIO</option>
<!--                  <option value="INDEFINIDO">INDEFINIDO</option>-->
                  <option value="MENSUAL">MENSUAL</option>
                  <option value="POR EVENTO">POR EVENTO</option>
                  <option value="SEMANAL">SEMANAL</option>                  
              </select>
          </div>

<!--          <div id="INFO_AGREGARREGISTRO">
              <div class="form-group">
                  Clave Documento:
              </div>
              <div class="form-group">
                  Descripcion Documento:
              </div>
              <div class="form-group">
                  Responsable Documento:
              </div>
          </div>-->

          <div class="form-group">
              <button type="submit" style="width:49%" id="btn_guardar_reg"  class="btn crud-submit btn-info">Guardar</button>
              <button type="submit" style="width:49%" id="btn_limpiar_reg"  class="btn crud-submit btn-info">Limpiar</button>
          </div>

      <!--</form>-->
        </div>
      </div>

    </div>
	
	
	
	
	
</div>
  
    
    

    
<div style="height: 10px"></div>

<div id="layout_here"></div>

<div id="treeboxbox_tree"></div>   
<div id="treeboxbox_treeIzquierda"></div>   
<!--//no borrar-->

<!--<div id="treeboxbox_tree" style="width:550px;height:250px;background-color:white;"></div></body>-->

<div id="seccionIzquierda">
    <div id="contenido" ></div>
</div>
<div id="contenidoDetalles"></div>

<!--<div id="comboclave_descripcion"></div>-->
<!--<div id="gridbox"></div>-->

	<script>
            var myLayout, myTree, myToolbar,myToolbarExportar,id_asignacion_t=-1,levelv=0,id_asignacion_r=-1,selec_tema=-1,id_seleccionado=-1,dataIds_req=[],dataIds_reg=[];
            var myContextMenu;
            var cualModoModalAgregarEdicioRegistro="agregarregistro";
            var dataListado=[];
            var DataGridExcel=[];
            var origenDeDatosVista="asignacionTemaRequisito";
            var id_real_arbol_seleccionado=-1;
            myTree = new dhtmlXTreeObject('treeboxbox_tree', '100%', '100%',0);
	    myTree.setImagePath("../../codebase/imgs/dhxtree_material/");
            myTree.enableDragAndDrop(false);
            myTreeIzquierda = new dhtmlXTreeObject('treeboxbox_treeIzquierda', '100%', '100%',0);
            myTreeIzquierda.setImagePath("../../codebase/imgs/dhxtree_material/");
            myTreeIzquierda.enableDragAndDrop(false); 
           
            
            myTreeIzquierda.attachEvent("onContextMenu", function(id, x, y, ev){
				if (myContextMenu == null) {
					myContextMenu = new dhtmlXMenuObject({
						icons_path: "../../codebase/imgs/dhxmenu_material/",
						context: true,
						items: [
							{id: "itemText"},
							{type: "separator"},
//							{id: "cut", text: "Cut", img: "cut.gif"},
							{id: "copy", text: "Copy", img: "dhxlayout_sep_ver.gif"}
//							{id: "paste", text: "Paste", img: "paste.gif"}
						]
					});
				}
                                
                                myContextMenu.setItemText("itemText", myTreeIzquierda.getItemText(id));
				myContextMenu.showContextMenu(x, y);
				myTreeIzquierda.selectItem(id);
				writeLog("onContextMenu event, id: "+id+" ("+myTreeIzquierda.getItemText(id)+")");
				return false; // prevent default context menu
                                
                                
                                
                            })
            
//             myTreeIzquierda.enableContextMenu(true);
            
            
//            myCombo = new dhtmlXCombo({
//				parent: "comboclave_descripcion",
//				width: 230,
//				filter: true,
//				name: "combo",
//				items: [
//					{value: "1", text: "The Adventures of Tom Sawyer"},
//					{value: "2", text: "The Dead Zone", selected: true},
//					{value: "3", text: "The First Men in the Moon"},
//					{value: "4", text: "The Girl Who Loved Tom Gordon"},
//					{value: "5", text: "The Green Mile"},
//					{value: "6", text: "The Invisible Man"},
//					{value: "7", text: "The Island of Doctor Moreau"},
//					{value: "8", text: "The Prince and the Pauper"}
//				]
//			});
                        
            id_nodo="",tipo_nodo="";

//	      combo = new dhtmlXCombo("comboclave_descripcion");	
//obtenerTemasEnAsignacion();
obtenerDatosArbolIzquierda();
function buscarDocumento(data)
{
    cadena = $(data).val().toLowerCase();
    tempData="";    
    if(cadena!="")
    {
        $.ajax({
            url: '../Controller/AsignacionDocumentosTemasController.php?Op=BuscarDocumento',
            type: 'GET',
            data: 'CADENA='+cadena,
            success:function(documentos)
            {
                $.each(documentos,function(index,value)
                {
                    // nombre = value.nombre_empleado+" "+value.apellido_paterno+" "+value.apellido_materno;
                    datos = value.id_documento+"^_^"+value.clave_documento+"^_^"+value.documento+"^_^"+value.nombre_empleado;
                    tempData += "<li role='presentation'><a role='menuitem' tabindex='-1'";
                    tempData += "onClick='seleccionarItemDocumentos("+JSON.stringify(value)+")'>";
                    tempData += value.clave_documento+" - "+value.documento+"</a></li>";
                });
                $("#dropdownEvent").html(tempData);
            }
        });
    }
}

var idDocumentoSelect=-1;
function seleccionarItemDocumentos(Documentos)
{
    $('#CLAVEESCRITURA_AGREGARREGISTRO').val(Documentos.clave_documento);
    idDocumentoSelect=Documentos.id_documento;
    // tempData = "<div class='form-group'>Clave Documento: "+Documentos.clave_documento+"</div>";
    tempData = "<div class='form-group'>Descripcion Documento: "+Documentos.documento+"</div>";
    tempData += "<div class='form-group'>Responsable Documento: "+Documentos.nombre_empleado+"</div>";
    $("#INFO_AGREGARREGISTRO").html(tempData);
}

function registroClaveEscritura()
{
    val = $('#CLAVEESCRITURA_AGREGARREGISTRO').val();
    if(val=="")
    {
        idDocumentoSelect=-1;
    // tempData = "<div class='form-group'>Clave Documento: "+Documentos.clave_documento+"</div>";
        tempData = "<div class='form-group'>Descripcion Documento:</div>";
        tempData += "<div class='form-group'>Responsable Documento:</div>";
        $("#INFO_AGREGARREGISTRO").html(tempData);
    }
}


parametroscheck={"penalizado":"false"};

$(function()
{
    
	
	
	
	
	
    $('#checkPenalizado').click(function() {
        parametroscheck["penalizado"]=$(this).is(':checked');
//        alert(parametroscheck["penalizado"]);
    });
    
    $("#btn_guardar_req").click(function(e)
    {
         e.preventDefault();
//         $("#btn_guardar_req").attr("disabled", "disabled");
//         alert("dcf  "+id_asignacion_t);
         var formData = {"ID_ASIGNACION_TEMA_REQUISITO":id_asignacion_t,"REQUISITO":$('#REQUISITO').val(),"PENALIZACION":parametroscheck["penalizado"]}; 
         
         
//         alert(formData);
         $.ajax({
             url:'../Controller/AsignacionTemasRequisitosController.php?Op=GuardarNodo',
             type:'POST',
             data:formData,
             success:function(r)
             {
//                alert("Entro al success");
                 if(r==false)
                 {
                    swal("","Error en el servidor","error");
                    setTimeout(function(){swal.close();$("#create-itemRequisito .close").click();},1500);
//                     $("#btn_guardar_req").removeAttr("disabled")
                    $('#create-itemRequisito .close').click();   
                 } else{
                     if(r==true)
                     {
                         swal("","Guardado Exitoso","success");
                         setTimeout(function(){swal.close();},1500);
                        
                         
                         
                         
                         
                         
                         obtenerDatosArbol(id_temporal_dinamico_para_los_nodos_del_arbol);
                         
                         
//                         $("#btn_guardar_req").removeAttr("disabled")
                        $('#create-itemRequisito .close').click();
                     }
                 }
             }
         });
                
     });
     
     
     $("btn_limpiar_req").click(function()
     {
         $("#REQUISITO").val("");
     });
               
     
     $("#btn_guardar_reg").click(function(e)
     {
         e.preventDefault();
        console.log(dataIds_req);
        id_req=-1;
        $.each(dataIds_req,function(index,value){
            if(value.padre==id_seleccionado){
               id_req= value.id_requisito;
//               alert("d "+id_req);
            }
//            alert("d "+value.id_requisito);
        });
        if(cualModoModalAgregarEdicioRegistro=="agregarregistro") 
        {
//         $("#btn_guardar_reg").attr("disabled", "disabled");
                  
//         alert("dcf  "+id);

//$("#selectFrecuencia option[value="+ valor +"]").attr("selected",true)
        var selected_registro;
        selected_registro=document.getElementById("REGISTRO").value;
//        alert("es");
//        $("#REGISTRO").on('input', function(e){
//             selected = $(this).val();
//             console.log("s  ",selected);
//        });
//        console.log("salio",selected);
         var formData = {"ID_REQUISITO":id_req,"REGISTRO":selected_registro,"ID_DOCUMENTO":idDocumentoSelect,"FRECUENCIA":$("#selectFrecuencia").prop("value"),"descripcion_registro":$("#descripcion_registro").val()};
//         alert("Entro al ajax");
            $.ajax({
                url:'../Controller/AsignacionTemasRequisitosController.php?Op=GuardarSubNodo',
                type:'POST', 
                data:formData,
                success:function(r)
                {
                    
                    if(r=="registro_repetido")
                    {
                        swal("","Error Registro Duplicado","error");
                        setTimeout(function(){swal.close();},1500);
                        $('#create-itemRegistro .close').click(); 
                    }
   //                 alert("Entro al success");
                    if(r==false)
                    {
   //                     alert("Entro al if");
                        swal("","Error en el servidor","error");
                        setTimeout(function(){swal.close();},1500);
//                        $("#btn_guardar_reg").removeAttr("disabled")
                        $('#create-itemRegistro .close').click();
                        
                        
                        
                        
                        
                    }else{
                        if(r==true)
                        {
                            
                            
                            obtenerlistaderegistrossinrepetir();
                            
                            swal("","Guardado Exitoso","success");
                            setTimeout(function(){
                                swal.close();
                                $("#create-itemRegistro .close").click();
                            },1500);
                            obtenerDatosArbol(id_temporal_dinamico_para_los_nodos_del_arbol);
                            $('#create-itemRegistro .close').click();
                        
                            
                        }
                    }

                }
            });
          
        }
        else{
//           alert( id_real_arbol_seleccionado)
           var id_registro=id_real_arbol_seleccionado;
           
           var formData = {"ID_REQUISITO":id_req,"ID_REGISTRO":id_registro,"REGISTRO":$('#REGISTRO').val(),"ID_DOCUMENTO":idDocumentoSelect,"FRECUENCIA":$("#selectFrecuencia").prop("value")};
            $.ajax({
             url:'../Controller/AsignacionTemasRequisitosController.php?Op=EdicionNodo',
             type:'POST',
             data:formData,
             success:function(r)
             {
                 if(r==true){
                    swal("","Edicion Exitosa","success");
                    setTimeout(function(){swal.close();},1500);
                    obtenerDatosArbol(id_temporal_dinamico_para_los_nodos_del_arbol);
                    $('#create-itemRegistro .close').click();
                 }else{
                    swal("","Actualizacion no Realizada","error");
                    setTimeout(function(){swal.close();},1500);
                    $('#create-itemRegistro .close').click();
                 }
                 if(r==-1){
                    swal("","Error En El servidor","error");
                    setTimeout(function(){swal.close();},1500);
                    $('#create-itemRegistro .close').click();
                 }
                 
                 
             }
         });
//            alert("edicion registro ");
        } 
     });
     
     $("btn_limpiar_reg").click(function()
     {
         $("#REGISTRO").val("");
     });
     

//     
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
        $("#listjson").excelexportHibrido({
            containerid: "listjson"
            , datatype: 'json'
            , dataset: DataGridExcel
            , columns: getColumns(DataGridExcel)
        });
    });  
}); 
//CIERRA $FUNCTION

function obtenerlistaderegistrossinrepetir(){

  $.ajax({
             url:'../Controller/AsignacionTemasRequisitosController.php?Op=obtenerlistaderegistrossinrepetir',
             type:'POST',
             success:function(r)
             {
                  $("#list-productos").html("");
                 $.each(r,function(index,value){
//                     console.log("entro",value);
                    $("#list-productos").append($('<option>',{
                      value:""+value["registro"],
                     }));    
                     
                 });
   
                 
             }
         });


}



function reconstruirExcel(value,index)
{
//    console.log(value);
//    console.log("Entro al reconstruirExcel");
    tempData=new Object();
    tempData["No.Tema"]= value.no;
    tempData["Tema"]= value.nombre;
    
    tempData["Requisitos"]="";
    if(value['detalles_requisitos'].length==0)
    {
        tempData["Requisitos"]+="No";
    }else{
//          console.log();
        $.each(value['detalles_requisitos'],function(index2,value2)
        {
//              console.log(value2);
                tempData["Requisitos"]+="<li>"+value2.requisito+"</li>";
        });
    }
    
    tempData["Registros"]="";
    tempData["Frecuencia"]="";
    tempData["Clave del Documento"]="";
    tempData["Documento"]="";
    tempData["Responsable"]="";
    if(value['detalles_requisitos'].length==0)
    {
        tempData["Registros"]+="No";
        tempData["Frecuencia"]+="No";
        tempData["Clave del Documento"]+="No";
        tempData["Documento"]+="No";
        tempData["Responsable"]+="No";
    }else{
//          console.log();
        $.each(value['detalles_requisitos'],function(index2,value2)
        {
//            console.log(value2);
            if(value2['detalles_registros'].length==0)
            {
                tempData["Registros"]+="<li>No</li>";
                tempData["Frecuencia"]+="<li>No</li>";
                tempData["Clave del Documento"]+="<li>No</li>";
                tempData["Documento"]+="<li>No</li>";
                tempData["Responsable"]+="<li>No</li>";
            } else{
                $.each(value2['detalles_registros'],function(index3,value3)
                {
//                    console.log(value3);
                    tempData["Registros"]+="<li>"+value3.registro+"</li>";
                    tempData["Frecuencia"]+="<li>"+value3.frecuencia+"</li>";
                    tempData["Clave del Documento"]+="<li>"+value3.clave_documento+"</li>";
                    tempData["Documento"]+=(value3.documento=="")?"No":"<li>"+value3.documento+"</li>";
                    tempData["Responsable"]+="<li>"+value3.responsable+"</li>";
                });
            }   

        });
    }
    
    return tempData;    
}



var myLayout = new dhtmlXLayoutObject({
			parent: "layout_here",
			pattern: "3W",
			cells: [
				{id: "a", width: 240, text: "Estaciones de servicio"},
				{id: "b",   text: "Requisitos-Registros"},
                                {id: "c", width: 260,text: "Detalles"}
				
			]
		});





var myToolbar = myLayout.cells("b").attachToolbar
({
    iconset: "awesome",
    items: [
            {id:"agregarReq",type: "button", text: "Agregar Requisito", img: "fa fa-save "},
            {id:"agregar",type: "button", text: "Agregar Otro Producto", img: "fa fa-save "},
            {id:"editar",type: "button", text: "Editar Registro", img: "fa fa-edit"},
            {id:"eliminar",type: "button", text: "Eliminar", img: "fa fa-trash-o "}

    ]
});

myLayout.cells("b").attachObject("treeboxbox_tree");
myLayout.cells("a").attachObject("treeboxbox_treeIzquierda");     
     
     
myToolbar.attachEvent("onClick", function(id){

    evaluarToolbarSeccionB(id);

});






myTree.attachEvent("onClick", function(id){

 levelv = myTree.getLevel(id);
 id_seleccionado=id;

idTree=-1;
//alert("seleccionado  "+id_seleccionado);
   $.each(dataIds_req,function(index,value){
            if(value.padre==id_seleccionado){
               idTree= value.id_requisito;
            }
        });
 
 obtenerInfo(idTree);
});







function evaluarToolbarSeccionB(id)
{
    if(id_asignacion_t==-1){
//        alert(id_asignacion_t);
        swal("","Seleccione un Tema","error");
        setTimeout(function(){swal.close();},1500);
    }else{
            if(id=="agregar")
            {
                if( selec_tema==0){
//                   if(levelv==0){
//                        $('#create-itemRequisito').modal('show');
//                        
//                   }
//                   else{
                   
                        if(levelv==1){               
                            
                            cualModoModalAgregarEdicioRegistro="agregarregistro";
                            obtenerlistaderegistrossinrepetir();
                            $('#create-itemRegistro').modal('show');
                             $("#textoHeaderRegistro").html("Guardar Producto");

                       }else{
                            swal("","Seleccione un Requisito","error");
                            setTimeout(function(){swal.close();},1500);
                       }
//                 }
                }
                   
            } 
            
            if(id=="agregarReq"){
                $('#create-itemRequisito').modal('show');
//                alert("fd "+id_asignacion_t);
//                
//                
//               myTreeView.unselectItem(id_seleccionado); 
//alert("d");

//    id_asignacion_t
            }
            if(id=="editar"){
                if(levelv==2){
                    $.ajax({
                       url:"../Controller/AsignacionTemasRequisitosController.php?Op=detalles",
                       type:"POST",
                       data:{"id":id_real_arbol_seleccionado,"tipo":"reg","tipoEdicionOrigenPurosDatosDeServer":"registrosEdicionDeDatosModal"},
                       success:function(r){
                           if(r.validado_documento_responsable_or_evidenciascargadas!="se_encuentra_validado_o_ahy_evidencias" ){
                               $("#REGISTRO").val(r.registro);
                               $("#descripcion_registro").val(r.descripcion);
                               $('#create-itemRegistro').modal('show');
                               $("#textoHeaderRegistro").html("Edicion de Registro");
                           }else{
                               
                                 swal("","No Es posible Modificar El Registro ya esta en un documento validado por el responsable o ya tiene al menos una evidencia ","error");
//                            setTimeout(function(){swal.close();},1500);
                           }
//                           construirDetalles(r);
                       }
                     });
                   
                    cualModoModalAgregarEdicioRegistro="edicionregistro";
                   
                }else{
                    swal("","Seleccione un Registro","error");
                            setTimeout(function(){swal.close();},1500);
                }
//                alert("le has picado en editar");              
            }
            if(id=="eliminar")
            {
                    var level = myTree.getLevel(id_seleccionado);
                    var subItems= myTree.getSubItems(id_seleccionado);
//                    alert("Este es el level: "+level);
//                    alert("Este es el subItems: "+subItems);                    
                    if(level==0){
                      swal("","Seleccione un Requisito o Registro","error");
                      setTimeout(function(){swal.close();},1500);  
                    } else {
//                             alert("Este es el level: "+level);
//                             alert("Este es el subItems: "+subItems);
//                             alert("Este es el nodo: "+tipo_nodo);   
                                  if(tipo_nodo=="req")
                                    {
                                          if(subItems=="")
                                            { 
//                                                alert("Si se puede eliminar el Requisito: ");
                                                swal("","Se elimino correctamente el Requisito","success");
                                                setTimeout(function(){swal.close();},1500);
                                                eliminarNodoRequisito();    
                                            } else{
                                                        swal("","El requisito tiene Registros","error");
                                                        setTimeout(function(){swal.close();},1500);
                                                   }       
                                    } else {
//                                            alert("Este es el level: "+level);
//                                            alert("Este es el subItems: "+subItems);  
                                                if(tipo_nodo=="reg" && level==2)
                                                    {
//                                                            alert("Si se puede eliminar el registro");
                                                            eliminarNodoRegistro();
//                                                            obtenerDatosArbol(id_asignacion_t);
                                                    } 
//                                                    else{
//                                                        swal("","Seleccione un Requisito o Registro","error");
//                                                        setTimeout(function(){swal.close();},1500);
//                                                    }
                                      } 
                    }                   
                        
            }
                    
                    
                    
    }
}
    
    
    function eliminarNodoRequisito()
    {
        $.ajax({
            url:"../Controller/AsignacionTemasRequisitosController.php?Op=EliminarRequisito",
            data:"ID_REQUISITO="+id_nodo,
            success:function(data)
            {
                obtenerDatosArbol(id_temporal_dinamico_para_los_nodos_del_arbol);
            }
        });
    }
 
    function eliminarNodoRegistro()
    {
        $.ajax({
            url:"../Controller/AsignacionTemasRequisitosController.php?Op=EliminarRegistro",
            data:"ID_REGISTRO="+id_nodo,
            success:function(data)
            {
                if(data==1)
                {   
//                    alert("Este es el data: "+data)
                    swal("","Se elimino correctamente el Registro","success");
                    setTimeout(function(){swal.close();},1500);
                    obtenerDatosArbol(id_temporal_dinamico_para_los_nodos_del_arbol);
                } else{
//                    alert("Este es el data: "+data)
                    if(data==0)
                    {    
                    swal("","El Registro esta cargado en Evidencias","error");
                    setTimeout(function(){swal.close();},1500);
                    }
                }    
            }   
        });
    }
    

  dataTemasSubtemasEnAsignacion=[];
                  
     function obtenerTemasEnAsignacion(){
//         alert("e");  
    
            $.ajax({
            url: '../Controller/AsignacionTemasRequisitosController.php?Op=Listar',
            async:false,
            success:function(data)
            {
//               dataListado = data;
               dataTemasSubtemasEnAsignacion=data;
//               console.log(data);
//               $htmlData="<div style='overflow-y:auto;' class='table-responsive altotablascrollbar'><ul class='list-group'>";
//               $.each(data,function(index,value){
//                ya no  $htmlData+="<li class='list-group-item'><button onclick='obtenerDatosArbol("+value.id_asignacion_tema_requisito+")' >"+value.no+"-"+value.nombre+"</button><span class='badge'></li>"; 
//                  $htmlData+="<li class='list-group-item' style='background-color:#E6E6FA;'><div style='background-color:#E6E6FA;color:#000000;' onclick='obtenerDatosArbol("+value.id_asignacion_tema_requisito+")'>"+value.no+"-"+value.nombre+"</div><span class='badge'></li>"; 
                
//               });
//              $htmlData+="</ul></div>";
//              $("#contenido").html($htmlData);
//              contruirLista();
            }
            });
        
        
        
     }
     
     function obtenerDatosArbolIzquierda()
    {
//        alert("d");
        $.ajax({
            url:'../Controller/TemasController.php?Op=Listar',
            success:function(data)
            { 
                obtenerTemasEnAsignacion();  
                contruirArbol(data);
            },error:function (){
            }
        });
    }

function contruirArbol(dataArbol)
    {
        myTreeIzquierda.deleteChildItems(0);
        if(dataArbol.length>0){
        myTreeIzquierda.parse(dataArbol, "jsarray");
        }
    }
    
    var id_temporal_dinamico_para_los_nodos_del_arbol=-1;
myTreeIzquierda.attachEvent("onClick", function(id){
console.log("el falso  ",id);
    id_temporal_dinamico_para_los_nodos_del_arbol=id;
     obtenerDatosArbol(id);   
//    id_seleccionado=id;
    return true;
});






     myLayout.cells("c").attachObject("contenidoDetalles");
    // obtenerDatosArbol(1);
    function obtenerDatosArbol(id_asignacion)
    {
//        id_asignacion_t=0;
        
//   if(ayuda==undefined){     
        //el id asigancion cambio a ser el tema como tal para poder manipular el cambio solicitado pero abajo se vuelve a mapear par aque lleve el id
        // asignacion tema requisito y el id del tema 
//        alert("funcion que tiene parametro");
//    id_asignacion_t=id_asignacion;
    var id_tema_subtema=id_asignacion; 
    var datosEnviarParaPoderGenerarElArbol={"id_asignacion":id_asignacion,"id_tema_subtema":id_tema_subtema};
        banderaPrimeraIteracion=false;
        $.each(dataTemasSubtemasEnAsignacion,function (index,value){
//            console.log(value);
            if(banderaPrimeraIteracion==false){
                if(value["id_tema"]==id_asignacion){
                    
                    id_asignacion=value["id_asignacion_tema_requisito"];
                    datosEnviarParaPoderGenerarElArbol["id_asignacion"]=id_asignacion;
//                    datosEnviarParaPoderGenerarElArbol["id_tema_subtema"]=id_tema_subtema;
                    banderaPrimeraIteracion=true;
                }
            }
            
        });
        
        id_asignacion_t=datosEnviarParaPoderGenerarElArbol["id_asignacion"];
      
        console.log("ff",id_asignacion_t);
        selec_tema=0;
        levelv=0;
        cadenaReq="";
        cadenaReg="";
        dataIds_req.length=0;
        dataIds_reg.length=0;
//       alert("d  :"+id_asignacion_t);
//        id_asignacion_t=id_asignacion;
//        alert("d");
        $.ajax({
            url: '../Controller/RegistrosController.php?Op=GenerarArbol',
            type: 'GET',
            data: 'ID_ASIGNACION='+JSON.stringify(datosEnviarParaPoderGenerarElArbol),
            success:function(data)
            {
                // console.log(data);
                dataArbol=[];
                dataIds=[];
                padre=1;
                hijo=1;
                $.each(data.data,function(index,value)
                {
                    cadenaReq=value.requisito;
//                    cadenaReq.substr(0,6);
                    dataArbol.push([padre,0,"Requisito-"+ cadenaReq.substr(0,9)+"...."]);
                    dataIds_req.push({"padre":padre,"id_requisito":value.id_requisito,"requisito":value.requisito});
//                    dataIds.push({"padre":padre,"id_requisito":value.id_requisito,"requisito":value.requisito});
//                    dataIds.push(value.id_requisito);
                    $.each(value[0],function(ind,val)
                    {
                        hijo++;
                        cadenaReg=val.registro;
                        dataArbol.push([hijo,padre,"Reg-"+cadenaReg.substr(0,9)+"...."]);
                        
//                        dataIds.push([hijo,val.id_registro,val.registro]);
                         dataIds_reg.push({"hijo":hijo,"id_registro":val.id_registro,"registro":val.registro});
//                        dataIds.push([val.id_registro]);
                    });
                    hijo++;
                    padre=hijo;
                });
//                console.log(dataIds_reg);
         
//                dataIds_req=dataIds;
//                console.log("d"+dataIds_req);
//                console.log("d:  "+dataArbol);
                showArbol(dataArbol,dataIds);
                construirDetalleSeleccionado(data.detallesTema,id_asignacion_t);
//                obtenerTema(id_asignacion_t);
                
            }
        });
//    }else{
//        
//     alert();   
//    }
    }
    

    
    function construirDetalleSeleccionado(data,id)
    {
//        var level = myTree.getLevel(id);
//        alert("este es el nivel:"+level);
        tempData2="<div class='table-responsive altotablascrollbar'><table class='table table-bordered'><thead><tr class='danger'><th>Datos</th><th>Detalles</th></tr></thead><tbody></tbody>";
                    $.each(data, function(index,value){
                       tempData2+="<tr><td class='info'>No</td><td>"+value.no+"</td></tr>";
                       tempData2+="<tr><td class='info'>Estación de servicio</td><td>"+value.nombre+"</td></tr>";
                       tempData2+="<tr><td class='info'>Descripcion</td><td>"+value.descripcion+"</td></tr>";
//                       if(level==1)
                       tempData2+="<tr><td class='info'>Responsable</td><td>"+value.nombre_empleado+" "+value.apellido_paterno+" "+value.apellido_materno+"</td></tr>";
                       
//                       alert("");
//console.log("d");
                    });
        tempData2+="</table></div>";
   
        $("#contenidoDetalles").html(tempData2);
    }
   
    function obtenerInfo(id){
//        alert("ya has entrado aqui "+data);
        if(id==-1){
//         alert("accederas a registros");
            idTree=-1;
//            alert("d");
//alert("el id seleccionado es :  "+id_seleccionado);
             $.each(dataIds_reg,function(index,value){
//                 console.log("id_reg:  "+value.hijo);
                        if(value.hijo==id_seleccionado){
                               idTree= value.id_registro;
                        }
             });
              id_real_arbol_seleccionado=idTree;
//                console.log(id_real_arbol_seleccionado);
            obtenerDetalles_Seleccionado(idTree,"reg"); 
        }
        else{
//            alert("d "+id);
               
            obtenerDetalles_Seleccionado(id,"req");
            
        } 
    }
    
    
   function obtenerDetalles_Seleccionado(id,tipo){//funcion que recibe el id del requisito o registro ,tipo significa requisito-registro
       
//    alert(id);
//    alert(tipo);
    id_nodo=id;
    tipo_nodo=tipo;
   $.ajax({
       url:"../Controller/AsignacionTemasRequisitosController.php?Op=detalles",
       type:"POST",
       data:{"id":id,"tipo":tipo},
       success:function(d){
//       alert("se hizo ");
//alert("d");
            construirDetalles(d);
    }
        });
    
    }
    function construirDetalles(d){
//        alert();
        $("#contenidoDetalles").html(d);
    }
    
    
    function saveToDatabaseRequisitos(ObjetoThis,columna,id) 
    {
    //        alert("entro al save");            

                $(ObjetoThis).css("background","#FFF url(../../images/base/loaderIcon.gif) no-repeat right");
                $.ajax({
                        url: "../Controller/GeneralController.php?Op=ModificarColumna",
                        type: "POST",
                        data:'TABLA=requisitos &COLUMNA='+columna+' &VALOR='+ObjetoThis.innerHTML+' &ID='+id+' &ID_CONTEXTO=id_requisito',
                        success: function(data)
                        {
                            $(ObjetoThis).css("background","");
                        }   
                });        
    }
    
    function saveToDatabaseRegistros(ObjetoThis,columna,id) 
    {
    //        alert("entro al save");            

                $(ObjetoThis).css("background","#FFF url(../../images/base/loaderIcon.gif) no-repeat right");
                $.ajax({
                        url: "../Controller/GeneralController.php?Op=ModificarColumna",
                        type: "POST",
                        data:'TABLA=registros &COLUMNA='+columna+' &VALOR='+ObjetoThis.innerHTML+' &ID='+id+' &ID_CONTEXTO=id_registro',
                        success: function(data)
                        {
                            $(ObjetoThis).css("background","");
                        }   
                });        
    }
    
    
    
    
    
    function obtenerDatosParaArbol()
    {
        $.ajax({
            url:'../Controller/TemasController.php?Op=Listar',
            success:function(data)
            { 
//                alert("tiene algo el arbol");
             contruirElArbol(data);   
//             load(2);
             
            },error:function (){
//                alert("entro en el erro");
            }
        });
    }

function contruirElArbol(dataArbol)
    {
        myTreeIzquierda.deleteChildItems(0);
        if(dataArbol.length>0){
        myTreeIzquierda.parse(dataArbol, "jsarray");
        }
    }
    
    
    
        </script>      
</body>

            <script src="../../js/functionATRView.js" type="text/javascript"></script>
            <!--<script src="../../js/loaderanimation.js" type="text/javascript"></script>-->
                        <!--Termina para el spiner cargando-->

            <!--Bootstrap-->
            <script src="../../assets/probando/js/bootstrap.min.js"></script>
            <!--Para abrir alertas de aviso, success,warning, error-->
            <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>

            <!--Para abrir alertas del encabezado-->
            <script src="../../assets/probando/js/ace-elements.min.js"></script>
            <script src="../../assets/probando/js/ace.min.js"></script>
 
</html>

              
		