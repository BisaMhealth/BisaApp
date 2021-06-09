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
            <div class="col-md-4"></div>
            <div class="col-md-4 auth-sub-div">

                <div class="auth-logo-div">
                    <img src="{{ asset('images/bisa_sn_logo_white.png') }}" class="admin-auth-logo img-fluid" alt="">
                </div>

                <h5 class="text-center">ADMIN SIGNUP</h5>

                <div class="auth-form-div">
                    {{-- <h6><b>Log Into Your Account</b></h6><br> --}}
                    <form class="admin-signup-form">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm admin-signup-username" placeholder="admin username...">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control form-control-sm admin-signup-email" placeholder="admin email...">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm admin-signup-password" placeholder="admin password...">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm admin-signup-password-conf" placeholder="admin password...">
                        </div>

                        <button class="btn btn-sm btn-custom btn-block auth-btn">Signup</button><br><br>

                        <p class="text-center"><small> <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/login">I already have an admin account</a></small></p>
                    </form>

                </div>

            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/admin-constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/admin/admin-auth-controller.js') }}"></script>
@endsection
