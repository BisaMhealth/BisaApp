@extends('layouts.apptheme_innerpage')

@section('title', __('Pharmacies'))

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
                
                </li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Pharmacies') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1"></h4>
          </div>
        </div>
@endsection


@section('content')

<div class="row">
      @foreach($pharmaciesData as $pharmacy)
      
       <div class="card ml-4">

        <img  style="width:40%;" src="{{ $pharmacy->name }}" class="card-img-top ml-4 mt-4" alt="" />

        <div class="card-body">
          <h5 class="card-title link-green">{{ $pharmacy->name }}</h5>
          <p class="card-text">
              <h6>{{ __('Address')  }}   : {{ $pharmacy->address }}</h6>
              <h6>{{ __('Phone')  }}   : {{ $pharmacy->phone }}</h6>
              <h6>{{ __('Email')  }}   : {{ $pharmacy->email }}</h6>
              <h6>{{ __('Working Hours')  }}   : {{ $pharmacy->description }}</h6>
              
          </p>
          <a href="#" class="btn btn-success">{{ __('See more') }}</a>
        </div>
      </div>
      @endforeach




</div><!-- End Row -->

@endsection
