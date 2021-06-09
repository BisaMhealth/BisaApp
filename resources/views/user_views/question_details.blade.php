@extends('layouts.app')

@section('stylesheet')

@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">

                <li class="active">
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/questions"><i class="menu-icon fa fa-question"></i>Mes Questions </a>
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
                    <a href="<?php echo Config::get('constants.USER_APP_DIRECTORY'); ?>/user/doctors-details"><i class="menu-icon fa fa-user-md text-warning"></i>Médecins </a>
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
        <h5 class="text-center user-question-details-title"></h5>
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
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-question-controller.js') }}"></script>
    <script type="text/javascript">
        getQuestionDetails('{{$questionCode}}');
    </script>
@endsection
