<?php
    session_start();
    require_once '../util/Session.php';
    
    $Usuario=  Session::getSesion("user");
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <title></title>
    
    <!--Bootstrap y fontawesome-->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome-animation.min.css" rel="stylesheet" type="text/css"/>
    
    <script src="../../js/jquery.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>

    <!-- <link async href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/> -->

    <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
    
    <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
    
    <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
    <link async href="../../css/modal.css" rel="stylesheet" type="text/css"/>

    <!-- <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
    <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
    <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
    <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css"> -->
    
    <!--jquery-->
    
    <!-- <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script> -->

    <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
    
    <!-- <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/> -->

    <!-- <script src="../../js/fechas_formato.js" type="text/javascript"></script> Esta en encabezado usuario--> 
    <!-- <script src="../../js/filtroSupremo.js" type="text/javascript"></script>
    <link href="../../css/filtroSupremo.css" rel="stylesheet" type="text/css"/> -->
    <link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>

    <!-- <script src="../../js/tools.js" type="text/javascript"></script> marca un error al agregarse -->

    <!-- <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script> -->
    <script src="../../js/fControlTemasView.js" type="text/javascript"></script>
    <!-- <link href="../../css/jsgridconfiguration.css" rel="stylesheet" type="text/css"/> -->
    <script src="../../js/fGridComponent.js" type="text/javascript"></script>

    <script src="../../js/excelexportarjs.js" type="text/javascript"></script>
   
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
       
        
        .hideScrollBar{
        width: 100%;
        height: 100%;
        overflow: auto;
        margin-right: 14px;
        padding-right: 28px; /*This would hide the scroll bar of the right. To be sure we hide the scrollbar on every browser, increase this value*/
        padding-bottom: 15px; /*This would hide the scroll bar of the bottom if there is one*/
        }
        
        .validar_formulario{
            background: blue; 
            width: 120px; 
            color: white; 
        }

        </style>
</head>
<!-- <body> -->
<body class="no-skin" >
    <!--<div id="loader"></div>-->
    
<?php
    require_once 'EncabezadoUsuarioView.php';
?>
    
<div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">
    <input id="fechaInicioTematica" type="date" class="btn btn-success btn_agregar" style="display:none;border-radius:3px !important;"></input>
    <button id="iniciarTematica" type="button" class="btn btn-success btn_agregar" style="display:none">
        Iniciar Tematica
    </button>

    <button id="btnAgregarEvidenciasRefrescar" type="button" class="btn btn-info btn_refrescar" onclick="refresh();" >
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

</body>


<script>
var DataGrid = [];
var dataListado = [];
var filtros=[];
var gridInstance;
var ultimoNumeroGrid=0;
var DataGridExcel=[];
var origenDeDatosVista="controlTemas";

var MyDateField = function(config)
{
        // data = {};
    jsGrid.Field.call(this, config);
//     console.log(this);
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
                return getSinFechaFormato(value[0].fecha);
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
        editTemplate: function(value,args)
        {
                // console.log(args);
                fecha="0000-00-00";
                if(value[0].fecha!=fecha)
                {
                        fecha=value[0].fecha;
                }
                if(value[0].estado==0)
                    return this._inputDate = $("<input>").attr({type:"date",value:fecha,style:"margin:-5px;width:145px"});
                else
                    return getSinFechaFormato(fecha);
        },
        insertValue: function()
        {},
        editValue: function(val)
        {
                value = this._inputDate[0].value;
                if(value=="")
                        return [{fecha:"0000-00-00",estado:value.estado}];
                else
                        return [{fecha:$(this._inputDate).val(),estado:value.estado}];
        }
});

var customsFieldsGridData=[
        {field:"customControl",my_field:MyCControlField},
       {field:"date",my_field:MyDateField},
];

var objFieldEdit="";

// editTemplateCust = (value,data)=>
// {
//     console.log(value,data);
//     let temp = "";
//     temp = data.no == "2"? $("<input>").attr({value:value}) : value;
//     objFieldEdit = temp;
//      return temp;
// }

// editvalueCust = ()=>
// {
//     let val = $(objFieldEdit).val();
//     console.log(val);
//      return val;
// }

estructuraGrid = [
//        { name: "id_principal",visible:false},
        { name:"no",title:"No Tema",width:40,editing:false},
        { name: "nombre",title:"Estaciones", type: "text",width:180,editing:false},
        { name: "descripcion",title:"Descripcion", type: "text",width:160, editing:false},
        // { name: "descripcion",title:"Descripcion", type: "text",width:160, editTemplate:editTemplateCust,editValue:editvalueCust},
        { name: "fecha_fisica",title:"Fecha de Inicio", type: "text",editing:false},
        // { name: "fecha_inicio",title:"Fecha de Inicio", type: "date",editing:true},
        { name: "estado",title:"Registros", type: "text",editing:false},
        { name:"delete", title:"Opción", type:"customControl",sorting:""},
        
    ];
    
construirGrid();
inicializarFiltros().then((resolve2)=>
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
    <script src="../../js/loaderanimation.js" type="text/javascript"></script>
    <!--Termina para el spiner cargando-->
    
    <!--Bootstrap-->
    <script src="../../assets/probando/js/bootstrap.min.js"></script>
    <!--Para abrir alertas de aviso, success,warning, error-->
    <!-- <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script> -->

    <!--Para abrir alertas del encabezado-->
    <script src="../../assets/probando/js/ace-elements.min.js"></script>
    <script src="../../assets/probando/js/ace.min.js"></script>

    <!-- js cargar archivo
    <script  src="../../assets/FileUpload/js/tmpl.min.js"></script>
    <script  src="../../assets/FileUpload/js/load-image.all.min.js"></script>
    <script  src="../../assets/FileUpload/js/canvas-to-blob.min.js"></script>
    <script  src="../../assets/FileUpload/js/jquery.blueimp-gallery.min.js"></script>
    <script  src="../../assets/FileUpload/js/jquery.iframe-transport.js"></script>
    <script  src="../../assets/FileUpload/js/jquery.fileupload.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-process.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-image.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-audio.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-video.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-validate.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-ui.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-jquery-ui.js"></script>
    <script src="../../assets/FileUpload/js/main.js"></script> -->
</body>
</html>



