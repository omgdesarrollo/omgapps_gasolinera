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

            $Lista=$model->listarEmpleados("tareas");  
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
    	Session::setSesion("listarEmpleadosComboBox",$Lista);
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
                  
                  $pojo->setIdentificador("tareas");
                  
                  $Lista= $model->insertar($pojo);
                  echo json_encode($Lista);
//                  return $Lista;
		break;
            
            
        case 'GuardarIdentificador':
            $Lista= $model->actualizarIdentificadorSubmodulo($_REQUEST['ID'],$_REQUEST['IDENTIFICADOR']."-tareas");
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            return $Lista;
            
            break;
        
        case 'VerificaCorreo':
            $existe = $model->verificaCorreo($_REQUEST['CORREO']);
            echo $existe;
            break;
            

	case 'Modificar':
		# code...
                        
                    $model->actualizarPorColumna($_REQUEST["column"],$_REQUEST["editval"],$_REQUEST["id"] );

	break;

	case 'Eliminar':
		# code...
		break;	
	default:
		# code...
		break;
}


?>


