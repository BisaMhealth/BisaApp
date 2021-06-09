@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="active">
                    <a href="#"><i class="menu-icon fa fa-arrow-right"></i>New Questions </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/answered-questions"><i class="menu-icon fa fa-check text-success"></i>Answered Questions </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/account-settings"><i class="menu-icon fa fa-cog text-info"></i>Account settings </a>
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
            <div class="col-md-12 user-questions-res"></div>
        </div>
    </div>

    <!-- Add question modal -->
    <div class="modal fade" id="add-question-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ask A Doctor</h5>
            </div>
            <div class="modal-body">
                <form class="add-question-form">
                    <div class="row">
                        <div class="col-6">
                            <label for="add-question-thumbnail" class="btn btn-secondary btn-block add-question-thumbnail-label"><small>Question Media (optional)</small></label>
                            <input type="file" name="editArticleThumbnail" id="add-question-thumbnail" class="add-question-thumbnail">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-6">
                            <label><small>Question Category</small></label>
                            <select class="form-control form-control-sm add-question-category" name="">

                            </select>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Question Content</small></label>
                        <textarea class="form-control form-control-sm add-question-content"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-custom add-btn">Submit</button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/doctor-question-controller.js') }}"></script>
    <script type="text/javascript">
        getDoctorsQuestions()
        // getUserQuestions()
    </script>
@endsection
