@extends('layouts.apptheme_innerpage')

@section('title', $catname)

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/article/category/{{ $categoryId }}/{{ $catname }}">{{ $catname }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ $title }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection


@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-8">
                @if(isset($article))
                <div class="card">
                    <img src="{{ $article->thumbnail }}" class="card-img-top article-thumbnail" alt="...">
                    <div class="card-body">
                        <h6 class="card-title">{{ $article->title }}</h6>
                        <p class="card-text"><?php echo $article->content;  ?></p>
                        <a href="/article/category/{{ $categoryId }}/{{ $catname }}" class="card-link btn btn-sm btn-dark rounded-pill">
                            <i class="fa fa-arrow-left"></i>
                        </a>
                    </div>
                </div>

                @endif


            </div>






            <div  class="col-md-4 mt-3">

                <div style="border:1px solid #ebeded; width:98% !important; " class="section-nav sticky-top">
                   <h6 style="color: #3a4761 !important;" class="card-subtitle mb-2 text-muted cs-navlable ml-2 mt-2 ">{{ __('OTHERS') }}</h6>
                    <nav id="navSection" class="nav flex-column">

                            @if(isset($categories))
                              @foreach($categories as $value)
                              <a href="/read/{{ $value->id }}/{{ $catname }}/{{ $value->title }}/{{ $categoryId }}" class="nav-link"> {{ $value->title }} </a>
                              @endforeach
                            @endif
                    </nav>
                    </div>
            </div>



        </div>
    </div>
@endsection
