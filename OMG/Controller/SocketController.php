<?php
session_start();

require_once '../util/Session.php';


$address = '192.168.1.72';
$port = 8686;
$sock="";
$bind="";
$listen="";

$Op=$_REQUEST["Op"];
switch($Op)
{
    case "socket":
    // @echo OFF
    // $php "../Model/socketModel.php";
    // C:\xampp\htdocs\enerin-omg\OMG\Model
    // $ol = shell_exec("exec.bat");
    // {
    //     // echo "socket_bind() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
    // }

    // if (@socket_listen($sock, 5) == false)
    // {
    //     // echo "socket_listen() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
    // }
    // // socket_set_timeout($sock,1000);
    // // Session::setSesion([""]);
    $sock="HOLA";
    Session::setSesion("estadoServidor",$sock);
    // sleep(4);
    $sock="MUNDO";
    Session::setSesion("estadoServidor",$sock);
    // sleep(4);
    // do {
            // echo "$buf\n";
        // } while (true);
        // socket_close($msgsock);
    // } while (true);
    // echo $sock;
    // echo $bind;
    // echo $listen;
    $sock="COMO";
    Session::setSesion("estadoServidor",$sock);
    // sleep(4);
    $sock="Estas";
    Session::setSesion("estadoServidor",$sock);
    echo $sock;
    break;
    case 'conect':
        echo Session::getSesion("estadoServidor");;
        // socket_connect();
    break;
    case 'cerrarSocket':
        socket_close($msgsock);
    break;

    // if (($msgsock = socket_accept($sock)) === false) {
    //     echo "socket_accept() falló: razón: " . socket_strerror(socket_last_error($sock)) . "\n";
    //     break;
    // }

    // $msg = "\nBienvenido al Servidor De Prueba de PHP. \n" .
    //     "Para salir, escriba 'quit'. Para cerrar el servidor escriba 'shutdown'.\n";
    // socket_write($msgsock, $msg, strlen($msg));

    // if (false === ($buf = socket_read($msgsock, 2048, PHP_NORMAL_READ)))
    // {
    //     echo "socket_read() falló: razón: " . socket_strerror(socket_last_error($msgsock)) . "\n";
    //     break 2;
    // }
    // if (!$buf = trim($buf)) {
    //     continue;
    // }
    // if ($buf == 'quit') {
    //     break;
    // }
    // if ($buf == 'shutdown') {
    //     socket_close($msgsock);
    //     break 2;
    // }
    // $talkback = "PHP: Usted dijo '$buf'.\n";
    // socket_write($msgsock, $talkback, strlen($talkback));

}    
?>
