$(function()
{
    var $btnDLtoExcel = $('#toExcel'); 
    $btnDLtoExcel.on('click', function () 
    {   
        __datosExcel=[]
        $.each(dataListado,function (index,value)
            {
                console.log("Entro al datosExcel");
                __datosExcel.push( reconstruirExcel(value,index+1) );
            });
            DataGridExcel= __datosExcel;
//            console.log("Entro al excelexportHibrido");
        $("#listjson").excelexportHibrido({
            containerid: "listjson"
            , datatype: 'json'
            , dataset: DataGridExcel
            , columns: getColumns(DataGridExcel)
        });
    });

    // $("#BTN_ANTERIOR_GRAFICAMODAL").click(function()
    // {
    //     if(activeChart>1)
    //     {
    //         activeChart-=2;
    //         selectChart();
    //     }
    //     else
    //     {
    //         activeChart = -1;
    //         graficar();
    //     }
    // });

}); //SE CIERRA EL $(FUNCTION())




parametroscheck={"validado":"false","no_validado":"false","sin_documento":"false"};

function inicializarFiltros()
{
    return new Promise((resolve,reject)=>
    {
        filtros = [
            { id:"noneUno", type:"none"},
            { id: "nombre",title:"Tema",type:"text"},
            { id: "nombre_empleado",title:"Usuario", type: "text"},
            { id: "registro",title:"Registro", type: "text"},
            { id: "fecha_logica",title:"Fecha Actualización", type: "date"},
            { id: "fecha_fisica",title:"Fecha Corte", type: "date"},
            { id: "ext_anterior",title:"Ext. Anterior", type: "text"},
            { id: "cantidad_comprada",title:"Cant. Comprada", type: "none"},
            { id: "cantidad_vendida",title:"Cant. Vendida", type: "none"},
            { id: "ext_actual",title:"Ext. Actual", type: "none"},
            { id: "adjuntos",title:"Adjuntos", type: "none"},
        
        // { name: "nombre",title:"Tema", type: "text", width: 150, editing:false },
        // { name: "nombre_empleado", title:"Usuario", type: "text", width:250, editing:false },
        // { name: "registro",title:"Registro", type: "text", width: 150, editing:false  },
        // { name: "fecha_logica",title:"Fecha Actualización", type: "text", width: 160, editing:false },
        // { name: "fecha_fisica",title:"Fecha Corte", type: "text", width: 160, editing:false },
        // { name: "ext_anterior", title:"Ext. Anterior", type: "text", width: 100, editing:false },
        // { name: "cantidad_comprada",title:"Cant. Comprada", type: "text", width: 150, editing:false},
        // { name: "cantidad_vendida",title:"Cant. Vendida", type: "text", width: 110, editing:false },
        // { name: "ext_actual",title:"Ext. Actual", type: "text", width: 100, editing:false},
        // { name: "adjuntos",title:"Adjuntos", type: "text", width: 100, editing:false},
        ];
        resolve();
    });
}

    // $(function (){
//      alert("tene");
// $('#checkValidado').click(function() {
//        if (!$(this).is(':checked')) {
//            return confirm("Estas seguro que desea quitarle la seleccion");
//             alert("esta en "+$(this).is(':checked'));
//            parametroscheck["validado"]="false";
//            alert("validados");
//        }else{
//            alert("esta  "+$(this).is(':checked'));
            //  parametroscheck["validado"]=$(this).is(':checked');
//        }
//alert("checkeado  "+parametroscheck["validado"]);
    // cargar("validados");
//alert("d"+parametroscheck["validado"]+"  no validados  "+parametroscheck["no_validado"] );
    // });
    
// $('#checkNoValidado').click(function() {
//        if (!$(this).is(':checked')) {
//            return confirm("Estas seguro que desea quitarle la seleccion");
//        }
//alert("d");
// parametroscheck["no_validado"]=$(this).is(':checked');
//     cargar("novalidados");
//     });
    
// $('#checkSinDocumento').click(function() {
//        if (!$(this).is(':checked')) {
//            return confirm("Estas seguro que desea quitarle la seleccion");
//        }
//alert("d");
// parametroscheck["sin_documento"]=$(this).is(':checked');
//     cargar("sindocumento");
//     });
    
    
    // }); //CIERRA EL $(FUNCTION)
    
    
// function cargar(key){
//     switch (key) {
//         case "validados":

//         //        alert("entraste en validados");
//                 listarDatos();
//         break;
        
//         case "novalidados":
//             listarDatos();
//         //        alert("no validados");
//         break;
        
//         case "sindocumento":
//             listarDatos();
//         //        alert("sin documento");
//         break;
        
//         default:

//         break;
//     }
// }
// months = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

function mostrar_urls(id_evidencia)
{
    var tempData=[];
    URL = 'fileEvidencias/'+id_evidencia;
    // $.ajax({
    //     url: '../Controller/ArchivoUploadController.php?Op=CrearUrl',
    //     type: 'GET',
    //     data: 'URL='+URL,
    //     success:function(creado)
    //     {
    //     if(creado)
    //     {
            $.ajax({
            url: '../Controller/ArchivoUploadController.php?Op=listarUrls',
            type: 'GET',
            data: 'URL='+URL,
            async:false,
            success: function(todo)
            {
                console.log(todo);
                if(todo[0].length!=0)
                {
                    // tempDocumentolistadoUrl = "<table class='tbl-qa'><tr><th class='table-header'>Fecha de subida</th><th class='table-header'>Nombre</th><th class='table-header'></th></tr><tbody>";
                    $.each(todo[0], function (index,value)
                    {
                        nametmp = value.split("^-O-^-M-^-G-^");
                        fecha = new Date(nametmp[0]*1000);
                        fecha = fecha.getDay() +" "+ months[fecha.getMonth()] +" "+ fecha.getFullYear() +" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
                        tempData["name"] = "<a href=\""+todo[1]+"/"+value+"\" download='"+nametmp[1]+"'>"+nametmp[1]+"</a>";
                        tempData["fecha"] = fecha;
                        // tempDocumentolistadoUrl += "<button style=\"font-size:x-large;color:#39c;background:transparent;border:none;\"";
                        // tempDocumentolistadoUrl += "onclick='borrarArchivo(\""+URL+"/"+value+"\");'>";
                        // tempDocumentolistadoUrl += "<i class=\"fa fa-trash\"></i></button>";
                        // tempDocumentolistadoUrl += "</td></tr>";
                    });
                    // tempDocumentolistadoUrl += "</tbody></table>";
                }
                else
                {
                    tempData["name"] = " Sin archivo";
                    tempData["fecha"] = " ----------- ";
                }
                // $('#DocumentolistadoUrl').html(tempDocumentolistadoUrl);
            }
            });
            console.log(tempData);
            return tempData;
        // }
        // else
        // {
        //     swal("Error en el servidor");
        // }
        // }
    // });
}

function listarDatos()
{
    return new Promise((resolve,reject)=>
    {
        URL = 'fileEvidencias/';
        __datos=[];
        $.ajax({
            url: '../Controller/InformeEvidenciasController.php?Op=Listar',
            type: 'GET',
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
                    crearComboGrafica(data);
                    $.each(data,function (index,value)
                    {
                        __datos.push( reconstruir(value,index+1) );
                    });
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
                growlError("Error","Error en el servidor");
                reject();
            }
        });
    });
}

crearComboGrafica = (data)=>
{
    return new Promise((resolve,reject)=>{
        let lista = new Object();
        let select = $("<select>",{id:"comboboxChart"});
        let options;
        let primero = 1;

        $.each(data,(index,value)=>{
            if(lista[value.id_tema]==undefined)
                lista[value.id_tema]=[];
            lista[value.id_tema].push(value);
        });
        $.each(lista,(index,value)=>{
            // options = primero==1?$("<option>",{value:index,selected:true}):$("<option>",{value:index});
            options = $("<option>",{value:index});
            $(options).html(value[0].nombre);
            $(options)[0]["customData"] = value;
            $(select).html(options);
        });
        // options = $("<option>",{value:"1000"});
        // $(options).html("solo");
        // $(options)[0]["customData"] = "";
        // $(select).append(options);
        $(select).change(()=>{
            changeSelect();
        });
        $("#graficaComboBox_estacion").html(select);
        // changeSelect(select);
        resolve();
    });
}

changeSelect = ()=>
{
    obj = $("#comboboxChart");
    // objTemp = $(obj.currentTarget)[0]!=undefined? $(obj.currentTarget).find('option:selected') : $(obj).find('option:selected');
    console.log(obj);
    objTemp = $(obj).find('option:selected')
    // console.log(objTemp);
    let data = $(objTemp)[0]["customData"];
    graficar(data);
}

function mostrarMensajes(msj,num)
{
    $("#areaMensaje").html(msj);
    if(num == 0)
        $("#myModalLabelMandarNotificacion").html("Desviación");
    else
        $("#myModalLabelMandarNotificacion").html("Acción Correctiva");
}

function reconstruir(value,index)
{
    noMsj = "<i class='fa fa-file-o' style='font-size: xx-large;color:#6FB3E0;cursor:pointer' aria-hidden='true'></i>";
    yesMsj = "<i class='ace-icon fa fa-file-text-o icon-animated-bell' style='font-size: xx-large;color:#02ff00;cursor:pointer' aria-hidden='true'></i>";
    ultimoNumeroGrid = index;
    tempData = new Object();
    
    tempData["no"] = ultimoNumeroGrid;
    tempData["id_principal"] = [];
    tempData["id_principal"].push({'id_evidencias':value.id_evidencias});

    tempData["nombre"] = value.nombre;
    tempData["nombre_empleado"] = value.nombre_empleado;
    tempData["registro"] = value.registro;
    tempData["fecha_logica"] = getSinFechaFormato(value.fecha_logica);
    tempData["fecha_fisica"] = getSinFechaFormato(value.fecha_fisica);

    tempData["ext_anterior"] = value.ext_anterior;
    tempData["ext_actual"] = value.ext_actual;
    tempData["cantidad_comprada"] = value.cantidad_comprada;
    tempData["cantidad_vendida"] = value.cantidad_vendida;

    if(value.archivosUpload.length!=0)
    {
        let archivos = $("<button>",{style:"font-size:x-large;color:#39c;background:transparent;border:none;",onclick:"abrirModalArchivos(this)"});
        $(archivos)[0]["customData"] = value.archivosUpload;
        $(archivos).append("<i class='fa fa-cloud' style='font-size: xx-large;color:#3399cc;cursor:pointer' aria-hidden='true'></i>");
        tempData["adjuntos"] = archivos;
    }
    else
    {
        let noArchivos = $("<button>",{style:"font-size:x-large;color:#39c;background:transparent;border:none;",onclick:"swal('Sin Archivos','','info')"});
        $(noArchivos).append("<i class='fa fa-times' style='font-size: xx-large;color:red;cursor:pointer' aria-hidden='true'></i>");
        tempData["adjuntos"] = noArchivos;
    }
    return tempData;
}

abrirModalArchivos = (obj)=>//componer el listado de los archivos
{
    let data = $(obj)[0]["customData"];
    let tempData = "<table class='tbl-qa'><tr><th class='table-header'>Fecha de subida</th><th class='table-header'>Nombre</th></tr><tbody>";
    $.each(data[0],(index,value)=>
    {
        nametmp = value.split("^-O-^-M-^-G-^");
        fecha = new Date(nametmp[0]*1000);
        fecha = fecha.getDate() +" "+ months[fecha.getMonth()] +" "+ fecha.getFullYear() +" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
        // name = "<a href=\""+todo[1]+"/"+value+"\" download='"+nametmp[1]+"'>"+nametmp[1]+"</a>";
        tempData += "<tr class='table-row'><td>"+fecha+"</td><td>";
        tempData += "<a href=\""+data[1]+"/"+value+"\" download='"+nametmp[1]+"'>"+nametmp[1]+"</a></td>";
        // tempData += "<td><button style=\"font-size:x-large;color:#39c;background:transparent;border:none;\"";
        // tempData += "onclick='borrarArchivo(\""+URL+"/"+value+"\");'>";
        // tempData += "<i class=\"fa fa-trash\"></i></button></td></tr>";
        // tempData["fecha"] = fecha;
        tempData += "</td></tr>";
    });
    tempData += "</tbody></table>";
    $("#create-itemUrls").modal();
    $("#DocumentolistadoUrl").html(tempData);
}

abrirNotificaciones = (mensajes,responsableTema,responsableEvidencia)=>
{
    $("#usuarios_notificaciones")[0]["dataCustom"] = {"IZQ":0,"DER":0};
    $.ajax({
        url: '../Controller/EvidenciasController.php?Op=ObtenerParticipantesUsuarios',
        type: 'GET',
        data: 'R_TEMA='+responsableTema+'&R_EVIDENCIA='+responsableEvidencia,
        beforesend:()=>
        {
            growlWait("Espere","Cargando Mensajes...");
        },
        success:function(data)
        {
            if(typeof(data)=="object")
            {
                if(data.length!=0)
                {
                    let bandera = 1;
                    // let var2 = 0;
                    let tempData = '<div class="row" style="border:2px solid #3399cc;padding:5px 15px 5px 15px;background:#c0c0c0b0;">';
                    $.each(data,(index,value)=>{
                        if(bandera==1)
                        {
                            // $("#usuarios_notificaciones")[0]["dataCustom"] = {"R_TEMA":responsableTema,"R_EVIDENCIA":responsableEvidencia};
                            $("#usuarios_notificaciones")[0]["dataCustom"]["DER"] = value.id_usuario;
                            tempData += '<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5" style="padding:5px;border-radius:10px 25px 25px 10px;float:right;background:lightgreen">'+
                                            '<div class="col-xs-9 col-sm-9 col-md-10 col-lg-10" style="padding:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'+
                                            '<span style="color:black;" title="'+value.nombre_completo+'">'+value.nombre_completo+'</span><br>'+
                                            '<span style="font-size:10px;float:left">Responsable '+ ( responsableEvidencia==value.id_usuario&&responsableTema==value.id_usuario? "Evidencia/Tema":
                                            responsableEvidencia==value.id_usuario? "Evidencia" : "Tema")+'</span>'+
                                            '</div>'+
                                            '<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2" style="padding:0px;float:right;">'+
                                                '<img src="'+ (value["archivosUpload"][0].length!=0?
                                                (  value["archivosUpload"][1]+"/"+value["archivosUpload"][0][value["archivosUpload"][0].length-1] ) :
                                                ("../../images/base/user.png"))+'" class="img-circle" style="height:35px;float:right">'+
                                            '</div></div>';
                            bandera = 0;
                        }
                        else
                        {
                            $("#usuarios_notificaciones")[0]["dataCustom"]["IZQ"] = value.id_usuario;
                            tempData += '<div class="col-xs-6 col-sm-5 col-md-5 col-lg-5" style="padding:5px;border-radius:25px 10px 10px 25px;float:left;background:#ffffff">'+
                                            '<div class="col-xs-3 col-sm-3 col-md-2 col-lg-2" style="padding:0px;float:left;">'+
                                                '<img src="'+ (value["archivosUpload"][0].length!=0?
                                                (  value["archivosUpload"][1]+"/"+value["archivosUpload"][0][value["archivosUpload"][0].length-1] ) :
                                                ("../../images/base/user.png"))+'" class="img-circle" style="height:35px;float:left">'+
                                            '</div>'+

                                            '<div class="col-xs-9 col-sm-9 col-md-10 col-lg-10" style="padding:0px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">'+
                                                '<span style="color:black;" title="'+value.nombre_completo+'">'+value.nombre_completo+'</span><br>'+
                                                '<span style="font-size:10px;float:right">Responsable '+ ( responsableEvidencia==value.id_usuario&&responsableTema==value.id_usuario? "Evidencia/Tema":
                                                responsableEvidencia==value.id_usuario? "Evidencia" : "Tema")+'</span>'+
                                            '</div>'+
                                            '</div>'+
                                        '<div class="col-xs-0 col-sm-2 col-md-2 col-lg-2" style="padding:5px;border-radius:25px 10px 10px 25px;float:left;">'+
                                            '<i class="fa fa-arrows-h" style="font-size:xx-large;color:#3399cc"></i>'+
                                        '</div>';
                        }
                    });
                    tempData += '</div>';
                    cargarMensajes(mensajes);
                    $("#usuarios_notificaciones").html(tempData);
                    // console.log($("#usuarios_notificaciones"));
                }
                else
                {
                    growlError("Error","No se pudieron cargar los mensajes reintente");
                }
            }
            else
            {
                growlError("Error","Error al cargar mensajes");
            }
        },
        error:()=>
        {
            growlError("Error","Error en el servidor");
        }
    });
}

cargarMensajes = (data)=>
{
    let idUsuario = $("#usuarios_notificaciones")[0]["dataCustom"]["DER"];
    let tempData = "";
    if(data.length!=0)
    {
        $.each(data,(index,value)=>{
            if(value.id == idUsuario)
            {
                tempData += '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="text-align:right;float:right;margin-bottom:5px">'+
                    '<div style="background:lightgreen;padding:5px 10px 5px 10px;border-radius:15px 3px 3px 15px;float:right">'+
                        '<span style="color:black;font-size:13px">'+value.mensaje+'</span>'+
                        '<br>'+
                        '<span style="font-size:9px">'+value.fecha+'</span>'+
                    '</div>'+
                '</div>';
            }
            else
            {
                tempData += '<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9" style="text-align:left;float:left;margin-bottom:5px">'+
                    '<div style="background:#ffffff;padding:5px 10px 5px 10px;border-radius:3px 15px 15px 3px;float:left">'+
                        '<span style="color:black;font-size:13px">'+value.mensaje+'</span>'+
                        '<br>'+
                        '<span style="font-size:9px">'+value.fecha+'</span>'+
                    '</div>'+
                '</div>';
            }
        });
        $("#mensajes_notificaciones").html(tempData);
    }
    else
    {
        growlSuccess("","Sin mensajes para mostrar");
        $("#mensajes_notificaciones").html("");
    }
    $("#mostrar_notificaciones").modal();
}

function reconstruirExcel(value,index)
{
    tempData = new Object();
    tempData["No"] = index;
    tempData["Tema"] = value.tema;
    tempData["Responsable del Tema"] = value.tema_responsable;
    tempData["Requisito"] = value.requisito;
    tempData["Registro"] = value.registro;
    tempData["Frecuencia"] = value.frecuencia;
    tempData["Clave del Documento"] = value.clave_documento;
//    tempData["Fecha Evidencia"] = getSinFechaFormato(value.fecha_creacion);
     tempData["Fecha Registro"] ="";
    tempData["Estatus"]="";
    if(value.archivosUpload[0].length==0)
    {
        tempData["Fecha Registro"] ="";
        tempData["Evidencia"] ="No";        
    }else{
        $.each(value.archivosUpload[0],function(index2,value2){            
            nametmp = value2.split("^-O-^-M-^-G-^");
            fecha = getFechaStamp(nametmp[0]);
            
            tempData["Fecha Registro"] = fecha;
//            tempData["Evidencia"] = "Si";   
        });        
    }
//    tempData["Desviacion"] = value.desviacion;
//    tempData["Accion Correctiva"] = value.accion_correctiva;
    tempData["Avance del Plan"] = value.avance_plan;
if( value.estatus=="EN PROCESO"){
     tempData["Estatus"] ="NO CONFORME";
}
 if( value.estatus=="VALIDADO"){
     tempData["Estatus"] ="CONFORME";
}  
    
    return tempData;
}


   
//    var listfunciones=[variablefunciondatos];
//    ajaxHibrido(datosParamAjaxValues,listfunciones); 
   
//        $("#jsGrid").jsGrid({
//         width: "100%",
//         height: "300px",
//         heading: true,
//         sorting: true,
//         paging: true,
 
//         data: __datos,
//         fields: [
//                 { name: "No", type: "text", width: 80, validate: "required" },
//                 { name: "Tema", type: "text", width: 150, validate: "required" },
//                 { name: "Requisitos", type: "text", width: 150, validate: "required" },
//                 { name: "Registros", type: "text", width: 150, validate: "required" },
// //                { name: "Clave del Documento",textField: "Clave documento", type: "text", width: 150, validate: "required" },
//                 { name: "Clave del Documento", type: "text", width: 200, validate: "required" },    
//                 { name: "Responsable del Documento", type: "text", width: 250, validate: "required" },
//                 { name: "Frecuencia", type: "text", width: 150, validate: "required" },
//                 { name: "Evidencia", type: "text", width: 150, validate: "required" },
//                 { name: "Fecha de Registro", type: "text", width: 150, validate: "required" },
//                 { name: "Desviacion", type: "text", width: 150, validate: "required" },
//                 { name: "Accion Correctiva", type: "text", width: 150, validate: "required" },
//                 { name: "Avance del Plan", type: "text", width: 150, validate: "required" },
//                 { name: "status", type: "text", width: 150, validate: "required" }
//         ]
//     });
// }


// function construirTable(datos)
// {
//     cargaTodo=0;
//     tempData="";
    
//     $.each(datos,function(index,value){
        
//             tempData += construir(value,cargaTodo);
//     });
    
// //    $.each(datos["info"],function(index,value){
// //        value["clave_cumplimiento"]=datos["detallesContrato"]["clave_cumplimiento"];
// //        value["cumplimiento"]=datos["detallesContrato"]["cumplimiento"];
// //            tempData += construir(value,cargaTodo);
// //    });
     
//     $("#datosGenerales").html(tempData);
//     $("#loader").hide();
// }


// function mostrarTemaResponsable(id_documento)
// {
//     ValoresTemaResponsable = "<table class='tbl-qa'>\n\
//                                 <tr>\n\
//                                     <th class='table-header'>Tema</th>\n\
//                                     <th class='table-header'>Responsable del Tema</th>\n\
//                                 </tr>\n\
//                                 <tbody>";
    
//     $.ajax({
//         url:'../Controller/InformeEvidenciasController.php?Op=MostrarTemayResponsable',
//         type:'POST',
//         data:'ID_DOCUMENTO='+id_documento,
//         success:function(datosTemaResponsable)
//         {
//             $.each(datosTemaResponsable,function(index,value){
//                 ValoresTemaResponsable+="<tr><td>"+value.no+"</td>" ;
//                 ValoresTemaResponsable+="<td>"+value.nombre_empleado+" "+value.apellido_paterno+" "+value.apellido_materno+"</td></tr>";
//             });
//                 ValoresTemaResponsable += "</tbody></table>";
//                 $('#TemayResponsableListado').html(ValoresTemaResponsable);
//         }
//     });
// }

// function mostrarRequisitos(id_documento)
// {
//         ValoresRequisitos = "<ul>";

//         $.ajax ({
//             url: "../Controller/InformeEvidenciasController.php?Op=MostrarRequisitosPorDocumento",
//             type: 'POST',
//             data: 'ID_DOCUMENTO='+id_documento,
//             success:function(datosRequisitos)
//             {
//                $.each(datosRequisitos,function(index,value){
                
//                 ValoresRequisitos+="<li>"+value.requisito+"</li>";                                       

//                });
//            ValoresRequisitos += "</ul>";     
//                $('#RequisitosListado').html(ValoresRequisitos);
//             }
//         });
// }

// function mostrarRegistros(id_documento)
// {
//  ValoresRegistros = "<ul>";

//  $.ajax ({
//      url:"../Controller/InformeEvidenciasController.php?Op=MostrarRegistrosPorDocumento",
//      type: 'POST',
//      data: 'ID_DOCUMENTO='+id_documento,
//      success:function(datosRegistros)
//      {
//          $.each(datosRegistros,function(index,value){
//             ValoresRegistros+="<li>"+value.registro+"</li>"; 
//          });

// ValoresRegistros += "</ul>";
//          $('#RegistrosListado').html(ValoresRegistros);
//      }
//  })
// }
graficarPrincipal = ()=>
{
    // graficar();
    changeSelect();
}

graficaLineal = (dataNextGrafica,concepto)=>
{
    // console.log(dataNextGrafica);
    // console.log(concepto);
    // function drawLineColors() {
    let data = new google.visualization.DataTable();
    let tempData = [];
    $.each(dataListado,(index,value)=>
    {
        let fecha = value.fecha_fisica.split("-");
        console.log(value);
        tempData.push([new Date(fecha[0],fecha[1]-1,fecha[2]), Number(value.cantidad_vendida),Number(value.cantidad_comprada),Number(value.ext_actual)]);
    });

    console.log(tempData);

    data.addColumn('date', 'x');
    data.addColumn('number', 'Vendida');
    data.addColumn('number', 'Comprada');
    data.addColumn('number', 'Existencia');

    data.addRows(tempData);

    var options = {
        width:700,
        height:600,
        pointSize:5,
        legend:{
            position:"top",alignment:"start",
            textStyle:{color:"black",fontSize:14,bold:true}
        },
        hAxis: {
            title: 'Fecha',format: 'd-M-yy',
            textStyle:{color:"black",fontSize:14,bold:true}
        },
        vAxis: {
            title: 'Litros',
            textStyle:{color:"black",fontSize:14,bold:true}
        },
        colors: ['blue', '#097138','red']
    };
    var chart = new google.visualization.LineChart(document.getElementById('graficaPie'));
    // graficaPie
    chart.draw(data, options);

    // }
}

function graficar(data)
{
    chartsCreados = [];
    let validados = 0;
    let validados_data = [];
    let proceso = 0;
    let proceso_data = [];
    let dataGrafica = [];
    let tituloGrafica = "INFORME DE REGISTROS";
    let bandera = 0;
    let lista = new Object();

    $.each(data,(index,value)=>{
        if(lista[value.id_registro]==undefined)
            lista[value.id_registro]=[];
        lista[value.id_registro].push(value);
    });

    $.each(lista,(index,value)=>
    {
        let existencia = 0;
        let fecha = new Date(value[0].fecha_fisica);
        let valTemp = value[0];
        $.each(value,(ind,val)=>
        {
            let fechaTemp = new Date(val.fecha_fisica);
            if(fecha<fechaTemp)
            {
                fecha = fechaTemp;
                valTemp = val;
            }
        });
        existencia = valTemp.ext_actual;
        dataGrafica.push([valTemp.nombre+" "+valTemp.registro,Number(valTemp.ext_actual),">>Existencia Actual: "+valTemp.ext_actual+"(litros)",JSON.stringify(value),1]);
    });

    // console.log(dataGrafica);

    // console.log(lista);
    
    // if(validados!=0)
    //     dataGrafica.push(["Conforme",validados,">> Evidencias:"+validados.toString(),JSON.stringify(validados_data),1]);
    // if(proceso!=0)
    //     dataGrafica.push(["No Conforme",proceso,">> Evidencias:"+proceso.toString(),JSON.stringify(proceso_data),1]);
    
    $.each(dataGrafica,function(index,value){
        if(value[1] != 0)
            bandera=1;
    });

    if(bandera == 0 || dataGrafica.length==0 )
    {
        dataGrafica.push([ "NO HAY DATOS QUE MOSTRAR","[]",0]);
        tituloGrafica = "NO HAY DATOS";
    }
    construirGrafica(dataGrafica,tituloGrafica);
    $("#BTN_ANTERIOR_GRAFICAMODAL").html("Recargar");
}

function graficar2(temas,concepto)
{
    let lista = new Object();
    let id_tema;
    let bandera = 0;
    let dataGrafica = [];

    tituloGrafica = concepto != "No Conforme" ? "EVIDENCIAS CONFORMES" : "EVIDENCIAS NO CONFORMES";
    temas = JSON.parse(temas);
    $.each(temas,(index,value)=>
    {
        if(lista[value.id_tema]==undefined)
            lista[value.id_tema]=[];
        lista[value.id_tema].push(value);
    });
    $.each(lista,(index,value)=>{
        dataGrafica.push(["Tema: "+value[0].no_tema,value.length,">> Tema:\n"+value[0].tema+"\n>> Responsable:\n"+value[0].tema_responsable+"\n>> Evidencias:"+value.length,JSON.stringify(value),2]);
    });
    construirGrafica(dataGrafica,tituloGrafica);
}

function graficar3(datos,concepto)
{
    let dataGrafica = [];
    let lista = new Object();

    datos = JSON.parse(datos);
    tituloGrafica = datos[0].estatus == "VALIDADO" ? "DETALLES EVIDENCIAS CONFORMES" : "DETALLES EVIDENCIAS NO CONFORMES";
    
    $.each(datos,(index,value)=>{
        if(lista[value.id_registro]==undefined)
            lista[value.id_registro]=[];
        lista[value.id_registro].push(value);
    });
    $.each(lista,(index,value)=>{
        dataGrafica.push([value[0].registro,value.length,">> Responsable Registro:\n"+value[0].resp+"\n>> Frecuencia:\n"+value[0].frecuencia+"\n>> Evidencias:"+value.length,"[]",-1]);
    });
    construirGrafica(dataGrafica,tituloGrafica);
}

refresh = ()=>
{
    // construirGrid();
    // inicializaChartjs();
    // inicializarFiltros().then((resolve2)=>
    // {
        construirFiltros();
        listarDatos();
    // });
}
