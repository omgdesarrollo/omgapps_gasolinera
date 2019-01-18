<?php


session_start();
require_once '../Model/AdminModel.php';
require_once '../Model/EmpleadoModel.php';
// require_once '../Pojo/DocumentoEntradaPojo.php';
// require_once '../Pojo/SeguimientoEntradaPojo.php';
require_once '../util/Session.php';

 

$Op=$_REQUEST["Op"];
$model = new AdminModel();
$modelEmpleado=new EmpleadoModel();

// $pojo= new DocumentoEntradaPojo();
// $modelSeguimientoEntrada=new SeguimientoEntradaModel();
// $pojoSeguimientoEntrada= new SeguimientoEntradaPojo();

switch ($Op)
{
    case 'Listar':
        $usuario = Session::getSesion("user")["ID_USUARIO"];
        $lista = $model->listarUsuarios($usuario);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
    break;

	case 'BusquedaEmpleado':
		$lista=$modelEmpleado->BusquedaEmpleado($_REQUEST["CADENA"]);
    	header('Content-type: application/json; charset=utf-8');
		echo json_encode($lista);
        // return $lista;
    break;

    case 'ListarPermisos':
        $lista=$model->listarUsuarioVistas($_REQUEST["ID_USUARIO"]);
    	header('Content-type: application/json; charset=utf-8');
		echo json_encode($lista);
    break;

    case 'ListarUsuario':
        $lista = $model->listarUsuario($_REQUEST["ID_EMPLEADO"]);
        
        // header('Content-type: application/json; charset=utf-8');
		// echo json_encode($lista);
        break;

    case 'ListarTemas':

        $lista = $model->listarTemas(trim($_REQUEST["CADENA"]),$_REQUEST["ID_USUARIO"],Session::getSesion("s_cont"));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
        break;

    case 'ListarTemasPorUsuario':
        $lista = $model->listarTemasPorUsuario($_REQUEST["ID_USUARIO"],Session::getSesion("s_cont"));
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($lista);
        
        break;
    
    case 'AgregarUsuario':
        $result = $model->InsertarUsuario($_REQUEST["ID_EMPLEADO"],$_REQUEST["NOMBRE_USUARIO"]);
        header('Content-type: application/json; charset=utf-8');
		echo json_encode($result);
    break;

    case 'AgregarUsuarioTema':
        $result = $model->insertarUsuarioTema($_REQUEST['ID_USUARIO'],$_REQUEST['ID_TEMA']);
        header('Content-type: application/json; charset=utf-8');
        echo json_encode($result);
        break;

    
    case 'CrearTablaPermisos':
        $lista = $model->listarSubmodulos();
        $usuario = Session::getSesion("user");
        $bandera=0;
        // var_dump( $usuario );
        // foreach($lista as $key=>$datos)
        // {
        //     echo "$key \n";
        //     foreach($datos as $val)
        //     {
        //         echo "\n";
        //         echo " $val[descripcion]";
        //         // header('Content-type: application/json; charset=utf-8');
        //         // echo json_encode($val);
        //     }
        //     // echo $key."\n";
        //     // header('Content-type: application/json; charset=utf-8');
        //     // echo json_encode($datos);
        //     // echo "\n";
        // }
        
        $tempData="";
        $idEstruct=2;
        $textCheckBox = "<input type='checkbox' style='width:40px;height:40px;margin:7px 0 0;'";
        
        foreach($lista as $index=>$value)
        {
            $tempData .= "<tr>";
            $tempData2 = "";
            $tempData3 = "";
            $cont=0;
            $bandera=0;
            
            foreach ($value as $ind=>$val)
            {
                $vista = explode("-",$val['descripcion']);
                // echo $vista[1];
                if($cont==0)
                {
                    //ver/consultar/editar/eliminar
                    if($usuario["ID_USUARIO"]<1)
                    {
                        $tempData2 .= "<tr>";
                        $tempData2 = "<td style='border-top: 1px solid;border-right: 1px solid;'>$vista[1]</td>";
                        $tempData2 .= "<td onClick=\"saveCheckBoxToDataBase(this,'consult','$val[id_estructura]')\" id='consult_$val[id_estructura]' style='border-top: 1px solid;border-right: 1px solid;cursor:pointer;'></td>";
                        $tempData2 .= "</tr>";
                        $bandera = 1;
                        $cont++;
                    }
                    else
                    {
                        if($vista[1] != "Permisos" && $vista[1] != "Control Temas")
                        {
                            $tempData2 .= "<tr>";
                            $tempData2 = "<td style='border-top: 1px solid;border-right: 1px solid;'>$vista[1]</td>";
                            $tempData2 .= "<td onClick=\"saveCheckBoxToDataBase(this,'consult','$val[id_estructura]')\" id='consult_$val[id_estructura]' style='border-top: 1px solid;border-right: 1px solid;cursor:pointer;'></td>";
                            $tempData2 .= "</tr>";
                            $bandera = 1;
                            $cont++;
                        }
                    }

                    // $tempData2 .= "<td onClick=\"saveCheckBoxToDataBase(this,'new','$val[id_estructura]')\" id='new_$val[id_estructura]' style='border-top: 1px solid;cursor:pointer;border-right: 1px solid'></td>";

                    // $tempData2 .= "<td onClick=\"saveCheckBoxToDataBase(this,'edit','$val[id_estructura]')\" id='edit_$val[id_estructura]' style='border-top: 1px solid;cursor:pointer;border-right: 1px solid'></td>";

                    // $tempData2 .= "<td onClick=\"saveCheckBoxToDataBase(this,'delete','$val[id_estructura]')\" id='delete_$val[id_estructura]' style='border-top: 1px solid;cursor:pointer;border-right: 1px solid'></td>";
                    
                }
                else
                {
                    if($usuario["ID_USUARIO"]<1)
                    {
                        $tempData3 .= "<tr><td style='border-right: 1px solid'>$vista[1]</td>";
                        $tempData3 .= "<td onClick=\"saveCheckBoxToDataBase(this,'consult','$val[id_estructura]')\" id='consult_$val[id_estructura]' style='cursor:pointer;border-right:1px solid;'></td>";
                        $tempData3 .= "</tr>";
                        $bandera = 1;
                        $cont++;
                    }
                    else
                    {
                        if($vista[1] != "Permisos" && $vista[1] != "Control Temas")
                        {
                            $tempData3 .= "<tr><td style='border-right: 1px solid'>$vista[1]</td>";
                            $tempData3 .= "<td onClick=\"saveCheckBoxToDataBase(this,'consult','$val[id_estructura]')\" id='consult_$val[id_estructura]' style='cursor:pointer;border-right:1px solid;'></td>";
                            $tempData3 .= "</tr>";
                            $bandera = 1;
                            $cont++;
                        }
                    }

                    // $tempData3 .= "<td onClick=\"saveCheckBoxToDataBase(this,'new','$val[id_estructura]')\" id='new_$val[id_estructura]' style='cursor:pointer;border-right: 1px solid'></td>";

                    // $tempData3 .= "<td onClick=\"saveCheckBoxToDataBase(this,'edit','$val[id_estructura]')\" id='edit_$val[id_estructura]' style='cursor:pointer;border-right: 1px solid'></td>";

                    // $tempData3 .= "<td onClick=\"saveCheckBoxToDataBase(this,'delete','$val[id_estructura]')\" id='delete_$val[id_estructura]' style='cursor:pointer;border-right: 1px solid'></td>";
                }
                // if($bandera == 0)
                //     $cont=0;
                $idEstruct++;
            }
            $tempData .= "<td style='border-top: 1px solid;' rowspan='$cont'>$index</td>";
            $tempData .= $tempData2.$tempData3;
        };
        echo $tempData;
    break;

    case 'ModificarPermiso':
        $exito = $model->actualizarUsuariosVistasPorColumna($_REQUEST['COLUMNA'], $_REQUEST['VALOR'], $_REQUEST['ID_USUARIO'], $_REQUEST['ID_ESTRUCTURA']);
        echo $exito;
    break;

    case 'EliminarUsuarioTema':
        $result = $model->eliminarUsuarioTema($_REQUEST['ID_USUARIO'],$_REQUEST['ID_TEMA']);
        // header('Content-type: application/json; charset=utf-8');//federico si lees esto es para que sepas que esto no va ya que la consulta no regresara una lista, regresara un true o false, recuerdalo
        // echo json_encode($result);
        echo $result;
        break;
        
    case 'ConsultarExisteUsuario':
        $existe = $model->ConsultarExisteUsuario($_REQUEST["NOMBRE_USUARIO"]);
        echo $existe;
    break;

    case 'VerificarPass':
        $usuario = Session::getSesion("user");
        $existe = $model->verificarPass($usuario["ID_USUARIO"],$_REQUEST["PASS"]);
        echo $existe;
    break;

    case 'CambiarPass':
        $usuario = Session::getSesion("user");
        $exito = $model->cambiarPass($usuario["ID_USUARIO"],$_REQUEST["PASS"],$_REQUEST["NEW_PASS"]);
        echo $exito;
    break;

    case 'CambiarPermisoCumplimiento':
        $exito = $model->cambiarPermisoCumplimiento($_REQUEST["ID_USUARIO"],$_REQUEST["ID_CUMPLIMIENTO"],$_REQUEST["VALOR"]);
        echo $exito;
    break;

    case 'CambiarColor':
        $usuario = Session::getSesion("user");
        $exito = $model->cambiarColor($usuario["ID_USUARIO"],$_REQUEST["COLOR"]);
        if($exito>0)
            Session::setSesion("colorFondo_Vista",$_REQUEST["COLOR"]);
        echo $exito;
    break;

    case 'CrearSesionVarPhoto':
        Session::setSesion("fotoPerfilActual",$_REQUEST["URL"]);
    break;

    default:
    return false;
    break;
}
            
