@extends('layouts.apptheme_innerpage')

@section('pageinfo')

          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Site Analytics</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Welcome back :: {{ Session::get('full_name') }}</h4>
          </div>
        </div>
@endsection



@section('content')        

           <div class="col-sm-6 col-lg-3">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Today's Registrations</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">36</h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">1.2% <i class="icon ion-md-arrow-up"></i></span> than last week
                </p>
              </div>
              <div class="chart-three">
                  <div id="flotChart3" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
           
          <div class="col-sm-6 col-lg-3 mg-t-10 mg-sm-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Number of Users</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,867</h3>
                <!-- <p class="tx-11 tx-color-03 mg-b-0">
                  <span class="tx-medium tx-danger">0.7% <i class="icon ion-md-arrow-down"></i></span> than last week
                </p> -->
              </div>
              <div class="chart-three">
                  <div id="flotChart4" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->

               <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Number of Doctors</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">102</h3>
                <!-- <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-danger">0.3% <i class="icon ion-md-arrow-down"></i></span> than last week</p> -->
              </div>
              <div class="chart-three">
                  <div id="flotChart5" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->


              <div class="col-sm-6 col-lg-3 mg-t-10 mg-lg-t-0">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Today's Questions</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">28</h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2.1% <i class="icon ion-md-arrow-up"></i></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart6" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->



            <div class="col-lg-8 col-xl-7 mg-t-10">
                      <div class="card">
              <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Monthly Sign Up Rate</h6>
                <ul class="list-inline d-flex mg-t-20 mg-sm-t-10 mg-md-t-0 mg-b-0">
                </ul>
              </div><!-- card-header -->
              

              <div class="card-body pos-relative pd-0">
                <div class="pos-absolute t-20 l-20 wd-xl-100p z-index-10">
                  <div class="row">
              
                    <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                      <h3 class="tx-normal tx-rubik tx-spacing--2 mg-b-5">63</h3>
                      <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-10">Avg. /Users</h6>
                      <p class="mg-b-0 tx-12 tx-color-03"> Average monthly signups</p>
                    </div>
                  
                  </div><!-- row -->
                
                </div>

                <div class="chart-one">
                  
                  <div id="flotChart" class="flot-chart"></div>
                
                </div><!-- chart-one -->
              </div><!-- card-body -->
            

            </div><!-- card -->



            </div>
            

            <div class="col-lg-4 col-xl-5 mg-t-10">
                     <div class="card">
              <div class="card-header pd-t-20 pd-b-0 bd-b-0">
                <h6 class="mg-b-5">Gender Stats</h6>
                <p class="tx-12 tx-color-03 mg-b-0">Users Grouped By Gender</p>
              </div><!-- card-header -->
              <div class="card-body pd-20">
                
                <div class="chart-two mg-b-20">
                  <div id="flotChart2" class="flot-chart"></div>
                </div><!-- chart-two -->
                
                <div class="row">
                  <div class="col-sm">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">2398</h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-primary">Males</p>
                    <div class="tx-12 tx-color-03"></div>
                  </div><!-- col -->
                  
                  <div class="col-sm mg-t-20 mg-sm-t-0">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">1469</h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-pink">Females</p>
                    <div class="tx-12 tx-color-03"></div>
                  </div><!-- col -->
                </div><!-- row -->
              </div><!-- card-body -->
           
          
            </div><!-- card -->
            </div>


            <div class="col-md-6 col-xl-4 mg-t-10 order-md-1 order-xl-0">
              <div class="card ht-lg-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Users Grouped By Location</h6>
                <div class="tx-13 d-flex align-items-center">
                  <span class="mg-r-5">Country:</span> 
                  <select>
                    <option value="Ghana">Ghana</option>
                    <option value="Senegal">Senegal</option>
                  </select><!-- <i class="icon ion-ios-arrow-down mg-l-5"></i> -->
                  <a href="" class="d-flex align-items-center link-03 lh-0"> 
                  </a>
                </div>
              </div><!-- card-header -->
              <div class="card-body pd-0">
                <div class="pd-y-25 pd-x-20">
                  <div id="vmap" class="ht-200"></div>
                </div>
                <div class="table-responsive">
                  <table class="table table-borderless table-dashboard table-dashboard-one">
                    <thead>
                      <tr>
                        <th class="wd-40">Location</th>
                        <th class="wd-25 text-right">Users</th>
                        <!-- <th class="wd-35 text-right">Question</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="tx-medium">California</td>
                        <td class="text-right">12,201</td>
                       <!--  <td class="text-right">$150,200.80</td> -->
                      </tr>
                      <tr>
                        <td class="tx-medium">Texas</td>
                        <td class="text-right">11,950</td>
                       <!--  <td class="text-right">$138,910.20</td> -->
                      </tr>
                      <tr>
                        <td class="tx-medium">Wyoming</td>
                        <td class="text-right">11,198</td>
                        <!-- <td class="text-right">$132,050.00</td> -->
                      </tr>
                      <tr>
                        <td class="tx-medium">Florida</td>
                        <td class="text-right">9,885</td>
                        <!-- <td class="text-right">$127,762.10</td> -->
                      </tr>
                      <tr>
                        <td class="tx-medium">New York</td>
                        <td class="text-right">8,560</td>
                        <!-- <td class="text-right">$117,087.50</td> -->
                      </tr>
                    </tbody>
                  </table>
                </div><!-- table-responsive -->
              </div><!-- card-body -->
            </div><!-- card -->
            </div><!-- col -->
            <div class="col-lg-12 col-xl-8 mg-t-10">
                     <div class="card mg-b-10">
              <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                  <h6 class="mg-b-5">Appointment Statistics</h6>
                  <p class="tx-13 tx-color-03 mg-b-0"></p>
                </div>
                <div class="d-flex mg-t-20 mg-sm-t-0">
                
                </div>
              </div><!-- card-header -->
              <div class="card-body pd-y-30">
                <div class="d-sm-flex">
                  <div class="media">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Lorem ipsum, or lipsum </h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">34</h4>
                    </div>
                  </div>
                  <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Lorem ipsum, or lipsum </h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">9</h4>
                    </div>
                  </div>
                  <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Lorem ipsum, or lipsum </h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">$1,608,469<small>.50</small></h4>
                    </div>
                  </div>
                </div>
              </div><!-- card-body -->
              <div class="table-responsive">
                <table class="table table-dashboard mg-b-0">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th class="text-right">Hospital</th>
                      <th class="text-right">Number of Appointments</th>
                       
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/05/2018</td>
                      <td class="tx-medium text-right">Lorem ipsum, or lipsum </td>
                      <td class="text-right tx-teal">23</td>
                    
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">Lorem ipsum, or lipsum </td>
                      <td class="text-right tx-teal">12</td>
                    
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">Lorem ipsum, or lipsum </td>
                      <td class="text-right tx-teal">45</td>
               
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">Lorem ipsum, or lipsum </td>
                      <td class="text-right tx-teal">22</td>
                   
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">Lorem ipsum, or lipsum </td>
                      <td class="text-right tx-teal">5</td>
                    
                    </tr>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card -->



              <div class="card card-body ht-lg-100">
                <div class="media">
                  <span class="tx-color-04"><i data-feather="download" class="wd-60 ht-60"></i></span>
                  <div class="media-body mg-l-20">
                    <h6 class="mg-b-10">Download your earnings in CSV format.</h6>
                    <p class="tx-color-03 mg-b-0">Open it in a spreadsheet and perform your own calculations, graphing etc.</p>
                  </div>
                </div><!-- media -->
              </div>
            </div><!-- col -->

@endsection




 




          </div><!-- row -->

