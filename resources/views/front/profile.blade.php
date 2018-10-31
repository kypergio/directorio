@extends('layouts.front')

@section('content')
<!-- Main Content -->
    <div class="Content">
      <!-- Add your content here -->

        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="column medic">
                        <img src="/front/assets/img/photo-doctor-female.png" alt="" />
                        <span>María Emilia del Pino Flores</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="location">
            <div class="container">
                <div class="row">
                    <div class="column half">
                        <p><span>Horarios</span> Lunes a Viernes 9:00 - 19:00 hrs.  <br /> Sábados y Domingos 11:00 - 15:00 hrs.</p>
                        <p>Regístrate para mayor información.<br /><br /><a href="#" onclick="return openModal()">Registrarme</a></p>
                    </div>
                    <div class="column half">
                        <img src="/front/assets/img/map.png" alt="" />
                    </div>
                </div>
            </div>
        </div>

      <!-- Add your content here -->
    </div>

@endsection
