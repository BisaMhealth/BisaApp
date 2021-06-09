
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@Bisa">
    <meta name="twitter:creator" content="@Bisa">
    <meta name="twitter:card" content="Bisa">
    <meta name="twitter:title" content="Bisa">
    <meta name="twitter:description" content="Bisa - With us you always have a doctor">
    <meta name="twitter:image" content="">

    <!-- Facebook -->
    <meta property="og:url" content="">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Bisa Ghana">

    <meta property="og:image" content="">
    <meta property="og:image:secure_url" content="">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Bisa - With us you always have a doctor">
    <meta name="author" content="Amazing Technologies">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>Bisa - With us you always have a doctor</title>

    <!-- vendor css -->
    <link href="{{ asset('../../lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../../lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('../../lib/material/css/materialdesignicons.css') }}">


  </head>
  <body class="page-profile">

    

    <header class="navbar navbar-header navbar-header-fixed">
      <a href="" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
      <div class="navbar-brand">
        <a href="../../index.html" class="df-logo"> <img src="{{ asset('../../assets/img/logo-inverse.png') }}" />  
      </a>
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="../../index.html" class="df-logo">B<span>isa</span></a>
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->
        <ul class="nav navbar-menu">
          <li class="nav-label pd-l-20 pd-lg-l-25 d-lg-none">Main Navigation</li>
          <li class="nav-item with-sub active">
            <a href="" class="nav-link"><i data-feather="pie-chart"></i> Home</a>
         
          </li>
          <li class="nav-item with-sub">
            <a href="" class="nav-link"><i data-feather="package"></i> Hospitals</a>
            <ul class="navbar-menu-sub">
              <li class="nav-sub-item"><a href="app-calendar.html" class="nav-sub-link"><i data-feather="list"></i>View All Hospitals </a></li>

              <li class="nav-sub-item"><a href="app-chat.html" class="nav-sub-link"><i data-feather="plus"></i>Add New Hospital</a> </li>

              <li class="nav-sub-item"><a href="app-contacts.html" class="nav-sub-link">
                <i data-feather="calendar"></i>Appointments</a></li>
            </ul>
          </li>

          <li class="nav-item with-sub">
            <a href="" class="nav-link"><i data-feather="layers"></i> Pharmacies</a>
            <div class="navbar-menu-sub">
              <div class="d-lg-flex">
                <ul>
                 
                  <li class="nav-sub-item"><a href="page-signin.html" class="nav-sub-link">
                    <i data-feather="list"></i> View All Pharmacies</a></li>
                  <li class="nav-sub-item"><a href="page-signup.html" class="nav-sub-link"><i data-feather="plus"></i> Add New Pharmacy</a></li>
                 
                
                </ul>
             
              </div>
            </div><!-- nav-sub -->
          </li>
         
          <li class="nav-item"><a href="../../collections/" class="nav-link"><i data-feather="users"></i> Accounts</a></li>

           <li class="nav-item"><a href="../../collections/" class="nav-link"><i data-feather="users"></i> Reports</a></li>
        </ul>
      </div><!-- navbar-menu-wrapper -->
      <div class="navbar-right">
        <!-- <a id="navbarSearch" href="" class="search-link"><i data-feather="search"></i></a> -->
        <div class="dropdown dropdown-message">
          <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
            <i data-feather="message-square"></i>
            <span>0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header">New Messages</div>
 
            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <strong>Sample Message</strong>
                  <p>duis aute irure dolor in repre...</p>
                  <span>Mar 12 10:40pm</span>
                </div><!-- media-body -->
              </div><!-- media -->
            </a>


            <div class="dropdown-footer"><a href="">View all Messages</a></div>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->

        
        <div class="dropdown dropdown-notification">
          <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
            <i data-feather="bell"></i>
            <span>0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header">Notifications</div>

            <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <p><strong>Sam</strong> added an answer</p>
                  <span>Mar 12 10:40pm</span>
                </div><!-- media-body -->
              </div><!-- media -->
            </a>




            <div class="dropdown-footer"><a href="">View all Notifications</a></div>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
        <div class="dropdown dropdown-profile">
          <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
            <div class="avatar avatar-sm"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
          </a><!-- dropdown-link -->
          <div class="dropdown-menu dropdown-menu-right tx-13">
            <div class="avatar avatar-lg mg-b-15"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
            <h6 class="tx-semibold mg-b-5">Katherine Pechon</h6>
            <p class="mg-b-25 tx-12 tx-color-03">Administrator</p>

            <a href="" class="dropdown-item"><i data-feather="edit-3"></i> Edit Profile</a>
            
            <div class="dropdown-divider"></div>
            
            <a href="" class="dropdown-item"><i data-feather="settings"></i>Account Settings</a>
            <a href="" class="dropdown-item"><i data-feather="settings"></i>Privacy Policy</a>
            <a href="page-signin.html" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->
      </div><!-- navbar-right -->
      <div class="navbar-search">
        <div class="navbar-search-header">
          <input type="search" class="form-control" placeholder="Type and hit enter to search...">
          <button class="btn"><i data-feather="search"></i></button>
          <a id="navbarSearchClose" href="" class="link-03 mg-l-5 mg-lg-l-10"><i data-feather="x"></i></a>
        </div><!-- navbar-search-header -->
        <div class="navbar-search-body">
       

          <hr class="mg-y-30 bd-0">

          <label class="tx-10 tx-medium tx-uppercase tx-spacing-1 tx-color-03 mg-b-10 d-flex align-items-center">Search Suggestions</label>

          <ul class="list-unstyled">
            <li><a href="dashboard-one.html">cryptocurrency</a></li>
            <li><a href="app-calendar.html">button groups</a></li>
            <li><a href="../../collections/modal.html">form elements</a></li>
            <li><a href="../../components/el-avatar.html">contact app</a></li>
          </ul>

        </div><!-- navbar-search-body -->
      </div><!-- navbar-search -->
    </header><!-- navbar -->





    <div class="content content-fixed">
      <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
        
        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Site Analytics</li>
              </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Welcome back Richard</h4>
          </div>
          <div class="d-none d-md-block">
          
          </div>

        </div>

        <div class="row row-xs">
          
          <div class="col-sm-6 col-lg-3">
            <div class="card card-body">
              <h6 class="tx-uppercase tx-11 tx-spacing-1 tx-color-02 tx-semibold mg-b-8">Today's Registrations</h6>
              <div class="d-flex d-lg-block d-xl-flex align-items-end">
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">94</h3>
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
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">3,137</h3>
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
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">30</h3>
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
                <h3 class="tx-normal tx-rubik mg-b-0 mg-r-5 lh-1">180</h3>
                <p class="tx-11 tx-color-03 mg-b-0"><span class="tx-medium tx-success">2.1% <i class="icon ion-md-arrow-up"></i></span> than last week</p>
              </div>
              <div class="chart-three">
                  <div id="flotChart6" class="flot-chart ht-30"></div>
                </div><!-- chart-three -->
            </div>
          </div><!-- col -->
          
          <div class="col-lg-9 col-xl-8 mg-t-10">
           
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
                      <h3 class="tx-normal tx-rubik tx-spacing--2 mg-b-5">200</h3>
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
        

          <div class="col-lg-3 col-xl-4 mg-t-10">
            
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
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">43</h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-semibold mg-b-10 tx-primary">Males</p>
                    <div class="tx-12 tx-color-03"></div>
                  </div><!-- col -->
                  
                  <div class="col-sm mg-t-20 mg-sm-t-0">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-5">454</h4>
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
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">Gross Earnings</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">$1,958,104</h4>
                    </div>
                  </div>
                  <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Tax Withheld</h6>
                      <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">$234,769<small>.50</small></h4>
                    </div>
                  </div>
                  <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                    <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                      <i data-feather="bar-chart-2"></i>
                    </div>
                    <div class="media-body">
                      <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Net Earnings</h6>
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
                      <td class="tx-medium text-right">1,050</td>
                      <td class="text-right tx-teal">+ $32,580.00</td>
                    
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                    
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
               
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                   
                    </tr>
                    <tr>
                      <td class="tx-color-03 tx-normal">03/04/2018</td>
                      <td class="tx-medium text-right">980</td>
                      <td class="text-right tx-teal">+ $30,065.10</td>
                    
                    </tr>
                  </tbody>
                </table>
              </div><!-- table-responsive -->
            </div><!-- card -->

            <div class="card card-body ht-lg-100">
              <div class="media">
                <span class="tx-color-04"><i data-feather="download" class="wd-60 ht-60"></i></span>
             <!--    <div class="media-body mg-l-20">
                  <h6 class="mg-b-10">Download your earnings in CSV format.</h6>
                  <p class="tx-color-03 mg-b-0">Open it in a spreadsheet and perform your own calculations, graphing etc. The CSV file contains additional details, such as the buyer location. </p>
                </div> -->
              </div> 
            </div>
          </div><!-- col -->
      



          <div class="col-md-6 col-xl-4 mg-t-10">
            <div class="card ht-lg-100p">
              <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Top 5 Doctors</h6>
                <ul class="list-inline d-flex mg-b-0">
                  <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-df-2 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Today</span>
                  </li>
                  <li class="list-inline-item d-flex align-items-center mg-l-10">
                    <span class="d-block wd-10 ht-10 bg-df-3 rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Yesterday</span>
                  </li>
                </ul>
              </div><!-- card-header -->
              <div class="card-body pd-b-0">
                <div class="row mg-b-20">
            
                  <div class="col">
                    <h4 class="tx-normal tx-rubik tx-spacing--1 mg-b-10">$21,880 </h4>
                    <p class="tx-11 tx-uppercase tx-spacing-1 tx-medium tx-color-03">Total </p>
                  </div>

                </div><!-- row -->
                <div class="chart-five">
                  <div><canvas id="chartBar1"></canvas></div>
                </div>
              </div><!-- card-body -->
            </div>
          </div>
        </div><!-- row -->
      </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; <?php echo date('Y'); ?> Bisa v1.2.0 </span>
        <span>{{ __('Created by') }} <a href="#">Amazing Technologies</a></span>
      </div>
      <div>
        <nav class="nav">
      
          <a href="#" class="nav-link">Get Help</a>
        </nav>
      </div>
    </footer>

    <script src="{{ asset('../../lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('../../lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('../../lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../../lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('../../lib/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('../../lib/jquery.flot/jquery.flot.stack.js') }}"></script>
    <script src="{{ asset('../../lib/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('../../lib/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('../../lib/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('../../lib/jqvmap/maps/jquery.vmap.usa.js') }}"></script>

    <script src="{{ asset('../../assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashforge.sampledata.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashboard-one.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('../../lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashforge.settings.js') }}"></script>
    <script src="{{ asset('../../assets/js/patient/patient.js') }}"></script>


  </body>
</html>
