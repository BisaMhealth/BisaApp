@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/questions"><i class="menu-icon fa fa-question text-orange"></i>Mes Questions </a>
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

                <li class="active">
                    <a href="#"><i class="menu-icon fa fa-user-md"></i>Médecins </a>
                </li>

                @if($username != 'anonymous')
                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/account-settings"><i class="menu-icon fa fa-cog text-info"></i>Paramètres Du Compte </a>
                </li>
                @endif

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/logout"><i class="menu-icon fa fa-power-off text-danger"></i>Déconnexion </a>
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
                <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo_sn_hdpi.png') }}" class="nav-logo" alt="Logo"></a>
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
                            <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/account-settings"><i class="fa fa-cog"></i>Paramètres Du Compte</a>

                            <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/logout"><i class="fa fa-power-off"></i>Déconnexion</a>
                        </div>
                    @endif

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/logout"><i class="fa fa-power-off"></i>Déconnexion</a>
                    </div>
                </div>

            </div>
        </div>
    </header><!-- /header -->
    <!-- Header-->

    <div class="content">
        <h5 class='text-center user-res-title'><b>Our Doctors</b></h5><br>
        <div class="row doctors-res"></div>
    </div>

    <!--  view doctor details -->
    <div class="modal fade" id="view-doctor-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Doctor Details</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="" class="doctor-details-thumbnail img-fluid">
                    </div>
                    <div class="col-md-7">
                        <table class="table table-sm">
                            <tr>
                                <td><b>Name</b></td>
                                <td><span class="doctor-name"></span></td>
                            </tr>

                            <tr>
                                <td><b>Username</b></td>
                                <td><span class="doctor-username"></span></td>
                            </tr>

                            <tr>
                                <td><b>Email</b></td>
                                <td><span class="doctor-email"></span></td>
                            </tr>

                            <tr>
                                <td><b>Phone</b></td>
                                <td><span class="doctor-phone"></span></td>
                            </tr>

                            <tr>
                                <td><b>Gender</b></td>
                                <td><span class="doctor-gender"></span></td>
                            </tr>

                            <tr>
                                <td><b>Country</b></td>
                                <td><span class="doctor-country"></span></td>
                            </tr>

                            <tr>
                                <td><b>Address</b></td>
                                <td><span class="doctor-address"></span></td>
                            </tr>


                            <tr>
                                <td><b>Active</b></td>
                                <td><span class="doctor-active"></span></td>
                            </tr>

                            <tr>
                                <td><b>Bio</b></td>
                                <td><span class="doctor-bio"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Okay</button>
            </div>
        </div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-doctor-detiails-controller.js') }}"></script>
@endsection
