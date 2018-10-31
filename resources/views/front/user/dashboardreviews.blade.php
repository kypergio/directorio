@extends('layouts.front')

@section('content')

@include('front.user.sidebar') 
    <div class="content-wrapper">
        <div class="container-fluid overflow-hidden">
            <div class="row margin-bottom-90px margin-lr-10px sm-mrl-0px">
                <!-- Page Title -->
                <div id="page-title" class="padding-30px background-white full-width">
                    <div class="container">
                        <ol class="breadcrumb opacity-5">
                            <li><a href="{{route("user.dashboard")}}">Inicio</a></li>
                            <li class="active">Reseñas hechas por mi</li>
                        </ol>
                        <h1 class="font-weight-300">Reseñas hechas por mi</h1>
                    </div>
                </div>
                <!-- // Page Title -->
                <div class="full-width row margin-tb-45px">

                    <!-- Review item -->
                    @forelse($reviews as $rating)
                    <div class="col-lg-6 margin-bottom-45px">
                        <div class="background-white thum-hover box-shadow hvr-float">
                            <div class="padding-30px">
                                @if($rating->to->image)
                                <img style="width: 60px;height: 60px;" src="/uploads/userimage/{{$rating->touserid}}/{{$rating->to->image}}" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
                                @else
                                <img style="width: 60px;height: 60px;" src="/front/assets/images/noimagefound.png" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="">
                                @endif
                                
                                <div class="margin-left-85px">
                                    <a target="_blank" class="d-inline-block text-dark text-medium margin-right-20px" href="{{ url('/profile/'.$rating->userslug) }}">{{ ucfirst($rating->name) }}</a>
                                    <span class="text-extra-small">Date :
                                        <a href="javascript:voide(0)" class="text-main-color">
                                            {{ date('F d, Y', strtotime($rating->created_at)) }}
                                        </a>
                                    </span>
                                    <div class="rating">
                                        <ul>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <li class="{{ ($rating->rating >= $i) ? 'active':'' }}"></li>
                                            @endfor
                                        </ul>
                                    </div>
                                    <p class="margin-top-15px text-grey-2">{{ ucfirst($rating->comment) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="col-md-12 alert alert-danger text-center">Todavía no has hecho ninguna reseña</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
