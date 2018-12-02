@extends('layouts.front3')

@section('content')
    <style>
        #searchResultContainer p {
            cursor: pointer;
        }

        .Content .search-results .container .row .column p span {
            margin-top: 10px;
        }
    </style>
    <?php
    /*$searchKeyword = (isset($_GET['keyword']) && !empty($_GET['keyword'])) ? $_GET['keyword'] : '';
    $searchAddress = (isset($_GET['address']) && !empty($_GET['address'])) ? $_GET['address'] : '';
    $searchLat = (isset($_GET['lat']) && !empty($_GET['lat'])) ? $_GET['lat'] : '';
    $searchLng = (isset($_GET['lng']) && !empty($_GET['lng'])) ? $_GET['lng'] : '';
    $searchCateg = (isset($_GET['category']) && !empty($_GET['category'])) ? $_GET['category'] : '';*/
    ?>
    <div class="hero">
        <div class="container">
            <div class="row">
                <div class="column">
                    <h1>Encuentra tu clínica o médico certificado</h1>
                    <p>No aceptes Ultherapy&reg; de cualquiera. Sólo con nuestras clínicas y médicos certificados
                        obtienes resultados seguros, contundentes y naturales con un equipo 100% original.</p>
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
                            <input id="address" name="address" type="text" placeholder="Ubicación por estado"
                                   autocomplete="off"/>
                            <label for="address">Especialistas cerca de ti</label>
                        </fieldset>
                        <fieldset>
                            <input name="keyword" id="keyword" type="text" placeholder="Nombre del médico/clínica"
                                   autocomplete="off"/>
                        </fieldset>
                        <fieldset>
                            <select name="type" id="choosetype">
                                <option value="">¿Médico o clínica?</option>
                                <option value="2">
                                    Médico
                                </option>
                                <option value="3">
                                    Clínica
                                </option>
                            </select>
                        </fieldset>
                        <fieldset>
                            <input type="hidden" name="addresslat" id="addresslat">
                            <input type="hidden" name="addresslng" id="addresslng">
                            <button type="button" onclick="searchDetails()" id="searchBtn">BUSCAR</button>
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
                    <h2 >Médicos y Clínicas encontrados:</h2>
                    <div id="searchResultContainer">
                        <p class="result" style="margin-top:30px;text-align:center;color:#ff0000;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var noimage = base_url + '/front/assets/images/noimagefound.png';
        var noimageSmall = base_url + '/front/assets/images/noimagefound-small.png';
        var markericon = base_url + '/front/assets/images/markericon.png';

        $(document).ready(function () {

            var autocomplete = new google.maps.places.Autocomplete((
                document.getElementById('address')), {});
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();

                if (!place.geometry) {
                    window.alert("No details available for input: '" + place.name + "', Please choose and address from autocomplete!");
                    return;
                }
                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                $('#addresslat').val(lat);
                $('#addresslng').val(lng);
            });
            setTimeout(function () {
                searchDetails();
            }, 1000);
        });
        function searchDetails() {
            var keyword = $('#keyword').val();
            var address = $('#address').val();
            var addresslat = $('#addresslat').val();
            var addresslng = $('#addresslng').val();
            var category = $('#choosetype').val();
            if (address == '') {
                addresslat = '';
                addresslng = '';
            }
            $("#searchResultContainer").html("<p class='result' style='margin-top:30px;text-align:center;color:#ff0000;'>" +
                "Buscando...</p>");
            $.ajax({
                url: '{{ route("main.search") }}',
                type: 'POST',
                contentType: "application/json",
                dataType: "json",
                data: JSON.stringify({
                    "keyword": keyword,
                    "addresslat": addresslat,
                    "addresslng": addresslng,
                    "category": category
                }),
                success: function (data) {
                    var data = data;
                    setAllMarkers(data);
                },
                error: function (data, textStatus, errorThrown) {
                    alert('Error Occurred');
                }
            });
        }
        function setAllMarkers(data) {

            var html = '';
            for (i in data) {
                var getData = data[i];

                var userid = getData.id;
                var username = getData.name;
                var userslug = getData.userslug;
                var address = getData.address;
                var state = getData.state;
                var city = getData.city;
                var userlat = getData.userlat;
                var userlng = getData.userlng;
                var type = getData.type;
                var userrating = getData.avg_rating.length > 0 ? Math.round(getData.avg_rating[0].avg) : 0;
                var image = getData.image;
                image = (image == '') ? noimage : base_url + '/uploads/userimage/' + userid + '/' + image;
                var profilelink = '{{ url('/profile') }}' + '/' + userslug;

                var className = (type == 2) ? 'medic' : 'clinic';
                html += '<p class="' + className + ' result" onclick="showProfile(\'' + profilelink + '\')">';
                html += '<img src="' + image + '" alt="' + ucfirst(username) + '" />';
                html += '<span>' + ucfirst(username) + '</span>';
                html += '<span><b>' + state + '</b><i>' + city + '</i></span>';
                html += '</p>';
                /*****************************************************/

            }
            if (html == '') {
                html += '<p class="result" style="margin-top:30px;text-align:center;color:#ff0000;">' +
                            'No se encontraron resultados para tu búsqueda' +
                        '</p>';
            }
            $('#searchResultContainer').html(html);
        }
        function ucfirst(str) {
            var text = str;
            var parts = text.split(' '),
                len = parts.length,
                i, words = [];
            for (i = 0; i < len; i++) {
                var part = parts[i];
                var first = part[0].toUpperCase();
                var rest = part.substring(1, part.length);
                var word = first + rest;
                words.push(word);

            }
            return words.join(' ');
        }

        function showProfile(profilelink) {
            window.open(profilelink);
        }
    </script>
@endsection
