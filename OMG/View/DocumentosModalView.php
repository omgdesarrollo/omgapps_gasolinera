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
		
			<!-- Feedback message zone -->
                        <div id="message" style="display:none;"></div>

			<!--  Number of rows per page and bars in chart -->
<!--			<div id="pagecontrol">
				<label for="pagecontrol">Filas Por Pagina </label>
				<select id="pagesize" name="pagesize">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
				</select>
				&nbsp;&nbsp;
				<label for="barcount">Bars in chart: </label>
				<select id="barcount" name="barcount">
					<option value="5">5</option>
					<option value="10">10</option>
					<option value="15">15</option>
					<option value="20">20</option>
					<option value="25">25</option>
					<option value="30">30</option>
					<option value="40">40</option>
					<option value="50">50</option>
				</select>	
			</div>-->
		
			<!-- Grid filter -->
<!--			<label for="filter">Filter :</label>
			<input type="text" id="filter"/>-->
		
			<!-- Grid contents -->
			<!--<div id="tablecontent"></div>-->
			<!-- [DO NOT DEPLOY] --> 
                          
   
   
   
                <!--<table id="htmlgrid" class="testgrid">-->
                         <table  class="testgrid " >
			<tr>
				<!--<th>NO.</th>-->
				<th>CLAVE DEL DOCUMENTO</th>
                                <th>DOCUMENTO</th>
				
				
			</tr>
                        <?php
                        $Lista = Session::getSesion("listarDocumentos");
                  //$cbxE= Session::getSesion("listarEmpleadosComboBox");
//                  $Lista = PaginacionController::show_rows("ID_DOCUMENTO");
                  $numeracion = 1;
                  
//		foreach ($Lista as $k=>$filas) { 
//                   $valorid= $Lista[$k]["ID_EMPLEADO"];
//                   $nombreempleado=$Lista[$k]["NOMBRE_EMPLEADO"];
                  foreach ($Lista as $filas) { 
                      
		  ?>
			  <tr class="table-row">
				                              
                                <td contenteditable="false" onBlur="saveToDatabase(this,'clave_documento','<?php echo $filas["id_documento"]; ?>')" onClick="showEdit(this);"><?php echo $filas["clave_documento"]; ?></td>
                                <td   contenteditable="false" onBlur="saveToDatabase(this,'documento','<?php echo $filas["id_documento"]; ?>')" onClick="showEdit(this);"><?php echo $filas["documento"]; ?></td>
                                
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
