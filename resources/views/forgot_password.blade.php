@extends('layouts.app')

@section('stylesheet')
    <style>
        body {
            background: #f6fafb;
        }

        @media only screen and (max-width: 766px) {
            .intro-img-col {
                display: none;
            }

            .auth-logo {
                display: block;
            }

            .auth-login-sub-div {
                padding-top: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container auth-main-div">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="forgot-password-img-div">
                    <img src="{{ asset('images/logo.png') }}" class="intro-logo img-fluid" alt=""><br>
                    <h5 class="text-center"><b>Enter your email address to reset your password</b></h5>
                    <img src="{{ asset('images/forgot_password.svg') }}" class="img-fluid forgot-password-img" alt="">
                </div><br>

                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <form class="forgot-password-form">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-sm user-email" placeholder="Email Address...">
                            </div>
                            <button type="submit" class="btn btn-sm btn-block btn-custom submit-btn">Submit</button>
                        </form>
                    </div>
                    <div class="col-md-3"></div>
                </div><br>

                <p class="text-center"><small><span class="forgot-password-res"></span></small></b></p>
            </div>

            <div class="col-md-3"></div>

        </div>
    </div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-auth-controller.js') }}"></script>
@endsection
