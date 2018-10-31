@extends('layouts.front2')

@section('content')
<style>
    #map_canvas {
        width: 100%;
        height: 600px;
    }
    #map_canvas .gm-style .item-thumbnail img {
        height: auto;
        max-width: 100% !important;
    }
    #map_canvas .gomapMarker {
        overflow: hidden;
    }
    #searchBtn {
        background-color: #f1b434;
    }
</style>
<?php
$searchKeyword = (isset($_GET['keyword']) && !empty($_GET['keyword']) ) ? $_GET['keyword'] : '';
$searchAddress = (isset($_GET['address']) && !empty($_GET['address']) ) ? $_GET['address'] : '';
$searchLat = (isset($_GET['lat']) && !empty($_GET['lat']) ) ? $_GET['lat'] : '';
$searchLng = (isset($_GET['lng']) && !empty($_GET['lng']) ) ? $_GET['lng'] : '';
$searchCateg = (isset($_GET['category']) && !empty($_GET['category']) ) ? $_GET['category'] : 'All Type';
if($searchCateg != 'doctor' && $searchCateg != 'clinic'){
    $searchCateg = 'All Type';
}
?>
<div>
        <div class="map-distributors-in height-550px">
        <div id="map_canvas"></div>
        
</div>
<script >

var map, bounds, infoWindow;
var markers = [];
//var noimage = base_url+'/public/front/assets/images/blank-profile-picture.png';
var noimage = base_url+'/public/front/assets/images/noimagefound.png';
var noimageSmall = base_url+'/public/front/assets/images/noimagefound-small.png';
var markericon = base_url+'/public/front/assets/images/markericon.png';

function initMap() {
    bounds = new google.maps.LatLngBounds();
    infoWindow = new google.maps.InfoWindow();
    map = new google.maps.Map(document.getElementById('map_canvas'), {
        zoom: 6,
        center: {lat: 23.634501, lng: -102.55278399999997},
        maxZoom:12
    });

    var autocomplete = new google.maps.places.Autocomplete((
        document.getElementById('address')), {
    });
    //places = new google.maps.places.PlacesService(map);
    autocomplete.addListener('place_changed', function() {
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
    searchDetails();
}

jQuery(document).ready(function(){
    initMap();
    $('button.dropdown-item').click(function(){
        var getVal = $(this).val();
        var getText = $(this).text();
        $('a#dropdownMenu2').text(getText);
        $('#category').val(getVal);
    });
});

function searchDetails(){
    var keyword = $('#keyword').val();
    var address = $('#address').val();
    var addresslat = $('#addresslat').val();
    var addresslng = $('#addresslng').val();
    if(address == ''){
        addresslat = '';
        addresslng = '';
    }
    var category = $('#category').val();

    var createSearchLink = base_url+'?keyword='+keyword+'&address='+address+'&lat='+addresslat+'&lng='+addresslng+'&category='+category
    $('#createSearchLink').show().text(createSearchLink);
    $.ajax({
        url: '{{ url('/searchDetailsMap') }}',
        type: 'POST',
        data: {
            "_method": 'POST',
            "_token": '{{csrf_token()}}',
            "keyword": keyword,
            "addresslat": addresslat,
            "addresslng": addresslng,
            "category": category,
        },
        success: function (data){
            var data = JSON.parse(data);
            if(data.length > 0){
                setAllMarkers(data);
            }else{
                alert('No hubo resultados para tu búsqueda, intenta con otros nombres, por favor');
            }
        },
        error: function (data, textStatus, errorThrown) {
            alert('Error Occurred');
        }
    });
}

function clearMarkers(){
    if(markers.length > 0){
        for(i in markers){
            markers[i].setMap(null);
        }
        markers = [];
    }
}

function setAllMarkers(data){
    
    if(data.length > 0){
        clearMarkers();
        bounds = new google.maps.LatLngBounds();
        var html = '';
        for(i in data){
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
            var userrating = Math.round(getData.userrating);
            var image = getData.image;
                image = (image == '') ? noimage: base_url+'/public/uploads/userimage/'+userid+'/'+image;
            var profilelink = '{{ url('/profile') }}'+'/'+userslug;

            var myLatLng = new google.maps.LatLng(userlat, userlng);
            bounds.extend(myLatLng);

            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: markericon,
                username: username,
                userslug: userslug,
                address: address,
                type: type,
                image: image,
                userrating: userrating,
                profilelink:profilelink
            });
            markers.push(marker);
            bindMarkerClickInfowindow(marker);
            /*****************************************************/
                html += '<li class="border-bottom-1 border-grey-1 margin-bottom-20px">';
                html +=     '<a href="'+profilelink+'" target="_blank"><img style="width:60px;height:60px;" src="'+image+'" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt=""></a>';
                
                html +=     '<div class="row">';
                html +=         '<div class="col-md-9">';
                if(type == 2){
                    html +=    '<a class="d-inline-block text-dark text-medium margin-right-20px" href="'+profilelink+'" target="_blank">Doctor</a>';
                }else{
                    html +=    '<a class="d-inline-block text-dark text-medium margin-right-20px" href="'+profilelink+'" target="_blank" >Clínica </a>';
                }
                //html +=             '<a class="d-inline-block text-dark text-medium margin-right-20px" href="">Bakhita alrawi </a>';
                html +=         '<div class="">';
                html +=             '<a target="_blank" href="'+profilelink+'"><span>'+ucfirst(username)+'</span></a>';
                html +=         '</div>';
                html +=         '<p class="margin-top-15px text-grey-2">&nbsp;</p>';
                html +=     '</div>';
                html +=     '<div class="col-md-3">';
                html +=         '<a class="d-inline-block text-dark text-medium margin-right-20px" href="#">'+state+' </a>';
                html +=         '<div class="">';
                html +=             '<span>'+city+'</span>';
                html +=         '</div>';
                html +=         '<p class="margin-top-15px text-grey-2">&nbsp;</p>';
                html +=     '</div>';
                html +=     '</div>';
                html +=  '</li>';
            /*****************************************************/

        }
        if(html == ''){
            html += '<li class="border-bottom-1 border-grey-1 margin-bottom-20px">';
            html +=     '<div class="alert alert-danger text-center">No records found</div>';
            html += '</li>';
        }
        $('#searchResultContainer').html(html);
        if(markers.length > 0){
            map.fitBounds(bounds);
        }
    }
}

function bindMarkerClickInfowindow(marker){
    google.maps.event.addListener(marker, 'click', function() {
        var getName = this.username;
        var getImage = this.image;
        var userslug = this.userslug;
        var address = this.address;
        var userrating = this.userrating
        
        var html = '<div class="gomapMarker">';
            html +=    '<div class="background-white width-250px">';
            html +=        '<div class="item-thumbnail gradient text-center"> <a href="'+base_url+'/profile/'+userslug+'" target="_blank" ><img src="'+getImage+'" alt=""></a> </div>';
            html +=        '<div class="padding-top-20px padding-lr-20px">';
            html +=            '<div class="z-index-2 position-relative">';
            html +=                '<h5 class="text-center margin-bottom-20px" ><a style="color:#4285F4;" href="'+base_url+'/profile/'+userslug+'" target="_blank" >'+ucfirst(getName)+'</a></h5>';
            html +=                '<div class="rating clearfix">';
            html +=                    '<span class="float-left text-grey-2">';
            html +=                        '<i class="far fa-map"></i> '+ucfirst(address);
            html +=                    '</span>';
            html +=                    '<ul class="float-right">';
            for(i=1; i<=5; i++){
                if(userrating >= i){
                    html +=                        '<li class="active"></li>';    
                }else{
                    html +=                        '<li></li>';    
                }
            }
            html +=                    '</ul>';
            html +=                '</div>';
            html +=            '</div>';
            html +=        '</div>';
            html +=    '</div>';
            html += '</div>';
        infoWindow.setContent(html);
        infoWindow.open(map, this);
    });
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
};
</script>
        
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="listing-search pull-top-150px z-index-99 position-relative box-shadow">
                        <form class="row no-gutters">
                            <div class="col-md-3 col-6">
                                <div class="keywords">
                                    <input class="listing-form first" type="text" placeholder="@lang('labels.keywords')" name="keyword" id="keyword" value="<?php echo $searchKeyword; ?>" >
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="regions">
                                    <input class="listing-form" type="text" name="address" id="address" placeholder="@lang('labels.all_estado')" value="<?php echo $searchAddress; ?>">
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="categories dropdown">
                                    <a class="listing-form d-block" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $searchCateg; ?></a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                        <button class="dropdown-item text-up-small" type="button" value="all">@lang('labels.all_type')</button>
                                        <button class="dropdown-item text-up-small" type="button" value="doctor">Doctors</button>
                                        <button class="dropdown-item text-up-small" type="button" value="clinic">Clinics</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <input type="hidden" name="addresslat" id="addresslat" value="<?php echo $searchLat; ?>">
                                <input type="hidden" name="addresslng" id="addresslng" value="<?php echo $searchLng; ?>">
                                <input type="hidden" name="category" id="category" value="<?php echo $searchCateg; ?>">
                                <button type="button" onclick="searchDetails()" class="listing-bottom background-dark box-shadow" id="searchBtn" >@lang('labels.search_now')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clear" style="padding: 10px;margin: 50px 0px 0px 0px;text-align: center;">
            <div id="createSearchLink" style="display: none;padding:10px;background-color: #dcdcdc; "></div>
        </div>
    </div>


    <div class="container">
        <div class="row">
                <div class="col-lg-12">

                    

                   

                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white" >
                            <ul class=" padding-0px margin-0px list-unstyled text-grey-3" id="searchResultContainer">
                            </ul>
                        </div>
                    </div>

                   

                </div>
                
            </div>
    </div>

@endsection
