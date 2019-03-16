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
                        <li><a href="index.php"><i class="zmdi zmdi-home"></i>Reloj</a></li>
                        <li class="navigation__active"><a href="usuarios.php"><i class="zmdi zmdi-accounts"></i>Usuarios</a></li>
                    </ul>
                </div>
            </aside>


            <section class="content content--full">
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Empleados</h1>

                        <div class="actions">
                            <button class="btn btn-primary btn--icon-text waves-effect"><i class="zmdi zmdi-plus"></i> Agregar Nuevo</button>
                        </div>
                    </header>

                    <div class="toolbar">
                        <nav class="toolbar__nav">
                            <a class="active" href="">Empleados</a>
                            <a href="groups.html">Departamentos</a>
                        </nav>

                        <div class="toolbar__search">
                            <input type="text" placeholder="Search...">

                            <i class="toolbar__search__close zmdi zmdi-long-arrow-left" data-ma-action="toolbar-search-close"></i>
                        </div>
                    </div>

                    <div class="contacts row" id="contenido_usuarios">
                        
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


        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>

        <script>
            $(document).ready(function(){
                get_usuarios();
            });


            function get_usuarios(){
                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: 'opc=get_usuarios',
                    dataType: "json",
                    success: function(json){
                        console.log(json);
                        var html = "";
                        for (var i = 0; i < json.data.length; i++) {
                            // html += '<tr>'+
                            //         '<td>'+json.data[i].id_usuario+'</td>'+
                            //         '<td></td>'+
                            //         '<td>'+json.data[i].nombres+' '+json.data[i].apellido_pat+' '+json.data[i].apellido_mat+'</td>'+
                            //         '<td>'+json.data[i].puesto+'</td>'+
                            //         '<td>'+json.data[i].departamento+'</td>'+
                            //         '<td>'+json.data[i].tipo_usuario+'</td>'+
                            //         '<td></td>'+
                            //         '</tr>';

                            html += '<div class="col-xl-2 col-lg-3 col-sm-4 col-6">'+
                                        '<div class="contacts__item">'+
                                            '<a href="" class="contacts__img">'+
                                                '<img src="demo/img/contacts/1.jpg" alt="">'+
                                            '</a>'+
                                            '<div class="contacts__info">'+
                                                '<strong>'+json.data[i].nombres+' '+json.data[i].apellido_pat+' '+json.data[i].apellido_mat+'</strong>'+
                                                '<small>'+json.data[i].puesto+'</small>'+
                                            '</div>'+
                                            '<button class="contacts__btn">Following</button>'+
                                        '</div>'+
                                    '</div>';

                        }
                        // $("#tbody_usuarios").html(html);
                        $("#contenido_usuarios").html(html);

                    },
                    error: function(error){

                    }
                })
            }


        </script>

    </body>
</html>