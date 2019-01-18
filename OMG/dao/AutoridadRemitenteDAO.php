<?php
require_once '../ds/AccesoDB.php';
class AutoridadRemitenteDAO{

    public function mostrarAutoridadesRemitentes()
    {
        try{
                        
            $query="SELECT id_autoridad, clave_autoridad, descripcion, direccion, telefono, extension, 
		           email,direccion_web FROM autoridad_remitente";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
    }  catch (Exception $ex)
    {
        throw $ex;
        return -1;
    }
    }
    
    
    public function listarAutoridadRemitente($ID_AUTORIDAD)
    {
        try
        {
            $query="SELECT autoridad_remitente.id_autoridad, autoridad_remitente.clave_autoridad, autoridad_remitente.descripcion,
                            autoridad_remitente.direccion, autoridad_remitente.telefono, autoridad_remitente.extension, 
                            autoridad_remitente.email, autoridad_remitente.direccion_web	
                    FROM autoridad_remitente
                    WHERE autoridad_remitente.id_autoridad=$ID_AUTORIDAD";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }




    public function mostrarAutoridadesRemitentesComboBox()
    {
        try{
                        
            $query="SELECT id_autoridad, clave_autoridad, descripcion, direccion, telefono, extension, 
		           email,direccion_web FROM autoridad_remitente";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
    }  catch (Exception $ex)
    {
        throw $ex;
        return -1;
    }
    }
    

    public function insertarAutoridadRemitente($clave_autoridad,$descripcion,$direccion,$telefono,$extension,$email,$direccion_web)
    {
        
        try{
            
            $query_obtenerMaximo_mas_uno="SELECT max(id_autoridad)+1 as id_autoridad from autoridad_remitente";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
          
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_autoridad"];
            }
            
            if($id_nuevo==NULL){
                $id_nuevo=0;
            }
                        
            $query="INSERT INTO autoridad_remitente(id_autoridad, clave_autoridad, descripcion, direccion, telefono, extension, email, direccion_web)"
                    . "VALUES($id_nuevo,'$clave_autoridad','$descripcion','$direccion','$telefono','$extension','$email','$direccion_web')";
            
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            return ($exito != 0)?[0=>1,"id_nuevo"=>$id_nuevo]:[0=>0,"id_nuevo"=>$id_nuevo ];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }   
    }
    
    public function actualizarAutoridadRemitentePorColumna($COLUMNA,$VALOR,$id_autoridad)
    {
         
        try{
            $query="UPDATE autoridad_remitente SET ".$COLUMNA."='".$VALOR."'  WHERE id_autoridad=$id_autoridad";
     
            $db= AccesoDB::getInstancia();
            $result= $db->executeQueryUpdate($query);

        } catch (Exception $ex) 
        {
           throw $ex;
           return -1;
        }
    }
    
    public function eliminarAutoridadRemitente($ID_AUTORIDAD)
    {
        try{
            $query="DELETE FROM autoridad_remitente WHERE id_autoridad=$ID_AUTORIDAD";
            
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    public function verificarExistenciadeAutoridadenDocumentoEntrada($ID_AUTORIDAD)
    {
        try
        {
            $query="SELECT COUNT(*) AS verificacion_documento_entrada
                    FROM documento_entrada tbdocumento_entrada
                    JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
                    WHERE tbautoridad_remitente.id_autoridad=$ID_AUTORIDAD";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['verificacion_documento_entrada'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
        public function verificarExistenciadeAutoridadenDocumentoSalidaSinFolio($ID_AUTORIDAD)
    {
        try
        {
            $query="SELECT COUNT(*) AS verificacion_documento_salida_sinfolio
                    FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada
                    WHERE tbdocumento_salida_sinfolio_entrada.id_autoridad=$ID_AUTORIDAD";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['verificacion_documento_salida_sinfolio'];
        } catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
}

?>
