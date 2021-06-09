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
	 @if(session()->has('message'))
          <div class="alert alert-success">{{session('message')}}</div>
        @endif

        <h3>Edit Article</h3>
        <hr>
        <div class="row">
            <div class="col-md-12">
               @if($article_edit_id)
		    <form method="post" action="{{route('adminArticleupdate',$article_edit_id->article_id)}}" enctype="multipart/form-data">
			@csrf
                        <input type="hidden" name="article_id" value="{{$article_edit_id->article_id}}">
                        <div class="row">
                            <div class="col-6">
                                <img src="" name="article_thumbnail" class="edit-article-thumbnail-res img-fluid">
                                 <label for="edit-article-thumbnail" class="btn btn-secondary btn-block edit-article-thumbnail-label"><small>Update Article Thumbnail</small></label>
                                <input type="file" name="article_thumbnail" id="edit-article-thumbnail" accept="image/*" class="edit-article-thumbnail">
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-6">
                                <label><h4>Article Title</h4></label>
                                <input type="text" name="article_title" class="form-control form-control-sm edit-article-title" value="{{$article_edit_id->article_title}}" required>
                            </div>

                            <div class="col-6">
                                <label><h4>Article Category</h4></label>
                            <select name="category_name" class="form-control form-control-sm publish-article-select edit-article-cateogory" required>
				<option  value="{{\App\Models\ArticleCategory::select('category_id')->where('category_id',$article_edit_id->article_cat_id)->pluck('category_id')->first()}}" selected>{{\App\Models\ArticleCategory::select('category_name')->where('category_id',$article_edit_id->article_cat_id)->pluck('category_name')->first()}}</option>
			     @if($categories)
                    @foreach($categories as $category)
                        <option  value="{{$category->category_id}}">{{$category->category_name}}</option>
                    @endforeach
                @endif
				</select>
                            </div>
                        </div><br>

                        <div class="row">
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label><h4>Article Content</h4></label>
                                    <textarea name="article_content" class="form-control tinymce-editor" required>
                                            {{$article_edit_id->article_content}}
                                    </textarea>
                                </div>
                            </div>

			    <div class="col-md-5">
				<label><h4>Article thumbnail</h4></label>
                                <img src="{{$article_edit_id->article_thumbnail}}" class="img-fluid" style="border-radius: 5px;">
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-sm btn-custom edit-btn">Update</button>
                        <a href="/admin/articles" class="btn btn-sm btn-info">Cancel</a> 
                    </form>
               @endif
            </div>
        </div>
        <a class="btn btn-float rounded-circle" href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/publish-article">+</a>
    </div>


</div>
@endsection

@section('javascript')
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/quill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin-constants.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/controllers/admin/admin-article-controller.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/t85g896g81eyk3aij3xetvp5evhamv7k07t1fbijar9saegk/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: 'textarea.tinymce-editor',
            height: 600,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code help wordcount'
            ],
            toolbar: 'undo redo | formatselect | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help',
            content_css: '//www.tiny.cloud/css/codepen.min.css'
        });
    </script>

@endsection

