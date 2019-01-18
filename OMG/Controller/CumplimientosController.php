<?php
//este controlador solo atiende un requerimiento
//el requerimiento que atiende es el de inicio de sesion
session_start();
require_once '../Model/CumplimientoModel.php';
require_once '../Pojo/CumplimientoPojo.php';
require_once '../Pojo/UsuarioPojo.php';
require_once '../util/Session.php';



$Op=$_REQUEST["Op"];
@$operacionarealizar=$_REQUEST["TipoOperacion"];
$model=new CumplimientoModel();
$cumplimientoPojo= new CumplimientoPojo();
$usuarioPojo= new UsuarioPojo();

switch ($Op) {
	case 'Listar':
				$ID_USUARIO= Session::getSesion("user")["ID_USUARIO"];
				isset($_REQUEST["ID_USUARIO"])?
               	$lista = $model->listarCumplimientos($_REQUEST["ID_USUARIO"]):
                $lista = $model->listarCumplimientos($ID_USUARIO);
				header('Content-type: application/json; charset=utf-8');
				echo json_encode($lista);
		break;
            
        case 'ListarCumplimiento':
                $lista = $model->listarCumplimiento($_REQUEST['ID_CUMPLIMIENTO']);
		header('Content-type: application/json; charset=utf-8');
		echo json_encode($lista);
		break;        
                
        case 'mostrarcombo':
		$Lista=$model->listarCumplimientosComboBox();
    	Session::setSesion("listarCumplimientosComboBox",$Lista);
    	header('Content-type: application/json; charset=utf-8');
		echo json_encode($Lista);
		return $Lista;
		break;
                
	case 'obtenerContrato':
            $lista;
            if(isset(Session::getSesion("user")["ID_USUARIO"]))
		$lista=$model->obtenerContratosPorUsuarioPermiso(Session::getSesion("user")["ID_USUARIO"]);
            else
                $lista=-1;
            header('Content-type: application/json; charset=utf-8');
		// foreach($lista as $key=>$value)
		// {
		// 	foreach($value as $key2=>$val)
		// 		$lista[$key][$key2] = utf8_encode($val);
		// }
                
            
			echo json_encode($lista);
		break;
         
	case 'Guardar':
		# code...
		break;
        case 'contratoselec':
//            if($_REQUEST["obt"]=="false"){
//               if(isset(Session::getSesion("s_cont")))
//               {
//                  echo  Session::getSesion("s_cont");
//               }else
//               {
	
//                   echo "no";
//               }
//            }
//            else{if()
            if($_REQUEST["obt"]=="false"){
            Session::setSesion("s_cont", $_REQUEST["c"]);
            $v["contrato"]=Session::getSesion ("s_cont");
            $Lista= $model->detallesContratoSeleccionado($v);
//            foreach($Lista as $key=>$value)
//		{
//			
//                    $Lista[$key] = utf8_encode($value);
//		}
            
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            } else{
//                Session::getSesion ("s_cont");
                
                $v["contrato"]=Session::getSesion ("s_cont");
                $Lista= $model->detallesContratoSeleccionado($v);
                
//                foreach($Lista as $key=>$value)
//                   {
//                        $Lista[$key] = utf8_encode($value);
//                   }
                if($Lista==null)
                {
                    $Lista=[];
                }
                header('Content-type: application/json; charset=utf-8');     
                echo json_encode($Lista);
            }
//            }
        break;

	case 'Modificar':
		# code...
                  $pojo->setIdCumplimiento($_REQUEST['id_cumplimiento']);
                  $pojo->setClaveCumplimiento($_REQUEST['clave_cumplimiento']);
                  $pojo->setCumplimiento($_REQUEST['cumplimiento']);
                  $model->actualizar($pojo);
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
		# code...
		break;
}

?>


