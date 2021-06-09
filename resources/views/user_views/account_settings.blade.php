@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/questions"><i class="menu-icon fa fa-home text-info"></i>Home page</a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/questions"><i class="menu-icon fa fa-question text-orange"></i>My questions </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit text-violet"></i>Info Santé</a>
                    @if (count($articleCategories)> 0)
                        <ul class="sub-menu children dropdown-menu">
                            @foreach ($articleCategories as $category)
                                <li><i class="menu-icon fa fa-list-o"></i><a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/health-info/{{$category->category_name}}">{{$category->category_name}}</a></li>
                            @endforeach
                        </ul>
                    @endif

                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/health-resources"><i class="menu-icon fa fa-medkit text-success"></i>Ressources De Santé </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/doctors-details"><i class="menu-icon fa fa-user-md text-warning"></i>Doctors </a>
                </li>

                @if($username != 'anonymous')
                <li class="active">
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/account-settings"><i class="menu-icon fa fa-cog text-info"></i>Account settings </a>
                </li>
                @endif

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/logout"><i class="menu-icon fa fa-power-off text-danger"></i>Sign Out </a>
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
                <a class="navbar-brand" href="#"><img src="{{ asset('images/logo_sn_hdpi.png') }}" class="nav-logo" alt="Logo"></a>
                <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo_sn_hdpi.png) }}" class="nav-logo" alt="Logo"></a>
                <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
            </div>
        </div>
        <div class="top-right">
            <div class="header-menu">
                {{-- <div class="header-left">

                    <div class="dropdown for-notification">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="count bg-danger">3</span>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="notification">

                        </div>
                    </div>
                </div> --}}

                <div class="user-area dropdown float-right">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user-circle-o"></i> &nbsp;<small>{{$username}} <i class="fa fa-caret-down"></i></small>
                    </a>

                    @if($username != 'anonymous')
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/account-settings"><i class="fa fa-cog"></i>Account Settings</a>

                            <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/logout"><i class="fa fa-power-off"></i>Sign Out</a>
                        </div>
                    @endif

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/logout"><i class="fa fa-power-off"></i>Sign Out</a>
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

                <!-- user details settings -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-div">
                            <h5><b><i class="fa fa-user"></i> 
Personal Details Settings</b></h5>
                            <form class="user-personal-details-form" action="index.html" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>
First name</small></label>
                                        <input type="text" class="form-control form-control-sm first-name" value="{{ $userDetails->first_name }}">
                                    </div>

                                    <div class="col-6">
                                        <label><small>Nom De famille</small></label>
                                        <input type="text" class="form-control form-control-sm last-name" value="{{ $userDetails->last_name }}">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Nom d'utilisateur</small></label>
                                        <input type="text" class="form-control form-control-sm username" value="{{ $userDetails->username }}">
                                    </div>

                                    <div class="col-6">
                                        <label><small>Email</small></label>
                                        <input type="email" class="form-control form-control-sm email" value="{{ $userDetails->email }}">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Numéro De Téléphone</small></label>
                                        <input type="text" class="form-control form-control-sm phone" value="{{ $userDetails->phone }}">
                                    </div>

                                    <div class="col-6">
                                        <label><small>Addresse</small></label>
                                        <input type="text" class="form-control form-control-sm address" value="{{ $userDetails->address }}">
                                    </div>
                                </div><br>

                                <button type="submit" class="btn btn-custom personnal-info-reset-btn">Réactualiser</button>
                            </form>
                        </div>
                    </div>
                </div><br><br>
                <!-- user health settings -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-div">
                            <h5><b><i class="fa fa-stethoscope"></i> Paramètres D'Informations De Santé</b></h5>
                            <form class="user-health-info-settings-form" action="index.html" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Poids (kg)</small></label>
                                        <input type="text" value="{{ $userHealthInfo->weight }}" class="form-control form-control-sm user-weight">
                                    </div>

                                    <div class="col-6">
                                        <label><small>La Taille(m)</small></label>
                                        <input type="text" value="{{ $userHealthInfo->height }}" class="form-control form-control-sm user-height">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Les Allergies</small></label>
                                        <textarea class="form-control form-control-sm user-allergies">{{ $userHealthInfo->allergies }}</textarea>
                                    </div>

                                    <div class="col-6">
                                        <label><small>Conditions De Santé</small></label>
                                        <textarea class="form-control form-control-sm user-health-condition">{{ $userHealthInfo->health_conditions }}</textarea>
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Médicament Actuel</small></label>
                                        <textarea class="form-control form-control-sm user-current-medication">{{ $userHealthInfo->current_medication }}</textarea>
                                    </div>

                                    <div class="col-6">
                                        <label><small>Autres Notes</small></label>
                                        <textarea class="form-control form-control-sm user-health-notes">{{ $userHealthInfo->other_notes }}</textarea>
                                    </div>
                                </div><br>

                                <button type="submit" class="btn btn-custom health-info-reset-btn">Réactualiser</button>
                            </form>
                        </div>
                    </div>
                </div><br><br>

                <!-- user password settings -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="settings-div">
                            <h5><b><i class="fa fa-key"></i> Paramètres De Mot De Passe</b></h5>
                            <form class="user-password-reset-form" method="post">
                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Mot De Passe Actuel</small></label>
                                        <input type="password" class="form-control form-control-sm current-password">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Nouveau Mot De Passe</small></label>
                                        <input type="password" class="form-control form-control-sm new-password">
                                    </div>
                                </div><br>

                                <div class="row">
                                    <div class="col-6">
                                        <label><small>Confirmer Le Nouveau Mot De Passe</small></label>
                                        <input type="password" class="form-control form-control-sm new-password-conf">
                                    </div>
                                </div><br>

                                <button type="submit" class="btn btn-custom password-reset-btn">Réactualiser</button>
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
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-account-settings-controller.js') }}"></script>
@endsection
