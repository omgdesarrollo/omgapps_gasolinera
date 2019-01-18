<?php

require_once '../dao/CumplimientoDAO.php';
require_once '../Pojo/CumplimientoPojo.php';
class CumplimientoModel{
    //valida los datos del usuario.
    //retorna el registro del usuario como un arreglo asociativo
//    private $idEmpleado;
//    private $Nombre_Empleado='';
//    private $Apellido_Paterno='';
//    private $Apellido_Materno='';
//    private $Categoria='';
//    private $Correo='';
//    private $Fecha_Creacion='NOW()';
    
    public function  listarCumplimientos($ID_USUARIO)
    {
        try
        {
            $dao=new CumplimientoDAO();
            $rec=$dao->mostrarCumplimientos($ID_USUARIO);
            
            return $rec;
        }  catch (Exception $e){
            throw  $e;
        }
    }

    public function  listarCumplimiento($ID_CUMPLIMIENTO)
    {
        try
        {
            $dao=new CumplimientoDAO();
            $rec=$dao->mostrarCumplimiento($ID_CUMPLIMIENTO);
            
            return $rec;
        }  catch (Exception $e){
            throw  $e;
        }
    }
    
    public function  listarCumplimientosComboBox(){
        try{
            $dao=new CumplimientoDAO();
            $rec=$dao->mostrarCumplimientosComboBox();
            
            /*if($rec==NULL){
            throw new Exception("Usuario no existe !!!!!");
            }
            if($rec["CONTRA"]!=$clave){
            throw  new Exception("Clave Incorrecta!!!!!");
            }*/            
            return $rec;
    }  catch (Exception $e){
        throw  $e;
    }
    }
    
    
    public function listarCumplimientosPorUsuario($pojo){
        try{
            $dao= new CumplimientoDAO();
            $rec=$dao->mostrarCumplimientosPorUsuario($pojo->getNombreUsuario());
            
            return $rec;
        } catch (Exception $ex) {

        }
    }
    public function insertar($pojo){
        try{
            $dao=new CumplimientoDAO();
//            $pojo=new EmpleadoPojo();
            
           $dao->insertarCumplimientos($pojo->getClaveCumplimiento(),$pojo->getCumplimiento());
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    public function actualizar($pojo){
        try{
            $dao= new CumplimientoDAO();
//            $pojo= new EmpleadoPojo();
//            $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(),$pojo->getNombreEmpleado(),$pojo->getApellidoPaterno(),$pojo->getApellidoMaterno(), $pojo->getCategoria(),$pojo->getCorreo());
//        $rec=$dao->actualizarEmpleado($pojo->getIdEmpleado(), $pojo->getCorreo());
        $dao->actualizarCumplimiento($pojo->getIdCumplimiento(),$pojo->getClaveCumplimiento(), $pojo->getCumplimiento());
//            return $rec;
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    public function obtenerContratosPorUsuarioPermiso($ID_USUARIO)
    {
        try
        {
            $dao=new CumplimientoDAO();
            $rec= $dao->obtenerContratosPorUsuarioPermiso($ID_USUARIO);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    function detallesContratoSeleccionado($v){
        try{
            $dao= new CumplimientoDAO();
            $rec=$dao->detallesContratoSeleccionado($v);
            return $rec;
        }catch (Exception $ex) {

        }
    }




    public function eliminar(){
        try{
            $dao= new CumplimientoDAO();
            $pojo= new CumplimientoPojo();
            $dao->eliminarCumplimiento($pojo->getIdCumplimiento());
//            return $rec;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}

?>