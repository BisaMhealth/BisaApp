@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/questions"><i class="menu-icon fa fa-arrow-right text-orange"></i>New Questions </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/answered-questions"><i class="menu-icon fa fa-check text-success"></i>Answered Questions
 </a>
                </li>

                <li class="active">
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/account-settings"><i class="menu-icon fa fa-cog"></i>
Account settings </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/logout"><i class="menu-icon fa fa-power-off text-danger"></i>Sign Out </a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside>


<!-- Right Panel -->
<div id="right-panel" class="right-panel">

    <!-- Header-->
    <header id="header" class="header admin-header">
        <div class="top-left">
            <div class="navbar-header">
                <a class="navbar-brand" href="#"><img src="{{ asset('images/bisa_sn_logo_white.png') }}" class="nav-logo" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/bisa_sn_logo_white.png') }}" class="nav-logo" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="{{$thumbnail}}" alt="doctor-thumbnail" class="doctor-nav-thumbnail rounded-circle"> &nbsp;<small>{{$username}} <i class="fa fa-caret-down"></i></small>
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/account-settings"><i class="fa fa-cog"></i>Account settings</a>
                        <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/logout"><i class="fa fa-power-off"></i>Sign Out</a>
                    </div>
                </div>

            </div>
        </div>
    </header><!-- /header -->
    <!-- Header-->

    <div class="content">
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h3><b><i class="fa fa-cogs"></i> 
Account settings</b></h3><hr>

                <!-- doctor profile photo settings -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-div">
                            <h5><b><i class="fa fa-user"></i> 
Profile Photo Update</b></h5>
                            <form class="doctor-profile-photo-form" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <img src="{{ $doctorDetails->thumbnail }}" class="update-doctor-thumbnail-res img-fluid">
                                        <label for="update-doctor-thumbnail" class="btn btn-secondary btn-block update-doctor-thumbnail-label"><small>
Select A Profile Photo </small></label>
                                        <input type="file" name="editArticleThumbnail" id="update-doctor-thumbnail" accept="image/*" class="update-doctor-thumbnail">
                                    </div>
                                </div><br>

                                <button type="submit" class="btn btn-custom profile-photo-reset-btn">Update</button>
                            </form>
                        </div>
                    </div>
                </div><br><br>

                <!-- doctor details settings -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-div">
                            <h5><b><i class="fa fa-user"></i> Personal Details Settings</b></h5>
                            <form class="doctor-personal-details-form" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>First name</small></label>
                                        <input type="text" class="form-control form-control-sm first-name" value="{{ $doctorDetails->first_name }}">
                                    </div>

                                    <div class="col-6">
                                        <label><small>Last name</small></label>
                                        <input type="text" class="form-control form-control-sm last-name" value="{{ $doctorDetails->last_name }}">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Username</small></label>
                                        <input type="text" class="form-control form-control-sm username" value="{{ $doctorDetails->username }}">
                                    </div>

                                    <div class="col-6">
                                        <label><small>Email</small></label>
                                        <input type="email" class="form-control form-control-sm email" value="{{ $doctorDetails->email }}">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Phone number</small></label>
                                        <input type="text" class="form-control form-control-sm phone" value="{{ $doctorDetails->phone }}">
                                    </div>

                                    <div class="col-6">
                                        <label><small>Addresse</small></label>
                                        <input type="text" class="form-control form-control-sm address" value="{{ $doctorDetails->address }}">
                                    </div>
                                </div><br>

                                <div class="form-group">
                                    <label><small>A Propos Du Docteur</small></label>
                                    <textarea type="text" class="form-control form-control-sm bio">{{ $doctorDetails->bio }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-custom personnal-info-reset-btn">Réactualiser</button>
                            </form>
                        </div>
                    </div>
                </div><br><br>
                
                <!-- doctor password settings -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-div">
                            <h5><b><i class="fa fa-key"></i> Password Settings</b></h5>
                            <form class="doctor-password-reset-form" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Current Password</small></label>
                                        <input type="password" class="form-control form-control-sm current-password">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>New Password</small></label>
                                        <input type="password" class="form-control form-control-sm new-password">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Confirm the new password</small></label>
                                        <input type="password" class="form-control form-control-sm new-password-conf">
                                    </div>
                                </div><br>

                                <button type="submit" class="btn btn-custom password-reset-btn">Update</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/doctor-account-settings-controller.js') }}"></script>
@endsection
