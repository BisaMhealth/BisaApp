@extends('layouts.app')

@section('stylesheet')

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

                <li class="active">
                    <a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/general-stats"><i class="menu-icon fa fa-bar-chart-o"></i>Reports</a>
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

    <div class="content" class="stats-container">
        <div class="row">
            <div class="col-md-4">
                <div class="stats-div">
                    <p class="text-center"><b><span class="userChartTitle"></span></b></p>
                    <canvas id="usersChart" width="200" height="200"></canvas>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats-div">
                    <p class="text-center"><b><span class="doctorChartTitle"></span></b></p>
                    <canvas id="doctorsChart" width="200" height="200"></canvas>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stats-div">
                    <p class="text-center"><b><span class="adminChartTitle"></span></b></p>
                    <canvas id="adminsChart" width="200" height="200"></canvas>
                </div>
            </div>
        </div><br><br>

        <div class="row">
            <div class="col-md-6">
                <div class="stats-div">
                    <p class="text-center"><b><span class="topUserChartTitle"></span></b></p>
                    <canvas id="topUsersChart" width="200" height="150"></canvas>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stats-div">
                    <p class="text-center"><b><span class="topDoctorChartTitle"></span></b></p>
                    <canvas id="topDoctorsChart" width="200" height="150"></canvas>
                </div>
            </div>
        </div><br><br>

        <div class="row">
            <div class="col-md-3">
                <div class="alert stats-div-sm user-signup-stats-div">
                    <h3><b><span class="new-users-today-res"></span></b></h3>
                    <p><b><small>New Users Today</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm user-signup-stats-div">
                    <h3><b><span class="new-users-this-week-res"></span></b></h3>
                    <p><b><small>New Users This Week</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm user-signup-stats-div">
                    <h3><b><span class="new-users-this-month-res"></span></b></h3>
                    <p><b><small>New Users This Month</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm user-signup-stats-div">
                    <h3><b><span class="new-users-this-year-res"></span></b></h3>
                    <p><b><small>New Users This Year</small></b></p>
                </div>
            </div>
        </div><br>

        <div class="row">

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="total-questions-res"></span></b></h3>
                    <p><b><small>Total Questions</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="questions-today-res"></span></b></h3>
                    <p><b><small>Questions Today</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="questions-this-week-res"></span></b></h3>
                    <p><b><small>Questions This Week</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="questions-this-month-res"></span></b></h3>
                    <p><b><small>Questions This Month</small></b></p>
                </div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="questions-this-month-res"></span></b></h3>
                    <p><b><small>Questions This Month</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="open-questions-res"></span></b></h3>
                    <p><b><small>Opened Questions</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="closed-questions-res"></span></b></h3>
                    <p><b><small>Closed Question</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="answered-questions-res"></span></b></h3>
                    <p><b><small>Answered Questions</small></b></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="alert stats-div-sm questions-stats-div">
                    <h3><b><span class="unanswered-questions-res"></span></b></h3>
                    <p><b><small>Unanswered QUestions</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="health-resources-res"></span></b></h3>
                    <p><b><small>Health Resources</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="pharmacies-res"></span></b></h3>
                    <p><b><small>Pharmacies</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="article-categories-res"></span></b></h3>
                    <p><b><small>Article Categories</small></b></p>
                </div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="articles-res"></span></b></h3>
                    <p><b><small>Articles</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="ariticle-views-res"></span></b></h3>
                    <p><b><small>Article Views</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="article-upvotes-res"></span></b></h3>
                    <p><b><small>Article Upvotes</small></b></p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="alert stats-div-sm misc-stats-div">
                    <h3><b><span class="article-downvotes-res"></span></b></h3>
                    <p><b><small>Article Downvotes</small></b></p>
                </div>
            </div>
        </div>
    </div>
    <div class="btn btn-float rounded-circle pulse" onclick="printStats()"><i class="fa fa-print" style="font-size:30px"></i></div>
</div>
@endsection

@section('javascript')
    <script type="text/javascript" src="{{ asset('js/admin-constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/jQuery.print.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/Chart.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/admin/graph-controller.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/admin/admin-general-statistics-controller.js') }}"></script>
@endsection
