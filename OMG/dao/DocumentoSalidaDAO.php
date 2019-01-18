<?php
require_once '../ds/AccesoDB.php';
class DocumentoSalidaDAO{
    
    public function mostrarDocumentosSalida($CONTRATO)
    {
        try{
        //     $query="SELECT tbdocumento_salida.id_documento_salida,tbdocumento_entrada.id_documento_entrada,
        //             tbdocumento_entrada.folio_entrada,tbdocumento_salida.folio_salida,
        //             tbdocumento_salida.fecha_envio, tbdocumento_salida.asunto,
        //             tbautoridad_remitente.clave_autoridad,tbdocumento_salida.destinatario,
        //             tbempleados.nombre_empleado,tbempleados.apellido_paterno, 
        //             tbempleados.apellido_materno,tbdocumento_salida.observaciones 
        //             FROM documento_salida tbdocumento_salida
        //             JOIN documento_entrada tbdocumento_entrada ON
        //             tbdocumento_entrada.id_documento_entrada=tbdocumento_salida.id_documento_entrada
        //             JOIN autoridad_remitente tbautoridad_remitente ON
        //             tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
        //             JOIN temas tbtemas ON
        //             tbtemas.id_tema=tbdocumento_entrada.id_tema
        //             JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado";
        $query = "SELECT tbdocumento_salida.id_documento_salida, tbdocumento_entrada.id_documento_entrada,
        tbdocumento_entrada.folio_entrada, tbdocumento_salida.folio_salida,
        tbdocumento_salida.fecha_envio, tbdocumento_salida.asunto,
        tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad,
        tbdocumento_salida.destinatario, tbempleados.id_empleado,
        CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) AS nombre_empleado,
        tbdocumento_salida.observaciones 
        
        FROM documento_salida tbdocumento_salida
        
        JOIN documento_entrada tbdocumento_entrada ON
        tbdocumento_entrada.id_documento_entrada=tbdocumento_salida.id_documento_entrada
        JOIN autoridad_remitente tbautoridad_remitente ON
        tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
        JOIN temas tbtemas ON
        tbtemas.id_tema=tbdocumento_entrada.id_tema
        JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado 
        WHERE tbdocumento_salida.id_cumplimiento = 1";

        $db=  AccesoDB::getInstancia();
        $lista=$db->executeQuery($query);
            

            return $lista;
    }  catch (Exception $ex){
        //throw $rec;
        throw $ex;
    }
    }
    
    public function mostrarDocumentoSalida($ID_DOCUMENTO)
    {
        try{
            $query="SELECT tbdocumento_salida.id_documento_salida, tbdocumento_entrada.id_documento_entrada,
            tbdocumento_entrada.folio_entrada, tbdocumento_salida.folio_salida,
            tbdocumento_salida.fecha_envio, tbdocumento_salida.asunto,
            tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad,
            tbdocumento_salida.destinatario, tbempleados.id_empleado,
            CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) AS nombre_empleado,
            tbdocumento_salida.observaciones 
            
            FROM documento_salida tbdocumento_salida
            
            JOIN documento_entrada tbdocumento_entrada ON
            tbdocumento_entrada.id_documento_entrada=tbdocumento_salida.id_documento_entrada
            JOIN autoridad_remitente tbautoridad_remitente ON
            tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad
            JOIN temas tbtemas ON
            tbtemas.id_tema=tbdocumento_entrada.id_tema
            JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
            WHERE tbdocumento_salida.id_documento_salida=$ID_DOCUMENTO";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function listarFoliosDeEntrada()
    {
        try{
            $query="SELECT tbdocumento_entrada.id_documento_entrada, tbdocumento_entrada.folio_entrada
                    FROM documento_entrada tbdocumento_entrada";


            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    public function insertarDocumentosSalida($tabla,$id,$id_documento_entrada,$folio_salida,$fecha_envio,$asunto,$destinatario,$observaciones,$CONTRATO)
    {
        
        try{
            
            // $query_obtenerMaximo_mas_uno="SELECT max(id_documento_salida)+1 as id_documento_salida FROM documento_salida";
            // $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            // $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            // $id_nuevo=0;
            
            // foreach ($lista_id_nuevo_autoincrementado as $value) {
            //    $id_nuevo= $value["id_documento_salida"];
            // }
            
            // if ($id_nuevo==NULL) {
            //     $id_nuevo=0;
            // }
                        
            // echo $id;
             $query="insert into $tabla (id_documento_salida,id_documento_entrada,folio_salida,fecha_envio,asunto,destinatario,observaciones,id_cumplimiento)
                                                  
                                                    
                                          VALUES ($id,$id_documento_entrada,'$folio_salida','$fecha_envio','$asunto','$destinatario','$observaciones',$CONTRATO);";
            
//            $db=  AccesoDB::getInstancia();
//            $db->executeQueryUpdate($query);
            $db=  AccesoDB::getInstancia();
            $exito = $db->executeUpdateRowsAfected($query);
            // echo $exito;
            return ($exito != -1)?[0=>1,"id_nuevo"=>$id]:[0=>0,"id_nuevo"=>$id];
             
        } catch (Exception $ex) {
                throw $ex;
        }   
    }
    
    public function actualizarClausula($id_clausula,$clausula,$sub_clausula,$descripcion_clausula,$descripcion_sub_clausula,$texto_breve,$descripcion,$plazo)
    {
        try{
             $query="UPDATE CLAUSULAS SET CLAUSULA='$clausula', SUB_CLAUSULA='$sub_clausula', DESCRIPCION_CLAUSULA='$descripcion_clausula', DESCRIPCION_SUB_CLAUSULA='$descripcion_sub_clausula', TEXTO_BREVE='$texto_breve', DESCRIPCION='$descripcion',PLAZO='$plazo' WHERE ID_CLAUSULA=$id_clausula";
     
            $db= AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
           throw $ex; 
        }
        
    }
    
    public function actualizarDocumentoSalidaPorColumna($COLUMNA,$VALOR,$ID_DOCUMENTO_SALIDA)//no sirve
    {
        try{
            $query="UPDATE documento_salida SET ".$COLUMNA."='".$VALOR."'  WHERE id_documento_salida=$ID_DOCUMENTO_SALIDA";

     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);

        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    
    public function eliminarDocumentoSalidaConFolio($ID_DOCUMENTO)
    {
        try{
            $query="DELETE FROM documento_salida
                    WHERE id_documento_salida = $ID_DOCUMENTO";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeUpdateRowsAfected($query);
            
            return $lista;
        }catch(Exception $ex)
        {
                throw $ex;
                return -1;
        }
    }

    public function eliminarDocumentoSalidaSinFolio($ID_DOCUMENTO)
    {
        try{
            $query="DELETE FROM documento_salida_sinfolio_entrada
                    WHERE id_documento_salida = $ID_DOCUMENTO";
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeUpdateRowsAfected($query);
            
            return $lista;
        } catch (Exception $ex) {
                throw $ex;
                return -1;
        }
    }
    
    public function responsablesDelTemaCombobox()
    {
        try 
        {
            $query="SELECT tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
                    AS nombre_completo
                    FROM empleados tbempleados";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    public function responsableDelTemaParaFiltroConFolio($CONTRATO)
    {
        try 
        {
            $query="SELECT tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
                    AS nombre_completo
                    FROM documento_salida tbdocumento_salida
                    JOIN documento_entrada tbdocumento_entrada ON tbdocumento_entrada.id_documento_entrada=tbdocumento_salida.id_documento_entrada
                    JOIN temas tbtemas ON tbtemas.id_tema=tbdocumento_entrada.id_tema
                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado 
                    WHERE tbdocumento_salida.id_cumplimiento= $CONTRATO GROUP BY tbempleados.id_empleado";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    public function autoridadRemitenteParaFiltroConFolio($CONTRATO)
    {
        try 
        {
            $query="SELECT tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad
                    FROM documento_salida tbdocumento_salida
                    JOIN documento_entrada tbdocumento_entrada ON tbdocumento_entrada.id_documento_entrada=tbdocumento_salida.id_documento_entrada
                    JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_entrada.id_autoridad 
                    WHERE tbdocumento_salida.id_cumplimiento= $CONTRATO GROUP BY tbautoridad_remitente.id_autoridad";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
        
    }


//    AREA DEL DOCUMENTO DE SALIA SIN FOLIO DE ENTRADA
    public function mostrarDocumentosSalidaSinFolio($CONTRATO)
    {
        try 
        {
        //     $query="SELECT tbdocumento_salida_sinfolio_entrada.id_documento_salida_sinfolio, tbdocumento_salida_sinfolio_entrada.id_documento_entrada,
		//  tbdocumento_salida_sinfolio_entrada.folio_salida, 
		//  tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
		//  AS nombre_completo,
		//  tbdocumento_salida_sinfolio_entrada.fecha_envio, tbdocumento_salida_sinfolio_entrada.asunto,
		//  tbdocumento_salida_sinfolio_entrada.destinatario,
		//  tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad,
		//  tbdocumento_salida_sinfolio_entrada.observaciones		 
        //          FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada
        //          JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumento_salida_sinfolio_entrada.id_empleado
        //          JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_salida_sinfolio_entrada.id_autoridad
        //          WHERE tbdocumento_salida_sinfolio_entrada.ID_CUMPLIMIENTO= $CONTRATO";

        $query="SELECT tbdocumento_salida_sinfolio_entrada.id_documento_salida, tbdocumento_salida_sinfolio_entrada.folio_entrada, 
        tbdocumento_salida_sinfolio_entrada.id_documento_entrada, tbdocumento_salida_sinfolio_entrada.folio_salida, 
        tbdocumento_salida_sinfolio_entrada.id_empleado,
        CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) AS nombre_empleado,
		 tbdocumento_salida_sinfolio_entrada.fecha_envio, tbdocumento_salida_sinfolio_entrada.asunto,
		 tbdocumento_salida_sinfolio_entrada.destinatario,
		 tbdocumento_salida_sinfolio_entrada.id_autoridad, tbautoridad_remitente.clave_autoridad,
		 tbdocumento_salida_sinfolio_entrada.observaciones
       FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada
       LEFT JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumento_salida_sinfolio_entrada.id_empleado
       LEFT JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_salida_sinfolio_entrada.id_autoridad
       WHERE tbdocumento_salida_sinfolio_entrada.id_cumplimiento = $CONTRATO";

    //    echo $query;
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    public function obtenermayorDocumentoSalidasSinFolio()
    { 
        try 
        {
            $query="SELECT (SELECT IFNULL(MAX(tbdocumento_salida_sinfolio_entrada.id_documento_salida),-1)) AS resultado
                    FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['resultado'];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;        
        }
    }

    public function obtenermayorDocumentoSalidaConFolio()
    { 
        try 
        {
            $query="SELECT (SELECT IFNULL(MAX(tbdocumento_salida.id_documento_salida),-1)) AS resultado
                    FROM documento_salida tbdocumento_salida";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista[0]['resultado'];
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;        
        }   
    }

    public function responsableDelTemaParaFiltroSinFolio($CONTRATO)
    {
        try 
        {
            $query="SELECT tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
                    AS nombre_completo
                    FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada
                    JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumento_salida_sinfolio_entrada.id_empleado
                    WHERE tbdocumento_salida_sinfolio_entrada.id_cumplimiento = $CONTRATO GROUP BY tbempleados.id_empleado";
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    public function autoridadRemitenteParaFiltroSinFolio($CONTRATO)
    {
        try 
        {
            $query="SELECT tbautoridad_remitente.id_autoridad, tbautoridad_remitente.clave_autoridad
                    FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada
                    JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_salida_sinfolio_entrada.id_autoridad
                    WHERE tbdocumento_salida_sinfolio_entrada.id_cumplimiento= $CONTRATO GROUP BY tbautoridad_remitente.id_autoridad";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);

            return $lista;            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

        public function listarDocumentoSalidaSinFolio($ID_DOCUMENTO_SALIDA)
    {
        try
        {
            $query = "SELECT tbdocumento_salida_sinfolio_entrada.id_documento_salida, tbdocumento_salida_sinfolio_entrada.folio_entrada, 
            tbdocumento_salida_sinfolio_entrada.id_documento_entrada, tbdocumento_salida_sinfolio_entrada.folio_salida, 
            tbdocumento_salida_sinfolio_entrada.id_empleado,
            CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) AS nombre_empleado,
             tbdocumento_salida_sinfolio_entrada.fecha_envio, tbdocumento_salida_sinfolio_entrada.asunto,
             tbdocumento_salida_sinfolio_entrada.destinatario,
             tbdocumento_salida_sinfolio_entrada.id_autoridad, tbautoridad_remitente.clave_autoridad,
             tbdocumento_salida_sinfolio_entrada.observaciones
           FROM documento_salida_sinfolio_entrada tbdocumento_salida_sinfolio_entrada
           LEFT JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumento_salida_sinfolio_entrada.id_empleado
           LEFT JOIN autoridad_remitente tbautoridad_remitente ON tbautoridad_remitente.id_autoridad=tbdocumento_salida_sinfolio_entrada.id_autoridad
           WHERE tbdocumento_salida_sinfolio_entrada.id_documento_salida = $ID_DOCUMENTO_SALIDA";
            // echo $query;
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        }catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
}

?>
