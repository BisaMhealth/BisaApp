@extends('layouts.apptheme_innerpage')

@section('title', __('My Appointment') )

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/patient/dashboard">{{ __('Appointment') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{  __('My Appointment') }}</li>
              </ol>
            </nav>
            <h3 style="color:#5c5b5b !important;" class="mg-b-0 tx-spacing--1 mt-5">{{  __('My Appointment') }}</h3>
          </div>
        </div>
@endsection


@section('content')

<div  class="card card-body">


                    <table  class="table table-striped col-md-10">
                    <thead>
                      <tr>
                        <th class="wd-40">{{ __('DATE OF APPOINTMENT') }}</th>
                        <th class="wd-40">{{ __('HOSPITAL') }} </th>
                        <th class="wd-25 ">{{ __('DOCTOR') }}</th>
                        <th class="wd-35 ">{{ __('STATUS') }}</th>
                        <th class="wd-35 ">{{ __('DETAILS') }}</th>
                        <!-- <th class="wd-35 ">{{ __('REMOVE') }}</th> -->
                      </tr>
                    </thead>
                    <tbody id="">
                      @if(isset($appiontmentData))
                        @foreach($appiontmentData as $appointment)
                          <tr>
                            <td class="txt-light-blue">
                           {{ Carbon\Carbon::parse($appointment->start_date )->format('M-d-Y') }}  @   {{ $appointment->start_time }}
                            </td>
                            <td>{{ $appointment->hospital_name }}</td>
                            <td>{{ $appointment->doctor_name }}</td>
                            <td>
                              @switch($appointment->status)

                                @case (1)

                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                                @break;

                                 @case (2)

                                <span class="badge badge-success">{{ __('Confirmed') }}</span>
                                @break;

                                  @case (3)

                                <span class="badge badge-danger">{{ __('Cancelled') }}</span>
                                @break;

                              @endswitch

                            </td>

                            <td class="text-right">
                              <a href="#" class="btn btn-xs btn-info">{{ __('See the details') }}</a>
                            </td>

                            <!-- <td class="text-right">
                              <a href="#" class="btn btn-xs btn-danger"> <i class="fa fa-trash"></i> </a>
                            </td> -->
                          </tr>
                          @endforeach
                      @endif
                    </tbody>
                  </table>

</div>

@endsection
