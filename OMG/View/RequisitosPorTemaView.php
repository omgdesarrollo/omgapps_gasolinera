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
                <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
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
                
                <div id="message" style="display:none;"></div>

                <div class="row justify-content-between">
                                        
                    <div class="col-sm-8">
   
                            <table  class="testgrid " >
                    <tr>				
				<th class="table-header">CLAVE DEL TEMA</th>									
                                <th class="table-header">DESCRIPCION DEL TEMA</th>																		
			  </tr>
		  
		  <tbody>
		 
                  <?php
                  
                  $ListaTemas = Session::getSesion("listarClausulas");
                                                       

                  foreach ($ListaTemas as $filas) { 
		  ?>
			  <tr class="table-row">
				
                            
                                
                                <td contenteditable="false" onBlur="saveToDatabase(this,'clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);">                            
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-requirement"><?php echo $filas["clausula"]; ?></button>
                                    
                                </td>
                                
                                <td contenteditable="false" onBlur="saveToDatabase(this,'descripcion_clausula','<?php echo $filas["id_clausula"]; ?>')" onClick="showEdit(this);"><?php echo $filas["descripcion_clausula"]; ?></td>                                                         
                                                    
			  </tr>
		<?php
		}
                
		?>
                          
                          
                 
		  </tbody>
			
		</table>
                
                    </div>
                    
                    
                    <div class="col-sm-4">
                        
                        <table  class="testgrid " >
                            <tr>				
				<th class="table-header">REQUISITO</th>																		
			  </tr>
		  
		  <tbody>
                      
                <?php
                      
                $ListaReqisitos = Session::getSesion("listarAsignacionTemasRequisitos");
                
                                            foreach ($ListaReqisitos as $value) { 
   
    
                                            if($value["id_clausula"]=="".$filas["id_clausula"]){
        
                                         ?>  
                      
                                <tr class="table-row">  
                                    <td>
					<form action="" class="mt-3">
                                            

						<div class="custom-control custom-checkbox">
							<input type="checkbox" name="" id="checkboxPersonalizado1" class="custom-control-input">
							<label for="checkboxPersonalizado1" class="custom-control-label"><?php echo $value["requisito"]; ?></label>
						</div>

					</form>
                                    </td>    
                               </tr>            
                                    
                                        <?php
                                            } else {
                                        ?>
                               
                               
                                <tr class="table-row">  
                                    <td>
                                            <?php echo "No hay requisitos";?>
                                    </td>        
                                </tr>
      
                                      <?php
    
                                            }
  
                                        }
    
                                        ?>      

              
		  </tbody>
                        </table>
                        
                    </div>    
                                        
                </div>        
                

		<div class="form-group">
                                <button type="submit" id="btn_guardar"  class="btn crud-submit btn-info">Guardar</button>
                                <button type="submit" id="btn_limpiar"  class="btn crud-submit btn-info">Limpiar</button>
                </div>

			
	    </div>
            
 
            
            
            
	</body>

</html>
