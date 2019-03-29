<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Vendor styles -->
        <link rel="stylesheet" href="vendors/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css">
        <link rel="stylesheet" href="vendors/bower_components/animate.css/animate.min.css">
        <link rel="stylesheet" href="vendors/bower_components/fullcalendar/dist/fullcalendar.min.css">
        <link rel="stylesheet" href="vendors/bower_components/sweetalert2/dist/sweetalert2.min.css">
        <link rel="stylesheet" href="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.css">




        <!-- Extras unicamente para el time line  -->
        <link href='vendors/time-line/core/main.css' rel='stylesheet' />
        <link href='vendors/time-line/daygrid/main.css' rel='stylesheet' />
        <link href='vendors/time-line/timegrid/main.css' rel='stylesheet' />
        <link href='vendors/time-line/list/main.css' rel='stylesheet' />
        <link href='vendors/time-line/timeline/main.css' rel='stylesheet' />
        <link href='vendors/time-line/resource-timeline/main.css' rel='stylesheet' />
        <script src='vendors/time-line/core/main.js'></script>
        <script src='vendors/time-line/interaction/main.js'></script>
        <script src='vendors/time-line/daygrid/main.js'></script>
        <script src='vendors/time-line/timegrid/main.js'></script>
        <script src='vendors/time-line/list/main.js'></script>
        <script src='vendors/time-line/timeline/main.js'></script>
        <script src='vendors/time-line/resource-common/main.js'></script>
        <script src='vendors/time-line/resource-timeline/main.js'></script>


        <link rel="stylesheet" href="css/app.min.css">
        <style>
            #div_alto{
                
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
                        <li><a href="usuarios.php"><i class="zmdi zmdi-accounts"></i>Usuarios</a></li>
                        <li><a href="registros.php"><i class="zmdi zmdi-home"></i>Insidencias</a></li>
                        <li class="navigation__active"><a href="horarios.php"><i class="zmdi zmdi-accounts"></i>Horarios</a></li>
                        <li><a href="registros.php"><i class="zmdi zmdi-home"></i>Horas</a></li>
                    </ul>
                </div>
            </aside>


             <section class="content content--full">
                <div class="content__inner">
                    <header class="content__title">
                        <h1>Messages</h1>

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

                    <div class="messages">
                        <div class="messages__sidebar">
                            <div class="toolbar toolbar--inner mb-3">
                                <div class="toolbar__label">Horarios Existentes</div>
                                <div class="actions toolbar__actions">
                                    <button class="btn btn-info btn--icon waves-effect" id="add_horario"><i class="zmdi zmdi-plus zmdi-hc-fw"></i></button>
                                </div>
                            </div>
                            <form action="" class="col-md-12" id="form_horario_nvo" style="display: none;">
                                <div class="input-group">
                                    <input type="text" name="nombre_horario" class="form-control" id="nombre_horario" autocomplete="off">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-success waves-effect">
                                            <i class="zmdi zmdi-save zmdi-hc-fw"></i>
                                        </button>
                                    </span>
                                </div>
                            </form>
                            
                            <div class="listview listview--hover table-responsive" id="div_alto">
                                <table class="table table-bordered">
                                    <tbody id="tbody_horarios">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="messages__body">
                            <div class="messages__header">
                                <div class="toolbar toolbar--inner mb-0">
                                    <div class="toolbar__label">Horas Asignadas al Horario</div>

                                    <div class="actions toolbar__actions">
                                        <button class="btn btn-success" id="btn-modal-horario"> <i class="fa fa-plus"></i> Borrar Horas
                                            <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                        </button>
                                        <button class="btn btn-success" id="btn-modal-horario"> <i class="fa fa-plus"></i> Gestionar Horas
                                            <i class="zmdi zmdi-time zmdi-hc-fw"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="messages__content">
                                <div id='calendar'></div>
                            </div>

                            <div class="messages__reply">
                                <textarea class="messages__reply__text" placeholder="Type a message..."></textarea>
                                <button class="btn btn-success btn--icon messages__reply__btn"><i class="zmdi zmdi-mail-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Large -->
            <div class="modal fade" id="modal-horario" tabindex="-1">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title pull-left">Lista de horarios desponibles</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-3 b-r" >
                                    <table class="table">
                                        <tr>
                                            <th>Horario</th>
                                        </tr>
                                    </table>
                                    <div class="table-responsive" id="div_responsive">
                                        <table class="table table-hover table-bordered">
                                            <!-- <tbody id="tbody_horarios">
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                                <tr class="b-b">
                                                    <td>09:00 - 17:00</td>
                                                </tr>
                                            </tbody> -->
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <table class="table mb-0 table-striped" id="table_horas">
                                        <thead>
                                            <tr>
                                                <th>Dia</th>
                                                <th>Horas asignadas</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th>Lunes</th>
                                                <td>
                                                    <span class="badge badge-pill badge-primary">10:00-11:50</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Martes</th>
                                                <td>
                                                    <span class="badge badge-pill badge-primary">10:00-11:50</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Miercoles</th>
                                                <td>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Jueves</th>
                                                <td>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Viernes</th>
                                                <td>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                    <span class="badge badge-pill badge-primary">11:50-1:30</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Sabado</th>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Domingo</th>
                                                <td>
                                                    
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            
                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>

            
        </main>

        <!-- ../vendors -->
        <script src="vendors/bower_components/jquery/dist/jquery.min.js"></script>
        <script src="vendors/bower_components/tether/dist/js/tether.min.js"></script>
        <script src="vendors/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="vendors/bower_components/Waves/dist/waves.min.js"></script>
        <script src="vendors/bower_components/jquery.scrollbar/jquery.scrollbar.min.js"></script>
        <script src="vendors/bower_components/jquery-scrollLock/jquery-scrollLock.min.js"></script>

        <script src="vendors/bower_components/moment/min/moment.min.js"></script>
        <script src="vendors/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="vendors/bower_components/autosize/dist/autosize.min.js"></script>
        <script src="vendors/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>



        <!-- App functions and actions -->
        <script src="js/app.min.js"></script>
        <script src="js/funciones.js"></script>

        <script>
            var horarios = "";
            var id_horario = "";
             $(document).ready(function(){
                json = get_horarios_completos();
                set_tabla_horarios(json);
                var h = $("#div_alto").height();
                $("#div_alto").height(h - 100);
            });


            function set_tabla_horarios(json){
                if(json.success){
                    console.log(json);
                    var html = "";
                    for (var i = 0; i < json.data.length; i++) {
                            html += '<tr>'+
                             '<td>'+json.data[i].nombre_horario+'</td>'+
                             '</tr>';
                    }
                    $("#tbody_horarios").html(html);
                }
            }

            $("#add_horario").click(function(){
                $(this).attr('disabled',true);
                $("#form_horario_nvo").show();
            });

            $("#form_horario_nvo").on('submit',function(e){
                console.log('ok');
                var datos = $(this).serialize();
                datos+= "&id_horario="+id_horario+"&opc=guardar_nom_horario";
                $.ajax({
                    url: "php/funciones.php",
                    type: "POST",
                    data: datos,
                    dataType: "json",
                    success: function(json){
                        if(json.success){
                            swal('Correcto!',json.message,'success');    
                        }else{
                            swal('Oops!',json.message,'error');
                        }
                        
                    },
                    error:function(error){
                        swal('Oops!',error,'error');
                    },
                });
                e.preventDefault();
            });

        </script>

        <script>
            var horaE = '09:00:00';
            var horaS = '17:00:00';
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                  schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                  plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list', 'resourceTimeline' ],
                  
                  scrollTime: '06:00', // undo default 6am scrollTime
                  defaultView: 'resourceTimelineDay',
                  resourceLabelText: 'Dia',
                  resourceAreaWidth: "10%",
                  header: {
                    left: '',
                    center: '',
                    right: ''
                  },
                  resources: [
                    { id: 'lun', title: 'Lunes' },
                    { id: 'mar', title: 'Martes', eventColor: 'green' },
                    { id: 'mie', title: 'Miercoles', eventColor: 'orange' },
                    { id: 'jue', title: 'Jueves' },
                    { id: 'vie', title: 'Viernes' },
                    { id: 'sab', title: 'Sabado' },
                    { id: 'dom', title: 'Domingo' }
                  ],
                  events: [
                    { id: '1', resourceId: 'lun', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: '02:30 - 17:25' },
                    { id: '2', resourceId: 'mar', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: 'event 2' },
                    { id: '3', resourceId: 'mie', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: 'event 3' },
                    { id: '4', resourceId: 'jue', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: 'event 4' },
                    { id: '4', resourceId: 'vie', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: 'event 4' },
                    { id: '5', resourceId: 'sab', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: 'event 5' },
                    { id: '4', resourceId: 'Dom', start: '2019-03-29T'+horaE, end: '2019-03-29T'+horaS, title: 'event 4' }
                  ]
                });
                calendar.render();
            });
        </script>
    </body>
</html>
