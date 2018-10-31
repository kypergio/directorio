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
                            <li class="active">Mi ubicación</li>
                        </ol>
                        <h1 class="font-weight-300">Mi ubicación</h1>
                    </div>
                </div>
                <!-- // Page Title -->
                
                <div class="row margin-tb-45px full-width">
                    @if(session()->has('message.level'))
                    <div class="col-md-12 horizontal-center alert alert-{{ session('message.level') }}"> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        {!! session('message.content') !!}
                    </div>
                    @endif
                   
                    <div class="col-md-8">
                        <div><small>Da un click en el mapa para obtener tu locación</small></div>
                        <div id="map_canvas" style="widows: 100%;height:400px;"></div>
                    </div>
                    <div class="col-md-4">
                      <form action="{{ route('user.userlocationUpdate') }}" method="post" name="updatelocation" id="updatelocation" onsubmit="return confirmDetails()">
                      @csrf
                      <div class="row">
                          <div class="col-md-12 margin-bottom-20px">
                              <label>
                                  <i class="far fa-user margin-right-10px"></i>
                                  Dirección
                                  <sup class="requiredSup">*</sup>
                              </label>
                              <input type="text" class="form-control form-control-sm" placeholder="DIrección"
                                     name="address" id="address" required onchange="geocodeAddress();"
                                     value="{{ $userdetails->address }}">
                          </div>
                          <div class="col-md-6 margin-bottom-20px">
                              <label><i class="fas fa-map-marker margin-right-10px"></i> Calle</label>
                              <input type="text" class="form-control form-control-sm" placeholder="Calle" name="street" id="street" value="{{ $userdetails->street }}" onchange="geocodeAddress();">
                          </div>
                          <div class="col-md-6 margin-bottom-20px">
                              <label><i class="fas fa-map-marker margin-right-10px"></i> Colonia</label>
                              <input type="text" class="form-control form-control-sm" placeholder="Colonia" name="colony" id="colony"  value="{{ $userdetails->colony }}"  onchange="geocodeAddress();" >
                          </div>
                          <div class="col-md-6 margin-bottom-20px">
                              <label><i class="fas fa-map-marker margin-right-10px"></i> Estado</label>
                              <input type="text" class="form-control form-control-sm" placeholder="Estado" name="state" id="state" value="{{ $userdetails->state }}" onchange="geocodeAddress();" >
                          </div>
                          <div class="col-md-6 margin-bottom-20px">
                              <label><i class="fas fa-map-marker margin-right-10px"></i> Ciudad</label>
                              <input type="text" class="form-control form-control-sm" placeholder="Ciudad" name="city" id="city"  value="{{ $userdetails->city }}" onchange="geocodeAddress();" >
                          </div>
                          <div class="col-md-6 margin-bottom-20px">
                              <label><i class="fas fa-map-marker margin-right-10px"></i> Latitud</label>
                              <input type="text" class="form-control form-control-sm" name="latitude" id="latitude" readonly value="{{ $userdetails->lat }}">
                          </div>
                          <div class="col-md-6 margin-bottom-20px">
                              <label><i class="fas fa-map-marker margin-right-10px"></i> Longitud</label>
                              <input type="text" class="form-control form-control-sm" placeholder="" name="longitude" id="longitude" readonly value="{{ $userdetails->lng }}" >
                          </div>
                          <div class="col-md-12 margin-bottom-20px text-center">
                              <button type="submit" name="submit" class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block">
                                  Guardar Dirección
                              </button>
                          </div>
                      </div>
                      
                      <hr class="margin-tb-40px">
                      

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


<script>
    var map, geocoder, marker;
    function initMap(){
        geocoder = new google.maps.Geocoder();
        map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 6,
            center: {lat: 23.634501, lng: -102.55278399999997}
        });
        google.maps.event.addListener(map, 'click', function( event ){
            var lat = event.latLng.lat(); 
            var lng =  event.latLng.lng();
            if(marker){
                marker.setMap(null);
            }
            var myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true
            });
            markerDragend(marker);
            reverseGeocodeLatLng(lat,lng);
        });

        /*var autocomplete = new google.maps.places.Autocomplete((
                document.getElementById('address')), {
        });
        
        autocomplete.addListener('place_changed', function() {
              var place = autocomplete.getPlace();
              if (!place.geometry) {
                window.alert("No details available for input: '" + place.name + "', Please choose and address from autocomplete!");
                return;
              }

                var lat = place.geometry.location.lat();
                var lng = place.geometry.location.lng();
                var myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
                
                if(marker) { marker.setMap(null); }
                marker = new google.maps.Marker({
                    map: map,
                    position: myLatlng,
                    draggable: true
                });
                markerDragend(marker); 
                reverseGeocodeLatLng(lat, lng, 'fromAutocomplete');
                map.setCenter(myLatlng);

        });*/

        var getLat = $('#latitude').val();
        var getLng = $('#longitude').val();
        if(getLat != '' && getLng != ''){
            var myLatlng = new google.maps.LatLng(parseFloat(getLat), parseFloat(getLng));
            marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true
            });
            markerDragend(marker);
            map.setCenter(myLatlng);
            map.setZoom(12);
        }

        /********************/
        //to put share location button on map.
        var DivCcnsBtm = document.createElement('div');
        DivCcnsBtm.innerHTML = '<div style="margin-top:-16px;">';
        DivCcnsBtm.innerHTML +=     '<span class="btn btn-info btn-sm" onclick="shareLocation()">ShareLocation</span>';
        
        DivCcnsBtm.innerHTML += '</div>';
        DivCcnsBtm.index = 0;
        map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(DivCcnsBtm);
        /********************/
    }
    function shareLocation(){
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    }
    function showPosition(position) {
        if(marker){
            marker.setMap(null);
        }
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        
        var myLatlng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
        $('#latitude').val(lat);
        $('#longitude').val(lng);
        reverseGeocodeLatLng(lat, lng);
        map.setCenter(myLatlng);
        marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            draggable: true
        });
        markerDragend(marker); 
    }
    function reverseGeocodeLatLng(lat, lng, fromAutocomplete) {
        var latlng = {lat: parseFloat(lat), lng: parseFloat(lng)};
        geocoder.geocode({'location': latlng}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
                //console.log(results[0].formatted_address);
                if(fromAutocomplete == undefined){
                    $('#address').val(results[0].formatted_address);
                }
                
                if (results[1]) {
                var indice=0;
                for (var j=0; j<results.length; j++)
                {
                    if (results[j].types[0]=='locality')
                        {
                            indice=j;
                            break;
                        }
                    }
                //alert('The good number is: '+j);
                //console.log(results[j]);
                for (var i=0; i<results[j].address_components.length; i++)
                    {   
                        if (results[j].address_components[i].types[0] == "route") {
                                //this is the object you are looking for City
                                street = results[j].address_components[i];
                                //console.log(street.long_name);
                                //$('#city').val(city.long_name);
                            }
                        if (results[j].address_components[i].types[0] == "locality") {
                                //this is the object you are looking for City
                                city = results[j].address_components[i];
                                $('#city').val(city.long_name);
                            }
                        if (results[j].address_components[i].types[0] == "administrative_area_level_1") {
                                //this is the object you are looking for State
                                region = results[j].address_components[i];
                                $('#state').val(region.long_name);
                            }
                        if (results[j].address_components[i].types[0] == "country") {
                                //this is the object you are looking for
                                //console.log(results[j].address_components);
                                country = results[j].address_components[i];
                            }
                    }

                    //city data
                    //alert(city.long_name + " || " + region.long_name + " || " + country.short_name)


                    } else {
                      alert("No results found");
                    }



            } else {
              window.alert('No results found');
            }
          } else {
            window.alert('Geocoder failed due to: ' + status);
          }
        });
    }

    function markerDragend(marker){
        google.maps.event.addListener(marker,'dragend',function(event) {
            document.getElementById('latitude').value =event.latLng.lat();
            document.getElementById('longitude').value =event.latLng.lng();

            reverseGeocodeLatLng(event.latLng.lat(), event.latLng.lng())
        });
    }
    function geocodeAddress() {
        if(marker){
            marker.setMap(null);
        }

        var getAddress = '';

        var address = document.getElementById('address').value;
        var street = $('#street').val();
        if(street != ''){
            address += ', '+ street;
        }

        var colony = $('#colony').val();
            if(colony != ''){
                address += ', '+ colony;
            }

        var city = $('#city').val();
            if(city != ''){
                address += ', '+ city;
            }

        var state = $('#state').val();
            if(city != ''){
                address += ', '+ state;
            }
        
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            if(marker) { marker.setMap(null); }
            map.setCenter(results[0].geometry.location);
            marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location,
                draggable: true
            });
            markerDragend(marker);   
            
            $('#latitude').val(results[0].geometry.location.lat());
            $('#longitude').val(results[0].geometry.location.lng());
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
    }
    $(document).ready(function(){
        initMap();
        $('#updatelocation').validate();
    });
    function confirmDetails(){
        if(!$('#updatelocation').valid()){
            return false;
        }
        if(confirm('Are you sure the Address and Location is fine?')){
            return true;
        }else{}
            return false;
    }
</script>
@endsection
