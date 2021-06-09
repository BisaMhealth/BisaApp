@extends('layouts.app')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@section('stylesheet')
    <style>
        body {
            background: #f6fafb;
        }

        #user-country {
            height: 100% !important;
            width: inherit;
            background: red;
        }

        .bootstrap-select.form-control-sm .dropdown-toggle {
            height: 30px;
            border: 1px solid #ced4da;
            background: #fff;
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
            <div class="col-md-1"></div>
            <div class="col-md-6 intro-img-col">
                <div class="intro-img-div">
                    <img src="{{ asset('images/logo_sn_hdpi.png') }}" class="intro-logo img-fluid" alt=""><br>
                    <h5 class="text-center"><b>Welcome. With us you always have a doctor</b></h5>
                    <img src="{{ asset('images/doctors.svg') }}" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-md-4 auth-login-sub-div">

                <div class="auth-logo-div">
                    <img src="{{ asset('images/logo_sn_hdpi.png') }}" class="auth-logo img-fluid" alt="">
                </div>

                <h5 class="text-center"><b>
Account login</b></h5>

                <div class="auth-form-div">
                    <form class="user-signup-form">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control form-control-sm user-first-name" placeholder="
First name">
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control form-control-sm user-last-name" placeholder="
Last name">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-6">
                                <select class="form-control form-control-sm user-gender">
                                    <option disabled selected>Sex</option>
                                    <option value="male">
Male</option>
                                    <option value="female">
Female</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <input type="text" class="form-control form-control-sm user-dob date-input" placeholder="
Date of Birth">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-6">
                                <input type="text" class="form-control form-control-sm username" placeholder="
username">
                            </div>

                            <div class="col-6">
                                <select id="user-country" class="form-control form-control-sm selectpicker countrypicker" data-live-search="true" data-default="Ghana"></select>
                            </div>
                        </div><br>

                        <div class="form-group">
                            <input type="email" class="form-control form-control-sm user-email" placeholder="
Email-address">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm user-phone" placeholder="
Phone number">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm user-password" placeholder="Password">
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control form-control-sm user-password-conf" placeholder="Confirm the password">
                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-sm btn-custom btn-block auth-btn">
Register</button>
                            </div>
                            <div class="col-6">
                                <p class="text-center"><small> <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/login">
I have an account</a></small></p>
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
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/countrypicker.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-auth-controller.js') }}"></script>
    <script type="text/javascript">
        jQuery(".date-input").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            endDate: '0m',
            clearBtn: true,
            todayHighlight: true,
        });
    </script>
@endsection
