<?php
require_once '../ds/AccesoDB.php';

class AdminDAO{
    
    public function listarUsuarios($ID_USUARIO)
    {
        try
        {
            $query="SELECT tbusuarios.id_usuario, tbusuarios.nombre_usuario,
		    CONCAT (tbempleados.nombre_empleado,' ', tbempleados.apellido_paterno,' ', tbempleados.apellido_materno)
            AS nombre, tbempleados.categoria, tbempleados.correo
            FROM usuarios tbusuarios
            JOIN empleados tbempleados ON tbempleados.id_empleado=tbusuarios.id_empleado
            WHERE tbusuarios.id_usuario > 0 && tbusuarios.id_usuario != $ID_USUARIO";
            
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function listarUsuarioVistas($ID_USUARIO)
    {
//        echo "s";
        try
        {
//            $query="SELECT tbestructura.id_estructura, tbestructura.id_submodulos,tdsubmodulos.nombre nombre_submodulo ,tbestructura.descripcion, tbestructura.id_vistas,tbvistas.nombre,tbestructura.vista_nombre_logico,tbestructura.nombre_contenido_dentro_submodulos nombre_contenido_sub,tbestructura.imagen_seccion_up,tbestructura.imagen_seccion_izquierda,
//           tbusuarios_vistas.new,tbusuarios_vistas.consult 
//            FROM usuarios_vistas tbusuarios_vistas
//            JOIN estructura tbestructura ON tbusuarios_vistas.id_estructura = tbestructura.id_estructura
//            JOIN vistas tbvistas ON tbvistas.id_vistas = tbestructura.id_vistas
//            JOIN submodulos tdsubmodulos ON tdsubmodulos.id_submodulos = tbestructura.id_submodulos
//            WHERE tbusuarios_vistas.id_usuario=$ID_USUARIO ";

            $query="SELECT tbestructura.id_estructura, tbestructura.id_submodulos,tdsubmodulos.nombre nombre_submodulo ,tbestructura.descripcion, tbestructura.id_vistas,tbvistas.nombre,tbestructura.vista_nombre_logico,tbestructura.nombre_contenido_dentro_submodulos nombre_contenido_sub,tbestructura.imagen_seccion_up,tbestructura.imagen_seccion_izquierda, tbusuarios_vistas.EDIT,
            tbusuarios_vistas.delete, tbusuarios_vistas.new,tbusuarios_vistas.consult 
            FROM usuarios_vistas tbusuarios_vistas
            JOIN estructura tbestructura ON tbusuarios_vistas.id_estructura = tbestructura.id_estructura
            JOIN vistas tbvistas ON tbvistas.id_vistas = tbestructura.id_vistas
            JOIN submodulos tdsubmodulos ON tdsubmodulos.id_submodulos = tbestructura.id_submodulos
            WHERE tbusuarios_vistas.id_usuario=$ID_USUARIO";

            // $query="SELECT tbestructura.id_estructura, tbestructura.id_submodulos,tdsubmodulos.nombre nombre_submodulo,
            // tbestructura.descripcion, tbestructura.id_vistas,tbvistas.nombre,tbestructura.vista_nombre_logico,
            // tbestructura.nombre_contenido_dentro_submodulos nombre_contenido_sub,tbestructura.imagen_seccion_up,
            // tbestructura.imagen_seccion_izquierda, tbusuarios_vistas.EDIT,
            // tbusuarios_vistas.delete, tbusuarios_vistas.new,tbusuarios_vistas.consult 
            //             FROM usuarios_vistas tbusuarios_vistas
            //             JOIN estructura tbestructura ON tbusuarios_vistas.id_estructura = tbestructura.id_estructura
            //             JOIN vistas tbvistas ON tbvistas.id_vistas = tbestructura.id_vistas
            //             JOIN submodulos tdsubmodulos ON tdsubmodulos.id_submodulos = tbestructura.id_submodulos
            //             WHERE tbusuarios_vistas.id_usuario = $ID_USUARIO AND tbvistas.id_vistas = (IF(tbvistas.id_vistas = 24,
            //                 IF(
            //                     (SELECT tbsubmodulos.adquirido FROM submodulos tbsubmodulos WHERE tbsubmodulos.id_submodulos=3)=0,
            //                     -1,tbvistas.id_vistas
            //                 )
            //                 ,tbvistas.id_vistas))";
            // echo $query;
            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
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
           $query="SELECT tbsubmodulos.id_submodulos, tbsubmodulos.nombre
                   FROM submodulos tbsubmodulos WHERE tbsubmodulos.id_submodulos != 1  AND tbsubmodulos.adquirido = 1";
           $db= AccesoDB::getInstancia();
           $lista= $db->executeQuery($query);
           
           return $lista;
           
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function listarVistasDeSubmodulos($ID_SUBMODULOS)
    {
        try
        {
          $query="SELECT tbestructura.id_submodulos,tbestructura.id_estructura, tbestructura.descripcion  
                FROM estructura tbestructura
                WHERE  tbestructura.id_submodulos=$ID_SUBMODULOS AND
                tbestructura.id_vistas = (IF(tbestructura.id_vistas = 24,
                    IF(
                        (SELECT tbsubmodulos.adquirido FROM submodulos tbsubmodulos WHERE tbsubmodulos.id_submodulos=3)=0,
                        -1,tbestructura.id_vistas
                    )
                    ,tbestructura.id_vistas)
                )";
                  
          $db= AccesoDB::getInstancia();        
          $lista= $db->executeQuery($query);
          
          return $lista;
          
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }


//    public function listarTemas($CADENA,$ID_USUARIO,$CONTRATO)
//    {
//        try
//        {
//            $query="SELECT tbtemas.id_tema,tbtemas.no, tbtemas.nombre, tbtemas.descripcion,tbtemas.identificador
//                    FROM temas tbtemas
//                    WHERE LOWER(tbtemas.nombre) LIKE '%$CADENA%' AND tbtemas.padre=0 AND tbtemas.contrato=$CONTRATO
//                    AND tbtemas.id_tema 
//                    NOT IN( SELECT tbusuario_temas.id_tema FROM usuarios_temas tbusuario_temas 
//                    WHERE tbusuario_temas.id_usuario=$ID_USUARIO )";
//
//            $db= AccesoDB::getInstancia();        
//            $lista= $db->executeQuery($query);
//            return $lista;
//            // var_dump($lista);
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
            $query="SELECT tbtemas.id_tema,tbtemas.no, tbtemas.nombre, tbtemas.descripcion,tbtemas.identificador
                    FROM temas tbtemas
                    WHERE LOWER(tbtemas.nombre) LIKE '%$CADENA%' AND tbtemas.identificador LIKE '%catalogo%' AND tbtemas.padre=0 AND tbtemas.contrato=$CONTRATO
                    AND tbtemas.id_tema
                    NOT IN( SELECT tbusuario_temas.id_tema FROM usuarios_temas tbusuario_temas 
                    WHERE tbusuario_temas.id_usuario=$ID_USUARIO)";

            $db= AccesoDB::getInstancia();        
            $lista= $db->executeQuery($query);
//            echo "Este es el query: ".json_encode($query);
            return $lista;
            // var_dump($lista);
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
            $query="SELECT tbtemas.id_tema, tbtemas.no, tbtemas.nombre, tbtemas.descripcion, tbtemas.identificador
                    FROM usuarios_temas tbusuarios_temas
                    JOIN temas tbtemas ON tbtemas.id_tema = tbusuarios_temas.id_tema
                    WHERE tbusuarios_temas.id_usuario = $ID_USUARIO AND tbtemas.contrato=$CONTRATO";

            $db= AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            return $lista;
            
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
            $query_obtenerMaximo_mas_uno="SELECT max(id_usuario)+1 as id_usuario from usuarios";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_usuario"];
            }
            
            $query ="INSERT INTO usuarios (id_usuario, nombre_usuario, contra, id_empleado) VALUES($id_nuevo,'$NOMBRE_USUARIO',
                    (SELECT tbempleados.correo FROM empleados tbempleados
                    WHERE tbempleados.id_empleado=$ID_EMPLEADO),$ID_EMPLEADO)";
            
            $db= AccesoDB::getInstancia();
            $lista['resultado'] = $db->executeQueryUpdate($query);
            $lista['id_usuario'] = $id_nuevo;

            return $lista;
            
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
            $query="INSERT INTO usuarios_temas (id_usuario,id_tema) VALUES ($ID_USUARIO,$ID_TEMA)";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
           
            return $lista;            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    

    public function actualizarUsuariosVistasPorColumna($COLUMNA,$VALOR,$ID_USUARIO,$ID_ESTRUCTURA)
    {
        try
        {
            $query="UPDATE usuarios_vistas tbusuarios_vistas 
                    SET tbusuarios_vistas.".$COLUMNA."= '".$VALOR."' WHERE tbusuarios_vistas.id_usuario=$ID_USUARIO AND tbusuarios_vistas.id_estructura=$ID_ESTRUCTURA";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
            
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
          $query="DELETE FROM usuarios_temas
                  WHERE id_usuario=$ID_USUARIO AND id_tema=$ID_TEMA";
          $db= AccesoDB::getInstancia();
          $lista= $db->executeQueryUpdate($query);
          return $lista;
          
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function ConsultarExisteUsuario($USUARIO)
    {
        try
        {
          $query="SELECT COUNT(*) AS res 
                  FROM usuarios tbusuarios
                  WHERE tbusuarios.nombre_usuario='$USUARIO'";
          
          $db= AccesoDB::getInstancia();
          $lista= $db->executeQuery($query);
          return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function verificarPass($USUARIO,$CONTRASENA)
    {
        try
        {
            $query="SELECT COUNT(*) AS res 
                  FROM usuarios tbusuarios
                  WHERE tbusuarios.id_usuario=$USUARIO
                  AND tbusuarios.contra='$CONTRASENA'";
            // echo $query;
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQuery($query);
            // echo $lista[0]['res'];
            return $lista[0];
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function cambiarPass($USUARIO,$CONTRASENA,$VALOR)
    {
        try
        {
            $query="UPDATE usuarios tbusuarios
                SET tbusuarios.contra= '$VALOR'
                WHERE tbusuarios.id_usuario=$USUARIO
                AND tbusuarios.contra='$CONTRASENA'";
            $db= AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            return $lista;
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function cambiarPermisoCumplimiento($ID_USUARIO,$ID_CUMPLIMIENTO,$VALOR)
    {
        try
        {
            $query="UPDATE usuarios_cumplimientos tbusuarios_cumplimientos
                SET tbusuarios_cumplimientos.acceso = '$VALOR'
                WHERE tbusuarios_cumplimientos.id_usuario=$ID_USUARIO
                AND tbusuarios_cumplimientos.id_cumplimiento=$ID_CUMPLIMIENTO";
            $db= AccesoDB::getInstancia();
            $exito= $db->executeQueryUpdate($query);
            return $exito;
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }

    public function cambiarColor($ID_USUARIO,$COLOR)
    {
        try
        {
            $query = "UPDATE usuarios SET fondo_color = '$COLOR' WHERE ID_USUARIO = $ID_USUARIO";
            $db= AccesoDB::getInstancia();
            $exito= $db->executeUpdateRowsAfected($query);
            return $exito;
        }catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    //lo de aqui para abajo es para mostrar estructura principal tomand en cuenta permisos no borrar
    public function listarUsuarioVistasAsignadasPorLoMenosUnTipoDePermisoParaMostrarVista($param)
    {
        try
        {
            $query="SELECT tbestructura.id_estructura, tbestructura.id_submodulos,tdsubmodulos.nombre nombre_submodulo ,tbestructura.descripcion, tbestructura.id_vistas,tbvistas.nombre,tbestructura.vista_nombre_logico,tbestructura.nombre_contenido_dentro_submodulos nombre_contenido_sub,tbestructura.imagen_seccion_up,tbestructura.imagen_seccion_izquierda, tbusuarios_vistas.EDIT,
            tbusuarios_vistas.delete, tbusuarios_vistas.new,tbusuarios_vistas.consult 
            FROM usuarios_vistas tbusuarios_vistas
            JOIN estructura tbestructura ON tbusuarios_vistas.id_estructura = tbestructura.id_estructura
            JOIN vistas tbvistas ON tbvistas.id_vistas = tbestructura.id_vistas
            JOIN submodulos tdsubmodulos ON tdsubmodulos.id_submodulos = tbestructura.id_submodulos
            WHERE tdsubmodulos.adquirido = 1 AND tbusuarios_vistas.id_usuario='".$param['id_usuario']."'     order by tbestructura.ordenar asc";

            $db= AccesoDB::getInstancia();
            $lista = $db->executeQuery($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }//aqui termina para mostrar estructura principal tomand en cuenta permisos
}


?>

