<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark z-index-9  fixed-top" id="mainNav">

    <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav navbar-sidenav background-main-color admin-nav" id="admin-nav">
            <li class="nav-item">
                <span class="nav-title-text">PRINCIPAL</span>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link {{ActiveRoute::isActiveRoute("user.dashboard")}}"
                   href="{{ route('user.dashboard') }}">
                    <i class="fas fa-fw fa-home"></i><span class="nav-link-text">Inicio</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
                <a class="nav-link {{ActiveRoute::isActiveRoute("user.userreviewsFromme")}}"
                   href="{{ route('user.userreviewsFromme') }}">
                    <i class="fa fa-fw fa-star"></i>
                    <span class="nav-link-text">Reseñas hechas por mi</span>
                </a>
            </li>
            @if(Auth::user()->type == 2 || Auth::user()->type == 3)
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reviews">
                    <a class="nav-link {{ActiveRoute::isActiveRoute("user.userreviewsTome")}}"
                       href="{{ route('user.userreviewsTome') }}">
                        <i class="fa fa-fw fa-star"></i>
                        <span class="nav-link-text">Reseñas de mi servicio</span>
                    </a>
                </li>
            @endif
            <li class="nav-item">
                <span class="nav-title-text">USUARIO</span>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Profile">
                <a class="nav-link {{ActiveRoute::isActiveRoute("user.editprofile")}}"
                   href="{{ route('user.editprofile')}}">
                    <i class="fa fa-fw fa-user-circle"></i>
                    <span class="nav-link-text">Mi perfil</span>
                </a>
            </li>
            @if(Auth::user()->type == 2 || Auth::user()->type == 3)
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="My Location">
                    <a class="nav-link" href="{{ route('user.profiledetails', ["string" => Auth::user()->userslug])}}"
                       target="_blank">
                        <i class="fa fa-fw fa-user"></i>
                        <span class="nav-link-text">Visitar mi perfil</span>
                    </a>
                </li>
            @endif
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sing Out">
                <a class="nav-link {{ActiveRoute::isActiveRoute("user.changepassword")}}"
                   href="{{ route('user.changepassword') }}">
                    <i class="fa fa-fw fa-sign-out-alt"></i>
                    <span class="nav-link-text">Cambiar Contraseña</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Sing Out">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="fa fa-fw fa-sign-out-alt"></i>
                    <span class="nav-link-text">Salir</span>
                </a>
            </li>
            @if( Auth::user()->address == '' && (Auth::user()->type == 2 || Auth::user()->type == 3))
                <li class="alert alert-warning">

                    Por favor agrega tu dirección par que tu perfil pueda salir en resultados de búsquedas.
                    <a href="{{ route('user.userlocation') }}">
                        Presiona aquí
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>