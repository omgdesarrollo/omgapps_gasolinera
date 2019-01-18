
<?php

require_once '../ds/AccesoDB.php';
class DocumentoDAO{
    //consulta los datos de un empleado por su nombre de usuario
    public function mostrarDocumentos($CONTRATO){
        try{
            
            $query="SELECT tbdocumentos.id_documento, tbdocumentos.clave_documento, tbdocumentos.documento,
                    tbempleados.id_empleado, tbempleados.nombre_empleado, tbempleados.apellido_paterno,tbempleados.apellido_materno 
                    FROM documentos tbdocumentos

                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumentos.id_empleado
                    WHERE tbdocumentos.contrato=$CONTRATO
                    ORDER BY  tbdocumentos.clave_documento";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista;
    
            
    }  catch (Exception $e){
        //throw $rec;
        throw $e;
    }
    }
    
    public function mostrarDocumento($ID_DOCUMENTO,$CONTRATO)
    {
        try
        {
            $query="SELECT tbdocumentos.id_documento, tbdocumentos.clave_documento, tbdocumentos.documento,
                    tbempleados.id_empleado, tbempleados.nombre_empleado, tbempleados.apellido_paterno,
                    tbempleados.apellido_materno FROM documentos tbdocumentos

                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumentos.id_empleado
                    WHERE tbdocumentos.id_documento=$ID_DOCUMENTO AND tbdocumentos.contrato=$CONTRATO
                    ORDER BY  tbdocumentos.clave_documento";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }



    public function mostrarDocumentosComboBox(){
        try{
//            $query="SELECT ID_DOCUMENTO, CLAVE_DOCUMENTO, DOCUMENTO FROM DOCUMENTOS";
            $query="SELECT id_documento, clave_documento, documento FROM documentos";
            
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
    
        
    public function nombresCompletosCombobox()
    {
        try
        {
            $query="SELECT empleados.id_empleado, CONCAT(empleados.nombre_empleado,' ',empleados.apellido_paterno,' ',empleados.apellido_materno) 
                    AS nombre_completo
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
    
    public function responsableDelDocumento()
    {
        try
        {
            $query="SELECT empleados.id_empleado, CONCAT(empleados.nombre_empleado,' ',empleados.apellido_paterno,' ',empleados.apellido_materno) 
                    AS nombre_completo
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
    
    
    
    public function verificacionExisteClaveandDocumento($cadena,$cualverificar){
        try{
           $query="SELECT tbdocumentos.clave_documento  FROM documentos tbdocumentos WHERE tbdocumentos.$cualverificar ='$cadena'";

            
//            $query="SELECT ID_EMPLEADO  FROM EMPLEADOS";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista;
            
        } catch (Exception $ex) {
            throw $ex;
        }
    }
   
    
    public function insertarDocumentos($clave_documento,$documento,$id_empleado,$contrato){
//        echo "aqui en el dao lo tiene  ".$contrato;
        try{
            
            $query_obtenerMaximo_mas_uno="SELECT max(id_documento)+1 as id_documento FROM documentos";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_documento"];
            }
             if($id_nuevo==NULL){
                $id_nuevo=0;
            }
            $query="INSERT INTO documentos(id_documento,clave_documento,documento,id_empleado,contrato)"
                    . "VALUES($id_nuevo,'$clave_documento','$documento',$id_empleado,$contrato)";
//            echo $query;
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            return ($exito != 0)?[0=>1,"id_nuevo"=>$id_nuevo]:[0=>0,"id_nuevo"=>$id_nuevo ];
            
//            $lista= $db->executeQueryUpdate($query);            
//            return $lista;
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }   
    }
    
    
    
    public function actualizarDocumentoPorColumna($COLUMNA,$VALOR,$ID_DOCUMENTO){
         
        try{
            $query="UPDATE documentos SET ".$COLUMNA."='".$VALOR."'  WHERE id_documento=$ID_DOCUMENTO";
//            echo "l aconsulta  : ".$query;
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    
    
    
    public function eliminarDocumento($ID_DOCUMENTO){
        try{
            $query="DELETE FROM documentos WHERE id_documento=$ID_DOCUMENTO";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
//            echo "Valor lista DAO: ".json_encode($lista);
            return $lista;
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }
    }
    
    public function verificarExistenciadeDocumentoEnRegistros($ID_DOCUMENTO)
    {
        try
        {
            $query="SELECT COUNT(*) AS reg
                    FROM registros tbregistros
                    WHERE tbregistros.id_documento=$ID_DOCUMENTO";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['reg'];
//            echo "Este es el query registros: ".json_encode($query);                        
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
        
    }

    public function verificarSiDocumentoEstaValidado($ID_DOCUMENTO)
    {
        try
        {
            $query="SELECT COUNT(*) AS validado
                    FROM validacion_documento tbvalidacion_documento
                    WHERE tbvalidacion_documento.id_documento=$ID_DOCUMENTO AND tbvalidacion_documento.validacion_documento_responsable='true' 
                    OR tbvalidacion_documento.validacion_tema_responsable='true' ";
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
//            echo "Este es el query validado: ".json_encode($query);                        

            return $lista[0]['validado'];
                    
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    

}
?>
