<?php

require_once '../dao/ControlTemasDAO.php';

class ControlTemasModel {
    //put your code here
    
    public function listarTemas($CONTRATO, $CADENA)
    {
        try 
        {
            $dao = new ControlTemasDAO();
            $lista = $dao->listarTemas($CONTRATO, $CADENA);
            $lista2 = $lista;
            $bandera = 1;
            $bandera2 = 0;
            $id=0;
            foreach($lista2 as $key => $value)
            {
                if($bandera==1)
                {
                    $id = $value["id_tema"];
                    $bandera=0;
                }
                else
                {
                    if($value["id_tema"]==$id)
                    {
                        unset($lista[$key]);
                    }
                    else
                    {
                        $id = $value["id_tema"];
                    }
                }
            }
            
            foreach($lista as $key => $value)
            {
                $bandera = 1;
                $bandera2 = 1;
                foreach($lista2 as $k => $v)
                {
                    
                    if($v["id_tema"]==$value["id_tema"])
                    {
                        if($bandera2!=1)
                        {
                            // if($value["estado"]!=0)
                            // {
                                $lista[$key]["estado"] = 1;
                            // }
                        }
                        else
                            $bandera2=0;
                    }
                }
            }

            // var_dump($lista);

            return $lista;
        } catch (Exception $ex) 
        {
            throw $ex;
            return -1;
        }
    }

    public function actualizar($ID_TEMA,$FECHA)
    {
        try
        {
            $dao = new ControlTemasDAO();
            $rec = $dao->actualizar($ID_TEMA,$FECHA);
            return $rec > 0 ? 1 : 0;
        }catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }

    public function iniciarTematica($CONTRATO,$DATALISTADO,$FECHA)
    {
        try
        {
            $dao = new ControlTemasDAO();
            foreach($DATALISTADO as $key => $value)
            {
                if($value["estado"]=="0")
                    $rec = $dao->iniciarTematica($value["id_tema"],$FECHA);
            }
            return $rec > 0 ? 1 : 0;
        }catch(Exception $ex)
        {
            throw $ex;
            return -1;
        }
    }
    
}

?>
