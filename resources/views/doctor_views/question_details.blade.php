@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/questions"><i class="menu-icon fa fa-home text-info"></i>Home </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/questions"><i class="menu-icon fa fa-arrow-right text-orange"></i>New Questions </a>
                </li>

                <li>
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/answered-questions"><i class="menu-icon fa fa-check text-success"></i>Answered Questions  </a>
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
                        <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/account-settings"><i class="fa fa-cog"></i>
Account settings</a>
                        <a class="nav-link" href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/doctor/logout"><i class="fa fa-power-off"></i>Sign Out</a>
                    </div>
                </div>

            </div>
        </div>
    </header><!-- /header -->
    <!-- Header-->

    <div class="content">
        <h5 class="text-center user-question-details-title"></h5>
        <p class="text-center text-danger doctor-close-question-div close-question"><small>Close Question</small></p><br>
        {{-- <p class="text-center text-danger doctor-question-closed-notice"><small>Close Question</small></p><br> --}}
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10 user-questions-details-res"></div>
            <div class="col-md-1"></div>
        </div>
        <button class="btn btn-float rounded-circle pulse" data-target="#reply-question-modal" data-toggle="modal"><small>&#8617;</small></i></button>
    </div>

    <!-- Reply question modal -->
    <div class="modal fade" id="reply-question-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply Question</h5>
            </div>
            <div class="modal-body">
                <form class="reply-question-form">
                    <input type="hidden" class="question_id">
                    <input type="hidden" class="patient_id">
                    <input type="hidden" class="question_closed">

                    <div class="row">
                        <div class="col-6">
                            <label for="reply-question-thumbnail" class="btn btn-secondary btn-block reply-question-thumbnail-label"><small>Question Media (optional)</small></label>
                            <input type="file" name="editArticleThumbnail" id="reply-question-thumbnail" class="reply-question-thumbnail">
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Question Content</small></label>
                        <textarea class="form-control form-control-sm reply-question-content"></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-sm btn-custom reply-btn">Submit</button>
                <button type="button" class="btn btn-sm btn-info" data-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
        </div>
    </div>

</div>
@endsection

@section('javascript')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.2.0/socket.io.js"></script>
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/doctor-question-controller.js') }}"></script>
    <script type="text/javascript">
        getQuestionDetails('{{$questionCode}}');
        window.localStorage.setItem('questionCode', '{{$questionCode}}');
        window.localStorage.setItem('questionId', '{{ $questionId }}');
    </script>
@endsection
