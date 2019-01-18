<?php
session_start();
require_once '../util/Session.php';
$Usuario=  Session::getSesion("user");

$Lista = Session::getSesion("listarDocumentosEntrada");

$a = 0; // Variable para "En proceso(En Tiempo)"
$b = 0; // Variable para "En proceso(Alerta Vencida)"        
$c = 0; // Variable para "En proceso(Tiempo Limite)"
$d = 0; // Variable para "En proceso(Tiempo Vencido)"
$e = 0; // Variable para "Suspendido"
$f = 0; // Variable para "Terminado"

foreach ($Lista as $filas) { 


//Inicia Status Logico
                                    $alarm = new Datetime($filas['fecha_alarma']);
                                    $alarm = strftime("%d-%B-%y",$alarm -> getTimestamp());
                                    $alarm = new Datetime($alarm);
                                    
                                    $flimite = new Datetime($filas['fecha_limite_atencion']);// Guarda en una variable la fecha de la base de datos
                                    $flimite = strftime("%d-%B-%y",$flimite -> getTimestamp());// Esta da el formato: dia. mes y año, sin guardar las horas 
                                    $flimite = new Datetime($flimite);//Se guarda en este formato y se reinicializan las horas a 00.
                                    
                                    $hoy = new Datetime();
                                    $hoy = strftime("%d - %B - %y");
                                    $hoy = new Datetime($hoy);
                               

                                    
                                    if($filas["status_doc"]== 1){

                                        if ($flimite <= $hoy){

                                            if($flimite == $hoy){
                                                
                                                //echo "Tiempo Limite";
                                                $c++;
                                                
                                            } else {
                                                
                                                //echo "Tiempo Vencido";
                                                $d++;
                                            }
                                                  
                                        } else{
                                            
                                          if ($alarm <= $hoy){
                                              
                                              //echo "Alerta Vencida";
                                              $b++;
                                              
                                          } else {
                                                  //echo "En Tiempo";
                                                  $a++;
                                              }                                           
                                        }
                                       
                                     
                                    } //Primer If 
                                    
                                  
                                    if($filas["status_doc"]== 2){
                                        //echo "Suspendido";
                                        $e++;
                                        
                                    } if($filas["status_doc"]== 3){
                                        //echo "Terminado";
                                        $f++;
                                    } 
                                   
                                    //Termina Status Logico    
	                                                                        
} //foreach


?>


<!DOCTYPE html>
<html>
<head>
	<title>Pie</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([

          ['Status', 'Cantidad'],
          ['En proceso(En Tiempo)', <?php echo $a; ?>],
          ['En proceso(Alerta Vencida)', <?php echo $b; ?>],
          ['En proceso(Tiempo Limite)', <?php echo $c; ?>],
          ['En proceso(Tiempo Vencido)', <?php echo $d; ?>],
          ['Suspendido', <?php echo $e; ?>]
          //['Terminado', <?php //echo $f; ?>]
        ]);

        var options = {
          title: 'Documentos de entrada',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
      
    
    </script>


</head>
<body>
    
<div class="row mt-3">
  <div class="col-md-8">

      <div id="piechart_3d" style="width: 600px; height: 400px;"></div> 
  
  </div>
</div>
    
    
</body>
</html>
