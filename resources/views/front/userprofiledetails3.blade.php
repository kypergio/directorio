@extends('layouts.front3')

@section('content')
    <style>
        .modal .row .column .registration form fieldset input, .modal .row .column .registration form fieldset textarea, .modal .row .column .registration form fieldset select {
            border: 1px solid #f1b434;
        }

        .modal .row .column .registration form fieldset:nth-child(4):before {
            border-left: 1px solid #f1b434;;
        }

        .modal .row .column .registration form fieldset:nth-child(4):after {
            border-top: 8px solid #f1b434;
        }
    </style>
    <div class="profile">
        <div class="container">
            <div class="row">
                <div class="column {{ ($userdetails->type == 2) ? 'medic':'clinic' }}">
                    @if($userdetails->image)
                        <img src="/uploads/userimage/{{$userdetails->id}}/{{$userdetails->image}}"
                             alt="{{ $userdetails->name }}" style="max-width: 235px;">
                    @else
                        <img src="/ultherapy/photo-doctor-female.png" alt=""/>
                    @endif
                    <span>{{ ucwords($userdetails->name) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="location">
        <div class="container">
            <div class="row">
                <div class="column half-profile">
                    <p><span>Horarios de atención</span>
                    <table cellpadding="10" class="table-times">
                        <tr>
                            @if($usertimings->monStatus == 1)
                                <td>Lunes &nbsp;&nbsp;</td>
                                <td>{{ str_replace('-', ' - ', $usertimings->monTiming) }} </td></tr>
                        @endif
                        @if($usertimings->tueStatus == 1)
                            <tr>
                                <td>Martes &nbsp;&nbsp;</td>
                                <td>{{ str_replace('-', ' - ', $usertimings->tueTiming) }} </td>
                            </tr>
                        @endif

                        @if($usertimings->wedStatus == 1)
                            <tr>
                                <td>Miércoles &nbsp;&nbsp; </td>
                                <td>{{ str_replace('-', ' - ', $usertimings->wedTiming) }} </td>
                            </tr>
                        @endif

                        @if($usertimings->thuStatus == 1)
                            <tr>
                                <td>Jueves &nbsp;&nbsp; </td>
                                <td>{{ str_replace('-', ' - ', $usertimings->thuTiming) }} </td>
                            </tr>
                        @endif

                        @if($usertimings->friStatus == 1)
                            <tr>
                                <td>Viernes &nbsp;&nbsp; </td>
                                <td>{{ str_replace('-', ' - ', $usertimings->friTiming) }} </td>
                            </tr>
                        @endif

                        @if($usertimings->satStatus == 1)
                            <tr>
                                <td>Sábado&nbsp;&nbsp; </td>
                                <td>{{ str_replace('-', ' - ', $usertimings->satTiming) }} </td>
                            </tr>
                        @endif
                        @if($usertimings->sunStatus == 1)
                            <tr>
                                <td>Domingo &nbsp;&nbsp; </td>
                                <td>{{ str_replace('-', ' - ', $usertimings->sunTiming) }} </td>
                            </tr>
                        @endif
                    </table>
                    </p>
                    <p>Regístrate para mayor información.<br/><br/><a href="#"
                                                                      onclick="return openModal()">Registrarme</a></p>
                </div>
                <div class="column half-profile" style="width: 627px;">
                    <div id="map_canvas" style="width: 620px;height: 340px;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal">
        <div class="row">
            <div class="column">
                <div class="registration">
                    <i onclick="return closeModal()"></i>
                    <p>Llena los campos para recibir por correo la información completa del médico o clínica. Y como nos
                        gusta consentirte, además podrás recibir antes que nadie beneficios exclusivos como promociones,
                        eventos y mucho más.</p>
                    <div id="reqmsgContainer" style="display: none;"></div>
                    <form action="" method="" onsubmit="return saveReqInfo();" name="reqForm" id="reqForm">

                        <fieldset>
                            <input type="text" placeholder="Nombre" id="req_name" name="req_name"/>
                        </fieldset>
                        <fieldset>
                            <input type="text" placeholder="Teléfono" id="req_phone" name="req_phone"/>
                        </fieldset>
                        <fieldset>
                            <input type="text" placeholder="Correo electrónico" email="true" id="req_email"
                                   name="req_email"/>
                        </fieldset>
                        <fieldset>
                            <select name="req_option" id="req_option">
                                <option value="">¿Qué le quieres preguntar?</option>
                                <option value="1">Solicitar Costos</option>
                                <option value="2">Agendar Cita</option>
                                <option value="3">¿Soy candidato(a) al Tratamiento?</option>
                                <option value="4">Informacion Sobre Ultherapy</option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <textarea name="req_description" id="req_description"
                                      placeholder="Cuéntale a tu médico o clínica tu inquietud:"></textarea>
                            <button type="submit" class="buttons" name="submit" id="submit">Enviar</button>
                        </fieldset>
                    </form>
                    <p>Consulta nuestro <strong><a href="">Aviso de Privacidad</a></strong></p>
                </div>
                <div class="success">
                    <strong>Gracias Por Tu Mensaje</strong>
                    <p>Acabamos de enviarte un correo con la información completa del médico o clínica y pronto
                        recibirás una respuesta a tu consulta.</p>
                    <a href="#" class="buttons" onclick="return closeModal()">Salir</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        var map, marker;
        function initMap() {
            var lat = '{{ $userdetails->varylat }}';
            var lng = '{{ $userdetails->varylng }}';
            var zoom = 13;
            if (lat == '' || lng == '') {
                lat = 19.427478;
                lng = -99.167737;
                zoom = 4;
                disableDefaultUI = true;
            }


            var myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));

            map = new google.maps.Map(document.getElementById('map_canvas'), {
                zoom: zoom,
                center: {lat: parseFloat(lat), lng: parseFloat(lng)},
                fullscreenControl: false,
                mapTypeControl: false,
                streetViewControl: false,
                maxZoom: 16
            });

            var locCircle = new google.maps.Circle({
                strokeColor: '#f1b434',
                strokeOpacity: 0.8,
                strokeWeight: 2,
                fillColor: '#f1b434',
                fillOpacity: 0.35,
                map: map,
                center: myLatlng,
                radius: 1200
            });
        }


        $(document).ready(function () {
            initMap();
        });
        function saveReqInfo() {
            var getName = $('#req_name').val();
            var getPhone = $('#req_phone').val();
            var getEmail = $('#req_email').val();
            var getOption = $('#req_option').val();
            var getDesc = $('#req_description').val();

            if (getName == '' || getPhone == '' || getEmail == '' || getOption == '' || getDesc == '') {
                var msg = '<div class="medico" style="text-align:center;color:#ff0000;border: 1px solid #dcdcdc;padding: 10px;background-color: #efeffe;" >Todos los campos son obligatorios</div>';
                $('#reqmsgContainer').show().html(msg).fadeOut(5000);
                return false;
            }

            var touserid = '{{ $userdetails->id }}';
            $.ajax({
                url: '{{ url('/sendProfileRequest') }}',
                type: 'post',
                data: {
                    touserid: touserid,
                    getName: getName,
                    getPhone: getPhone,
                    getEmail: getEmail,
                    getOption: getOption,
                    getDesc: getDesc,
                    _token: '{{csrf_token()}}'
                },
                success: function (data) {
                    if (data == 'emailexists') {
                        $('#reqmsgContainer').show().html('<div class="medico" style="text-align:center;color:#ff0000;border: 1px solid #dcdcdc;padding: 10px;background-color: #efeffe;" >La dirección de correo ya existe</div>').fadeOut(5000);
                        return false;
                    }
                    if (data != 1) {
                        $('#reqmsgContainer').show().html('<div class="medico" style="text-align:center;color:#ff0000;border: 1px solid #dcdcdc;padding: 10px;background-color: #efeffe;" >Se produjo un error</div>').fadeOut(5000);
                        return false;
                    }
                    registration();
                },
                error: function (data, textStatus, errorThrown) {
                    $('#reqmsgContainer').show().html('<div class="medico" style="text-align:center;color:#ff0000;border: 1px solid #dcdcdc;padding: 10px;background-color: #efeffe;" >Se produjo un error</div>').fadeOut(5000);
                },
            })


            return false;
        }
    </script>

@endsection
