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
                            <li class="active">Mi Perfil</li>
                        </ol>
                        <h1 class="font-weight-300">Mi Perfil</h1>
                    </div>
                </div>
                <!-- // Page Title -->
                <form action="{{ route('user.updateprofiledetails') }}" method="post" name="editprofile"
                      id="editprofile" enctype="multipart/form-data">
                    <div class="row margin-tb-45px full-width">
                        @if(session()->has('message.level'))
                            <div class="col-md-12 horizontal-center alert alert-{{ session('message.level') }}">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                {!! session('message.content') !!}
                            </div>
                        @endif
                        @csrf
                        <div class="col-md-4">
                            <div class="padding-15px background-white">
                                <a href="javascript:voide(0)" id="imageContainer" class="d-block margin-bottom-10px">
                                    @if($userdetails->image)
                                        <img id="imgUserimage"
                                             src="/uploads/userimage/{{$userdetails->id}}/{{$userdetails->image}}"
                                             alt="">
                                    @else
                                        <img id="imgUserimage" src="/front/assets/images/blank-profile-picture.png"
                                             alt="">
                                    @endif
                                </a>
                                <div class="error text-center">(max size: 5 mb)</div>
                                <input accept="image/x-png,image/gif,image/jpeg" type="file" name="profilepic"
                                       id="profilepic"
                                       class="btn btn-sm  text-white background-main-color btn-block">
                                Subir imagen

                                <div class="error">{{ $errors->first('profilepic') }}</div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6 margin-bottom-20px">
                                    <label>
                                        <i class="far fa-user margin-right-10px"></i>
                                        Nombre Completo
                                        <sup class="requiredSup">*</sup>
                                    </label>
                                    <input type="text" class="form-control form-control-sm" name="fullname"
                                           id="fullname" placeholder="Nombre Completo" required
                                           value="{{ $userdetails->name }}" minlength="3" maxlength="25">
                                    <div class="error">{{ $errors->first('fullname') }}</div>
                                </div>

                                <div class="col-md-6 margin-bottom-20px">
                                    <label>
                                        <i class="far fa-envelope-open margin-right-10px"></i>
                                        Correo Electrónico
                                    </label>
                                    <input type="text" class="form-control form-control-sm"
                                           placeholder="Correo Electrónico" readonly
                                           value="{{ $userdetails->email }}">
                                </div>
                                <div class="col-md-6 margin-bottom-20px">
                                    <label>
                                        <i class="fas fa-mobile-alt margin-right-10px"></i>
                                        Teléfono
                                        <sup class="requiredSup">*</sup>
                                    </label>
                                    <input type="text" class="form-control form-control-sm"
                                           placeholder="Teléfono" name="phone" id="phone" required
                                           value="{{ $userdetails->phone }}" maxlength="15">
                                </div>
                                <div class="col-md-6 margin-bottom-20px">
                                    <label>
                                        <i class="fas fa-link margin-right-10px"></i>
                                        Sitio Web
                                    </label>
                                    <input type="text" class="form-control form-control-sm"
                                           placeholder="mi-sitio.com" name="website" id="website"
                                           value="{{ $userdetails->website }}" url="true">
                                </div>
                                <div class="col-md-6 margin-bottom-20px">
                                    <label><i class="fas fa-info margin-right-10px"></i> Descripción
                                        <sup class="requiredSup">*</sup></label>
                                    <textarea class="form-control form-control-sm" name="description" id="description"
                                              placeholder="Descripción" required
                                              minlength="20">{{ $userdetails->description }}</textarea>
                                </div>
                                <div class="col-md-6 margin-bottom-20px">
                                    <label><i class="fas fa-info margin-right-10px"></i> Especialización
                                        <sup class="requiredSup">*</sup></label>
                                    <textarea class="form-control form-control-sm" name="specialization"
                                              id="specialization" required=""
                                              placeholder="Especialización">{{ $userdetails->specialization }}</textarea>
                                </div>
                                <div class="col-md-6 margin-bottom-20px">
                                    <label><i class="fas fa-info margin-right-10px"></i> Acerca de ti
                                        <sup class="requiredSup">*</sup></label>
                                    <textarea class="form-control form-control-sm" name="about" id="about"
                                              placeholder="Acerca de ti" required
                                              minlength="20">{{ $userdetails->about }}</textarea>
                                </div>
                            </div>
                            <hr class="margin-tb-40px">

                            <div class="row">
                                <label><i class="fas fa-clock margin-right-10px"></i> Horario Disponible
                                </label>
                                <table class="table table-striped">
                                    <tr>
                                        <td>Disponibilidad</td>
                                        <td>Día</td>
                                        <td>Desde</td>
                                        <td>Hasta</td>
                                    </tr>
                                    @php
                                        $daysArr = [
                                        'mon' => "Lunes",
                                        'tue'  => "Martes",
                                        'wed' => "Miércoles",
                                        'thu'  => "Jueves",
                                        'fri' => "Viernes",
                                        'sat' => "Sábado",
                                        'sun' => "Domingo"
                                        ];
                                    @endphp
                                    @foreach ($daysArr as $key => $value)
                                        @php
                                            $start = '12:00AM';
                                            $end = '11:59PM';
                                            $interval = '+ 15 minutes';

                                            $start_str = strtotime($start);
                                            $end_str = strtotime($end);
                                            $now_str = $start_str;

                                            $getUserTimings = $usertimings->{$key.'Timing'};
                                            $getUserTimings = ($getUserTimings) ? explode('-', $getUserTimings): '';
                                        @endphp

                                        <tr>
                                            <td><input type="checkbox" name="{{$key}}AvailableStatus"
                                                       id="monAvailableStatus" {{$usertimings->{$key . "Status"} ? "checked": ""}} >
                                            </td>
                                            <td>{{$value}}</td>
                                            <td>
                                                <select class="form-control-sm" name="{{$key}}Fromtime"
                                                        id="{{$key}}Fromtime">
                                                    @while($now_str <= $end_str)
                                                        @php
                                                            $fromTime = date('h:i A', $now_str);
                                                            $selectedFrom = '';
                                                            if ($getUserTimings && $getUserTimings[0] == $fromTime) {
                                                                $selectedFrom = 'selected="selected"';
                                                            }
                                                            $now_str = strtotime($interval, $now_str);
                                                        @endphp
                                                        <option {{$selectedFrom}} value="{{$fromTime}}">{{$fromTime}}</option>
                                                    @endwhile
                                                </select>
                                            </td>
                                            <td>
                                                <select class="form-control-sm" name="{{$key}}Totime"
                                                        id="{{$key}}Totime">
                                                    @php
                                                        $now_str = $start_str;
                                                    @endphp
                                                    @while($now_str <= $end_str)
                                                        @php
                                                            $toTime = date('h:i A', $now_str);
                                                            $selectedTo = '';
                                                            if ($getUserTimings && $getUserTimings[1] == $toTime) {
                                                                $selectedTo = 'selected="selected"';
                                                            }
                                                            $now_str = strtotime($interval, $now_str);
                                                        @endphp
                                                        <option {{$selectedTo}} value="{{$toTime}}">{{$toTime}}</option>
                                                    @endwhile
                                                </select>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            <button class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block"
                                    type="submit" name="submit" id="submit">Actualizar perfil
                            </button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#editprofile').validate();
        });
        function readImgURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#imgUserimage').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#profilepic").change(function () {
            readImgURL(this);
        });
    </script>
@endsection
