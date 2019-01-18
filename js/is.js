$(function(){

    
    $("#loginform").submit(function(e){
//        jQuery("#loginform").submit(function(e){
//                                    alert("ya entro aqui ");
        $("#IngresoLog").attr("disabled",true);
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "../Controller/LoginController.php",
            data:formData,
            success: function(r)
            {
                if(r.success==true)
                {
                    var delay = 1000;
                    if(r.accesos=="si"){
//                                                            $.jGrowl("Acceso a vistas exitosa", { sticky: true });
                        var delay = 1000;
                        if(r.contrato=="si"){
//                                                                 $.jGrowl("Tiene contrato Asginado", { sticky: true });
                                $.jGrowl("Cargando  Porfavor Espere......", { sticky: true,theme:"themeG-wait" });
                                $.jGrowl("Bienvenido", { header: 'Acceso Permitido',theme:"themeG-success" });
                                var delay = 1000;
                                setTimeout(function(){ window.location = 'principalmodulos.php?type='+$("#t").val() }, delay);  
                        }else{
                                $.jGrowl("Error no  tiene contrato asignado", { header: 'Error acceso contratos',theme:"themeG-error" });
                                var delay = 1000;
                                $("#IngresoLog").attr("disabled",false);
                        }
                    }else
                    {
                            $.jGrowl("Error no tiene acceso al menos en una vista", { header: 'Error acceso a la vista' });
                                var delay = 1000;
                                $("#IngresoLog").attr("disabled",false);
                    }
                }
                else
                {
                    if(r.success==false){
                            $.jGrowl("Porfavor checa tu Usuario y Password", { header: 'Error de inicio de sesion',theme:"themeG-error" });
                            var delay = 1000;
                            $("#IngresoLog").attr("disabled",false);
                    }
                }
        },
                                    error:function(){
//                                                            alert("hubo un error al tratar de realizar la peticion ajax ");
                                        $.jGrowl("Error......", { sticky: true });
                                        $("#IngresoLog").attr("disabled",false);
                                    }
            });
                    return false;
                });
            });
            
            
            
            