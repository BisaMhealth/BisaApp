@extends('layouts.apptheme_innerpage')
@section('title', __('Admin Dashboard') )

@section('pageinfo')

          <div class="col-md-12">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/patient/dashboard">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('Admin Dashboard') }}</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">{{ __('Hi') }} ,
              <?php $fullName = Session::get('full_name') ?>
              @if(!$fullName == 'n/a' || !$fullName == 'n_a')

                 @else
                      {{ Session::get('full_name') }}

              @endif
            </h4>

            @if(Session::get('admin_type') == 'admin')
                <div class="">
                  <div class="mg-t-10">
                <div class="card">
                  <div class="card-header">
                    <h6 class="mg-b-0">{{ __('USERS') }}</h6>
                  </div><!-- card-header -->
                  <div class="card-body pd-0">
                    <div class="row no-gutters">

                      <div class="col col-sm-6 col-lg">
                        <div class="crypto">
                          <div class="media mg-b-10">
                            <div class="crypto-icon bg-secondary">
                              <i class="fa fa-users"></i>
                            </div><!-- crypto-icon -->
                            <div class="media-body pd-l-8">
                              <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">{{ __('Patients') }} </h6>
                              <div class="d-flex align-items-baseline tx-rubik">
                                <h5 class="tx-20 mg-b-0" id="patient-counts" >0</h5>
                                <p class="mg-b-0 tx-11 tx-success mg-l-3"><i class="icon ion-md-arrow-up"></i> 0.77%</p>
                              </div>
                            </div><!-- media-body -->
                          </div><!-- media -->

                          <div class="chart-twelve">
                            <div id="flotChart3" class="flot-chart" style="padding: 0px; position: relative;">
                              <canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160">
                              </canvas>
                              <canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas>
                            </div>
                          </div> <!-- chart-twelve -->

                          <div class="pos-absolute b-5 l-20 tx-medium">
                              <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                <a href="" class="link-01 tx-semibold">( <span id="p-males"></span> )</a> {{ __('MALES') }}
                              </label>
                              <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                <a href="" class="link-01 tx-semibold">( <span id="p-females"></span> )</a> {{ __('FEMALES') }}
                              </label>
                            </div>
                        </div><!-- crypto -->
                      </div>

                      <div class="col col-sm-6 col-lg bd-t bd-sm-t-0 bd-sm-l">
                        <div class="crypto">
                          <div class="media mg-b-10">
                            <div class="crypto-bitcoin-cash"><i class="fa fa-users tx-success tx-42"></i></div>
                            <div class="media-body pd-l-8">
                              <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">{{ __('Admins') }} <span class="tx-color-03 tx-normal">( ADMINISTRATORS )</span></h6>
                              <div class="d-flex align-items-baseline tx-rubik">
                                <h5 class="tx-20 mg-b-0" id="admin-count"></h5>
                                <p class="mg-b-0 tx-11 tx-success mg-l-3"><i class="icon ion-md-arrow-up"></i> 4.34%</p>
                              </div>
                            </div><!-- media-body -->
                          </div><!-- media -->

                          <div class="chart-twelve">
                            <div id="flotChart5" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas></div>

                          </div><!-- chart-twelve -->

                          <div class="pos-absolute b-5 l-20 tx-medium">
                          <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                            <a href="" class="link-01 tx-semibold">( <span id="ad-males"></span> )</a> {{ __('MALES') }}
                          </label>
                          <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                            <a href="" class="link-01 tx-semibold">( <span id="ad-females"></span> )</a> {{ __('FEMALES') }}
                          </label>
                        </div>

                        </div><!-- crypto -->
                      </div>


                      <div class="col col-sm-6 col-lg bd-t bd-lg-t-0 bd-lg-l">
                        <div class="crypto">
                          <div class="media mg-b-10">
                            <div class="crypto-icon bg-litecoin">
                              <i class="fa fa-stethoscope"></i>
                            </div><!-- crypto-icon -->
                            <div class="media-body pd-l-8">
                              <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">{{ __('Doctors') }} <span class="tx-color-03 tx-normal">(LTC)</span></h6>
                              <div class="d-flex align-items-baseline tx-rubik">
                                <h5 class="tx-20 mg-b-0"  id="doctor-count"></h5>
                                <p class="mg-b-0 tx-11 tx-danger mg-l-3"><i class="icon ion-md-arrow-up"></i> 2</p>
                              </div>
                            </div><!-- media-body -->
                          </div><!-- media -->

                          <div class="chart-twelve">
                            <div id="flotChart4" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas></div>
                          </div><!-- chart-twelve -->

                          <div class="pos-absolute b-5 l-20 tx-medium">
                              <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                <a href="" class="link-01 tx-semibold">( <span id="d-males">s</span> )</a> {{ __('MALES') }}
                              </label>
                              <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                <a href="" class="link-01 tx-semibold"> ( <span id="d-females"></span> )</a> {{ __('FEMALES') }}
                              </label>
                            </div>
                        </div><!-- crypto -->
                      </div>
                      <div class="col col-sm-6 col-lg bd-t bd-lg-t-0 bd-sm-l">
                        <div class="crypto">
                          <div class="media mg-b-10">
                            <div class="crypto-icon bg-primary">
                              <i class="fa fa-edit"></i>
                            </div>
                            <div class="media-body pd-l-8">
                              <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">{{ __('Editors') }} <span class="tx-color-03 tx-normal"></span></h6>
                              <div class="d-flex align-items-baseline tx-rubik">
                                <h5 class="tx-20 mg-b-0">0</h5>
                                <p class="mg-b-0 tx-11 tx-danger mg-l-3"><i class="icon ion-md-arrow-up"></i> 0.0%</p>
                              </div>
                            </div>
                          </div>

                          <div class="chart-twelve">
                            <div id="flotChart5" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas></div>
                          </div>

                        </div>
                      </div>


                    </div><!-- row -->
                  </div><!-- card-body -->
                </div><!-- card -->
              </div>
              </div><!-- End Stripe -->
          @endif


          <div class="">
            <div class="mg-t-10">
          <div class="card">

            <div class="card-header">
              <h6 class="mg-b-0">COVID-19</h6>

              <a class="btn btn-primary float-right" href="/patient/covid/follow">{{ __('Follow UP') }}</a>
            </div><!-- card-header -->

            <div class="card-header">
              <h6 class="mg-b-0">{{ __('ARTICLES') }}</h6>

              <a class="btn btn-primary float-right" href="/article/publish">{{ __('Publish') }}</a>
            </div><!-- card-header -->


            <div class="card-body pd-0">
              <div class="row no-gutters">


                <div class="col-lg-3 col-md-6 mg-t-10">
                    <div class="card">
                     <a href="/list-articles">
                      <div class="card-body pd-y-20 pd-x-25">
                        <div class="row row-sm">
                          <div class="col-7">
                            <h3 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">{{ $articleCount  }}</h3>
                            <h6 class="tx-12 tx-semibold tx-uppercase tx-spacing-1 tx-primary mg-b-5">{{ __('ARTICLES') }} (s)</h6>
                            <p class="tx-11 tx-color-03 mg-b-0"></p>
                          </div>
                        </div>
                      </div><!-- card-body -->
                        </a>

                    </div><!-- card -->
                  </div>




                  <div class="col-lg-3 col-md-6 mg-t-10">
                      <div class="card">
                        <a href="#">
                        <div class="card-body pd-y-20 pd-x-25">
                          <div class="row row-sm">
                            <div class="col-7">
                              <h3 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">{{$countCategories}}</h3>
                              <h6 class="tx-12 tx-semibold tx-uppercase tx-spacing-1 tx-primary mg-b-5">Category(s)</h6>
                              <p class="tx-11 tx-color-03 mg-b-0"></p>
                            </div>

                          </div>
                        </div><!-- card-body -->
                          </a>
                      </div><!-- card -->
                    </div>


              </div><!-- row -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div>
        </div><!-- End Stripe -->








          <div class="">
            <div class="mg-t-10">
          <div class="card">
            <div class="card-header">
              <h6 class="mg-b-0">{{ __('QUESTION STATS') }}</h6>

              <span class="float-right">
                  <select class="stats-period">
                    <option value="<?php echo date('Y'); ?>">{{ __('Select Period') }}</option>
                    <option value="2019">2019</option>
                    <option value="2020">2021</option>
                    <option value="2020">2022</option>
                    <option value="2020">2023</option>
                    <option value="2020">2024</option>
                    <option value="2020">2025</option>
                    <option value="2020">2026</option>
                    <option value="2020">2027</option>
                    <option value="2020">2028</option>
                    <option value="2020">2029</option>
                  </select>
              </span>
            </div><!-- card-header -->
            <div class="card-body pd-0">
              <div class="row no-gutters">
               <div class="col col-md-8  bd-t bd-lg-t-0 bd-lg-l">
                  <div class="crypto">
                    <div class="media mg-b-10">
                      <div class="media-body pd-l-8">
                        <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">{{ __('Question Category') }}  <span class="tx-color-03 tx-normal">(PERIOD : <?php echo date("Y"); ?>)</span></h6>
                        <div class="d-flex align-items-baseline tx-rubik">
                           <canvas id="myChart" width="300" height="150"></canvas>
                        </div>
                      </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="chart-twelve">
                      <div id="flotChart4" class="flot-chart" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 283.75px; height: 80px;" width="567" height="160"></canvas></div>
                    </div><!-- chart-twelve -->

                    <div class="pos-absolute b-5 l-20 tx-medium">

                    </div>
                  </div><!-- crypto -->
                </div>
                <div class="col col-md-4  bd-t bd-lg-t-0 bd-sm-l">
                  <div class="crypto">
                    <div class="media mg-b-10">
                      <div class="media-body pd-l-8">
                        <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">{{ __('Monthly Breakdown') }} <span class="tx-color-03 tx-normal"></span></h6>

                        <div class="d-flex align-items-baseline tx-rubik">

                        </div>
                      </div><!-- media-body -->
                    </div><!-- media -->

                    <div class="chart-twelve">

              <div class="card">

                <div class="card-body pd-y-10">
                  <div class="d-flex align-items-baseline tx-rubik">
                    <h1 class="tx-40 lh-1 tx-normal tx-spacing--2 mg-b-5 mg-r-5">{{ $totalQuestion }}</h1>
                    <!-- <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">1.6% <i class="icon ion-md-arrow-up"></i></span></p> -->
                  </div>

                  <table class="table-dashboard-two">
                    <tbody>
                      @if(isset($questionCount))

                      @foreach($questionCount as $monthlyQuestionCount)
                            <tr>
                              <td><div class="wd-12 ht-12 rounded-circle bd bd-3 bd-primary"></div></td>
                              <td class="tx-medium">{{ $monthlyQuestionCount->month  }}</td>
                              <td class="text-right">{{ $monthlyQuestionCount->question_count  }}</td>
                              <?php
                                    $percentageCount  =   round($monthlyQuestionCount->question_count / $totalQuestion,2) * 100;
                              ?>
                              <td class="text-right">{{$percentageCount}}%</td>
                            </tr>
                      @endforeach

                      @endif

                      <!-- <tr>
                        <td><div class="wd-12 ht-12 rounded-circle bd bd-3 bd-success"></div></td>
                        <td class="tx-medium">Very Good</td>
                        <td class="text-right">1,674</td>
                        <td class="text-right">25%</td>
                      </tr> -->



                    </tbody>
                  </table>
                </div><!-- card-body -->
              </div><!-- card -->

                    </div><!-- chart-twelve -->

                    <div class="pos-absolute b-5 l-20 tx-medium">

                    </div>
                  </div>
                </div>


              </div><!-- row -->
            </div><!-- card-body -->
          </div><!-- card -->
        </div>
        </div><!-- End Stripe -->


         @if(Session::get('admin_type') == 'admin')
         <div class="row">

           <div class="col-sm-6 mg-t-10">
            <div class="card">
              <div class="card-header d-sm-flex align-items-start justify-content-between">
                <h6 class="lh-5 mg-b-0"> {{ __('RESPONSE STATS') }}</h6>
                <select class="">
                  <option>2020</option>
                </select>
                  <!-- <a href="" class="tx-13 link-03">Mar 01 - Mar 20, 2019 <i class="icon ion-ios-arrow-down"></i></a> -->
              </div><!-- card-header -->
              <div class="card-body pd-y-15 pd-x-10">
                <div class="table-responsive">
                  <table class="table table-Stripped table-sm tx-13 tx-nowrap mg-b-0">
                    <thead>

                        <th>&nbsp;</td>
                        <th>{{ __('DOCTOR') }}</th>
                        <th class="text-right">{{ __('QUES. ANSWERED') }}</th>
                        <!-- <th class="text-right">Avg ERT</th> -->
                        <th class="text-right">%</th>

                    </thead>
                    <tbody>
                      @if(isset($doctorResponseCount))

                        @foreach($doctorResponseCount as $responses)
                          <tr>
                            <td><div class="wd-10 ht-10 rounded-circle bg-pink mg-r-5"></div> </td>
                            <!-- doctor-responses/{{$responses->responder_id}} -->
                            <td class="tx-medium"><a href="/view/doctor/questions/{{ $responses->responder_id }}"> {{$responses->fullname}} </a></td>
                            <td class="text-right">{{$responses->questions_answered}}</td>
                            <!-- <td class="text-right"></td> -->
                            <td class="text-right">
                              <?php
                                    $resPercentageCount  =   round($responses->questions_answered / $totalResponse,2) * 100;
                                    echo $resPercentageCount;
                              ?>%
                            </td>
                          </tr>
                          @endforeach

                      @endif

                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card-body -->
            </div><!-- card -->
          </div>



                   <div class="col-sm-3 mg-t-10">
                     <div class="card">
                             <div class="card-header">
                               <h6 class="mg-b-0">{{ __('Questions') }} <span class="float-right"><a href="/question/list-questions">{{ __('See All') }}</a></span></h6>
                             </div><!-- card-header -->
                             <div class="card-body tx-center">
                               <h4 class="tx-normal tx-rubik tx-40 tx-spacing--1 mg-b-0">{{$totalQuestion}}</h4>
                               <p class="tx-12 tx-color-03 mg-b-0">{{ __('Total Questions') }}</p>
                             </div><!-- card-body -->
                             <!-- <div class="card-footer bd-t-0 pd-t-0">
                               <button class="btn btn-sm btn-block btn-outline-primary btn-uppercase tx-spacing-1">View</button>
                             </div> -->
                           </div>
                  </div>



         <div class="col-sm-3 mg-t-10">
           <div class="card">
                   <div class="card-header">
                     <h6 class="mg-b-0">{{ __('SUPPORT ISSUES') }}</h6>
                   </div><!-- card-header -->
                   <div class="card-body tx-center">
                     <h4 class="tx-normal tx-rubik tx-40 tx-spacing--1 mg-b-0">0</h4>
                     <p class="tx-12 tx-color-03 mg-b-0">{{ __('Untracked  Support Issues') }}</p>
                   </div><!-- card-body -->
                   <!-- <div class="card-footer bd-t-0 pd-t-0">
                     <button class="btn btn-sm btn-block btn-outline-primary btn-uppercase tx-spacing-1">View</button>
                   </div>-->
                 </div>
        </div>

         </div>
          @endif


          </div>


@endsection


  @push('scripts')
  <script>
  let url = `/user-count`;

   fetch(url).then((resp) => resp.json()).then(function(data) {

      let globalCount = data.countUserByRole;
      let patientCount = document.getElementById('patient-counts').innerHTML = data.userCountByRole.patients;
      document.getElementById('admin-count').innerHTML = data.userCountByRole.admins;
      document.getElementById('doctor-count').innerHTML = data.userCountByRole.doctors;

      document.getElementById('d-females').innerHTML = data.countDoctorsByGender.females
      document.getElementById('d-males').innerHTML = data.countDoctorsByGender.males

      document.getElementById('p-males').innerHTML = data.countPatientsByGender.males
      document.getElementById('p-females').innerHTML = data.countPatientsByGender.females

      document.getElementById('ad-males').innerHTML = data.adminsCountArr.males
      document.getElementById('ad-females').innerHTML = data.adminsCountArr.females
   });

  </script>
  @endpush
