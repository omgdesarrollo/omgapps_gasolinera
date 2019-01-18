$(function ()
{
    $("#btn-cont").click(function ()
    {
      cambiarCont();
    });

});

function inicializarFiltros()
{  
    return new Promise((resolve,reject)=>
    {
        filtros =[
                {id:"noneUno",type:"none"},
                {id:"clave_cumplimiento",type:"text"},
                {id:"cumplimiento",type:"text"},
                {name:"opcion",id:"opcion",type:"opcion"}
        ];
        resolve();
    });    
}



function listarDatos()
{
    return new Promise((resolve,reject)=>
    {
        var __datos=[];
        $.ajax(
        {
            url:"../Controller/CumplimientosController.php?Op=obtenerContrato",
            type:"GET",
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
                    $.each(data,function(index,value)
                    {
                        __datos.push(reconstruir(value,index+1));
                    }); 
                    DataGrid = __datos;
                    gridInstance.loadData();
                    resolve();
                }else{
                    growlSuccess("Solicitud","No Existen Registros");
                    reject();
                }               
            },
            error:function()
            {
                growlError("Error","Error en el servidor");
                reject();
            }        
        });
    });
}


//aqui iva el reconstruir

function saveUpdateToDatabase(args)//listo
{
    columnas=new Object();
    id_afectado = args['item']['id_principal'][0];
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
            data:'TABLA=cumplimientos'+'&COLUMNAS_VALOR='+JSON.stringify(columnas)+"&ID_CONTEXTO="+JSON.stringify(id_afectado),
            beforeSend:()=>
            {
                    growlWait("Actualización","Espere...");
            },
            success:(data)=>
            {
                    if(data==1)
                    {
                            growlSuccess("Actulización","Se actualizaron los campos");
                            actualizarCumplimiento(id_afectado.id_cumplimiento);
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

function actualizarCumplimiento(id_cumplimiento)
{
    $.ajax({
            url:'../Controller/CumplimientosController.php?Op=ListarCumplimiento',
            type: 'GET',
            data:'ID_CUMPLIMIENTO='+id_cumplimiento,
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
    id_vista = value.id_cumplimiento;
    id_string = "id_cumplimiento";
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

function cambiarCont()
{ 
    var jsonObj = {    
    }

    $contador=1;
    $.ajax({  
        url: "../Controller/CumplimientosController.php?Op=obtenerContrato",  
        async:false,
        success: function(r) 
        {
            $.each(r,function(index,value)
            {
                jsonObj[value.id_cumplimiento] = value.clave_cumplimiento ;
            });
        }    
    });

    swal({
      title: 'Seleccione una Temática',
      input: 'select',
      inputOptions:jsonObj,
      inputPlaceholder: 'Sin Temática seleccionada ',
      showCancelButton: true,
      showLoaderOnConfirm: true,
      inputValidator: function (value) {
        return new Promise(function (resolve, reject) {
          if (value != '') {
            resolve();
          } else {
            reject('Requiere seleccionar una Temática ');
          }
        });
      },
      preConfirm: function() {
        return new Promise(function(resolve) {
          setTimeout(function() {
            resolve()
          }, 1000)
        })
      }
    }).then(function (result) {

        $.ajax({  
            url: "../Controller/CumplimientosController.php?Op=contratoselec&c="+result+"&obt=false",  
            async:false,
            success: function(r) 
            {
                $('#desc',window.parent.document).html("TEMÁTICA("+r.clave_cumplimiento+")");
                $('#infocontrato',window.parent.document).html("Tematica  Seleccionada:<br>("+r.clave_cumplimiento+")");
            }    
        });
    });    
} 
 
function refresh()
{
   listarDatos();
   gridInstance.loadData();
}