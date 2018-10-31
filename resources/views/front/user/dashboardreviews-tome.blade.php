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
                            <li><a href="#">Inicio</a></li>
                            <li class="active">Reseñas de mi servicio</li>
                        </ol>
                        <h1 class="font-weight-300">Reseñas de mi servicio</h1>
                    </div>
                </div>
                <!-- // Page Title -->
                <div class="full-width row margin-tb-45px">

                    <!-- Review item -->
                    @forelse($reviews as $rating)
                        <div class="col-lg-6 margin-bottom-45px">
                            <div class="background-white thum-hover box-shadow hvr-float">
                                <div class="padding-30px">
                                    @if($rating->from->image)
                                        <img style="width: 60px;height: 60px;"
                                             src="/uploads/userimage/{{$rating->fromuserid}}/{{$rating->from->image}}"
                                             class="float-left margin-right-20px border-radius-60 margin-bottom-20px"
                                             alt="">
                                    @else
                                        <img style="width: 60px;height: 60px;"
                                             src="/front/assets/images/noimagefound.png"
                                             class="float-left margin-right-20px border-radius-60 margin-bottom-20px"
                                             alt="">
                                    @endif

                                    <div class="margin-left-85px">
                                        @if($rating->from->type == 2 || $rating->from->type == 3)
                                            <a target="_blank"
                                               class="d-inline-block text-dark text-medium margin-right-20px"
                                               href="{{ route('user.profiledetails', ["string" => $rating->from->userslug]) }}">
                                                {{ ucfirst($rating->from->name) }}
                                                <small>
                                                    @switch($rating->from->type)
                                                    @case(2)
                                                    (Doctor)
                                                    @break
                                                    @case(3)
                                                    (Clinic)
                                                    @break
                                                    @default
                                                    (Visitor)
                                                    @endswitch
                                                </small>
                                            </a>
                                        @else
                                            <a target="_blank"
                                               class="d-inline-block text-dark text-medium margin-right-20px"
                                               href="javascript:void(0)">{{ ucfirst($rating->from->name) }}
                                                <small>(Visitor)</small>
                                            </a>
                                        @endif

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
                                        <!-- <a href="#" class="d-inline-block text-grey-2 text-up-small"><i class="far fa-file-alt"></i> Edit</a>
                                        <a href="#" class="d-inline-block margin-lr-20px text-grey-2 text-up-small"><i class="far fa-window-close"></i> Delete</a> -->

                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-md-12 alert alert-danger text-center">Ninguna reseña registrada</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
