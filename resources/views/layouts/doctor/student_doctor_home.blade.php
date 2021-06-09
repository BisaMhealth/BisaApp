@extends('layouts.apptheme_innerpage')

@section('title','Dashboard')

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/doctor/dashboard">{{__('Home')}}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Dashboard') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ __('Welcome Back :: Dr') }} . {{ Session::get('full_name')}}</h4>
          </div>
        </div>
@endsection


@section('content')


        @if(Session('doctor_permission') != "student")
        <div class="col-sm-4 col-lg-3 ">
            <a href="/question-queue" >
                <div class="card card-body br-green1">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                   {{ __('Unanswered Questions') }}  </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">

                       <span class="set-unreadquestion">
                         {{ $ureadQuestionsGlobal }}
                       </span>

                    </h3>
                    <p class="tx-11 tx-color-03 mg-b-0 tx-success"> <i class="fa fa-comment-medical fa-md"></i>
                    {{ __('Click to see unread questions') }}
                    </p>
                </div>

                </div>
                </a>
        </div><!-- col -->
        @endif



<!--         <div class="col-sm-4 col-lg-3 ">
            <a href="#" >
                <div class="card card-body br-green1">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                   Follow ups </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"> 0</h3>
                    <p class="tx-11 tx-color-03 mg-b-0 tx-success"> <i class="fa fa-comment-alt fa-md"></i></i>
                    Click to view user replies
                    </p>
                </div>

                </div>
                </a>
        </div> --><!-- col -->


        <div class="col-sm-4 col-lg-3 ">
            <a href="/article-dashboard" >
                <div class="card card-body br-green1">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                {{ __('Health Tips') }}</h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"> {{$countArticles }}</h3>
                    <p class="tx-11 tx-color-03 mg-b-0 tx-success"> <i class="fa fa-file fa-md"></i></i>
                    {{ __('Health Tips') }}
                    </p>
                </div>

                </div>
                </a>
        </div><!-- col -->

        <div class="col-sm-4 col-lg-3 ">
            <!-- <a href="/work-flow" >
                <div class="card card-body br-green1">
                <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">
                {{ __('Workflow') }} </h6>
                <div class="d-flex d-lg-block d-xl-flex align-items-end">
                    <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1"> {{$allQuestions}}</h3>
                    <p class="tx-11 tx-color-03 mg-b-0 tx-success"> <i class="fa fa-file fa-md"></i></i>

                    </p>
                </div>

                </div>
                </a> -->
        </div>

          <div class="col-sm-12 col-lg-12 mt-4">
            <div class="card mg-b-10">
            <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
              <div>
                <h6 class="mg-b-5">{{ __('COVID-19') }} </h6>

              </div>


                <a style="display:block;" href="/covid-patient-review" class="btn btn-primary float-right"> Follow Up </a>

            </div>
            </div><!-- card-header permission-->
          </div>



                <div class="col-sm-12 col-lg-12 mt-4">
                     <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6  class="mg-b-5">{{ __('Questions') }}</h6>

                </div>

              </div><!-- card-header -->
              <div class="card-body pd-y-30">
                <div class="d-sm-flex">
                  <div class="media">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                        <line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">
                      {{ __('Opened Questions') }}
                      </h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">

                      <span class="set-unreadquestion"> {{ $ureadQuestionsGlobal }} </span>

                      </h4>
                    </div>
                  </div>



                </div>
              </div><!-- card-body -->
              <div class="table-responsive col-md-12 col-lg-12 ">

              <table class="table table-striped mg-b-0"> <!-- Per Hospital -->

                  <thead>
                         <tr>
                          <th> {{ __('Patient Name') }} </th>
                          <th style="width: 50%"> {{ __('Questions') }}</th>
                          <th> {{ __('Answered') }}</th>
                          <th> {{ __('Date') }}</th>
                          <th> {{ __('Details') }}</th>
                          <th> {{ __('Remove') }}</th>
                         </tr>
                  </thead>

                  <tbody id="question-body">

                  </tbody>

                </table>

                  <nav aria-label="Page navigation example " class="float-fleft mt-4 mb-4 ml-4">
                      <ul class="pagination mg-b-0 question-paginations-links">

                      <!--   <li class="page-item disabled"><a class="page-link page-link-icon" href="#"><i data-feather="chevron-left"></i></a></li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link page-link-icon" href="#"><i data-feather="chevron-right"></i></a></li> -->
                      </ul>

                    </nav>


              </div><!-- table-responsive -->
            </div><!-- card -->
        </div><!-- col -->




        @if(Session('doctor_permission') != "student")
        <div class="col-sm-12 col-lg-8 mt-4">
                     <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">{{ __('Appointment list') }}</h6>

                </div>

              </div><!-- card-header -->
              <div class="card-body pd-y-30">
                <div class="d-sm-flex">
                  <div class="media">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                        <line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">{{ __('Number of meetings') }}</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">  </h4>
                    </div>
                  </div>



                </div>
              </div><!-- card-body -->
              <div class="table-responsive">
                <table class="table table-dashboard mg-b-0"> <!-- Per Hospital -->
                  <thead>


                      <th>{{ __('Req.Date') }}</th>
                      <th class="text-left">{{ __('Patient Name') }}</th>
                      <th class="text-left">{{ __('Appointment Date') }}</th>
                      <th class="text-left">{{ __('Time') }}</th>
                      <th class="text-left">{{ __('Type') }}</th>
                      <th class="text-left">{{ __('Status') }}</th>


                  </thead>
                  <tbody>
                    @if(isset($hospitalAppointments))
                      @foreach($hospitalAppointments as $patientAppointments)
                           <tr>
                              <td class="tx-color-03 tx-normal">{{ Carbon\Carbon::parse($patientAppointments->created_at)->format('M-d-Y') }}</td>
                              <td class="tx-medium text-left">{{$patientAppointments->patient_name}}</td>
                              <td class="text-left tx-teal">{{$patientAppointments->start_date}}</td>
                              <td class="text-left tx-pink">{{$patientAppointments->start_time}}</td>
                              <td class="text-left tx-pink">{{$patientAppointments->appointment_type}}</td>
                              <td class="tx-medium text-left">
                                @switch($patientAppointments->status)

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
                          </tr>
                    @endforeach




                  </tbody>
                </table>

                  @else
                     <div class="alert alert-warning">{{ __('No Records Found') }}</div>

                @endif


              </div><!-- table-responsive -->
            </div><!-- card -->
        </div><!-- col -->






          <div class="col-sm-12 col-xl-4 mt-4">
            <div class="card ht-lg-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0"></h6>
                <ul class="list-inline d-flex mg-b-0">
                 <!--  <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Today</span>
                  </li> -->
                  <li class="list-inline-item d-flex align-items-center mg-l-10">
                    <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">{{ __('Today') }}</span>
                  </li>
                </ul>
              </div><!-- card-header -->
              <div class="card-body pd-b-0">
                <div class="row mg-b-20">
                  <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">{{$totalDailQues}} / {{$toatalResponses}}<!-- small class="tx-11 tx-success letter-spacing--2"><i class="icon ion-md-arrow-up"></i> 0.20%</small> --></h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">  {{ __('Questions') }} / {{ __('Answers') }}</p>
                  </div>



                   <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10"> {{ $fmtAvgResponseTime }}  <small class="tx-11 tx-danger letter-spacing--2"> h : s</small> </h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">{{ __('Avg Response Time') }}</p>
                  </div>


                </div><!-- row -->
               <!--  <div class="chart-five">
                  <div>
                    <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
                    <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="chartBar1" style="display: block; height: 225px; width: 341px;" width="682" height="450" class="chartjs-render-monitor">

                    </canvas>

                  </div>
                </div> -->
              </div><!-- card-body -->
            </div>
          </div><!-- col -->

          @endif
                <!-- -->

@endsection
