<?php


class AsignacionDocumentoTemaPojo {

    private $id_asignacion_documento_tema;
    private $id_documento='';
    private $id_asignacion_tema_requisito='';

    
function getId_asignacion_documento_tema() {
return $this->id_asignacion_documento_tema;
}

function setId_asignacion_documento_tema($id_asignacion_documento_tema) {
$this->id_asignacion_documento_tema = $id_asignacion_documento_tema;
}


function getId_documento() {
return $this->id_documento;
}

function setId_documento($id_documento) {
$this->id_documento = $id_documento;
}


function getId_asignacion_tema_requisito() {
return $this->id_asignacion_tema_requisito;
}

function setId_asignacion_tema_requisito($id_asignacion_tema_requisito) {
$this->id_asignacion_tema_requisito = $id_asignacion_tema_requisito;
}

            
}
