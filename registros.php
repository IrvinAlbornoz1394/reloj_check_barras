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
        <link rel="stylesheet" href="vendors/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="vendors/bower_components/flatpickr/dist/flatpickr.min.css" />

        <!-- App styles -->
        <link rel="stylesheet" href="css/app.min.css">

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
                        <li><a href="index.php"><i class="zmdi zmdi-home"></i>Reloj</a></li>
                        <li><a href="usuarios.php"><i class="zmdi zmdi-accounts"></i>Usuarios</a></li>
                        <li class="navigation__active"><a href="registros.php"><i class="zmdi zmdi-home"></i>Insidencias</a></li>
                        <li><a href="horarios.php"><i class="zmdi zmdi-accounts"></i>Horarios</a></li>
                    </ul>
                </div>
            </aside>


            <section class="content content--full">
                <header class="content__title">
                    <h1>Registro de Insidencias</h1>

                    <div class="actions">
                            <a href="" class="actions__item zmdi zmdi-trending-up"></a>
                            <a href="" class="actions__item zmdi zmdi-check-all"></a>

                            <div class="dropdown actions__item">
                                <i data-toggle="dropdown" class="zmdi zmdi-more-vert"></i>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="" class="dropdown-item">Refresh</a>
                                    <a href="" class="dropdown-item">Manage Widgets</a>
                                    <a href="" class="dropdown-item">Settings</a>
                                </div>
                            </div>
                        </div>
                </header>
                
                <div class="card">
                    <div class="card-header">
                        <form action="" id="form_insidencias">
                            <div class="row align-items-end">
                                <div class="col-md-3">
                                    <label>Tipo Usuario</label>
                                    <select class="select2 form-control" name="tipo_usuario" id="select_tipo" data-minimum-results-for-search="Infinity"  required="true">
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <label>Fecha Inicio</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                        <div class="form-group">
                                            <input type="text" name="fecha_i" class="form-control date-picker" placeholder="Pick a date" required="true">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <label>Fecha Final</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="zmdi zmdi-calendar"></i></span>
                                        <div class="form-group">
                                            <input type="text" name="fecha_f" class="form-control date-picker" placeholder="Pick a date" required="true">
                                            <i class="form-group__bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label>Empleado</label>
                                    <select class="select2 form-control" id="select_usuario" name="usuario">
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-info btn--icon waves-effect"><i class="zmdi zmdi-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="tabla_insidencias" class="table table-striped table-hover">
                                <thead class="thead-default">
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Dia</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Foto</th>
                                        <th>Nombre</th>
                                        <th>Puesto</th>
                                        <th>Dia</th>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                    </tr>
                                </tfoot>
                                <tbody id="tbody_insidencias">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <footer class="footer hidden-xs-down">
                    <p>© Material Admin Responsive. All rights reserved.</p>

                    <ul class="nav footer__nav">
                        <a class="nav-link" href="">Homepage</a>

                        <a class="nav-link" href="">Company</a>

                        <a class="nav-link" href="">Support</a>

                        <a class="nav-link" href="">News</a>

                        <a class="nav-link" href="">Contacts</a>
                    </ul>
                </footer>
            </section>

            
        </main>

        <!-- ../vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        

        <!-- Vendors: Data tables -->
        <script src="vendors/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="vendors/bower_components/jszip/dist/jszip.min.js"></script>
        <script src="vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>


        <script src="vendors/bower_components/autosize/dist/autosize.min.js"></script>
        <script src="vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>

        <script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

        <script src="vendors/bower_components/flatpickr/dist/flatpickr.min.js"></script>


        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
        
        <script>
            $(document).ready(function(){
                // $("#select_tipo").select2({placeholder: 'Selecciona una opción'});    
                $("#select_usuario").select2({placeholder: 'Selecciona una opción'});    
                get_tipo_usuarios();
            });
            
            $("#select_tipo").change(function(){
                var id_tipo = $(this).val();
                get_empleados(id_tipo);
            });

            $("#form_insidencias").on('submit',function(e){
                var datos = $(this).serialize();
                datos += '&opc=get_tabla_insidencias';
                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: datos,
                    dataType: "json",
                    //una vez finalizado correctamente
                    success: function(json){
                        if(json.success){
                            console.log(json);
                            set_tabla(json.data);
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
                e.preventDefault();
            })

            function get_tipo_usuarios(){
                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: "opc=get_tipo_usuarios",
                    dataType: "json",
                    //una vez finalizado correctamente
                    success: function(json){
                        if(json.success){
                            var li_tipo_usuarios = "<option value=''></option>";
                            for (let i = 0; i < json.data.length; i++) {
                                li_tipo_usuarios += '<option value ="'+json.data[i].id_tipo+'">'+json.data[i].nombre_tipo+'</option>';
                            }
                            $("#select_tipo").html(li_tipo_usuarios);
                            $("#select_tipo").select2({placeholder: 'Selecciona una opción'});

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
            }

            function get_empleados(id){
                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: 'opc=get_nom_usuarios&id_tipo='+id,
                    dataType: "json",
                    success: function(json){
                        console.log(json);
                        var html = "<option value='0'>TODOS</option>";
                        for (var i = 0; i < json.data.length; i++) {
                            html += '<option value="'+json.data[i].id_usuario+'">'+json.data[i].nombres+' '+json.data[i].apellido_pat+' '+json.data[i].apellido_mat+'</option>';
                        }
                        $("#select_usuario").html(html);
                        $("#select_usuario").select2({placeholder: 'Selecciona una opción'});    ;
                    },
                    error:function(error){

                    }
                });
            }

            function set_tabla(data){
                var tabla = "";
                for (var i = 0; i < data.length; i++) {
                    var foto = "img/usuarios/"+data[i].foto;
                    tabla += "<tr>"+
                                "<td><img src='"+foto+"' class='messages__avatar'/></td>"+
                                "<td>"+data[i].nombres+" "+data[i].apellido_pat+" "+data[i].apellido_mat+"</td>"+
                                "<td>"+data[i].puesto+"</td>"+
                                "<td>"+data[i].dia+"</td>"+
                                "<td width='15%'>"+data[i].fecha+"</td>"+
                                "<td>"+data[i].check+"</td>"+
                             "</tr>";
                }
                $("#tbody_insidencias").html(tabla);
                $("#tabla_insidencias").DataTable();

                // <th>Foto</th>
                // <th>Nombre</th>
                // <th>Puesto</th>
                // <th>Dia</th>
                // <th>Fecha</th>
                // <th>Hora</th>
            }
        </script>

    </body>
</html>