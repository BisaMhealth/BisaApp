@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/dashboard"><i class="menu-icon fa fa-pie-chart text-maroon"></i>Dashboard </a>
                </li>

                <li class="menu-item-has-children dropdown active-list">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Articles</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-list-alt"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/article-categories">Article Categories</a></li>

                        <li class="active"><i class="menu-icon fa fa-book"></i><a href="#">All Articles</a></li>
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
        <div class="row">
            <div class="col-md-8">
                <h5><b>Publish New Article</b></h5><br>
                <form method="post" class="publish-article-form" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-6">
                            <img src="" class="article-thumbnail-res img-fluid">
                            <label for="article-thumbnail" class="btn btn-secondary btn-block article-thumbnail-label"><small>Select Article Thumbnail</small></label>
                            <input type="file" name="articleThumbnail" id="article-thumbnail" accept="image/*" class="article-thumbnail">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-6">
                            <label><small>Article Title</small></label>
                            <input type="text" class="form-control form-control-sm add-article-title">
                        </div>

                        <div class="col-6">
                            <label><small>Article Category</small></label>
                            <select class="form-control form-control-sm publish-article-select add-article-cateogory"></select>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Article Content</small></label>
                        <textarea class="form-control form-control-sm add-article-content"></textarea>
                    </div>
                    <button class="btn btn-custom add-btn">Publish</button>
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/quill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin-constants.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/controllers/admin/admin-article-controller.js') }}"></script>
    <script>
        getArticleCategoriesForForm();
    </script>
@endsection
