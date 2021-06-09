@extends('layouts.apptheme_innerpage')

@section('title',__('Frequently asked questions'))  

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/patient/dashboard">{{__('Health Tips')}}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{__('Frequently asked questions')}}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection


@section('content')

<div class="row">

     <div class="col-sm-10 col-md-10 col-lg-10 mb-4">
      @if(isset($categoryData))

      <div class="btn-group" role="group" aria-label="Basic example">
        @foreach($categoryData as $category)

         <a href="/faq/{{ $category->cat_id }}"  class="btn btn-secondary">{{ $category->cat_name }}</a>

        @endforeach
      </div>
      @endif

      </div>

      @if(isset($listQuestions))

            <div class="col-sm-12 col-md-3 col-lg-3 ">
            <ul class="list-group section-nav sticky-top mb-5">
              @foreach($listQuestions->data as $answer)
                  <li class="list-group-item"><a href="#{{ $answer->faq_id }}"> {{ $answer->question }}</a></li>
              @endforeach

            </ul>
        </div>

      <div class="col-sm-12 col-md-8 col-lg-8 ml-4">

          @foreach($listQuestions->data as $answer)
              <h3 id="{{ $answer->faq_id }}" class="mg-b-10">{{ $answer->question }}</h3>
               <p class="mg-b-30">{{ $answer->answer }}</p>

               <hr class="mg-t-50 mg-b-40">

          @endforeach

      </div>
      @endif




</div><!-- End Row -->

@endsection


@push('scripts')

    <script>
      $(function(){
        'use strict'

        // Default functionality
        $('#accordion1').accordion({
          heightStyle: 'content'
        });

        // Collapse content
        $('#accordion2').accordion({
          heightStyle: 'content',
          collapsible: true
        });

        // Custom style
        $('#accordion3').accordion({
          heightStyle: 'content'
        });

        $('#accordion4').accordion({
          heightStyle: 'content'
        });

        // Colored variant
        $('#accordion5').accordion({
          heightStyle: 'content'
        });

        $('#accordion6').accordion({
          heightStyle: 'content'
        });

        $('#accordion7').accordion({
          heightStyle: 'content'
        });

        $('#accordion8').accordion({
          heightStyle: 'content'
        });

      });
    </script>

@endpush
