@extends('layouts.front')

@section('content')
<style>
    .rateUser ul li {
        width: 20px;height:20px;background-size:cover;
    }
    ul#ulTimingsContainer li:nth-child(even) {
        background-color: #3396ff;
    }
</style>
@if(session()->has('message.level'))
<div class="horizontal-center alert alert-{{ session('message.level') }}"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {!! session('message.content') !!}
</div>
@endif
<div id="page-title" class="padding-tb-30px gradient-white hide">
        <div class="container">
            <h1 class="font-weight-300">{{ ucwords($userdetails->name) }}</h1>
        </div>
    </div>


    <div class="margin-bottom-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="margin-bottom-30px box-shadow">
                        @if($userdetails->image)
                        <img src="/uploads/userimage/{{$userdetails->id}}/{{$userdetails->image}}" alt="{{ $userdetails->name }}">
                        @else
                        <img src="/front/assets/images/no-profile-image-min.jpg" alt="{{ $userdetails->name }}">
                        @endif
                        
                        <div class="padding-30px background-white">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="rating clearfix">
                                        <span class="float-left text-grey-2"><i class="far fa-map"></i>  {{ ucfirst($userdetails->address) }}</span>
                                        <ul class="float-right">
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li class="active"></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row no-gutters">
                                        <div class="col-6"><a href="#" class="text-lime"><i class="far fa-bookmark"></i> Open Now!</a></div>
                                        <!-- <div class="col-4 text-center"><a href="#" class="text-red"><i class="far fa-heart"></i> Save</a></div> -->
                                        <div class="col-6 text-right"><a href="#" class="text-blue"><i class="far fa-hospital"></i> {{ $userdetails->categorytype }}</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-hospital margin-right-10px text-main-color"></i> @lang('labels.about') - {{ ucfirst($userdetails->name) }}</h3>
                            <hr>
                            <p class="text-grey-2">{{ ucfirst($userdetails->about) }}</p>
                            <p class="text-grey-2">{{ ucfirst($userdetails->description) }}</p>
                        </div>
                    </div>

                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-map margin-right-10px text-main-color"></i> {{ ucfirst($userdetails->name) }} @lang('labels.location')</h3>
                            <hr>
                            <div class="map-distributors-in">
                                <div id="map_canvas" style="width: 100%;height:250px;"></div>
                            </div>
                        </div>
                    </div>

                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-star margin-right-10px text-main-color"></i> @lang('labels.review_and_rating')</h3>
                            <hr>
                        
                            <ul class="commentlist padding-0px margin-0px list-unstyled text-grey-3">
                                
                                @forelse ($ratingDetails as $rating)
                                    <li class="border-bottom-1 border-grey-1 margin-bottom-20px">
                                        @if($rating->image)
                                        <img style="width: 60px;height: 60px;" src="{{ asset('public/uploads/userimage'.'/'.$rating->fromuserid.'/'.$rating->image) }}" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
                                        @else
                                        <img style="width: 60px;height: 60px;" src="{{ asset('public/front/assets/images/noimagefound-small.png') }}" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
                                        @endif
                                        <div class="margin-left-85px">
                                            <a  class="d-inline-block text-dark text-medium margin-right-20px" href="javascript:void(0)">{{ ucfirst($rating->name) }} </a>
                                            <span class="text-extra-small">Date :  <a href="javascript:voide(0)" class="text-main-color">{{ date('F d, Y', strtotime($rating->created_at)) }}</a></span>
                                            <div class="rating">
                                                <ul>
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <li class="{{ ($rating->rating >= $i) ? 'active':'' }}"></li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <p class="margin-top-15px text-grey-2">{{ ucfirst($rating->comment) }} </p>
                                        </div>
                                    </li>
                                @empty
                                    <div class="alert alert-danger">User have no reviews yet!</div>
                                @endforelse
                                
                            </ul>

                        </div>
                    </div>
                    @if(Auth::user() && $userdetails->id != Auth::user()->id && Auth::user()->type != 1)
                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-star margin-right-10px text-main-color"></i> @lang('labels.add_review') </h3>
                            <hr>
                            <div id="errorMsg" style="display: none;" class="alert alert-danger"></div>
                            @if(session()->has('message.level'))
                            <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {!! session('message.content') !!}
                            </div>
                            @endif
                            <form action="{{ url('/profile/'. Request::segment(2)) }}" method="post" name="reviewSubmit" id="reviewSubmit" onsubmit="return chkFormdetails()">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group row col-md-12">
                                        <div class="col-md-6">@lang('labels.your_rating')  <small>( @lang('labels.your_rating_smalltext') ) </small>: <sup class="requiredSup">*</sup></div>
                                        <div class="col-md-6 rating rateUser">
                                            <ul>
                                                <li data-rate="1" class=""></li>
                                                <li data-rate="2" class=""></li>
                                                <li data-rate="3" class=""></li>
                                                <li data-rate="4" class=""></li>
                                                <li data-rate="5" class=""></li>
                                            </ul>
                                            <div class="error">{{ $errors->first('rateVal') }}</div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label>@lang('labels.comment') <small>(@lang('labels.comment_smalltext'))</small>: <sup class="requiredSup">*</sup></label>
                                    <textarea class="form-control" id="usercomments" name="usercomments" rows="3" placeholder="Your Comments here" minlength="20">{{ old('usercomments') }}</textarea>
                                    <div class="error">{{ $errors->first('usercomments') }}</div>
                                </div>
                                <input type="hidden" name="rateVal" id="rateVal" >
                                <input type="hidden" name="touser" id="" value="{{ $userdetails->id }}">
                                <button type="submit" name="saveComments" id="saveComments" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px">Add Now !</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="margin-bottom-30px box-shadow addreviewContainerBox">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-star margin-right-10px text-main-color"></i> Add Review </h3>
                            <hr>
                            <div id="errorMsg" style="display: none;" class="alert alert-danger"></div>
                            @if(session()->has('message.level'))
                            <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {!! session('message.content') !!}
                            </div>
                            @endif
                            <form action="" method="post" name="reviewSubmit" id="reviewSubmit" onsubmit="">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group row col-md-12">
                                        <div class="col-md-6">Your Rating  <small>( Click stars to rate) </small>: <sup class="requiredSup">*</sup></div>
                                        <div class="col-md-6 rating rateUser">
                                            <ul>
                                                <li data-rate="1" class=""></li>
                                                <li data-rate="2" class=""></li>
                                                <li data-rate="3" class=""></li>
                                                <li data-rate="4" class=""></li>
                                                <li data-rate="5" class=""></li>
                                            </ul>
                                            <div class="error">{{ $errors->first('rateVal') }}</div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label>Comment <small>(minimum 20 characters required)</small>: <sup class="requiredSup">*</sup></label>
                                    <textarea class="form-control" id="usercomments" name="usercomments" rows="3" placeholder="Your Comments here" minlength="20">{{ old('usercomments') }}</textarea>
                                    <div class="error">{{ $errors->first('usercomments') }}</div>
                                </div>
                                <a href="{{ url('/login') }}" name="saveComments" id="saveComments" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px">Signin to review or comment !</a>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="background-second-color border-radius-10 margin-bottom-45px text-white box-shadow">
                        <h3 class="padding-lr-30px padding-top-20px"><i class="far fa-clock margin-right-10px"></i> Horario de consulta</h3>
                        <div class="padding-bottom-30px">
                            <ul id="ulTimingsContainer" class="padding-0px margin-0px">
                                @if($usertimings->monStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px">Lunes <span class="float-right">
                                    {{ ($usertimings->monStatus == 1) ? str_replace('-', ' - ', $usertimings->monTiming) : 'Closed'  }} </span></li>
                                @endif

                                @if($usertimings->tueStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px ">Martes <span class="float-right">{{ ($usertimings->tueStatus == 1) ? str_replace('-', ' - ', $usertimings->tueTiming) : 'Closed'  }}</span></li>
                                @endif

                                @if($usertimings->wedStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px">Miércoles <span class="float-right">{{ ($usertimings->wedStatus == 1) ? str_replace('-', ' - ', $usertimings->wedTiming) : 'Closed'  }}</span></li>
                                @endif

                                @if($usertimings->thuStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px ">Jueves <span class="float-right">{{ ($usertimings->thuStatus == 1) ? str_replace('-', ' - ', $usertimings->thuTiming) : 'Closed'  }}</span></li>
                                @endif

                                @if($usertimings->friStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px">Viernes  <span class="float-right">{{ ($usertimings->friStatus == 1) ? str_replace('-', ' - ', $usertimings->friTiming) : 'Closed'  }}</span></li>
                                @endif

                                @if($usertimings->satStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px ">Sábado  <span class="float-right">{{ ($usertimings->satStatus == 1) ? str_replace('-', ' - ', $usertimings->satTiming) : 'Closed'  }}</span></li>
                                @endif

                                @if($usertimings->sunStatus == 1)
                                <li class="padding-lr-30px padding-tb-10px">Domingo    <span class="float-right">{{ ($usertimings->sunStatus == 1) ? str_replace('-', ' - ', $usertimings->sunTiming) : 'Closed'  }}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="background-white border-radius-10 margin-bottom-45px">
                        <div class="padding-25px">
                            <h3 class="margin-lr-20px"><i class="fas fa-search margin-right-10px text-main-color"></i> @lang('labels.search_filter')</h3>
                            <!-- Listing Search -->
                            <div class="listing-search">
                                <form method="get"  action="{{ url('/') }}" id="searchForm" name="searchForm">
                                    <div class="keywords margin-bottom-20px">
                                        <input class="listing-form first border-radius-10" type="text" placeholder="@lang('labels.keywords')" value="" name="keyword" id="keyword" >
                                    </div>
                                    <div class="regions margin-bottom-20px">
                                        <input class="listing-form border-radius-10" type="text" placeholder="@lang('labels.all_estado')" value="">
                                    </div>

                                    <div class="categories dropdown margin-bottom-20px">
                                        <a class="listing-form d-block border-radius-10" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('labels.all_type')</a>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                            <button class="dropdown-item text-up-small" type="button" value="all">@lang('labels.all_type')</button>
                                            <button class="dropdown-item text-up-small" type="button" value="doctor" >Doctors</button>
                                            <button class="dropdown-item text-up-small" type="button" value="clinic" >Clinics</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="lat" id="addresslat" value="">
                                    <input type="hidden" name="lng" id="addresslng" value="">
                                    <input type="hidden" name="category" id="category" value="">
                                    <button type="submit" name="submit" id="submit" class="listing-bottom background-dark box-shadow border-radius-10" href="#">@lang('labels.search_now')</button>
                                </form>
                            </div>
                            <!-- // Listing Search -->
                        </div>
                    </div>


                    <div class="featured-categorey">
                        <div class="row">
                            <div class="col-6 margin-bottom-30px wow fadeInUp">
                                <a href="javascript:void(0)"  class="d-block border-radius-15 hvr-float hvr-sh2">
                                    <div onclick="searchBtnCLick('doctor')" class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                        <div class="icon margin-bottom-15px opacity-7">
                                            <img src="{{ asset('public/front') }}/assets/img/icon/categorie-1.png" alt="">
                                        </div>
                                        Doctors
                                    </div>
                                </a>
                            </div>
                            <div class="col-6 margin-bottom-30px wow fadeInUp" data-wow-delay="0.2s">
                                <a href="javascript:void(0)"  class="d-block border-radius-15 hvr-float hvr-sh2">
                                    <div onclick="searchBtnCLick('clinic')" class="background-main-color text-white border-radius-15 padding-30px text-center opacity-hover-7">
                                        <div class="icon margin-bottom-15px opacity-7">
                                            <img src="{{ asset('public/front') }}/assets/img/icon/categorie-2.png" alt="">
                                        </div>
                                        Clinics
                                    </div>
                                </a>
                            </div>
                            
                        </div>

                    </div>
                    @if(Auth::user() && $userdetails->id != Auth::user()->id && Auth::user()->type != 1)
                    <div class="featured-categorey">
                        <div class="row">
                            <div class="col-12 margin-bottom-30px wow fadeInUp">
                                <a href="javascript:void(0)" class="d-block border-radius-15 hvr-float hvr-sh2">
                                    <div class="background-main-color1 text-white border-radius-15 padding-30px text-center opacity-hover-7 background-orange" style="font-size: 25px;" onclick="showRequestPopup()">
                                        <i class="fa fa-calendar"></i> @lang('labels.request')
                                    </div>
                                </a>
                            </div>
                            
                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

<!----------------->
<!-- The Modal -->
<div class="modal" id="requestPopupModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h5 class="modal-title text-center">
            Información del médico o clínica
            <p style="font-size:12px;color: #888;margin-bottom:0px;">Llena los campos para recibir información completa del médico o clínica . También, como nos gusta consentirte, además podrás recibir antes que nadie  beneficios exclusivos como promociones, eventos mucho más.</p>
        </h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            
            <form action="" onsubmit="return saveReqInfo();" name="reqForm" id="reqForm">
                <div id="reqmsgContainer" style="display: none;"></div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="req_name" name="req_name" placeholder="Nombre" required minlength="3" maxlength="30">
                    </div>
                    <div class="col-md-6">
                        <input type="text" class="form-control" id="req_phone" name="req_phone" placeholder="Teléfono" required minlength="10" maxlength="10" number="true" >
                    </div>
                </div>
                <div class="clear margin-top-10px"></div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="email" class="form-control" id="req_email" name="req_email" placeholder="Correo electrónico " required email="true">
                    </div>
                    <div class="col-md-6">
                        <select name="req_option" id="req_option" class="form-control" required>
                            <option value="">¿Qué le quieres preguntar</option>
                            <option value="1">Solicitar costos</option>
                            <option value="2">Agendar cita</option>
                            <option value="3">¿Soy candidata (o) al tratamiento?</option>
                            <option value="4">Información sobre Ultherapy</option>
                        </select>
                    </div>
                </div>
                <div class="clear margin-top-10px"></div>
                <div class="row">
                    <div class="col-md-12">
                        <textarea class="form-control" name="req_description" id="req_description"  rows="3" style="width: 100%;" placeholder="Cuéntale a tu medico o clínica" required></textarea>
                    </div>
                </div>
                <div class="clear margin-top-10px"></div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button class="btn btn-danger" name="submit" id="sendReqSubmit">Submit</button>
                    </div>
                    <div class="col-md-12 text-center">
                        <a href="https://ultherapy.mx/files/ultherapy-aviso_de_privacidad_datos_personales.pdf" target="_blank">Consulta nuestro Aviso de Privacidad</a>
                    </div>
                </div>
                
            </form>
      </div>

    </div>
  </div>
</div>
<!----------------->



@if(Auth::user() && ($userdetails->id == Auth::user()->id || Auth::user()->type == 1))
<script>
    jQuery('.addreviewContainerBox').remove();
</script>
@endif
<script>
jQuery(document).ready(function(){
    $('button.dropdown-item').click(function(){
        var getVal = $(this).val();
        var getText = $(this).text();
        $('a#dropdownMenu2').text(getText);
        $('#category').val(getVal);
    });
});
function searchBtnCLick(type){ console.log('in search');
    $('#category').val(type);
    //$('#searchForm').eq(0).submit();
    $('#searchForm button#submit').trigger('click');
}
function saveReqInfo(){
    var chkValidForm = $('#reqForm').valid();
    if(chkValidForm){
        var getName = $('#req_name').val();
        var getPhone = $('#req_phone').val();
        var getEmail = $('#req_email').val();
        var getOption = $('#req_option').val();
        var getDesc = $('#req_description').val();
        var touserid = '{{ $userdetails->id }}';
        $('#sendReqSubmit').prop('disabled', true);
        $.ajax({
            url: '{{ url('/sendProfileRequest') }}',
            type: 'post',
            data: { touserid:touserid, getName: getName, getPhone:getPhone, getEmail:getEmail, getOption:getOption, getDesc:getDesc, _token: '{{csrf_token()}}' },
            success: function(data){
                if(data != 1){
                    $('#sendReqSubmit').prop('disabled', false);
                    $('#reqmsgContainer').show().html('<div class="alert alert-danger">Error Occured!!</div>').fadeOut(5000);
                    return false;
                }
                $('#reqmsgContainer').show().html('<div class="alert alert-success">Details have been sent successfully!!</div>').fadeOut(5000);
                setTimeout(function(){
                    $('#requestPopupModal').modal('hide');
                }, 4000);
            },
            error: function (data, textStatus, errorThrown) {
                alert('Error Occurred');
            },
        })
    }
    
    return false;
}
function showRequestPopup(){
    $('#reqForm').trigger("reset");
    $('label.error').remove();

    $('#requestPopupModal').modal('show');
    setTimeout(function(){
        $('#reqForm').validate().resetForm();
    }, 600);
}

    var map, marker;
    function initMap(){
        var lat = '{{ $userdetails->varylat }}';
        var lng = '{{ $userdetails->varylng }}';
        var zoom = 11;
        if(lat == '' || lng == ''){
            lat = 23.634501;
            lat = -102.55278399999997;
            zoom = 5;
        }

        var title = '{{ ucfirst($userdetails->name) }}';
        var iconpath = "{{ asset('public/front') }}/assets/images/markericon.png";
        
        var myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: zoom,
            center: {lat: parseFloat(lat), lng: parseFloat(lng)},
            maxZoom: 14
        });

        var getLat = $('#latitude').val();
        var getLng = $('#longitude').val();
        if(getLat != '' && getLng != ''){
            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                icon: iconpath,
                title: title
            });
        }
    }

    
    $(document).ready(function(){
        initMap();
        $('.rateUser li').click(function(){
            $('.rateUser li').removeClass('active');

            var getVal = $(this).attr('data-rate');
            $('#rateVal').val(getVal);
            $('.rateUser li').each(function(){
                var getVal2 = $(this).attr('data-rate');
                if(getVal2 <= getVal){
                    $(this).addClass('active');
                }
            });    
        });
    });

    function chkFormdetails(){
        var getRateVal = $('#rateVal').val();
        var getCOmments = $('#usercomments').val();
        if(getRateVal == 0 || getRateVal == '' || getCOmments == ''){
            $('#errorMsg').show().html('Please add <strong>Rating</strong> and <strong>Comments</strong> before submit!!').fadeOut(5000);
            return false;
        }
        return true;
    }
</script>
@endsection
