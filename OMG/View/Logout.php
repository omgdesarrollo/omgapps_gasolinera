
<?php
require_once '../util/Session.php';
require_once '../Pojo/ConexionesBDPojo.php';
session_start();
$tipo= ConexionesBDPojo::dataBD(Session::getSesion("tipo"));
// session_start();
// session_unset();
session_destroy();
// foreach( $_SESSION as $key => $value )
// {
//     echo json_encode($key);
//     echo json_encode($value);
// }
?>

<?php
header('location: login.php?t='.$tipo["05"]);
?>
