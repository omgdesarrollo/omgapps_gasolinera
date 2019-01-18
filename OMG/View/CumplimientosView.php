<?php
session_start();
require_once '../util/Session.php';
$error=Session::eliminarSesion("error");
$usuario=Session::eliminarSesion("usuario");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0 minimum-scale=1.0">
	
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/loaderanimation.css" rel="stylesheet" type="text/css"/>
    <link href="../../css/inputable.css" rel="stylesheet" type="text/css"/>
    <script src="../../js/loaderanimation.js" type="text/javascript"></script>
    <script src="../../js/inputable.js" type="text/javascript"></script>
    
     <script src="../../js/jquery.js" type="text/javascript"></script>
<!--<style>
#myProgress {
  width: 100%;
  background-color: #ddd;
}

#myBar {
  width: 1%;
  height: 30px;
  background-color: #4CAF50;
}
</style>-->
    
    
</head>

<body onload="myFunction();">
<!--    <div id="myProgress">
  <div id="myBar"></div>
</div>-->
    
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
<div class="container">
  
  	<div class="row justify-content-center" >
            <div class="col-4">
            <h1 class="heading">Cumplimientos</h1>
            </div>
            
      <div class="col-4"><a href="#"> <button type="button" class="btn btn-primary">Nuevo</button> </a></div>
  	</div>
<input type="text" id="myInput" onkeyup="filtroTable()" placeholder="Busca por nombre" title="Type in a name">
  	<div class="row">
      	<div class="col">         

        	<table class="table table-info table-striped table-sm table-hover table-bordered table-responsive-lg" id="myTable">
        		<thead class="thead-primary text-dark">
              <th>ID</th>
        			<th>CLAVE DEL CUMPLIMIENTO</th>
        			<th>CUMPLIMIENTO</th>
              <th><CENTER>OPCIONES</CENTER></th>
        		</thead>

			<?php 

				$Lista = Session::getSesion("listarCumplimientos");

				foreach ($Lista as $filas) {
				
				?>

				<tr  class='table-success text-dark'>
              <td class="editable0"><?php echo $filas['id_cumplimiento']; ?></td>
              <td class="editable1"> <?php echo $filas['clave_cumplimiento']; ?></td>
	       			<td class="editable2"><?php echo $filas['cumplimiento']; ?></td>
	       			
              <td><button type="button" class="btn btn-warning" onclick="editableTable();">Modificar</button>
              
              <!--<a href="../Controller/EmpleadosController.php?Op=Modificar&Correo=12&Id_Empleado=<?php echo "".$filas['id_empleado'];?>">-->
              <a href="#"> <button type="button" class="btn btn-danger">Eliminar</button></a></td>
        </tr> 
        
                            <?php    
                                }
                             ?>

			</table>
	
		</div>
  	</div>  
</div>
</div>

</body>
</html>