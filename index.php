<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">

        <style>
            
            .arial{
                font-family:Arial;
            }

            .table-div{
                height:400px;
            }
            .font-white{
                color: #FFFF;
            }

        </style>

    </head>

    <body data-ma-theme="green">
        <main class="main">
            <div class="page-loader">
                <div class="page-loader__spinner">
                    <svg viewBox="25 25 50 50">
                        <circle cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
                    </svg>
                </div>
            </div>

            <header class="header">
                <div class="navigation-trigger" data-ma-action="aside-open" data-ma-target=".sidebar">
                    <div class="navigation-trigger__inner">
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                        <i class="navigation-trigger__line"></i>
                    </div>
                </div>

                <div class="header__logo hidden-sm-down">
                    <h1><a href="index.html">Reloj checador Conalep 1.0</a></h1>
                </div>


                <ul class="top-nav">
                    <li class="hidden-xl-up"><a href="" data-ma-action="search-open"><i class="zmdi zmdi-search"></i></a></li>

                    <li class="hidden-xs-down">
                        <a class="top-nav__notify">
                            <i class="zmdi zmdi-comment-alt-text"></i>
                        </a>
                    </li>
                </ul>
            </header>

            <aside class="sidebar sidebar--hidden">
                <div class="scrollbar-inner">
                    <div class="user">
                        <div class="user__info" data-toggle="dropdown">
                            <img class="user__img" src="demo/img/profile-pics/8.jpg" alt="">
                            <div>
                                <div class="user__name">Malinda Hollaway</div>
                                <div class="user__email">malinda-h@gmail.com</div>
                            </div>
                        </div>

                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="">View Profile</a>
                            <a class="dropdown-item" href="">Settings</a>
                            <a class="dropdown-item" href="">Logout</a>
                        </div>
                    </div>

                    <ul class="navigation">
                        <li class="navigation__active"><a href="index.php"><i class="zmdi zmdi-home"></i>Reloj</a></li>
                        <li><a href="usuarios.php"><i class="zmdi zmdi-accounts"></i>Usuarios</a></li>
                    </ul>
                </div>
            </aside>


            <section class="content content--full">
                <div class="card">
                    <div class="card-header bg-light-blue">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget-calendar__year" id="v_año"></div>
                                <div class="widget-calendar__day" id="v_fecha"></div>
                            </div>
                            <!-- <a href="calendar.html" class="bg-orange btn btn--action waves-effect"><i class="zmdi zmdi-plus"></i></a> -->
                            <div class="col-md-6 text-right">
                                <span id="liveclock"></span>
                                <h1 class="arial font-white"><b><i class="zmdi zmdi-time zmdi-hc-fw"></i> <span id="hora_actual"></span></b></h1>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <img src="medios/fotos_usuarios/perfil.png" id="foto_usuario" alt="" class="img-fluid">
                        </div>
                        <div class="col-md-8">
                            <form action="" id="form_codigo">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button id="validarurl" type="button" class="btn btn-primary">
                                            <i class="zmdi zmdi-accounts-list zmdi-hc-fw"></i>
                                        </button>
                                    </span>
                                    <input type="text" name="codigo" class="form-control" id="codigo" autocomplete="off">
                                </div>
                            </form>
                            <br>                            
                            <br>
                            <div class="row" id="info_usuario" style="display: :none;">
                                <div class="col-md-10 ">
                                    <h3 id="nombre_usuario"></h3>
                                    <hr>
                                    <h3 id="puesto_usuario"></h3>
                                    <hr>
                                    <h3 id="departamento"></h3>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h4>Marcado:</h4>    
                                    <hr>
                                    <span>
                                    <h2 style="background:yellow;padding:10px;" id="hora_checada"></h2>
                                    </span>                        
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="alert alert-danger mt-3" id="alerta" role="alert" style="display:none;">
                                        <h4 class="font-white"><strong id="texto_alerta"></strong></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                        <div class="table-responsive table-div">
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr style="background:black;color:White">
                                        <th>#</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Departamento</th>
                                        <th>Hora Checkout</th>
                                        <th>Comentario</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_checkout">
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </section>

            
        </main>

        <!-- ../vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <script src="vendors/bower_components/autosize/dist/autosize.min.js"></script>
        <script src="vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>



        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>

        <script>    
            var n = 0;
            var hora = "";
            var tolerancia = 15;
            var retardo = false;
            var salida_antes = false;

            $(document).ready(function(){
                show5();
                get_fecha();
                $("#codigo").focus();
            })
            // window.onload=show5



            function show5(){
                if (!document.layers&&!document.all&&!document.getElementById)
                return
                    var Digital=new Date()
                    var hours=Digital.getHours()
                    var minutes=Digital.getMinutes()
                    var seconds=Digital.getSeconds()

                    var dn="Hrs"
                    if (minutes<=9)
                    minutes="0"+minutes
                    if (seconds<=9)
                    seconds="0"+seconds
                    //change font size here to your desire
                    hora = hours+":"+minutes+":"+seconds;
                    if(hours == 0 && seconds == 0){
                        get_fecha();
                    }
                    $("#hora_actual").html(hora+" Hrs");
                setTimeout("show5()",1000)
            }

            function get_fecha(){
                f = new Date()
                var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
                var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");

                var fecha = diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();

                var año = f.getFullYear();
                var dia = diasSemana[f.getDay()];
                var mes = meses[f.getMonth()];

                var fecha = dia+" "+f.getDate()+" de "+mes;

                $("#v_año").html(año);
                $("#v_fecha").html(fecha);
                
            }

        


            $("#form_codigo").on('submit',function(e){
                
                f = new Date();
                var dd = f.getDate();
                var mm = f.getMonth()+1; //f es 0!
                var yyyy = f.getFullYear();

                if(dd<10) {
                    dd='0'+dd
                } 

                if(mm<10) {
                    mm='0'+mm
                } 

                hoy = yyyy+'/'+mm+'/'+dd;

                dia = get_dia_semana(f);

                var codigo = $("#codigo").val();
                var datos = "opc=checkout&codigo="+codigo+"&fecha="+hoy+"&dia_semana="+dia+"&hora="+hora;
                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: datos,
                    dataType: "json",
                    //una vez finalizado correctamente
                    success: function(json){
                        if(json.success){
                            var foto = 'img/usuarios/'+json.data.file_foto;
                            $("#foto_usuario").attr('src',foto);
                            $("#nombre_usuario").html(json.data.nombres+" "+json.data.apellido_pat+" "+json.data.apellido_mat);
                            $("#puesto_usuario").html(json.data.puesto);
                            $("#departamento").html(json.data.departamento);
                            $("#hora_checada").html(hora);
                            n++;
                            
                            var message = validar_horario(json.data.horario,hora,json.data.id_usuario,json.data.id_horario);

                            

                            var html_tr = '<tr>'+
                                            '<td>'+n+'</td>'+
                                            '<td>'+json.data.nombres+" "+json.data.apellido_pat+" "+json.data.apellido_mat+'</td>'+
                                            '<td>'+json.data.puesto+'</td>'+
                                            '<td>'+json.data.departamento+'</td>'+
                                            '<td>'+hora+'</td>'+
                                            '<td>'+message+'</td>'+
                                            '</tr>';
                            $("#tbody_checkout").append(html_tr);
                            setTimeout(function(){limpiar_vista()},8000);
                            
                        }else{
                            swal('Oops!',json.message,'error');
                        }
                    },
                    //si ha ocurrido un error
                    error: function(error){                    
                        swal('Oops!','Error Fatal, consulta a suporte tecnico','error');
                        console.log(error.responseText);                  
                    }
                });

                $(this)[0].reset();      
                e.preventDefault();
            });


            /* function guardar_checada(id_usuario,id_horario,hora_c,checkout){
                f = new Date();
                var dd = f.getDate();
                var mm = f.getMonth()+1; //f es 0!
                var yyyy = f.getFullYear();

                if(dd<10) {
                    dd='0'+dd
                } 

                if(mm<10) {
                    mm='0'+mm
                } 

                hoy = yyyy+'/'+mm+'/'+dd;
                dia = get_dia_semana(f);
                var datos = "opc=guardar_checkout&id_usuario="+id_usuario+"&id_horario="+id_horario+"&fecha="+hoy+"&dia_semana="+dia+"&hora="+hora_c+"&checkout="+checkout


                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: datos,
                    dataType: "json",
                    //una vez finalizado correctamente
                    success: function(json){
                        if(json.success){
                            console.log(json.message);
                        }else{
                            swal('Oops!',json.message,'error');
                        }
                    },
                    //si ha ocurrido un error
                    error: function(error){                    
                        swal('Oops!','Error Fatal, consulta a suporte tecnico','error');
                        console.log(error.responseText);                  
                    }

            } */

            function limpiar_vista(){
                $("#foto_usuario").attr('src','');
                $("#nombre_usuario").html("");
                $("#puesto_usuario").html("");
                $("#departamento").html("");
                $("#hora_checada").html("");
                $("#texto_alerta").html("");
                $("#alerta").hide();
                $("#codigo").focus();
            }
            

            /* function validar_horario(horario,hora_c,id_usuario,id_horario){
                var message = "";
                if(id_horario == '' || id_horario == null){
                    message = "USUARIO SIN HORARIO ASIGNADO";
                    $("#texto_alerta").html(message);
                    $("#alerta").show();
                    return message;
                }else{
                    for (let i = 0; i < horario.length; i++) {
                        var h_e = horario[i].h_entrada;
                        var h_s = horario[i].h_salida;
                        var checkout = "NO SE REGISTRA";
                        var message = "";
                        
                        var dif_antes = restaH(hora_c,h_e);
                        var dif_despues = restaH(h_e,hora_c);
                        
                        if(dif_antes < 40){
                            checkout = "Entrada";
                            message = checkout;
                        }if (dif_despues < 40) {
                            checkout = "Entrada";
                            if(dif_despues > 10){
                                retardo = true;
                                message = "Retardo de "+dif_despues+" Minutos";
                            }
                        }
                        var dif_antes = restaH(hora_c,h_s);
                        var dif_despues = restaH(h_s,hora_c);

                        if(dif_antes < 40){
                            checkout = "Salida";
                            message = checkout;
                            if(dif_antes > 10){
                                salida_antes = true;
                                message = "Salida  de "+dif_despues+" Minutos antes.";
                            }

                        }if (dif_despues < 40) {
                            checkout = "Salida";
                            message = checkout;
                        }

                        if(retardo == true){
                            message = "Tienes un retardo de "+dif_despues+" Minutos.";
                            $("#texto_alerta").html(message);
                            $("#alerta").show();
                        }
                        if(salida_antes == true){
                            message = "Estas saliendo "+dif_antes+" Minutos antes.";
                            $("#texto_alerta").html(message);
                            $("#alerta").show();
                        }

                        if(checkout == "NO SE REGISTRA"){
                            message = "Fuera de tiempo admintido."
                            $("#texto_alerta").html(message);
                            $("#alerta").show();
                        }else{
                            guardar_checada(id_usuario,id_horario,hora_c,checkout);
                        }
                        return message;

                    }
                }
                
            } */

            function restaH(h1,h2){
                var h1 = h1.split(":"),
                h2 = h2.split(":"),
                t1 = new Date(),
                t2 = new Date();

                /* Asignamos Las horas */                
                t1.setHours(h1[0], h1[1], h1[2]);
                t2.setHours(h2[0], h2[1], h2[2]);
                
                //Aquí hago la resta
                t1.setHours(t1.getHours() - t2.getHours(), t1.getMinutes() - t2.getMinutes(), t1.getSeconds() - t2.getSeconds());

                //Imprimo el resultado
                var hrs = t1.getHours() * 60 + t1.getMinutes();
                return hrs;
            }


            
            

            function get_dia_semana(f){
                var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
                var dia = diasSemana[f.getDay()];
                return dia;
            }

        </script>
    </body>
</html>