<?php
require_once '../dao/AdminDAO.php';

class AdminModel{
    
    public function listarUsuarios($ID_USUARIO)
    {
        try
        {
           $dao=new AdminDAO();
           $rec=$dao->listarUsuarios($ID_USUARIO);
           
           return $rec;
           
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
        
    }
    
    public function listarUsuarioVistas($ID_USUARIO)
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->listarUsuarioVistas($ID_USUARIO);
            
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function listarSubmodulos()
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->listarSubmodulos();
            $resultado;
            foreach($rec as $index=>$value)
            {
                $val = $dao->listarVistasDeSubmodulos($value['id_submodulos']);
                // foreach($dao->listarVistasDeSubmodulos($value['id_submodulos']) as $val)
                // {
                    $resultado[$value['nombre']] = $val;
                    // array_push($resultado[$value['nombre']]=>$val);
                // }
                // array_push($resultado[$value['nombre']]=>$value);
            }
            return $resultado;
        }
        catch(Exception $ex)
        {
            throw $ex;
            return $ex;
        }
    }
    
//    public function listarTemas($CADENA,$ID_USUARIO,$CONTRATO)
//    {
//        try
//        {
//            $dao=new AdminDAO();
//            $rec = $dao->listarTemas($CADENA,$ID_USUARIO,$CONTRATO);
//            return $rec;
//            // var_dump($rec);
//        } catch (Exception $ex)
//        {
//            throw $ex;
//            return false;
//        }
//    }
    
        public function listarTemas($CADENA,$ID_USUARIO,$CONTRATO)
    {
        try
        {
            $dao=new AdminDAO();
            $rec = $dao->listarTemas($CADENA,$ID_USUARIO,$CONTRATO);
            return $rec;
            // var_dump($rec);
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function listarTemasPorUsuario($ID_USUARIO,$CONTRATO)
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->listarTemasPorUsuario($ID_USUARIO,$CONTRATO);
            return $rec;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function insertarUsuario($ID_EMPLEADO, $NOMBRE_USUARIO)
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->insertarUsuario($ID_EMPLEADO, $NOMBRE_USUARIO);
            
            return $rec;
        } catch (Exception $ex)
        {
        throw $ex;
        return false;
        }
    }
    
    public function insertarUsuarioTema($ID_USUARIO, $ID_TEMA)
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->insertarUsuarioTema($ID_USUARIO, $ID_TEMA);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    
    public function actualizarUsuariosVistasPorColumna($COLUMNA, $VALOR, $ID_USUARIO, $ID_ESTRUCTURA)
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->actualizarUsuariosVistasPorColumna($COLUMNA, $VALOR, $ID_USUARIO, $ID_ESTRUCTURA);
            
            return $rec;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function eliminarUsuarioTema($ID_USUARIO,$ID_TEMA)
    {
        try
        {
            $dao=new AdminDAO();
            $rec= $dao->eliminarUsuarioTema($ID_USUARIO,$ID_TEMA);            
            return $rec;
        } catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function ConsultarExisteUsuario($USUARIO)
    {
        try
        {
            $dao = new AdminDAO();
            $rec = $dao->ConsultarExisteUsuario($USUARIO);
            if($rec[0]['res']==0)
            {   
                return true;
            }
            else
            {
                return false;
            }
            
        }
        catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function verificarPAss($USUARIO,$CONTRASENA)
    {
        try
        {
            $dao = new AdminDAO();
            $rec = $dao->verificarPAss($USUARIO,$CONTRASENA);
            if($rec['res']!=0)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function cambiarPass($USUARIO,$CONTRASENA,$VALOR)
    {
        try
        {
            $dao = new AdminDAO();
            $rec = $dao->cambiarPass($USUARIO,$CONTRASENA,$VALOR);
            return $rec;
        }
        catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function cambiarPermisoCumplimiento($ID_USUARIO,$ID_CUMPLIMIENTO,$VALOR)
    {
        try
        {
            $dao = new AdminDAO();
            $rec = $dao->cambiarPermisoCumplimiento($ID_USUARIO,$ID_CUMPLIMIENTO,$VALOR);
            return $rec;
        }
        catch(Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function listarUsuarioVistasAsignadasPorLoMenosUnTipoDePermisoParaMostrarVista($param) {
        try{
            $dao = new AdminDAO();
            $rec = $dao->listarUsuarioVistasAsignadasPorLoMenosUnTipoDePermisoParaMostrarVista($param);
            return $rec;
        } catch (Exception $ex) {
                 throw $ex;
                return false;
        }
    }

    public function cambiarColor($ID_USUARIO,$COLOR)
    {
        try{
            $dao = new AdminDAO();
            $exito = $dao->cambiarColor($ID_USUARIO,$COLOR);
            return $exito;
        } catch (Exception $ex) {
            throw $ex;
            return false;
        }
    }
}

?>

