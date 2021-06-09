@extends('layouts.apptheme_innerpage')

@section('title', __('Hospitals'))

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/patient/dashboard">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Hospitals') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection


@section('content')

<div class="row">
      @foreach($responseData as $hospital)
      
      <div class="card ml-4 mb-4  col-sm-3">

        <img  style="width:180px" src="{{ $hospital->image_url }}" class="card-img-top" alt="...">
        
        <div class="card-body">
          <h5 class="card-title link-green">{{ $hospital->hospital_name }}</h5>
          <p class="card-text">
              <h6>{{ __('Phone') }}   : {{ $hospital->phone }}</h6>
              <h6>{{ __('Email') }}   : {{ $hospital->email }}</h6>
              <h6>{{ __('Website') }} : {{ $hospital->website_url }}</h6>
              <h6>{{ __('Speciality') }} : {{ $hospital->speciality }}</h6>
          </p>
          <a href="#" class="btn btn-success">{{ __('See more') }}</a>
        </div>
      </div>
      @endforeach




</div><!-- End Row -->

@endsection
