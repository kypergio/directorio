@extends('layouts.front')

@section('content')
        <div id="page-title" class="padding-tb-30px gradient-white" style="padding-top: 100px;">
            <div class="container text-center">
                <ol class="breadcrumb opacity-5">
                    <li><a href="{{route("user.dashboard")}}">Inicio</a></li>
                    <li class="active">Sobre nosotros</li>
                </ol>
                <h1 class="font-weight-300">Sobre nosotros</h1>
            </div>
        </div>

        <section class="margin-tb-100px">
            <div class="container">

                <div class="row">

                    <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp">
                        <div class="service text-center opacity-hover-7 hvr-bob">
                            <div class="icon margin-bottom-10px">
                                <img src="/front/assets/img/icon/service-1.png" alt="">
                            </div>
                            <h3 class="text-second-color">@lang('labels.reliable_places')</h3>
                            <p class="text-grey-2">@lang('labels.reliable_places_text')</p>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.2s">
                        <div class="service text-center opacity-hover-7 hvr-bob">
                            <div class="icon margin-bottom-10px">
                                <img src="/front/assets/img/icon/service-2.png" alt="">
                            </div>
                            <h3 class="text-second-color">@lang('labels.high_credibility')</h3>
                            <p class="text-grey-2">@lang('labels.high_credibility_text')</p>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.4s">
                        <div class="service text-center opacity-hover-7 hvr-bob">
                            <div class="icon margin-bottom-10px">
                                <img src="/front/assets/img/icon/service-3.png" alt="">
                            </div>
                            <h3 class="text-second-color">@lang('labels.quick_search')</h3>
                            <p class="text-grey-2">@lang('labels.quick_search_text')</p>
                        </div>
                    </div>


                    <div class="col-lg-3 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.6s">
                        <div class="service text-center opacity-hover-7 hvr-bob">
                            <div class="icon margin-bottom-10px">
                                <img src="/front/assets/img/icon/service-4.png" alt="">
                            </div>
                            <h3 class="text-second-color">@lang('labels.know_better')</h3>
                            <p class="text-grey-2">@lang('labels.know_better_text')</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>


        <section class="padding-tb-80px background-second-color">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3">
                        <div class="item text-white opacity-hover-7 hvr-bob border-right-1 wow fadeInUp">
                            <div class="opacity-hover-7 hvr-bob">
                                <div class="title margin-bottom-15px">
                                    <h2> @lang('labels.unlimited_colors')</h2>
                                </div>
                                <p class="opacity-5">@lang('labels.unlimited_colors_text')</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="item text-white border-right-1 wow fadeInUp">
                            <div class="opacity-hover-7 hvr-bob">
                                <div class="title margin-bottom-15px">
                                    <h2>@lang('labels.powerful_website')</h2>
                                </div>
                                <p class="opacity-5">@lang('labels.powerful_website_text')</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="item text-white border-right-1 wow fadeInUp">
                            <div class="opacity-hover-7 hvr-bob">
                                <div class="title margin-bottom-15px">
                                    <h2>@lang('labels.responsive_design')</h2>
                                </div>
                                <p class="opacity-5">@lang('labels.responsive_design_text')</p>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-3">
                        <div class="item text-white wow fadeInUp">
                            <div class="opacity-hover-7 hvr-bob">
                                <div class="title margin-bottom-15px">
                                    <h2>@lang('labels.high_speed')</h2>
                                </div>
                                <p class="opacity-5">@lang('labels.high_speed_text')</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="padding-tb-100px background-white">
            <!-- Section Title -->
            <div class="container padding-bottom-40px">
                <div class="row justify-content-center text-center">
                    <div class="col-md-7">
                        <h2 class="text-grey-3 text-center">@lang('labels.our_clients')</h2>
                        <div class="margin-tb-30px text-grey-3 opacity-6">
                            Nuestros Clientes
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Section Title -->

            <div class="container">
                <ul class="row clients-border no-gutters padding-0px margin-0px list-unstyled text-center">
                    <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp">
                        <a href="#" class="hvr-bounce-out"><img src="http://placehold.it/140x90" alt=""></a>
                    </li>
                    <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp" data-wow-delay="0.2s">
                        <a href="#" class="hvr-bounce-out"><img src="http://placehold.it/140x90" alt=""></a>
                    </li>
                    <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp" data-wow-delay="0.4s">
                        <a href="#" class="hvr-bounce-out"><img src="http://placehold.it/140x90" alt=""></a>
                    </li>
                    <li class="col-md-3 col-6 padding-tb-30px wow fadeInUp" data-wow-delay="0.6s">
                        <a href="#" class="hvr-bounce-out"><img src="http://placehold.it/140x90" alt=""></a>
                    </li>
                </ul>
            </div>

        </section>

@endsection
