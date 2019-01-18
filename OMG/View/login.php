<?php
session_start();
require_once '../util/Session.php';
//$error=Session::eliminarSesion("error");
//$usuario=Session::eliminarSesion("usuario");

//if(!isset($_REQUEST["t"])){
//    echo "no se tiene acceso ";  
//     echo "logica".$_SERVER['HTTP_HOST'];
//     echo "fisica".$_SERVER['DOCUMENT_ROOT'];
//     
     if(isset($_REQUEST["t"])){
//        echo $_REQUEST["t"];
    }else{
     if($_SERVER["SERVER_NAME"] != "localhost")
     {
//         echo "d";
            header("location:error.php");
                
     }
     }
     
     
     
     
//}else{
     if (Session:: existeSesion("user")){
         
//         if(Session::getSesion("user")["ID_USUARIO"]!="NOTUSER"){
//            header("location: principalmodulos.php");
            header("location: principalmodulos.php?type=".Session::getSesion("tipo"));
            return;
//         }else{
//             
//         }
        
    } 
    
   
    
    
?>

<?php // echo "el error es "+$error;  ?>
<?php // echo "el usuario es  "+$usuario   ?>

<html lang="ES">
    <head>
        <title>OMG</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        
        <link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css">
        <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
		<!-- Libreria java scritp de bootstrap -->
        <!--<script src="../../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>-->
                <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
        <script src="../../js/jquery.min.js" type="text/javascript"></script>
        <!--<script src="../../js/jquery-ui.min.js" type="text/javascript"></script>-->
        <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>
        <script src="../../js/is.js" type="text/javascript"></script>
        <!--materialize-->
        <link type="text/css" rel="stylesheet" href="../../assets/materialize/css/materialize.min.css"  media="screen,projection"/>
         <script type="text/javascript" src="../../assets/materialize/js/materialize.min.js"></script>
        <!--end materialize-->
         <link href="../../assets/googleApi/icon.css" rel="stylesheet">
        
         <!--<link href="//cdn.shopify.com/s/files/1/1775/8583/t/1/assets/admin-materialize.min.css?701317015908805120" rel="stylesheet">-->
        <!--<script src="../../js/tooltip.js" type="text/javascript"></script>-->
        <!--<script src="../../angular/angular.min.js" type="text/javascript"></script>-->
        <!--<link href="../../css/settingsView.css" rel="stylesheet" type="text/css"/>-->
        <!--<link href="../../css/wb/imagen_de_inicio.css" rel="stylesheet" type="text/css"/>-->
            <script>
//              function decrypt(password) 
//{
//var content="164121149140147112182179179181204195188111186184189173145096097139186184189173145096097139186169177165145096097139191169196162115182191176196183181181144117204195184113136099145096097139198173196173184145172189198173196173184183119159179171181125130199192195190169142078093143196180198165112175180192188140116171181175184197184195193182114097182194197195183178196126117170176162155155169136115170188177114134197170191183188193114117129097128115191195198180138112130202206198128187201180188202208182201169178163200188195179183182126164194192121141095078140173188193194111186182181167144117192188179171181175178183188174187178185164188194133178197183114097197184195140116183196186191184202183183169196099145096097139190173190172115187201180184129114170193183188199128167195180117115201180190129114180199204195180197172181166199117149092092128127169184180187141095078140163194183208141095078093075143130185190182189142078093143134183198177188127";
//var key = "  '#$%&'()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_ `abcdefghijklmnopqrstuvwxyz{|}~€‚ƒ„…†‡ˆ‰Š‹ŒŽ‘’“”•–—˜™š›œžŸ ¡¢£¤¥¦§¨©ª«¬­®¯°±²³´µ¶·¸¹º»¼½¾¿ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖ×ØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõö÷øùúûüýþÿ";
//var html="";var tag="";var i=0;var n=0;for(i=0;i<12;i=i+3){tag=tag+String.fromCharCode((content.substring(i, i + 3)-key.indexOf(password.charAt(n))));n=n+1;if(n==password.length){n=0;}} if(tag!='T8B9'){alert('The specified password is invalid!');return  document.location.href="d";} for(j=i;j<content.length;j=j+3){html=html+String.fromCharCode((content.substring(j,j+3)-key.indexOf(password.charAt(n))));n=n+1;if(n==password.length){n=0;}} document.writeln(html);document.close();if(navigator.appName=="Microsoft Internet Explorer") document.location.reload(false);}


function clock() 
{
   var digital = new Date();
   var hours = digital.getHours();
   var minutes = digital.getMinutes();
   var seconds = digital.getSeconds();
   if (minutes <= 9) minutes = "0" + minutes;
   if (seconds <= 9) seconds = "0" + seconds;
   dispTime = hours + ":" + minutes + ":" + seconds;

   $('#basicclock').html("ds");
//   basicclock.innerHTML = "2";
//   setTimeout("clock()", 1000);
}

//clock();



            </script>
   <script>
        // $(document).ready(function(){
        //     $('.tabs').tabs();
        // });
        
        $(document).ready(function(){
//            $('.sidenav').sidenav();
//            $(".dropdown-trigger").dropdown();
//            $('.carousel').carousel();
            $('.fixed-action-btn').floatingActionButton();
            console.log($('.tabs').tabs());
            
//            alert();
//                $("#iconoRayoderechaabajo").click(()=>{
//                      alert("d");
//                      $(".modal").modal();
//                      
//                      
//                      
//                });
                     $(".modal").modal();


        });
//        document.addEventListener('DOMContentLoaded', function() {
//        var elems = document.querySelectorAll('.sidenav');
//        var instances = M.Sidenav.init(elems, options);
//        });

//        $(()=>{
//            $(".btn-menu").click((t)=>{
//                
//                $(".btn-menu").css("background","transparent");
//                $(t.currentTarget).css("background","burlywood");
//            });
//        });
        
        
//     floating components

  // Or with jQuery

  
  $('.fixed-action-btn').floatingActionButton({
//    toolbarEnabled: true,
     direction: 'top',
      hoverEnabled: false
  })
  
//  end floating components

         document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('.fixed-action-btn');
    var instances = M.FloatingActionButton.init(elems, {
//      direction: 'left',
      hoverEnabled: false
    });
  });
       
       
       
        
    </script>         
        
        <style>
            
            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                background-color:#009999 ;
                color: white;
                text-align: center;
            }
            .modal{
                width: 90% !important;
                height: 100% !important;
            }
            .icon-animated-rayo{
                animation-duration: 3s;
            }
/*        .animacion {
-webkit-animation:fa-spin 20s infinite linear;animation:fa-spin 24s infinite linear;*/

/*@media only screen and (max-width:320px){
#Contenedor{
	width: 100%;
	height: auto;
	margin: 0px;
}*/
 /*animation-name: slidein;*/
 
 
/*    body{
        cursor:url(http://falconmasters.com/img/cursor.gif), auto;
      cursor: url(../../images/base/enerinLogo.png);
   }*/
/*   a, a:hover{
   cursor: url(../../images/base/enerinLogo.png), help;
    }*/
   
/*  .sidenav .divider
            {
                margin:0px !important;
            }
            .waves-effect.waves-omg .waves-ripple
            {
                background-color: #3399cc;
            }
            .blue-text
            {
                color: #3399cc !important;
            }
            .sidenav li>a
            {
                padding: 0 0 0 32px;
            }
         
            */
            
</style>
    </head>
    <div class="icon-animated-rayo">
        <!--dasdsadadaasd-->
        
    </div>
    <body class="has-fixed-sidenav">
<!--      
        <div id="" style="position:absolute;left:10px;top:1px;width:175px;height:315px;z-index:0;">
<img src="../../images/base/img0001.png" id="Shape1" alt="" style="width:125px;height:315px;"></div>
<div id="" style="position:absolute;left:2px;top:280px;width:175px;height:310px;z-index:1;">
<img src="../../images/base/img0002.png" id="Shape2" alt="" style="width:125px;height:315px;"></div>-->
        <!--<div id=""> <img  class="" style="float:right;width:220px;height:220px;" src="../../images/base/omgapps.png" alt="descripción" /></div>-->
<!--        <div class="rombo"></div>
        <div class="cuadrado"></div>
	<div class="oval "></div>-->
        <!--<p>ddsd </p>-->

<!--<center>
<br>
<span style="font-size:13px;font-family:Arial;font-weight:normal;text-decoration:none;color:#000000">This page is password protected.<br><br><br></span>
<form name="logon">
   <table style="background-color:#FFFFFF;border:1px solid #000000;border-spacing:0;">
   <tr>
      <td colspan="2" style="background-color:#000000;color:#FFFFFF;text-align:center;padding:4px;font-size:13px;font-family:Arial;font-weight:normal;text-decoration:none;"><strong>Login</strong></td>
   </tr>
   <tr>
      <td style="font-size:13px;font-family:Arial;font-weight:normal;text-decoration:none;color:#000000;text-align:right" width="30%" height="60">Password:</td>
      <td style="font-size:13px;font-family:Arial;font-weight:normal;text-decoration:none;color:#000000;text-align:left" width="70%" height="60"><input type="password" name="password" value="" style="border:1px solid #000000;width:120px;">&nbsp;&nbsp;<input type="button" value="Login" name="Login" onclick="decrypt(password.value)"></td>
   </tr>
   </table>
</form>
</center>-->

 <div class="navbar-fixed">
     <nav class="navbar" style="background-color:#006699 ">
          <div class="nav-wrapper"> 
              <center><h4>OMG <a href="#" class="brand-logo"><img src="../../images/base/enerinLogo.png" height="100%"></a> &nbsp;&nbsp;&nbsp; Apps</h4> </center>
            <ul id="nav-mobile" class="right">
               <ul class="right hide-on-med-and-down">
<!--                    <li><a href="sass.html"><i class="material-icons">search</i></a></li>
                    <li><a href="badges.html"><i class="material-icons">view_module</i></a></li>
                    <li><a href="collapsible.html"><i class="material-icons">refresh</i></a></li>-->
                    <!--<li><a href=""><i class="material-icons">more_vert</i></a></li>-->
                   
                 

                </ul>
                <div class="nav-content">
                    <span class="nav-title">  </span>
                    <a class="btn-floating btn-large halfway-fab waves-effect waves-light teal">
                      <!--<i class="material-icons">add</i>-->
                        <i class="material-icons">business_center</i>
                        <!--<img src="../../images/base/omgapps.png" height="90%">-->                  
                    </a>
                </div>
            </ul><a href="#!" data-target="sidenav-left" class="sidenav-trigger left"><i class="material-icons black-text">menu</i></a>
          </div>
        </nav>
      </div>

<!--<div class="navbar-fixed">
    <nav class="navbar white">
      <div class="nav-wrapper">
        <a href="#!" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="sass.html">Sass</a></li>
          <li><a href="badges.html">Components</a></li>
        </ul>
      </div>
    </nav>
  </div>-->

<!--<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>-->


 <div class="card">
    <div class="card-content">
      <p>  <center><div style="font-size: 20px">Interacción estructurada y orientada, con datos precisos para Decisiones adecuadas.</div></center> </p>
    </div>
    <div class="card-tabs">
      <ul class="tabs tabs-fixed-width">
          <li class="tab" style="border-style: solid;border-color: #006699"><a class="active" href="#accesologin" style="color:black;background: gray;">Acceso Al Sistema</a></li>
        <li class="tab" style="border-style: solid;border-color: #006699"><a  href="#terminosycondiciones" style="color:black;background: gray;">Terminos Y Condiciones</a></li>
        <li class="tab" style="border-style: solid;border-color: #006699"><a href="#registroalsistema" style="color:black;background: gray;">INFORMACION DE APP</a></li>
      </ul>
    </div>
    <div class="card-content grey lighten-4">
        <div id="accesologin">
            
                    <!--<div id="Contenedor">-->
                <!--<div id="container">-->
                <div style="padding-left: 20%;padding-right: 20%">
            <div class="Icon"><span class="glyphicon glyphicon-user"></span>  </div>
            
            <div class="ContentForm">
               


                <form id="loginform"  method="post" name="FormEntrar">
<!--                        <div class="input-group input-group-lg">
                          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
                          
                          <input type="text" class="form-control" autocomplete="false" name="usuario" placeholder="Usuario" id="Usuario"  required>
                        </div>
                        <br>
                        <div class="input-group input-group-lg ">
                          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                          <input type="password" name="pass" class="form-control" placeholder="******" aria-describedby="sizing-addon1" required>
                        </div>-->
                        
                             <div class="row">
                                 <div class="input-field col s12 light-blue-text text-darken-3">
                                     <i class="material-icons prefix">person</i>
                                         <label for="Usuario">USUARIO</label>
                                        <input id="Usuario" name="usuario" type="text"  class="autocomplete light-blue-text text-darken-4" autocomplete="off">
                                      
                                    
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="input-field col s12 light-blue-text text-darken-3">
                                     <i class="material-icons prefix">vpn_key</i>
                                     <input id="contrasenaInput" name="pass" type="password" id="pass-input">
                                     <label for="contrasenaInput">CONTRASEÑA</label>
                                 </div>
                             </div>
                             <input id="t" name="t" type="hidden" value="<?php 
                                   if(isset($_REQUEST["t"])){
                                       echo $_REQUEST["t"];
                                   }else{
                                    if($_SERVER["SERVER_NAME"] == "localhost")
                                    {
                                       echo "interno";      
                                    }
                                      
                                       
                                   }
                                       ?>">   
                             <div class="row">
                                 <div class="input-field col s12">
                                     <button data-placement="right" title="Haga clic aquí para iniciar sesión" class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="submit">Entrar</button>
                                 </div>
                             </div>
                        
                       
                        <!--<div class="opcioncontra "><a href="">Olvidaste tu contraseña?</a></div>-->
                        
                        
                        
                        
                        
                </form>   

            </div>
         </div>
            
            
        </div>
        <div id="terminosycondiciones">
            <div align="justify">
                <b>  Bienvenido a OMG Apps, opera por medio de Energía Integral S.A. de C.V. bajo la licencia del Autor Javier M. Dávila Bartoluchi. (La “Compañía”, “nosotros” o “nos”). Nos permite ofrecerle acceso al Servicio (como se define más abajo), sujeto a estos términos y condiciones, así como a la Política de Privacidad de la empresa. Al ingresar y utilizar el Servicio, usted da su aprobación, acuerdo y entendimiento de los Términos y condiciones.</b> 
                <p><b> 1. Generalidades sobre los Términos de Servicio.</b></p>
                <p><b> 1.1 Para su conveniencia, estos términos están disponibles en español y en inglés, pero en caso de cualquier conflicto la versión en español será la definitiva.</b></p>
                <p><b>1.2 Los términos que están en mayúscula se definen en el cuerpo de estos Términos de Servicio o en la Sección 10.</b></p>
                <p><b>1.3 La Compañía posee y opera la herramienta web, que se encuentra disponible a través de https://enerin-omgapps.com (el “website” o el “sitio”). Le ofrecemos una herramienta  que se fundamenta en tres partes Organización, medición y gestión. El Servicio incluye el acceso al sitio específicamente para la capacidad contratada. Estos datos de contratación son administrados por la Compañía.</b></p>
                <p><b>1.4 Lo siguiente es un breve resumen de determinados términos y condiciones que se incluyen en estos Términos de Servicio. No obstante, este resumen se proporciona únicamente para su comodidad; por lo tanto, usted debería leer todos los Términos de Servicio antes de aceptarlos. Se le concede el derecho a utilizar el Servicio, sometido a los presentes Términos de Servicio. Este derecho de uso está limitado a la cantidad establecida en el contrato con la compañía, siendo de carácter  individual, negocio o entidad corporativa, el cual es intransferible, a menos que conste por escrito el consentimiento expreso de la Compañía. Su negativa a aceptar los términos de dichos acuerdos podría limitar su capacidad de utilizar plenamente el Servicio. No obstante otra disposición contenida en el presente documento, el Servicio estará disponible en periodo máximo de 3 días, posterior al pago correspondiente por el derecho de uso del servicio. El Servicio funciona con  computadora personal y dispositivos móviles mientras tenga conexión a internet. Para utilizar el Servicio, se le proporcionará una cuenta de administrador del sitio para crear el número de usuarios establecidos en el servicio. Nos reservamos el derecho a realizar actualizaciones periódicas del Servicio, con o sin previo aviso. El Servicio incluye funciones relacionadas con la seguridad y la manipulación indebida que, en caso de activarse, podrían ocasionar que el contenido previamente disponible para su uso, deje de estarlo a partir de entonces. Al utilizar el Servicio, usted autoriza la recopilación, procesamiento y utilización de toda aquella información relacionada con el uso que usted hace del Servicio, la cual se recopila y maneja de conformidad con los términos de nuestra Política de Privacidad. En caso de algún cambio sustancial, haremos todos los esfuerzos comercialmente razonables para notificárselo, en caso de tener alguna duda, envíela desde cualquier correo a la dirección soporteomgapps@enerin.mx.</b></p>
            </div>
        </div>
        <div id="registroalsistema">
            <center>
             <video  width="33%" height="" src="../../movies/base/GTE PRESENTACION DINAMICA29111801.mp4" controls></video>
            <!--<video  width="33%" height="" src="../../movies/base/Tutorial Esquematico 121118.mp4" controls></video>-->
            <video  width="33%" height="" src="../../movies/base/Tutorial APP alta resolucion.mp4" controls></video>
            </center>
            
            
        </div>
    </div>




  </div>



        <div class="col s12 m7">
            
           
            
        <!--<h5 class="header">Horizontal Card</h5>-->
        <!--<a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>-->
<!--         <div class="card horizontal">
         <div class="row" >
                                                <div class="col s12">
                                                    <ul id="tabs" class="tabs">
                                                        <li class="tab col s4" style="border-style: solid;"><a href="#accesoSistema" style="color:black;background: gray;"><b>Acceso Al Sistema</b></a></li>
                                                        <li class="tab col s4" style="border-style: solid;"><a class="active" style="color:black;background: gray;" href="#test-swipe-2"><b>Inicio</b></a></li>
                                                        <li class="tab col s4" style="border-style: solid;"><a href="#test-swipe-3" style="color:black;background: gray;"><b>Registro Al Sistema</b></li>
                                                    </ul>

                                                </div>
                                    
                                            </div>
         </div>-->
        <div class="card horizontal">
              
          <div class="card-image">
              <!--<img src="../../images/base/enerinLogo.png" height="20%">-->
          </div>
          <div class="card-stacked">
            <div class="card-content">
                
                <!--#ee6e73-->
<!--                    <nav>
                        <div class="nav-wrapper">
                          <div class="col s12">
                                <div class="col s5">
                             f
                                            
                 
                          </div>
                            
                         
    
    
                        </div>
                    </nav>-->
                


                
                            <!--</div>-->
              <a  style="text-decoration:none"><center>CONOCIMIENTO, EXPERIENCIA E INNOVACION, EN LOS MAS DE 27 AÑOS ATENDIENDO EL MERCADO EMPRESARIAL.</center></a>
              
              
              
              
              <!--<div style="height: 40%;" ></div>-->
              
              <!--<div class="card-action" style="height: 80%">-->
              <!--<a href="#">This is a link</a>-->
              
              
              
             <!--<div id="accesoSistema" class="col s12">-->
                            
<!--                                    <div id="test3" class="col s12">Test 3</div>
                                    <div id="test4" class="col s12">Test 4</div>-->
              
              
              
              

<!--        <div id="Contenedor">
            <div class="Icon"><span class="glyphicon glyphicon-user"></span>  </div>
            
            <div class="ContentForm">
               


                <form id="loginform"  method="post" name="FormEntrar">
                        <div class="input-group input-group-lg">
                          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
                          
                          <input type="text" class="form-control" autocomplete="false" name="usuario" placeholder="Usuario" id="Usuario"  required>
                        </div>
                        <br>
                        <div class="input-group input-group-lg ">
                          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
                          <input type="password" name="pass" class="form-control" placeholder="******" aria-describedby="sizing-addon1" required>
                        </div>
                        
                             <div class="row">
                                 <div class="input-field col s12 light-blue-text text-darken-3">
                                     <i class="material-icons prefix">person</i>
                                         <label for="user-input">USUARIO</label>
                                        <input id="Usuario" name="usuario" type="text"  class="autocomplete light-blue-text text-darken-4" >
                                      
                                    
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="input-field col s12 light-blue-text text-darken-3">
                                     <i class="material-icons prefix">vpn_key</i>
                                     <input id="contrasenaInput" name="pass" type="password" id="pass-input" class="autocomplete">
                                     <label for="pass-input">CONTRASEÑA</label>
                                 </div>
                             </div>

                             <div class="row">
                                 <div class="input-field col s12">
                                     <button data-placement="right" title="Haga clic aquí para iniciar sesión" class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="submit">Entrar</button>
                                 </div>
                             </div>
                        
                       
                        <div class="opcioncontra "><a href="">Olvidaste tu contraseña?</a></div>
                        
                        
                        
                        
                        
                </form>   

            </div>
         </div>-->

<!--cierre del primer tabs con el contenido en este caso del login-->
             <!--</div>-->
<!--aqi termina--> 



<!--segunda opcion del tab-->
<!--<div id="terminosycondiciones" class="col s12">
    
    
    
    H
    
    
  </div>-->



<!--end segunda opcion del tab-->












         </div>
          </div>
        </div>
      <!--</div>-->

       
      
       <div class="row"  >
           <div class="col s12 m4"  >
             <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="../../images/base/grafica.png">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Visualiza el proceso de tus temas.
<i class="material-icons right">more_vert</i></span>
      <p><a href="#">....</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Visualiza el proceso de tus temas.<i class="material-icons right">close</i></span>
    <p>Visualiza el proceso de tus tareas
        Por medio de un gráfico circular, dividido en segmentos en un primer nivel puede visualizar el proceso de los temas de acuerdo a la clasificación predeterminada por el sistema, basada en
        Temas suspendidos, en proceso – en tiempo, con alerta vencida y con Tiempo Vencido.
    </p>
    <p>
        En un nivel de detalle 2, al seleccionar un segmento podrá visualizar el Nombre del responsable o responsables y si requiere más detalle podrá ver los temas asignados a dichos responsables.
    </p>
    </div>
  </div>
           </div>
           
           
        
           
     
                  <div class="col s12 m4"  >
             <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="../../images/base/gant_tareas.jpg">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Haz eficiente tus reuniones<i class="material-icons right">more_vert</i></span>
      <p><a href="#">....</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Haz eficiente tus reuniones<i class="material-icons right">close</i></span>
      <p>Haz eficiente tus reuniones
Llega a la reuniones con tus colaboradores y otras personas con datos clave de seguimiento y actualizados, eliminando el uso de sistemas de almacenamiento de archivos y documentos con varias versiones que te generan tiempo improductivo.
</p>
    </div>
  </div>
           </div>
   
           
                  <div class="col s12 m4"  >
             <div class="card">
    <div class="card-image waves-effect waves-block waves-light">
      <img class="activator" src="../../images/base/temasespeciales_presentacion_login.png">
    </div>
    <div class="card-content">
      <span class="card-title activator grey-text text-darken-4">Controla tus Temas<i class="material-icons right">more_vert</i></span>
      <p><a href="#">....</a></p>
    </div>
    <div class="card-reveal">
      <span class="card-title grey-text text-darken-4">Controla tus Temas<i class="material-icons right">close</i></span>
      <p>Controla tus Temas
Registra aquellos temas a los cuales debes dar seguimiento, asigna un plan de trabajo a tus colaboradores,
Revisa sus avance, las anotaciones, integra a tu equipo para trabajar en un mismo lugar y hacia un mismo objetivo. 

</p>
    </div>
  </div>
           </div>
           
           
           
           
           
           
        </div>
      
      <div class="footer">
        <p>Copyright © 2018 - 2019 Javier M. Davila Bartoluchi</p>
      </div>
      


        <div class=" fixed-action-btn">
            <a class="icon-animated-rayo btn-floating btn-large   waves-effect waves-light btn modal-trigger" id="iconoRayoderechaabajo" style="background-color:#006699" href="#modal1">
                <!--<a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>-->
              <!--<i class="large material-icons">mode_edit</i>-->
              <img src="../../images/base/enerinLogo.png" height="100%">
            </a>
            <!--<ul style="">-->
                <!--<div style="width: 100% !important">-->
                    <!--right: 1800%; padding-right: 1800%; padding-top: 800%;-->
                    <!--<li style=""><a class="btn-floating"   style="right:100px;  border-radius: 40px; opacity: 1; transform: scale(1) translateY(0px) translateX(0px); background-color: white;">-->
                        
                        <!--<i class="material-icons" >insert_chart</i>-->
                        <!--<i class="" >-->
                          
                            
                        <!--</i>-->
                        
                 
                 
                   
                   
                   <!--</a></li>--> 
<!--                </div>-->
                
                
                
                
              <!--<li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a></li>-->
              <!--<li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a></li>-->
              <!--<li><a class="btn-floating green"><i class="material-icons">publish</i></a></li>-->
              <!--<li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a></li>-->
            <!--</ul>-->
        </div>




      

    </body> 
    
    
</html>


  <!-- Modal Trigger -->
<!--  <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>-->

  <!-- Modal Structure -->
  <div id="modal1" class="modal">
    <!--<div class="modal-content">-->
     
      <p>
          <iframe width="100%" height="100%" src="../../movies/base/GestiTemas EspecialesApuntes.html"></iframe>
        
      </p>
    <!--</div>-->
<!--    <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
    </div>-->
  </div>
//<?php
//}
//?>