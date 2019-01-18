<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of NotificacionesModel
 *
 * @author usuario
 */

require '../dao/NotificacionesDAO.php';


class NotificacionesModel {

    
    
    public function guardarNotificacionHibry($id_usuario,$id_para,$mensaje,$tipo,$atendido,$asunto,$CONTRATO){
      try{
            $dao=new NotificacionesDAO();
            $rec=$dao->guardarNotificacionHibry($id_usuario,$id_para,$mensaje,$tipo,$atendido,$asunto,$CONTRATO);
            
//            echo "valores rec: ".json_encode($rec);
            return $rec;
        }catch (Exception $ex)
        {
            return false;
        }
    
    
    }
    
    public function mostrarNotificacionesCompletas($ID_USUARIO)
    {
        try{
            $dao= new NotificacionesDAO();
            $rec= $dao->mostrarNotificacionesCompletas($ID_USUARIO);
            return $rec;
        } catch (Exception $ex) {

        }    
    }
    
    public function eliminarNotificacion($ID_NOTIFICACION)
    {
        try{
            $dao= new NotificacionesDAO();
            $rec= $dao->eliminarNotificacion($ID_NOTIFICACION);
            return $rec;
        } catch (Exception $ex)
        {
            return false;
        }
    }
    
    
    
}
