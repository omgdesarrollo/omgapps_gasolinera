<?php


class AsignacionTemaRequisitoPojo {
    //put your code here
    
    private $id_asignacion_tema_requisito;
    private $id_clausula='';
    private $requisito='';
    private $id_documento='';
    


function getId_asignacion_tema_requisito() {
    return $this->id_asignacion_tema_requisito;
}

function setId_asignacion_tema_requisito($id_asignacion_tema_requisito) {
    $this->id_asignacion_tema_requisito = $id_asignacion_tema_requisito;
}


 function getId_clausula() {
    return $this->id_clausula;
}

function setId_clausula($id_clausula) {
    $this->id_clausula = $id_clausula;
}


 function getRequisito() {
    return $this->requisito;
}

 function setRequisito($requisito) {
    $this->requisito = $requisito;
}


function getId_Documento() {
    return $this->id_documento;
}

function setId_Documento($id_documento) {
    $this->id_documento = $id_documento;
}


}
