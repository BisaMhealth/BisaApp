@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/dashboard"><i class="menu-icon fa fa-pie-chart text-maroon"></i>Dashboard </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit text-violet"></i>Articles</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-list-alt"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/article-categories">Article Categories</a></li>

                        <li><i class="menu-icon fa fa-book"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/articles">All Articles</a></li>
                    </ul>
                </li>


                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-question-circle-o text-orange"></i>Questions</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-list-ul"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/question-categories">Ques. Categories</a></li>
                        <li><i class="menu-icon fa fa-question"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/questions">All Questions</a></li>
                    </ul>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-address-book-o text-blue"></i>Accounts</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-user-circle-o"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/admins-accounts">Admins</a></li>
                        <li><i class="menu-icon fa fa-user-md"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/doctors-accounts">Doctors</a></li>
                        <li><i class="menu-icon fa fa-users"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/users-accounts">Users</a></li>
                    </ul>
                </li>

                <!-- <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-bar-chart-o text-warning"></i>Reports</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-file"></i><a href="<?php //echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/general-stats">General Stats</a></li>
                        <li><i class="menu-icon fa fa-file"></i><a href="<?php //echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/doctors-stats">Doctors</a></li>
                        <li><i class="menu-icon fa fa-file"></i><a href="<?php //echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/users-stats">Users</a></li>
                    </ul>
                </li> -->

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/general-stats"><i class="menu-icon fa fa-bar-chart-o text-warning"></i>Reports</a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/videos"><i class="menu-icon fa fa-video-camera text-pink"></i>Videos </a>
                </li>


                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/health-resources"><i class="menu-icon fa fa-medkit text-success"></i>Health Resources </a>
                </li>

                <li class="active">
                    <a href="#"><i class="menu-icon fa fa-plus-square"></i>Pharmacies </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/logout"><i class="menu-icon fa fa-power-off text-danger"></i>Logout </a>
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
                        <i class="fa fa-user-circle-o"></i> &nbsp;<small>{{ $username }} <i class="fa fa-caret-down"></i> </small>
                    </a>

                    <div class="user-menu dropdown-menu">
                        <a class="nav-link" href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/logout"><i class="fa fa-power-off"></i>Logout</a>
                    </div>
                </div>

            </div>
        </div>
    </header><!-- /header -->
    <!-- Header-->

    <div class="content">
        <div class="row">
            <div class="col-md-12 pharmacy-resources-res"></div>
        </div>
        <div class="btn btn-float rounded-circle pulse" data-target="#add-pharmacy-modal" data-toggle="modal">+</div>
    </div>

    <!--Add health resource modal-->
    <div class="modal fade" id="add-pharmacy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Pharmacy</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="add-pharmacy-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <img src="" class="add-pharmacy-thumbnail-res img-fluid">
                            <label for="add-pharmacy-thumbnail" class="btn btn-secondary btn-block add-pharmacy-thumbnail-label"><small>Pharmacy Thumbnail</small></label>
                            <input type="file" name="editArticleThumbnail" id="add-pharmacy-thumbnail" accept="image/*" class="add-pharmacy-thumbnail">
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Name</small></label>
                        <input type="text" class="form-control form-control-sm add-pharmacy-name">
                    </div>

                    <div class="form-group">
                        <label><small>Country</small></label>
                        <select id="add-pharmacy-country" class="form-control form-control-sm add-doctor-country selectpicker countrypicker" data-live-search="true"></select>
                    </div>

                    <div class="form-group">
                        <label><small>Address</small></label>
                        <input type="text" class="form-control form-control-sm add-pharmacy-address">
                    </div>

                    <div class="form-group">
                        <label><small>Phone</small></label>
                        <input type="text" class="form-control form-control-sm add-pharmacy-contact">
                    </div>

                    <div class="form-group">
                        <label><small>Email</small></label>
                        <input type="email" class="form-control form-control-sm add-pharmacy-email">
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <label><small>Longitude</small></label>
                            <input type="text" value="n/a" class="form-control form-control-sm add-pharmacy-longitude">
                        </div>
                        <div class="col-6">
                            <label><small>Latitude</small></label>
                            <input type="text" value="n/a" class="form-control form-control-sm add-pharmacy-latitude">
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Description</small></label>
                        <textarea class="form-control  form-control-sm add-pharmacy-description"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-custom add-btn">Add</button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
        </div>
    </div>


    <!--Edit health resource modal-->
    <div class="modal fade" id="edit-pharmacy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Pharmacy</h5>
                </div>
                <div class="modal-body">
                    <form method="post" class="edit-pharmacy-form" enctype="multipart/form-data">
                        <input type="hidden" class="edit-pharmacy-id">
                        <div class="row">
                            <div class="col-6">
                                <img src="" class="edit-pharmacy-thumbnail-res img-fluid">
                                <label for="edit-pharmacy-thumbnail" class="btn btn-secondary btn-block edit-pharmacy-thumbnail-label"><small>Pharmacy Thumbnail</small></label>
                                <input type="file" name="editArticleThumbnail" id="edit-pharmacy-thumbnail" accept="image/*" class="edit-pharmacy-thumbnail">
                            </div>
                        </div><br>
    
                        <div class="form-group">
                            <label><small>Name</small></label>
                            <input type="text" class="form-control form-control-sm edit-pharmacy-name">
                        </div>
    
                        <div class="form-group">
                            <label><small>Country</small></label>
                            <select id="edit-pharmacy-country" class="form-control form-control-sm edit-doctor-country selectpicker countrypicker" data-live-search="true"></select>
                        </div>
    
                        <div class="form-group">
                            <label><small>Address</small></label>
                            <input type="text" class="form-control form-control-sm edit-pharmacy-address">
                        </div>
    
                        <div class="form-group">
                            <label><small>Phone</small></label>
                            <input type="text" class="form-control form-control-sm edit-pharmacy-contact">
                        </div>
    
                        <div class="form-group">
                            <label><small>Email</small></label>
                            <input type="email" class="form-control form-control-sm edit-pharmacy-email">
                        </div>
    
                        <div class="row">
                            <div class="col-6">
                                <label><small>Longitude</small></label>
                                <input type="text" value="n/a" class="form-control form-control-sm edit-pharmacy-longitude">
                            </div>
                            <div class="col-6">
                                <label><small>Latitude</small></label>
                                <input type="text" value="n/a" class="form-control form-control-sm edit-pharmacy-latitude">
                            </div>
                        </div><br>
    
                        <div class="form-group">
                            <label><small>Description</small></label>
                            <textarea class="form-control  form-control-sm edit-pharmacy-description"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-custom edit-btn">Update</button>
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
            </div>
        </div>

    <div class="modal fade" id="view-health-resource-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b><span class="health-resource-name"></span></b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="" class="health-resource-thumbnail img-fluid">
                    </div>
                    <div class="col-md-7">
                        <table class="table table-sm">
                            <tr>
                                <td><b>Name</b></td>
                                <td><span class="health-resource-name"></span></td>
                            </tr>

                            <tr>
                                <td><b>Type</b></td>
                                <td><span class="health-resource-type"></span></td>
                            </tr>

                            <tr>
                                <td><b>Country</b></td>
                                <td><span class="health-resource-country"></span></td>
                            </tr>

                            <tr>
                                <td><b>Address</b></td>
                                <td><span class="health-resource-address"></span></td>
                            </tr>

                            <tr>
                                <td><b>Phone</b></td>
                                <td><span class="health-resource-phone"></span></td>
                            </tr>

                            <tr>
                                <td><b>Email</b></td>
                                <td><span class="health-resource-email"></span></td>
                            </tr>

                            <tr>
                                <td><b>Longitude</b></td>
                                <td><span class="health-resource-longitude"></span></td>
                            </tr>

                            <tr>
                                <td><b>Latitude</b></td>
                                <td><span class="health-resource-latitude"></span></td>
                            </tr>
                        </table>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-12">
                        <small><b>Speciality</b></small><br>
                        <small><span class="health-resource-speciality"></span></small>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-12">
                        <small><b>Description</b></small><br>
                        <small><span class="health-resource-description"></span></small>
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

<div class="modal fade" id="view-pharmacy-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b><span class="pharmacy-name"></span></b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="" class="pharmacy-thumbnail img-fluid">
                    </div>
                    <div class="col-md-7">
                        <table class="table table-sm">
                            <tr>
                                <td><b>Name</b></td>
                                <td><span class="pharmacy-name"></span></td>
                            </tr>

                            <tr>
                                <td><b>Country</b></td>
                                <td><span class="pharmacy-country"></span></td>
                            </tr>

                            <tr>
                                <td><b>Address</b></td>
                                <td><span class="pharmacy-address"></span></td>
                            </tr>

                            <tr>
                                <td><b>Phone</b></td>
                                <td><span class="pharmacy-phone"></span></td>
                            </tr>

                            <tr>
                                <td><b>Email</b></td>
                                <td><span class="pharmacy-email"></span></td>
                            </tr>

                            <tr>
                                <td><b>Longitude</b></td>
                                <td><span class="pharmacy-longitude"></span></td>
                            </tr>

                            <tr>
                                <td><b>Latitude</b></td>
                                <td><span class="pharmacy-latitude"></span></td>
                            </tr>
                        </table>
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-md-12">
                        <small><b>Description</b></small><br>
                        <small><span class="pharmacy-description"></span></small>
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
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/countrypicker.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/admin-constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/admin/admin-pharmacy-controller.js') }}"></script>
@endsection