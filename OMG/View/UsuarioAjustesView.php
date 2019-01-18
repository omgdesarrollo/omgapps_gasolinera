<?php
session_start();
require_once '../util/Session.php';
//$error=Session::eliminarSesion("error");
//$usuario=Session::eliminarSesion("usuario");
// if (Session:: existeSesion("user")){
//     header("location: principalmodulos.php");
//     return;
// }
?>
<html>
    <head>
        <title>OMG</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" type="text/css" href="../../css/estilo.css">
        <link href="../../assets/vendors/jGrowl/jquery.jgrowl.css" rel="stylesheet" type="text/css"/>
		<!-- Libreria java scritp de bootstrap -->
        <!-- <script src="../../assets/bootstrap/js/bootstrap.min.js" type="text/javascript"></script> -->
                <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->

        <script src="../../js/jquery.js" type="text/javascript"></script>
        <script src="../../js/jquery-ui.min.js" type="text/javascript"></script>

        <!-- <script src="../../js/jquery.min.js" type="text/javascript"></script> -->
        <script src="../../assets/vendors/jGrowl/jquery.jgrowl.js" type="text/javascript"></script>

        <script src="../../assets/colorPicker2/jquery.wheelcolorpicker.js" type="text/javascript"></script>
        <link href="../../assets/colorPicker2/css/wheelcolorpicker.css" rel="stylesheet" type="text/css"/>

        <!-- <script src="../../assets/colorPicker/jquery.mousewheel.min.js" type="text/javascript"></script> -->
        <!-- <script src="../../assets/colorPicker/colorPicker.min.js" type="text/javascript"></script> -->
        <!-- <script src="../../js/is.js" type="text/javascript"></script> -->
        <!-- <script src="../../js/tooltip.js" type="text/javascript"></script> -->

        <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-noscript.css"></noscript>
        <noscript><link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui-noscript.css"></noscript>
        <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload.css">
        <link async rel="stylesheet" href="../../assets/FileUpload/css/jquery.fileupload-ui.css">

        <!-- <script src="../../angular/angular.min.js" type="text/javascript"></script> -->

        <!-- swalAlert -->
        <script src="../../assets/bootstrap/js/sweetalert.js" type="text/javascript"></script>
        <link href="../../assets/bootstrap/css/sweetalert.css" rel="stylesheet" type="text/css"/>
        <style>
        /* #fileupload
        {
            text-align:center;
        } */
        body
        {
            height:100%;
        }
        .jQWCP-wWidget
        {
            top:45px !important;
            left:5px !important;
            width:auto !important;
            /* display:table !important; */
        }
        #demo:focus
        {
            /* border:0px;
            background:transparent;
            color:transparent; */
        }
        #demo
        {
            width:0px;
            height:0px;
            top:10px;
            left:10px;
            /* border:0px;
            background:transparent;
            color:transparent; */
        }
        /* td,th{padding:10px} */
        /* table[role="presentation"]
        {
            width:100%;
            text-align:center;
        } */
        </style>
    </head>
    <body>

    <!-- <div style="width:128px;">
   <input style="width:100px;" id="mycolor" class="colorPicker evo-cp0" />
   <div class="evo-colorind" style="background-color:#8db3e2"></div>
</div> -->
    <!-- <input id="colorPicker" type="color"></input> -->
    <div id="headerOpciones" style="position:fixed;width:100%;margin: 10px 0px 0px 0px;padding: 0px 25px 0px 5px;">
        <button id="cambiarFondoBtn" type="button" class="btn btn-success btn_agregar">Cambiar Fondo</button>
        <button id="cambiarFondoAccionBtn" type="button" class="btn btn-success btn_agregar" disabled>Guardar Fondo</button>
    </div>
    <input type="text" id="demo" data-wheelcolorpicker>
    <br><br><br>
    <div id="filesPhoto"></div>
    <div id="Contenedor" style="margin: 0px auto;height:fit-content">
        <div id="contenedorFotoPerfil" class="Icon">
            <!-- <span id="fotoPerfilCambio" class="glyphicon glyphicon-user" style="cursor:pointer"></span> -->
        </div>
		<!-- <div class="ContentForm"> -->
        <div class="form-group">
		 	<!-- <form id="loginform"  method="post" name="FormEntrar"> -->
            <label class="control-label">Contraseña Actual: </label>
            <div class="input-group input-group-lg">
                <span class="input-group-addon" id=""><i class="glyphicon glyphicon-lock"></i></span>
                <input onBlur="verificarPass(this)" id="contraActual" type="password" class="form-control" placeholder="******" required>
                <span class="input-group-addon" id="iconPassActual"><i style="color:red" class="glyphicon glyphicon-remove"></i></span>
            </div>
            <br>

            <label class="control-label">Contraseña Nueva: </label>
            <div class="input-group input-group-lg">
                <span class="input-group-addon" id=""><i class="glyphicon glyphicon-lock"></i></span>
                <input onKeyup="checarPass(this)" id="contraNueva" type="password" class="form-control" placeholder="******" required>
                <span class="input-group-addon" id="iconPassNueva"><i style="color:red" class="glyphicon glyphicon-remove"></i></span>
            </div>
            <br>

            <label class="control-label">Repetir Contraseña: </label>
            <div class="input-group input-group-lg">
                <span class="input-group-addon" id=""><i class="glyphicon glyphicon-lock"></i></span>
                <input onKeyup="checarPass(this)" id="contraNueva2" type="password" class="form-control" placeholder="******" required>
                <span class="input-group-addon" id="iconPassNueva2"><i style="color:red" class="glyphicon glyphicon-remove"></i></span>
            </div>
            <br>

            <button onClick="cambiarPass()" title="Haga clic aquí para cambiar contraseña" class="btn btn-lg btn-primary btn-block btn-signin">
            Cambiar Contraseña</button>
				<!--<div class="opcioncontra"><a href="">Olvidaste tu contraseña?</a></div>-->
            <!-- </form> -->
    </div>

     </div>
     <script>
        okpass=false;
        okpassN=false;
        noArchivo = 1;
        Frame = $(this)[0].frameElement;
        $(Frame).css("height","100%");
        var parentFrame = $(Frame).parent();
        $(parentFrame).css("height","100%");

        $(document).ready(()=>{
            var colorView = <?php
            $color = "";
            if(Session:: NoExisteSeSion("colorFondo_Vista"))
                $color = Session::getSesion("user")["FONDO_COLOR"];
            else
                $color = Session::getSesion("colorFondo_Vista");
            echo "'$color'";
            ?>;
            // console.log(colorView);
            $("style").append("::-webkit-scrollbar-thumb{ background-color:"+colorView+" !important;} .dhxlayout_base_material div.dhx_cell_layout div.dhx_cell_hdr{background-color:"+colorView+" !important;opacity:0.8 !important; }");
            $('#demo').wheelColorPicker();
        });
        
        $(()=>{

            $("#cambiarFondoBtn").click(()=>{
                $("#demo").focus();
            });

            $("#demo").focus(()=>{
                $(".jQWCP-wWidget").css("display","table");
            });

            $("#demo").on("change",()=>{
                let color = $("#demo").wheelColorPicker('getValue');
                $("#cambiarFondoAccionBtn").removeAttr("disabled");
                $("#cambiarFondoAccionBtn").css({"background":"#"+color,"opacity":0.8});
            });

            $("#cambiarFondoAccionBtn").click(()=>{
                let color = $("#demo").wheelColorPicker('getValue');
                cambiarColorDB(color);
            });
        });

        cambiarColorDB = (newColor)=>
        {
            $.ajax({
                url: '../Controller/AdminController.php?Op=CambiarColor',
                type: 'POST',
                data: 'COLOR=#'+newColor,
                beforeSend:()=>
                {
                    growlWait("Cambiar Color Fondo","...");
                },
                success:(resp)=>
                {
                    if(resp==1)
                    {
                        growlSuccess("Cambiar Color Fondo","Cambiado.<br>Recarga en breve...");
                        $("#cambiarFondoAccionBtn").attr("disabled",true);
                        setTimeout(() => {
                            window.parent.location.reload();
                        }, 2000);
                    }
                    else
                    {
                        growlError("Error Cambiar Color Fondo","No se pudo cambiar el color de fondo");
                    }
                },
                error:()=>
                {
                    growlError("Error","Error en el servidor");
                }
            });
        }

        function limpiarFormulario()
        {
            no = "<i style='color:red' class='glyphicon glyphicon-remove'></i>";
            clearInterval(outTime);
            swal({
                    title:"",
                    text: "Se agoto el tiempo de espera para el cambio de contraseña",
                    type: "info",
                    showCancelButton: false,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    confirmButtonText: "Recargar",
                    }, function()
                    {
                        outTime = setInterval(function(){limpiarFormulario();},35000);
                        swal.close();
                        limpiar();
                    }
                );
        }
        function limpiar()
        {
            $("#contraActual").val("");
            $("#contraNueva").val("");
            $("#contraNueva2").val("");

            $("#iconPassActual").html(no);
            $("#iconPassNueva").html(no);
            $("#iconPassNueva2").html(no);
            
            okpass=false;
            okpassN=false;
        }
        outTime = setInterval(function(){limpiarFormulario();},30000);

        function cambiarPass()
        {
            contraA = $("#contraActual").val();
            contraN = $("#contraNueva").val();
            if(okpass==true && okpassN==true)
            {
                if(contraA != contraN)
                {
                    $.ajax({
                        url: '../Controller/AdminController.php?Op=CambiarPass',
                        type: 'POST',
                        data: 'PASS='+contraA+"&NEW_PASS="+contraN,
                        success:function(exito)
                        {
                            if(exito==true)
                            {
                                clearInterval(outTime);
                                swal({
                                    title:"",
                                    text: "La contraseña se cambio. Inicie sesion de nuevo",
                                    type: "info",
                                    showCancelButton: false,
                                    closeOnConfirm: false,
                                    showLoaderOnConfirm: true,
                                    confirmButtonText: "Salir",
                                    }, function()
                                    {
                                        window.parent.location.href="Logout.php";
                                    }
                                );
                                setTimeout(function(){swal.close();window.parent.location.href="Logout.php";},7000);
                            }
                            else
                            {
                                swalError("No se pudo hacer el cambio de contraseña");
                            }
                        },
                        error:function()
                        {
                            swalError("Error en el servidor");
                        }
                    });
                }
                else
                {
                    swal("","No puedes utilizar tu misma contraseña","info");
                }
            }
        }

        // function verificarTodo()
        // {
        //     //contraActual,contraNueva,contraNueva2
        //     contraA = $("#contraActual").val();
        //     contraN = $("#contraNueva").val();
        //     contraN2 = $("#contraNueva2").val();

        //     if(contraN!="")
        //     {
        //     }
        //     if(contraN2!="")
        //     {
        //     }
        // }
        function checarPass(Obj)
        {
            console.log("aq");
            pass = $("#contraNueva").val();
            passN = $("#contraNueva2").val();
            yes = "<i style='color:#02ff00' class='glyphicon glyphicon-ok'></i>";
            no = "<i style='color:red' class='glyphicon glyphicon-remove'></i>";
            if(pass!="" && passN!="")
            {                
                if(pass == passN)
                {
                    $("#iconPassNueva").html(yes);
                    $("#iconPassNueva2").html(yes);
                    okpassN=true;
                }
                else
                {
                    $("#iconPassNueva").html(no);
                    $("#iconPassNueva2").html(no);
                    okpassN=false;
                }
            }
            else
            {
                $("#iconPassNueva").html(no);
                $("#iconPassNueva2").html(no);
                okpassN=false;
            }
        }

        function verificarPass(Obj)
        {
            contrasena = $(Obj).val();
            yes = "<i style='color:#02ff00' class='glyphicon glyphicon-ok'></i>";
            no = "<i style='color:red' class='glyphicon glyphicon-remove'></i>";
            $.ajax({
                url: '../Controller/AdminController.php?Op=VerificarPass',
                type: 'GET',
                data: 'PASS='+contrasena,
                success:function(correcta)
                {
                    if(correcta==true)
                    {
                        $("#iconPassActual").html(yes);
                        okpass=true;
                    }
                    else
                    {
                        okpass=false;
                        $("#iconPassActual").html(no);
                    }
                },
                error:function()
                {
                    okpass=false;
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

        function agregarArchivosUrl()
        {
            usuario = <?php echo Session::getSesion("user")["ID_USUARIO"] ?>;
            var ID_EVIDENCIA_DOCUMENTO = $('#tempInputIdEvidenciaDocumento').val();
            url = 'filePerfilesUsuario/'+usuario,
            $.ajax({
                url: "../Controller/ArchivoUploadController.php?Op=CrearUrl",
                type: 'GET',
                data: 'URL='+url+"&SIN_CONTRATO=X",
                success:function(creado)
                {
                    if(creado==1)
                    {
                        growlWait("Subir Imagen","Cargando Imagen Espere...");
                        $('.start').click();
                    }
                },
                error:function()
                {
                    growlError("Error","Error en el servidor");
                }
            });
        }

        mostrar_urls = ()=>
        {
            return new Promise((resolve,reject)=>{
                let usuario = <?php echo Session::getSesion("user")["ID_USUARIO"] ?>;
                let tempDocumentolistadoUrl = "";
                URL = 'filePerfilesUsuario/'+usuario,
                $.ajax({
                    url: '../Controller/ArchivoUploadController.php?Op=listarUrls',
                    type: 'GET',
                    data: 'URL='+URL+"&SIN_CONTRATO=''",
                    // async:false,
                    success:(todo)=>
                    {
                        $("#filesPhoto").html("<form id='fileupload' method='POST' enctype='form-data' style='display:none'>"+
                        "<div class='fileupload-buttonbar'><div class='fileupload-buttons'>"+
                        "<span id='fileBtn' class='fileinput-button'><span id='spanAgregarDocumento'><a >Agregar Archivos(Click o Arrastrar)...</a></span>"+
                        "<input type='file' name='files[]' ></span><span class='fileupload-process'></span></div>"+
                        "<div class='fileupload-progress'><div class='progress-extended'>&nbsp;</div></div></div>"+
                        "<table role='presentation'><tbody class='files'></tbody></table></form>");
                        if(todo[0].length!=0)
                        {
                            ultimo = todo[0].length;
                            let inp = '<img onclick="fotoPerfilCambio()" src="'+todo[1]+"/"+todo[0][ultimo-1]+'" class="img-circle" style="width:140px;height:140px;margin-top:5px;cursor:pointer">';
                            $("#contenedorFotoPerfil").html(inp);
                        }
                        else
                            $("#contenedorFotoPerfil").html('<span onclick="fotoPerfilCambio()" class="glyphicon glyphicon-user" style="cursor:pointer"></span></div>');

                        noArchivo=1;
                        resolve();
                    }
                });
            });
        }
       
        fotoPerfilCambio = ()=>
        {
            $("input[type='file']").click();
        }
        mostrar_urls().then((resolve)=>{ $('#fileupload').fileupload({url: '../View/'});console.log("primera");},(error)=>{  console.log("d");}        );
       
    </script>
    <script id="template-upload" type="text/x-tmpl">
    {% let error = 0; %}
    {%for (var i=0, file; file=o.files[i]; i++) { %}
        <tr class="template-upload" style="width:100%">
            <td>
                <span class="preview"></span>
            </td>
            <!-- <td> -->
            <!-- <p class="name">{%=file.name%}</p> -->
            <!-- <strong class="error"></strong> -->
            <!-- </td> -->
            <!-- <td> -->
            <!-- <p class="size">Processing...</p> -->
            <!-- <div class="progress"></div> -->
            <!-- </td> -->
            <td>
            {% if (!i && !o.options.autoUpload) { if(noArchivo==1){ if(file.type.split("/")[0]=="image"){ noArchivo=0; %}
                    <button class="start" style="display:none;padding: 0px 4px 0px 4px;" disabled>Start</button>
            {% }else{ error = 1; } } } %}
            {% if (!i) { %}
                    <!-- <button class="cancel" style="padding: 0px 4px 0px 4px;color:white">Cancel</button> -->
            {% } %}
            </td>
        </tr>
        {% if(i==0){ if(error==1) growlError("Error Imagen","Formato de Imagen no Compatible"); else{  setTimeout(agregarArchivosUrl,200);         } } %}
    <!-- {%  } %} -->
</script>

<script id="template-download" type="text/x-tmpl">
    {%  var t = $('#fileupload').fileupload('active'); var i,file; %}
    {% for (i=0,file; file=o.files[i]; i++) { %}
        <!-- <tr class="template-download" style="width:100%"> -->
            <!-- <td>
            <span class="preview"> -->
            <!-- {%  %} -->
                    <!-- {% if (file.thumbnailUrl) { %} -->
                    <!-- <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery> -->
                    <!-- <img src="{%=file.thumbnailUrl%}"></img> -->
                    <!-- </a> -->
                    <!-- {% } %} -->
            <!-- </span>
            </td> -->
            <!-- <td> -->
            <!-- <p class="name"> -->
                    <!-- <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a> -->
                    <!-- <img src="{%=file.thumbnailUrl%}"></img> -->
            <!-- </p> -->
            <!-- </td> -->
            <!-- <td>
            <!-- <span class="size">{%=o.formatFileSize(file.size)%}</span> -->
            </td> -->
            <!-- <td> -->
            <!-- <button class="delete" style="padding: 0px 4px 0px 4px;" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>Delete</button> -->
            <!-- <input type="checkbox" name="delete" value="1" class="toggle"> -->
            <!-- </td> -->
        <!-- </tr> -->
    {% } %}
    {% growlSuccess("","Imagen Cargada"); mostrar_urls().then(()=>{ $('#fileupload').fileupload({url: '../View/'}); }); %}
</script>
<!-- <script src="../../assets/probando/js/bootstrap.min.js"></script> -->

    <script  src="../../assets/FileUpload/js/tmpl.min.js"></script>
    <script  src="../../assets/FileUpload/js/load-image.all.min.js"></script>
    <script  src="../../assets/FileUpload/js/canvas-to-blob.min.js"></script>
    <script  src="../../assets/FileUpload/js/jquery.blueimp-gallery.min.js"></script>
    <script  src="../../assets/FileUpload/js/jquery.iframe-transport.js"></script>
    <script  src="../../assets/FileUpload/js/jquery.fileupload.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-process.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-image.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-audio.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-video.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-validate.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-ui.js"></script>
    <script src="../../assets/FileUpload/js/jquery.fileupload-jquery-ui.js"></script>
    <!-- <script src="../../assets/FileUpload/js/main.js"></script> -->
    <body>
</html>