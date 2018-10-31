@extends('layouts.front3')

@section('content')
<link rel="stylesheet" href="/front/assets/css/bootstrap.min.css">
<style>
    .Content {
        max-width: 500px;
        margin: auto;
        border: 1px solid #dcdcdc;
        margin-top:10px;
        margin-bottom: 20px;
    }
    .btn-primary {
        background-color:#f1b434;
        border-color:#f1b434;
    }
    textarea:focus,
    input[type="text"]:focus,
    input[type="password"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="time"]:focus,
    input[type="week"]:focus,
    input[type="number"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="search"]:focus,
    input[type="tel"]:focus,
    input[type="color"]:focus,
    .uneditable-input:focus {   
      border-color: #f1b434;
      box-shadow: 0 1px 1px #f1b434 inset, 0 0 8px #f1b434;
      outline: 0 none;
    }
</style>
<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5 hidden">
                <li><a href="#">@lang('labels.home')</a></li>
                <li class="active">@lang('labels.login')</li>
            </ol>
            <h1 class="font-weight-300">@lang('labels.login_page')</h1>
        </div>
    </div>

    <div class="container margin-bottom-100px">
        <!--======= log_in_page =======-->
        <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">

            <div class="form-output">
                @if(session()->has('message.level'))
                <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {!! session('message.content') !!}
                </div>
                @endif
                @if ($errors->has('delete'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('delete') }}</strong>
                </div>
                @endif
                @if ($errors->has('status'))
                <div class="alert alert-danger">
                    <strong>{{ $errors->first('status') }}</strong>
                </div>
                @endif
                <form action="{{ route('login') }}" method="POST" name="loginForm" id="loginForm">
                    @csrf
                    <div class="form-group label-floating">
                        <label class="control-label">@lang('labels.youremail')</label>
                        <input class="form-control" placeholder="@lang('labels.email')" type="email" name="email" id="email" value="{{ old('email') }}" required autofocus >
                        <div class="error">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">@lang('labels.yourpassword')</label>
                        <input class="form-control" placeholder="@lang('labels.password')" type="password" name="password" id="password" required >
                        <div class="error">{{ $errors->first('password') }}</div>
                    </div>

                    <div class="remember">
                        <div class="checkbox">
                            <label>
                            <input name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }} >
                                @lang('labels.remember_me')
                        </label>
                        </div>
                    </div>
                    <div style="text-align: center;">
                    <button type="submit" name="submit" id="submit"  class="btn btn-md btn-primary full-width">@lang('labels.login')</button>
                    </div>

                    <p><a style="color: #888;" target="_blank" href="{{route("forgetpassword")}}">¿Olvidaste tu contraseña?</a> </p>
                </form>
            </div>
        </div>
        <!--======= // log_in_page =======-->

    </div>
<script>
    $(document).ready(function(){
        $('#loginForm').validate();
    });
</script>
@endsection
