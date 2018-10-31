@extends('layouts.front')

@section('content')

<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">@lang('labels.home')</a></li>
                <li class="active">@lang('labels.dashboard')</li>
            </ol>
            <h1 class="font-weight-300">@lang('labels.sign_up_page')</h1>
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
                <form method="POST" action="{{ route('signup.registeruser') }}" name="registrationForm" id="registrationForm">
                    @csrf
                    <div class="form-group label-floating">
                        <label class="control-label">@lang('labels.fullname')</label>
                        <input class="form-control" placeholder="@lang('labels.fullname')" type="text" name="fullname" id="fullname" required maxlength="25" minlength="3" value="{{ old('fullname') }}" >
                        <div class="error">{{ $errors->first('fullname') }}</div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">@lang('labels.youremail')</label>
                        <input class="form-control" placeholder="@lang('labels.email')" type="email" name="email" id="email" required value="{{ old('email') }}">
                        <div class="error">{{ $errors->first('email') }}</div>
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">@lang('labels.yourpassword')</label>
                        <input class="form-control" placeholder="@lang('labels.yourpassword')" type="password" name="password" id="password" required maxlength="25" minlength="6" value="{{ old('password') }}" >
                        <div class="error">{{ $errors->first('password') }}</div>
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">@lang('labels.yourpassword_confirm')</label>
                        <input class="form-control" equalTo="#password" placeholder="@lang('labels.yourpassword_confirm')" type="password" name="password_confirmation" id="password_confirmation" required maxlength="25" minlength="6" value="{{ old('password_confirmation') }}" >
                        <div class="error">{{ $errors->first('password_confirmation') }}</div>
                    </div>

                    <div class="form-group label-floating is-select d-none">
                        <label class="control-label">@lang('labels.signup_yourself_as')</label>
                        <select class="selectpicker form-control" name="userSignupAs" id="userSignupAs" required >
                            <option  value="4">Visitor</option>
                        </select>
                        <div class="error">{{ $errors->first('userSignupAs') }}</div>
                    </div>

                    <div class="remember">
                        <div class="checkbox">
                            <label>
                            <input name="optionsCheckboxes" type="checkbox" required >
                            @lang('labels.accept_terms_text')
                        </label>
                        </div>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn btn-md btn-primary full-width">@lang('labels.complete_signup')</button>

                    <p>@lang('labels.you_have_an_account') <a href="page-login.html"> @lang('labels.register_signin')</a> </p>
                </form>

            </div>
        </div>
        <!--======= // log_in_page =======-->

    </div>

<script>
    $(document).ready(function(){
        $('#registrationForm').validate();
    });    
</script>

@endsection
