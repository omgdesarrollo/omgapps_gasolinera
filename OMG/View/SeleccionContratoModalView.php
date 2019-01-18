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
        <script src="../../js/fSeleccionContratoModalView.js" type="text/javascript"></script>
        <script src="../../js/fGridComponent.js" type="text/javascript"></script>
        
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
        </style> 
        
    </head>

    
    <body class="no-skin">

        <div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;"> 
            <button type="button" id="btn-cont" class="btn btn-success btn_agregar" >
                Seleccione Temática
            </button>
            
            <button type="button" id="btnAgregarDocumentoEntradaRefrescar" class="btn btn-info btn_refrescar" id="btnrefrescar" onclick="refresh();" >
                <i class="glyphicon glyphicon-repeat"></i>   
            </button>
        </div>    

        <br><br><br>

        <div id="jsGrid"></div>
  

        <!-- Inicio de Seccion Modal Tema-->
<!--        <div class="modal draggable fade" id="change-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                   <div class="modal-dialog" role="document">
                     <div class="modal-content">
                       <div class="modal-header">
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
                         <h4 class="modal-title" id="myModalLabel">Seleccionar Contrato</h4>
                       </div>

                       <div class="modal-body">

                         <div id="contenidomodal" ></div>

                       </div>
                     </div>

                   </div>
        </div>-->
        <!--Final de Seccion Modal-->
                                              
       
                        
                
        <script>
            var DataGrid = [];
            var dataListado = [];
            var filtros=[];
            var db={};
            var gridInstance;
            var ultimoNumeroGrid=0;
            
            var customsFieldsGridData=[
                {field:"customControl",my_field:MyCControlField}
            ];
            
            estructuraGrid= [
                { name: "id_principal",visible:false},
                { name:"no",title:"No",width:50},
                { name: "clave_cumplimiento",title:"Clave", type: "textarea",width:150},
                { name: "cumplimiento",title:"Descripción", type: "textarea",width:200},
                { name:"delete", title:"Opción", type:"customControl",sorting:"", width:50}
            ],
                    
            construirGrid();
            
            inicializarFiltros().then((resolve)=>
            { 
                construirFiltros();
                listarDatos();
            },
            (error)=>
            {
                growlError("Error!","Error al construir la vista, recargue la página");
            });
            function reconstruir(value,index)
            {
                tempData=new Object();
                ultimoNumeroGrid = index;
                puedeEditarSoloAdmin=<?php echo Session::getSesion("user")["ID_USUARIO"]; ?>;
                tempData["id_principal"]= [{'id_cumplimiento':value.id_cumplimiento}];
                tempData["no"]= index;
                tempData["clave_cumplimiento"]=value.clave_cumplimiento;
                tempData["cumplimiento"]=value.cumplimiento;
                tempData["id_principal"].push({eliminar : 0});
                if(puedeEditarSoloAdmin==0)
                tempData["id_principal"].push({editar : 1});
                else
                  tempData["id_principal"].push({editar : 0});  
                tempData["delete"]= tempData["id_principal"] ;

                return tempData;
            }

            
            
        </script>

        <!--Bootstrap-->
        <script src="../../assets/probando/js/bootstrap.min.js"></script>
        
        <!--Para abrir alertas del encabezado-->
        <script src="../../assets/probando/js/ace-elements.min.js"></script>
        <script src="../../assets/probando/js/ace.min.js"></script>
        
    </body>
</html>
