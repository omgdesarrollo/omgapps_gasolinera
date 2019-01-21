<?php
session_start();
require_once '../util/Session.php';
require_once 'rutasArchivos.php';
//$error=Session::eliminarSesion("error");
//$usuario=Session::eliminarSesion("usuario");

if(!isset($_REQUEST["type"])){
      header("location: login.php");
    return;
}else{
    if($_REQUEST["type"]==""){
        header("location: login.php");
//        if($_REQUEST["type"]!= Session::getSesion("tipo")){
//           header("location: login.php");
//           return;
//        }
    }else{
         if($_REQUEST["type"]!= Session::getSesion("tipo")){
           header("location: login.php");
           return;
        }
    }
}


    
//Session::setSesion("s_cont",1);


if (Session:: NoExisteSeSion("user")){
    
    header("location: login.php");
    return;
}
// var_dump( Session::getSesion("user") );
//para hallar ruta fisica tanto web como local
//echo dirname(__FILE__);
//$urls["fisica"] = "/home/fpa9q09nzhnx/public_html/oficina/archivos/";
//$urls["logica"] = 'http://www.enerin-omgapps.com/oficina/archivos/';
// $urls[""] = ;

$Usuario=  Session::getSesion("user");
//echo Session::getSesion("tipo");
//$tokenseguridad=  Session::getSesion("token");
//$tse=$tokenseguridad["tokenseguridad"];
?>

<!DOCTYPE html>
<html>
<head>
	<title>OMG APPS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="shortcut icon" href="../../images/base/enerinLogo.png">
    
	<link rel="stylesheet" type="text/css" href="../../codebase/fonts/font_roboto/roboto.css"/>
	<link rel="stylesheet" type="text/css" href="../../codebase/dhtmlx.css"/>
        <link href="../../codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/>
         <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
         <!--<link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>-->
         <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<script src="../../codebase/dhtmlx.js"></script>
        <script src="../../js/jquery.js" type="text/javascript"></script>
        <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
        <!--<script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>-->
        <script src="../../js/funcionessidebar.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
        <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
        <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>

        <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>
        <style>

        .modal-body{
                color:#888;
                max-height: calc(100vh - 110px);
                overflow-y: auto;
            }
            
		div#sidebarObj {
			position: relative;
			/*margin-left: 10px;*/
			/*margin-top: 50px;*/
			/*width: 100%    ;*/
                        overflow:auto ;
			height: 450px;
                        height: 100%;
                        /*background-color: #ffff33;*/
			/*box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);*/
                        box-shadow: 0 1px 3px rgba(0,0,0,90.05), 0 1px 3px rgba(0,0,0,0.09);
		}
                div#sidebarObjV {
			position: relative;
			/*margin-left: 10px;*/
                        /*margin-top: 50px;*/
			/*width: 900px    ;*/
                        /*overflow: auto;*/
                        
                        /*esta linea es la original ver si la reemplazo por la abajo de esta*/ 
                        /*height: 450px;*/  
                        height: 100%;
/*			box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
                        box-shadow: 0 1px 3px rgba(0,0,0,90.05), 0 1px 3px rgba(0,0,0,0.09);*/
                        box-shadow: 0 1px 3px rgba(0,0,0,90.05), 0 1px 3px rgba(0,0,0,0.09);
		}
                div#arbolprincipal{
/*                  position: relative;*/
                    height:800px;
                }

                .dhtmlxribbon_material .dhxrb_block_base{
                        border: 1px solid #b5bebf;
                        /*background-color: #0f76e057;*/
                }
                .dhtmlxribbon_material .dhxrb_g_area{
                    overflow-y: auto;
                } 
                .dhtmlxribbon_material .dhxrb_big_button {
                    padding: 1px;
                }
                #limpiarSeleccionesRibbon{
                    margin: 3px 0 3px 3px;
                    float: left;
                    border: 1px solid #dfdfdf;
                    background-color: #fafafa;
                    height: 118px;
                    overflow: hidden;
                    position: relative;
                }                
               #seleccion_informacion{ 

                    margin: 3px 0 3px 3px;
                    float: left;
                    border: 1px solid #dfdfdf;
                    background-color: red;
                    height: 118px;
                    overflow: hidden;
                    position: relative;
                }
                #seleccion_informacion_palabra{ 

                    
                    color: blue;
                }
                #seleccion_opcionmenuarriba{
                    background-color: #cccccc;
                }
                
                
                
                
/*                body{
                    height: 100%;
                    background-color: #6666ff;
                }*/
/*                .layoutObj{
                    background-color: #cc66ff;
                    height: 100%;
                    position: re;
                }*/
                
	</style>
	<script>

    var colorView = <?php
    $color = "";
    if(Session:: NoExisteSeSion("colorFondo_Vista"))
        $color = Session::getSesion("user")["FONDO_COLOR"];
    else
        $color = Session::getSesion("colorFondo_Vista");
    echo "'$color'";
    ?>;
    var colorLeter = hexToRgb(colorView);
    console.log(colorLeter);
    colorLeter = invertirRgb(colorLeter)==1?"#ffffff":"#000000";
    // colorLeter = invertirRgb(colorLeter);
    // console.log(colorLeter);
    // colorLeter = rgbToHex( colorLeter["r"], colorLeter["g"], colorLeter["b"] );
    // console.log(colorView);
    $("style").append("::-webkit-scrollbar-thumb{ background-color:"+colorView+" !important;}");
    $("style").append(".dhxlayout_base_material div.dhx_cell_layout div.dhx_cell_hdr{background-color:"+colorView+" !important;opacity:0.8 !important; color:"+colorLeter+" }");
    $("style").append(".dhxrb_block_label{ background:"+colorView+" !important; opacity:0.8; color:"+colorLeter+" !important }");
    // $("style").append("#seleccion_opcionmenuarriba{ background-color:"+colorView+" !important; }");
    // $("#seleccion_opcionmenuarriba").css("background-color",colorView+" !important");
    function hexToRgb(hex)
    {
        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
        return result ? {
            r: parseInt(result[1], 16),
            g: parseInt(result[2], 16),
            b: parseInt(result[3], 16)
        } : null;
    }

    function rgbToHex(r, g, b)
    {
        return "#" + componentToHex(r) + componentToHex(g) + componentToHex(b);
    }

    function componentToHex(c)
    {
        var hex = c.toString(16);
        return hex.length == 1 ? "0" + hex : hex;
    }

    function invertirRgb(data)
    {
        // obj = new Object();
        let obj = 0;
        if(data.g<=200)
        {
            if(data.b<=150 && data.r>=100)
                obj = 1;
            else
                if(data.g<=40)
                    obj = 1;
                else
                    if(data.r<=200)
                        obj = 1;
                    else
                        obj = 0;
        }
        return obj;
    }

            
		var dhxWins, w1,w , myLayout, mySidebar,ribbon,layout;
                var arr = [];
                var nombre_usuario;
//                dhtmlx.image_path='../../codebase/imgs/';
var seccionHerramientas=[
					
    {id:'adjuntar',text:'Adjuntar Documento',img:'attach.png',imgdis:"attach_dis.png", type:'button',isbig:true}	
	  		      	
    //,{id:'cuadre',text:'Cuadre recursos',img:'643.png', imgdis:"643_dis.png",type:'button'}	  		  	
 ];
 
// var seccionReporte=[
//      {id:'excel',text:'Excel',img:'File_XLS_Excel.png', type:'button'},
//      {id:'pdf',text:'PDF',img:'FILE_PDF.png', type:'button'}
// ];
 
 var seccionCatalogo=[
     {id:'Información', text:'Información',img:'catalogo.png',type:'button',isbig:true}  
 ];
 
 
 var seccionCumplimiento=[
     {id:'documentos',text:'Validacion de Documentos',img:'documentos.png',type:'button',isbig:true} ,
     {id:'evidencias',text:'Evidencias',img:'operaciones.png',type:'button',isbig:true},
     {id:'informecumplimientos',text:'Informe',img:'documentos.jpg',type:'button',isbig:true}
 ];
 
  var seccionProcesos=[
     {id:'procesos',text:'Reportes',img:'procesos.png',type:'button',isbig:true} ,
 ];
 
 var seccionTareas=[
     {id:'tareas',text:'Registro de Tareas',img:'tareas.png',type:'button',isbig:true} ,
 ];
  var seccionOficios=[
     {id:'catalogooficios',text:'Catalogos',img:'catalogos.png',type:'button',isbig:true},  
     {id:'documentacion',text:'Documentacion',img:'oficios.png',type:'button',isbig:true},  
     {id:'cargaprograma',text:'Seguimiento',img:'663.png',type:'button',isbig:true},
     {id:'informegerencial',text:'Informe Gerencial',img:'seguimiento.png',type:'button',isbig:true}
 ];
  var cambiodeidioma=[
      {
          id:'cambioespanol',text:'Cambiar a ESPAÑOL',img:'',type:'button',isbig:true
      },
      {
          id:'cambioingles',text:'Cambiar a INGLES',img:'',type:'button',isbig:true
      }
  ];

 var cambiodeidioma=[
      {
          id:'cambioespanol',text:'Cambiar a ESPAÑOL',img:'',type:'button',isbig:true
      },
      {
          id:'cambioingles',text:'Cambiar a INGLES',img:'',type:'button',isbig:true
      }
  ];
  
  
var gantt=[
    {
         id:'cargadeprograma',text:'Carga de Programa',img:'',type:'button',isbig:true
    }  
];

  datacontratos=[
//         {id:'cambiarcontrato',text:'Cambiar Contrato',img:'contratos.png',type:'button',isbig:true}
         {id:'cambiarcontrato',text:'<div id=\'infocontrato\'>Temática Seleccionada:</div>',img:'contratos.png',type:'button',isbig:true}
  ];
  dataSeccionRibbon=[];
   var listasubmodulos=[];
   var nombre_contenido_sub_usuario;
  var variables_super_globales={};
  variables_super_globales["cumplimientos"]=false;
  
   loadDataNotificaciones();

  
 var infosesionusuario=[
     {id:'sesionusuario',text:'<div id="infousuario"><?php echo "Bienvenido <br>".$Usuario["NOMBRE_USUARIO"]; ?></div>',img:'user.png', type:'button',isbig:true}
 ];

function redimencionarLayout()
{
    // console.log(tam1);
    var tam1,tam2,tamW,tamW1;
    if($(window).height()<720)
    {
        tam1 = 740 - 193;
        tamW1 = $(window).width();
        tamW = tamW1 - 330;
        tam2 = tam1 - 42;
        // console.log($("iframe"));
        // $("#jsGrid").css("height","395px");
        // alert($("#jsGrid").css("height"));
    }
    else
    {
        tam1 = $(window).height() - 193;
        tamW1 = $(window).width();
        tamW = tamW1 - 330;
        tam2 = tam1 - 42;
        // $("#jsGrid").css("height", $(window).height() - 740 + tam2+"px");
    }
    // $(".dhx_cell_hdr").css("height", tam1+"px");
    $("#layoutObj").height(tam1);
    $("#arbolprincipal").height(tam1);
    $(".dhxlayout_cont").width(tamW1-10);
    $(".dhxlayout_cont").height(tam1);

    let nav = $(".dhxlayout_cont")[0].childNodes[0];//objecto navegacion
    let vis = $(".dhxlayout_cont")[0].childNodes[1];//objecto visualizacion
    let sep = $(".dhxlayout_cont")[0].childNodes[2];//objecto separador
    let tamNav = $(nav).width();

    // $(".dhx_cell_cont_layout").css("height", tam2+"px");
    $(nav).height(tam1);
    $(sep).height(tam1);
    $(vis).height(tam1);
    $(vis).width(tamW1 - 25 - tamNav);

    $($(vis)[0].childNodes[0]).width(tamW1 - 25 - tamNav);
    $($(vis)[0].childNodes[1]).width(tamW1 - 25 - tamNav);
    $($(vis)[0].childNodes[1]).height(tam2-1);

    $($(nav)[0].childNodes[1]).height(tam2-1);

    let navNode1 = $(nav)[0].childNodes[1];
    let navNode2 = $(navNode1)[0].childNodes[0];
    let navNode3 = $(navNode2)[0].childNodes[1];
    if(navNode3!=undefined)
    {
        let navNode4 = $(navNode3)[0].childNodes[0];
        $(navNode4).css("border-width","0px 0px 0px 0px");
        console.log($(navNode4).width());
    }
    // $(".dhx_cell_cont_layout").css("width", tamW1 - 42 - tamNav +"px");

    // $(".dhx_cell_layout").css("height", tam1+"px");
    // $(".dhx_cell_layout").css("width", tamW+"px");

    // $(".dhxlayout_cont").css("height", tam1+"px");//l
    

    // $(".dhxlayout_cont").css("width", tamW+"px");//l

    $(".dhxlayout_sep").css("height", tam2+"px");
    $("#arbolprincipal").css("height", tam1+"px");

    $("#sidebarObjV").css("height", tam2+"px");
    // $("#sidebarObjV").css("width", tamW+"px");
    $("#sidebarObj").css("height", tam2+"px");

    $(".dhxtabbar_tabs").css("width", tamW1+"px");
    $(".dhx_cell_tabbar").css("width", tamW1+"px");
    $(".dhxtabbar_cont").css("width", tamW1+"px");

    $(".dhxrb_g_area").css("overflow-y","hidden");
    $(".dhx_cell_tabbar").css("overflow-x","auto");
    // $(".dhxrb_g_area").css("overflow-x","auto");
    // if(tamW1>1060)
    // {
        // $(".dhx_cell_tabbar").css("width", 1057+"px");
    // }
    $(".dhx_cell_cont_tabbar").css("width", "max-content");

    // $(".dhxrb_g_area").css("width", "max-content");
    // console.log($(".dhxrb_g_area").css("overflow-y"));

    // $("#sidebarObjV").css("width", tamW+"px");
    // $("#sidebarObjV").parent().css("width", tamW+"px");
    // $("#sidebarObjV").parent().parent().css("width", tamW+"px");
    // console.log($("#sidebarObj").parent().find(".dhx_cell_hdr").css("height"));
    if($(vis).hasClass("dhxlayout_collapsed_v"))
    {
        $($(vis)[0].childNodes[0]).width(28);
        $($(vis)[0].childNodes[0]).height(tam1);
    }
    var dhx_cell_hdr = $(".dhx_cell_hdr")[0];
    // console.log($(dhx_cell_hdr).css("height"));
    tamdhc_cell_hdr = $(dhx_cell_hdr).height();
    tamdhc_cell_hdr > 47 ?
    $(dhx_cell_hdr).css("height",tam1+"px"):console.log();

    $(".dhxrb_with_tabbar").css("height","190px");
    $(".dhxtabbar_cont").css("height","190px");
    $(".dhx_cell_tabbar").css("height","145px");
    
        // $("iframe").css("height",553-6+"px");
    // else
        // $("iframe").css("height",tam2-6+"px");
        
    // $("#jsGrid");

    // console.log($("#sidebarObjV").parent().parent().css("width", tamW+"px"));
    // myLayout.setAutoSize("a;b;e");
}
  function mostrar_urls()
    {
        return new Promise((resolve,reject)=>{
            let usuario = <?php echo Session::getSesion("user")["ID_USUARIO"] ?>;
            let tempDocumentolistadoUrl = "";
            URL = 'filePerfilesUsuario/'+usuario,
            $.ajax({
                url: '../Controller/ArchivoUploadController.php?Op=listarUrls',
                type: 'GET',
                data: 'URL='+URL+"&SIN_CONTRATO=''",
                // async:false,
                success: function(todo)
                {
                    if(todo[0].length!=0)
                    {
                       console.log("todo ",todo);
                    }

                    resolve(todo);
                }
            });
        });
    }
    $(function()
    {
       $(document).ready(()=>{
           redimencionarLayout();
       });

       $(window).resize(()=>{
           // $(window).height();
           // tam1 = $(window).height() - 200;
           // tam2 = tam1 + 42;
           // $(".dhx_cell_cont_layout").css("height", tam1+"px");
           // $(".dhx_cell_layout").css("height", tam2+"px");
           // $(".dhxlayout_cont").css("height", tam2+"px");
           // $("#arbolprincipal").css("height", tam2+"px");
           redimencionarLayout();
       });
           //  layout = new dhtmlXLayoutObject({parent: "layoutObj",pattern: "2U",cells: [{id: "a", text: "Navegacion", header:true},{id: "b", text: "Visualizacion",header:true}]});
        
        myLayout = new dhtmlXLayoutObject({parent: "layoutObj",pattern: "2U",cells: [{id: "a", text: "Navegacion", header:true},{id: "b", text: "Visualizacion",header:true}]});

        myLayout.cells("a").setWidth(310);
         myLayout.cells("a").setHeight(710);
        myLayout.cells("a").attachObject("sidebarObj");
        myLayout.cells("b").attachObject("sidebarObjV");

        myLayout.attachEvent("onResizeFinish", function(){
            // alert("A");
            redimencionarLayout();
        });

        myLayout.attachEvent("onExpand", function(name){
            // alert("Z");
            redimencionarLayout();
        });

        myLayout.attachEvent("onPanelResizeFinish", function(names){
            // alert("X");
            redimencionarLayout();
        });


                    detallescontratosiahyseleccionado();
//                  loadDataMenuArriba("","NO SELECCIONADO");
                   
                    loadDataMenuRibbonSeccionArriba();
                    
                  
//                   console.log("nnnn", listasubmodulos);
                      mostrar_urls().then(function (todo){
                                         
                                         
                                            console.log("esto esdd ",todo);
//                                             ribbon.conf.icons_path=todo[1];
//                                             ribbon._items.Bienvenido.conf.icons_path=todo[1];
//                                             ribbon._items.Bienvenido.conf.img=todo[0][ultimo-1];
//                                               ribbon._items.Bienvenido.base.innerHTML="d";
                                              ultimo = todo[0].length;
                                              if(todo[0].length!=0)
                                              {
                                                    ribbon._items.Bienvenido.base.innerHTML='<img class="img-circle dhxrb_image" src="'+todo[1]+"/"+todo[0][ultimo-1]+'"><div class="dhxrb_label_button">\n\
                                                                                       <div id="infousuario">'+nombre_contenido_sub_usuario+'<br><?php echo  $Usuario["NOMBRE_USUARIO"]; ?> </div></div>';
                                              }
                                     });
                    
                   
                     console.log("ri  ",ribbon);
                    ribbon.setSizes();
                    ribbon.attachEvent("onClick", function(itemIdSeleccion, bId){
                       limpiarSeleccionDeRibbon();
//                        limpiarSeleccionesRibbon
                        
                        console.log(ribbon);
//                        dhxrb_big_button
                        
                        if(itemIdSeleccion=="Bienvenido"){
                             ribbon._items["Bienvenido"].base.id="seleccion_opcionmenuarriba";
//                             ribbon._items["Bienvenido"].base.lastElementChild.id="seleccion_informacion_palabra"
//                            ribbon.check(itemIdSeleccion);
//                                      ribbon.isVisible(bId);  
                               $.each(listasubmodulos,function (index,value){

                                $.each(value["contenido_sub"],function(index1,value1)
                                {
//                                    console.log(value1);
                                    
                                    if(value1["nombre_contenido_sub"]=="Bienvenido"){
//                                        console.log(value1["contenido_vista"]);
                                             loadDataSideBarAjustesUsuario(value1["contenido_vista"]);
                                    }
                                });
                  
                             })
                        }
                        if(itemIdSeleccion=="cambiaresc")
                            alert("le has picado a cam biar act");
                        
                        if(itemIdSeleccion=="logout")
                            logout();
                        if(itemIdSeleccion=="principal")
                           alert("le has picado a principal");
                        
                        if(itemIdSeleccion=="adjuntar")
                           alert("le has picado ajuntar");
                        
                        if(itemIdSeleccion=="autorizar")
                           alert("le has picado autorizar");
                        
                        if(itemIdSeleccion=="excel")
                           alert("le has picado a excel ");
                        
                        if(itemIdSeleccion=="cambiarcontrato"){
                             ribbon._items["cambiarcontrato"].base.lastElementChild.id="seleccion_informacion_palabra"
                             ribbon._items["cambiarcontrato"].base.id="seleccion_opcionmenuarriba";
                                 loadDataSideBarContratos();  
                        }
                          
                
                        if(itemIdSeleccion=="Información") {
//                            ribbon._items["Información"].base.id="seleccion_informacion";
//                            ribbon._items["Información"].base.lastElementChild.id="seleccion_informacion_palabra"
//                            ribbon._items["Información"].base.className="class_informacion";
                           ribbon._items["Información"].base.id="seleccion_opcionmenuarriba";
                           
//                            console.log(listasubmodulos);
//                            console.log(listasubmodulos["0"]["contenido_sub"]["0"]["contenido_vista"]);
                           loadDataSideBarCatalogoInformacion(listasubmodulos["0"]["contenido_sub"]["0"]["contenido_vista"]);
                       }   
                        if(itemIdSeleccion=="Validación"){
                            ribbon._items["Validación"].base.id="seleccion_opcionmenuarriba";
//                            ribbon._items["Validación"].base.lastElementChild.id="seleccion_informacion_palabra";
                          
                           loadDataSideBarCumplimientosDocumentos();
                        }
                       
                        if(itemIdSeleccion=="Evidencias"){
//                            ribbon._items["Evidencias"].base.lastElementChild.id="seleccion_informacion_palabra"
                            ribbon._items["Evidencias"].base.id="seleccion_opcionmenuarriba";
                                loadDataSideBarCumplimientosEvidencias();
                        }
                        
                        if(itemIdSeleccion=="Reportes"){
                             ribbon._items["Reportes"].base.id="seleccion_opcionmenuarriba";
//                            ribbon._items["Reportes"].base.lastElementChild.id="seleccion_informacion_palabra";
                            
                              $.each(listasubmodulos,function (index,value){

                                $.each(value["contenido_sub"],function(index1,value1)
                                {
//                                    console.log(value1);
                                    
                                    if(value1["nombre_contenido_sub"]=="Reportes"){
//                                        console.log(value1["contenido_vista"]);
                                             loadDataSideBarProcesos(value1["contenido_vista"]);
                                    }
                                });
                  
                             })
                            
//                            loadDataSideBarProcesos();
                        }

                        if(itemIdSeleccion=="Gestión de Temas Especiales"){
                            ribbon._items["Gestión de Temas Especiales"].base.id="seleccion_opcionmenuarriba";
//                            ribbon._items["Control de Temas Especiales"].base.lastElementChild.id="seleccion_informacion_palabra";
                            var listRegistroTareas=[];
                            $.each(listasubmodulos,function (index,value){

                                $.each(value["contenido_sub"],function(index1,value1)
                                {
//                                    console.log(value1);
                                    
                                    if(value1["nombre_contenido_sub"]=="Gestión de Temas Especiales"){
//                                        console.log(value1["contenido_vista"]);
                                             loadDataSideBarTareas(value1["contenido_vista"]);
                                    }
                                });
                  
                             })
                            

                        }
                        
                        if(itemIdSeleccion=="Informe"){
                              ribbon._items["Informe"].base.id="seleccion_opcionmenuarriba";
//                            ribbon._items["Informe"].base.lastElementChild.id="seleccion_informacion_palabra";
                            
                            
                                 $.each(listasubmodulos,function (index,value){

                                $.each(value["contenido_sub"],function(index1,value1)
                                {
//                                    console.log(value1);
                                    
                                    if(value1["nombre_contenido_sub"]=="Informe"){
//                                        console.log(value1["contenido_vista"]);

                                            loadDataSideBarInformeCumplimientos(value1["contenido_vista"]);
                                    }
                                });
                  
                             })
                             
                             
                            
                        }
                        
                        if(itemIdSeleccion=="Catálogos"){
                            ribbon._items["Catálogos"].base.id="seleccion_opcionmenuarriba";
//                             ribbon._items["Catálogos"].base.lastElementChild.id="seleccion_informacion_palabra";
                             $.each(listasubmodulos,function (index,value){

                                $.each(value["contenido_sub"],function(index1,value1)
                                {
//                                    console.log(value1);
                                    
                                    if(value1["nombre_contenido_sub"]=="Catálogos"){
//                                        console.log(value1["contenido_vista"]);
                                             loadDataSideBarOficiosCatalogos(value1["contenido_vista"]);
                                    }
                                });
                  
                             })
                           
                        }
                       
                        if(itemIdSeleccion=="Documentación"){
                              ribbon._items["Documentación"].base.id="seleccion_opcionmenuarriba";
//                            ribbon._items["Documentación"].base.lastElementChild.id="seleccion_informacion_palabra";
                            
                              $.each(listasubmodulos,function (index,value){

                                $.each(value["contenido_sub"],function(index1,value1)
                                {
//                                    console.log(value1);
                                    
                                    if(value1["nombre_contenido_sub"]=="Documentación"){
//                                        console.log(value1["contenido_vista"]);
                                             loadDataSideBarOficiosDocumentacion(value1["contenido_vista"]);
                                    }
                                });
                  
                             })
                           
                        }
                        if(itemIdSeleccion=="Informe Gerencial"){
                             ribbon._items["Informe Gerencial"].base.id="seleccion_opcionmenuarriba";
//                        ribbon._items["Informe Gerencial"].base.lastElementChild.id="seleccion_informacion_palabra"; 
                            loadDataInformeGerencial();
                        }
                        if(itemIdSeleccion=="Seguimiento"){
                              ribbon._items["Seguimiento"].base.id="seleccion_opcionmenuarriba";
//                              ribbon._items["Seguimiento"].base.lastElementChild.id="seleccion_informacion_palabra"; 
                            loadDataCargaProgramaGantt();
                        }
                       
                    });      
                    }	                            
         );


function limpiarSeleccionDeRibbon(){
    
                        if(ribbon._items["Información"]!=undefined){
                           ribbon._items["Información"].base.id="";
                            ribbon._items["Información"].base.lastElementChild.id="";
                            
                        }
                        if(ribbon._items["Validación"]!=undefined){
                            ribbon._items["Validación"].base.id="";
                            ribbon._items["Validación"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Evidencias"]!=undefined){
                            ribbon._items["Evidencias"].base.id="";
                            ribbon._items["Evidencias"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Informe"]!=undefined){
                              ribbon._items["Informe"].base.id="";
                            ribbon._items["Informe"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Reportes"]!=undefined){
                            ribbon._items["Reportes"].base.id="";
                            ribbon._items["Reportes"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Gestión de Temas Especiales"]!=undefined){
                            ribbon._items["Gestión de Temas Especiales"].base.id="";
                            ribbon._items["Gestión de Temas Especiales"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Catálogos"]!=undefined){
                            ribbon._items["Catálogos"].base.id="";
                            ribbon._items["Catálogos"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Documentación"]!=undefined){
                            ribbon._items["Documentación"].base.id="";
                            ribbon._items["Documentación"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Seguimiento"]!=undefined){
                            ribbon._items["Seguimiento"].base.id="";
                            ribbon._items["Seguimiento"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Informe Gerencial"]!=undefined){
                            ribbon._items["Informe Gerencial"].base.id="";
                            ribbon._items["Informe Gerencial"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["Bienvenido"]!=undefined){
                            ribbon._items["Bienvenido"].base.id="";
                            ribbon._items["Bienvenido"].base.lastElementChild.id="";
                        }
                        if(ribbon._items["cambiarcontrato"]!=undefined){
                            ribbon._items["cambiarcontrato"].base.id="";
                            ribbon._items["cambiarcontrato"].base.lastElementChild.id="";
                        }
//                        ribbon._items["Validación"].base.id="";                      
                        
    }
 function loadDataMenuArriba(iniciodinamic,info){	

     
	var inicio=[
        {id:'00',text:'<div id=\'desc\'>contrato(NO SELECCIONADO)</div>' ,items:[
        
                    {id:'0x1',mode:'cols',text:'Contratos',type:'block',
          list:datacontratos
        }
        ]},
    
	{id:'0',text:'OMG', active:true, items:[
	{id:'0x2',mode:'cols',text:'Principal',type:'block', 
		list:[
		    {id:'logout',text:'Cerrar',img:'cerrarsesion.png', type:'button',isbig:true}
		   
		      ]	},
                            {id:'0x32',mode:'cols',text:'Catalogo',type:'block',
          list:seccionCatalogo},	
                             
                             {id:'0x33',mode:'cols',text:'Cumplimientos',type:'block',
          list:seccionCumplimiento},
      
                             {id:'0x34',mode:'cols',text:'Procesos',type:'block',
          list:seccionProcesos},
      
                             {id:'0x35',mode:'cols',text:'Tareas',type:'block',
          list:seccionTareas},
                            
                             {id:'0x36',mode:'cols',text:'Oficios',type:'block',
          list:seccionOficios},
                             
                             {id:'0x37',mode:'cols',text:'Usuario',type:'block',
          list:infosesionusuario}
	] }
        ];
    
    
ribbon = new dhtmlXRibbon({	parent: "ribbonObj",arrows_mode: "none",icons_path: "../../images/base/",tabs:inicio});

    }
    
    
    
    
    
     function loadDataMenuRibbonSeccionArriba(){	

         var datosSeccionesRibbon=[];
                
        //aqui empieza este siempre va por que es el que permite cerrar sesion 
        datosSeccionesRibbon.push({id:'0x0',mode:'cols',text:'Principal',type:'block', 
		list:[
		    {id:'logout',text:'Cerrar',img:'cerrarsesion.png', type:'button',isbig:true}
		   
		      ]	});

var entro_seccion_Registro_Tareas=false;
var entro_seccion_Catalogo=false;
var entro_seccion_Documentos=false;
var seccionesRibbonArriba=[];
var datosTemp=[];
var datosTemp2=[];
var contadorSecciones=1;



var seccionCatalogo=[
     {id:'Informacion', text:'Informacion',img:'catalogo.png',type:'button',isbig:true}  
 ];
 submodulos=[];
 dentrodesubmodulos=[]
var bandera=false;
var bandera2=false;
var bandera3=false;
var nombre_submodulo="";
var contador=-1;
var contador2=-1;
var listaModulos=[];
var nombre_contenido_sub="";
var listado_contenido_sub=[];
var vistas = [];

        $.ajax({  
                     url: "../Controller/LoadEstructuraPantallaGeneralController.php?Op=VistasPorUsuarioLaCualTienePermisos",  
                     async:false,
                    success: function(r){
                        $.each(r,function (index,value)
                        {
//                                    bandera=false;
                            if(bandera3==false)
                            {
                               
                                nombre_submodulo=value["nombre_submodulo"];
                                 
                                listaModulos.push({nombre_submodulo:value["nombre_submodulo"],contenido_sub:[]});
                                contador++;
                               
                            }
                            bandera3=true;
                            if(value["nombre_submodulo"]==nombre_submodulo)
                            {
                                if(bandera==false)
                                {
                                    nombre_contenido_sub = value["nombre_contenido_sub"];
                                    
                                    bandera=true;
                                }
                                if(nombre_contenido_sub == value["nombre_contenido_sub"])
                                {
                                    if(bandera2==false)
                                    {
                                        listado_contenido_sub.push({nombre_contenido_sub:value["nombre_contenido_sub"],contenido_vista:[],hijos:0,imagen:value["imagen_seccion_up"]});
                                        contador2++;
                                        bandera2=true;
                                    }
                                    if(value["imagen_seccion_izquierda"]!="undefined")
                                    {
//                                        vistas=[];
//                                        vistas.push({nombre:value["nombre"],id:value["id_vista"],edit:value["EDIT"],consult:value["consult"],"delete":value["delete"]
//                                            ,"new":value["new"],imagen:value["imagen_seccion_izquierda"]});
                                        listado_contenido_sub[contador2]["hijos"]=1;
//                                        listado_contenido_sub[contador2]["contenido_vista"] = vistas;
                                        listado_contenido_sub[contador2]["contenido_vista"].push({nombre:value["nombre"],id:value["id_vistas"],edit:value["EDIT"],consult:value["consult"],"delete":value["delete"],
                                            "new":value["new"],imagen:value["imagen_seccion_izquierda"]});
                                    }
                                    else
                                    {
                                        listado_contenido_sub[contador2]["nombre"] = value["nombre"];
                                        listado_contenido_sub[contador2]["id"] = value["id_vistas"];
                                        listado_contenido_sub[contador2]["edit"] = value["EDIT"];
                                        listado_contenido_sub[contador2]["consult"] = value["consult"];
                                        listado_contenido_sub[contador2]["delete"] = value["delete"];
                                        listado_contenido_sub[contador2]["new"] = value["new"];
                                        listado_contenido_sub[contador2]["imagen"] = value["imagen_seccion_up"];
                                    }
//                                    listaModulos[contador]["contenido_sub"] = listado_contenido_sub;
                                }
                                else
                                {
//                                    listado_contenido_sub=[];
//                                    contador2=-1;
                                    nombre_contenido_sub = value["nombre_contenido_sub"];
                                    listado_contenido_sub.push({nombre_contenido_sub:value["nombre_contenido_sub"],contenido_vista:[],hijos:0,imagen:value["imagen_seccion_up"]});
                                    contador2++;
                                    if(value["imagen_seccion_izquierda"]!="undefined")
                                    {
//                                        vistas=[];
//                                        vistas.push({nombre:value["nombre"],id:value["id_vista"],edit:value["EDIT"],consult:value["consult"],"delete":value["delete"],
//                                            "new":value["new"],imagen:value["imagen_seccion_izquierda"]});
                                        listado_contenido_sub[contador2]["hijos"]=1;
                                        listado_contenido_sub[contador2]["contenido_vista"].push({nombre:value["nombre"],id:value["id_vistas"],edit:value["EDIT"],consult:value["consult"],"delete":value["delete"],
                                            "new":value["new"],imagen:value["imagen_seccion_izquierda"]});
                                    }
                                    else
                                    {
                                        listado_contenido_sub[contador2]["nombre"] = value["nombre"];
                                        listado_contenido_sub[contador2]["id"] = value["id_vistas"];
                                        listado_contenido_sub[contador2]["edit"] = value["EDIT"];
                                        listado_contenido_sub[contador2]["consult"] = value["consult"];
                                        listado_contenido_sub[contador2]["delete"] = value["delete"];
                                        listado_contenido_sub[contador2]["new"] = value["new"];
                                        listado_contenido_sub[contador2]["imagen"] = value["imagen_seccion_up"];
                                    }
                                }
                                listaModulos[contador]["contenido_sub"]=listado_contenido_sub;
                                
                            }
                            else
                            {
                                nombre_contenido_sub = value["nombre_contenido_sub"];
                                nombre_submodulo=value["nombre_submodulo"];
                                listaModulos.push({nombre_submodulo:value["nombre_submodulo"],contenido_sub:[]});
                                contador++;
                                contador2=-1;
                                vistas=[];
                                listado_contenido_sub=[];
                                bandera2=false;
//                                bandera=false;
                                if(nombre_contenido_sub == value["nombre_contenido_sub"])
                                {
                                    if(bandera2==false)
                                    {
                                        listado_contenido_sub.push({nombre_contenido_sub:value["nombre_contenido_sub"],contenido_vista:[],hijos:0,imagen:value["imagen_seccion_up"]});
                                        contador2++;
                                        bandera2=true;
                                    }
                                    if(value["imagen_seccion_izquierda"]!="undefined")
                                    {
//                                        vistas=[];
//                                        vistas.push({nombre:value["nombre"],id:value["id_vista"],edit:value["EDIT"],consult:value["consult"],"delete":value["delete"]
//                                            ,"new":value["new"],imagen:value["imagen_seccion_izquierda"]});
                                        listado_contenido_sub[contador2]["hijos"]=1;
//                                        listado_contenido_sub[contador2]["contenido_vista"] = vistas;
                                        listado_contenido_sub[contador2]["contenido_vista"].push({nombre:value["nombre"],id:value["id_vistas"],edit:value["EDIT"],consult:value["consult"],"delete":value["delete"],
                                            "new":value["new"],imagen:value["imagen_seccion_izquierda"]});
                                    }
                                    else
                                    {
                                        listado_contenido_sub[contador2]["nombre"] = value["nombre"];
                                        listado_contenido_sub[contador2]["id"] = value["id_vistas"];
                                        listado_contenido_sub[contador2]["edit"] = value["EDIT"];
                                        listado_contenido_sub[contador2]["consult"] = value["consult"];
                                        listado_contenido_sub[contador2]["delete"] = value["delete"];
                                        listado_contenido_sub[contador2]["new"] = value["new"];
                                        listado_contenido_sub[contador2]["imagen"] = value["imagen_seccion_up"];
                                    }
                                }
                                
                                listaModulos[contador]["contenido_sub"]=listado_contenido_sub;
                            }
                        });
//                        console.log(listaModulos);
 var banderasSeccionesArriba=false;
 var contadoresSeccionesArriba=1    ;
 listasubmodulos=[]=listaModulos;
 console.log(listasubmodulos);
              $.each(listasubmodulos,function (index,value){
                  nombre_submodulo=value["nombre_submodulo"];
                            
                 banderasSeccionesArriba=false;
           
                  $.each(value["contenido_sub"],function(index1,value1)
                  {
           
                      
//                        console.log(value["contenido_sub"]);
                      if(value1["hijos"]>0){
                          $.each(value1["contenido_vista"],function(indexContenidoVistas,valueContenidoVistas){                             
//                              console.log(valueContenidoVistas);                          
                              if(banderasSeccionesArriba==false){
                                     if(valueContenidoVistas["edit"]=="true" || valueContenidoVistas["consult"]=="true" || valueContenidoVistas["delete"]=="true" || valueContenidoVistas["new"]=="true")
                                    {
                                           banderasSeccionesArriba=true;
                                            datosSeccionesRibbon.push( {id:'0x'+contadoresSeccionesArriba,mode:'cols',text:value["nombre_submodulo"],type:'block',list:[]} );
                                    }
                        } 
                          }) 
                           if(banderasSeccionesArriba==true)
                            {
                                
                                var quieniniciosesion="";
                                if(value1["nombre_contenido_sub"]=="Bienvenido"){
                                  
                                   nombre_contenido_sub_usuario=value1["nombre_contenido_sub"];
                                     datosSeccionesRibbon[contadoresSeccionesArriba]["list"].push({id:value1["nombre_contenido_sub"], text:'<div id="infousuario">'+value1["nombre_contenido_sub"]+"<br><?php echo  $Usuario["NOMBRE_USUARIO"]; ?>",img:value1["imagen"],type:'button',isbig:true});
                                }else{
//                                    alert(value1["nombre_contenido_sub");
//                                        console.log("f",value1["nombre_contenido_sub"]);
//                                        if(value1["nombre_contenido_sub"]=="Cumplimientos"){
//                                            variables_super_globales["cumplimientos"]=true;
//                                        }
                                        var tienalmenosunavista=false;
                                         $.each(value1["contenido_vista"],function(indexContenidoVistas1,valueContenidoVistas1){
//                                             console.log()
                                             if(valueContenidoVistas1["edit"]=="true" || valueContenidoVistas1["consult"]=="true" || valueContenidoVistas1["delete"]=="true" || valueContenidoVistas1["new"]=="true")
                                             {
                                                 tienalmenosunavista=true;
                                                 console.log("entro ");
                                             }
                                             
                                         });
                                         if(tienalmenosunavista==true){
//                                             console.log("tiene  ",value1["nombre_contenido_sub"]);
                                             datosSeccionesRibbon[contadoresSeccionesArriba]["list"].push({id:value1["nombre_contenido_sub"], text:value1["nombre_contenido_sub"],img:value1["imagen"],type:'button',isbig:true});
                                      
                                         }
                                }
                            }
                      }
                      else{                                   
                          if(banderasSeccionesArriba==false)
                            {
                                if(value1["edit"]=="true" || value1["consult"]=="true" || value1["delete"]=="true" || value1["new"]=="true")
                                {
//                                    alert(value["nombre_submodulo"]);
//                                    alert(value1["nombre_contenido_sub"]);
                                    banderasSeccionesArriba=true;
                                    datosSeccionesRibbon.push( {id:'0x'+contadoresSeccionesArriba,mode:'cols',text:''+value["nombre_submodulo"],type:'block',list:[]} );
                                }
                            }
                            if(banderasSeccionesArriba==true)
                            {
//                            alert("entro en true");
//console.log(value1);
                             if(value1["edit"]=="true" || value1["consult"]=="true" || value1["delete"]=="true" || value1["new"]=="true")
                                {
                                    datosSeccionesRibbon[contadoresSeccionesArriba]["list"].push({id:value1["nombre_contenido_sub"], text:value1["nombre_contenido_sub"],img:value1["imagen"],type:'button',isbig:true});
                                }
                            }       
                        }
                  });
                  
                if(banderasSeccionesArriba==true)
                        contadoresSeccionesArriba++;
              });            
                     datosSeccionesRibbon;  
                     
                     
                     
                     
                     
                          $.each(datosSeccionesRibbon,function(index,value1){
//                console.log("debajo:",value);
                
                             if(value1["text"]=="Cumplimientos"){
                                    variables_super_globales["cumplimientos"]=true;
                                 }
                         });
                         
                         
                         
                         
//                datosSeccionesRibbon.push({id:'0x37',mode:'cols',text:'Usuario',type:'block',
//          list:infosesionusuario});
                     },
                     beforeSend:function(r){

                     }
                 
        });    
        console.log("u  ",datosSeccionesRibbon);
//        datosSeccionesRibbon.text["catal"]
        
//   
        
        
        
        datosSeccionesRibbonArriba=[
	{id:'0x2',mode:'cols',text:'Principal',type:'block', 
		list:[
		    {id:'logout',text:'Cerrar',img:'cerrarsesion.png', type:'button',isbig:true}
		   
		      ]	},
                            {id:'0x32',mode:'cols',text:'Catalogo',type:'block',
          list:seccionCatalogo},	
                             
                             {id:'0x33',mode:'cols',text:'Cumplimientos',type:'block',
          list:seccionCumplimiento},
      
                             {id:'0x34',mode:'cols',text:'Procesos',type:'block',
          list:seccionProcesos},
      
                             {id:'0x35',mode:'cols',text:'Tareas',type:'block',
          list:seccionTareas},
                            
                             {id:'0x36',mode:'cols',text:'Oficios',type:'block',
          list:seccionOficios},
                             
                             {id:'0x37',mode:'cols',text:'Usuario',type:'block',
          list:infosesionusuario}
	];
        

        
	var inicio=[
        {id:'00',text:'<div id=\'desc\'>Temática(NO SELECCIONADA)</div>' ,items:[
        
                    {id:'0x1',mode:'cols',text:'Temáticas',type:'block',
          list:datacontratos
        }
        ]},
	{id:'0',text:'OMG', active:true, items:datosSeccionesRibbon }
        ];
    
    
ribbon = new dhtmlXRibbon({	parent: "ribbonObj",arrows_mode: "none",icons_path: "../../images/base/",tabs:inicio});

    }
    function consultarInformacion(url){
               $.ajax({  
                     url: ""+url,  
                     
                    success: function(r) {    
                     $("#procesando").empty();
                     },
                     beforeSend:function(r){
                          $("#sidebarObjV").append("<div class='loader'></div>");


                     }
                 
        });  
            }

function loadDataNotificaciones(){
           $.ajax({  
                     url: "../Controller/NotificacionesController.php?Op=mostrarNotificaciones->Responsable",  
                    success: function(r) {    
//                     $("#procesando").empty();
                     },
                     beforeSend:function(r){
//                          $("#sidebarObjV").append("<div class='loader'></div>");


                     }
                 
        });
        
}
 
     
     function loadDataContratoSeleccionado()
     {
         contrato="";
         $.ajax({
             url:"../Controller/CumplimientosController.php?Op=contratoselec&obt=true",
             type:"POST",
             async:false,
             success:function(dato)
             {
                 if(dato!="")
                 {
                    contrato += '<div>"Temática Seleccionada :"</div>';
                 }
                 return contrato;
             }
         });
         
         $("#infocontrato").html(contrato);
     }
    
      
    function logout(){
            swal({
  title: "Cerrar Sesion",
  text: "Confirme si desea cerrar sesion",
  type: "warning",
  showCancelButton: true,
  closeOnConfirm: false,
  showLoaderOnConfirm: true,
   preConfirm: function() {
    return new Promise(function(resolve) {
      setTimeout(function() {
        resolve()
      }, 1000)
    })
  }
}, function () {
//    window.location.href="Logout.php";
//  setTimeout(function () {
//        temporalcierresesion=1;
//    swal("Sesion finalizada de manera correcta");
//  }, 2000);

 
}).then(function (result) {
     window.location.href="Logout.php";
});;
    }
    

    
    
    function loadDataCargaProgramaGantt(){     
       var dhxWins = new dhtmlXWindows();
        //var layoutWin = dhxWins.createWindow("w1", 20, 20, 600, 400);
         dhxWins.attachViewportTo("arbolprincipal");
         var layoutWin=dhxWins.createWindow({id:"emp", text:"OMG", left: 20, top: 30,width:1338,  height:505,  center:true,resize: true,park:true,modal:true	});
         layoutWin.attachURL("SeguimientoEntradaView.php", null, true);
 
        dhxWins.attachEvent("onMinimize", function(win){
            // alert("minimize");
        });
        
        dhxWins.attachEvent("onShow", function(win){
            // alert("show");
        });
    dhxWins.attachEvent("onHide", function(win){
             alert("en onhide");
});
 dhxWins.attachEvent("onClose", function(win){
//             alert("en c");
             ribbon._items["Seguimiento"].base.lastElementChild.id="";
             return 1;
});


    }
    
    
    
    function cerrarSesion(bclose){
            var dhxWins = new dhtmlXWindows();
//var layoutWin = dhxWins.createWindow("w1", 20, 20, 600, 400);
 var layoutWin=dhxWins.createWindow({id:"emp", text:"OMG", left: 20, top: 30,width:430,  height:205,  center:true,resize: true,park:true,modal:true	});
 layoutWin.attachURL("login.php", null, true);
 
}
        </script>
        

</head>
<!--<body>-->
<body onload="consultarInformacion('../Controller/DocumentosEntradaController.php?Op=Alarmas')">
<div id="ribbonObj" style="position: relative;width: 100%;"></div>
   
    
<div id="layoutObj" class="layoutObj" style="width:99.9%"> 
    <div id="arbolprincipal"> </div>
    <!--<div id="combo_zone2" style="width:200px; height:30px;"></div>-->
</div>
<!--    <div id="treeviewObj" > 


</div>-->
    
    <!--<div id="treeboxbox_tree" class="treeboxbox_tree" style="height:100%;"></div>-->
    <div id="sidebarObj"> </div>
    
    
 
    <div id="sidebarObjV">
  
    </div>
    <input id="gom" type="hidden" value="<?php echo Session::getSesion("token")?>"/>

<script>

cambiarCont();
mostrarTareasEnAlarma();
mostrarTareasVencidas();

//setInterval(security_session,2000);

function cambiarCont()
    { 

var jsonObj = {};

  $contador=1;
           $.ajax({  
                     url: "../Controller/CumplimientosController.php?Op=obtenerContrato",  
                     async:false,
                     success: function(r) {
        $.each(r,function(index,value){
             jsonObj[value.id_cumplimiento] = value.clave_cumplimiento ;
                                })
                       
                        }    
        });
                swal({
  title: 'Seleccione una Temática',
  input: 'select',
//  html:s,
//  html:'<input type=\'text\' disabled>',
  inputOptions:jsonObj,
  inputPlaceholder: 'Sin Temática Seleccionada ',
  showCancelButton: false,
  showLoaderOnConfirm: true,
   allowEscapeKey:false,
   allowOutsideClick: false,
   showConfirmButton: true,
   confirmButtonText:"Seleccionar",
  inputValidator: function (value) {
    return new Promise(function (resolve, reject) {
      if (value !== '') {
        resolve();
      } else {
        reject('Requiere seleccionar una Temática ');
      }
    });
  },
  preConfirm: function() {
    return new Promise(function(resolve) {
      setTimeout(function() {
        resolve()
      }, 1000)
    })
  }
}).then(function (result) {
    $.ajax({  
                        url: "../Controller/CumplimientosController.php?Op=contratoselec&c="+result+"&obt=false",  
                        async:true,
                        success: function(r) {
                              swal({
                                type: 'success',
                                html: 'Tematica Seleccionada:' + r.clave_cumplimiento,    
                                timer: 2000,
                              });
                                window.top.$("#desc").html("Temática("+r.clave_cumplimiento+")");
                                window.top.$("#infocontrato").html("Temática Seleccionada:<br>("+r.clave_cumplimiento+")");
//                                mostrarTareasEnAlarma();
                                
                                
    }    
           });
  });
   
 }
 
 function detallescontratosiahyseleccionado()
 {
    $.ajax({  
            url: "../Controller/CumplimientosController.php?Op=contratoselec&obt=true",  
            async:false,
            success: function(r) 
            {
                window.top.$("#desc").html("Temática("+r.clave_cumplimiento+")");
                window.top.$("#infocontrato").html("Temática Seleccionada::<br>("+r.clave_cumplimiento+")");
            }    
        });
 }
 
 
 
 function mostrarTareasEnAlarma()
 {
     $.ajax({
         url:"../Controller/NotificacionesTareasController.php?Op=tareasEnAlarma",
         type:"GET",
         success:function()
         {
             
         }
     });
 }
 
 function mostrarTareasVencidas()
 {
     $.ajax({
         url:"../Controller/NotificacionesTareasController.php?Op=tareasVencidas",
         type:"GET",
         success:function()
         {
             
         }
     });
 }
 
 function security_session(){
     var tipoU=<?php echo "'".$_REQUEST["type"]."'"?>;
     var sactual=<?php echo "'".Session::getSesion("tipo")."'" ?>;
     var tok=<?php echo "'".Session::getSesion("token")."'"  ?>;
     var t=$("#gom").val();
     if(t!=tok){
         console.log("es diferente");
     }
     console.log("t de vista"+t+"-- token actual real "+tok);
//console.log("f  "+sactual+"-- "+tipoU,);
//     if(sactual!=tipoU){
//         console.log("es diferente");
//     }else
//     {
//         console.log("es igual");
//     }
 }
  function RTAndPGeneral()
 {
     return new Promise(function (resolve,reject){
        $.ajax({
            url:"../Controller/TemasController.php?Op=RTAndPGeneral",
            success:function()
            {
                resolve();
            }
        })
    })
 }
// RTAndPGeneral().then(function(){
//     console.log("ya termino");
// });
 
 
 

</script>
<?php  
//$_SESSION=array();
//echo session_id();
//if(isset($_COOKIE[session_name()])){
//    setcookie(session_name(),'', time()-100,'/');
//}
//session_destroy();

?>



</body>
</html>