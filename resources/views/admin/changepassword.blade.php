@extends('layouts.adminlayout')
@section('pagecontent')

<div class="page-title">
  <div class="title_left">
    <h3>Restablecer su contraseña</h3>
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


@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Detalles </h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <br />
          <form id="demo-form2" method="POST" data-parsley-validate class="form-horizontal form-label-left" action="{{ route('admin.changepassword') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="oldpwd">Contraseña anterior <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
          <input type="text" id="oldpwd" required="required" value="{{ old('oldpwd') }}" class="form-control col-md-7 col-xs-12" name="oldpwd">
          <div class="error">{{ $errors->first('oldpwd') }}</div>
              </div>

            </div>
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpwd">Nueva contraseña<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="newpwd" required="required" class="form-control col-md-7 col-xs-12" name="newpwd" value="{{ old('newpwd') }}">
                    <div class="error">{{ $errors->first('newpwd') }}</div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="newpwd">Confirmación de contraseña <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="newpwd_confirmation" required="required" class="form-control col-md-7 col-xs-12" name="newpwd_confirmation" value="{{ old('newpwd_confirmation') }}">
                    <div class="error">{{ $errors->first('newpwd_confirmation') }}</div>
                </div>
            </div>
           
      
            <div class="ln_solid"></div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="submit" class="btn btn-success">Enviar</button>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>


@stop