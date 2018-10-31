<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>My Directory</title>
    <meta name="author" content="My-Theme">
    <meta name="robots" content="index follow">
    <meta name="googlebot" content="index follow">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="keywords" content="directory, doctor, doctor directory, Health directory, listing, map, medical, medical directory, professional directory, reservation, reviews">
    <meta name="description" content="Health Care & Medical Services Directory">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

<!---------------------->
<meta property="og:type" content="article" /> 
<meta property="og:title" content="Ultherapy" />
<meta property="og:description" content="Descripción" />
<meta property="og:image" content="link a logo" />
<meta property="og:url" content="http>//ultherapy.mx" />
<meta property="og:site_name" content="Ultherapy" />

<meta name="twitter:title" content="Ultherapy">
<meta name="twitter:description" content="Descripción">
<meta name="twitter:image" content="Link a logo">
<meta name="twitter:site" content="@ultherapy">
<meta name="twitter:creator" content="@ultherapy">
<!---------------------->







    <link rel="icon" href="{{ url('public/front') }}/assets/img/favicon.ico" type="image/x-icon" />
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,800%7CPoppins:300i,300,400,700,400i,500%7CDancing+Script:700%7CDancing+Script:700" rel="stylesheet">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/animate.css" />
    <!-- owl Carousel assets -->
    <link href="{{ asset('public/front') }}/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="{{ asset('public/front') }}/assets/css/owl.theme.css" rel="stylesheet">
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/bootstrap.min.css">
    <!-- hover anmation -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/hover-min.css">
    <!-- flag icon -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/flag-icon.min.css">
    <!-- main style -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/style.css">
    <!-- colors -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/colors/main.css">
    <!-- elegant icon -->
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/elegant_icon.css">
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/stylesnew.css" />

    @yield('styles')

    
    <!-- jquery library  -->
    <script  src="{{ asset('public/front') }}/assets/js/jquery-3.2.1.min.js"></script>

    <!-- Maps library  -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL5Ae9Mv4lqPyQ1wD3NUhHkpmuX85DFo4&libraries=places"></script>
    <script  src="{{ asset('public/front') }}/assets/js/jquery.gomap-1.3.3.min.js"></script>

    <!-- fontawesome  -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    <script>
        var base_url = '{{ url('/') }}';
    </script>
    <style>
        .background-main-color, .background-second-color {
            background-color:#f1b434;
        }
        .ba-2 {
            background-color:#f3bd4c;
        }

    </style>
</head>

<body>

    <!--<header class="background-white box-shadow">
        <div class="container header-in">
            
  
                <div class="row">
                    <div class="col-lg-2 col-md-12">
                        <a id="logo" href="{{ url('/') }}" class="d-inline-block margin-tb-15px"><img src="{{ asset('public/front') }}/assets/img/logo-1.png" alt=""></a>
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
                            <a href="{{ url('/admin') }}" class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-20px">
                                <i class="fa fa-user"></i>  @lang('labels.dashboard')
                            </a>
                            <div class="nav-item float-left">
                                <a href="{{ url('/logout') }}" class="nav-link margin-top-10px">
                                    <div class="text-grey-3"><i class="fa fa-fw fa-sign-out-alt"></i>@lang('labels.logout')</div>
                                </a>
                            </div>
                            @else
                            <a href="{{ url('/mydashboard') }}" class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-20px">
                                <i class="fa fa-user"></i>  @lang('labels.dashboard')
                            </a>
                            <div class="nav-item float-left">
                                <a href="{{ url('/logout') }}" class="nav-link margin-top-10px" >
                                    <div class="text-grey-3"><i class="fa fa-fw fa-sign-out-alt"></i>@lang('labels.logout')</div>
                                </a>
                            </div>
                            @endif

                        @else
                        <a href="{{ url('/login') }}" class="btn btn-sm border-radius-30 margin-tb-15px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-30px">
                          <i class="fa fa-user"></i>  @lang('labels.login')
                        </a>
                        <a href="{{ url('/register') }}" class="padding-lr-0px margin-left-30px margin-tb-20px d-inline-block text-up-small float-left float-lg-right"><i class="far fa-user"></i>  @lang('labels.signup')</a>&nbsp;
                        @endif
                        
                    </div>
                </div>
             
        </div>
    </header>-->
    <!-- // Header  -->
    <div id="offcanvas" class="c-offcanvas js-offcanvas">

    <!-- Navigation Desktop -->

    <div class="c-navigation c-navigation--desktop">
      <div class="c-navigation__container">
        <div class="c-navigation__logo">
          <a href="https://ultherapy.mx">
            <img src="https://ultherapy.mx/images/ultherapy_logo.png" class="" alt="Ultherapy, la evolución del lifting" title="Haz que tu rostro luzca más joven con Ultherapy">
          </a>
        </div>
        <div class="c-navigation__links">
          <div class="c-navigation__nav">
            <ul class="c-navigation__nav_list">
              <li><a href="#" class="icon js-lightbox__open"><svg width="22px" height="20px" viewBox="0 0 22 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs><linearGradient x1="0%" y1="-43.6936937%" x2="141.921397%" y2="132.732733%" id="linearGradient-1"><stop stop-color="#ED8B00" offset="0%"></stop><stop stop-color="#F7D285" offset="100%"></stop></linearGradient><linearGradient x1="0%" y1="-43.6936937%" x2="140.476048%" y2="130.935979%" id="linearGradient-2"><stop stop-color="#ED8B00" offset="0%"></stop><stop stop-color="#F7D285" offset="100%"></stop></linearGradient></defs><g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Header" transform="translate(-804.000000, -90.000000)"><g id="icon"><g transform="translate(804.000000, 90.000000)"><path d="M1.64,6.32 L1.64,18 L18.32,18 L18.32,19.64 L1.64,19.64 C1.1866644,19.64 0.8000016,19.4800016 0.48,19.16 C0.1599984,18.8399984 0,18.4533356 0,18 L0,6.32 L1.64,6.32 Z" id="Path" fill="url(#linearGradient-1)"></path><path d="M10.326006,12.4684685 L16.332012,7.97597598 L10.326006,3.45945946 L10.326006,12.4684685 Z M19.1037838,0 C19.7163995,0 20.2389168,0.19219027 20.6713514,0.576576577 C21.1037859,0.960962883 21.32,1.4254227 21.32,1.96996997 L21.32,13.981982 C21.32,14.5265292 21.1037859,14.998997 20.6713514,15.3993994 C20.2389168,15.7998018 19.7163995,16 19.1037838,16 L5.59027027,16 C4.97765459,16 4.44612838,15.7998018 3.99567568,15.3993994 C3.54522297,14.998997 3.32,14.5265292 3.32,13.981982 L3.32,1.96996997 C3.32,1.4254227 3.54522297,0.960962883 3.99567568,0.576576577 C4.44612838,0.19219027 4.97765459,0 5.59027027,0 L19.1037838,0 Z" id="video_library---material-copy" fill="url(#linearGradient-2)"></path></g></g></g></g></svg></a></li>
              <li><a rel="canonical" href="https://ultherapy.mx/como-funciona-un-lifting-facial-sin-cirugia">Cómo funciona</a></li>
              <li><a rel="canonical" href="https://ultherapy.mx/beneficios-lifting-facial-sin-cirugia">Antes y después</a></li>
              <li><a href="https://ultherapy.mx/resultados-lifting-facial">Resultados</a></li>
              <li><a href="https://ultherapy.mx/como-identificar-un-tratamiento-ulthera-original">El Original</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation Mobile -->

    <div class="c-navigation c-navigation--mobile">
      <div class="c-navigation-hamburger js-c-nav-mobile-ham">
        <span class="c-navigation-hamburger__line c-navigation-hamburger__line--1"></span>
        <span class="c-navigation-hamburger__line c-navigation-hamburger__line--2"></span>
        <span class="c-navigation-hamburger__line c-navigation-hamburger__line--3"></span>
      </div>
      <a href="https://ultherapy.mx">
        <img src="https://ultherapy.mx/images/ultherapy_logo_mobile.png" class="" alt="Ultherapy, la evolución del lifting" title="Haz que tu rostro luzca más joven con Ultherapy">
      </a>
    </div>

    <!-- Navigation Mobile Sidebar -->

    <div class="c-navigation-sidebar js-c-nav-mobile-sidebar">
      <div class="c-navigation-sidebar__container">
        <ul class="c-navigation-sidebar__nav">
          <li class="c-navigation-sidebar__nav_el">
            <a href="https://ultherapy.mx">
              <span>Home</span>
            </a>
          </li>
          <li class="c-navigation-sidebar__nav_el">
            <a href="https://ultherapy.mx/como-funciona-un-lifting-facial-sin-cirugia">
              <span>Cómo funciona</span>
            </a>
          </li>
          <li class="c-navigation-sidebar__nav_el">
            <a href="https://ultherapy.mx/beneficios-lifting-facial-sin-cirugia">
              <span>Antes y después</span>
            </a>
          </li>
          <li class="c-navigation-sidebar__nav_el">
            <a href="https://ultherapy.mx/resultados-lifting-facial">
              <span>Resultados</span>
            </a>
          </li>
          <li class="c-navigation-sidebar__nav_el">
            <a href="https://ultherapy.mx/como-identificar-un-tratamiento-ulthera-original">
              <span>El Original</span>
            </a>
          </li>
          <li class="c-navigation-sidebar__nav_el">
            <a href="https://ultherapy.mx/preguntas-sobre-lifting-facial">
              <span>Preguntas frecuentes</span>
            </a>
          </li>
          <li class="c-navigation-sidebar__nav_el hidden">
            <a href="https://ultherapy.mx/consideraciones-lifting-facial">
              <span>Consideraciones</span>
            </a>
          </li>
        </ul>
      </div>
    </div>




    <!-- Main Content -->
    <div class="Content">
    <!-- // Header  -->
@yield('content')

@if(Request::segment(1) != 'mydashboard')
    
@endif
    <script  src="{{ asset('public/front') }}/assets/js/sticky-sidebar.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/YouTubePopUp.jquery.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/owl.carousel.min.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/imagesloaded.min.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/wow.min.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/custom.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/popper.min.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/bootstrap.min.js"></script>
    <script  src="{{ asset('public/front') }}/assets/js/jquery.validate.js"></script>
    </div>
    <footer class="c-footer js-footer">
      <div class="c-footer_principal">
        <div class="l-wrapper">
          <div class="c-footer_column c-footer_column-social">
            <div class="c-footer_column-content">
              <div class="c-footer_column-img c-footer_social">
                <a href="" class="c-footer_social-twitter fake-invisible  js-footer-social" data-social="twitter">
                  <img src="https://ultherapy.mx/images/shared/social_icons/u_social_icon-twitter.svg">
                </a>
                <a href="https://www.facebook.com/UltherapyMexicoOficial/" target="_blank" class="c-footer_social-facebook js-footer-social" data-social="facebook">
                  <img src="https://ultherapy.mx/images/shared/social_icons/u_social_icon-facebook.svg">
                </a>
                <a href="" class="c-footer_social-instagram fake-invisible  js-footer-social" data-social="instagram">
                  <img src="https://ultherapy.mx/images/shared/social_icons/u_social_icon-instagram.svg">
                </a>
              </div>
              <div>Síguenos en las redes</div>
            </div>
          </div>
          <div class="c-footer_column c-footer_column-how_works js-footer-submenu" data-submenu="Ultrasonido microfocalizado">
            <div class="c-footer_column-content">
              <a href="https://ultherapy.mx/como-funciona-un-lifting-facial-sin-cirugia">
                <div class="c-footer_column-img">
                  <img src="https://ultherapy.mx/images/ultherapy_logo-no_slogan.png" alt="Ultherapy, la evolución del lifting" title="Haz que tu rostro luzca más joven con Ultherapy">
                </div>
                <div>Ultrasonido<br>microfocalizado</div>
              </a>
            </div>
          </div>
          <div class="c-footer_column c-footer_column-where_find js-footer-submenu" data-submenu="Un especialista cerca de ti">
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
                <li><a href="https://ultherapy.mx/como-funciona-un-lifting-facial-sin-cirugia">Cómo funciona</a></li>
                <li><a href="https://ultherapy.mx/beneficios-lifting-facial-sin-cirugia">Antes y después</a></li>
                <li><a href="https://ultherapy.mx/resultados-lifting-facial">Resultados</a></li>
              </ul>
              <ul>
                <li><a href="https://ultherapy.mx/solicitar-cita-lifting-sin-cirugia">Encuentra un doctor</a></li>
                <li><a href="https://ultherapy.mx/preguntas-sobre-lifting-facial">Preguntas frecuentes</a></li>
                <li><a href="https://ultherapy.mx/como-identificar-un-tratamiento-ulthera-original">Ultherapy® El original</a></li>
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
              <a target="_blank" href="https://ultherapy.mx/files/ultherapy-aviso_de_privacidad_datos_personales.pdf">Aviso de Privacidad</a>
              <a href="https://ultherapy.mx/terminos-y-condiciones">Términos y Condiciones</a>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- EOF -->
  </div>

  
<script>
    var _openMenu = true;

var toggleMenu = function(e) {
  e.preventDefault();

  if (!_openMenu) return;

  _openMenu = false;

  setTimeout(function() {
    $(".js-c-nav-mobile-ham").toggleClass("c-navigation-hamburger--is-active");
    $(".js-c-nav-mobile-sidebar").toggleClass("c-navigation-sidebar--is-active");
  }, 250);
  setTimeout(function() {
    _openMenu = true;
  }, 750);
}

$(".js-c-nav-mobile-ham").on("click", toggleMenu);

</script>     
</body>

</html>
