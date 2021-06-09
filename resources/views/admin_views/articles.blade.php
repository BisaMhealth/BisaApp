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
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped">
                  <thead>
                    <tr>
                     <th scope="col">#</th>
                      <th scope="col">Image</th>
                      <th scope="col">Title</th>
                      <th scope="col">Category</th>
                      <th scope="col">Author</th>
                      <th scope="col">Date</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>
          <tbody>
          @if($articles)
               @foreach($articles as $article)
            <tr>
                <td>{{$article->article_id}}</td>
                <td><img src="{{$article->article_thumbnail}}" class="article-thumbnail-sm img-fluid"></td>
                <td>{{$article->article_title}}</td>
            <td> {{\App\Models\ArticleCategory::select('category_name')->where('category_id',$article->article_cat_id)->pluck('category_name')->first()}} </td>
                      <td>{{\App\Models\Admin::select('admin_username')->where('admin_id',$article->article_author)->pluck('admin_username')->first()}} </td>
                            <td>{{$article->created_at}}</td>
               <td colspan="2">                    
            <a href="{{route('view-article',$article->article_id)}}" class="text-warning action-btn"><i class='fa fa-eye'></i> view</a>&nbsp;&nbsp;&nbsp;
            <a href="{{route('edit-article',$article->article_id)}}" class='text-info action-btn'><i class='fa fa-pencil'></i> edit</a>&nbsp;&nbsp;&nbsp;
            <a href="{{route('delete-article',$article->article_id)}}" class='text-danger action-btn'><i class='fa fa-trash-o'></i> delete</button>
              </td>
            </tr>
                        @endforeach
                  </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {!! $articles->links() !!}  
        </div>
        @endif
            </div>
        </div>
       <a class="btn btn-float rounded-circle" href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/admin/publish-article">+</a>
    </div>
    <!--Edit article details modal-->
    <div class="modal fade" id="edit-article-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Article</h5>
            </div>
            <div class="modal-body">
                <form method="post" class="edit-article-form" enctype="multipart/form-data">
                    <input type="hidden" class="edit-article-id">
                    <div class="row">
                        <div class="col-6">
                            <img src="" class="edit-article-thumbnail-res img-fluid">
                            <label for="edit-article-thumbnail" class="btn btn-secondary btn-block edit-article-thumbnail-label"><small>Update Article Thumbnail</small></label>
                            <input type="file" name="editArticleThumbnail" id="edit-article-thumbnail" accept="image/*" class="edit-article-thumbnail">
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-6">
                            <label><small>Article Title</small></label>
                            <input type="text" class="form-control form-control-sm edit-article-title">
                        </div>

                        <div class="col-6">
                            <label><small>Article Category</small></label>
                            <select class="form-control form-control-sm publish-article-select edit-article-cateogory"></select>
                        </div>
                    </div><br>

                    <div class="form-group">
                        <label><small>Article Content</small></label>
                        <textarea class="form-control form-control-sm edit-article-content"></textarea>
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


    <!--View article details modal -->
    <div class="modal fade" id="article-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><b><span class="article-detail-title"></span></b></h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-5">
                        <img src="" class="article-detail-img img-fluid"/>
                    </div>
                    <div class="col-md-7">
                        <table class="table table-sm">
                            <tr>
                                <td>
                                    <b>Category</b>
                                </td>
                                <td><span class="article-detail-category"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Author</b>
                                </td>
                                <td><span class="article-detail-author"></span></td>
                            </tr>

                            <tr>
                                <td>
                                    <b>Date Published</b>
                                </td>
                                <td><span class="article-detail-date-published"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Upvotes</b>
                                </td>
                                <td><span class="article-detail-upvotes"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Downvotes</b>
                                </td>
                                <td><span class="article-detail-downvotes"></span></td>
                            </tr>
                            <tr>
                                <td>
                                    <b>Views</b>
                                </td>
                                <td><span class="article-detail-views"></span></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12 article-detail-content"></div>
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
    <script type="text/javascript" src="{{ asset('js/quill.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin-constants.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/controllers/admin/admin-article-controller.js') }}"></script>
    <script>
        getAllArticles();
        getArticleCategoriesForForm();
    </script>
@endsection
