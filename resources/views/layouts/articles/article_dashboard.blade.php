@extends('layouts.apptheme_innerpage')

@section('title', __('Health tips')  )

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item">
                @switch(Session::get('user_role'))
                  @case('patient')
                  <a href="/patient/dashboard">{{ __('Home') }}</a> 
                  @break

                  @case('doctor')
                  <a href="/doctor/dashboard">{{ __('Home') }}</a> 
                  @break

                @endswitch
                </li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Health tips') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection


@section('content')

<div class="row">

         @if(isset($categories))

            @foreach($categories as $category)
                
                    <div class="card card-help ml-4">
                    <div class="card-body tx-13">
                        <div class="tx-60 lh-0 mg-b-25"><i class="icon ion-ios-filing"></i></div>
                        <h5><a href="" class="link-01">{{ $category->category_name }}</a></h5>
                        <p class="tx-color-03 mg-b-0">...</p>
                    </div>
                    <a href="/article/category/{{ $category->article_cat_id }}/{{ $category->category_name }}" class="tx-18 lh-0">
                    <div class="card-footer tx-13">
                        <span> ({{ $category->number_of_articles }}) {{ __('Topics') }}</span>
                        <i class="icon ion-md-arrow-forward"></i>
                    </div>
                    </a>
                    </div>
                
            @endforeach

          @endif

        


</div><!-- End Row -->

@endsection
