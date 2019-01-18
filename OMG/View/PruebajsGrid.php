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

		<link rel="stylesheet" href=".../../assets/probando/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../../assets/probando/css/ace-rtl.min.css" />
                
                <!--Inicia para el spiner cargando-->
                <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
                <!--Termina para el spiner cargando-->
                
                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>
                <script src="../../js/jquery.js" type="text/javascript"></script>
                <script src="../../js/fDocumentosView.js" type="text/javascript"></script>

                <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.css" />
                <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid-theme.min.css" />
                <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jsgrid/1.5.3/jsgrid.min.js"></script>

                <script src="../ajax/ajaxHibrido.js" type="text/javascript"></script>

                
                
        <style>
            .jsgrid-header-row>.jsgrid-header-cell {
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
        </style>              
                
 			 
</head>

        
        <body class="no-skin" onload="loadSpinner()">
             <div id="loader"></div>
       

<?php

require_once 'EncabezadoUsuarioView.php';

?>

             
<div style="position: fixed;">    
<button type="button" class="btn btn-info " id="btnrefrescar" onclick="refresh();" >
    <i class="glyphicon glyphicon-repeat"></i>   
</button>

<button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Excel'">
    <img src="../../images/base/_excel.png" width="30px" height="30px">
</button>
<button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Word'">
    <img src="../../images/base/word.png" width="30px" height="30px"> 
</button>
<button type="button" onclick="window.location.href='../ExportarView/exportarValidacionDocumentoViewTiposDocumentos.php?t=Pdf'">
    <img src="../../images/base/pdf.png" width="30px" height="30px"> 
</button>    

        <input type="text" id="idInputClaveDocumento" onkeyup="filterTableClaveDocumento()" placeholder="Clave Documento" style="width: 180px;">
        <input type="text" id="idInputNombreDocumento" onkeyup="filterTableNombreDocumento()" placeholder="Nombre Documento" style="width: 180px;">
        <input type="text" id="idInputResponsableDocumento" onkeyup="filterTableResponsableDocumento()" placeholder="Responsable del Documento" style="width: 180px;">
        <i class="ace-icon fa fa-search" style="color: #0099ff;font-size: 20px;"></i>
</div>    


<div style="height: 40px"></div>


<div id="jsGrid"></div>

       

<script>


var db = {

        loadData: function(filter) {
            return $.grep(this.clients, function(client) {
                return (!filter.Name || client.Name.indexOf(filter.Name) > -1)
                    && (!filter.Age || client.Age === filter.Age)
                    && (!filter.Address || client.Address.indexOf(filter.Address) > -1)
                    && (filter.Married === undefined || client.Married === filter.Married);
            });
        },

        insertItem: function(insertingClient) {
            this.clients.push(insertingClient);
        },

        updateItem: function(updatingClient) { },

        deleteItem: function(deletingClient) {
            var clientIndex = $.inArray(deletingClient, this.clients);
            this.clients.splice(clientIndex, 1);
        }

    };

    window.db = db;

db.countries = [
    { Name: "", Id: 0 },
    { Name: "United States", Id: 1 },
    { Name: "Canada", Id: 2 },
    { Name: "United Kingdom", Id: 3 },
    { Name: "France", Id: 4 },
    { Name: "Brazil", Id: 5 },
    { Name: "China", Id: 6 },
    { Name: "Russia", Id: 7 }
];

db.clients = [
    {
        "Name": "Otto Clay",
        "Age": 61,
        "Country": 6,
        "Address": "Ap #897-1459 Quam Avenue",
        "Married": false
    },
    {
        "Name": "Connor Johnston",
        "Age": 73,
        "Country": 7,
        "Address": "Ap #370-4647 Dis Av.",
        "Married": false
    },
    {
        "Name": "Lacey Hess",
        "Age": 29,
        "Country": 7,
        "Address": "Ap #365-8835 Integer St.",
        "Married": false
    },
    {
        "Name": "Timothy Henson",
        "Age": 78,
        "Country": 1,
        "Address": "911-5143 Luctus Ave",
        "Married": false
    },
    {
        "Name": "Ramona Benton",
        "Age": 43,
        "Country": 5,
        "Address": "Ap #614-689 Vehicula Street",
        "Married": true
    },
    {
        "Name": "Ezra Tillman",
        "Age": 51,
        "Country": 1,
        "Address": "P.O. Box 738, 7583 Quisque St.",
        "Married": true
    },
    {
        "Name": "Dante Carter",
        "Age": 59,
        "Country": 1,
        "Address": "P.O. Box 976, 6316 Lorem, St.",
        "Married": false
    },
    {
        "Name": "Christopher Mcclure",
        "Age": 58,
        "Country": 1,
        "Address": "847-4303 Dictum Av.",
        "Married": true
    },
    {
        "Name": "Ruby Rocha",
        "Age": 62,
        "Country": 2,
        "Address": "5212 Sagittis Ave",
        "Married": false
    },
    {
        "Name": "Imelda Hardin",
        "Age": 39,
        "Country": 5,
        "Address": "719-7009 Auctor Av.",
        "Married": false
    },
    {
        "Name": "Jonah Johns",
        "Age": 28,
        "Country": 5,
        "Address": "P.O. Box 939, 9310 A Ave",
        "Married": false
    },
    {
        "Name": "Herman Rosa",
        "Age": 49,
        "Country": 7,
        "Address": "718-7162 Molestie Av.",
        "Married": true
    },
    {
        "Name": "Arthur Gay",
        "Age": 20,
        "Country": 7,
        "Address": "5497 Neque Street",
        "Married": false
    },
    {
        "Name": "Xena Wilkerson",
        "Age": 63,
        "Country": 1,
        "Address": "Ap #303-6974 Proin Street",
        "Married": true
    },
    {
        "Name": "Lilah Atkins",
        "Age": 33,
        "Country": 5,
        "Address": "622-8602 Gravida Ave",
        "Married": true
    },
    {
        "Name": "Malik Shepard",
        "Age": 59,
        "Country": 1,
        "Address": "967-5176 Tincidunt Av.",
        "Married": false
    },
    {
        "Name": "Keely Silva",
        "Age": 24,
        "Country": 1,
        "Address": "P.O. Box 153, 8995 Praesent Ave",
        "Married": false
    },
    {
        "Name": "Hunter Pate",
        "Age": 73,
        "Country": 7,
        "Address": "P.O. Box 771, 7599 Ante, Road",
        "Married": false
    },
    {
        "Name": "Mikayla Roach",
        "Age": 55,
        "Country": 5,
        "Address": "Ap #438-9886 Donec Rd.",
        "Married": true
    },
    {
        "Name": "Upton Joseph",
        "Age": 48,
        "Country": 4,
        "Address": "Ap #896-7592 Habitant St.",
        "Married": true
    },
    {
        "Name": "Jeanette Pate",
        "Age": 59,
        "Country": 2,
        "Address": "P.O. Box 177, 7584 Amet, St.",
        "Married": false
    }
];

$("#jsGrid").jsGrid({
        height: 300,
        width: "100%",
 
        filtering: true,
        editing: true,
        sorting: true,
        paging: true,
        autoload: true,
 
        pageSize: 15,
        pageButtonCount: 5,
 
        deleteConfirm: "Do you really want to delete the client?",
 
        controller: db,
 
        fields: [
            { name: "Name", type: "textarea", width: 150 },
            { name: "Age", type: "number", width: 50 },
            { name: "Address", type: "text", width: 200 },
            { name: "Country", type: "select", items: db.countries, valueField: "Id", textField: "Name", filterValue: function() { 
                return this.items[this.filterControl.val()][this.textField];
            }},
            { name: "Married", type: "checkbox", title: "Is Married", sorting: false },
            { type: "control" }
        ]
    });


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
          
                
	</body>
     
</html>



