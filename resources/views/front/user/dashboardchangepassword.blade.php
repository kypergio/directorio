@extends('layouts.front')

@section('styles')
    <link rel="stylesheet" href="{{ asset('public/front') }}/assets/css/sb-admin.css">
@stop

@section('content')

@include('front.user.sidebar') 
    <div class="content-wrapper">
        <div class="container-fluid overflow-hidden">
            <div class="row margin-bottom-90px margin-lr-10px sm-mrl-0px">
                <!-- Page Title -->
                <div id="page-title" class="padding-30px background-white full-width">
                    <div class="container">
                        <ol class="breadcrumb opacity-5">
                            <li><a href="#">@lang('labels.home')</a></li>
                            <li><a href="#">@lang('labels.dashboard')</a></li>
                            <li class="active">@lang('labels.my_profile')</li>
                        </ol>
                        <h1 class="font-weight-300">@lang('labels.my_profile')</h1>
                    </div>
                </div>
                <!-- // Page Title -->
                <div id="msgShow" class="col-md-12" style="display: none;"></div>
                @if(session()->has('message.level'))
                <div class="col-md-12 horizontal-center alert alert-{{ session('message.level') }}"> 
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                    {!! session('message.content') !!}
                </div>
                @endif
                @if (session('error'))
                    <div class="col-md-12 alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="col-md-12 alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <form action="{{ route('user.changepasswordSave') }}" method="post" name="changepwd" id="changepwd" onsubmit="return chkPassword();" >
                <div class="row margin-tb-45px full-width">

                    @csrf
                    <div class="col-md-8  offset-md-5">
                      <div class="row">
                          <div class="col-md-12 margin-bottom-20px">
                              <label><i class="far fa-user margin-right-10px"></i> @lang('labels.old_password') <sup class="requiredSup">*</sup></label>
                              <input type="text" class="form-control form-control-sm" name="oldpwd" id="oldpwd" placeholder="@lang('labels.old_password')" required value="" minlength="6" maxlength="25">
                              <div class="error">{{ $errors->first('oldpwd') }}</div>
                          </div>
                          <div class="col-md-12 margin-bottom-20px">
                              <label><i class="far fa-user margin-right-10px"></i> @lang('labels.new_password') <sup class="requiredSup">*</sup></label>
                              <input type="text" class="form-control form-control-sm" name="newpwd" id="newpwd" placeholder="@lang('labels.new_password')" required value="" minlength="6" maxlength="25">
                              <div class="error">{{ $errors->first('newpwd') }}</div>
                          </div>
                          <div class="col-md-12 margin-bottom-20px">
                              <label><i class="far fa-user margin-right-10px"></i> @lang('labels.new_password_confirmation') <sup class="requiredSup">*</sup></label>
                              <input type="text" class="form-control form-control-sm" equalTo="#newpwd" name="newpwd_confirmation" id="newpwd_confirmation" placeholder="@lang('labels.new_password_confirmation')" required value="" minlength="6" maxlength="25">
                              <div class="error">{{ $errors->first('newpwd_confirmation') }}</div>
                          </div>
                          
                      </div>
                      <div class="col-md-12 text-center margin-top-20px">
                        <button class="btn btn-md padding-lr-25px  text-white background-main-color btn-inline-block" type="submit" name="submit" id="submit">@lang('labels.update_password')</button>
                      </div>
                      <hr class="margin-tb-40px">
                      

                    </div>
                </div>
                </form>

            </div>
        </div>
        <!-- /.container-fluid-->
        <!-- /.content-wrapper-->
        <footer class="sticky-footer">
            <div class="container">
                <div class="text-center">
                    <span>@lang('labels.footer_copyright')</span>
                </div>
            </div>
        </footer>
        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fa fa-angle-up"></i>
        </a>
        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="page-login.html">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function(){
        $('#changepwd').validate();
    });
    function chkPassword(){
        if(!$('#changepwd').valid()){ return false;}

        var oldpwd = $('#oldpwd').val();
        var newpwd = $('#newpwd').val();
        var newpwdConfirm = $('#newpwd_confirmation').val();
        if(oldpwd == newpwd){
            $('#msgShow').show().html('<div class="alert alert-danger">The new password must be different from old password!</div>').fadeOut(5000);
            return false;
        }
        if(newpwd !== newpwdConfirm ){
            $('#msgShow').show().html('<div class="alert alert-danger">The new password must be equal to new password confirmation!</div>').fadeOut(5000);
            return false;
        }
        return true;
    }
</script>
@endsection
