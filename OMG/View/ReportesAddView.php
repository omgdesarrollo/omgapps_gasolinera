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
    
    <link async href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
    
    <!-- text fonts -->
	<!--<link rel="stylesheet" href=".../../assets/probando/css/fonts.googleapis.com.css" />-->
    <!-- ace styles -->
    <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
    <!--<link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" />-->
    <link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
    
    <!--Inicia para el spiner cargando-->
    <link async href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
    <!--Termina para el spiner cargando-->
                  
    <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
    <link async href="../../css/modal.css" rel="stylesheet" type="text/css"/>
<!--    <link href="../../css/tabla.css" rel="stylesheet" type="text/css"/>-->
    <!--jquery-->
        <script src="../../js/jquery.js" type="text/javascript"></script>
    <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
<!--    <link href="../../assets/jsgrid/jsgrid-theme.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../assets/jsgrid/jsgrid.min.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/jsgrid/jsgrid.min.js" type="text/javascript"></script>-->
    <!--<script src="../../js/jqueryblockUI.js" type="text/javascript"></script>-->
    <link href="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/sweetalert2/6.4.1/sweetalert2.js"></script>
    <!--<script src="../../js/filtroSupremo.js" type="text/javascript"></script>-->

    <!--<script src="../../js/dhtmlxFunctions.js" type="text/javascript"></script>-->
    <!--<script src="../../js/formulario.js" type="text/javascript"></script>-->
    <!--LIBRERIA DE dhtmlx-->
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>
    <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
    <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/>
    <!--TERMINA LIBRERIA DE dhtmlx-->
    <script src="../../js/tools.js" type="text/javascript"></script>
    <script src="../../js/fReportesView.js" type="text/javascript"></script>
    
    <style>

    </style>
    
    
    
    
    
</head>
<!-- <body> -->
<body class="no-skin" >
 <button  type="button" onclick="ventanaWindowsEmergente()"
        class="btn btn-success">
            Agregar Nuevo Reporte Diariofdf
 </button>
    
    
    <div id="contenidoFormulario"></div>
    
    
    
    <script>
    $(function (){
        construirFormulario();
    });
    
    
    function construirFormulario(){
formData = [
				{type: "settings", position: "label-right", labelWidth: "auto", inputWidth: 130},
				{type: "label", label: "Web Skin"},
				{type: "checkbox", label: "Sync data with FTP server", checked: true, list:[
					{type: "settings", labelWidth: 90, inputWidth: 200, position: "label-left"},
					{type: "input", name: "ftp_server", label: "Server", value: "ftp://backup.mydomain.com"},
					{type: "input", name: "ftp_login", label: "Login", value: "user"},
					{type: "password", name: "ftp_pwd", label: "Password", value: "password"},
					{type: "select", name: "ftp_sync", label: "Sync every", options:[
						{value: "day", text: "day"},
						{value: "2ndday", text: "second day"},
						{value: "friday", text: "friday"},
						{value: "2ndfriday", text: "second friday", selected: true},
						{value: "Month", text: "last friday in a month"}
					]},
					{type: "checkbox", name: "ftp_log", value: 1, label: "Enable log", checked: true}
				]},
				{type: "checkbox", label: "Init system hardware upgrade", offsetTop: 10, checked: true, list: [
					//
					{type: "settings", labelWidth: 90, inputWidth: 100, position: "label-left"},
					{type: "calendar", dateFormat: "%Y-%m-%d", label: "Start Date", name: "reminder", enableTime: false, calendarPosition: "right", value:"2013-03-01" },
					{type: "select", label: "Duration", options:[
						{value: "day", text: "day"},
						{value: "week", text: "week", selected: true},
						{value: "2weeks", text: "two weeks"}
					]}
				]},
				{type: "checkbox", label: "Use custom UI colors", checked: true, offsetTop: 10, list:[
					{type: "settings", labelWidth: "auto", inputWidth: "auto"},
					{type: "fieldset", label: "Font", inputWidth: 160, list: [
						{type: "radio", name: "fontcolor", label: "Black", checked: true},
						{type: "radio", name: "fontcolor", label: "Blue"},
						{type: "radio", name: "fontcolor", label: "Green"}
					]},
					{type: "newcolumn"},
					{type: "fieldset", label: "Background", inputWidth: 160, offsetLeft: 30, list:[
						{type: "radio", name: "bgcolor", label: "White", checked: true},
						{type: "radio", name: "bgcolor", label: "Yellow"},
						{type: "radio", name: "bgcolor", label: "Gray"}
					]}
				]},
				{type: "checkbox", label: "Custom font", checked: true, offsetTop: 10, list:[
					{type: "combo", label: "", inputWidth: 120, options: [
						{value: "tahoma", text: "Tahoma"},
						{value: "arial", text: "Arial", selected: true},
						{value: "verdana", text: "Verdana"}
					]},
					{type: "newcolumn"},
					{type: "combo", label: "", inputWidth: 70, offsetLeft: 5, options: [
						{value: "12", text: "12px"},
						{value: "13", text: "13px"},
						{value: "14", text: "14px", selected: true}
					]}
				]},
				{type: "checkbox", label: "Upload new data", checked: true, offsetTop: 10, list:[
					{type: "fieldset", label: "Files", inputWidth: 350, list:[
						{type: "upload", name: "myFiles", inputWidth: 330, url: "../07_uploader/php/dhtmlxform_item_upload.php", _swfLogs: "enabled", swfPath: "../../../codebase/ext/uploader.swf", swfUrl: "../../samples/07_uploader/php/dhtmlxform_item_upload.php"}
					]}
				]},
				//
				{type: "checkbox", label: "Yes! I'm sure to save changes", offsetTop: 10, checked: 1, list:[
					//
					{type: "button", value: "Save", offsetLeft: 50, offsetTop: 10, inputWidth: 50},
					{type: "newcolumn"},
					{type: "button", value: "Cancel", offsetLeft: 8, offsetTop: 10}
				]}
			];
			myForm = new dhtmlXForm("contenidoFormulario", formData);
			myForm.setFocusOnFirstActive();    
}
    </script>
    <!--Inicia para el spiner cargando-->
    <script src="../../js/loaderanimation.js" type="text/javascript"></script>
    <!--Termina para el spiner cargando--> 
    <!--Bootstrap-->
    <script src="../../assets/probando/js/bootstrap.min.js"></script>
    <!--Para abrir alertas de aviso, success,warning, error-->
    <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>
    <!--Para abrir alertas del encabezado-->
    <script src="../../assets/probando/js/ace-elements.min.js"></script>
    <script src="../../assets/probando/js/ace.min.js"></script>
 
</body>
</html>



