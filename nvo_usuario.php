<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">
        <link rel="stylesheet" href="vendors/bower_components/select2/dist/css/select2.min.css">
        <link rel="stylesheet" href="vendors/bower_components/dropzone/dist/dropzone.css">
        <link rel="stylesheet" href="vendors/bower_components/flatpickr/dist/flatpickr.min.css" />
        <link rel="stylesheet" href="vendors/bower_components/nouislider/distribute/nouislider.min.css">
        <link rel="stylesheet" href="vendors/bower_components/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css">
        <link rel="stylesheet" href="vendors/bower_components/trumbowyg/dist/ui/trumbowyg.min.css">
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
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-10">
                                <h2 class="card-title">Informacion de Usuario</h2>
                                <small class="card-subtitle">Alta de nuevos usuarios</small>
                            </div>
                            <div class="col-md-2">
                                <select class="select2" data-minimum-results-for-search="Infinity">
                                    <option value="1">Merida I</option>
                                    <option value="2">Merida II</option>
                                    <option value="3">Merida III</option>
                                    <option value="4">Valladolid</option>
                                    <option value="5">Tizimin</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="" autocomplete="off" id="form_usuario">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <img src="img/usuarios/usuario.png" alt="" class="img-fluid" id="foto_usuario">
                                    <input type="file" accept="image/*" hidden="true" class="input_fie" id="input_subir_foto">
                                    <input type="file" accept="image/*" capture="" hidden="true" class="input_fie" id="input_tomar_foto">
                                    <button class="mt-3 btn btn-primary btn--icon-text waves-effect" id="btn_subir_foto">
                                        <i class="zmdi zmdi-upload"></i> Subir Foto
                                    </button>
                                    <button class="mt-3 btn btn-success btn--icon-text waves-effect  d-sm-none" id="btn_tomar_foto">
                                        <i class="zmdi zmdi-camera"></i>Tomar Foto
                                    </button>
                                    


                                </div>
                                <div class="col-md-9 b-l">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-group--float">
                                                <input type="text" class="form-control form-control-lg" name="nombres" id="nombres">
                                                <label>Nombres</label>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group--float">
                                                <input type="text" class="form-control form-control-lg" name="apellido_pat" id="apellido_pat">
                                                <label>Apellido Paterno</label>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-group--float">
                                                <input type="text" class="form-control form-control-lg" name="apellido_mat" id="apellido_mat">
                                                <label>Apellido Materno</label>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Departamento</label>
                                                <select class="select2" name="departamento" id="select_departamento">
                                                    <option value="">Informatica</option>
                                                    <option value="">Finanzas</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-group--float">
                                                <input type="text" class="form-control form-control-lg" name="puesto" id="puesto">
                                                <label>Puesto</label>
                                                <i class="form-group__bar"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Tipo Usuario</label>
                                                <select class="select2" name="tipo_usuario" data-minimum-results-for-search="Infinity" id="select_tipo_usuario">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 col-md-2">
                                            <h4 class="card-block__title">Administrador</h4>
                                            <br>
                                            <div class="form-group">
                                                <div class="toggle-switch">
                                                    <input type="checkbox" name="admin" class="toggle-switch__checkbox" id="on_off_admin">
                                                    <i class="toggle-switch__helper"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-10" id="datos_administrador" style="display:none;">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group form-group--float">
                                                        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control form-control-lg">
                                                        <label>Nombre Usuario</label>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group--float">
                                                        <input type="password" name="password" id="password" class="form-control form-control-lg" autocomplete="new-password">
                                                        <label>Contraseña</label>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group form-group--float">
                                                        <input type="password" name="confirm_password" id="confirm_password" class="form-control form-control-lg" autocomplete="new-password">
                                                        <label>Confirmar Contraseña</label>
                                                        <i class="form-group__bar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <button class="mt-3 btn btn-success btn-lg btn--icon-text waves-effect"><i class="zmdi zmdi-save"></i>Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

            
        </main>

        <!-- Vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <script src="vendors/bower_components/jquery-mask-plugin/dist/jquery.mask.min.js"></script>
        <script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
        <script src="vendors/bower_components/dropzone/dist/min/dropzone.min.js"></script>
        <script src="vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="vendors/bower_components/flatpickr/dist/flatpickr.min.js"></script>
        <script src="vendors/bower_components/nouislider/distribute/nouislider.min.js"></script>
        <script src="vendors/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
        <script src="vendors/bower_components/trumbowyg/dist/trumbowyg.min.js"></script>

        <script src="vendors/bower_components/autosize/dist/autosize.min.js"></script>
        <script src="vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>

        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
        
        <script>
            var id_edit  = getParameterByName('id');
            if(id_edit !== ''){
                get_usuario();
            }
            $(document).ready(function(){
                get_tipo_usuarios();
                get_departamentos();
            });

            $("#on_off_admin").click(function(){
                if($(this).prop('checked')){
                    $("#datos_administrador").show();
                }else{
                    $("#datos_administrador").hide();
                }
            });

            $("#btn_subir_foto").click(function(e){
                e.preventDefault();
                $("#input_subir_foto").click();
            });

            $("#btn_tomar_foto").click(function(e){
                e.preventDefault();
                $("#input_tomar_foto").click();
            });
        

            $("#input_subir_foto").change(function () {
                $(".input_fie").attr('name','');
                $(this).attr('name','foto_usuario');
                /* $('img#foto_usuario').attr('src','../img/cargando.gif'); */
                setTimeout(readURL(this), 1000);
                // readURL(this);
            });

            $("#input_tomar_foto").change(function () {
                $(".input_fie").attr('name','');
                $(this).attr('name','foto_usuario');
                /* $('img#foto_usuario').attr('src','../img/cargando.gif'); */
                setTimeout(readURL(this), 1000);
                // readURL(this);
            });

            $("#form_usuario").on('submit',function(e){
                var formData = new FormData($(this)[0]);
                formData.append('id_usuario',id_edit);
                var message = ""; 
                console.log(formData);
                //hacemos la petición ajax  
                $.ajax({
                    url: "php/funciones.php?opc=guardar_usuario",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    cache: false,
                    contentType: false,
                    processData: false,
                    //mientras enviamos el archivo
                    beforeSend: function(){
                        swal({
                            title: 'Espera un momento',
                            text: 'Guardando información',
                            showCancelButton: false,
                            showConfirmButton: false,
                            imageUrl: '../img/cargando.gif',
                            });
                    },
                    //una vez finalizado correctamente
                    success: function(json){
                        if(json.success){
                            swal('Coreecto',json.message,'success');
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
            });

            function readURL(input) {
                console.log("subir");
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('img#foto_usuario').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

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
                        $("#select_tipo_usuario").html(li_tipo_usuarios);
                        $("#select_tipo_usuario").select2({placeholder: 'Selecciona una opción'});

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

            function get_departamentos(){
                $.ajax({
                url: "php/funciones.php",
                type: "POST",
                data: "opc=get_departamentos",
                dataType: "json",
                //una vez finalizado correctamente
                success: function(json){
                    if(json.success){
                        var li_departamento = "<option value=''></option>";
                        for (let i = 0; i < json.data.length; i++) {
                            li_departamento += '<option value ="'+json.data[i].id_departamento+'">'+json.data[i].nombre_departamento+'</option>';
                        }
                        $("#select_departamento").html(li_departamento);
                        $("#select_departamento").select2({placeholder: 'Selecciona una opción'});

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

            function getParameterByName(name) {
                name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
                results = regex.exec(location.search);
                return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            function get_usuario(){
                $.ajax({
                url: "php/funciones.php",
                type: "POST",
                data: "opc=get_usuario&idu="+id_edit,
                dataType: "json",
                //una vez finalizado correctamente
                success: function(json){
                    if(json.success){
                        var img = 'img/usuarios/'+json.data.file_foto;
                        $("#foto_usuario").attr('src',img);
                        $("#nombres").val(json.data.nombres);
                        $("#apellido_pat").val(json.data.apellido_pat);
                        $("#apellido_mat").val(json.data.apellido_mat);
                        $("#puesto").val(json.data.puesto);
                        $("#nombre_usuario").val(json.data.clave);
                        $("#password").val(json.data.password);
                        $("#confirm_password").val(json.data.password);
                        if(json.data.admin){
                            $("#on_off_admin").attr('checked',true);
                            $("#datos_administrador").show();
                        }

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
        </script>

    </body>
</html>