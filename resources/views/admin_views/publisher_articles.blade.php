@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
@endsection

@section('content')
<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">


                <li class="menu-item-has-children dropdown active-list">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-edit"></i>Articles</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-list-alt"></i><a href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/publisher/article-categories">Article Categories</a></li>

                        <li class="active"><i class="menu-icon fa fa-book"></i><a href="#">All Articles</a></li>
                    </ul>
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
            <div class="col-md-12 articles-res"></div>
        </div>
        <a class="btn btn-float rounded-circle" href="<?php echo Config::get('constants.ADMIN_APP_DIRECTORY'); ?>/publisher/publish-article">+</a>
    </div>

    <!--Edit article details modal-->
    <div class="modal fade" id="edit-article-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Article Category</h5>
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
                        <div id="toolbar"></div>
                        <div id="editor" class="article-content edit-article-content"></div>
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
