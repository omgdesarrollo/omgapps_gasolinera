
var valorChecking="false";

$(function()
{
    $("button[title='Limpiar Filtro']").on("click",()=>
    {
        if(opcionSeleccionadaComboBoxEstatus == 1)
        {
            valorChecking="false";
            opcionSeleccionadaComboBoxEstatus = 0;
            listarDatos();
        }
    });


    $("#TAREA").keyup(function()
    {
        var valueTarea=$(this).val();
        verificarExiste(valueTarea,"tarea");
    });
    $("#btn_crearTarea").click(function()
    {
        tareaDatos=new Object();
//        tareaDatos.referencia = $("#REFERENCIA").val();
        tareaDatos.tarea = $("#TAREA").val();
        tareaDatos.id_empleado = $("#ID_EMPLEADOMODAL").val();
//        tareaDatos.fecha_creacion = $("#FECHA_CREACION").val();
        tareaDatos.fecha_alarma = $("#FECHA_ALARMA").val();
        tareaDatos.fecha_cumplimiento = $("#FECHA_CUMPLIMIENTO").val();
        tareaDatos.status_tarea = $("#STATUS_TAREA").val();
        tareaDatos.observaciones = $("#OBSERVACIONES").val();
//        tareaDatos.archivo_adjunto = $('#fileupload').fileupload('option', 'url');

        listo=
            (
//                tareaDatos.referencia!=""?
                tareaDatos.tarea!=""?
                tareaDatos.id_empleado!=""?
//                tareaDatos.fecha_creacion!=""?
                tareaDatos.fecha_alarma!=""?
                tareaDatos.fecha_cumplimiento!=""?
                tareaDatos.status_tarea!=""?
//                tareaDatos.observaciones!=""?
                true: false: false: false: false: false                                                               
            );
//        console.log(tareaDatos);
//        console.log("termino");
            listo ? insertarTareas(tareaDatos):swalError("Completar campos");
        
    });
    
    $("#btn_limpiarModalTarea").click(function()
    {
        $("#CONTRATO").val("");
        $("#TAREA").val("");
        $("#ID_EMPLEADOMODAL").val("");
        $("#FECHA_CREACION").val("");
        $("#FECHA_ALARMA").val("");
        $("#FECHA_CUMPLIMIENTO").val("");
        $("#OBSERVACIONES").val("");        
    });
    
    
    $("#subirArchivos").click(function()
    {
        agregarArchivosUrl();
    });

    var $btnDLtoExcel = $('#toExcel'); 
    $btnDLtoExcel.on('click', function () 
    {
        __datosExcel=[];
        $.each(dataListado,function(index,value)
        {
            // console.log("Entro al datosExcel");
            __datosExcel.push(reconstruirExcel(value,index+1));
        });
        DataGridExcel= __datosExcel;        
        $("#listjson").excelexportHibrido({
            containerid: "listjson"
            , datatype: 'json'
            , dataset: DataGridExcel
            , columns: getColumns(DataGridExcel)
        });
    });
    
    $("select[id='status_grafica_combobox'").on('change',()=>
    {
        a = $("#status_grafica_combobox option:selected" ).text();
        if(a=="TERM")
        {
            opcionSeleccionadaComboBoxEstatus = 1;
            valorChecking = "true";
            listarDatos();
        }
        else
        {
            if(opcionSeleccionadaComboBoxEstatus == 1)
            {
                opcionSeleccionadaComboBoxEstatus = 0;
                valorChecking = "false";
                listarDatos();
            }
        }
    });
    
//    $("#myCanvas").canvas()

}); //CIERRA $(FUNCTION())

drawCanvasAll = ()=>
{
    drawCanvasRed();
    drawCanvasGreen();
    drawCanvasOrange();
    drawCanvasBlue();
    drawCanvasYellow();
}

drawCanvasRed = ()=>
{
    return new Promise((resolve,reject)=>{
        let obj = new Object();
        let x=-10;
        let bandera = true;
        for(i=0;i<10;)
        {
            obj["y"+i] = x;
            obj["x"+i] = bandera == true ? -10 : 350 ;
            bandera = !bandera;
            obj["y"+(i+1)] = x;
            obj["x"+(i+1)] = bandera == true ? -10 : 350 ;
            i+=2;
            x+=34;
        }
        obj["strokeStyle"] = '#ff9f9f';
        obj["strokeWidth"] = 6;
        // console.log(obj);
        $('canvas.semaforoRed').drawLine(obj);
    });
}

drawCanvasOrange = ()=>
{
    // console.log("ejecutando drawCanvasOrange");
    return new Promise((resolve,reject)=>{
        let obj = new Object();
        let x=-10,y=30;
        let bandera = true;
        for(i=0;i<20;)
        {
            if(bandera==true)
            {
                obj["x"+i] = x;
                obj["y"+i] = y ;
                obj["y"+(i+1)] = x;
                obj["x"+(i+1)] = y ;
            }else
            {
                obj["y"+i] = x;
                obj["x"+i] = y ;
                obj["x"+(i+1)] = x;
                obj["y"+(i+1)] = y ;
            }
            i+=2;
            y+=50;
            bandera = !bandera;
        }
        obj["strokeStyle"] = '#fcdca3';
        obj["strokeWidth"] = 10;
        // console.log(obj);
        $('canvas.semaforoOrange').drawLine(obj);
    });
}

drawCanvasGreen = ()=>
{
    return new Promise((resolve,reject)=>{
        let obj = new Object();
        let x=-10;
        let bandera = true;
        for(i=0;i<10;)
        {
            obj["x"+i] = x;
            obj["y"+i] = bandera == true ? -10 : 350 ;
            bandera = !bandera;
            obj["x"+(i+1)] = x;
            obj["y"+(i+1)] = bandera == true ? -10 : 350 ;
            i+=2;
            x+=69;
        }
        obj["strokeStyle"] = '#73ff00';
        obj["strokeWidth"] = 10;
        $('canvas.semaforoGreen').drawLine(obj);
    });
}

drawCanvasBlue = ()=>
{
    $('canvas.semaforoBlue').drawLine({
        strokeStyle: '#93aed3',
        strokeWidth: 20,
        strokeDash: [20],
        strokeDashOffset: 100,
        x1: 100, y1: -10,
        x2: 100, y2: 350,
        x3: 200, y3: 350,
        x4: 200, y4: -10
    });

    $('canvas.semaforoBlue').drawLine({
        strokeStyle: '#93aed3',
        strokeWidth: 6,
        strokeDash: [35],
        strokeDashOffset: 100,
        y1: 50, x1: -10,
        y2: 50, x2: 350,
        y3: 100, x3: 350,
        y4: 100, x4: -10
    });
}

drawCanvasYellow = ()=>
{
    return new Promise((resolve,reject)=>{
        $('canvas.semaforoYellow').drawLine({
            strokeStyle: '#f8f893',
            strokeWidth: 10,
            x1: 60, y1: 150,
            x2: -10, y2: 90,
            x3: -10, y3: 50,
            x4: 120, y4: 160,
            x5: 170, y5: 160,
            x6: -20, y6: 0,
            x7: 30, y7: 0,
            x8: 220, y8: 160,
            x9: 270, y9: 160,
            x10:70, y10:-10,
            x11:120, y11:-10,
            x12:320, y12:160,
            x13:320, y13:120,
            x14:170, y14:-10,
            x15:220, y15:-10,
            x16:320, y16:80
        });
    });
}

function inicializarFiltros()
{  
    return new Promise((resolve,reject)=>
    {
        filtros =[
//                {id:"noneUno",type:"none"},
//                {id:"referencia",type:"text"},
                {id:"tarea",type:"text"},
                {id:"id_empleado",type:"combobox",data:listarEmpleados(),descripcion:"nombre_completo"},
//                {id:"fecha_creacion",type:"date"},
                {id:"fecha_alarma",type:"date"},
                {id:"fecha_cumplimiento",type:"date"},
//                {id:"status_tarea",type: "combobox",descripcion:"descripcion",
//                    data:[{"status_tarea":"1","descripcion":"En Proceso"},{"status_tarea":"2","descripcion":"Suspendido"},{"status_tarea":"3","descripcion":"Terminado"}]
//                },
                {id:"status_grafica",type: "combobox",descripcion:"descripcion",
                    data:[
                            {"status_grafica":"Alarma vencida","descripcion":"ALAR"},
                            {"status_grafica":"En tiempo","descripcion":"EPRO"},
                            {"status_grafica":"Suspendido","descripcion":"SUSP"},
                            {"status_grafica":"Terminado","descripcion":"TERM"},
                            {"status_grafica":"Tiempo vencido","descripcion":"VENC"},
                        ]
                },

                {id:"noneDos",type:"none"},
//                {id:"observaciones",type:"text"},
//                {id:"archivo_adjunto",type:"text"},
//                {id:"registrar_programa",type:"text"},
//                {id:"avance_programa",type:"text"},
                
                {id:"noneTres",type:"none"},
                {id:"noneCuatro",type:"none"},
                {id:"noneCinco",type:"none"},
                {id:"noneSeis",type:"none"},
                {name:"opcion",id:"opcion",type:"opcion"}
        ];
        resolve();
    });    
}

function listarDatos(msj)
{
    return new Promise((resolve,reject)=>
    {
        var __datos=[];
        $.ajax(
        {
            url:"../Controller/TareasController.php?Op=Listar&URL=Tareas/",
            type:"GET",
            data:"VALOR="+valorChecking,
            beforeSend:()=>
            {
                if(msj!=undefined)
                    growlWait("Solicitud","Solicitando Datos...");
            },
            success:(data)=>
            {
                if(typeof(data)=="object")
                {
                    if(msj!=undefined)
                        growlSuccess("Solicitud","Registros obtenidos");
                    dataListado = data;
                    $.each(data,function(index,value)
                    {
                        __datos.push(reconstruir(value,index+1));
                    });
                    
                    DataGrid = __datos;
                    gridInstance.loadData();
                    mostrarTareasEnAlarma();
                    // mostrarTareasVencidas();
                    resolve();
                    
                }else{
                    if(msj!=undefined)
                        growlSuccess("Solicitud","No Existen Registros");
                    reject();
                }
            },
            error:()=>
            {
                growlError("Error","Error en el servidor");
                reject();
            }

        });
    });    
}

function reconstruir(value,index)
{
    tempData=new Object();
    ultimoNumeroGrid = index;
    tempData["id_principal"]= [{'id_tarea':value.id_tarea}];
//    tempData["no"]= index;  
//    tempData["referencia"]=value.referencia;
    tempData["tarea"]=value.tarea;
    tempData["id_empleado"]=value.id_empleado;
//    tempData["fecha_creacion"]= getSinFechaFormato(value.fecha_creacion);
    tempData["fecha_alarma"] = getSinFechaFormato(value.fecha_alarma);
    tempData["fecha_alarma"] = value.fecha_alarma;
    tempData["fecha_cumplimiento"]= getSinFechaFormato(value.fecha_cumplimiento);

    tempData["status_tarea"]= value.status_tarea;
    tempData["status_grafica"]= value.status_grafica;
    tempData["fecha_al"]= value.fecha_alarma;
    tempData["fecha_cump"]= value.fecha_cumplimiento;

        
    tempData["semaforo"]="";
    if(value.status_tarea==1 && value.status_grafica=="En tiempo")
    {
        tempData["semaforo"]+="<canvas title='En Proceso' class='semaforoGreen'>.</canvas>";
        // tempData["status_tarea"] = "EPRO";
        // tempData["semaforo"]+="<span title='En Proceso' class='semaforoGreen'>.</span>";        
    }
    if(value.status_tarea==1 && value.status_grafica=="Alarma vencida")
    {
        tempData["semaforo"]+="<canvas title='En Alarma' class='semaforoOrange'>.</canvas>";
        // tempData["status_tarea"] = "ALAR";
    }
    if(value.status_tarea==1 && value.status_grafica=="Tiempo vencido")
    {
        tempData["semaforo"]+="<canvas title='Tiempo Vencido' class='semaforoRed'>.</canvas>";
        // tempData["status_tarea"] = "VENC";
        // tempData["semaforo"]+="<span title='Tiempo Vencido' class='semaforoRed'>.</span>";
    }

    if(value.status_tarea==2)
    {
        tempData["semaforo"]+="<canvas title='Suspendido' class='semaforoYellow'>.</span>";
        // tempData["status_tarea"] = "SUSP";
    }
    if(value.status_tarea==3)
    {
        tempData["semaforo"]+="<canvas title='Terminado'  class='semaforoBlue'>.</canvas>";
        // tempData["status_tarea"] = "TERM";
    }

    // tempData["semaforo"] = value.status_tarea;

    tempData["observaciones"]=value.observaciones; 
    if(value.archivosUpload[0].length==0)
    {
        tempData["archivo_adjunto"] = "<button onClick='mostrar_urls("+value.id_tarea+")' type='button' class='btn btn-info botones_vista_tabla' data-toggle='modal' data-target='#create-itemUrls'>";
        tempData["archivo_adjunto"] += "<i class='fa fa-cloud-upload' style='font-size: 20px'></i> Adjuntar - "+value.archivosUpload[0].length+"</button>";
    }else{
        tempData["archivo_adjunto"] = "<button onClick='mostrar_urls("+value.id_tarea+")' type='button' class='btn btn-danger botones_vista_tabla2' data-toggle='modal' data-target='#create-itemUrls'>";
        tempData["archivo_adjunto"] += "<i class='fa fa-cloud-upload' style='font-size: 20px'></i> Adjuntar - "+value.archivosUpload[0].length+"</button>";
    }
    if(value.existe_programa!=0)
        tempData["registrar_programa"]="<button id='btn_cargaGantt' class='btn btn-info botones_vista_tabla' onClick='cargarprogram("+JSON.stringify({"id_t":value.id_tarea,"descripcion":value.tarea})+")'>Vizualizar</button>";
    else
        tempData["registrar_programa"]="<button id='btn_cargaGantt' class='btn btn-info botones_vista_tabla' onClick='cargarprogram("+JSON.stringify({"id_t":value.id_tarea,"descripcion":value.tarea})+")'>Registrar</button>";
    tempData["avance_programa"]=(value.avance_programa*100).toFixed(2)+"%";
    
    if(value.archivosUpload[0].length==0 && value.existe_programa==0)
    {
        tempData["id_principal"].push({eliminar : 1});
    }else{
        tempData["id_principal"].push({eliminar : 0});
    }
    tempData["id_principal"].push({editar : 1});
    tempData["delete"]= tempData["id_principal"] ;
    
    return tempData;
}

function reconstruirExcel(value,index)
{
    tempData=new Object();
    tempData["No"]= index;  
    tempData["Referencia"]=value.referencia;
    tempData["Tema"]=value.tarea;
    tempData["Responsable"]=value.nombre_completo;
    tempData["Fecha de Creacion"]= getSinFechaFormato(value.fecha_creacion);
    tempData["Fecha Alarma"]= getSinFechaFormato(value.fecha_alarma);
    tempData["Fecha de Cumplimiento"]= getSinFechaFormato(value.fecha_cumplimiento);
    
    if(value.status_tarea==1 && value.status_grafica=="En tiempo")
        tempData["Status"]="En Proceso";
    if(value.status_tarea==1 && value.status_grafica=="Alarma vencida")
        tempData["Status"]="En Alarma";
    if(value.status_tarea==1 && value.status_grafica=="Tiempo vencido")
        tempData["Status"]="Tiempo Vencido";
    if(value.status_tarea==2)
        tempData["Status"]="Suspendido";
    if(value.status_tarea==3)
        tempData["Status"]="Terminado";
    
    tempData["Observaciones"]=value.observaciones;
    
    if(value.archivosUpload[0].length==0)
        tempData["Archivo Adjunto"]= "No"
    else
        tempData["Archivo Adjunto"]= "Si"
        
    tempData["Avance del Programa"]=(value.avance_programa*100).toFixed(2)+"%";
    
    return tempData;
}

function archivoyComboboxparaModal()
{
  $('#DocumentolistadoUrl').html(" ");
  $('#DocumentolistadoUrlModal').html(" ");
  $('#DocumentoEntradaAgregarModal').html(ModalCargaArchivo);
  
  $.ajax({
      url:"../Controller/TareasController.php?Op=empleadosConUsuario",
      type:"GET",
      success:function(empleados)
      {
          tempData="";
          $.each(empleados,function(index,value)
          {
              tempData+="<option value='"+value.id_empleado+"'>"+value.nombre_completo+"</option>";
          }); 
          
          $("#ID_EMPLEADOMODAL").html(tempData);
      }
  });
  
  $('#fileupload').fileupload({
                url: '../View/'
        });
  
}

function insertarTareas(tareaDatos)
{
    $.ajax({
        url:"../Controller/TareasController.php?Op=Guardar",
        type:"POST",
        data:"tareaDatos="+JSON.stringify(tareaDatos),
        async:false,
        success:function(datos)
        {
            if(typeof(datos) == "object")
            {
                tempData;
                swalSuccess("Tarea Creada");                
                $.each(datos,function(index,value)
                {
                   tempData= reconstruir(value,ultimoNumeroGrid+1);
                });
                
                $("#jsGrid").jsGrid("insertItem",tempData).done(function()
                {
                    
                });
                dataListado.push(datos[0]),
                DataGrid.push(tempData),
                $("#crea_tarea .close ").click();
                mostrarTareasEnAlarma();
                // mostrarTareasVencidas();
                
            } else{
                if(datos==0)
                {
                    swalError("Error, No se pudo crear la Tarea");                    
                } else{
                    swalInfo("Creado, Pero no listado, Actualice");
                }                
            }
            
        },
        error:function()
            {
                swalError("Error en el servidor");
            }
    });
}

function saveUpdateToDatabase(args)//listo
{
    console.log("este es el args: ",args);
    columnas=new Object();
    id_afectado = args['item']['id_principal'][0];
    id_empleadoActual=args["item"]["id_empleado"];
    id_empleadoAnterior=args["previousItem"]["id_empleado"];
    statusTemaActual=args["item"]["status_tarea"];
    statusTemaAnterior=args["previousItem"]["status_tarea"];
    tarea=args["item"]["tarea"];
    verificar = 0;
    $.each(args['item'],(index,value)=>
    {
            if(args['previousItem'][index]!=value && value!="")
            {
                    if(index!='id_principal' && !value.includes("<button") && index!="delete")
                    {
                            columnas[index]=value;
                    }
            }
    });

    if( Object.keys(columnas).length != 0 && verificar==0)
    {

        $.ajax({
            url:"../Controller/GeneralController.php?Op=Actualizar",
            type:"POST",
            data:'TABLA=tareas'+'&COLUMNAS_VALOR='+JSON.stringify(columnas)+"&ID_CONTEXTO="+JSON.stringify(id_afectado),
            beforeSend:()=>
            {
                    growlWait("Actualización","Espere...");
            },
            success:(data)=>
            {
                    if(data==1)
                    {
                        growlSuccess("Actulización","Se actualizaron los campos");
                        actualizarTarea(id_afectado.id_tarea);

                        if(id_empleadoActual==id_empleadoAnterior && statusTemaActual==statusTemaAnterior)
                        {
                            enviarNotificacionWhenUpdate(id_empleadoActual,tarea);
                        } else{
                            if(id_empleadoActual!=id_empleadoAnterior)
                            {
                                enviarNotificacionWhenRemoveTarea(id_empleadoAnterior,tarea);
                                enviarNotificacionWhenRemoveTareaAlNuevoUsuario(id_empleadoActual,tarea);
                            }
                            
                            if(statusTemaActual!=statusTemaAnterior)
                            {
                                enviarNotificacionWhenCambioDeStatus(id_empleadoActual,tarea,statusTemaActual,id_afectado.id_tarea);
                            }
                        }


                    }
                    else
                    {
                            growlError("Actualización","No se pudo actualizar");
                            componerDataGrid();
                            gridInstance.loadData();
                    }
            },
            error:function()
            {
                    componerDataGrid();
                    gridInstance.loadData();
                    growlError("Error","Error del servidor");
            }
        });
    }
    else
    {
            componerDataGrid();
            gridInstance.loadData();
    }
}

function actualizarTarea(id_tarea)
{
        $.ajax({
                url:'../Controller/TareasController.php?Op=ListarTarea&URL=Tareas/',
                type: 'GET',
                data:'ID_TAREA='+id_tarea,
                success:function(datos)
                {
                        if(typeof(datos)=="object")
                        {
                            $.each(datos,function(index,value){
                                    componerDataListado(value);
                            });
                            componerDataGrid();
                            gridInstance.loadData();
                        }
                        else
                        {
                                growlError("Actualizar Vista","No se pudo actualizar la vista, refresque");
                                componerDataGrid();
                                gridInstance.loadData();
                        }
                },
                error:function()
                {
                        componerDataGrid();
                        gridInstance.loadData();
                        growlError("Error","Error del servidor");
                }
        });
}

function componerDataListado(value)// id de la vista documento, listo
{
    id_vista = value.id_tarea;
    id_string = "id_tarea";
    $.each(dataListado,function(indexList,valueList)
    {
        $.each(valueList,function(ind,val)
        {
            if(ind == id_string)
                ( val==id_vista) ? dataListado[indexList]=value : console.log();
        });
    });
}

function componerDataGrid()//listo
{
    __datos = [];
    $.each(dataListado,function(index,value){
        __datos.push(reconstruir(value,index+1));
    });
    DataGrid = __datos;
}

function listarEmpleados()
{
    $.ajax({
        url:"../Controller/TareasController.php?Op=empleadosConUsuario",
        type:"GET",
        async:false,
        success:function(empleadosComb)
        {
            EmpleadosCombobox=empleadosComb;
        }
    });
    return EmpleadosCombobox;
}

function listarThisEmpleados()
{
    return new Promise((resolve,reject)=>
    {
        $.ajax(
            {
                url:"../Controller/TareasController.php?Op=responsableTarea",
                type:"GET",
                success:function(empleados)
                {
                    thisEmpleados = empleados;
                    resolve();
                    
                },
                error:function(er)
                {
                    reject(er);
                }

            });
    });
}

function verificarExiste(dataString,cualverificar)
{
$.ajax({
    url: "../Controller/TareasController.php?Op=verificarTarea&cualverificar="+cualverificar,
    type: "POST",
    data: "cadena="+dataString,
    success: function(data) 
    {    
        mensajeerror="";

        $.each(data, function (index,value) {
            mensajeerror=" La Tarea "+value.tarea+" Ya Existe";
        });
        $("#msgerrorTarea").html(mensajeerror);
        if(mensajeerror!=""){
            $("#msgerrorTarea").css("background","orange");
            $("#msgerrorTarea").css("width","190px");
            $("#msgerrorTarea").css("color","white");
            $("#btn_crearTarea").prop("disabled",true);
        }else{
            $("#btn_crearTarea").prop("disabled",false);
        }
    }
    })
}

function mostrar_urls(id_tarea)
{
        var tempDocumentolistadoUrl = "";
        URL = 'Tareas/'+id_tarea;
        $.ajax({
                url: '../Controller/ArchivoUploadController.php?Op=listarUrls',
                type: 'GET',
                data: 'URL='+URL+'&SIN_CONTRATO=',
                async:false,
                success: function(todo)
                {
                        if(todo[0].length!=0)
                        {
                                tempDocumentolistadoUrl = "<table class='tbl-qa'><tr><th class='table-header'>Fecha de subida</th><th class='table-header'>Nombre</th><th class='table-header'></th></tr><tbody>";
                                $.each(todo[0], function (index,value)
                                {
                                        nametmp = value.split("^-O-^-M-^-G-^");
                                        fecha = new Date(nametmp[0]*1000);
                                        fecha = fecha.getDate() +" "+ months[fecha.getMonth()] +" "+ fecha.getFullYear() +" "+fecha.getHours()+":"+fecha.getMinutes()+":"+fecha.getSeconds();
                                        
                                        tempDocumentolistadoUrl += "<tr class='table-row'><td>"+fecha+"</td><td>";
                                        tempDocumentolistadoUrl += "<a href=\""+todo[1]+"/"+value+"\" download='"+nametmp[1]+"'>"+nametmp[1]+"</a></td>";
                                        tempDocumentolistadoUrl += "<td><button style=\"font-size:x-large;color:#39c;background:transparent;border:none;\"";
                                        tempDocumentolistadoUrl += "onclick='borrarArchivo(\""+URL+"/"+value+"\");'>";
                                        tempDocumentolistadoUrl += "<i class=\"fa fa-trash\"></i></button></td></tr>";
                                });
                                tempDocumentolistadoUrl += "</tbody></table>";
                        }
                        if(tempDocumentolistadoUrl == " ")
                        {
                                tempDocumentolistadoUrl = " No hay archivos agregados ";
                        }
                        tempDocumentolistadoUrl = tempDocumentolistadoUrl + "<br><input id='tempInputIdDocumento' type='text' style='display:none;' value='"+id_tarea+"'>";
                        // alert(tempDocumentolistadoUrl);
                        $('#DocumentoEntradaAgregarModal').html(" ");
                        $('#DocumentolistadoUrlModal').html(ModalCargaArchivo);
                        $('#DocumentolistadoUrl').html(tempDocumentolistadoUrl);
                        // $('#fileupload').fileupload();
                        $('#fileupload').fileupload({
                        url: '../View/',
                        });
                }
        });
}

var ModalCargaArchivo = "<form id='fileupload' method='POST' enctype='multipart/form-data'>";
                ModalCargaArchivo += "<div class='fileupload-buttonbar'>";
                ModalCargaArchivo += "<div class='fileupload-buttons'>";
                ModalCargaArchivo += "<span class='fileinput-button'>";
                ModalCargaArchivo += "<span><a >Agregar Archivos(Click o Arrastrar)...</a></span>";
                ModalCargaArchivo += "<input type='file' name='files[]' multiple></span>";
                ModalCargaArchivo += "<span class='fileupload-process'></span></div>";
                ModalCargaArchivo += "<div class='fileupload-progress' >";
                ModalCargaArchivo += "</div></div>";
                ModalCargaArchivo += "<table role='presentation'><tbody class='files'></tbody></table></form>";
                

months = ["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"];

function agregarArchivosUrl()
{
        var ID_TAREA = $('#tempInputIdDocumento').val();
        url = 'Tareas/'+ID_TAREA,
        $.ajax({
                url: "../Controller/ArchivoUploadController.php?Op=CrearUrl",
                type: 'GET',
                data: 'URL='+url+'&SIN_CONTRATO=',
                success:function(creado)
                {
                    if(creado==true)
                        $('.start').click();
                },
                error:function()
                {
                        swalError("Error del servidor");
                }
        });
}

function borrarArchivo2(url)
{

        swal({
//                title: "ELIMINAR",
//                text: "Confirme para eliminar el Archivo",
//                type: "warning",
//                showCancelButton: true,
//                closeOnConfirm: false,
//                showLoaderOnConfirm: true
            title: "Eliminar",
            text: "¿Eliminar Pendiente?",
            type: "Warning",
            showCancelButton: true,
            // closeOnConfirm: false,
            showLoaderOnConfirm: true,
            confirmButtonText: "Eliminar",
            cancelButtonText: "Cancelar",
                }, 
                function()
                {
                        var ID_TAREA = $('#tempInputIdDocumento').val();
                        $.ajax({
                                url: "../Controller/ArchivoUploadController.php?Op=EliminarArchivo",
                                type: 'GET',
                                data: 'URL='+url+'&SIN_CONTRATO=',
                                success: function(eliminado)
                                {
                                        // eliminar = eliminado;
                                        if(eliminado)
                                        {
                                                mostrar_urls(ID_TAREA);
                                                refresh();
                                                swal("","Archivo eliminado");
                                                setTimeout(function(){swal.close();},1000);
                                        }
                                        else
                                                swal("","Ocurrio un error al eliminar el archivo", "error");
                                },
                                error:function()
                                {
                                        swal("","Ocurrio un error al elimiar el archivo", "error");
                                }
                        });
                });
}

function borrarArchivo(url)
{
        swal({
                title: "",
                text: "¿Desea eliminar el Archivo?",
                type: "warning",
                showCancelButton: true,
                // closeOnConfirm: false,
                showLoaderOnConfirm: true,
//                confirmButtonText:'SI'
                confirmButtonText: "Eliminar",
                cancelButtonText: "Cancelar"
                }).then((res)=>
                {
                        if(res)
                        {
                                var ID_TAREA = $('#tempInputIdDocumento').val();
                                $.ajax({
                                        url: "../Controller/ArchivoUploadController.php?Op=EliminarArchivo",
                                        type: 'POST',
                                        data: 'URL='+url+'&SIN_CONTRATO=',
                                        beforeSend:()=>
                                        {
                                                growlWait("Eliminar Archivo","Eliminando Archivo...");
                                        },
                                        success: function(eliminado)
                                        {
                                                // eliminar = eliminado;
                                                if(eliminado)
                                                {
                                                        growlSuccess("Eliminar Archivo","Archivo Eliminado");
                                                        mostrar_urls(ID_TAREA);
                                                        actualizarTarea(ID_TAREA);
                                                        // swal("","Archivo eliminado");
                                                        setTimeout(function(){swal.close();},1000);
                                                }
                                                else
                                                        growlError("Error Eliminar","Ocurrio un error al eliminar el archivo");
                                        },
                                        error:function()
                                        {
                                                growlError("Error","Error en el servidor");
                                        }
                                });
                        }
                });
}

function preguntarEliminar(data)
{
//     console.log("jajaja",data);
    swal({
        title: "",
        text: "¿Desea Eliminar el Pendiente?",
        type: "warning",
        showCancelButton: true,
        // closeOnConfirm: false,
        showLoaderOnConfirm: true,
        confirmButtonText: "Eliminar",
        cancelButtonText: "Cancelar"
        }).then((confirmacion)=>{
                if(confirmacion)
                {
                        eliminarTarea(data);
                }
        });
}

 function eliminarTarea(id_afectado)
 {
        $.each(dataListado,function(index,value)
        {
            if(value.id_tarea==id_afectado.id_tarea)
            {
                id_empleadoActual=value.id_empleado;
                tarea=value.tarea;
            }
        });
//        console.log(id_empleadoActual);
//        console.log(tarea);
        $.ajax({
                url:"../Controller/TareasController.php?Op=Eliminar",
                type:"POST",
                data:"ID_TAREA="+id_afectado.id_tarea,
                beforeSend:()=>
                {
                        growlWait("Eliminación Tarea","Eliminando...");
                },
                success:(res)=>
                {
                        // console.log(data);
                        if(res >= 0)
                        {
                                dataListadoTemp=[];
                                dataItem = [];
                                numeroEliminar=0;
                                itemEliminar={};
                                id = id_afectado.id_tarea;
                                $.each(dataListado,function(index,value)
                                {
                                        value.id_tarea != id ? dataListadoTemp.push(value) : (dataItem.push(value), numeroEliminar=index+1);
                                });
                                // console.log(dataListadoTemp);
                                // itemEliminar = reconstruir(dataItem[0],numeroEliminar);este esra para el eliminar directo en grid
                                DataGrid = [];
                                dataListado = dataListadoTemp;
                                if(dataListado.length == 0 )
                                        ultimoNumeroGrid=0;
                                $.each(dataListado,function(index,value)
                                {
                                        DataGrid.push( reconstruir(value,index+1) );
                                });

                                gridInstance.loadData();
                                growlSuccess("Eliminación","Registro Eliminado");
                                enviarNotificacionWhenDeleteTarea(id_empleadoActual,tarea);
                        }
                        else
                                growlError("Error Eliminación","Error al Eliminar Registro");
                },
                error:()=>
                {
                        growlError("Error Eliminación","Error del Servidor");
                }
        });
 }


function refresh()
{
    inicializarFiltros().then((resolve)=>
    {
        valorChecking="false";
        construirFiltros();
        listarThisEmpleados();
        listarDatos("");
        $('#status_grafica_combobox').on('change',()=>
        {
            a = $("#status_grafica_combobox option:selected" ).text();
            if(a=="TERM")
            {
                opcionSeleccionadaComboBoxEstatus = 1;
                valorChecking = "true";
                listarDatos();
            }
            else
            {
                if(opcionSeleccionadaComboBoxEstatus == 1)
                {
                    opcionSeleccionadaComboBoxEstatus = 0;
                    valorChecking = "false";
                    listarDatos();
                }
            }
        });

    },
    (error)=>
    {
        growlError("Error!","Error al construir la vista, recargue la página");
    });
}


function enviarNotificacionWhenUpdate(id_empleado,tarea)

{
        $.ajax({
            url:"../Controller/TareasController.php?Op=enviarNotificacionWhenUpdate",
            data: "ID_EMPLEADO="+id_empleado+"&TAREA="+tarea,
            success:function(response)
            {
//            (response==true)?(
//                growlSuccess("Notificación","Se notifico del cambio")
//                // swalSuccess("Se notifico del cambio "),
//                //  refresh()
//                )
//            :growlError("Error Notificación","No se pudo notificar el cambio");
            
            },
            error:function()
            {
//            growlError("Error Notificación","Error en el servidor");
            // swalError("Error en el servidor");
            }
        });
}

function enviarNotificacionWhenCambioDeStatus(id_empleado,tarea,status_tarea,id_tarea)

{
        $.ajax({
            url:"../Controller/TareasController.php?Op=enviarNotificacionWhenCambioDeStatus",
            data: "ID_EMPLEADO="+id_empleado+"&TAREA="+tarea+"&STATUS_TAREA="+status_tarea+"&ID_TAREA="+id_tarea,
            success:function(response)
            {
            
            },
            error:function()
            {
                
            }
        });
}


function enviarNotificacionWhenRemoveTarea(id_empleadoAnterior,tarea)

{
        $.ajax({
            url:"../Controller/TareasController.php?Op=enviarNotificacionWhenRemoveTarea",
            data: "ID_EMPLEADO="+id_empleadoAnterior+"&TAREA="+tarea,
            success:function(response)
            {
            
            },
            error:function()
            {

            }
        });
}


function enviarNotificacionWhenRemoveTareaAlNuevoUsuario(id_empleadoActual,tarea)

{
        $.ajax({
            url:"../Controller/TareasController.php?Op=enviarNotificacionWhenRemoveTareaAlNuevoUsuario",
            data: "ID_EMPLEADO="+id_empleadoActual+"&TAREA="+tarea,
            success:function(response)
            {
            
            },
            error:function()
            {
                
            }
        });
}


function enviarNotificacionWhenDeleteTarea(id_empleadoActual,tarea)
{
    $.ajax({
            url:"../Controller/TareasController.php?Op=enviarNotificacionWhenDeleteTarea",
            data: "ID_EMPLEADO="+id_empleadoActual+"&TAREA="+tarea,
            success:function(response)
            {
            
            },
            error:function()
            {
                
            }
        });   
}

 function mostrarTareasEnAlarma()
 {
     $.ajax({
         url:"../Controller/TareasController.php?Op=tareas_EnAlarma_Venciadas",
         type:"GET",
         success:function()
         {
             
         }
     });
 }
 
 
//   function mostrarTareasVencidas()
//  {
//      $.ajax({
//          url:"../Controller/TareasController.php?Op=tareasVencidas",
//          type:"GET",
//          success:function()
//          {
             
//          }
//      });
//  }


//area de gantt
function cargarprogram(value){    
//    console.log(value[""]);
    window.open("Gantt_TareasView.php?id_tarea="+value["id_t"]+"&descripcion="+value["descripcion"],'_blank');
}//finaliza area de gantt

function graficar()
{
//    activeChart = 0;
    chartsCreados = [];
    let enTiempo = 0;
    let enTiempo_data = [];
    let alarmaVencida = 0;
    let alarmaVencida_data = [];
    let tareaVencida = 0;
    let tareaVencida_data = [];
    let suspendido = 0;
    let suspendido_data = [];
    let dataGrafica = [];
    let tituloGrafica = "TEMAS ESPECIALES";
    let bandera = 0;

    $.each(dataListado,(index,value)=>
    {
        if(value.status_grafica == "En tiempo")
        {
            enTiempo++;
            enTiempo_data.push(value);
        }
        
        if(value.status_grafica == "Alarma vencida")
        {
            alarmaVencida++;
            alarmaVencida_data.push(value); 
        }
        
        if(value.status_grafica == "Tiempo vencido")
        {
            tareaVencida++;
            tareaVencida_data.push(value); 
        }
        
        if(value.status_grafica == "Suspendido")
        {
            suspendido++;
            suspendido_data.push(value); 
        }

    });
    
    
    if(enTiempo!=0)
        dataGrafica.push(["En Proceso-En Tiempo",enTiempo,">> Temas:"+enTiempo.toString(),JSON.stringify(enTiempo_data),1]);
    if(alarmaVencida!=0)
        dataGrafica.push(["En Proceso-Alarma Vencida",alarmaVencida,">> Temas:"+alarmaVencida.toString(),JSON.stringify(alarmaVencida_data),1]);
    if(tareaVencida!=0)
        dataGrafica.push(["En Proceso-Tiempo Vencido",tareaVencida,">> Temas:"+tareaVencida.toString(),JSON.stringify(tareaVencida_data),1]);
    if(suspendido!=0)
        dataGrafica.push(["Suspendido",suspendido,">> Temas:"+suspendido.toString(),JSON.stringify(suspendido_data),1]);

    $.each(dataGrafica,function(index,value)
    {
        if(value[1] != 0)
            bandera=1;
    });

    if(bandera == 0)
    {
        dataGrafica.push([ "NO EXISTEN PENDIENTES",1,"SIN PENDIENTES","[]"]);
        tituloGrafica = "NO EXISTEN PENDIENTES";
    }
    
    construirGrafica(dataGrafica,tituloGrafica);
    $("#BTN_ANTERIOR_GRAFICAMODAL").html("Recargar");
}

function graficar2(tareas,concepto)
{
//    console.log("concepto: ",concepto);
//    activeChart = 1;
    let lista = new Object();
    let id_empleado;
    let bandera = 0;
    let dataGrafica = [];
//    tituloGrafica = concepto != "En Proceso" ? "EVIDENCIAS VALIDADAS" : "EVIDENCIAS EN PROCESO";
if(concepto== "En Proceso-En Tiempo")
    tituloGrafica = "TEMAS EN PROCESO-EN TIEMPO";
if(concepto== "En Proceso-Alarma Vencida")
    tituloGrafica = "TEMAS EN PROCESO-ALARMA VENCIDA";
if(concepto== "En Proceso-Tiempo Vencido")
    tituloGrafica = "TEMAS EN PROCESO-VENCIDO";
if(concepto== "Suspendido")
    tituloGrafica = "TEMAS SUSPENDIDOS";

    tareas = JSON.parse(tareas);
//    console.log("Estas son las tareas.parse: ",tareas);
    $.each(tareas,(index,value)=>
    {
        if(lista[value.id_empleado]==undefined)
            lista[value.id_empleado]=[];
        lista[value.id_empleado].push(value);        
    });
    
    $.each(lista,(index,value)=>
    {
//        console.log("value: ",value);
        dataGrafica.push(["Responsable: "+value[0].nombre_completo,value.length,">> Temas:"+value.length,JSON.stringify(value),2]);  
    });
    construirGrafica(dataGrafica,tituloGrafica);
}

function graficar3(datos,concepto)
{
//    activeChart = 2;
    let dataGrafica = [];
    let lista = new Object();

    datos = JSON.parse(datos);
    tituloGrafica = "TEMAS";
    
    $.each(datos,(index,value)=>
    {
//        console.log("Estos son los datos: ",datos);
        if(lista[value.id_tarea]==undefined)
            lista[value.id_tarea]=[];
        lista[value.id_tarea].push(value);
    });
    // console.log(lista);
    $.each(lista,(index,value)=>
    {
//        console.log("este es el value: ",value);
        dataGrafica.push(["Tema: "+value[0].tarea,value.length,">> Tema:\n"+value[0].tarea+"\n>> Responsable:\n"+value[0].nombre_completo,"[]",3]);
    });
    construirGrafica(dataGrafica,tituloGrafica);
}