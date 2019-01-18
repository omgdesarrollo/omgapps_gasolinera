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
                <!--Para abrir alertas de aviso, success,warning, error-->
                <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
                <!--<link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>-->
                <!-- ace styles -->
                <link rel="stylesheet" href="../../assets/probando/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
                
                <!--Inicia para el spiner cargando-->
                <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
                <!--Termina para el spiner cargando-->
                
                
                <!--<link href="../../css/paginacion.css" rel="stylesheet" type="text/css"/>-->
                
                <script src="../../js/jquery.js" type="text/javascript"></script>
      

                <link href="../../css/modal.css" rel="stylesheet" type="text/css"/>
                <link href="../../css/tabla.css" rel="stylesheet" type="text/css"/>
                <!--<script src="../../js/functionTemasView.js" type="text/javascript"></script>-->
                
                <link href="../../assets/dhtmlxSuite_v51_std/codebase/fonts/font_roboto/roboto.css" rel="stylesheet" type="text/css"/>
                <!--<link href="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
                <script src="../../assets/dhtmlxSuite_v51_std/codebase/dhtmlx.js" type="text/javascript"></script>
                <link href="../../assets/dhtmlxSuite_v51_std/skins/web/dhtmlx.css" rel="stylesheet" type="text/css"/>
                <!--<link href="../../assets/dhtmlxSuite_v51_std/skins/skyblue/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
                <!--<link href="../../assets/dhtmlxSuite_v51_std/skins/terrace/dhtmlx.css" rel="stylesheet" type="text/css"/>-->
                
                
            <style> 
                    .modal-body{
                      color:#888;
                      max-height: calc(100vh - 110px);
                      overflow-y: auto;
                     
                    }                    
                    
                    #sugerenciasclausulas {
                    width:350px;
                    height:5px;
                    overflow: auto;
                    }  
                    /*
                    
                    .hideScrollBar{
                      width: 100%;
                      height: 100%;
                      overflow: auto;
                      margin-right: 14px;
                      padding-right: 28px; This would hide the scroll bar of the right. To be sure we hide the scrollbar on every browser, increase this value
                      padding-bottom: 15px; This would hide the scroll bar of the bottom if there is one
                    }*/
                    
                    div#layout_here {
                    position: relative;
                    width: 100%;
                    height: 392px;
                    /*overflow: auto;*/
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
                    /*margin: 0 auto;*/
                    }
                    div#treeboxbox_tree{
                    /*position: relative;*/
                    /*width: 900px;*/
                    height: 300px;
                    /*overflow: auto;*/
                    box-shadow: 0 1px 3px rgba(0,0,0,0.05), 0 1px 3px rgba(0,0,0,0.09);
                    }
/*                    div#contenido{
                         height: 150px;
                    }*/
                    .altotablascrollbar{
                         height: 320px;
                    }


            </style>    


	</head>

        <body class="no-skin" >
    <!--<div id="loader"></div>-->
            
            
<?php

require_once 'EncabezadoUsuarioView.php';

?>

            
<!--<div style="height: 5px"></div>            
           
<div style="position: fixed;">    
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
        Agregar Tema
    </button>

<button type="button" class="btn btn-info " id="btnrefrescar" onclick="refresh();" >
    <i class="glyphicon glyphicon-repeat"></i> 
</button>
<button type="button" onclick="window.location.href='../ExportarView/exportarClausulasView/exportarClausulasViewExcel.php'">
<img src="../../images/base/_excel.png" width="30px" height="30px">
</button>     
<button type="button" onclick="window.location.href='../ExportarView/exportarClausulasView/exportarClausulasViewWord.php'">
    <img src="../../images/base/word.png" width="30px" height="30px"> 
</button>
<button type="button" onclick="window.location.href='../ExportarView/'">
    <img src="../../images/base/pdf.png" width="30px" height="30px"> 
</button>

    Filtros de busqueda

    <i class="ace-icon fa fa-search" style="color: #0099ff;font-size: 20px;"></i>

</div>
 
<div style="height: 50px"></div>-->


<div id="layout_here" ></div>

<div id="treeboxbox_tree"></div>

<div id="contenido" ></div>

<div id="contenidoDetalles"></div>

                                         
       <!-- Inicio de Seccion Modal Tema-->
       <div class="modal draggable fade" id="create-itemTema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
		        <h4 class="modal-title" id="myModalLabel">Crear Nuevo Tema</h4>
		      </div>
                        
		      <div class="modal-body">
                          
                                                <div class="form-group">
							<label class="control-label" for="title">No.Tema:</label>
                                                        <input type="text"  id="NO" class="form-control"  />
                                                        
                                                    
							<div class="help-block with-errors"></div>
                                                        <div id="sugerenciasclausulas"></div>
                                                        
						</div>
                                                
                                                <div class="form-group">
							<label class="control-label" for="title">Tema:</label>
                                                        <textarea  id="NOMBRE" class="form-control" data-error="Ingrese la Descripcion del Tema" ></textarea>
							<div class="help-block with-errors"></div>
						</div>                                    
                                    
                                    
						<div class="form-group">
							<label class="control-label" for="title">Descripcion:</label>
                                                        <textarea  id="DESCRIPCION" class="form-control" data-error="Ingrese el Sub-Tema" ></textarea>
							<div class="help-block with-errors"></div>
						</div>
                                                                                                                       
                                                                        
                                                <div class="form-group">
							<label class="control-label" for="title">Plazo:</label>
                                                        <textarea  id="PLAZO" class="form-control" data-error="Ingrese la Descripcion del Sub-Tema" ></textarea>
							<div class="help-block with-errors"></div>
						</div>

                                                <div class="form-group">
							<label class="control-label" for="title">Responsable:</label>
                                                        
                                                        <select   id="ID_EMPLEADOMODAL" class="select1">
                                                                <?php
                                                                $s="";
                                                                
                                                                $cbxE = Session::getSesion("listarEmpleadosComboBox");
                                                                foreach ($cbxE as $value) {
                                                                ?>
                                                                
                                                                <option value="<?php echo "".$value["id_empleado"] ?>"><?php echo "".$value["nombre_empleado"]." ".$value["apellido_paterno"]." ".$value["apellido_materno"]; ?></option>
                                                                
                                                                    <?php
                                                                
                                                                }
                                    
                                                                 ?>
                                                        </select>
                                                        
							<div class="help-block with-errors"></div>
						</div>
                                                                        
                                                                                                                                
						<div class="form-group">
                                                    <button type="submit" style="width:49%" id="btn_guardar"  class="btn crud-submit btn-info">Guardar</button>
                                                    <button type="submit" style="width:49%" id="btn_limpiar_tema"  class="btn crud-submit btn-info">Limpiar</button>
						</div>
                     

		      </div>
		    </div>

		  </div>
       </div>
       <!--Final de Seccion Modal-->
       
       <!-- Inicio de Seccion Modal Sub-Tema-->
       <div class="modal draggable fade" id="create-itemSubTema" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="closeLetra">X</span></button>
		        <h4 class="modal-title" id="myModalLabel">Crear Nuevo Subtema</h4>
		      </div>
                        
		      <div class="modal-body">
                         
                          
                                                <div class="form-group">
							<label class="control-label" for="title">No.Sub-Tema:</label>
                                                        <input type="text"  id="NO_SUBTEMA" class="form-control"  />
                                                        
                                                    
							<div class="help-block with-errors"></div>
                                                        <div id="sugerenciasclausulas"></div>
                                                        
						</div>
                                                
                                                <div class="form-group">
							<label class="control-label" for="title">Sub-Tema:</label>
                                                        <textarea  id="NOMBRE_SUBTEMA" class="form-control" data-error="Ingrese la Descripcion del Tema" required></textarea>
							<div class="help-block with-errors"></div>
						</div>                                    
                                    
                                    
						<div class="form-group">
							<label class="control-label" for="title">Descripcion:</label>
                                                        <textarea  id="DESCRIPCION_SUBTEMA" class="form-control" data-error="Ingrese el Sub-Tema" required></textarea>
							<div class="help-block with-errors"></div>
						</div>
                                                                                                                       
                                                                        
                                                <div class="form-group">
							<label class="control-label" for="title">Plazo:</label>
                                                        <textarea  id="PLAZO_SUBTEMA" class="form-control" data-error="Ingrese la Descripcion del Sub-Tema" required></textarea>
							<div class="help-block with-errors"></div>
						</div>

                                                                        
                                                                                                                                
						<div class="form-group">
                                                    <button type="submit" style="width:49%" id="btn_guardarSub"  class="btn crud-submit btn-info">Guardar</button>
                                                    <button type="submit" style="width:49%" id="btn_limpiar_SubTema"  class="btn crud-submit btn-info">Limpiar</button>
						</div>
                        

		      </div>
		    </div>

		  </div>
       </div>
       <!--Final de Seccion Modal-->
       
		<script>  
//                        id_seleccionado="";
//                        obtenerDatosArbol();
           
		</script>
                
                
                
                <script src="../../js/fTemasView.js" type="text/javascript"></script>

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
