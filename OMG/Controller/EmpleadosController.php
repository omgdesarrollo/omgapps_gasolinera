<?php
//este controlador solo atiende un requerimiento
//el requerimiento que atiende es el de inicio de sesion
session_start();
require_once '../Model/EmpleadoModel.php';
require_once '../Pojo/EmpleadoPojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
$model=new EmpleadoModel();
$pojo= new EmpleadoPojo();

switch ($Op) {
	case 'Listar':

            $Lista=$model->listarEmpleados("catalogo");
            Session::setSesion("listarEmpleados",  $Lista);          
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);

		return $Lista;
		break;
        
        case 'ListarEmpleado':
            $resultado = $model->listarEmpleado($_REQUEST['ID_EMPLEADO']);
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($resultado);
            
            break;
        
            
        case 'mostrarcombo':
		$Lista=$model->listarEmpleadosComboBox();
                Session::setSesion("listarEmpleadosComboBox", $Lista);
//    	$tarjet="../view/principalmodulos.php";
    	header('Content-type: application/json; charset=utf-8');
//		echo json_encode($Lista);
                echo json_encode($Lista);
//	$filas=array();	
//        foreach ($Lista as $filas)
//            //$sentencia="SELECT * FROM empleados";
//            //$resultado=mysql_query($sentencia);
//            //while($filas=mysql_fetch_assoc($resultado))
//              
//            {
//            echo json_encode($filas['ID_EMPLEADO']);	
//            }
		//header("location: login.php");
//echo $json = json_encode(array("n" => "".$Lista.NOMBRE_EMPLEADO, "a" => "apellido",  "c" => "test"));
		return $Lista;
		break;
            
        case 'nombresCompletos':   
            $Lista= $model->nombresCompletosCombobox();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            break;
        
	case 'Nuevo':
		# code...
		break;	

    case 'Guardar':
        header('Content-type: application/json; charset=utf-8');
        $data = json_decode( $_REQUEST["EmpleadoDatos"],true );

        $pojo->setNombreEmpleado($data["nombre_empleado"]);
        $pojo->setApellidoPaterno($data["apellido_paterno"]);
        $pojo->setCategoria($data["categoria"]);
        $pojo->setApellidoMaterno($data["apellido_materno"]);
        $pojo->setCorreo($data["email"]);
        
        $pojo->setIdentificador("catalogo");

        $Lista= $model->insertar($pojo);
        echo json_encode($Lista);
        // return $Lista;
    break;
            
            
        case 'GuardarIdentificador':
            $Lista= $model->actualizarIdentificadorSubmodulo($_REQUEST['ID'],$_REQUEST['IDENTIFICADOR']."-catalogo");
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            return $Lista;
            
            break;
            
        
        case 'VerificaCorreo':
            $existe = $model->verificaCorreo($_REQUEST['CORREO']);
            echo $existe;
            break;
        
        case 'VerificaCorreoWeb':// ya no funciona se requiere pago
            $email = $_REQUEST["CORREO"];
            $key = "xTUfzTSfuUAJ65zM7Xyhb";
            $url = "https://app.verificaremails.com/api/verifyEmail?secret=".$key."&email=".$email;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
            $response = curl_exec($ch);
            echo $response;
            curl_close($ch);            
            break;

	case 'Modificar':
		# code...
//                  $pojo->setNombreEmpleado($_REQUEST['Nombre']);
//                  $pojo->setApellidoPaterno($_REQUEST['Apellido_Paterno']);
//                  $pojo->setCategoria($_REQUEST['Apellido_Materno']);
//                  $pojo->setIdEmpleado($_REQUEST['ID_EMPLEADO']);
//                  $pojo->setCorreo($_REQUEST['CORREO']);
//                  $pojo->setApellidoPaterno($_REQUEST['APELLIDO_PATERNO']);
//                  $pojo->setApellidoMaterno($_REQUEST['APELLIDO_MATERNO']);
//                  $pojo->setCategoria($_REQUEST['CATEGORIA']);
//                  $pojo->setCorreo($_REQUEST['$CORREO']);
            
            
                    $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );
//                  $model->actualizar($pojo);
//                  $msg=$exito['mensaje'];
//                  if($exito['Error']==0){
//                      header('Content-type: application/json; charset=utf-8');
//                      echo json_encode(array("data" => $msg));
//                  }
	break;

	case 'Eliminar':
		# code...
		break;	
	default:
		return -1;
		break;
}


?>


