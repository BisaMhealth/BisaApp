@extends('layouts.app')

@section('stylesheet')
    <style>
        body {
            background: #f6fafb;
        }
    </style>
@endsection

@section('content')
    <div class="container auth-main-div">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="reset-password-img-div">
                    <img src="{{ asset('images/logo_sn_hdpi.png') }}" class="intro-logo img-fluid" alt=""><br>
                    <h5 class="text-center"><b>Reset Your Password</b></h5>
                </div><br>

                <form class="reset-password-form">
                    <input type="hidden" value="{{ $code }}" class="reset-new-password-code">
                    <div class="form-group">
                        <input type="password" class="form-control form-control-sm reset-new-password" placeholder="New password">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control form-control-sm reset-new-password-conf" placeholder="Confirm new password">
                    </div>
                    <button type="submit" class="btn btn-sm btn-block btn-custom auth-btn">Update</button>
                </form>

            </div>

            <div class="col-md-4"></div>

        </div>
    </div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-auth-controller.js') }}"></script>
@endsection
