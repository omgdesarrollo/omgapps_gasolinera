<?php

session_start();
require_once '../Model/EmpleadoModel.php';
require_once '../Model/Gantt_TareasModel.php';
require_once '../Model/ArchivoUploadModel.php';
require_once '../util/Session.php';

$Op=$_REQUEST["Op"];
$model=new EmpleadoModel();
$modelGantt=new Gantt_TareasModel();
$modelArchivo=new ArchivoUploadModel();
// $pojo=new GanttPojo();
switch ($Op) {
        case 'ListarTodasLasTareasPorId':
            $Lista= $modelGantt->listarRegistrosGanttTareas(Session::getSesion("dataGantt_id_tarea"));
          if(Gantt_TareasModel::verificarSiExisteIDTareaEnGanttTareas(array("id_tarea"=>Session::getSesion("dataGantt_id_tarea")))=="true"){
              Gantt_TareasModel::actualizarExisteProgramaTareas(array("existeprograma"=>1,"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
          }else{
               Gantt_TareasModel::actualizarExisteProgramaTareas(array("existeprograma"=>0,"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
          }
//            foreach ($Lista as $key => $value) {
//            $url= $_REQUEST['URL'].$value['id'];
//            $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls(-1,$url);
//            }
          
            header('Content-type: application/json; charset=utf-8');
            echo json_encode(array("data"=>$Lista));
            break;            
            
        case 'ListarTodasLasTareasDetallesPorSuId':
            $Lista= $modelGantt->listarRegistrosGanttTareas(Session::getSesion("dataGantt_id_tarea"));
             
            if(Gantt_TareasModel::verificarSiExisteIDTareaEnGanttTareas(array("id_tarea"=>Session::getSesion("dataGantt_id_tarea")))=="true"){
                Gantt_TareasModel::actualizarExisteProgramaTareas(array("existeprograma"=>1,"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
            }else{
                 Gantt_TareasModel::actualizarExisteProgramaTareas(array("existeprograma"=>0,"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
            }
          
            foreach ($Lista as $key => $value) {
                $url= $_REQUEST['URL'].$value['id'];
                $Lista[$key]["archivosUpload"] = $modelArchivo->listar_urls(-1,$url);
            }
            
            header('Content-type: application/json; charset=utf-8');
            echo json_encode(array("data"=>$Lista));
            break;
            
        case 'ListarDescripcionEnDondeSeEstanLojandoLasTareas':
            
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            
            
        break;
            
        case 'calcularPorcentajeActividades':
            $Lista= $modelGantt->calcularPorcentajePorActividad();
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            break;
            
            
        case 'empleadosNombreCompleto':
            
	$Lista=$modelGantt->listarEmpleadosNombreCompleto("");
    	Session::setSesion("listarEmpleadosNombreCompleto",$Lista);
//    	$tarjet="../view/principalmodulos.php";
    	header('Content-type: application/json; charset=utf-8');
	echo json_encode($Lista);
                
		break;    
    
        case 'GuardarPonderado':
        header('Content-type: application/json; charset=utf-8'); 
        $Lista = json_decode($_REQUEST["DATA"],true);   
        if(isset($Lista[0]["ponderado_programado"])){
            echo "entro ";
            $resp["response"] = $modelGantt->guardarPonderados($Lista);
        }
//        if(isset($Lista[0]["notas"])){
//            $resp["response"]= $modelGantt->guardarNota($Lista[0]);
//        }
//            header('Content-type: application/json; charset=utf-8');
//             echo json_encode($resp);
//        }else{
//            $resp= $modelGantt->guardarNota($Lista[0]);
//        }
//            $VALUES["id"]= Session::getSesion("dataGantt_id_tarea");
//            $VALUES["text"]= $_REQUEST['TEXT'];
//            $VALUES["start_date"]= $_REQUEST['START_DATE'];
//            $VALUES["duration"]= $_REQUEST['DURATION'];
//            $VALUES["progress"]= $_REQUEST['PROGRESS'];
//            $VALUES["parent"]= $_REQUEST['PARENT'];
//            $VALUES["user"]= $_REQUEST['USER'];
//            $VALUES["id_tarea"]= $_REQUEST['ID_TAREA'];
//            
//            $Lista= $modelGantt->listarRegistrosGanttTareas($VALUES);
//            header('Content-type: application/json; charset=utf-8');
       
            
        break;
        
        case 'actualizardetabladetalles':
             $lista=$modelGantt->actualizarGanttTareasDeTablaDetalles(array($_REQUEST["COLUMNA"]=>$_REQUEST["VALUE"]),$_REQUEST["ID_TAREA"]);
             header('Content-type: application/json; charset=utf-8'); 
             echo json_encode($lista);
        break;
    
        case 'Eliminar':
            $Lista= $modelGantt->eliminarGanttTareas($_REQUEST['ID_GANTT_TAREAS']);
            header('Content-type: application/json; charset=utf-8');
            echo json_encode($Lista);
            break;
        
        
        case 'Actualizar':
            break;
	case 'ListarEmpleados'://este caso no borrarlo es para traer los difrentes empleados

	$Lista=$model->listarEmpleados("");
    	header('Content-type: application/json; charset=utf-8');
	echo json_encode($Lista);

		break;

    	


        case 'EliminarTarea':
             if(isset($_REQUEST["deleteidtarea"])){
//                echo "entro ";
//                 $value["id"]=$_REQUEST["deleteidtarea"];
                $modelGantt->eliminarGanttTareas($_REQUEST["deleteidtarea"]);
                  if($modelGantt->verificarSiExisteIDTareaEnGanttTareas(array("id_tarea"=>Session::getSesion("dataGantt_id_tarea")))=="true"){
                    $modelGantt->actualizarExisteProgramaTareas(array("existeprograma"=>1,"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
                  }else{
                    $modelGantt::actualizarExisteProgramaTareas(array("existeprograma"=>0,"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
                }    
                
                 $modelGantt::actualizarAvanceProgramaTareas(array("avance"=>$modelGantt::avanceProgramaTareas(array("id_tarea"=>Session::getSesion("dataGantt_id_tarea"))),"id_tarea"=>Session::getSesion("dataGantt_id_tarea")));
                
            }else{
                echo ":(";
            }
        break;
	case 'Modificar':
            
           
          $editing= $_REQUEST["editing"];
          $modo_gantt=$_REQUEST["gantt_mode"];
//          $server=$_SERVER["HTTP_REFERER"];
          	$numero = count($_POST);
            $tags = array_keys($_POST);// obtiene los nombres de las varibles
            $valores = array_values($_POST);// obtiene los valores de las varibles
            echo " &$##";
			// var_dump($valores);
			$arrayTransformado;
			$listaNo=0;
			$datos=0;
			$cas=0;
			foreach($tags as $key=>$value)
			{
				$cadenaKey;
				$valueKey = explode("_",$value,2);
				$tam = sizeof($valueKey);
				// echo $valueKey;
				foreach($valueKey as $ind=>$v)
				{
					if($tam!=1)
						$cadenaKey = $valueKey[1];
					else
						$cadenaKey = $valueKey[0];
				}
				$arrayTransformado[$listaNo][$cadenaKey] = $valores[$key];
				if($cadenaKey == "!nativeeditor_status")
					$listaNo++;
			}  
                        
//                        Session::setSesion("", $value);
                        //la variable de sesion del dataGant se refiere al id de seguimiento entrada que hace 
                        //referencia al folio de entrada de documento de entrada
                       
                                                                   
                        $modelGantt->insertarTareasGantt($arrayTransformado,Session::getSesion("dataGantt_id_tarea"));
                        
                        
			header('Content-type: application/json; charset=utf-8');
//                        echo json_encode($arrayTransformado);
         
            
	break;
        
        case 'EliminarTarea':
             if(isset($_REQUEST["deleteidtarea"])){
                $modelGantt->eliminarGanttTareas($_REQUEST["deleteidtarea"]);
            }else{
                echo ":(";
            }
        break;
        case "descendencia":
            $v["id"]=$_REQUEST["deleteidtarea"];
            header('Content-type: application/json; charset=utf-8');
            echo $modelGantt->verificarParentHijoEnTarea($v);
//            echo "\'true\'";
        break;
        case "insertarNotaHistorica":
            
            
        break;
    
    
        case "listarTareasModoChat":
            
              if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset(Session::getSesion("user")["ID_USUARIO"])){
				$data['status'] = 'success';
				$data['user'] 	= Session::getSesion("user");
			}else{
				$data['status'] = 'error';
			}
                
                
//                $modelGantt->notasHistoricas()
                        $data["tareas"]=$modelGantt->listarRegistrosGanttTareas(Session::getSesion("dataGantt_id_tarea"));
                 header('Content-type: application/json; charset=utf-8');
                echo json_encode($data);
            }
            
            
        break;
        case "notasHistoricasxActividad":
            
            header('Content-type: application/json; charset=utf-8');
           $data= json_decode( $_REQUEST["obtenerNotas"],true );
            
            echo json_encode($modelGantt->notasHistoricas($data[0]));
        break;
    
        case "insertarNotasHistoricas":
            header('Content-type: application/json; charset=utf-8');
           $data= json_decode( $_REQUEST["valoresEnvio"],true );
           $data["quiencreolanota"]=Session::getSesion("user")["ID_USUARIO"];
           echo json_encode($modelGantt->insertarNotasHistoricas($data));
        break;
        
        
        case "mostrarNotasHistoricas":
            
            $data;
            if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
                if(isset(Session::getSesion("user")["ID_USUARIO"])){
				$data['status'] = 'success';
				$data['user'] 	= Session::getSesion("user");
			}else{
				$data['status'] = 'error';
			}
                
                
//                $modelGantt->notasHistoricas()
                        $data["tareas"]=$modelGantt->notasHistoricas();
                 header('Content-type: application/json; charset=utf-8');
                echo json_encode($data);
            }
            
            
            
       
            
            
            
            
        break;
        
        
        

	case 'Eliminar':
		# code...
		break;	
                default: echo -1;
		# code...
		break;
}


?>


