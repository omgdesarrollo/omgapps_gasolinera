
<!DOCTYPE html>


<html>
    <head>
        <meta charset="UTF-8">
        <!--<meta charset="UTF-8" name="viewport" content="width=500, initial-scale=1, maximum-scale=1">-->
        <title></title>
        
        <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        
        <script src="../../js/jquery.min.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>
        <script src="../../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
      
        <style>
            
            /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
   
  </style>
    
    
    
        
         <body>
             
             <div id="apartadonotas" >
                    
                    <div class="row" style="height: 50%">
                            <div class="panel panel-info">
                                <div class="panel-heading">Notas</div>
                                <div class="panel-body">
                                    <div id="notaxnota"></div>
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                    
                    
                    </div>
                    
                </div>
<!--                <input type="text" id="message">-->
                <textarea id="ingresoNota"></textarea>
                <button id="btnenviarnotas">Enviar</button>
        
                
                
                
                <div class="container-fluid ">
  <div class="row content">
    <div class="col-sm-3 sidenav">
        <h4>
            USUARIO
            
            
        </h4>
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="#section1">Actividades</a></li>
        <!--<li class="active"><a href="#section1">Notas De Otros Responsables</a></li>-->
        <!--<li><a href="#section2">Actividades </a></li>-->
       
      </ul><br>
<!--      <div class="input-group">
        <input type="text" class="form-control" placeholder="">
        <span class="input-group-btn">
          <button class="btn btn-default" type="button">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>-->
    </div>

    <div class="col-sm-9" id="actividades">
      <h2><small>Notas Recientes</small></h2>
      <hr>
      <h2><div onclick="abrirmas()">Actividad 1</div></h2>
      <h5><span class="glyphicon glyphicon-time"></span> Creada por , fecha.</h5>
      <!--<h5><span class="label label-danger">Food</span> <span class="label label-primary">Ipsum</span></h5><br>-->
      <p>Esta es el area de nota</p>
      <br><br>
      
      <h4><small></small></h4>
      <hr>
      <h2>Actividad 2</h2>
      <h5><span class="glyphicon glyphicon-time"></span> creada por , fecha.</h5>
      <!--<h5><span class="label label-success">Lorem</span></h5><br>-->
      <p>area de nota</p>
      <hr>

<!--      <h4>Escribe Una Nota</h4>
      <form role="form">
        <div class="form-group">
          <textarea class="form-control" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
      </form>
      <br><br>-->

    </div>
  </div>
</div>

<footer class="container-fluid">
  <p></p>
</footer>

         </body>
        
        
        
        
        
        
        
   
    <script>
   function abrirmas(){
       alert();
       $("#actividades").html("");
   }
   
   
   
    $(function (){
       var db = firebase.database();  
       db.ref('notasgantttareas-temas').on('child_added', function(data){
//            console.log(data.val());
              $("#notaxnota").append("<li>"+data.val().notas+"</li>");
       });

       $('#btnenviarnotas').on('click', function(){
            var notas=$("#ingresoNota").val();
            console.log(notas);
//            set es para actualizar
            db.ref('notasgantttareas-temas').push({
             id:"25362536256",
             id_padre_de_todas_las_tareas_de_gantt:"2",
             notas:notas,
             origendequegantt:"temas",
             responsable:"2"
            });
            
            
            $("#notaxnota").append(notas);
            
        });
    });
  </script>
  
  
  
   
  
  
  
  
  
  
<!--<script src="https://www.gstatic.com/firebasejs/5.5.5/firebase.js"></script>-->
<script src="https://www.gstatic.com/firebasejs/3.9.0/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyAhszpIRh8BBXtzSbu1yhGziYX-uT5pPak",
    authDomain: "notasgantttareas-temas.firebaseapp.com",
    databaseURL: "https://notasgantttareas-temas.firebaseio.com",
    projectId: "notasgantttareas-temas",
    storageBucket: "notasgantttareas-temas.appspot.com",
    messagingSenderId: "1061411526028"
  };
  firebase.initializeApp(config);
</script>
  
  
  
  




  
  
  
</html>
