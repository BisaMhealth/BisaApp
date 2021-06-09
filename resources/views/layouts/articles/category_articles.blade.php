@extends('layouts.apptheme_innerpage')

@section('title',__('Health tips').'-'.$categoryName)

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/article-dashboard">{{__('Health tips')}}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ $categoryName }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection



@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                @if(isset($articles))
                        @foreach($articles as $value)
                        <div class="card mt-3">
                            <div class="card-body">
                               <a href="/read/{{ $value->id }}/{{ $categoryName }}/{{ $value->title }}/{{ $categoryId }}" class="">
                                <h5 class="card-title">
                                <img  src="{{ $value->thumbnail }}" alt="{{ $value->title }}" class="img-fluid img-thumbnail article-thumbnail" />
                                </h5> </a>

                                <br/>
                                <a href="/read/{{ $value->id }}/{{ $categoryName }}/{{ $value->title }}/{{ $categoryId }}" class="cs-links">
                                <h6 class="card-subtitle mb-2 text-muted">{{ $value->title }}</h6>
                                <p class="card-text">
                                  <?php
                                        $content = $value->content;
                                        if(strlen($value->content) >= 200){
                                          $content = substr($value->content, 0, 400). " ... ";
                                          echo $content;
                                        }else {
                                          $content = $value->content;
                                          echo $content;
                                        }
                                   ?>
                                    <!-- @if(strlen($value->content) >= 200)
                                    {{ substr($value->content, 0, 400). " ... " }}
                                    @else
                                      {{  $value->content }}
                                    @endif -->
                                </p>
                                </a>

                                <a href="/read/{{ $value->id }}/{{ $categoryName }}/{{ $value->title }}/{{ $categoryId }}" class="card-link float-right btn btn-sm btn-dark rounded-pill">
                                Read More</a>

                            </div>
                        </div>

                        @endforeach
                @endif


            </div>






            <div  class="col-md-3 mt-3  ">

                <div style="border:1px solid #ebeded; width:98% !important; " class="section-nav sticky-top">
                   <h6 style="color: #3a4761 !important;" class="card-subtitle mb-2 text-muted cs-navlable ml-2 mt-2 ">
                   Other Categories
                   </h6>
                    <nav id="navSection" class="nav flex-column">

                        @if($categories)
                            @foreach($categories as $data)
                              <a href="/article/category/{{ $data->article_cat_id }}/{{ $data->category_name }}" class="nav-link"> {{ $data->category_name }} </a>
                            @endforeach
                        @endif
                    </nav>
                    </div>
            </div>



        </div>
    </div>
@endsection



@push('scripts')
<script src="{{ asset('../lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('../lib/prismjs/prism.js') }}"></script>
@endpush
