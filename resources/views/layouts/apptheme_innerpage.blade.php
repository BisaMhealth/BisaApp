
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
  <?php
       $favicon = (App::isLocale('en')) ? '../../assets/img/favicon.png':'../../assets/img/logo.png';
       $country = (App::isLocale('en')) ? 'Ghana':'Senegal';
       $analyticsUrl  = 'https://www.googletagmanager.com/gtag/js?id=UA-163882580-1';

       $analyticsConfigId='UA-163882580-1';
    ?>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@Bisa {{$country}}">
    <meta name="twitter:creator" content="@Bisa {{$country}}">
    <meta name="twitter:card" content="Bisa {{$country}}">
    <meta name="twitter:title" content="Bisa {{$country}}">
    <meta name="twitter:description" content="Bisa - __('With us you always have a doctor') ">
    <meta name="twitter:image" content="">

    <!-- Facebook -->
    <meta property="og:url" content="Bisa {{$country}}">
    <meta property="og:title" content="Bisa {{$country}}">
    <meta property="og:description" content="Bisa {{$country}}">

    <meta property="og:image" content="Bisa {{$country}}">
    <meta property="og:image:secure_url" content="">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <meta property="csfr-token" content="{{ csrf_token() }}">

    <!-- Meta -->
    <meta name="description" content="Bisa - __('With us you always have a doctor')">
    <meta name="author" content="Amazing Technologies">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{$favicon}}">

    <title>Bisa - @yield('title')</title>

    <!-- vendor css -->
    <link href="{{ asset('../../lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">


    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.chat.css') }}">
    <link href="{{ asset('../../lib/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('../../assets/css/nprogress.css') }}" rel="stylesheet">
    <link defer rel="stylesheet" href="{{ asset('../../assets/css/dashforge.mail.css') }}">



    <link defer href="{{ asset('../lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <link defer rel="stylesheet" href="{{ asset('../../assets/css/dashforge.profile.css') }}" rel="stylesheet">

    <!-- <link href="{{ asset('../../lib/bootstrap-datepicker.min.css') }}" rel="stylesheet" type="text/css" /> -->

    <!-- Global site tag (gtag.js) - Google Analytics -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-172859077-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-172859077-1');
        </script>




  </head>
  <body class="app-chat">

    <aside  class="aside aside-fixed">

     <!--  <div id="" class="aside-header side-nav">
        <a href="#" class="aside-logo"> <img class="site-logo" src="{{ asset('../../assets/img/logo-inverse.png') }}" /></a>
      </div> -->

      <div class="aside-header side-nav">
       <a href="#" class="aside-logo">

         <?php
            if (App::isLocale('en')) {
                $logo = '../../assets/img/logo-inverse.png';
            }elseif(App::isLocale('fr')){
               $logo = '../../assets/img/logo2-inverse.png';
            }
          ?>

         <img  class="site-logo" src="{{ asset($logo) }}" /></a>

        <a href="#" style="color: #fff" class="aside-menu-link">

          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>

          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" style="color:" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>

        </a>


        <a href="#" style="color: #fff" id="chatContentClose" class="burger-menu d-none"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></a>
      </div>



      <div class="aside-body side-nav">
        <div class="aside-loggedin">
          <div class="d-flex align-items-center justify-content-start">
            <a href="#" class="avatar">
              <?php $profileImage =  Session::get('user_thumbnail')   ; ?>
              @if(isset($profileImage) && $profileImage  != '' && $profileImage != 'n_a' && $profileImage != 'n/a')

              <img src="{{$profileImage}}" class="rounded-circle" alt="...">

               @else

                  <img src="https://via.placeholder.com/500" class="rounded-circle" alt="">
              @endif
            </a>
            <div class="aside-alert-link">

              <a href="{{ route('signout') }}" data-toggle="tooltip" title="Sign out"><i class="nav-label" data-feather="log-out"></i></a>

            </div>
          </div>
          <div class="aside-loggedin-user">
            <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
              <h6 class="tx-semibold mg-b-0 nav-label">{{ Session::get('full_name') }}</h6>
              <i data-feather="chevron-down"></i>
            </a>
            <p class="tx-color-03 tx-12 mg-b-0"></p>
          </div>
          <div class="collapse" id="loggedinMenu">
            <ul class="nav nav-aside mg-b-0">
              @switch(Session::get('user_role'))
                    @case('patient')
                    <li class="nav-item"><a href="/user-profile" class="nav-link"><i data-feather="user"></i>
                    <span>{{ __('Profile') }} </span></a></li>
                    @break

                    @case('doctor')
                    <li class="nav-item"><a href="/doctor-profile" class="nav-link">
                      <i data-feather="user"></i> <span>{{ __('Profile') }} </span></a></li>
                    @break

              @endswitch

             <!--  <li class="nav-item"><a href="#" class="nav-link"><i data-feather="settings"></i> <span>Account Settings</span></a></li>
           {{ __('Welcome back! Please signin to continue') }} -->
             <!--  <li class="nav-item"><a href="#" class="nav-link"><i data-feather="help-circle"></i> <span>Help Center</span></a></li> -->
              <li class="nav-item"><a href="{{ route('signout') }}" class="nav-link"><i data-feather="log-out"></i>
              <span>{{ __('Logout') }}</span></a></li>
            </ul>
          </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
          <li class="nav-label">{{ __('Dashbboard') }}</li>

          @switch(Session::get('user_role'))
                @case('patient')
                  <li class="nav-item "><a href="/patient/dashboard" class="nav-link">
                    <i class="nav-icon" data-feather="grid"></i> <span>{{ __('Home') }} </span></a>
                  </li>
                    @break

                @case('doctor')
                <li class="nav-item "><a href="/doctor/dashboard" class="nav-link">
                    <i class="nav-icon" data-feather="grid"></i> <span> {{ __('Home') }}</span></a>
                  </li>
                    @break

                    @case('admin')
                    <li class="nav-item "><a href="/admin/dashboard" class="nav-link">
                        <i class="nav-icon" data-feather="grid"></i> <span> {{ __('Home') }}</span></a>
                      </li>
                        @break

                @default
                    <span>{{ __('An error has occurred. Try Again') }}</span>
            @endswitch



      <!--
          <li class="nav-label mg-t-25">Web Apps</li>
          <li class="nav-item"><a href="app-calendar.html" class="nav-link"><i data-feather="calendar"></i> <span>Calendar</span></a></li>
          <li class="nav-item"><a href="app-chat.html" class="nav-link"><i data-feather="message-square"></i> <span>Chat</span></a></li>
          <li class="nav-item"><a href="app-contacts.html" class="nav-link"><i data-feather="users"></i> <span>Contacts</span></a></li>
          <li class="nav-item"><a href="app-file-manager.html" class="nav-link"><i data-feather="file-text"></i> <span>File Manager</span></a></li>
          <li class="nav-item"><a href="app-mail.html" class="nav-link"><i data-feather="mail"></i> <span>Mail</span></a></li> -->

          @if(Session::get('user_role') == 'patient' || Session::get('user_role') == 'patient')
          <li class="nav-label mg-t-25">{{ __('Patients') }}</li>

           <!--  <li class="nav-item with-sub">
              <a href="" class="nav-link"><i class="nav-icon" data-feather="help-circle"></i> <span>Questions</span></a>
              <ul>
                <li><a href="/patient/chathistory">Ask A Doctor</a></li>
                <li><a href="/patient/chathistory">Chart History</a></li>

              </ul>
          </li> -->

          <li class="nav-item "><a href="/patient/chathistory" class="nav-link">
             <span> <i  class="fa fa-comments"></i> {{ __('Chat History') }}</span></a></li>

             <li class="nav-item with-sub">
            <a href="" class="nav-link"><i class="nav-icon" data-feather="calendar"></i> <span>{{ __('Appointments') }}</span></a>
            <ul>
              <li><a href="/new-appointment/{{ Session::get('user_token') }}">{{ __('Book Appointment') }}</a></li>
              <li><a href="/my-appointment">{{ __('My Appointments') }}</a></li>
            </ul>
          </li>

          <li class="nav-item "><a href="/hospital-list" class="nav-link">
            <i class="nav-icon" data-feather="home"></i> <span> {{ __('Hospitals') }}</span></a></li>

            <li class="nav-item "><a href="/pharmacies-list" class="nav-link">
              <i class="nav-icon" data-feather="folder-plus"></i> <span> {{ __('Pharmacies') }}</span></a></li>

          @endif



          @if(Session::get('user_role') == 'doctor')
          <li class="nav-label mg-t-25">{{ __('Doctor') }}</li>

          <li class="nav-item "><a href="/question-queue" class="nav-link">
          <i class="fa fa-comment-medical fa-md"></i> &nbsp; &nbsp;&nbsp;&nbsp;<span>  {{ __('Unanswered Questions') }}</span></a></li>

          <li class="nav-item "><a href="/view-all-questions" class="nav-link">
          <i class="fa fa-comment fa-md"></i> &nbsp; &nbsp;&nbsp;&nbsp;<span>  {{ __('View All Questions') }}</span></a></li>

          <li class="nav-item "><a href="/user/work-flow" class="nav-link">
          <i class="fa fa-bookmark"></i> &nbsp; &nbsp;&nbsp;&nbsp;<span>  {{ __('My Workflow') }}</span></a></li>

          @endif

          <li class="nav-item "><a href="/article-dashboard" class="nav-link"><i class="nav-icon" data-feather="file-text"></i>
            <span>{{ __('Health Tips') }}</span></a></li>


            @if(Session::get('admin_type') == 'publisher' || Session::get('admin_type') == 'admin')
            <li class="nav-item "><a href="/patient/messaging" class="nav-link">
            <i class="fa fa-envelope"></i> &nbsp; &nbsp;&nbsp;&nbsp;<span>  {{ __('Messaging') }}</span></a></li>
            @endif

           @if(Session::get('admin_type') == 'admin')

          <li class="nav-label mg-t-25"> {{ __('Back Office') }}</li>

          <li class="nav-item with-sub">
            <a href="" class="nav-link"><i class="nav-icon" data-feather="user"></i> <span>{{ __('Users') }}</span></a>
            <ul>
              <li><a href="#">{{ __('Patients') }}</a></li>
              <li><a href="#">{{ __('Doctors') }}</a></li>
              <li><a href="#">{{ __('Administrators') }}</a></li>

            </ul>
          </li>

          <li class="nav-item with-sub">
            <a href="" class="nav-link"><i class="nav-icon" data-feather="bar-chart-2"></i> <span>{{ __('Reports') }}</span></a>
            <ul>
              <li><a href="#">{{ __('User subscriptions') }}</a></li>
              <li><a href="#">{{ __('Appointment') }}</a></li>
            </ul>
          </li>
          @endif





          <li class="nav-item "><a href="/faq/general" class="nav-link">
          <i class="nav-icon" data-feather="help-circle"></i> <span> {{ __('FAQ') }}</span></a></li>

<!--
          <li class="nav-label mg-t-25">User Interface</li>
          <li class="nav-item"><a href="../../components" class="nav-link"><i data-feather="layers"></i> <span>Components</span></a></li>
          <li class="nav-item"><a href="../../collections" class="nav-link"><i data-feather="box"></i> <span>Collections</span></a></li> -->


        </ul>



      </div>
    </aside>

    <div class="content ht-100v pd-0">

      <div class="content-header">

        <div class="content-search">
          <i data-feather="search"></i>
          <input type="search" class="form-control" placeholder="{{ __('Search') }}">
        </div>
        <nav class="nav">

          <!-- <a href="" class="nav-link"><i data-feather="grid"></i></a> -->

          @switch(Session::get('user_role'))
                @case('patient')

                  <!-- <a href="#" class="btn  btn-success new-indicator" data-toggle="modal" data-target="#modalNewQuestion">
                        <i class="fa fa-question-circle"></i>
                        <span id="doctors-reply"> Ask A Doctor</span>
                      </a>&nbsp;&nbsp;
 -->
                <div class="dropdown dropdown-notification">
                      <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
                        <i data-feather="bell"></i>
                        <span id="doctors-reply">{{ Session::get('user_unread_messagges') }}</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-header">{{ __('Notification')  }}</div>

                    <!--     <a href="" class="dropdown-item">
                          <div class="media">
                            <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                            <div class="media-body mg-l-15">
                              <p><strong>Sam</strong> added an answer</p>
                              <span>Mar 12 10:40pm</span>
                            </div>
                          </div>
                        </a> -->
                        <div class="dropdown-footer"><a href="/patient/chathistory">{{ __('Show all notifications')  }}</a></div>
                      </div>
                  </div>

                  <!-- <a href="/user-profile" class="nav-link">
                   <i data-feather="user"></i>
                  </a> -->

                    @break

                  @case('doctor')
                  <div class="dropdown dropdown-message">
          <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
            <i data-feather="bell"></i> <!-- Doctor Notify  -->
            <span id="notify-doctor">
             {{ Session::get('user_unreadmessages') }}
              </span>
          </a> &nbsp;
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-header ">{{__('New message')}}</div>

            <div class="message-preview">
                  <!-- <a href="" class="dropdown-item">
                    <div class="media">
                      <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                      <div class="media-body mg-l-15">
                        <strong>Sample Message</strong>
                        <p>duis aute irure dolor in repre...</p>
                        <span>Mar 12 10:40pm</span>
                      </div>
                    </div>
                  </a> -->
            </div>


            <div class="dropdown-footer"><a href="">{{ __('View all Messages') }}</a></div>
          </div><!-- dropdown-menu -->
        </div><!-- dropdown -->

          <div class="dropdown dropdown-message">
          <a href="" class="dropdown-link new-indicator" data-toggle="dropdown">
            <i data-feather="message-square"></i>
            <span id="number-of-user-questions"> {{ Session::get('number_unread_question_global') }}</span>
          </a> &nbsp;
          <div class="dropdown-menu dropdown-menu-right show-user-questions">
            <div class="dropdown-header">{{ __('Recent Questions') }}</div>

            <!-- <a href="" class="dropdown-item">
              <div class="media">
                <div class="avatar avatar-sm avatar-online"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-15">
                  <strong>Sample Message</strong>
                  <p>duis aute irure dolor in repre...</p>
                  <span>Mar 12 10:40pm</span>
                </div>
              </div>
            </a> -->
            <div class="dropdown-footer"><a href="/users/show-questions">
            {{ __('See all questions') }} </a></div>
          </div>
        </div>
                  @break



                @default

            @endswitch
                &nbsp;&nbsp;


          <a href="{{ route('signout') }}" class="nav-link"> <i data-feather="log-out"></i> </a>
        </nav>



        @if(Session::has('message'))
        <div class="alert nt-status alert-success d-flex align-items-center alert-me nt-status" role="alert">
                       <i data-feather="check" class="mg-r-10"></i> {{ Session::get('message') }}
        </div>
      @endif

      @if(Session::has('message_error'))
                  <div class="alert alert-danger nt-status d-flex align-items-center alert-me" role="alert">
                       <i data-feather="alert-circle" class="mg-r-10"></i> {{ Session::get('message_error') }}
                  </div>
      @endif

      </div><!-- content-header -->

      <div class="content-body">


        <div class="container pd-x-0">


        <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">

            @yield('pageinfo')

          <div class="d-none d-md-block">

          </div>

        </div>

          <div class="row row-xs">

            <!-- Site Content -->
              @yield('content')
            <!-- End Ghana -->



        </div><!-- container -->


      </div>
 <!--       <footer class="footer">
      <div>
        <span>© <?php echo date('Y'); ?> Bisa v1.0.0. </span>
        <span> <a href="#"></a></span>
      </div>
      <div>
        <nav class="nav">

          <a href="#" class="nav-link">Privacy Policy</a>
          <a href="#" class="nav-link">Get Help</a>
        </nav>
      </div>
    </footer> -->

    <audio id="audio" src="{{ asset('../../assets/sounds/button-09.wav') }}" autostart="false" ></audio>

    </div>



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
    <script src="{{ asset('../../lib/axios.min.js') }}"></script>


    <script src="{{ asset('../../assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashforge.aside.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashforge.sampledata.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashboard-one.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('../../lib/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('../../assets/js/dashforge.settings.js') }}"></script>

    <script src="{{ asset('../../assets/js/dashboard-two.js') }}"></script>

    <script src="{{ asset('../../assets/js/dashforge.chat.js') }}"></script>

    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script src="{{ asset('../../lib/moment/min/moment.min.js') }}"></script>

    <script src="{{ asset('../../lib/toastr.min.js') }}"></script>

    <script src="{{ asset('../../lib/index.js') }}"></script>
    <script src="{{ asset('../../lib/ionsound/ion.sound.min.js') }}"></script>
    <script src="{{ asset('../../assets/js/patient/patient.js') }}"></script>

    <script src="{{ asset('../../assets/js/admin.js') }}"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <!-- <script src="{{ asset('../../lib/bootstrap-datepicker.min.js') }}"></script> -->


  <script src="{{ asset('../../assets/js/cs-bisa.js') }}"  defer></script>
  <script src="{{ asset('../../assets/js/dashboard_charts/charts.js') }}" defer></script>

  <!-- <script src="{{ asset('../../js/app.js') }}"  defer></script> -->

    <script>

    $('.datatables-minimal').DataTable({
      language: {
        searchPlaceholder: 'Search...',
        sSearch: '',
        lengthMenu: '_MENU_ items/page',
      }
    });

</script>



    @stack('scripts')

    @yield('javascript')

  </body>
</html>
