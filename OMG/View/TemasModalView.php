<?php
session_start();
require_once '../util/Session.php';
$Usuario=  Session::getSesion("user");

?>

<!DOCTYPE>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title></title>
		

               
<!--                <script src="../../assets/extensions/javascript/demo.js" type="text/javascript"></script>-->

                <link href="../../assets/extensions/css/demo.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript">
                    
                    $(function (){
//                       alert("e"); 
                    });
//			window.onload = function() { 
//				// you can use "datasource/demo.php" if you have PHP installed, to get live data from the demo.csv file
////				editableGrid.onloadJSON("datasource/demo.json");
////                            editableGrid.onloadHTML("htmlgrid"); 
////                            editableGrid.onloadHTML("htmlgrid");
//                           $("#con").load('DocumentosGridFilterView.php'); 
//                        
//                    }; 
		</script>
		
		
	</head>
	
	<body>
          
		<div id="wrap">
		<!--<h1>Lista Documentos</h1>--> 
		
			
                        <div id="message" style="display:none;"></div>

   
   
   
                <!--<table id="htmlgrid" class="testgrid">-->
                         <table  class="testgrid " >
			<tr>
				<!--<th>NO.</th>-->
				
                                <th class="table-header">TEMA</th>
				<th class="table-header">SUB-TEMA</th>				
				<th class="table-header">DESCRIPCION DEL TEMA</th>				
				<th class="table-header">DESCRIPCION DEL SUB-TEMA</th>				
				<th class="table-header">RESPONSABLE</th>				
				<!--<th class="table-header">TEXTO BREVE</th>-->				
				<th class="table-header">DESCRIPCION</th>				
                                <th class="table-header">PLAZO</th>
				
				
			</tr>
                        <?php
                        $Lista = Session::getSesion("listarClausulas");
                  //$cbxE= Session::getSesion("listarEmpleadosComboBox");
//                  $Lista = PaginacionController::show_rows("ID_DOCUMENTO");
//                  $numeracion = 1;
                  
//		foreach ($Lista as $k=>$filas) { 
//                   $valorid= $Lista[$k]["ID_EMPLEADO"];
//                   $nombreempleado=$Lista[$k]["NOMBRE_EMPLEADO"];
                  foreach ($Lista as $filas) { 
                      
		  ?>
			  <tr class="table-row">
				                              
                                <td contenteditable="false" onBlur="saveToDatabase(this,'clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["clausula"]; ?></td>
                                <td contenteditable="false" onBlur="saveToDatabase(this,'sub_clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["sub_clausula"]; ?></td>
                                <td contenteditable="false" onBlur="saveToDatabase(this,'descripcion_clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["descripcion_clausula"]; ?></td>
                                <td contenteditable="false" onBlur="saveToDatabase(this,'descripcion_sub_clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["descripcion_sub_clausula"]; ?></td>
                                <td contenteditable="false" onBlur="saveToDatabase(this,'descripcion_sub_clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo "".$filas["nombre_empleado"]." ".$filas["apellido_paterno"]." ".$filas["apellido_materno"]; ?></td>
                                <!--<td contenteditable="false" onBlur="saveToDatabase(this,'texto_breve','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["texto_breve"]; ?></td>-->
                                <td contenteditable="false" onBlur="saveToDatabase(this,'descripcion','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["descripcion"]; ?></td>
                                <td contenteditable="false" onBlur="saveToDatabase(this,'plazo','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["plazo"]; ?></td>
                          </tr>
		<?php
		}
                
		?>
		  </tbody>
			
		</table>	
		
			<!-- Paginator control -->
			<!--<div id="paginator"></div>-->
		
<!--			 Edition zone (to demonstrate the "fixed" editor mode) 
			<div id="edition"></div>
			
			 Charts zone 
			<div id="barchartcontent"></div>
			<div id="piechartcontent"></div>-->
			
		</div>
	</body>

</html>
