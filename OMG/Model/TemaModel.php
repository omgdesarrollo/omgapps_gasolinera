<?php

require_once '../dao/TemaDAO.php';
require_once '../dao/EmpleadoDAO.php';
class TemaModel{
    
    
    public function  mostrarTemas($cadena,$contrato)
    {
        try
        {
            $dao=new TemaDAO();
            $rec=$dao->mostrarTemas($cadena,$contrato);                       
            
            $resultadoArbol;
            $contador=0;
            foreach ($rec as $value)
            {  
                $resultadoArbol[$contador]=array($value['id_tema'],$value['padre'],$value['no']."-".$value['nombre'],$value["padre_general"],$value["responsable_general"]);                
                $contador++;
            }    
            if($contador!=0)
                return $resultadoArbol;
            else
                return "";
        }  catch (Exception $e)
        {
            throw  $e;
        }
    }
    
    
    public function listarTemasComboBox($cadena, $contrato)
    {
        try
        {
            $dao=new TemaDAO();
            $lista= $dao->mostrarTemasComboBox($cadena, $contrato);
            
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }




    public function listarHijos($CADENA,$CONTRATO,$ID)
    {
        try
        {
            $dao= new TemaDAO();
            $daoEmpleado=new EmpleadoDAO();
            $rec['datosHijos']= $dao->listarHijos($CADENA,$CONTRATO,$ID);
            $rec['detalles']= $dao->listarDetallesSeleccionados($ID);
            $rec['comboEmpleados']=$daoEmpleado->mostrarEmpleadosComboBox();
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function insertarNodo($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO,$ES_TEMA_OR_SUBTEMA,$DATOS_GENERALES)
    {
        
//        echo json_encode($DATOS_GENERALES);
        try
        {
            $dao=new TemaDAO();
            $rec;
         if($ES_TEMA_OR_SUBTEMA!="NO EXISTE"){
            if($ES_TEMA_OR_SUBTEMA=="TEMA"){
                 $rec= $dao->insertarNodo($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO);
//                 echo "E".$rec;
                 self::componerTablaTemasPadreandReponsaleGeneral(array("id_tema"=>$rec));
                 
                 
            }else{
               if($ES_TEMA_OR_SUBTEMA=="SUBTEMA"){
                   
                   
//                   echo json_encode($DATOS_GENERALES);
                    $rec= $dao->insertarNodoHijos($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO,$DATOS_GENERALES);
//                 echo "E".$rec;
                    
                    self::componerTablaTemasPadreandReponsaleGeneral(array("id_tema"=>$rec));
                   
//                  $rec= $dao->insertarNodo($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO);
            } 
            }
         }else{
             //para mantener funcionando la seccion de temas de oficios
              $rec= $dao->insertarNodo($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO);
         }
//            self::componerTablaTemasPadreandReponsaleGeneral();
        
            return true;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;        
        }
    }
    

    
    
    public function eliminarNodo($ID)
    {
        try
        {
            $dao=new TemaDAO();
            $rec= $dao->eliminarNodo($ID);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function eliminarNodoParaOficios($ID)
    {
        try
        {
            $dao=new TemaDAO();
            $resultado= $dao->verificarSiTemaEstaEnDocumentoDeEntrada($ID);
            $rec=false;
//            echo "este es el resultado: ". json_encode($resultado);
            if($resultado==0)
            {
                $rec= $dao->eliminarNodo($ID);
                $rec=true;
            }
            
            return $rec;            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
        private  static function componerTablaTemasPadreandReponsaleGeneral($value)
    {
        try
        {
            $dao=new TemaDAO();
            $data = array();
            $temas = $dao->listarTodosTemas();
//            foreach($temas as $key => $value)
//            {
                $hijos = $dao->obtenerHijosTema($value["id_tema"]);
                if( sizeof($hijos)!=0 )
                {
                    $tmp = array();
                    $bandera = true;
                    $key = 0;
                    while($bandera)
                    {
                        $v = $hijos[$key];
                        $dao->cambiarDatosTema($v["id_tema"],$value["id_tema"],$value["id_empleado"]);
                        $temp = $dao->obtenerHijosTema($v["id_tema"]);
                        if( sizeof($temp)!=0 )
                            array_push($hijos,$temp[0]);
                        $key++;
                        if( sizeof($hijos) == $key)
                            $bandera = false;
                    }
                }
//            }
            return "TERMINO BIEN";
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
       public function actualizarColumnas($TABLA, $COLUMNAS,$ID,$CONTRATO)
    {
        try
        {
            $ROWS="";
            $columna_id="";
            $valor_id="";
                    
            $CADENA="UPDATE $TABLA SET $ROWS,contrato=$CONTRATO  
                     WHERE $ID";
            
            $prueba=$ID[0][0];
            
            echo "valores del ID: ".json_encode($prueba);

//            $ID = json_decode($columna_id);        
//            echo "valor ID: ".json_decode($columna_id);
            
            $dao=new TemaDAO();
            $rec= $dao->actualizarColumnas($CADENA);
            
            foreach ($COLUMNAS as $index => $value) {
                
            echo "El valor de".$index[0]."es:".$value[0];
            }
//            echo "Valores Columnas: ".json_encode($COLUMNAS);
            echo "valor foreach: ".json_encode($value);
//            return $CADENA;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
     public function actualizarPorColumna($TABLA,$COLUMNA,$VALOR,$ID,$ID_CONTEXT) {
        try
        {
            $dao=new TemaDAO();
            $value=array("id_tema"=>$ID);
            $data=$dao->obtenerPadreGeneralPorElTemasOrSubtemaQueSeMande($value);
            
            $ID_CONTEXT="padre_general";
            $ID=$data[0]["padre_general"];
            $COLUMNA="responsable_general";
            $rec= $dao->actualizarColumnaPorTabla($TABLA, $COLUMNA, $VALOR, $ID,$ID_CONTEXT);
            
           
            return $rec;
            
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }    
    }
    
    
    
    
    
    
    
}

?>