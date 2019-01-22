<?php

require_once '../dao/AsignacionTemaRequisitoDAO.php';
require_once '../Pojo/AsignacionTemaRequisitoPojo.php';
require_once '../Model/AsignacionTemaRequisitoModel.php';

class AsignacionTemaRequisitoModel {
    //put your code here
    
    public function  listarAsignacionTemasRequisitos($CADENA,$CONTRATO){
        try{
            $dao=new AsignacionTemaRequisitoDAO();
            $model=new AsignacionTemaRequisitoModel(); 
                    
            $rec=$dao->mostrarAsignacionTemasRequisitos($CADENA,$CONTRATO);
         
            foreach ($rec as $key => $value) 
            {
                $rec[$key]['detalles_requisitos']= $model->obtenerDetallesRequisitoConIdAsignacion($value['id_asignacion_tema_requisito']);                                
//                $rec[$key]['detalles_registros']= $dao->obtenerDetallesRegistrosConIdAsignacion($value['id_asignacion_tema_requisito']);
            }
       
            return $rec;
    }  catch (Exception $e){
        throw  $e;
    }
    }
    
    
    public function  listarAsignacionTemasRequisitosComboBox(){
        try{
            $dao=new AsignacionTemaRequisitoDAO();
            $rec=$dao->mostrarAsignacionTemasRequisitosComboBox();
            
            
            return $rec;
    }  catch (Exception $e){
        throw  $e;
    }
    }
 
    
    
//    public function  obtenerRequisitosporDocumento($id_documento){
//        try{
//            $dao=new AsignacionTemaRequisitoDAO();
//            $rec=$dao->obtenerRequisitosporDocumento($id_documento);
//            
//            
//            return $rec;
//    }  catch (Exception $e){
//        throw  $e;
//    }
//    }        
    
    public function obtenerIdTema($ID_ASIGNACION)
    {
        try
        {
            $dao=new AsignacionTemaRequisitoDAO();
            $dao->obtenerIdTema($ID_ASIGNACION);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    
    public function obtenerDetallesHidrid($id,$tipo){
        try{
            $dao= new AsignacionTemaRequisitoDAO();
            $value["id"]=$id;
            
            $htmlFrontend="";
//            $value["tipo"]=$tipo;
          
            if($tipo=="req"){
            
                $rec= $dao->obtenerDetalles_Req($value);
                 $htmlFrontend="<div class='table-responsive'><table class='table table-bordered'><thead><tr class='danger'><th>Datos</th><th>Detalles Requisito</th></tr></thead><tbody></tbody>";
              
                foreach($rec as $valuet){
//                    $htmlFrontend=$valuet["registro"];
                    $htmlFrontend.="<tr><td class='info'>Requisito</td><td contenteditable='true' onClick='showEdit(this)' onBlur=\"saveToDatabaseRequisitos(this,'requisito',".$valuet['id_requisito'].")\">".$valuet['requisito']."</td></tr>";
//                    $htmlFrontend.="<tr><td class='info'>Clave Documento</td><td>".$valuet['clave_documento']."</td></tr>";
//                    if($valuet["documento"]!="")
//                    $htmlFrontend.="<tr><td class='info'>Documento</td><td>".$valuet['documento']."</td></tr>";
//                    else
//                    $htmlFrontend.="<tr><td class='info'>Documento</td><td>SIN DOCUMENTO</td></tr>";
//                    $htmlFrontend.="<tr><td class='info'>Nombre Completo</td><td>".$valuet['nombrecompleto']."</td></tr>";
                   
                }
                $htmlFrontend.="</table></div>";
                 echo $htmlFrontend;
            }
            else{
              if($tipo=="reg"){
                  
            $htmlFrontend="<div class='table-responsive'><table class='table table-bordered'><thead><tr class='danger'><th>Datos</th><th>Detalles Registro</th></tr></thead><tbody></tbody>";
                $rec= $dao->obtenerDetalles_Reg($value);
                foreach($rec as $valuet){
//                    $htmlFrontend=$valuet["registro"];
                    $htmlFrontend.="<tr><td class='info'>Registro</td><td contenteditable='false' onClick='showEdit(this)' onBlur=\"saveToDatabaseRegistros(this,'registro',".$valuet['id_registro'].")\">".$valuet['registro']."</td></tr>";
                    $htmlFrontend.="<tr><td class='info'>Frecuencia</td><td>".$valuet['frecuencia']."</td></tr>";                    
//                    $htmlFrontend.="<tr><td class='info'>Clave del Documento</td><td>".$valuet['clave_documento']."</td></tr>";
                    if($valuet["documento"]!="")
                    $htmlFrontend.="<tr><td class='info'>Documento</td><td>".$valuet['documento']."</td></tr>";
//                    else
//                    $htmlFrontend.="<tr><td class='info'>Documento</td><td>SIN DOCUMENTO</td></tr>";
//                    $htmlFrontend.="<tr><td class='info'>Responsable</td><td>".$valuet['nombrecompleto']."</td></tr>";
                   
                }
                $htmlFrontend.="</table></div>";
                 echo $htmlFrontend;
              }
            }
          if($tipo=="registrosEdicionDeDatosModal"){
//              $rec="gf";
//             echo  self::verificarRegistroExisteEnDocumentoandEstaValidadoPorDelDocumentoYTema($value)[0]["validacion_documento_responsable"];
//              if(){
                $rec= $dao->obtenerDetalles_Reg($value);
                return $rec;
//              }else{
//                  return array("validacion_documento_responsable"=>"no_procede");
//              }
//                
          }  
            
            
            
        } catch (Exception $ex) {
            throw $ex;
           return false;
        }

    }

   public static function verificarRegistroExisteEnDocumentoandEstaValidadoPorDelDocumentoYTema($data){
       try{
           $dao= new AsignacionTemaRequisitoDAO();
           $documento_validado=$dao->verificarRegistroExisteEnDocumentoandEstaValidadoPorDelDocumentoYTema(array("id_registro"=>$data["id"]));
           return $documento_validado;
       } catch (Exception $ex) {
            throw $ex;
           return -1;
       }
       
       
   }
   
   public static function verificarRegistroExisteEnEvidencias($data){
       try{
           $dao= new AsignacionTemaRequisitoDAO();
           $evidencias=$dao->verificarRegistroExisteEnEvidencias(array("id_registro"=>$data["id"]));
//           echo $evidencias;
           return $evidencias;

       } catch (Exception $ex) {
            throw $ex;
           return -1;
       }
   }
    public function insertar($pojo){
        try{
            $dao=new AsignacionTemaRequisitoDAO();
//            $pojo=new EmpleadoPojo();
           $dao->insertarAsignacionTemaRequisito($pojo->getId_clausula(),$pojo->getRequisito(),$pojo->getId_Documento());
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    public function actualizarRegistro($data){
        try{
            $dao= new AsignacionTemaRequisitoDAO();
            $requisito=$dao->obtenerIdRequisitoPadreDelRegistro($data);
            $model= new AsignacionTemaRequisitoModel();
            $listaderegistros= $model->obtenerLosRegistrosDentroDeRequisitos(array("id_requisito"=>$requisito[0]["id_requisito"]));
            
            $existe_registro_repetido=0;;
            
            foreach ($listaderegistros as $value) {
                if($value["registro"]==$data["registro"]){
                    $existe_registro_repetido++;
                }
              
            }
            
            
            if($existe_registro_repetido==0){
                return $dao->actualizarRegistro($data);
            }else{
                return false;
            }
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }
        
    }
    
    
    
    public function insertarRequisitos($ID_ASIGNACION,$requisito,$penalizacion)
    {
        try
        {
            $dao=new AsignacionTemaRequisitoDAO();
            
            
            $rec= $dao->insertarRequisito($requisito,$penalizacion);
            $ID_REQUISITO= $dao->obtenerMaximoRequisito();
            $resultado= $dao->insertarRequisitoTablaCompuesta($ID_ASIGNACION, $ID_REQUISITO);
//            echo "valor rec ".json_encode($rec);
                
            $datoLista="";
            if($rec==true && $resultado==true)
            {
               $datoLista=true; 
            }else{
               $datoLista=false; 
            }
//            echo "valor final: ".json_encode($datoLista);
            return $datoLista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function insertarRegistros($ID_REQUISITO,$registro,$frecuencia,$id_documento)
    {
        try
        {
            $dao=new AsignacionTemaRequisitoDAO($ID_REQUISITO,$registro,$id_documento);
            $model= new AsignacionTemaRequisitoModel();
            $datoRegistro="";
            //star obtener los registros dentro de los requisitos
            $listaderegistros=$model->obtenerLosRegistrosDentroDeRequisitos(array("id_requisito"=>$ID_REQUISITO));
            
            $existe_registro_repetido=0;;
            
            foreach ($listaderegistros as $value) {
                if($value["registro"]==$registro){
                    $existe_registro_repetido++;
                }
              
            }
            //end obtener registros dentro de los requisitos
            
            if($existe_registro_repetido==0){
                $rec= $dao->insertarRegistro($registro,$id_documento,$frecuencia);
                $ID_REGISTRO= $dao->obtenerMaximoRegistro();
                $resultado= $dao->insertarRegistroTablaCompuesta($ID_REQUISITO, $ID_REGISTRO);
                
                $model->insertarPrimeraEvidenciaRegistroPadre(array("id_registro"=>$ID_REGISTRO,"id_usuario"=>0));
                if($rec==true && $resultado==true)
                {
                    $datoRegistro=true;
                    
                    
                    
                }else{
                    $datoRegistro=false;
                }
            
            
            }else{
                $datoRegistro="registro_repetido";
            }
//            echo "valor final: ".json_encode($datoRegistro);
            return $datoRegistro;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }        

    public function actualizar($pojo){
        try{
            $dao= new AsignacionTemaRequisitoDAO();
//            $pojo= new EmpleadoPojo();
//            $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(),$pojo->getNombreEmpleado(),$pojo->getApellidoPaterno(),$pojo->getApellidoMaterno(), $pojo->getCategoria(),$pojo->getCorreo());
//        $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(), $pojo->getCorreo());
        $dao->actualizarClausula($pojo->getId_asignacion_tema_requisito(),$pojo->getId_clausula(),$pojo->getRequisito(),$pojo->getId_Documento());
//            return $rec;
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_ASIGNACION_TEMA_REQUISITO){
        try{
            $dao=new AsignacionTemaRequisitoDAO();
            $rec= $dao->actualizarAsignacionTemaRequisitoPorColumna($COLUMNA, $VALOR, $ID_ASIGNACION_TEMA_REQUISITO);
            
        } catch (Exception $ex) {

        }
    }
    
    
    public function eliminar(){
        try{
            $dao= new AsignacionTemaRequisitoDAO();
            $pojo= new AsignacionTemaRequisitoPojo();
            $dao->eliminarAsignacionTemaRequisito($pojo->getId_asignacion_tema_requisito());
//            return $rec;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    public function eliminarNodoRequisito($ID_REQUISITO)
    {
        try
        {
            $dao=new AsignacionTemaRequisitoDAO();
            $lista= $dao->eliminarNodoRequisito($ID_REQUISITO);
            
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function eliminarNodoRegistro($ID_REGISTRO)
    {
        try
        {    
            $exito=0;
            $dao=new AsignacionTemaRequisitoDAO();
            
            $evidencia= $dao->obtenerRegistrodeEvidencia($ID_REGISTRO);
            
            if($evidencia==0)
            {
                $exito= $dao->eliminarNodoRegistro($ID_REGISTRO);
            }
            
            return $exito;
//            echo "Este es el valor: ".json_encode($exito);            
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
    
    public static function generarDatosArbol($id_asignacion)
    {
        try
        {
            $datosArbol = array();
            $dao=new RegistrosDAO();
            $daoA= new AsignacionTemaRequisitoDAO();
            $daoT=new TemaDAO();
//            $rec= $daoT->listarDetallesSeleccionados($id_asignacion);
            $requisitos["data"]= $dao->obtenerRequisitos($id_asignacion);
            foreach($requisitos["data"] as $index=>$resultado)
            {
                $requisitos["data"][$index][0] = $dao->obtenerRegistros($resultado['id_requisito']);
            }
            
//        $id_tema=$daoA->obtenerIdTema($id_asignacion);
//         $requisitos["detallesTema"]=$daoT->listarDetallesSeleccionados($id_tema);
            
            return $requisitos;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerDetallesRequisitoConIdAsignacion($ID_ASIGNACION)
    {
        try 
        {
            $dao=new AsignacionTemaRequisitoDAO();
            $rec= $dao->obtenerDetallesRequisitoConIdAsignacion($ID_ASIGNACION);
            foreach ($rec as $key => $value) 
            {
                $rec[$key]['detalles_registros']= $dao->obtenerDetallesRegistrosConIdAsignacion($value['id_requisito']);
            }
            
            return $rec;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
        
    }
    //function que se encarga de obtener los registros que estan dentro de requisitos
    public function obtenerLosRegistrosDentroDeRequisitos($value){
        
        
        try{
             $dao=new AsignacionTemaRequisitoDAO();
             return $dao->obtenerLosRegistrosDentroDeRequisitos($value);
             
        } catch (Exception $ex) {

        }
    }
    
    
    
    public function insertarPrimeraEvidenciaRegistroPadre($value){
        try{
             $dao=new AsignacionTemaRequisitoDAO();
             return $dao->insertarPrimeraEvidenciaRegistroPadre($value["id_registro"],$value["id_usuario"]);
             
        } catch (Exception $ex) {

        }
        
        
    }
    
}
