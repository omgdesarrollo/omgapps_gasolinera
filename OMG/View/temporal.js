$(function(){
    
}); 
//   var estructuraGrid=[
//        { name: "No", type: "text", width: 80, validate: "required" },
//        { name: "Clave del Documento", type: "text", width: 200, validate: "required" },
//        { name: "Nombre del Documento", type: "text", width: 250, validate: "required" },
//        { name: "Responsable del Documento", type: "text", width: 250, validate: "required" },
//        { name: "Tema", type: "text", width: 150, validate: "required" },
//        { name: "Requisitos", type: "text", width: 150, validate: "required" },
//        { name: "Registros", type: "text", width: 150, validate: "required" },
//        { name: "Status", type: "text", width: 150, validate: "required" }
//];




function listarDatos()
{
    return new Promise((resolve,reject)=>
    {
        URL = 'filesEvidenciaDocumento/';
        __datos=[];
        $.ajax({
            url: '../Controller/InformeValidacionDocumentosController.php?Op=listarparametros(v,nv,sd)',
            type: 'GET',
            async:false,
            data:"URL="+URL,
            beforeSend:function()
            {
                growlWait("Solicitud","Solicitando Datos...");
            },
            success:function(data)
            {
                if(typeof(data)=="object")
                {
                    growlSuccess("Solicitud","Registros obtenidos");
                    dataListado = data;
                    $.each(data,function (index,value)
                    {
                        __datos.push( reconstruir(value,index+1) );
                    });
                    // console.log(__datos);
                    DataGrid = __datos;
                    gridInstance.loadData();
                    resolve();
                }
                else
                {
                    growlSuccess("Solicitud","No Existen Registros de Evidencias");
                    reject();
                }
            },
            error:function(e)
            {
                // console.log(e);
                growlError("Error","Error en el servidor");
                reject();
            }
        });
    });
}

function reconstruir(value,index)//listo jsgrid
{
    ultimoNumeroGrid = index;
    tempData = new Object();
    tempArchivo="";
    noCheck = "<i class='fa fa-times-circle-o' style='font-size: xx-large;color:red;cursor:pointer' aria-hidden='true'></i>";
    yesCheck = "<i class='fa fa-check-circle-o' style='font-size: xx-large;color:#02ff00;cursor:pointer' aria-hidden='true'></i>";
    noMsj = "<i class='fa fa-file-o' style='font-size: xx-large;color:#6FB3E0;cursor:pointer' aria-hidden='true'></i>";
    yesMsj = "<i class='ace-icon fa fa-file-text-o icon-animated-bell' style='font-size: xx-large;color:#02ff00;cursor:pointer' aria-hidden='true'></i>";
    denegado = "<i class='fa fa-ban' style='font-size: xx-large;color:red;' aria-hidden='true'></i>";
        nametmp="";
        tempData["id_principal"] = [];
        tempData["id_principal"].push({'id_evidencias':value.id_evidencias});
        tempData["validador"] = value.validador;
        tempData["no"] = index;
        tempData["tema"] = value.nombre;
        // tempData["requisito"] = value.requisito;
        tempData["registro"] = value.registro;
        tempData["frecuencia"] = value.frecuencia;
        tempData["clave_documento"] = value.clave_documento;
        tempData["fecha_creacion"] = getSinFechaFormato(value.fecha_creacion);
        
        tempData["adjuntar_evidencia"] = "<button onClick='mostrar_urls("+value.id_evidencias+","+value.validador+","+value.validacion_supervisor+","+value.id_usuario+");'";
        tempData["adjuntar_evidencia"] += " type='button' class='btn btn-info botones_vista_tabla' data-toggle='modal' data-target='#create-itemUrls'>";
        tempData["adjuntar_evidencia"] += "<i class='fa fa-cloud-upload' style='font-size: 22px'></i></button>";
        $.each(value.archivosUpload[0],function(index2,value2)
        {
            tempArchivo="a";
            nametmp = value2.split("^-O-^-M-^-G-^");
            fecha = getFechaStamp(nametmp[0]);
            // fecha = new Date(nametmp[0]*1000);
            // fecha = fecha.getDate() +" "+ months[fecha.getMonth()] +" "+ fecha.getFullYear() +" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
            tempData["fecha_registro"] = fecha;

            tempData["usuario"] = value.usuario;

            tempData["accion_correctiva"] = "<button style='font-size:x-large;color:#39c;background:transparent;border:none;' onClick='MandarNotificacion("+value.id_responsable+","+value.responsable+",\""+value.accion_correctiva+"\","+value.id_evidencias+","+value.validador+");' data-toggle='modal' data-target='#MandarNotificacionModal'>";
            if(value.accion_correctiva!="")
            {
                tempData["accion_correctiva"] += yesMsj+"</button>";
            }
            else
            {
                tempData["accion_correctiva"] += noMsj+"</button>";
            }
            
            tempData["plan_accion"] = "<button id='btn_cargaGantt' class='botones_vista_tabla' onClick='cargarprogram("+value.id_evidencias+","+value.validacion_supervisor+");'>";
            if(value.validacion_supervisor=="true")
                tempData["plan_accion"] += "Vizualizar Programa";
            else
                tempData["plan_accion"] += "Cargar Programa";
            
            tempData["plan_accion"] += "</button>";

            tempData["desviacion"] = "<button style='font-size:x-large;color:#39c;background:transparent;border:none;' onClick='MandarNotificacionDesviacion("+value.id_usuario+","+value.responsable+",\""+value.desviacion+"\","+value.id_evidencias+");' data-toggle='modal' data-target='#MandarNotificacionModal'>";
            if(value.desviacion!="")
            {
                tempData["desviacion"] += yesMsj+"</button>";
            }
            else
            {
                tempData["desviacion"] += noMsj+"</button>";
            }
            
            if(value.responsable=="1")
            {                    
                tempData["validacion"] = "<button style='font-size:x-large;color:#39c;background:transparent;border:none;' onClick='validarEvidencia(this,\"evidencias\",\"validacion_supervisor\",\"id_evidencias\","+value.id_evidencias+","+value.id_usuario+")'>";
                if(value.validacion_supervisor=="true")
                    tempData["validacion"] += yesCheck+"</button>";
                else
                    tempData["validacion"] += noCheck+"</button>";
            }
            else
            {
                if(value.validacion_supervisor=='true')
                {
                    tempData["validacion"] = "<button style='font-size:x-large;color:#39c;background:transparent;border:none;' onClick='swalInfo(\"Validadopor el responsable\")'>";
                    tempData["validacion"] += yesCheck+"</button>";
                }
                else
                {
                    tempData["validacion"] = "<button style='font-size:x-large;color:#39c;background:transparent;border:none;'  onClick='swalInfo(\"Aun no validado\")'>";
                    tempData["validacion"] += noCheck+"</button>";
                }
            }
        });
        if(tempArchivo=="")
        {
                tempData["fecha_registro"]="";
                tempData["usuario"]=value.usuario;
                tempData["accion_correctiva"]="";
                tempData["plan_accion"]="";
                tempData["desviacion"]="";
                tempData["validacion"]="";
                if(value.validador=="1")
                    tempData["id_principal"].push({eliminar:1});
                    // tempData["delete"]=tempData["id_principal"];
                else
                    tempData["id_principal"].push({eliminar:0});
                    // tempData["delete"]=tempData["id_principal"];
        }
        else
            // tempData["opcion"]="";
            tempData["id_principal"].push({eliminar:0});
            // tempData["delete"]=tempData["id_principal"];

    tempData["id_principal"].push({editar:0});//si quieres que edite 1, si no 0
    tempData["delete"]=tempData["id_principal"];
    return tempData;
}

function listarDatosBorrarEsteYaEstaDeplecado()
{
    
        __datos=[];
        contador=1;
        datosParamAjaxValues={};
        datosParamAjaxValues["url"]="../Controller/InformeValidacionDocumentosController.php?Op=listarparametros(v,nv,sd)";
        datosParamAjaxValues["type"]="POST";
        datosParamAjaxValues["paramDataValues"]=parametroscheck;
        datosParamAjaxValues["async"]=false;
        var variablefunciondatos=function obtenerDatosServer (r)
        {
        status="validado";
            $.each(r["info"],function(index,value){
              (value.validacion_tema_responsable=="true")?status="validado":status="En Proceso";
               __datos.push({
               "No":contador++,
               "Clave del Documento":value.clave_documento,
               "Nombre del Documento":value.documento,
               "Responsable del Documento":value.nombrecompleto,
               "Tema":"<button onClick='mostrarTemaResponsable("+value.id_documento+");' type='button' class='btn btn-success btn_agregar' data-toggle='modal' data-target='#mostrar-temaresponsable'><i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button>",
               "Requisitos":"<button onClick='mostrarRequisitos("+value.id_documento+");' type='button' class='btn btn-success btn_agregar' data-toggle='modal' data-target='#mostrar-requisitos'><i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button>",
               "Registros":"<button onClick='mostrarRegistros("+value.id_documento+");' type='button' class='btn btn-success btn_agregar' data-toggle='modal' data-target='#mostrar-registros'><i class='ace-icon fa fa-book' style='font-size: 20px;'></i>Ver</button>",
               "Status":status
               })
            });
            dataListado = r["info"];
        }
   var listfunciones=[variablefunciondatos];
   ajaxHibrido(datosParamAjaxValues,listfunciones); 
   construir(__datos);
//    return __datos;
}

function mostrarTemaResponsable(id_documento)
{
    ValoresTemaResponsable = "<table class='tbl-qa'>\n\
                                <tr>\n\
                                    <th class='table-header'>Tema</th>\n\
                                    <th class='table-header'>Responsable del Tema</th>\n\
                                </tr>\n\
                                <tbody>";
    $.ajax ({
        url:"../Controller/InformeValidacionDocumentosController.php?Op=MostrarTemayResponsable",
        type:'POST',
        data:'ID_DOCUMENTO='+id_documento,
        success:function(responseTemayResponsable)
        {
            $.each(responseTemayResponsable,function(index,value){
              ValoresTemaResponsable+="<tr><td>"+value.no+"</td>" ;
              ValoresTemaResponsable+="<td>"+value.nombre_empleado+" "+value.apellido_paterno+" "+value.apellido_materno+"</td></tr>";  

            });

            ValoresTemaResponsable += "</tbody></table>";
            $('#TemayResponsableListado').html(ValoresTemaResponsable);
        }

    })

}
    
    
function mostrarRequisitos(id_documento)
{
        ValoresRequisitos = "<ul>";

        $.ajax ({
            url: "../Controller/InformeValidacionDocumentosController.php?Op=MostrarRequisitosPorDocumento",
            type: 'POST',
            data: 'ID_DOCUMENTO='+id_documento,
            success:function(datosRequisitos)
            {
               $.each(datosRequisitos,function(index,value){
                
                ValoresRequisitos+="<li>"+value.requisito+"</li>";                                       

               });
           ValoresRequisitos += "</ul>";     
               $('#RequisitosListado').html(ValoresRequisitos);
            }
        });
}


function mostrarRegistros(id_documento)
{
 ValoresRegistros = "<ul>";

 $.ajax ({
     url:"../Controller/InformeValidacionDocumentosController.php?Op=MostrarRegistrosPorDocumento",
     type: 'POST',
     data: 'ID_DOCUMENTO='+id_documento,
     success:function(responseregistros)
     {
         $.each(responseregistros,function(index,value){
            ValoresRegistros+="<li>"+value.registro+"</li>"; 
         });

ValoresRegistros += "</ul>";
         $('#RegistrosListado').html(ValoresRegistros);
     }
 })
}


