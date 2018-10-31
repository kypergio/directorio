@extends('layouts.front')

@section('content')

<!-- Main Content -->
    <div class="Content">
      <!-- Add your content here -->

        <div class="hero">
            <div class="container">
                <div class="row">
                    <div class="column">
                        <h1>Encuentra tu clinica o medico certificado</h1>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-bar">
            <div class="container">
                <div class="row">
                    <div class="column">
                        <form action="" method="" autocomplete="off" novalidate>
                            <fieldset>
                                <input id="ubicacion" name="ubicacion" type="text" placeholder="Ubicacion por estado" autocomplete="off" />
                                <label for="ubicacion">Especialistas cerca de ti</label>
                            </fieldset>
                            <fieldset>
                                <input name="medico" type="text" placeholder="Nombre del medico/clinica" autocomplete="off" />
                            </fieldset>
                            <fieldset>
                                <select name="type"><option value="">Medico o clinica?</option><option value="">Medico</option><option value="">Clinica</option></select>
                            </fieldset>
                            <fieldset>
                                <button>Buscar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="search-results">
            <div class="container">
                <div class="row">
                    <div class="column">
                        <h2>Medicos y Clinicas encontrados</h2>
                        <p class="medic">
                            <img src="{{ asset('public/front') }}/assets/img/kaloni.jpg" alt="Kaloni" />
                            <span>Hospital De Luz</span>
                            <span><b>CDMX</b>Polanco</span>
                        </p>
                        <p class="clinic">
                            <img src="{{ asset('public/front') }}/assets/img/kaloni.jpg" alt="Kaloni" />
                            <span>Hospital De Luz</span>
                            <span><b>CDMX</b>Polanco</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

      <!-- Add your content here -->
    </div>

@endsection
