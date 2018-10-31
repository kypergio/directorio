@extends('layouts.adminlayout')

@section('pagecontent')

<style>
    
#map_canvas{
    width: 100%;
    height: 300px;
}
</style>
<div class="page-title">
    <div class="title_left">
      <h3>Información</h3>
    </div>
</div>
<div class="clearfix"></div>

@if(session()->has('message.level'))
<div class="horizontal-center alert alert-{{ session('message.level') }}"> 
    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {!! session('message.content') !!}
</div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
    </div>

    
</div>

<div class="">
    <div class="row top_tiles">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-caret-square-o-right"></i>
            </div>
            <div class="count">{{ $countData->usersCount }}</div>

            <h3>Inscripciones</h3>
            <p>Total de usuarios</p>
          </div>
        </div>
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats">
            <div class="icon"><i class="fa fa-comments-o"></i>
            </div>
            <div class="count">{{ $countData->contactsCount }}</div>

            <h3>Contáctanos</h3>
            <p>Cantidad de formas llenadas.</p>
          </div>
        </div>
        
        
    </div>
</div>
@stop