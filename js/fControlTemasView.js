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
    
    $("#iniciarTematica").on("click",()=>{
        let fecha = $("#fechaInicioTematica").val();
        // fecha!=""? iniciarTematicaCompletaFecha(fecha) : growlError("Error Fecha","Formato de fecha no valido") ;
        fecha==""? iniciarTematicaCompletaFecha("0000-00-00") : iniciarTematicaCompletaFecha(fecha);
    });

    $("#fechaInicioTematica").on("click",()=>{
        let fecha = new Date().getFullYear();
        $("#fechaInicioTematica").attr("min",fecha-1+"-01-01");
        $("#fechaInicioTematica").attr("max",fecha+100+"-01-01");
    });
}); //CIERRA EL $(FUNCTION())


function inicializarFiltros()
{    
    return new Promise((resolve,reject)=>
    {
        filtros =[
//                {id:"noneUno",type:"none"},
                {id:"no",type:"text"},
                {id:"nombre",type:"text"},
                {id:"descripcion",type:"text"},
                // {id:"fecha_inicio",type:"date"},
                {id:"noneUno",type:"none"},
                {name:"opcion",id:"opcion",type:"opcion"}
             ];
         resolve();
    });
}

iniciarTematicaCompletaFecha = (fecha)=>
{
    swal({
        title: "",
        text: "Confirme Para Iniciar Temática Con Fecha "+fecha,
        type: "warning",
        showCancelButton: true,
        // closeOnConfirm: false,
        showLoaderOnConfirm: true,
        preConfirm:()=>
        {
            return new Promise((resolve)=>
            {
                // setTimeout(function()
                // {
                    resolve();
                // }, 1000);
            });
        }
        },()=>{}
    ).then((result)=>
    {
        iniciarTematicaListo(fecha);
    });
}

iniciarTematicaListo = (fecha)=>
{
    $.ajax({
        url: '../Controller/ControlTemasController.php?Op=IniciarTematica',
        type: 'POST',
        data: 'FECHA='+fecha+"&dataListado="+JSON.stringify(dataListado),
        beforeSend:()=>
        {
            growlWait("Iniciando Temática","...");
        },
        success:(resp)=>
        {
            resp==1
            ?(
                growlSuccess("Iniciar Temática","Temática Iniciada"),
                refresh()
            ):growlSuccess("Iniciar Temática","No se aplicarón cambios");
        },
        error:()=>
        {
            growlError("Error","Erro en el servidor");
        }
    });
}

function reconstruir(value,index)
{
    no = "fa-times-circle-o";
    yes = "fa-check-circle-o";
    ultimoNumeroGrid = index;
    tempData = new Object();
    tempData["id_principal"]=[];
    tempData["id_principal"].push({'id_tema':value.id_tema});
    tempData["id_principal"].push({eliminar:0});
//    tempData["no"]= index;
    tempData["no"] = value.no;
    tempData["nombre"] = value.nombre;
    tempData["descripcion"] = value.descripcion;
    tempData["fecha_inicio"] = [{fecha:value.fecha_inicio,estado:value.estado}];
    tempData["estado"] = "<i class='fa ";
    if(value.estado==1)
    {
        tempData["estado"]+= yes+"' style='color:#02ff00;";
        tempData["id_principal"].push({editar:0});
    }
    else
    {
        tempData["estado"]+= no+"' style='color:red;";
        tempData["id_principal"].push({editar:1});
    }
    tempData["estado"]+= "font-size:xx-large'></i>";
    // tempData["estado"] = value.estado;
    tempData["delete"] = tempData["id_principal"];
    return tempData;
}

function reconstruirExcel(value,index)
{
    tempData = new Object();
    tempData["No"]= value.no;
    tempData["Tema"] = value.nombre,
    tempData["Descripcion"] = value.descripcion,
    tempData["Fecha de Inicio"] = value.fecha_inicio

    return tempData;
}

//function reconstruirExcel(value,index)
//{
//    tempData = new Object();
////    tempData["id_principal"] = [{'id_tema':value.id_tema}],
//    tempData["No"]= index;
//    tempData["Folio de Entrada"] = value.folio_entrada,
//    tempData["Autoridad Remitente"] = value.clave_autoridad,
//    tempData["Asunto"] = value.asunto,
//    tempData["Responsable del Tema"] = value.nombre_completo,
//    tempData["Fecha de Asignacion"] = getSinFechaFormato(value.fecha_asignacion),
//    tempData["Fecha Limite de Atencion"] = getSinFechaFormato(value.fecha_limite_atencion),
//    tempData["Fecha de Alarma"] = getSinFechaFormato(value.fecha_alarma),
//    tempData["Status"] = value.status_doc,
//    tempData["Condicion Logica"] = value.condicion
////    tempData["delete"] = "0";
//    return tempData;
//}

// $("#headerOpciones").append( '<input id="fechaInicioTematica" type="date" class="btn btn-success btn_agregar" style="margin-right:5px;border-radius:3px !important"></input>'+
                        //                             '<button id="iniciarTematica" type="button" class="btn btn-success btn_agregar">Iniciar Tematica</button>'):console.log(),

function listarDatos()
{
    return new Promise((resolve,reject)=>
    {
        // $("#fechaInicioTematica").css("display","");
        // $("#iniciarTematica").css("display","");
        var __datos=[];
        $.ajax({
            url:"../Controller/ControlTemasController.php?Op=Listar",
            type:"GET",
            beforeSend:function()
            {
                growlWait("Solicitud","Solicitando Datos...");
            },
            success:function(data)
            {
                if(typeof(data)=="object")
                {
                    data.length == 0 ? growlSuccess("Solicitud","No existen registros") :(
                        growlSuccess("Solicitud","Registros obtenidos"),
                        data[0]["modo_trabajo"]==1 ?(
                            $("#fechaInicioTematica").css("display",""),
                            $("#iniciarTematica").css("display","")
                        ):console.log(""),
                        dataListado = data,
                        $.each(data,function (index,value)
                        {
                            __datos.push( reconstruir(value,index+1) );
                        }),
                        DataGrid = __datos,
                        gridInstance.loadData(),
                        resolve()
                    );
                }
                else
                {
                    growlSuccess("Solicitud","No Existen Registros");
                    reject();
                }
            },
            error:function(e)
            {
                console.log(e);
                growlError("Error","Error en el servidor");
                reject();
            }
        });
        
    });
}

function refresh()
{
    inicializarFiltros().then((resolve2)=>
    {
        construirFiltros();
        listarDatos();
    },
    (error)=>
    {
        growlError("Error!","Error al construir la vista, recargue la página");
    });
}

function saveUpdateToDatabase(args)
{
    console.log(args);
    columnas=new Object();
    id_afectado = args['item']['id_principal'][0];
    //  = args['previousItem'][''];
    verificar = 0;
    $.each(args['item'],(index,value)=>
    {
        if(args['previousItem'][index]!=value && value!="")
        {
            
            // if(index!='id_principal' && !value.includes("<button") && index!="delete")
            // {
                // console.log(typeof(args['previousItem'][index][0].estado));
                // console.log(typeof(value[0].estado));
                if( args['previousItem'][index][0].fecha != value[0].fecha )
                    columnas[index]=value;
            // }
        }
    });
    // console.log(columnas);
    // console.log(columnas.fecha_inicio[0].fecha);
    if( Object.keys(columnas).length != 0)
    {
        $.ajax({
            url:"../Controller/ControlTemasController.php?Op=Actualizar",
            type:"POST",
            data:'ID_TEMA='+id_afectado.id_tema+"&FECHA="+columnas.fecha_inicio[0].fecha,
                beforeSend:()=>
                {
                    growlWait("Actualización","Espere...");
                },
                success:(data)=>
                {
                    // console.log("resultado actualizacion: ",data);
                    if(data>0)
                    {
                        growlSuccess("Actulización","Se actualizaron los campos");
                        // actualizarDocumentoEntrada(id_afectado.id_documento);
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
}

function componerDataListado(value)// id de la vista documento, listo
{
    id_vista = value.id_tema;
    id_string = "id_tema";
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