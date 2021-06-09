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

                <li class="active">
                    <a href="#"><i class="menu-icon fa fa-video-camera"></i>Videos </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/health-resources"><i class="menu-icon fa fa-medkit text-success"></i>Health Resources </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/pharmacies"><i class="menu-icon fa fa-plus-square text-info"></i>Pharmacies </a>
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
        <div class="videos-res-title"></div>
        <div class="row videos-res">
            
        </div>
        <div class="btn btn-float rounded-circle pulse" data-target="#add-video-modal" data-toggle="modal">+</div>
    </div>

    <!--Add video modal-->
    <div class="modal fade" id="add-video-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Video</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="add-video-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-6">
                            <label for="add-video-thumbnail" class="btn btn-secondary btn-block add-video-thumbnail-label"><small>Select Video File</small></label>
                            <input type="file" name="editArticleThumbnail" id="add-video-thumbnail" accept="video/*" class="add-video-thumbnail">
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Title / Caption</small></label>
                        <input type="text" class="form-control form-control-sm add-video-title">
                    </div>

                    <div class="form-group">
                        <label><small>Description</small></label>
                        <textarea type="text" class="form-control form-control-sm add-video-description"></textarea>
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

    <!--Edit video modal-->
    <div class="modal fade" id="edit-video-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Video Details</h5>
                </div>
                <div class="modal-body">
                    <form method="post" class="edit-video-form" enctype="multipart/form-data">
                        <input type="hidden" class="edit-video-id">
                        <div class="form-group">
                            <label><small>Title / Caption</small></label>
                            <input type="text" class="form-control form-control-sm edit-video-title">
                        </div>

                        <div class="form-group">
                            <label><small>Description</small></label>
                            <textarea type="text" class="form-control form-control-sm edit-video-description"></textarea>
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

    <!--View video modal-->
    <div class="modal fade" id="view-video-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h5><b><span class="view-video-title"></span></b></h5><br>
                    <video class="video-item" controls>
                        <source src="" class="view-vidoe-src" type="video/mp4">
                        Your browser does not support the video tag.
                    </video><br>
                    <div class="view-video-stats-div">
                        <div class="video-stat-item">
                            <p><small><b><i class="fa fa-thumbs-up"></i></b> <span class="view-video-upvotes"></span></small></p>
                        </div>

                        <div class="video-stat-item">
                            <p><small><b><i class="fa fa-thumbs-down"></i></b> <span class="view-video-downvotes"></span></small></p>
                        </div>

                        <div class="video-stat-item">
                            <p><small><b><i class="fa fa-eye"></i></b> <span class="view-video-views"></span></small></p>
                        </div>
                    </div>
                    <br>

                    <p class="view-video-description"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Close</button>
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
	<script type="text/javascript" src="{{ asset('js/controllers/admin/admin-video-controller.js') }}"></script>
@endsection
