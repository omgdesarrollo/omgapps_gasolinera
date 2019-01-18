<?php
require_once '../dao/GeneralDAO.php';
require_once '../dao/EvidenciasDAO.php';


class GeneralModel{
    
    
    
    public function actualizarPorColumna($TABLA,$COLUMNA,$VALOR,$ID,$ID_CONTEXT) {
        try
        {
            $dao=new GeneralDAO();
            $rec= $dao->actualizarColumnaPorTabla($TABLA, $COLUMNA, $VALOR, $ID,$ID_CONTEXT);
            
            if($COLUMNA=='validacion_supervisor')
            {
                $dao=new EvidenciasDAO();
                $rec= $dao->actualizarFechaValidacion($ID);
            }
            
            return $rec;
            
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }    
    }

    public function actualizar($TABLA,$COLUMNAS_VALOR,$ID_CONTEXTO)
    {
        try
        {
            $dao=new GeneralDAO();
            $query="UPDATE $TABLA SET";

            $index=0;
            foreach($COLUMNAS_VALOR as $key=>$value)
            {
                if($index!=0)
                {
                    $query .= " , ";
                }
                    $query .= " $key = '$value'";
                $index++;
            }
            foreach($ID_CONTEXTO as $key=>$value)
            {
                $query .= " WHERE $key = $value ";
            }

            // listar por ID no se puede ya que cada vista lista de difentes formas
            $update = $dao->actualizar($query);
            return ($update!=0)?1:0;
        }catch (Exception $ex)
        {
            throw $ex;
            return -1;
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
            
            $dao=new GeneralDAO();
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
    
    
}

?>