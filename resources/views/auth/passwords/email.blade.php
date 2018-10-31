@extends('layouts.front3')

@section('content')
<link rel="stylesheet" href="/front/assets/css/bootstrap.min.css">
<style>
    .Content .search-bar .container .row .column form fieldset:nth-child(3):before, .Content .search-bar .container .row .column form fieldset:nth-child(3):after{
        display: none;
    }
    div.error {
        color: #ff0000;
    }
</style>
<div class="search-bar">
            <div class="container">
                <div class="row">
                    @if(session()->has('success'))
                        <div class="horizontal-center alert alert-success text-center"> 
                            {!! session('success') !!}
                        </div>
                    @endif
                    @if(session()->has('message.level'))
                    <div class="horizontal-center alert alert-{{ session('message.level') }}"> 
                        {!! session('message.content') !!}
                    </div>
                    @endif
                    @if ($errors->has('delete'))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('delete') }}</strong>
                    </div>
                    @endif

                    @if ($errors->has('error'))
                    <div class="alert alert-danger">
                        <strong>{{ $errors->first('error') }}</strong>
                    </div>
                    @endif
                    <div class="column">
                        <form action="{{ route('forgetpasswordSendLink') }}" method="post" autocomplete="off" novalidate="" style="text-align:center; " onsubmit="return chkField();" >
                            @csrf
                            <fieldset>
                                Email Address : <br><br> <input name="email" id="email" type="email" placeholder="" autocomplete="off" value="{{ old('email') }}">
                            </fieldset>
                            <div class="error">{{ $errors->first('email') }}
                                @if(session()->has('error'))
                                    {!! session('error') !!}
                                @endif
                            </div>
                            <fieldset>
                                <button type="submit" name="submit"  id="searchBtn">Enviar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>

<script>
    function chkField() {
        var getEmail = $('#email').val();
        if(getEmail == ''){
            $('#email').focus();
            return false;
        }
        return true;
    }
</script>
@endsection
