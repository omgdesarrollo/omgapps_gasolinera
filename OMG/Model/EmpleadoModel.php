<?php

require_once '../dao/EmpleadoDAO.php';
require_once '../Pojo/EmpleadoPojo.php';
class EmpleadoModel{
    //valida los datos del usuario.
    //retorna el registro del usuario como un arreglo asociativo
//    private $idEmpleado;
//    private $Nombre_Empleado='';
//    private $Apellido_Paterno='';
//    private $Apellido_Materno='';
//    private $Categoria='';
//    private $Correo='';
//    private $Fecha_Creacion='NOW()';
    
    public function  listarEmpleados($cadena){
        try{
            $dao=new EmpleadoDAO();
            $rec=$dao->mostrarEmpleados($cadena);           
            return $rec;
            
    }  catch (Exception $e){
        throw  $e;
    }
    }
    
    
    public function listarEmpleado($ID_EMPLEADO){
        try
        {
            $dao = new EmpleadoDAO();
            $rec = $dao->listarEmpleado($ID_EMPLEADO);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    
    public function  listarEmpleadosComboBox()
    {
        try{
            $dao=new EmpleadoDAO();
            $rec=$dao->mostrarEmpleadosComboBox();
         
            return $rec;
        }  catch (Exception $e){
            throw  $e;
            return -1;
        }
    
    }
    
    public function nombresCompletosCombobox()
    {
       try
       {
           $dao=new EmpleadoDAO();
           $rec= $dao->nombresCompletosCombobox();
           
           return $rec;
       } catch (Exception $ex)
       {
           throw $ex;
           return -1;
       }
    }




    public function insertar($pojo){
        try{
            $dao=new EmpleadoDAO();
            $model=new EmpleadoModel();
            $devoldValor="";
            $lista=array();
            // $resultado= $model->verificarEmpleado($pojo->getCorreo());
//            echo json_encode($resultado);
        //    $pojo=new EmpleadoPojo();
            // if($resultado[0]['resultado']==0)
            // {   
            $exito = $dao->insertarEmpleados($pojo->getNombreEmpleado(),$pojo->getCategoria(), $pojo->getApellidoPaterno(),$pojo->getApellidoMaterno(),$pojo->getCorreo(),$pojo->getIdentificador());
                // $devoldValor=1;
            // } else {
            // @$result= $dao->verificarIdentificadorSubmodulo($resultado[0]['id_empleado'],$pojo->getIdentificador());
//            echo "este es el identificador".$result['identificador'];
//            echo "Este es result:".json_encode($result);
            if($exito[0] = 1)
            { 
                    
//                    $res= $dao->actualizarIdentificadorSubmodulo($resultado[0]['id_empleado'],$resultado[0]['identificador']."-".$pojo->getIdentificador());
//                    echo json_encode("esta es la variable res ".$res);
                $lista = $dao->listarEmpleado($exito['id_nuevo']);
            }
            else
                return $exito[0];
            return $lista;
        }catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function verificaCorreo($correo)
    {
        try
        {
            $dao=new EmpleadoDAO();
            $rec= $dao->verificaCorreo($correo);
            
            return $rec;
                     
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
    public function actualizarIdentificadorSubmodulo($id, $identificador)
    {
        try
        {
            $dao=new EmpleadoDAO();
            $rec= $dao->actualizarIdentificadorSubmodulo($id,$identificador);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    
//    public function actualizar($pojo){
//        try{
//            $dao= new EmpleadoDAO();
////            $pojo= new EmpleadoPojo();
////            $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(),$pojo->getNombreEmpleado(),$pojo->getApellidoPaterno(),$pojo->getApellidoMaterno(), $pojo->getCategoria(),$pojo->getCorreo());
////        $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(), $pojo->getCorreo());
//        $dao->actualizarEmpleado($pojo->getIdEmpleado(), $pojo->getCorreo());
////            return $rec;
//        } catch (Exception $ex) {
//                throw $ex;
//        }
//    }
    
    public function actualizarPorColumna($COLUMNA,$VALOR,$ID_EMPLEADO){
        try{
            $dao=new EmpleadoDAO();
            $rec= $dao->actualizarEmpleadoPorColumna($COLUMNA, $VALOR, $ID_EMPLEADO);
            
        } catch (Exception $ex) {

        }
    }
    public function eliminar(){
        try{
            $dao= new EmpleadoDAO();
            $pojo= new EmpleadoPojo();
            $dao->eliminarEmpleado($pojo->getIdEmpleado());
//            return $rec;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    public function BusquedaEmpleado($cadena)
    {
        try{
            $dao= new EmpleadoDAO();
            $lista = $dao->BusquedaEmpleado($cadena);
            return $lista;
        }catch(Exception $er)
        {
            return false;
            throw $er;
        }
    }
}

?>