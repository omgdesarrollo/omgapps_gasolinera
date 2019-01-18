<?php
require_once '../ds/AccesoDB.php';
class EmpleadoDAO{
    //consulta los datos de un empleado por su nombre de usuario
    public function mostrarEmpleados($cadena){
        try{

              $query="SELECT id_empleado, nombre_empleado, categoria, apellido_paterno, apellido_materno, correo, fecha_creacion, identificador 
                      FROM empleados 
                      WHERE empleados.id_empleado!=0 AND empleados.identificador LIKE '%%' order by nombre_empleado";            


            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
    }  catch (Exception $ex){
        throw $ex;
        return false;
    }
    }
    
    
    public function listarEmpleado ($ID_EMPLEADO){
        try
        {
            $query = "SELECT id_empleado, nombre_empleado, categoria, apellido_paterno, apellido_materno, correo, fecha_creacion
                      FROM empleados
                      WHERE id_empleado=$ID_EMPLEADO";
            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    

    public function mostrarEmpleadosComboBox(){
        try{
            $query="SELECT id_empleado, nombre_empleado, apellido_paterno, apellido_materno,CONCAT(empleados.nombre_empleado,' ',empleados.apellido_paterno,' ',empleados.apellido_materno) AS nombre_completo FROM empleados";

            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        }  catch (Exception $ex){
            throw $ex;
            return false;
        }
    }
    
    public function nombresCompletosCombobox()
    {
        try
        {
            $query="SELECT empleados.id_empleado, empleados.id_empleado id_empleadotema, CONCAT(empleados.nombre_empleado,' ',empleados.apellido_paterno,' ',empleados.apellido_materno) AS nombre_completo 
                    FROM empleados";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }






    public function insertarEmpleados($Nombre,$Categoria,$Apellido_Paterno,$Apellido_Materno,$Correo,$identificador){
        
        try{
            
            $query_obtenerMaximo_mas_uno="SELECT max(id_empleado)+1 as id_empleado from empleados";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_empleado"];
            }
            $query="INSERT INTO empleados(id_empleado,nombre_empleado,categoria,apellido_paterno,apellido_materno,correo,identificador)
                    VALUES($id_nuevo,'$Nombre','$Categoria','$Apellido_Paterno','$Apellido_Materno','$Correo','$identificador')";
            
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            return ($exito != 0)?[0=>1,"id_nuevo"=>$id_nuevo]:[0=>0,"id_nuevo"=>$id_nuevo ];
        }catch (Exception $ex)
        {
                throw $ex;
                return -1;
        }   
    }
    
    public function verificaCorreo($correo)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM empleados tbempleados
                    WHERE tbempleados.correo='$correo'";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            return $lista[0]["resultado"];
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    

    public function verificarIdentificadorSubmodulo($id,$cadena)
    {
        try
        {
            $query="SELECT tbempleados.identificador
                    FROM empleados tbempleados
                    WHERE tbempleados.id_empleado=$id AND tbempleados.identificador LIKE '%$cadena%'";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            
            return $lista[0];
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }        
    }
    
    public function actualizarIdentificadorSubmodulo($id,$identificador)
    {
        try
        {
            $query="UPDATE empleados SET identificador='$identificador'
                    WHERE empleados.id_empleado=$id";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }




    public function actualizarEmpleado($Id_Empleado,$Nombre,$Apellido_Paterno,$Apellido_Materno,$Categoria,$Correo){
//    public function actualizarEmpleado($Id_Empleado,$Correo){
        try{
            $query="UPDATE empleados SET nombre_empleado='$Nombre',apellido_paterno='$Apellido_Paterno',apellido_materno='$Apellido_Materno',correo='$Correo',categoria='$Categoria' WHERE id_empleado=$Id_Empleado";
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
        
    }
    
    public function actualizarEmpleadoPorColumna($COLUMNA,$VALOR,$ID_EMPLEADO){
         try{
            $query="UPDATE empleados SET ".$COLUMNA."='".$VALOR."'  WHERE id_empleado=$ID_EMPLEADO";
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    public function eliminarEmpleado($Id_Empleado){
        try{
            $query="DELETE FROM empleados WHERE id_empleado=$Id_Empleado";
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
//            return $lista[0];
        } catch (Exception $ex) {
                throw $ex;
        }
    }

    public function BusquedaEmpleado($cadena)
    {
        try
        {
//            $query = "SELECT tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno, tbempleados.correo, tbempleados.categoria 
//            FROM empleados tbempleados 
//            WHERE tbempleados.id_empleado != 0
//            AND (
//                    LOWER(tbempleados.nombre_empleado) like '%$cadena%'
//                    OR LOWER(tbempleados.apellido_paterno) like '%$cadena%' 
//                    OR LOWER(tbempleados.apellido_materno) like '%$cadena%'
//                )";
            
            $query="SELECT tbusuarios.nombre_usuario, tbempleados.id_empleado, 
            CONCAT (tbempleados.nombre_empleado,' ', tbempleados.apellido_paterno,' ', tbempleados.apellido_materno) 
            AS nombre,
		    
            tbempleados.categoria, tbempleados.correo

                FROM empleados tbempleados

                LEFT JOIN usuarios tbusuarios ON tbempleados.id_empleado=tbusuarios.id_empleado
                
                WHERE tbusuarios.id_empleado IS NULL AND tbempleados.id_empleado != 0

                AND (
                        LOWER(tbempleados.nombre_empleado) like '%$cadena%'
                        OR LOWER(tbempleados.apellido_paterno) like '%$cadena%' 
                        OR LOWER(tbempleados.apellido_materno) like '%$cadena%'
                   )";

            $db = AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            return $lista;
        }catch(Exception $er)
        {
            return false;
            throw $er;
        }
    }
}

?>
