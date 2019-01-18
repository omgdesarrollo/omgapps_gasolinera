
<link href="../../assets/bootstrap/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<script src="../../js/fechas_formato.js" type="text/javascript"></script>

<style>
.icon-animated-vertical
{
    animation-iteration-count: infinite;
}
</style>

<?php

date_default_timezone_set("America/Mexico_city");
$Alarmas = Session::getSesion("Alarmas");
$alarma;
$NotificacionesAlarma = array();
$numeroAlarmas = 0;
foreach($Alarmas as $alarma)
{
	// print_r($alarma);
	$alarm = new Datetime($alarma['fecha_alarma']);
	$flimite = new Datetime($alarma['fecha_limite_atencion']);
	$hoy = new Datetime();
	$al = strftime("%d - %B - %y");
	$hoy = new Datetime($al);
	if($flimite<=$hoy)
	{
		$NotificacionesAlarma[$numeroAlarmas]["AFECTADO"] = "FOLIO ".$alarma['folio_entrada']." DEL ".$alarma['clave_cumplimiento'];
			if($flimite == $hoy)
			{
				$NotificacionesAlarma[$numeroAlarmas]["MENSAJE"] = "TIEMPO VENCIDO";//mensaje automatico
			}
			else
			{
				$dias = strtotime(strftime("%d-%B-%y",$hoy -> getTimestamp())) - strtotime(strftime("%d-%B-%y",$flimite -> getTimestamp()));
				$dias = $dias / 86400;
				$NotificacionesAlarma[$numeroAlarmas]["MENSAJE"] = "TIEMPO VENCIDO ".$dias." DIA(S)";//mensaje automatico	
			}
		$numeroAlarmas++;
	}
	else
	{
		if($alarma['fecha_alarma'] != "0000-00-00")
		{
			$NotificacionesAlarma[$numeroAlarmas]["AFECTADO"] = "FOLIO ".$alarma['folio_entrada']." DEL ".$alarma['clave_cumplimiento'];
			if($alarm == $hoy)
			{
				$NotificacionesAlarma[$numeroAlarmas]["MENSAJE"] = "ALARMA - ".$alarma['mensaje_alerta'];//agregar campoDB para que el usuario ingrese su mensaje
			}
			else
			{
				$dias = strtotime(strftime("%d-%B-%y",$hoy -> getTimestamp())) - strtotime(strftime("%d-%B-%y",$alarm -> getTimestamp()));
				$dias = $dias / 86400;
				$NotificacionesAlarma[$numeroAlarmas]["MENSAJE"] = " ALARMA VENCIDA ".$dias." DIA(S)"." - ".$alarma['mensaje_alerta'];
			}
		$numeroAlarmas++;
		}
	}
}


// $notifacionescompletas= Session::getSesion("notificacionescompletas");
// $contadorNotificaciones=0;
// foreach ($notifacionescompletas as $value){
//     $contadorNotificaciones++;
// }



?>
<div class="main-encabezado">

<div id="navbar" class="navbar navbar-default ace-save-state">
            
            <div class="navbar-container ace-save-state" id="navbar-container">
                <div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							OMG APPS
						</small>
					</a>
				</div>
                <div class="navbar-buttons navbar-header pull-right" role="navigation" style=" z-index: 2;">
                    <ul class="nav ace-nav" style="height: 10%">
                    <!--seccion de inicio de sesion de alarmas--> 
        <li class="purple dropdown-modal">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#"   >
				    <i class="ace-icon fa fa-bell icon-animated-bell"></i>
					<span class="badge badge-important"><?php echo $numeroAlarmas;?></span>
				</a>

				<!-- <ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close"> -->
				<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close" style="overflow:hidden;width:320px;height:350px;left:414px;right:auto;top:20px;overflow-y:scroll">
					<li class="dropdown-header">
					     <i class="ace-icon fa fa-exclamation-triangle"></i>
						<?php echo $numeroAlarmas." NOTIFICACIONES"; ?>
					</li>

						<li class="dropdown-content" >
							<ul class="dropdown-menu dropdown-navbar navbar-pink">
							<?php foreach($NotificacionesAlarma as $item)
							{ ?>
								<li>
									<a href="#">
									    <div class="clearfix">
										<span class="pull-left">
										    <i class="btn btn-xs no-hover btn-pink fa fa-user"></i>
											<?php echo $item['AFECTADO']." - ".$item['MENSAJE']; ?>
										</span>
										<!-- <span class="pull-right badge badge-info">+1</span> -->
									    </div>
									</a>
								</li>
							<?php } ?>
							</ul>
						</li>

						<!-- <li class="dropdown-footer"> -->
									<!-- <a href="#"> -->
										<!--VER MAS NOTIFICACIONES-->
										<!-- <i class="ace-icon fa fa-arrow-right"></i> -->
									<!-- </a> -->
						<!-- </li> -->
				</ul>
			</li>
                        <!--seccion de cierre  alarmas-->
                        
                        <!--inicio de seccion de mensajes-->
                        
                        <li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i id="CANTIDAD_NOTIFICACIONES2_ICON" class='ace-icon fa fa-envelope icon-animated-vertical'></i>
								<span id="CANTIDAD_NOTIFICACIONES2" class='badge badge-success'></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header" id="CANTIDAD_NOTIFICACIONES">
									
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar" id="LISTA_NOTIFICACIONES">
									</ul>
								</li>

<!--								<li class="dropdown-footer">
									<a href="inbox.html">
										ver todos los mensajes
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>-->
							</ul>
						</li>
                        
                        <!--cierre de seccion de mensajes-->
                        
                        
                        
                        <!--seccion de info usuario-->
                <!-- <li class="light-blue dropdown-modal">
				<a data-toggle="dropdown" href="#" class="dropdown-toggle">
					<img class="nav-user-photo" src="../../assets/probando/images/avatars/user.jpg" alt="<?php echo $Usuario["NOMBRE_USUARIO"]; ?>" />
					<span class="user-info">
						<small>Bienvenido,</small>
                                                    <div id=""><?php echo $Usuario["NOMBRE_USUARIO"]; ?></div>
                                                   <?php 
                                                   ($Usuario['NOMBRE_USUARIO']!="")? ($obuser=$Usuario["NOMBRE_USUARIO"]) :$obuser="";
                                                   
                                                       ?>
                                                    
                                                    <input id="user" type="hidden" value="<?php  echo $obuser ?> "> 
                                                    <input id="ts" type="hidden" value="<?php  echo $Usuario['tokenseguridad'] ?> "> 
                                                   
					</span> -->

<!--								<i class="ace-icon fa fa-caret-down"></i>-->
				<!-- </a> -->

					
			    <!-- </li> -->
                        <!--fin de seccion de info usuario-->
                        
                        
                        
                        
                        
                    </ul>
                    
                    
                </div>
                
            </div>
</div>

</div>
<script>
	var colorView = <?php
    $color = "";
    if(Session:: NoExisteSeSion("colorFondo_Vista"))
        $color = Session::getSesion("user")["FONDO_COLOR"];
    else
        $color = Session::getSesion("colorFondo_Vista");
    echo "'$color'";
	?>;
	var colorLeter = hexToRgb(colorView);
    colorLeter = invertirRgb(colorLeter)==1?"#ffffff":"#000000";
	function hexToRgb(hex)
	{
		var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
		return result ? {
			r: parseInt(result[1], 16),
			g: parseInt(result[2], 16),
			b: parseInt(result[3], 16)
		} : null;
	}
	function invertirRgb(data)
    {
        // obj = new Object();
        let obj = 0;
        if(data.g<=200)
        {
            if(data.b<=150 && data.r>=100)
                obj = 1;
            else
                if(data.g<=40)
                    obj = 1;
                else
                    if(data.r<=200)
                        obj = 1;
                    else
                        obj = 0;
        }
        return obj;
    }
	$("style").append("::-webkit-scrollbar-thumb{ background-color:"+colorView+" !important;} .dhxlayout_base_material div.dhx_cell_layout div.dhx_cell_hdr{background-color:"+colorView+" !important;opacity:0.8 !important; }");
	$("#navbar").css("background-color",colorView);
	$(".navbar-brand").css("color",colorLeter);
	
	listarNotificaciones();
	setInterval(function(){listarNotificaciones();},25000);
        
	function listarNotificaciones()
	{
		$.ajax({
			url: '../Controller/NotificacionesController.php?Op=mostrarNotificaciones->Responsable',
			type: 'GET',
			success:function(notificaciones)
			{
				construirNotificaciones(notificaciones);
			}
		});
	}

	function construirNotificaciones(notificaciones)
	{
		cantidad=0;
		tempData2="";
		$.each(notificaciones,function(index,value)
		{
			// direcciones = value.dir;
			let ultimo
			tempData2 += "<div class='row' style='margin:0px;'>";
			tempData2 += "<a class='col-xs-10 col-sd-10 col-md-10 col-lg-10' style='cursor:pointer;text-decoration:none;float:left;padding:5px;width:90%;border-bottom:1px #6FB3E0 solid;'>";
			// tempData2 += "<a style='cursor:pointer;text-decoration:none;float:left;padding:5px;width:90%;border-bottom:1px #6FB3E0 solid' onClick='irAVista(\""+value.asunto+"\",\""+value.id_contrato+"\")'>";
			tempData2 += "<li style='padding-top:5px;'>";

			// tempData2 += "<div class='col-xs-3 col-sd-3 col-md-3 col-lg-3'></div>";

			value.archivosUpload[0].length > 0 ?(
				ultimo = value.archivosUpload[0].length -1,
				tempData2 += "<img src='"+value.archivosUpload[1]+"/"+value.archivosUpload[0][ultimo]+"' class='img-circle col-xs-4 col-sd-4 col-md-4 col-lg-4' alt='admin' />"
			// ) : tempData2 += "<img src='../../images/base/user.png' class='img-circle col-xs-6 col-sd-6 col-md-6 col-lg-6' alt='admin' />";
			):
			tempData2 += "<img src='../../images/base/user.png' class='img-circle col-xs-4 col-sd-4 col-md-4 col-lg-4' alt='admin' />";

			tempData2 += "<span class='col-xs-8 col-sd-8 col-md-8 col-lg-8' style='padding:0px'><span class='msg-title'><span class='blue'>"+value.mensaje+"<span style='color:green'>"+value.nombre+"</span>";
			tempData2 += "</span></span>";
			tempData2 += "</li>";
			tempData2 += "<span class='col-xs-12 col-sd-12 col-md-12 col-lg-12 msg-time' style='line-height:normal'><i class='ace-icon fa fa-clock-o'></i><span> "+getFechaFormatoH(value.fecha_envio)+"(Enviado)</span>";
			tempData2 += "</a>";
			tempData2 += "<i class='col-xs-1 col-sd-1 col-md-1 col-lg-1 ace-icon fa fa-times-circle' style='color:red;background:transparent;border:none;cursor:pointer;font-size:x-large;padding-top:5px;padding-left:1px'";
			tempData2 += "onClick=\"borrarNotificacion("+value.id_notificaciones+")\"></i>";

			tempData2 += "</span></span>";
			tempData2 += "</div>";
			cantidad++;
		});
		$("#CANTIDAD_NOTIFICACIONES").html("<i class='ace-icon fa fa-envelope-o'></i>Cantidad de Mensajes("+cantidad+")");
		$("#CANTIDAD_NOTIFICACIONES2").html(cantidad);
		$("#LISTA_NOTIFICACIONES").html(tempData2);
		$("#CANTIDAD_NOTIFICACIONES2_ICON").removeAttr("class","ace-icon fa fa-envelope icon-animated-vertical");
		$("#CANTIDAD_NOTIFICACIONES2_ICON").attr("class","ace-icon fa fa-envelope icon-animated-vertical");
		$("#CANTIDAD_NOTIFICACIONES2_ICON").removeAttr("style","animation-play-state: paused");
		setTimeout(function()
		{
			$("#CANTIDAD_NOTIFICACIONES2_ICON").attr("style","animation-play-state: paused");
		},5000);
	}

	function irAVista(direccion,contrato)
	{
		id_contrato = '<?php echo Session::getSesion("s_cont");?>';
		urlActual = window.location.pathname.split("/");
		urlIr = direccion.split("?");
		if(contrato==id_contrato)
		{
			if(urlIr[0]==urlActual[urlActual.length-1])
			{
				registro = urlIr[1].split("=");
				mover = registro[1];
				// contador=1;
				ejecutarPrimeraVez=true;
				moverA();
			}
			else
			{
				swal({
                    title:"",
                    text: "Esta accion cambiara la vista\n¿Desea dejar esta vista?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    // confirmButtonText: tempo,
                    }, function()
                    {
						window.location.href = direccion;
                    }
                );
			}
		}
		else
		{
			swal({
                    title:"",
                    text: "Esta accion cambiara el contrato y la vista\n¿Desea ejecutar esta acción?",
                    type: "warning",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    // confirmButtonText: tempo,
                    }, function()
                    {
						$.ajax({
							url:'../Controller/CumplimientosController.php?Op=contratoselec',
							type:'GET',
							data:'c='+contrato+"&obt=false",
							success:function(r)
							{
								window.location.href = direccion;
								window.top.$("#desc").html("CONTRATO("+r.clave_cumplimiento+")");
								window.top.$("#infocontrato").html("Contrato Seleccionado:<br>("+r.clave_cumplimiento+")"); 
                                                                
							},
							error:function()
							{
								swalError("Error al cambiar de contrato");
							}
						});
                    }
                );
		}

	}

	function borrarNotificacion(idNoti)
	{
		$.ajax({
			url: '../Controller/NotificacionesController.php?Op=EliminarNotificacion',
			type: 'GET',
			data: 'ID_NOTIFICACION='+idNoti,
			success:function(eliminado)
			{
				if(eliminado==true)
				{
					// swalSuccess("Eliminado");
					listarNotificaciones();
				}
				else
				swalError("No se pudo eliminar");
			},
			error:function()
			{
				swalError("Error en el servidor");
			}
		});
	}

	function swalSuccess(msj)
    {
        swal({
                title: '',
                text: msj,
                showCancelButton: false,
                showConfirmButton: false,
                type:"success"
            });
        setTimeout(function(){swal.close();},1500);
        $('#loader').hide();
    }
    
    function swalInfo(msj)
    {
        swal({
                title: '',
                text: msj,
                showCancelButton: false,
                showConfirmButton: false,
                type:"info"
            });
        setTimeout(function(){swal.close();},2000);
        $('#loader').hide();
    }

    function swalError(msj)
    {
        swal({
                title: '',
                text: msj,
                showCancelButton: false,
                showConfirmButton: false,
                type:"error"
            });
        setTimeout(function(){swal.close();$('#agregarUsuario .close').click()},1500);
        $('#loader').hide();
    }
</script>