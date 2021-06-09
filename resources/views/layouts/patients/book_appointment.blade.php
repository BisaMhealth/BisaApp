@extends('layouts.apptheme_innerpage')

@section('title', __('Book an appointment') )

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/patient/dashboard">{{ __('Home')}}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Book an appointment') }}</li>
              </ol>
            </nav>
            <h3 style="color:#5c5b5b !important;" class="mg-b-0 tx-spacing--1 mt-5">{{ __('New appointment') }}</h3>
          </div>
        </div>
@endsection


@section('content')

<div  class="card card-body">

      <div class="row row-sm mg-b-10 pl-4">
                <div class="col-sm-6">
                          @if (count($errors) > 0)
                                        <div class = "alert alert-danger">
                                            <ul>
                                              @foreach ($errors->all() as $error)
                                                  <li>{{ $error }}</li>
                                              @endforeach
                                            </ul>
                                        </div>
                            @endif

                  </div>

      </div>
  <form action="/patient/book/appointment" method="POST" id="form1" class="needs-validation ">
        {{ csrf_field() }}
        <div class="row row-sm mg-b-10 pl-4">

                  <div class="col-sm-6">
                    <h6 for="inputEmail4 form-label">{{ __('Fullname')}}</h6>
                    <input  style="border-bottom-color: #3bac2f !important; border-left-color: #fff !important;  border-top-color: #fff !important; border-right-color: #fff !important;" type="text" class="form-control" id="" value="{{ $fullname }}" placeholder="">

                    <input type="hidden" value="{{ Session::get('user_id')}}" id="user-t" name="user_t">
                  </div>

                   <div class="col-sm-6">
                    <!-- <label class="badge badge-info" for="inputEmail4">Change</label>
                     -->
                  </div>

                     <div class="col-sm-6 mt-4">
                      <label for="inputEmail4 form-label">{{ __('Clinic') }} ({{ __('Optional') }} ) </label>
                       <select class="form-control" name="hospital_id">
                        @if(isset($hospitalList))
                          <option value="">
                          {{ __('Select your prefered clinic') }}</option>
                          @foreach($hospitalList as $hospital)
                            <option value="{{ $hospital->hospital_id }}">{{ $hospital->hospital_name }}</option>
                          @endforeach
                        @endif
                       </select>
                    </div>

      </div>


      <div class="row row-sm mg-b-10 mt-4 pl-4">
                  <div class="col-sm-6">
                    <h6 for="inputEmail4 form-label">{{ __('Reason') }}</h6>
                    <textarea class="form-control" name="reason">{{ old('reason') }}</textarea>
                  </div>

      </div>


            <div class="row row-sm mg-b-10 mt-3 pl-4">

                  <div class="col-sm-3">
                    <h6 for="inputEmail4 form-label">{{ __('Appointment Date') }}</h6>
                     <input value="{{ old('appointment_date') }}" style="border-bottom-color: #3bac2f !important; border-left-color: #fff !important;  border-top-color: #fff !important; border-right-color: #fff !important;" type="text" id="" class="form-control  datepicker-single" name="appointment_date" placeholder="{{ __('Appointment Date') }}">
                  </div>


                  <div class="col-sm-2">
                    <h6 for="inputEmail4 form-label">{{ __('Time') }}</h6>
                     <input value="{{ old('appointment_time') }}" style="border-bottom-color: #3bac2f !important; border-left-color: #fff !important;  border-top-color: #fff !important; border-right-color: #fff !important;" type="time" id="" class="form-control hasDatepicker" name="appointment_time" placeholder="{{ __('Time') }}">
                  </div>

            </div>


            <div class="row row-sm mg-b-10 mt-4 pl-4">
                  <div class="col-sm-6">
                    <h6 for="inputEmail4 form-label">{{ __('Type of Appointment')}}</h6>
                  </div>
            </div>

              <div class="row row-sm mg-b-10  pl-4">

                <div class="col-sm-1">
                  <div class="custom-control custom-radio">
                    <input value="video"  type="radio" id="customRadio1" name="customRadio" class="app-type custom-control-input" checked>
                    <label class="custom-control-label" for="customRadio1">
                      <i class="fa fa-video cs-icon"></i></label>
                  </div>
              </div>

                <div class="col-sm-1">
                <div class="custom-control custom-radio">
                  <input type="radio" value="audio" id="customRadio2" name="customRadio" class="custom-control-input app-type">
                  <label class="custom-control-label" for="customRadio2">
                    <i class="fa fa-microphone-alt cs-icon"></i>
                  </label>
                </div>
                </div>
              </div>


              <input type="hidden" id="appointment-type" value="{{ old('appointment_type') }}" name="appointment_type">

              <div class="row row-sm mg-b-10 mt-5 pl-4">

                <div class="col-sm-6">
                  <button type="submit" class="btn btn-success btn-block book-appointment"> {{ __('Book')}} </button>
                </div>

              </div>

  </form>

</div>

@endsection


@push('scripts')




@end
