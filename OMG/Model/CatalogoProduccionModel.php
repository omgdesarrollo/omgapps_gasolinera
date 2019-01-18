<?php
require_once '../dao/CatalogoProduccionDAO.php';

class CatalogoProduccionModel{

    public function listarCatalogo($CONTRATO)
    {
        try
        {
            $dao=new CatalogoProduccionDAO();
            $lista= $dao->listarCatalogo($CONTRATO);
            if(sizeof($lista)==0)
                $lista=0;
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function listarUno($ID_CONTRATO)
    {
        try
        {
            $dao=new CatalogoProduccionDAO();
            $lista= $dao->listarUno($ID_CONTRATO);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function guardarCatalogo($CONTRATO,$DATOS)
    {
        try
        {
            $dao=new CatalogoProduccionDAO();
            // INSERT INTO asignacion_tema_requisito(id_asignacion_tema_requisito,id_clausula,requisito,id_documento)"
            // . "VALUES($id_nuevo,$id_clausula,'$requisito',$id_documento)";
            // $queryAsignaciones = ""
            // $resultado = $dao->buscarID($DATOS["region_fiscal"],$CONTRATO);
            // echo $resultado;
            $bandera = 0;
            // $bandera2 = 0;
            $query = "INSERT INTO catalogo_produccion(";
            $queryC = "";
            $clave_contrato = "";
            $region_fiscal = "";
            $queryV = "VALUES(";
            $ID_asignaciones = "";
            $listado = $dao->buscarID($DATOS["region_fiscal"],$CONTRATO);
            if( sizeof($listado)!=0 )
            {
                $query.= "id_asignacion,";
                $queryV .= $listado[0]["id_asignacion"].",";
            }
            foreach($DATOS as $key=>$value)
            {
                if($key!="clave_contrato" && $key!="region_fiscal")
                {
                    if($bandera!=0)
                    {
                        $queryC.=",";
                        $queryV.=",";
                    }
                    $queryC.=$key;
                    $queryV.= "'$value'";
                    $bandera=1;
                }
                else
                {
                    if($key=="clave_contrato")
                        $clave_contrato = $value;
                    else
                        $region_fiscal = $value;
                }
            }
            if( sizeof($listado)==0 )
            {
                // echo "INSERT INTO asignaciones_contrato(clave_contrato,region_fiscal,contrato) VALUES($clave_contrato,$region_fiscal,$CONTRATO)";
                $ID_asignaciones = $dao->guardarCatalogo("INSERT INTO asignaciones_contrato(clave_contrato,region_fiscal,contrato) VALUES('$clave_contrato','$region_fiscal',$CONTRATO)");
            }
            if($ID_asignaciones!="")
            {
                $query .= $queryC.",id_asignacion) ".$queryV.",$ID_asignaciones)";
            }
            else
                $query .= $queryC.") ".$queryV.")";
            // echo $query;
            $exito = $dao->guardarCatalogo($query);
            return $exito;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarID($CADENA,$CONTRATO)
    {
        try
        {
            $dao = new CatalogoProduccionDAO();
            $lista = $dao->buscarID($CADENA,$CONTRATO);
            if(sizeof($lista)==0)
                $lista = 0;
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarRegionesFiscales($CONTRATO)
    {
        try
        {
            $dao = new CatalogoProduccionDAO();
            $lista = $dao->buscarRegionesFiscales($CONTRATO);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function buscarTagMedidor($CONTRATO,$TAG_MEDIDOR)
    {
        try
        {
            $dao = new CatalogoProduccionDAO();
            $exito = $dao->buscarTagMedidor($CONTRATO,$TAG_MEDIDOR);
            return $exito;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenerConceptos($CUMPIMIENTO){
        try{
            $dao= new CatalogoProduccionDAO();
            $lista=$dao->obtenerConceptos($CUMPIMIENTO);
//            echo json_encode($lista);
            return $lista;
        } catch (Exception $ex) {
            throw  $ex;
            return -1;
        }
    }
    
    public function obtenerVista_Concepto_Seleccionado($value){
          try{
            $dao= new CatalogoProduccionDAO();
            $lista=$dao->obtenerVista_Concepto_Seleccionado($value);
            return $lista;
        } catch (Exception $ex) {
            throw  $ex;
            return -1;
        }
    }

    public function eliminarRegistro($ID_CONTRATO)
    {
        try
        {
            $dao = new CatalogoProduccionDAO();
            $permiso = $dao->permisoDeEliminar($ID_CONTRATO);
            $exito = 0;
            if($permiso == 0)
            {
                $exito = $dao->eliminarRegistro($ID_CONTRATO);
                if($exito != 1 )
                    $exito = -3;
            }
            else
                $exito = -2;
            return $exito;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function actualizar($COLUMNAS_VALOR,$ID_CONTEXTO)
    {
        try
        {
            $dao=new CatalogoProduccionDAO();
            $query="";
            $index=0;
            $update=-1;
            $banderaTA = 0;
            $id_catalogop = 0;
            foreach($COLUMNAS_VALOR as $key=>$value)
            {
                // if($key != "clave_contrato" && $key != "region_fiscal")
                // {
                    if($index!=0)
                    {
                        $query .= " , ";
                    }
                        // $query .= $key ."= '".utf8_decode( $value )."'";
                        $query .= $key ."= '$value'";
                    $index++;
                    if($key == "clave_contrato" || $key == "region_fiscal")
                        $banderaTA++;
                // }
                // else
                // {
                //     if($index2!=0)
                //         $query2 .= " , ";
                //     $query2 .= "$key = '".utf8_decode( $value )."'";
                //     $index2=1;
                // }
            }
            if($query!="")
            {
                $query = "UPDATE catalogo_produccion JOIN asignaciones_contrato ON catalogo_produccion.id_asignacion = asignaciones_contrato.id_asignacion  SET ".$query;
                foreach($ID_CONTEXTO as $key=>$value)
                {
                    // $query .= " WHERE $key = '".utf8_decode( $value )."'";
                    $id_catalogop=$value;
                    $query .= " WHERE $key = '$value'";
                }
                // echo $query."FIN";
                $update = $dao->actualizar($query);
                if($update != 0)
                {
                    if($banderaTA !=0)
                    {
                        $id_asignacion = $dao->buscarID_asignacionPorID_Catalogo($id_catalogop);
                        $update = $dao->listarPorAsignacion($id_asignacion[0]["id_asignacion"]);
                    }
                    else
                    $update = $dao->listarUno($id_catalogop);
                }
                else
                    $update = -2 ;
                // $update != 0 ? $banderaTA !=0 ? ($id_asignacion = $dao->buscarID_asignacionPorID_Catalogo($id_catalogop) , $update = $dao->listarPorAsignacion($id_asignacion) ) : ($update = $dao->listarUno($id_catalogop)) : $update = -2 ;
                // $update = $id_asignacion != -2 ? $dao->listarPorAsignacion() : -2; //no pude obtener los actualizados ya que no se en que momento se ejecuta uno y en que el otro
            }
            // if($query2!="")
            // {
            //     $query2 = "UPDATE $TABLA SET ".$query2;
            //     $query2 .= " WHERE region_fiscal = '".utf8_decode( $REGION )."'";
            //     // $update ? $dao->listarQuery(" SELECT * FROM  ");// listar todos lo que tengan la region fiscal
            //     $update2 = $dao->actualizar($query2);
            //     // if($update2!=0)?$dao->
            // }
            // echo $query;
            // echo $query2;
            // return $update==-1 ? $update2!=0 ? 2 : -2 : $update==0 ? $update2!=0 ? 3 : -3 : $update2!=0 ? 4 : -4;//2 se hizo el segundo, 3 no se hizo el primero solo el segundo, 4 se hizo todo
            return $update;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }    
    }
}
?>
