<?php
require_once '../ds/AccesoDB.php';
class CumplimientoDAO{
    //consulta los datos de un empleado por su nombre de usuario
    public function mostrarCumplimientos($ID_USUARIO)
    {
        try
        {
            $query="SELECT tbcumplimientos.id_cumplimiento, tbcumplimientos.clave_cumplimiento, 
                tbcumplimientos.cumplimiento,tbusuarios_cumplimientos.acceso
                FROM cumplimientos tbcumplimientos
                JOIN usuarios_cumplimientos tbusuarios_cumplimientos ON tbusuarios_cumplimientos.id_cumplimiento = tbcumplimientos.id_cumplimiento
                JOIN usuarios tbusuarios ON tbusuarios.id_usuario = tbusuarios_cumplimientos.id_usuario
                WHERE tbusuarios.id_usuario = $ID_USUARIO";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
        }  catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function mostrarCumplimiento($ID_CUMPLIMIENTO)
    {
        try
        {
            $query="SELECT tbcumplimientos.id_cumplimiento, tbcumplimientos.clave_cumplimiento, 
                    tbcumplimientos.cumplimiento
                    FROM cumplimientos tbcumplimientos
                    WHERE tbcumplimientos.id_cumplimiento=$ID_CUMPLIMIENTO";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function mostrarCumplimientosComboBox(){
        try{
                        //$query="SELECT ID_CUMPLIMIENTO, CLAVE_CUMPLIMIENTO, CUMPLIMIENTO FROM CUMPLIMIENTOS";
                        $query="SELECT id_cumplimiento, clave_cumplimiento, cumplimiento FROM cumplimientos";
//            $query="SELECT ID_EMPLEADO  FROM EMPLEADOS";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            /*$rec = NULL;
            if (count($lista)==1){
                $rec=$lista[0];
            }
            return $rec;*/

            return $lista;
    }  catch (Exception $ex){
        //throw $rec;
        throw $ex;
    }
    }
    public function detallesContratoSeleccionado($v){
        
        try{
            $query="SELECT tbcumplimientos.id_cumplimiento,tbcumplimientos.clave_cumplimiento,tbcumplimientos.cumplimiento 
                    FROM cumplimientos tbcumplimientos  
                    WHERE tbcumplimientos.id_cumplimiento=".$v["contrato"];
            

            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista[0];
        } catch (Exception $ex) {

        }
    }
    
    
    
    public function mostrarCumplimientosPorUsuario($usuario){
        try{
                        //$query="SELECT tbcumplimientos.CLAVE_CUMPLIMIENTO FROM USUARIOS  JOIN CUMPLIMIENTOS tbcumplimientos ON usuarios.ID_USUARIO=tbcumplimientos.ID_USUARIO where usuarios.NOMBRE_USUARIO='$usuario'";
            $query="SELECT tbcumplimientos.clave_cumplimiento FROM usuarios  
            JOIN cumplimientos tbcumplimientos ON usuarios.id_usuario=tbcumplimientos.id_usuario where usuarios.nombre_usuario='$usuario'";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        } catch (Exception $ex) {
                throw $ex;
        }
    }
    
    
    public function insertarCumplimientos($clave_cumplimiento,$cumplimiento){
        
        try{
            $query="INSERT INTO cumplimientos(id_cumplimiento,clave_cumplimiento,cumplimiento)VALUES('$clave_cumplimiento','$cumplimiento')";
            $db=  AccesoDB::getInstancia();
            $db->executeQuery($query);
//            $rec=$lista[0];
//            return $rec;
        } catch (Exception $ex) {
                throw $ex;
        }   
    }
    
//    public function actualizarEmpleado($Id_Empleado,$Nombre,$Apellido_Paterno,$Apellido_Materno,$Categoria,$Correo){
    public function actualizarEmpleado($id_cumplimiento,$clave_cumplimiento,$cumplimiento){
        try{
//            $query="UPDATE EMPLEADOS SET NOMBRE_EMPLEADO='$Nombre',APELLIDO_PATERNO='$Apellido_Paterno',APELLIDO_MATERNO='$Apellido_Materno',CORREO='$Correo'";
             $query="UPDATE cumplimientos SET clave_cumplimiento='$clave_cumplimiento', cumplimiento='$cumplimiento' WHERE id_cumplimiento=$id_cumplimiento";
     
            $db= AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
        
    }
    
    public function obtenerContratosPorUsuarioPermiso($ID_USUARIO)
    {
        try
        {
            $query="SELECT tbusuarios_cumplimientos.id_cumplimiento, tbcumplimientos.clave_cumplimiento, tbcumplimientos.cumplimiento
                    FROM usuarios_cumplimientos tbusuarios_cumplimientos
                    JOIN cumplimientos tbcumplimientos ON tbcumplimientos.id_cumplimiento=tbusuarios_cumplimientos.id_cumplimiento
                    WHERE tbusuarios_cumplimientos.acceso='true' AND tbusuarios_cumplimientos.id_usuario=$ID_USUARIO";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
            


    public function eliminarEmpleado($id_cumplimiento){
        try{
            $query="DELETE FROM cumplimientos WHERE id_cumplimiento=$id_cumplimiento";
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
//            return $lista[0];
        } catch (Exception $ex) {
                throw $ex;
        }
    }
}

?>
