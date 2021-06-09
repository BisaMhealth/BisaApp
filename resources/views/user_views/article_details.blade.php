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

                <li class="menu-item-has-children dropdown active-list">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Info Santé</a>
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
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h2 class="text-center"><b>{{ $article->article_title }}</b></h2>
                <img src="{{$article->article_thumbnail}}" class="user-article-detail-img img-fluid">
                <br><br>
                {!! $article->article_content !!}
                <br>
                <small>{{ $article->updated_at }}</small>
                <hr>

                <button type="button" class="btn btn-success btn-sm" onclick="upvote_article({{$article->article_id}})"><i class="fa fa-thumbs-up"></i> upvote (<span class="upvote-num">{{ $article->article_upvotes }}</span>)</button>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-warning btn-sm" onclick="downvote_article({{$article->article_id}})"><i class="fa fa-thumbs-down"></i> downvote (<span class="downvote-num">{{ $article->article_downvotes }}</span>)</button>&nbsp;&nbsp;&nbsp;
                <button type="button" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>{{ $article->article_views }} views</button>
            </div>
            <div class="col-md-2"></div>
        </div>
        <br>
    </div>

</div>
@endsection

@section('javascript')
	<script type="text/javascript" src="{{ asset('js/constants.js') }}"></script>
	<script type="text/javascript" src="{{ asset('js/controllers/user/user-health-info-controller.js') }}"></script>
    <script type="text/javascript">

    </script>
@endsection
