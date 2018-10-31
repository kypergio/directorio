<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin Dashboard | </title>

    <!-- Bootstrap core CSS -->

    <link href="/admin/css/bootstrap.min.css" rel="stylesheet">

    <link href="/admin/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="/admin/css/animate.min.css" rel="stylesheet">

    <!-- Custom styling plus plugins -->
    <link href="/admin/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/admin/css/maps/jquery-jvectormap-2.0.3.css"/>
    <link href="/admin/css/icheck/flat/green.css" rel="stylesheet">
    <link href="/admin/css/floatexamples.css" rel="stylesheet"/>

    <link href="/admin/js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css"/>

    <script src="/admin/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
    <script src="assets/js/ie8-responsive-file-warning.js"></script>
    <![endif]-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="nav-md">

<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{route("admin.home")}}" class="site_title"><i class="fa fa-paw"></i>
                        <span>Administración</span></a>
                </div>
                <div class="clearfix"></div>
                <!-- menu prile quick info -->
                <div class="profile">
                    <div class="profile_pic">
                        <img src="/admin/images/avatar5.png" alt="..." class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenido,</span>
                        <h2>{{ ucfirst(Auth::user()->name)  }}</h2>
                    </div>
                </div>
                <!-- /menu prile quick info -->

                <br/>
                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>&nbsp;</h3>
                        <ul class="nav side-menu">
                            <li {{ ActiveRoute::areActiveRoutes(["user.index","user.edit","user.create"], "data-customclass=active") }}><a><i
                                            class="fa fa-users"></i> Control de Usuarios <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('user.create') }}"><i class="fa fa-plus"
                                                                                style="width:15px;font-size: 15px"></i>
                                            Agregar usuarios</a></li>
                                    <li><a href="{{ route('user.index') }}"><i class="fa fa-list"
                                                                               style="width:15px;font-size: 15px"></i>
                                            Gestionar Usuarios</a></li>
                                </ul>
                            </li>
                            <li {{ ActiveRoute::isActiveRoute("contact.index", "data-customclass=active") }}><a><i
                                            class="fa fa-users"></i> Detalles de Contacto <span
                                            class="fa fa-chevron-down"></span></a>
                                <ul class="nav child_menu" style="display: none">
                                    <li><a href="{{ route('contact.index') }}">
                                            <i class="fa fa-list" style="width:15px;font-size: 15px"></i>
                                            Detalles de Contacto</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /sidebar menu -->
            </div>
        </div>
        <!-- top navigation -->
        <div class="top_nav">
            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="">
                            <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                               aria-expanded="false">
                                <img src="/admin/images/img.jpg" alt="">{{ ucfirst(Auth::user()->name)  }}
                                <span class=" fa fa-angle-down"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                <!-- <li><a href="javascript:;">  Profile</a> -->
                                <!-- </li> -->
                                <li>
                                    <a href="{{ route("admin.change-username") }}">
                                        <span>Cambie el nombre de usuario</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route("admin.change-password") }}">
                                        <span>Cambiar contraseña</span>
                                    </a>
                                </li>

                                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out pull-right"></i> Salir</a>
                                </li>
                            </ul>
                        </li>

                        <li role="presentation" class="dropdown">

                        </li>

                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->


        <!-- page content -->
        <div class="right_col" role="main"><br/>

            @yield('pagecontent')

        </div>
        <!-- /page content -->
    </div>


</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>

<script src="/admin/js/bootstrap.min.js"></script>
<script src="/admin/js/nicescroll/jquery.nicescroll.min.js"></script>

<!-- bootstrap progress js -->
<script src="/admin/js/progressbar/bootstrap-progressbar.min.js"></script>
<!-- icheck -->
<script src="/admin/js/icheck/icheck.min.js"></script>
<!-- daterangepicker -->
<script type="text/javascript" src="/admin/js/moment/moment.min.js"></script>
<script type="text/javascript" src="/admin/js/datepicker/daterangepicker.js"></script>
<!-- chart js -->
<script src="/admin/js/chartjs/chart.min.js"></script>
<!-- sparkline -->
<script src="/admin/js/sparkline/jquery.sparkline.min.js"></script>

<script src="/admin/js/custom.js"></script>

<!-- flot js -->
<!--[if lte IE 8]>
<script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
<script type="text/javascript" src="/admin/js/flot/jquery.flot.js"></script>
<script type="text/javascript" src="/admin/js/flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="/admin/js/flot/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="/admin/js/flot/jquery.flot.time.min.js"></script>
<script type="text/javascript" src="/admin/js/flot/date.js"></script>
<script type="text/javascript" src="/admin/js/flot/jquery.flot.spline.js"></script>
<script type="text/javascript" src="/admin/js/flot/jquery.flot.stack.js"></script>
<script type="text/javascript" src="/admin/js/flot/curvedLines.js"></script>
<script type="text/javascript" src="/admin/js/flot/jquery.flot.resize.js"></script>


<script src="/admin/js/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/js/datatables/dataTables.bootstrap.js"></script>


<!-- pace -->
<script src="/admin/js/pace/pace.min.js"></script>
<script src="/admin/js/jquery.validate.js"></script>
<!-- flot -->


@yield('footer_scripts')
</body>

</html>
