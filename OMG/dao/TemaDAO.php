<?php
require_once '../ds/AccesoDB.php';

class TemaDAO{
    

   
public function mostrarTemas($cadena,$contrato)
{
    try
    {
        $query="SELECT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion, tbtemas.plazo, tbtemas.padre,
		tbtemas.identificador,tbtemas.padre_general,tbtemas.responsable_general
                FROM temas tbtemas
                JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
                WHERE tbtemas.identificador LIKE '%$cadena%'    and  tbtemas.contrato=$contrato ORDER BY cast(NO as UNSIGNED) ";
        $db=  AccesoDB::getInstancia();
        $lista=$db->executeQuery($query);
        return $lista;
    }catch (Exception $ex)
    {       
        throw $ex;
        return false;
    }
}


public function mostrarTemasComboBox($cadena,$contrato)
{
    try
    {
        $query="SELECT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion
                FROM temas tbtemas
                WHERE tbtemas.PADRE=0 AND tbtemas.identificador LIKE '%$cadena%' AND tbtemas.contrato=$contrato";
        
        $db=  AccesoDB::getInstancia();
        $lista=$db->executeQuery($query);
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
        $query="SELECT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion, tbtemas.plazo,
                tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno	
		FROM temas tbtemas
                JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
                WHERE tbtemas.identificador LIKE '%$CADENA%' AND tbtemas.contrato=$CONTRATO AND tbtemas.padre=$ID";
        
        $db=  AccesoDB::getInstancia();
        $lista=$db->executeQuery($query);
        
        return $lista;
        
    } catch (Exception $ex)
    {
        throw $ex;
        return false;
    }
}

public function listarDetallesSeleccionados($ID)
{
    try
    {
        $query="SELECT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion, tbtemas.plazo,
                tbempleados.id_empleado ,tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno	
                FROM temas tbtemas
                JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.responsable_general
                WHERE tbtemas.id_tema=$ID";

        // $query="SELECT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion, tbtemas.plazo,
        //         tbempleados.id_empleado ,tbempleados.nombre_empleado, tbempleados.apellido_paterno, tbempleados.apellido_materno	
        //         FROM temas tbtemas
        //         JOIN empleados tbempleados ON tbempleados.id_empleado=tbtemas.id_empleado
        //         WHERE tbtemas.id_tema=$ID";
        
        $db=  AccesoDB::getInstancia();
        $lista=$db->executeQuery($query);
        
        return $lista;
               
    } catch (Exception $ex)
    {
        throw $ex;
        return false;
    }
}


public function insertarNodo($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO)
{
    try
    {
        $query="INSERT INTO temas (no,nombre,descripcion,plazo,padre,id_empleado,identificador,contrato,fecha_inicio,padre_general,responsable_general) 
                VALUES ('$NO','$NOMBRE','$DESCRIPCION','$PLAZO',$NODO,'$ID_EMPLEADO','$IDENTIFICADOR',$CONTRATO,'0000-00-00','0',$ID_EMPLEADO)";
        $db= AccesoDB::getInstancia();
        $exito= $db->executeQueryUpdate($query);
            if($exito==1)
                $exito = $db->executeQuery("SELECT LAST_INSERT_ID()")[0]["LAST_INSERT_ID()"];
            else
                $exito = -2;
            return $exito;

        return $exito;
        
    } catch (Exception $ex)
    {
        throw $ex;
        return false;
    }
}
public function insertarNodoHijos($NO,$NOMBRE,$DESCRIPCION,$PLAZO,$NODO,$ID_EMPLEADO,$IDENTIFICADOR,$CONTRATO,$DATOS_GENERALES)
{
//    echo json_encode($DATOS_GENERALES);
    $padre_general=$DATOS_GENERALES->padre_general;
    $responsable_general=$DATOS_GENERALES->reponsable_general;
    try
    {
        $query="INSERT INTO temas (no,nombre,descripcion,plazo,padre,id_empleado,identificador,contrato,fecha_inicio,padre_general,responsable_general) 
                VALUES ('$NO','$NOMBRE','$DESCRIPCION','$PLAZO',$NODO,'$ID_EMPLEADO','$IDENTIFICADOR',$CONTRATO,'0000-00-00','$padre_general',$responsable_general)";
        $db= AccesoDB::getInstancia();
        $exito= $db->executeQueryUpdate($query);
            if($exito==1)
                $exito = $db->executeQuery("SELECT LAST_INSERT_ID()")[0]["LAST_INSERT_ID()"];
            else
                $exito = -2;
            return $exito;

        return $exito;
        
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
        $query="DELETE FROM temas WHERE temas.id_tema=$ID";
        
        $db= AccesoDB::getInstancia();
        $lista= $db->executeQueryUpdate($query);
        
        return $lista;
  
    } catch (Exception $ex)
    {
        throw $ex;
        return false;
    }
}

    public function verificarSiTemaEstaEnDocumentoDeEntrada($ID_TEMA)
    {
        try 
        {
            $query="SELECT IF(COUNT(tbdocumento_entrada.id_tema)=0,0,1) AS resultado
                    FROM documento_entrada tbdocumento_entrada
                    WHERE tbdocumento_entrada.id_tema=$ID_TEMA";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        
            return $lista[0]['resultado'];            
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }

    }

        public function listarTodosTemas()
    {
        try 
        {
            $db= AccesoDB::getInstancia();
            $query="UPDATE temas SET padre_general = id_tema, responsable_general = id_empleado WHERE padre = 0";
            $db->executeQueryUpdate($query);

            $query="SELECT tbtemas.id_tema,tbtemas.id_empleado
                    FROM temas tbtemas WHERE tbtemas.padre = 0";
            $lista= $db->executeQuery($query);
            return $lista;

        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
      public function obtenerHijosTema($ID_TEMA)
    {
        try
        {
            $query="SELECT tbtemas.id_tema
            FROM temas tbtemas
            WHERE tbtemas.padre = $ID_TEMA";
            // echo $query;

            $db= AccesoDB::getInstancia();
            $result= $db->executeQuery($query);
            return $result;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
     public function cambiarDatosTema($ID_TEMA,$PADRE,$RESP)
    {
        try 
        {
            $query="UPDATE temas SET padre_general = $PADRE, responsable_general = $RESP
                    WHERE id_tema = $ID_TEMA";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            return $lista;

        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }
    
    
    
    
     public function actualizarColumnas($CADENA)
    {
        try
        {
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($CADENA);
            
            return $lista;
                    
        } catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
    
      public function actualizarColumnaPorTabla($TABLA,$COLUMNA,$VALOR,$ID,$ID_CONTEXT)
    {
//        echo "entro aqui ";
        try {
            $query="UPDATE $TABLA SET $COLUMNA='$VALOR' WHERE $ID_CONTEXT=$ID";
//            echo $query;
            $db= AccesoDB::getInstancia();
            $result= $db->executeQueryUpdate($query);
            
            return $result;
            
        } catch (Exception $ex){
            throw $ex;
            return false;
        }
    }
    
    
    public function obtenerPadreGeneralPorElTemasOrSubtemaQueSeMande($value){
        try{
            $query="select  tbtemas.padre_general from   temas tbtemas where tbtemas.ID_TEMA=".$value["id_tema"];
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            return $lista;
        } catch (Exception $ex) {
            throw $ex;
            return false;
        }
    }
    
    
    
    
      
    

}

?>
