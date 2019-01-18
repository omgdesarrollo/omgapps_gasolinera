<?php

session_start();

require_once '../util/Session.php';


$Op=$_REQUEST["Op"];


switch ($Op) {
    case "envioCorreo":
        
$to=$_REQUEST["para"];
$asunto=$_REQUEST["asunto"];
$mensaje=$_REQUEST["mensaje"];

$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
 
$messageCompleto = "
<html>
<head>
<title>Titulo</title>
</head>
<body>
<h1>".$mensaje."</h1>
</body>
</html>";
 
mail($to, $asunto, $messageCompleto, $headers);

 break;
    
    
    
}
?>
