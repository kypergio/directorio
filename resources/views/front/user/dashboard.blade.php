@extends('layouts.front')

@section('content')

    @include('front.user.sidebar')
    <div class="content-wrapper">
        <div class="container-fluid overflow-hidden">
            <div class="row margin-bottom-90px margin-lr-10px sm-mrl-0px">
                <div class="col-xl-3 col-md-6 margin-bottom-30px">
                    <a href="{{ route('user.userreviewsTome') }}"
                       class="d-block padding-30px background-lime box-shadow border-radius-10 hvr-float">
                        <h6 class="text-white margin-0px font-weight-400">
                            <i class="far fa-user text-icon-large margin-bottom-10px opacity-5 d-block"></i>
                            <span class="font-2 text-extra-large">{{ $myReviews->reviewsTome }}</span>
                            <span class="margin-left-10px">Reseñas de mi trabajo</span>
                        </h6>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6 margin-bottom-30px">
                    <a href="{{ route('user.userreviewsFromme') }}"
                       class="d-block padding-30px background-amber box-shadow border-radius-10 hvr-float">
                        <h6 class="text-white margin-0px font-weight-400">
                            <i class="far fa-star text-icon-large margin-bottom-10px opacity-5 d-block"></i>
                            <span class="font-2 text-extra-large">{{ $myReviews->reviewsFromme }}</span>
                            <span class="margin-left-10px">Reseñas hechas por mi</span>
                        </h6>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
