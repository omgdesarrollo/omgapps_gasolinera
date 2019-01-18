<?php

require_once '../ds/AccesoDB.php';

class AsignacionTemaRequisitoDAO {
    //put your code here
//    public function mostrarAsignacionTemas_Requisito()
//    {
//        try
//        {
//            $query="";
//            
//            $db=AccesoDB::getInstancia();
//            $lista=$db->executeQuery($query);
//            return $lista;
//        } catch (Exception $ex) {
//
//        }
//    }
    
    
    public function mostrarAsignacionTemasRequisitos($CADENA,$CONTRATO){
        try{

            
            $query="SELECT tbasignacion_tema_requisito.id_asignacion_tema_requisito, 
                    tbtemas.id_tema, tbtemas.no,tbtemas.nombre,tbtemas.descripcion,
                    tbdocumentos.id_documento, tbdocumentos.clave_documento
                    FROM asignacion_tema_requisito tbasignacion_tema_requisito
                    JOIN temas tbtemas ON tbtemas.id_tema=tbasignacion_tema_requisito.id_tema
                    JOIN documentos tbdocumentos ON tbdocumentos.id_documento=tbasignacion_tema_requisito.id_documento 
                    WHERE tbtemas.identificador LIKE '%$CADENA%' AND tbtemas.contrato=$CONTRATO";
            
            $db=  AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            

            return $lista;
    }  catch (Exception $ex){
        //throw $rec;
        throw $ex;
    }
    }
    
    
    public function mostrarAsignacionTemasRequisitosComboBox(){
        try{

            
            
            $query="SELECT tbasignacion_tema_requisito.id_asignacion_tema_requisito, 
                    tbclausulas.id_clausula, tbclausulas.clausula, tbclausulas.descripcion_clausula,
                    tbasignacion_tema_requisito.requisito FROM asignacion_tema_requisito tbasignacion_tema_requisito
		 
                    JOIN clausulas tbclausulas ON tbclausulas.id_clausula=tbasignacion_tema_requisito.id_clausula";
            
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
    
       
    public function obtenerIdTema($ID_ASIGNACION)
    {
        try
        {
            $query="SELECT tbasignacion_tema_requisito.id_tema
                    FROM asignacion_tema_requisito tbasignacion_tema_requisito
                    WHERE tbasignacion_tema_requisito.id_asignacion_tema_requisito=$ID_ASIGNACION";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
            return $lista[0]["id_tema"];
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }


    public function insertarAsignacionTemaRequisito($id_clausula,$requisito,$id_documento){
        
        try{
            
//            $query_obtenerMaximo_mas_uno="SELECT max(ID_ASIGNACION_TEMA_REQUISITO)+1 as ID_ASIGNACION_TEMA_REQUISITO from ASIGNACION_TEMA_REQUISITO";
            $query_obtenerMaximo_mas_uno="SELECT max(id_asignacion_tema_requisito)+1 as id_asignacion_tema_requisito FROM asignacion_tema_requisito";
            $db_obtenerMaximo_mas_uno=AccesoDB::getInstancia();
            $lista_id_nuevo_autoincrementado=$db_obtenerMaximo_mas_uno->executeQuery($query_obtenerMaximo_mas_uno);
            $id_nuevo=0;
            
            foreach ($lista_id_nuevo_autoincrementado as $value) {
               $id_nuevo= $value["id_asignacion_tema_requisito"];
            }
             if($id_nuevo==NULL){
                $id_nuevo=0;
            }
            $query="INSERT INTO asignacion_tema_requisito(id_asignacion_tema_requisito,id_clausula,requisito,id_documento)"
                    . "VALUES($id_nuevo,$id_clausula,'$requisito',$id_documento)";
            
            $db=  AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
                throw $ex;
        }   
    }
     public function actualizarRegistro($data)
    {
        try
        {
          $query="UPDATE registros SET registro='".$data["registro"]."', id_documento=".$data["id_documento"].", frecuencia='".$data["frecuencia"]."'  where id_registro=".$data["id_registro"];
//          echo $query;
          $db=  AccesoDB::getInstancia();
          $lista= $db->executeQueryUpdate($query);      
          
          return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    
    
    public function insertarRequisito($requisito,$penalizacion)
    {
        try
        {
          $query="INSERT INTO requisitos(requisito,penalizacion)
                  VALUES('$requisito','$penalizacion')";
          
          $db=  AccesoDB::getInstancia();
          $lista= $db->executeQueryUpdate($query);      
//          echo "lista insertar requisitos: ".json_encode($lista);
          
          return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerMaximoRequisito()
    {
        try
        {
            $query="SELECT max(id_requisito) as id_requisito FROM requisitos";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            
        return $lista[0]['id_requisito'];            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    

    public function insertarRequisitoTablaCompuesta($ID_ASIGNACION,$ID_REQUISITO)
    {
        try
        {
            $query="INSERT INTO asignacion_tema_requisito_requisitos(id_asignacion_tema_requisito,id_requisito)
                    VALUES($ID_ASIGNACION,$ID_REQUISITO)";
            
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
//            echo "lista insertar requisitos: ".json_encode($lista);
            
            return $lista;          
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function insertarRegistro($registro,$id_documento,$frecuencia)
    {
        try
        {
            $query="INSERT INTO registros(registro,id_documento,frecuencia)
                    VALUES ('$registro',$id_documento,'$frecuencia')";
//            echo "".$query;
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    public function obtenerMaximoRegistro()
    {
      try
      {
          $query="SELECT MAX(id_registro) AS id_registro FROM registros";
          
          $db= AccesoDB::getInstancia();
          $lista=$db->executeQuery($query);
          
          return $lista[0]['id_registro'];
      } catch (Exception $ex)
      {
          throw $ex;
          return false;
      }
    }
    
    public function insertarRegistroTablaCompuesta($ID_REQUISITO,$ID_REGISTRO)
    {
        try
        {
            $query="INSERT INTO requisitos_registros (id_requisito,id_registro)
                    VALUES($ID_REQUISITO,$ID_REGISTRO)";
            
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);

            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
public function obtenerDetalles_Req($value){
    try{
        $query="select tbrequisitos.id_requisito,tbrequisitos.requisito from requisitos tbrequisitos where tbrequisitos.id_requisito=".$value["id"];
        $db= AccesoDB::getInstancia();
       $lista= $db->executeQuery($query);
        return $lista;
    } catch (Exception $ex) {
        throw $ex;
    }
}

public function obtenerDetallesRequisitoConIdAsignacion($ID_ASIGNACION)
{
    try 
    {
        $query="SELECT tbrequisitos.id_requisito, tbrequisitos.requisito
                FROM asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos
                JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbasignacion_tema_requisito_requisitos.id_requisito
                WHERE tbasignacion_tema_requisito_requisitos.id_asignacion_tema_requisito=$ID_ASIGNACION";
        $db= AccesoDB::getInstancia();
        $lista= $db->executeQuery($query);
        
        return $lista;        
    } catch (Exception $ex) 
    {
        
    }
}

public function obtenerDetallesRegistrosConIdAsignacion($ID_REQUISITO)
{
    try 
    {
        $query="SELECT tbregistros.id_registro, tbregistros.registro, tbregistros.frecuencia, tbdocumentos.clave_documento, tbdocumentos.documento,
		 tbempleados.id_empleado, CONCAT(tbempleados.nombre_empleado,' ',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno)
		 AS responsable
                FROM asignacion_tema_requisito_requisitos tbasignacion_tema_requisito_requisitos		
                JOIN requisitos tbrequisitos ON tbrequisitos.id_requisito=tbasignacion_tema_requisito_requisitos.id_requisito		
                JOIN requisitos_registros tbrequisitos_registros ON tbrequisitos_registros.id_requisito=tbrequisitos.id_requisito
                JOIN registros tbregistros ON tbregistros.id_registro=tbrequisitos_registros.id_registro
                JOIN documentos tbdocumentos ON tbdocumentos.id_documento=tbregistros.id_documento
                JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumentos.id_empleado  
                WHERE tbrequisitos.id_requisito=$ID_REQUISITO";
        $db= AccesoDB::getInstancia();
        $lista= $db->executeQuery($query);
        
        return $lista;        
    } catch (Exception $ex) 
    {
        
    }
}

public function obtenerDetalles_Reg($value){
    try{
      $query="select tbregistros.id_registro,tbregistros.registro,tbregistros.frecuencia,tbdocumentos.clave_documento,
        tbdocumentos.documento,CONCAT(tbempleados.nombre_empleado,'',tbempleados.apellido_paterno,' ',tbempleados.apellido_materno) nombrecompleto 
        from registros tbregistros

        JOIN documentos tbdocumentos  ON tbdocumentos.id_documento= tbregistros.id_documento 
        JOIN empleados tbempleados ON tbempleados.id_empleado=tbdocumentos.id_empleado WHERE tbregistros.id_registro=".$value["id"];
      
        $db= AccesoDB::getInstancia();
        $lista=$db->executeQuery($query);
        return $lista;
    } catch (Exception $ex) {
        throw $ex;
    }
}
 
    
public function actualizarAsignacionTemaRequisito($id_asignacion_tema_requisito, $id_clausula,$requisito){
        try{
             $query="UPDATE asignacion_tema_requisito SET id_clausula='$id_clausula', requisito='$requisito',"
                  . "WHERE id_asignacion_tema_requisito=$id_asignacion_tema_requisito";
     
            $db= AccesoDB::getInstancia();
            $db->executeQueryUpdate($query);
        } catch (Exception $ex) {
           throw $ex; 
        }
        
    }
    
    
    
    public function actualizarAsignacionTemaRequisitoPorColumna($COLUMNA,$VALOR,$ID_ASIGNACION_TEMA_REQUISITO){
         
        try{
            $query="UPDATE asignacion_tema_requisito SET ".$COLUMNA."='".$VALOR."'  "
                 . "WHERE id_asignacion_tema_requisito=$ID_ASIGNACION_TEMA_REQUISITO";
            
//             $query="UPDATE EMPLEADOS SET CORREO='$Correo' WHERE ID_EMPLEADO=$Id_Empleado";
     
            $db= AccesoDB::getInstancia();
           $result= $db->executeQueryUpdate($query);
//            $db->executeQuery($query);
//            return $lista[0];
        } catch (Exception $ex) {
           throw $ex; 
        }
    }
    
    
//    public function eliminarAsignacionTemaRequisito($id_asignacion_tema_requisito){
//        try{
//            $query="DELETE FROM asignacion_tema_requisito WHERE id_asignacion_tema_requisito=$id_asignacion_tema_requisito";
//            $db=  AccesoDB::getInstancia();
//            $db->executeQueryUpdate($query);
//        } catch (Exception $ex) {
//                throw $ex;
//        }
//    }
    
    
    public function eliminarNodoRequisito($ID_REQUISITO)
    {
        try
        {
            $query="DELETE FROM requisitos
                    WHERE requisitos.id_requisito=$ID_REQUISITO";
            
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function eliminarNodoRegistro($ID_REGISTRO)
    {
        try
        {
            $query="DELETE FROM registros
                    WHERE registros.id_registro=$ID_REGISTRO";
            
            $db=  AccesoDB::getInstancia();
            $lista= $db->executeQueryUpdate($query);
            
            return $lista;
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    
    
    public function obtenerRegistrodeEvidencia($ID_REGISTRO)
    {
        try
        {
            $query="SELECT COUNT(*) AS resultado
                    FROM evidencias tbevidencias
                    WHERE tbevidencias.id_registro=$ID_REGISTRO";
            
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
        return $lista[0]['resultado'];
            
        } catch (Exception $ex)
        {
            throw $ex;
            return false;
        }
    }
    public function verificarRegistroExisteEnDocumentoandEstaValidadoPorDelDocumentoYTema($data){
        try{
            $query="select  tbvalidaciondocumento.VALIDACION_DOCUMENTO_RESPONSABLE as validacion_documento_responsable from registros tbregistros join documentos tbdocumentos 
            ON tbdocumentos.ID_DOCUMENTO=tbregistros.ID_DOCUMENTO join 
            validacion_documento tbvalidaciondocumento 
            ON tbvalidaciondocumento.ID_DOCUMENTO=tbdocumentos.ID_DOCUMENTO
            where tbregistros.ID_REGISTRO=".$data["id_registro"];
//            echo $query;
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista;
        } catch (Exception $ex) {
                 throw $ex;
                 return -1;
        }
    }
    
    public function verificarRegistroExisteEnEvidencias($data){
        try{
            $query="select  count(*) as totalevidencias from evidencias tbevidencias
                    where tbevidencias.ID_REGISTRO=".$data["id_registro"];
            $db= AccesoDB::getInstancia();
            $lista=$db->executeQuery($query);
            return $lista[0]["totalevidencias"];
        } catch (Exception $ex) {
             throw $ex;
             return -1;
        }
    }
    public function insertarTemasSubtemasSiNoExitenEnTemaRequisito($value){
        try {
             $query="insert into asignacion_tema_requisito set asignacion_tema_requisito.ID_ASIGNACION_TEMA_REQUISITO=
                    (select  IFNULL(MAX(tbasig.ID_ASIGNACION_TEMA_REQUISITO)+1,0)   from asignacion_tema_requisito tbasig), asignacion_tema_requisito.ID_DOCUMENTO=-1
                    ,asignacion_tema_requisito.ID_TEMA=".$value["id_tema_and_sub"];

             $db=  AccesoDB::getInstancia();
             return $db->executeQueryUpdate($query);  
             
        } catch (Exception $ex) {
            throw $ex;
            return -1;
        }
        }
        
        public function verificarSiExistenTemasSubtemasandEnTemaRequisito($value){
            try{
                $query="select count(*) as cantidad from asignacion_tema_requisito where asignacion_tema_requisito.ID_TEMA= ".$value["id_tema_and_subtema"];
                $db= AccesoDB::getInstancia();
                return $db->executeQuery($query);
            } catch (Exception $ex) {
                throw $ex;
                return -1;
            }
            
        }
    
    
    
    
}
