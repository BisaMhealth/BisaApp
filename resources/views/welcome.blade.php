@extends('layouts.app')

@section('stylesheet')
    <style>
        body {
            background: #f6fafb;
        }

        @media only screen and (max-width: 768px) {
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
            <div class="col-md-1"></div>
            <div class="col-md-6 col-lg-6 intro-img-col">
                <div class="intro-img-div">
                    <img src="{{ asset('images/logo_sn_hdpi.png') }}" class="intro-logo img-fluid" alt=""><br>
                    <h5 class="text-center"><b>Welcome. <span class="intro-text"></span></b></h5>
                    <img src="{{ asset('images/doctors.svg') }}" class="img-fluid" alt="Bisa Senegal Logo">
                </div>
            </div>
            <div class="col-md-4 col-lg-4  auth-login-sub-div intro-form-animation">

                <div class="auth-logo-div">
                    <img src="{{ asset('images/logo_sn_hdpi.png') }}" class="auth-logo img-fluid" alt="Bisa Senegal Logo">
                </div>

                <h5 class="text-center"><b>Account login</b></h5>

                <div class="auth-form-div">
                    <form class="user-login-form">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm user-email" placeholder="
Username or Email">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm user-password" placeholder="Password">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-sm btn-custom btn-block auth-btn">
Log in</button>
                            </div>
                            <div class="col-6">
                                <p class="text-right"><small> <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/forgot-password"><b>Forgot your password?</b></a></small></p>
                            </div>
                        </div><br>

                       <div class="row">
                            <div class="col-6">
                                <p><a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/signup"><small><b>
Register Now</b></small></a></p>
                            </div>
                            <div class="col-6">
                                <p><a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/anonymous-signup"><small><b>
Anonymous Connection</b></small></a></p>
                            </div>
                       </div>

                    </form>

                </div>

            </div>
            <div class="col-md-1"></div>

        </div>
    </div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/typed.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/controllers/user/user-auth-controller.js') }}"></script>
    <script>
        var options = {
            strings: ["With us, You always have a doctor","With Us, You Always Have Answers"],
            typeSpeed: 100,
            smartBackspace: true,
            startDelay: 2000,
            loop: true,
            backSpeed: 20,
        }

        var typed = new Typed(".intro-text", options);
    </script>
@endsection
