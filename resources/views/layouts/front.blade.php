<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>My Directory</title>
    <meta name="author" content="My-Theme">
    <meta name="robots" content="index follow">
    <meta name="googlebot" content="index follow">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="keywords"
          content="directory, doctor, doctor directory, Health directory, listing, map, medical, medical directory, professional directory, reservation, reviews">
    <meta name="description" content="Health Care & Medical Services Directory">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!---------------------->
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="Ultherapy"/>
    <meta property="og:description" content="Descripción"/>
    <meta property="og:image" content="link a logo"/>
    <meta property="og:url" content="http>//ultherapy.mx"/>
    <meta property="og:site_name" content="Ultherapy"/>

    <meta name="twitter:title" content="Ultherapy">
    <meta name="twitter:description" content="Descripción">
    <meta name="twitter:image" content="Link a logo">
    <meta name="twitter:site" content="@ultherapy">
    <meta name="twitter:creator" content="@ultherapy">
    <!---------------------->


    <link rel="icon" href="/front/assets/img/favicon.ico" type="image/x-icon"/>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7CPoppins:300i,300,400,700,400i,500%7CDancing+Script:700%7CDancing+Script:700"
          rel="stylesheet">
    <!-- animate -->
    <link rel="stylesheet" href="/front/assets/css/animate.css"/>
    <!-- owl Carousel assets -->
    <link href="/front/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="/front/assets/css/owl.theme.css" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="/front/assets/css/bootstrap.min.css">
    <!-- hover anmation -->
    <link rel="stylesheet" href="/front/assets/css/hover-min.css">
    <!-- flag icon -->
    <link rel="stylesheet" href="/front/assets/css/flag-icon.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="/front/assets/css/style.css">
    <!-- colors -->
    <link rel="stylesheet" href="/front/assets/css/colors/main.css">
    <!-- elegant icon -->
    <link rel="stylesheet" href="/front/assets/css/elegant_icon.css">

    <!-- main style -->
    <link rel="stylesheet" href="/front/assets/css/custom.css">
    <link rel="stylesheet" href="/front/assets/css/sb-admin.css">

@yield('styles')


<!-- jquery library  -->
    <script src="/front/assets/js/jquery-3.2.1.min.js"></script>

    <!-- Maps library  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL5Ae9Mv4lqPyQ1wD3NUhHkpmuX85DFo4&libraries=places"></script>
    <script src="/front/assets/js/jquery.gomap-1.3.3.min.js"></script>

    <!-- fontawesome  -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script>
        var base_url = '{{ url('/') }}';
    </script>
</head>

<body>

<header class="background-white box-shadow">
    <div class="container header-in">


        <div class="row">
            <div class="col-lg-2 col-md-12">
                <a id="logo" href="{{ url('/') }}" class="d-inline-block margin-tb-15px"><img
                            src="/front/assets/img/logo-1.png" alt=""></a>
                <a class="mobile-toggle padding-13px background-main-color" href="#"><i class="fas fa-bars"></i></a>
            </div>
            <div class="col-lg-10 col-md-12 position-inherit">
                <ul id="menu-main" class="nav-menu float-lg-right link-padding-tb-20px">
                    <li><a href="{{ url('') }}"><i class="fa fa-home"></i> @lang('labels.home')</a></li>
                    <li><a href="{{ url('/about-us') }}"> @lang('labels.about_us')</a></li>
                    <li><a href="{{ url('/contact-us') }}">@lang('labels.contact_us')</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-12 d-none">
                @if(Auth::user() )
                    @if(Auth::user() && Auth::user()->type == 1)
                        <a href="{{ url('/admin') }}"
                           class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-20px">
                            <i class="fa fa-user"></i> @lang('labels.dashboard')
                        </a>
                        <div class="nav-item float-left">
                            <a href="{{ url('/logout') }}" class="nav-link margin-top-10px">
                                <div class="text-grey-3"><i class="fa fa-fw fa-sign-out-alt"></i>@lang('labels.logout')
                                </div>
                            </a>
                        </div>
                    @else
                        <a href="{{ url('/mydashboard') }}"
                           class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-20px">
                            <i class="fa fa-user"></i> @lang('labels.dashboard')
                        </a>
                        <div class="nav-item float-left">
                            <a href="{{ url('/logout') }}" class="nav-link margin-top-10px">
                                <div class="text-grey-3"><i class="fa fa-fw fa-sign-out-alt"></i>@lang('labels.logout')
                                </div>
                            </a>
                        </div>
                    @endif

                @else
                    <a href="{{ url('/login') }}"
                       class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-30px">
                        <i class="fa fa-user"></i> @lang('labels.login')
                    </a>
                    <a href="{{ url('/register') }}"
                       class="padding-lr-0px margin-left-30px margin-tb-20px d-inline-block text-up-small float-left float-lg-right"><i
                                class="far fa-user"></i> @lang('labels.signup')</a>&nbsp;
                @endif

            </div>
        </div>

    </div>
</header>
<!-- // Header  -->

@yield('content')
@if(Request::segment(1) != 'mydashboard')
    <!-- Footer -->
    <footer class="c-footer js-footer">
        <div class="c-footer_principal">
            <div class="l-wrapper">
                <div class="c-footer_column c-footer_column-social">
                    <div class="c-footer_column-content">
                        <div class="c-footer_column-img c-footer_social">
                            <a href="" class="c-footer_social-twitter fake-invisible  js-footer-social"
                               data-social="twitter">
                                <img src="https://ultherapy.mx/images/shared/social_icons/u_social_icon-twitter.svg">
                            </a>
                            <a href="https://www.facebook.com/UltherapyMexicoOficial/" target="_blank"
                               class="c-footer_social-facebook js-footer-social" data-social="facebook">
                                <img src="https://ultherapy.mx/images/shared/social_icons/u_social_icon-facebook.svg">
                            </a>
                            <a href="" class="c-footer_social-instagram fake-invisible  js-footer-social"
                               data-social="instagram">
                                <img src="https://ultherapy.mx/images/shared/social_icons/u_social_icon-instagram.svg">
                            </a>
                        </div>
                        <div>Síguenos en las redes</div>
                    </div>
                </div>
                <div class="c-footer_column c-footer_column-how_works js-footer-submenu"
                     data-submenu="Ultrasonido microfocalizado">
                    <div class="c-footer_column-content">
                        <a href="https://ultherapy.mx/como-funciona-un-lifting-facial-sin-cirugia">
                            <div class="c-footer_column-img">
                                <img src="https://ultherapy.mx/images/ultherapy_logo-no_slogan.png"
                                     alt="Ultherapy, la evolución del lifting"
                                     title="Haz que tu rostro luzca más joven con Ultherapy">
                            </div>
                            <div>Ultrasonido<br>microfocalizado</div>
                        </a>
                    </div>
                </div>
                <div class="c-footer_column c-footer_column-where_find js-footer-submenu"
                     data-submenu="Un especialista cerca de ti">
                    <div class="c-footer_column-content">
                        <a href="https://ultherapy.mx/solicitar-cita-lifting-sin-cirugia">
                            <div class="c-footer_column-img">
                                <img src="https://ultherapy.mx/images/shared/map/u_search-icon_yellow.png">
                            </div>
                            <div>Un especialista<br>cerca de ti</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="l-wrapper">
                <div class="c-footer_sitemap">
                    <div class="c-footer_sitemap-logo">
                        <img src="https://ultherapy.mx/images/ultherapy_logo.svg">
                    </div>
                    <div class="c-footer_sitemap-links js-footer-links">
                        <ul>
                            <li><a href="https://ultherapy.mx/como-funciona-un-lifting-facial-sin-cirugia">Cómo
                                    funciona</a></li>
                            <li><a href="https://ultherapy.mx/beneficios-lifting-facial-sin-cirugia">Antes y después</a>
                            </li>
                            <li><a href="https://ultherapy.mx/resultados-lifting-facial">Resultados</a></li>
                        </ul>
                        <ul>
                            <li><a href="https://ultherapy.mx/solicitar-cita-lifting-sin-cirugia">Encuentra un
                                    doctor</a></li>
                            <li><a href="https://ultherapy.mx/preguntas-sobre-lifting-facial">Preguntas frecuentes</a>
                            </li>
                            <li><a href="https://ultherapy.mx/como-identificar-un-tratamiento-ulthera-original">Ultherapy®
                                    El original</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="c-footer_terms">
            <div class="c-footer_terms-border">
                <div class="l-wrapper">
                    <div class="c-footer_terms-copyright">© 2018 Merz Pharma</div>
                    <div class="c-footer_terms-links">
                        <a href="https://ultherapy.mx/referencias">Referencias</a>
                        <a target="_blank"
                           href="https://ultherapy.mx/files/ultherapy-aviso_de_privacidad_datos_personales.pdf">Aviso de
                            Privacidad</a>
                        <a href="https://ultherapy.mx/terminos-y-condiciones">Términos y Condiciones</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="modal">
        <div class="row">
            <div class="column">
                <div class="registration">
                    <i onclick="return closeModal()"></i>
                    <p>Llena los campos para recibir por correo la información completa del médico o clínica. Y como nos
                        gusta consentirte, además podrás recibir antes que nadie beneficios exclusivos como promociones,
                        eventos y mucho más.</p>
                    <form action="" method="" onsubmit="return registration()" novalidate>
                        <fieldset>
                            <input type="text" placeholder="Nombre"/>
                        </fieldset>
                        <fieldset>
                            <input type="text" placeholder="Teléfono"/>
                        </fieldset>
                        <fieldset>
                            <input type="text" placeholder="Correo electrónico"/>
                        </fieldset>
                        <fieldset>
                            <select>
                                <option>¿Qué le quieres preguntar?</option>
                                <option value="">Solicitar Costos</option>
                                <option value="">Agendar Cita</option>
                                <option value="">¿Soy candidato(a) al Tratamiento?</option>
                                <option value="">Informacion Sobre Ultherapy</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <textarea>Cuéntale a tu médico o clínica tu inquietud:</textarea>
                            <button>Enviar</button>
                        </fieldset>
                    </form>
                    <p>Consulta nuestro <a href="">Aviso de Privacidad</a></p>
                </div>
                <div class="success">
                    <strong>Gracias Por Tu Mensaje</strong>
                    <p>Acabamos de enviarte un correo con la información completa del médico o clínica y pronto
                        recibirás una respuesta a tu consulta.</p>
                    <a href="#" onclick="return closeModal()">salir</a>
                </div>
            </div>
        </div>
    </div>
@else
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <span>@lang('labels.footer_copyright') </span>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="page-login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>
@endif
<script src="/front/assets/js/sticky-sidebar.js"></script>
<script src="/front/assets/js/YouTubePopUp.jquery.js"></script>
<script src="/front/assets/js/owl.carousel.min.js"></script>
<script src="/front/assets/js/imagesloaded.min.js"></script>
<script src="/front/assets/js/wow.min.js"></script>
<script src="/front/assets/js/custom.js"></script>
<script src="/front/assets/js/popper.min.js"></script>
<script src="/front/assets/js/bootstrap.min.js"></script>
<script src="/front/assets/js/jquery.validate.js"></script>

</body>

</html>
