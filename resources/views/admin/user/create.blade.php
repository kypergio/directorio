@extends('layouts.adminlayout')

@section('pagecontent')
<style>
#map_canvas {
	width: 100%;
	height:300px;
}
label.error{
	font-weight: normal;
}	
</style>

<div class="page-title">
	<div class="title_left">
	  <h3>Add new user</h3>
	</div>
</div>
<div class="clearfix"></div>
<!--
@if(count($errors) > 0)
@foreach ($errors->all() as $error)
<div class="horizontal-center alert alert-danger alert-dismissable">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    {{$error}}
</div>
@break
@endforeach
@endif
-->

@if(session()->has('message.level'))
<div class="horizontal-center alert alert-{{ session('message.level') }}"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {!! session('message.content') !!}
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
        
          <form id="addUserdetails" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('user.store') }}" enctype="multipart/form-data" >
          	<input type="hidden" name="_token" value="{{ csrf_token() }}">
          	<h4>User Login Details</h4>
			<div class="form-group label-floating is-select">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Crear usuario como <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">
	                <select class="form-control col-md-7 col-xs-12" name="userType" id="userType" required >
	                    <option value="2">Doctor</option>
	                    <option value="3">Clínica</option>
	                </select>
            	</div>
                <div class="error">{{ $errors->first('userType') }}</div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email (será tu login) <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="email" id="email" required="required" class="form-control col-md-7 col-xs-12" name="email" value="{{ old('email') }}">
					<div class="error">{{ $errors->first('email') }}</div>
	            </div>
            </div>
			<div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Contraseña <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="password" id="password" required="required" class="form-control col-md-7 col-xs-12" name="password" value="{{ old('password') }}">
					<div class="error">{{ $errors->first('password') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label col-md-3 col-sm-3 col-xs-12" for="password_confirmation">Confirmar Contraseña <span class="required">*</span>
				</label>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<input type="password" id="password_confirmation" required="required" class="form-control col-md-7 col-xs-12" name="password_confirmation" value="{{ old('password_confirmation') }}">
					<div class="error">{{ $errors->first('password_confirmation') }}</div>
	            </div>
            </div>

            <div class="ln_solid"></div>
			
			<h4>Detalles Personales</h4>
			<div class="col-md-6">
            <div class="form-group">
				<label class="control-label" for="name">Nombre Completo <span class="required">*</span>
				</label>
				<div class="">
					<input minlength="2" type="text" id="name" required="required" value="{{ old('name') }}" class="form-control col-md-7 col-xs-12" name="name">
					<div class="error">{{ $errors->first('name') }}</div>
	            </div>

            </div>
           	<div class="form-group">
				<label class="control-label" for="contact">Teléfono <span class="required">*</span>
				</label>
				<div class="">
					<input minlength="10" maxlength="25" type="text" id="contact" required="required" class="form-control col-md-7 col-xs-12" name="contact" value="{{ old('contact') }}">
					<div class="error">{{ $errors->first('contact') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label" for="website">Website 
				</label>
				<div class="">
					<input type="text" id="website"  class="form-control col-md-7 col-xs-12" name="website" value="{{ old('website') }}">
					<div class="error">{{ $errors->first('website') }}</div>
	            </div>
            </div>

            <div class="form-group">
				<label class="control-label" for="address">Descripción <span class="required">*</span></label>
				<div class="">
					<textarea required minlength="20" class="form-control col-md-7 col-xs-12" name="description" id="description">{{ old('description') }}</textarea>
					<div class="error">{{ $errors->first('description') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label" for="address">Especialización</label>
				<div class="">
					<textarea class="form-control col-md-7 col-xs-12" name="specialization" id="specialization">{{ old('specialization') }}</textarea>
					<div class="error">{{ $errors->first('specialization') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label" for="address">Acerca de <span class="required">*</span></label>
				<div class="">
					<textarea required minlength="20"  class="form-control col-md-7 col-xs-12" name="about" id="about">{{ old('about') }}</textarea>
					<div class="error">{{ $errors->first('about') }}</div>
	            </div>
            </div>
            <div class="form-group">
				<label class="control-label" for="address">Imagen de Perfil <small>(máximo: 5 MB)</small> </label>
				<div class="">
					<input type="file" name="profilepic" id="profilepic"  accept="image/x-png,image/gif,image/jpeg" >
					<div class="error">{{ $errors->first('profilepic') }}</div>
	            </div>
            </div>
            </div>
            <div class="col-md-6">
            	


            	<div class="row">
                            <label><i class="fa fa-clock-o  margin-right-10px"></i> Disponibilidad</label>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td>Disponible</td>
                                    <td>Día</td>
                                    <td>Desde las</td>
                                    <td>Hasta las</td>
                                </tr>
                                <?php
                                $daysArr = array('mon' => 'Monday', 'tue'  => 'Tuesday', 'wed' => 'Wednesday', 'thu'  => 'Thursday', 'fri' => 'Friday', 'sat' => 'Saturday', 'sun' => 'Sunday');

                                

                                foreach ($daysArr as $key => $value) {
                                    $start = '12:00AM';
                                    $end = '11:59PM';
                                    $interval = '+ 15 minutes';

                                    $start_str = strtotime($start);
                                    $end_str = strtotime($end);
                                    $now_str = $start_str;

                                    //$getUserTimings = $usertimings->{$key.'Timing'};
                                    $getUserTimings = '';

                                    ?>
                                    <tr>
                                        <td><input type="checkbox" name="<?php echo $key;?>AvailableStatus" id="<?php echo $key;?>AvailableStatus"  ></td>
                                        <td><?php echo $value;?></td>
                                        <td>
                                            <select class="form-control-sm" name="<?php echo $key;?>Fromtime" id="<?php echo $key;?>Fromtime">
                                                <?php 

                                                while($now_str <= $end_str){
                                                    $fromTime = date('h:i A', $now_str);
                                                    $selectedFrom = '';
                                                    if($getUserTimings && $getUserTimings[0] == $fromTime){
                                                        $selectedFrom = 'selected="selected"';
                                                    }
                                                    echo '<option   '.$selectedFrom.' value="' . $fromTime . '">' . $fromTime . '</option>';
                                                    $now_str = strtotime($interval, $now_str);
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form-control-sm" name="<?php echo $key;?>Totime" id="<?php echo $key;?>Totime">
                                                <?php 
                                                $now_str = $start_str;
                                                while($now_str <= $end_str){
                                                    $toTime = date('h:i A', $now_str);
                                                    $selectedTo = '';
                                                    if($getUserTimings && $getUserTimings[1] == $toTime){
                                                        $selectedTo = 'selected="selected"';
                                                    }
                                                    echo '<option '.$selectedTo.' value="' . $toTime . '">' . $toTime . '</option>';
                                                    $now_str = strtotime($interval, $now_str);
                                                }
                                                ?>
                                            </select>
                                        </td>
                                    </tr>    
                                <?php }
                                ?>
                                
                            </table>
                        </div>




            </div>
            <div class="clear"></div>
            <div class="ln_solid"></div>
            <h4>Dirección</h4>
			<div class="form-group">
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div><small>Selecciona tu locación en el mapa</small></div>
					<div id="map_canvas"></div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-12">
					<div class="form-group col-md-12">
						<label class="control-label" for="address">Dirección <span class="required">*</span></label></label>
						<div class="">
							<input minlength="3" onchange="geocodeAddress();" required type="text" id="address"  class="form-control col-md-12 col-xs-12" name="address" value="{{ old('address') }}">
							<div class="error">{{ $errors->first('address') }}</div>
			            </div>
		            </div>	
		            <div class="form-group col-md-6">
						<label class="control-label" for="street">Calle</label>
						<div class="">
							<input onchange="geocodeAddress();" type="text" id="street"  class="form-control col-md-12 col-xs-12" name="street" value="{{ old('street') }}">
							<div class="error">{{ $errors->first('street') }}</div>
			            </div>
		            </div>	
		            <div class="form-group col-md-6">
						<label class="control-label" for="colony">Colonia</label>
						<div class="">
							<input onchange="geocodeAddress();" type="text" id="colony"  class="form-control col-md-12 col-xs-12" name="colony" value="{{ old('colony') }}">
							<div class="error">{{ $errors->first('colony') }}</div>
			            </div>
		            </div>	
		            <div class="form-group col-md-6">
						<label class="control-label" for="street">Estado</label>
						<div class="">
							<input onchange="geocodeAddress();" type="text" id="state"  class="form-control col-md-12 col-xs-12" name="state" value="{{ old('state') }}">
							<div class="error">{{ $errors->first('state') }}</div>
			            </div>
		            </div>	
		            <div class="form-group col-md-6">
						<label class="control-label" for="colony">Ciudad</label>
						<div class="">
							<input onchange="geocodeAddress();" type="text" id="city"  class="form-control col-md-12 col-xs-12" name="city" value="{{ old('city') }}">
							<div class="error">{{ $errors->first('city') }}</div>
			            </div>
		            </div>
		            <div class="form-group col-md-6">
						<label class="control-label" for="latitude">Latitud</label>
						<div class="">
							<input type="text" id="latitude" required  class="form-control col-md-12 col-xs-12" name="latitude" value="{{ old('latitude') }}">
							<div class="error">{{ $errors->first('latitude') }}</div>
			            </div>
		            </div>	
		            <div class="form-group col-md-6">
						<label class="control-label" for="longitude">Longitud</label>
						<div class="">
							<input type="text" id="longitude" required  class="form-control col-md-12 col-xs-12" name="longitude" value="{{ old('longitude') }}">
							<div class="error">{{ $errors->first('longitude') }}</div>
			            </div>
		            </div>	
				</div>


			</div>




            
            <div class="row text-center">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Guardar Detalles</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>

<script>
var map, geocoder, marker;

function initialize() {
	geocoder = new google.maps.Geocoder();
    var pyrmont = new google.maps.LatLng(41.066928, -101.425782);    
    map = new google.maps.Map(document.getElementById('map_canvas'), {
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      center: pyrmont,
      zoom: 4,
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
function markerDragend(marker){
    google.maps.event.addListener(marker,'dragend',function(event) {
        document.getElementById('latitude').value =event.latLng.lat();
        document.getElementById('longitude').value =event.latLng.lng();

        reverseGeocodeLatLng(event.latLng.lat(), event.latLng.lng())
    });
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
$(document).ready(function(){
    initialize();

    $('#addUserdetails').validate();
});
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDL5Ae9Mv4lqPyQ1wD3NUhHkpmuX85DFo4&libraries=places,geometry"
></script>
</script>

@stop