@extends('layouts.front')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white" style="padding-top: 100px;">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{route("user.dashboard")}}">Inicio</a></li>
                <li class="active">Contáctanos</li>
            </ol>
            <h1 class="font-weight-300">Contáctanos</h1>
        </div>
    </div>


    <div class="container margin-top-50px margin-bottom-100px">
        <div class="col-lg-12">
                <div class="row">
                    <div class="col-12">
                        <p class="text-grey-2">Mauris fermentum porta sem. </p>
                    </div>
                    <div class="col-lg-3 col-md-3 margin-bottom-45px">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_mail_alt icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Correo Eletrónico</h6>
                            <h5 class="font-2 ">info@site-name.com</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 margin-bottom-45px">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_map_alt icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Dirección</h6>
                            <h5 class="font-2 ">Marmora Road, Glasgow</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 sm-mb-30px">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_link icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Sitio Web</h6>
                            <h5 class="font-2">www.site-name.com</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_phone icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Teléfono</h6>
                            <h5 class="font-2">+222 123 3019</h5>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row">
            <div class="col-lg-6">

                <div class="map-distributors-in">
                    <div id="map-distributors">

                        <script >
                            $(function() {
                                $("#map-distributors").goMap({
                                    zoom: 6,
                                    maptype: 'ROADMAP',
                                    markers: [

                                        {
                                            address: '37.822350, -113.558284',
                                            icon: 'assets/img/icon_marker_1.png',
                                            html: '<div class="background-white width-250px"><div class="padding-top-50px padding-lr-20px"> <div class="z-index-2 position-relative"> <h5 class="margin-bottom-20px"><a class="text-dark" href="#">Alrayan Eye Clinic</a></h5> <div class="rating clearfix"> <span class="float-left text-grey-2"><i class="far fa-map"></i> California</span> <ul class="float-right"> <li class="active"></li> <li class="active"></li> <li class="active"></li> <li class="active"></li> <li></li> </ul> </div> </div> </div> </div> </div>'
                                        },



                                    ],
                                    hideByClick: true
                                });
                                $("#default").click(function() {
                                    $("#dump").html($.dump($.goMap.getMarkers()));
                                });
                                $("#clearall").click(function() {
                                    $.goMap.clearMarkers();
                                });
                                $("#json").click(function() {
                                    $("#dump").html($.goMap.getMarkers("json"));
                                });
                                $("#data").click(function() {
                                    $("#dump").html($.goMap.getMarkers("data"));
                                });

                                $('.gm-style-iw').parent().css('width', 'auto');


                            });

                        </script>

                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center">Contáctanos</h3>
                        <div class="container margin-bottom-100px">
                            <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">
                                @if(session()->has('message.level'))
                                <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    {!! session('message.content') !!}
                                </div>
                                @endif
                                <div class="form-output">

                                    <form name="contactus" id="contactus" method="post" action="{{ route('contactus.savedetails') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tu Nombre</label>
                                            <input class="form-control" placeholder="Tu Nombre" type="text" name="name" id="name" value="{{ old('name') }}" required>
                                            <div class="error">{{ $errors->first('name') }}</div>
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tu Correo Electrónico</label>
                                            <input class="form-control" value="{{ old('email') }}" placeholder="Tu Correo Electrónico" type="email" name="email" id="email" required>
                                            <div class="error">{{ $errors->first('email') }}</div>
                                        </div>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Tus Comentarios</label>
                                            <textarea class="form-control" placeholder="Tus Comentarios" name="comments" id="comments" required>{{ old('comments') }}</textarea>
                                            <div class="error">{{ $errors->first('comments') }}</div>
                                        </div>

                                        <button type="submit" name="submit" id="submit" class="btn btn-md btn-primary">
                                            Enviar detalles
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>
@endsection
