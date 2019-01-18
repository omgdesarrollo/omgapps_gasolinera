apis="../Controller/GanttTareasController.php?Op=listarTareasModoChat";
idactividadGlobal=-1;
function ajax(method, send, callback) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            callback(this.responseText);
        }
    };
    xmlhttp.open(method, apis, true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    if (send) {
        xmlhttp.send(send);
    }else {
        xmlhttp.send();
    }
}

var id_usuario=-1,estareapadre=false;
obtenerNotasHistoricas();

function obtenerNotasHistoricas(){
ajax("POST", "data=checar_existe_usuario", function(res) {
    var a = JSON.parse(res);
//    console.log("te",res);
    
    if(a.status == 'success'){
    
        document.getElementsByClassName('app-one')[0].style.display = "block";
//        document.getElementById("heading-name-meta").innerHTML = "("+a.user.NOMBRE_USUARIO+")";
        document.getElementById("heading-user").innerHTML =a.user.NOMBRE_USUARIO;
//        document.getElementById("heading-online").innerHTML = "Actividades";
    //     document.getElementById("quienestalogeado").innerHTML=a.user.NOMBRE_USUARIO;
//        $("#quienestalogeado").html(a.user.NOMBRE_USUARIO);
        estareapadre=false;
        id_usuario=a["user"]["ID_USUARIO"];
//        alert(usuario);
        $.each(a["tareas"],function (index,value){
//            console.log(value);
            if(value.parent==0){
                if(value.id_usuario==id_usuario){
                    estareapadre=true;
                }
            }
//             sideTwoHTML(value);
//             sideOneHTML(value);
//            console.log(value["tareas"]["0"].historico_notas);
//            tareas[""0""].historico_notas
//            sideTwoHTML(a);
        });
         $.each(a["tareas"],function (index,value){
//            console.log(value);
//             sideTwoHTML(value);
             sideOneHTML(value);
        });     
//        sideTwoHTML(a);   
    }else{
        
    }
});

}




function sideOneHTMLAnterior(a) {
        var b = "";
        b += '<div class="row sideBar-body "  data-tipe="actividades" data-login="' + a.date + '" data-avatar="' + a.avatar + '" data-status="online" id="' + a.name + '">';
        b += '	<div class="col-sm-3 col-xs-3 sideBar-avatar">';
        b += '  	<div class="avatar-icon">';
        b += '			<span class="contact-status ' + (a.status == 'online' ? 'on' : 'off') + '"></span>';
        b += '			<img src="' + a.avatar + '">';
        b += '  	</div>';
        b += '	</div>';
        b += '	<div class="col-sm-9 col-xs-9 sideBar-main">';
        b += '  	<div class="row">';
        b += '			<div class="col-sm-8 col-xs-8 sideBar-name">';
        b += '	  			<span class="name-meta">' + a.name + '</span>';
        b += '			</div>';
//        b += '			<div class="col-sm-4 col-xs-4 pull-right sideBar-time">';
//        b += '	 			<span class="time-meta pull-right">' + timeToWords(a.date) + '</span>';
//        b += '			</div>';
        b += '			<div class="col-sm-12 sideBar-message">';
        if (a.selektor != undefined) {
            if (a.selektor == "to") {
                b += '<i class="fa fa-check"></i> ' + htmlEntities(a.message);
            } else {
                b += htmlEntities(a.message);
            }
        }
        b += '  		</div>';
        b += '  	</div>';
        b += '	</div>';
        b += '</div>';
        $('.side-one .sideBar').prepend(b);
    }
    
    
    
    function sideOneHTML(a) {
//        console.log("entro",a);
        a["avatar"]="https://tustareas.com.co/wp-content/uploads/2017/11/Tus-tareas.png";
        var b = "";
        b += '<div class="row sideBar-body" data-tipe="actividades" data-login="' + a.user + '" data-avatar="' + a.avatar + '" data-status="' +(a.manipulacion_tarea == 'true' ? 'on' : 'off')  + '" data-idactividad="' + a.id + '"  data-manipulacion_tarea="'+a.manipulacion_tarea+'"            id="' + a.text + '">';
        b += '<div class="col-sm-3 col-xs-3 sideBar-avatar">';
        b += '  <div class="avatar-icon">';
        b += '	<span class="contact-status ' + (a.manipulacion_tarea == 'true' ? 'on' : 'off') + '"></span>';
        b += '	<img src="' + a.avatar + '">';
        b += '  </div>';
        b += '</div>';
        b += '<div class="col-sm-9 col-xs-9 sideBar-main">';
        b += '  <div class="row">';
        b += '	<div class="col-sm-8 col-xs-8 sideBar-name">';
        b += '	  <div class="informacioncorta" >' + a.text + '</div>';
        b += '	</div>';
        
        
        b += '	<div class="col-sm-4 col-xs-4 pull-right sideBar-time">';
        if(estareapadre==true){
            b += '	  <span class="time-meta pull-right">Add</span>';
        }else{
            if(a.manipulacion_tarea == 'true'){
             b += '	  <span class="time-meta pull-right">Add</span>';
            }
        }
//         b += '	  <span class=" pull-right">info</span>';
//        b += '	  <span class="time-meta pull-right">' + timeToWords(a.login) + '</span>';
        b += '	</div>';
        b += '  </div>';
        b += '</div>';
        b += '</div>';       
//        $('.side-two .compose-sideBar').prepend(b);
         $('.side-one .sideBar').prepend(b);
}
// function sideTwoHTML(a) {
//        a["avatar"]="https://tustareas.com.co/wp-content/uploads/2017/11/Tus-tareas.png";
//        var b = "";
//        b += '<div class="row sideBar-body" data-tipe="actividades" data-login="' + a.user + '" data-avatar="' + a.avatar + '" data-status="' +(a.manipulacion_tarea == 'true' ? 'on' : 'off')  + '" id="' + a.text + '">';
//        b += '<div class="col-sm-3 col-xs-3 sideBar-avatar">';
//        b += '  <div class="avatar-icon">';
//        b += '	<span class="contact-status ' + (a.manipulacion_tarea == 'true' ? 'on' : 'off') + '"></span>';
//        b += '	<img src="' + a.avatar + '">';
//        b += '  </div>';
//        b += '</div>';
//        b += '<div class="col-sm-9 col-xs-9 sideBar-main">';
//        b += '  <div class="row">';
//        b += '	<div class="col-sm-8 col-xs-8 sideBar-name">';
//        b += '	  <span class="name-meta">' + a.text + '</span>';
//        b += '	</div>';
////        b += '	<div class="col-sm-4 col-xs-4 pull-right sideBar-time">';
////        b += '	  <span class="time-meta pull-right">tiempo words</span>';
////        b += '	  <span class="time-meta pull-right">' + timeToWords(a.login) + '</span>';
////        b += '	</div>';
//        b += '  </div>';
//        b += '</div>';
//        b += '</div>';       
////        $('.side-two .compose-sideBar').prepend(b);
//         $('.side-one .sideBar').prepend(b);
//}
    
    
    $('body').on('keydown', '#searchText', function() {
        setTimeout(function() {
            if (document.getElementById("searchText").value == "") {
                $("body .side-one .sideBar-body").show();
            } else {
                $("body .side-one .sideBar-body").hide();
                $("body .side-one .sideBar-body").each(function(i, a) {
                    var key = $("body .side-one .sideBar-body").eq(i).attr('id');
                    var reg = new RegExp(document.getElementById("searchText").value, 'ig');
                    var res = key.match(reg);
                    if (res) {
                        $("body .side-one .sideBar-body").eq(i).show();
                    }
                });
            }

        }, 50);
    });
var  limit = 10;
  $('body').on('click', '.side-one .sideBar-body', function() {
      
      mostrarInfoMasAdetalleActividad();
//      alert("e");
        var a = $(this).attr('id'),
            tipe = $(this).data('tipe'),
            av = $(this).data('avatar'),
            st = $(this).data('status'),
            idactividad=$(this).data('idactividad'),
            manipulacion_tarea=$(this).data('manipulacion_tarea');
//            showPopup(a);
//            alert(manipulacion_tarea);
             if(estareapadre==true){
                $("#campoParaEnviarNota").html('<textarea class="form-control" data-emojiable="true" rows="1" id="comment"></textarea>');
                $("#send").html('<i class="fa fa-send fa-2x pull-right" aria-hidden="true"></i>');
             }else{
                if(manipulacion_tarea==true){
                    $("#campoParaEnviarNota").html('<textarea class="form-control" data-emojiable="true" rows="1" id="comment"></textarea>');
                     $("#send").html('<i class="fa fa-send fa-2x pull-right" aria-hidden="true" readonly></i>');
                }else{
                     $("#send").html('<i class="fa fa-ban fa-2x pull-right" aria-hidden="true"></i>');
                     $("#campoParaEnviarNota").html('<textarea class="form-control" data-emojiable="true" rows="1" id="comment" readonly></textarea>');
                }
             }
             
             
             
//            id_Actividad=$(this).data('id_Actividad');

        idactividadGlobal=idactividad;
            console.log(a);
        $('.side-one .sideBar-body').removeClass("active");
        $(this).addClass("active");
        $('.side-one #' + a + ' .inbox-count').remove();
        uKe = a;
        uTipe = tipe;
        headingHTML(av, a, st);
        valoresTodosLosImportantes=[];
        valoresTodosLosImportantes.push({"a":a,"idactividad":idactividad});
        notasHistoricas(valoresTodosLosImportantes, function(a) {
            messages = a;
            no = 0;
            document.getElementsByClassName('messages')[0].innerHTML = "";
            console.log("me  ",messages);
            if (messages.length > 1) {
                $("#mensajePrevio").html("<a>Mostrar Notas Previas</a>");
                $(".message-previous").show();
            } else {
                $(".message-previous").hide();
            }
            var opsid = 0;
            messages.forEach(function(a) {
                if (opsid < limit) {
                    console.log(a);
                    messageHTML(messages[no]);
                    no++;
                }
                opsid++;
            });
       
            scrollBottom();
        });
        var $window = $(window);

        function checkWidth() {
            var windowsize = $window.width();
            if (windowsize <= 700) {
                $(".side").css({
                    "display": "none"
                });
            }
        }
        checkWidth();
        $(window).resize(checkWidth);
        return false
    });
    
    
    function mostrarInfoMasAdetalleActividad(){

       
    }
    
      $("body #conversation").scroll(function() {
        // scroll bottom
        if ($(this).scrollTop() >= ($("body .messages").height() - $(this).height())) {
            $("body .message-scroll").hide();
            $("body .message-previous").hide();
            return false;
        } else if ($(this).scrollTop() == 0) {
            if (no >= messages.length) {
                $("body .message-previous").hide();
            } else {
                $("body .message-previous").show();
            }
            return false;
        } else {
//            $("body .message-previous").hide();
            $("body .message-scroll").show();
            return false;
        }
    });
    
    
    
    
    
    
    function notasHistoricas(valoresImportantesEnviar, callback) {
        $.ajax({
            url: "../Controller/GanttTareasController.php?Op=notasHistoricasxActividad",
            type: "post",
            data: {
//                data: 'message',
                obtenerNotas:JSON.stringify(valoresImportantesEnviar)
            },
            crossDomain: true,
            dataType: 'json',
            success: function(a) {
                callback(a);
            }
        })
    }
     function messageHTML(a, bottom) {
//        var image = (a.image != undefined ? a.image : a.images);
        var b = "";
//        console.log(a);
       
        
        //m es el usuario
//        console.log(a.name);
        if (a.name == "") {
//            alert("e");
            b += '<div class="row message-body">';
            b += '  <div class="col-sm-12 message-main-sender">';
            b += '	<div class="sender">';
//            b += '	  <div class="message-text">' + (image != '' ? '<a title="Zoom" href="' + imageDir + '/' + image + '" class="placeholder"><img class="imageDir" src="' + imageDir + '/' + image + '"/></a>' : '') + urltag(htmlEntities(a.message)) + '</div>';
            b += '	  <span class="message-time pull-right">' + timeToWords(a.fecha_creacion_nota) + '</span>';
            b += '	</div>';
            b += '  </div>';
            b += '</div>';
        } else {
//            alert("entro ");
            b += '<div class="row message-body">';
            b += '  <div class="col-sm-12 message-main-receiver">';
            b += '	<div class="receiver">';
            if(id_usuario==a.quien_introdujo_el_registro){
                b += '	  <div class="message-text" ><span class="pull-left"><a title="Usuario quien creo la nota" ><div  class="responsabletarea">'+a.nombre_usario_quien_creo_la_nota+'</div></a></span>' + urltag(htmlEntities(a.historico_notas)) + '</div>';
            }else{
                 b += '	  <div class="message-text" ><span class="pull-left"><a title="Usuario quien creo la nota" ><div  class="otrosreponsablesdelaactividad">'+a.nombre_usario_quien_creo_la_nota+'</div></a></span>' + urltag(htmlEntities(a.historico_notas)) + '</div>';
            }
            
//            b += '	  <div class="message-text" ><span class="pull-left"><a title="Usuario quien creo la nota" ><div  class="nota">'+a.nombre_usario_quien_creo_la_nota+'</div></a></span>' + urltag(htmlEntities(a.historico_notas)) + '</div>';
            b += '	  <span class="message-time pull-right"><span style="color:#006699" class="pull-right">'+a.fecha_creacion_nota+'</span>' + timeToWords(a.fecha_creacion_nota) + '</span>';
            b += '	</div>';
            b += '  </div>';
            b += '</div>';
        }
        if (bottom != undefined) {
            $('#conversation .messages').append(b);
        } else {
//            alert("");
            $('#conversation .messages').prepend(b);
        }
    }
   
  function timeToWords(time, lang) {
        lang = lang || {
            postfixes: {
                '<': '',
                '>': ''
            },
            1000: {
                singular: 'justo Ahora',
//                singular: 'just now',
                plural: '# segundos'
//                plural: '# seconds'
            },
            60000: {
                singular: '1 minuto',
//                singular: '1 minute',
                plural: '# minutos'
//                plural: '# minutes'
            },
            3600000: {
                singular: '1 hora',
//                singular: '1 hour',
                plural: '# horas'
//                plural: '# hours'
            },
            86400000: {
                singular: 'un dia',
//                singular: 'a day',
                plural: '# dias'
//                plural: '# days'
            },
            31540000000: {
                singular: 'un año',
//                singular: 'a year',
                plural: '# años'
//                plural: '# years'
            }
        };

        var timespans = [1000, 60000, 3600000, 86400000, 31540000000];
        var parsedTime = Date.parse(time.replace(/\-00:?00$/, ''));

        if (parsedTime && Date.now) {
            var timeAgo = parsedTime - Date.now();
            var diff = Math.abs(timeAgo);
            var postfix = lang.postfixes[(timeAgo < 0) ? '<' : '>'];
            var timespan = timespans[0];

            for (var i = 1; i < timespans.length; i++) {
                if (diff > timespans[i]) {
                    timespan = timespans[i];
                }
            }

            var n = Math.round(diff / timespan);

            return lang[timespan][n > 1 ? 'plural' : 'singular']
                .replace('#', n) + postfix;
        }
    }  
    function htmlEntities(a) {
        return String(a).replace(/</g, '&lt;').replace(/>/g, '&gt;')
    }
    function urltag(d, e) {
        var f = {
            yutub: {
                regex: /(^|)(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*)(\s+|$)/ig,
                template: "<iframe class='yutub' src='//www.youtube.com/embed/$3' frameborder='0' allowfullscreen></iframe>"
            },
            link: {
                regex: /((^|)(https|http|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig,
                template: "<a href='$1' target='_BLANK'>$1</a>"
            },
            email: {
                regex: /([a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z0-9._-]+)/gi,
                template: '<a href=\"mailto:$1\">$1</a>'
            }
        };
        var g = $.extend(f, e);
        $.each(g, function(a, b) {
            d = d.replace(b.regex, b.template)
        });
        return d
    }
    function scrollTop() {
        setTimeout(function() {
            var cc = $('#conversation');
            cc.animate({
                scrollTop: 0
            }, 500);
        }, 1000);
    }
   function scrollBottom() {
//       alert("b");
        setTimeout(function() {
            var cc = $('#conversation');
            var dd = cc[0].scrollHeight;
            cc.animate({
                scrollTop: dd
            }, 500);
            $("body .message-scroll").hide();
            $("body .message-previous").hide();
        }, 1000);
    }

function headingHTML(avatar, name, status) {
//        document.getElementsByClassName('you')[0].src = avatar;
        document.getElementById('heading-name-meta').innerHTML = name;
        document.getElementById('heading-online').innerHTML = status;
}





document.getElementById("scroll").addEventListener("click", function() {
        var cc = $('#conversation');
        var dd = cc[0].scrollHeight;
        cc.animate({
            scrollTop: dd
        }, 500);
        return false
    });

  document.getElementsByClassName("previous")[0].addEventListener("click", function() {
//      alert("d");
        var opsid = 0;
        messages.forEach(function(a) {
            if (opsid < limit) {
                messageHTML(messages[no]);
                no++;
                scrollTop();
                if (no >= messages.length) {
                    $(".message-previous").hide();
                }
            }
            opsid++;
        });

        $('.placeholder').magnificPopup({
            type: 'image',
            closeOnContentClick: true,
            mainClass: 'mfp-img-mobile',
            image: {
                verticalFit: true
            }

        });
        return false
    });

//document.getElementsByClassName("heading-compose")[0].addEventListener("click", function() {
//    document.getElementsByClassName('side-two')[0].style.left = "0";
//});
//  $("#send").click(function (){
//        alert("le has picado");
//    });
    document.getElementById("send").addEventListener("click", function() {
//        alert("D");
 
        var a = new Date(),
            b = a.getDate(),
            c = (a.getMonth() + 1),
            d = a.getFullYear(),
            e = a.getHours(),
            f = a.getMinutes(),
            g = a.getSeconds(),
            date = d + '-' + (c < 10 ? '0' + c : c) + '-' + (b < 10 ? '0' + b : b) + ' ' + (e < 10 ? '0' + e : e) + ':' + (f < 10 ? '0' + f : f) + ':' + (g < 10 ? '0' + g : g);
      
        if (document.getElementById('comment').value != '') {
//            alert(document.getElementById('comment').value);
           
//            ajax("../Controller/GanttTareasController.php?Op=insertarNotasHistoricas","POST", "&data=send&date="+date, function(res) {
//
//
//            });
// f=$(this).data('idactividad');
//alert(idactividadGlobal);
        
            var valoresEnviar={"id_actividad":idactividadGlobal,"nota":document.getElementById('comment').value};
            $.ajax({
                url:"../Controller/GanttTareasController.php?Op=insertarNotasHistoricas",
                type:"POST",
                data:"data=send&valoresEnvio="+JSON.stringify(valoresEnviar),
                success:function (res){
//                     var a = JSON.parse(res);
                     document.getElementById('comment').value = "";
                     $(".sideBar-body.active").trigger('click');
                     scrollBottom();   
                }
            })
            
            
            
        } else {
            
//            alert('no puede quedar el campo vacio ')
        }
    });
    
  
//document.getElementsByClassName("newMessage-back")[0].addEventListener("click", function() {
//    document.getElementsByClassName('side-two')[0].style.left = "-100%";
//});

//document.getElementsByClassName("user-back")[0].addEventListener("click", function() {
//    document.getElementsByClassName('side')[0].style.display = "block";
//});


