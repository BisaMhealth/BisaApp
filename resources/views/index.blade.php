
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
    <meta name="twitter:description" content="Bisa - __(With us you have a doctor)">
    <meta name="twitter:image" content="">

    <?php
       $favicon = (App::isLocale('en')) ? '../../assets/img/favicon.png':'../../assets/img/logo.png';
       $country = (App::isLocale('en')) ? 'Ghana':'Senegal';
    ?>
    <!-- Facebook -->
    <meta property="og:url" content="">
    <meta property="og:title" content="DashForge">
    <meta property="og:description" content="Bisa {{$country}}">

    <meta property="og:image" content="">
    <meta property="og:image:secure_url" content="">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Bisa - __(With us you have a doctor)">
    <meta name="author" content="Amazing Technologies">

    <!-- Favicon -->

    <link rel="shortcut icon" type="image/x-icon" href={{$favicon}}>

    <title>Bisa - {{ __('With us you always have a doctor')  }}</title>

    <!-- vendor css -->
    <link href="{{ asset('../../lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('../../assets/css/dashforge.auth.css') }}">
    <link rel="stylesheet" href="{{ asset('../../lib/material/materialdesignicons.css') }}">
    <link href="{{ asset('../../lib/toastr.min.css') }}" rel="stylesheet">
    <link href="{{ asset('../../assets/css/nprogress.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
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
  <body>

    <header class="navbar navbar-header navbar-header-fixed">
      <a href="#" id="mainMenuOpen" class="burger-menu"><i data-feather="menu"></i></a>
      <div class="navbar-brand">
        <?php

           if (App::isLocale('en')) {
               $logo = '../../assets/img/logo-gh.png';
               $facebook ='https://web.facebook.com/Bisaapp';
               $twitter  = 'https://twitter.com/Bisaapp';
           }elseif(App::isLocale('fr')){
              $logo = '../../assets/img/logo2.png';
              $facebook ='https://web.facebook.com/Bisaapp';
              $twitter  = 'https://twitter.com/Bisaapp';
           }

         ?>
      <img class="site-logo"  src="{{ asset($logo) }}"/>

      <!-- <a href="/" class="df-logo">B <span> isa</span> </a> -->
      </div><!-- navbar-brand -->
      <div id="navbarMenu" class="navbar-menu-wrapper">
        <div class="navbar-menu-header">
          <a href="/" class="df-logo"> <img class="site-logo"  src="{{ asset($logo) }}" />
          <!-- B<span>isa</span> </a> -->
          <a id="mainMenuClose" href=""><i data-feather="x"></i></a>
        </div><!-- navbar-menu-header -->



      </div>
      <div class="navbar-right">
        <a href="{{$facebook}}" target="_blank" class="btn btn-social5"><i class="fab fa-facebook"></i></a>

        <a href="{{$twitter}}" target="_blank" class="btn btn-social5"><i class="fab fa-twitter"></i></a>
      <!--   <a href="#" class="btn btn-buy"><i data-feather="shopping-bag"></i> <span>
          <span class="mdi mdi-electron-framework"></span></span></a> -->

            <div class="dropdown">
                <a href="" class="btn btn-sm btn-site-primary" data-toggle="dropdown">
                  <!-- <img width="30px;" src="{{ asset('../../assets/img/l2.png') }}" alt="" /> -->
                  Lang
                </a>

                <div class="dropdown-menu tx-13 cs-nav">
                  <ul class="nav nav-pills flex-column ">
                    <li class="nav-items">
                      <a  class="nav-link cs-link" href="/setlanguage/en">ENG</a>
                    </li>
                    <li class="nav-items">
                      <a  class="nav-link cs-link" href="/setlanguage/fr">FR</a>
                    </li>

                  </ul>
                </div>
              </div>

                 @if(Session::has('success'))

         <div class="alert nt-status alert-success d-flex align-items-center alert-me nt-status" role="alert">

                       <i data-feather="check" class="mg-r-10"></i> {{ __(Session::get('success') ) }}
                       &nbsp; <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
              </div>

      @endif

      @if(Session::has('message_error'))
                  <div class="alert alert-danger nt-status d-flex align-items-center alert-me" role="alert">
                       <i data-feather="alert-circle" class="mg-r-10"></i> {{ __(Session::get('message_error')) }}
                      &nbsp; <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
      @endif

      </div>

    </header>

    <!-- navbar-right -->
<!-- navbar -->
    <div class="content content-fixed content-auth">

        <!-- Container goes here -->
          @yield('content')

        <!-- Container Ends Here -->
    </div><!-- content -->

    <footer class="footer">
      <div>
        <span>&copy; <?php echo date('Y'); ?> Bisa v1.2.0 </span>
        <span>{{ __('Created by') }} <a href="#">Amazing Technologies</a></span>
      </div>
      <div>
        <nav class="nav">

          <a href="#" class="nav-link">{{ __('GET HELP') }}</a>
        </nav>
      </div>
    </footer>

    <script src="{{ asset('../../lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('../../lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('../../lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../../lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('../../assets/js/dashforge.js') }}"></script>

    <!-- append theme customizer -->
    <script src="{{ asset('../../lib/js-cookie/js.cookie.js') }}"></script>
     <script src="{{ asset('../../lib/axios.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('../../assets/js/dashforge.settings.js') }}"></script>
     <script src="{{ asset('../../lib/toastr.min.js') }}"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
        <script>
        $( function() {
          $( ".datepicker-single" ).datepicker(
              {
                showOtherMonths: true,
                selectOtherMonths: true,
                changeMonth: true,
                changeYear: true
              }
            );


                    $('.verify-user-code').on('click',function(){

                    let msisdn = $('#user-phone').val();
                    let verificationCode = $('#verification-code').val();
                    let _token  = $('#user-token').val();

                     if(verificationCode == '' ){
                        toastr.error('Please enter your verification code');
                        return false;
                    }

                    //loadProgressBar();
                    axios.post('/account/verify', {
                        phone: msisdn,
                        code: verificationCode,
                        token: _token
                    })
                    .then(function (response) {
                         switch(response.data.status){
                            case 409:
                                toastr.info('Account is already verified');
                            break;

                            case 201:
                                //toastr.success('Code Verified successfully');
                                $.confirm({
                                        title: 'Success',
                                        content: 'Code Verified successfully. Click Ok to login to your account',
                                        buttons: {
                                            confirm: function () {
                                                window.location.href = '/';
                                            },
                                            cancel: function () {
                                                $.alert('Canceled!');
                                            }
                                        }
                                    });


                            break;

                            case 309:
                                toastr.error('Invalid Verification Code');
                            break;

                            case 404:
                                toastr.error('Account does not exist');
                            break;

                            default:
                                toastr.error('Account does not exist');
                         }


                    })
                    .catch(function (error) {

                    });



    });


        } );
  </script>
    <script>
      $(function(){
        'use script'

        window.darkMode = function(){
          $('.btn-white').addClass('btn-dark').removeClass('btn-white');
        }

        window.lightMode = function() {
          $('.btn-dark').addClass('btn-white').removeClass('btn-dark');
        }

        var hasMode = Cookies.get('df-mode');
        if(hasMode === 'dark') {
          darkMode();
        } else {
          lightMode();
        }
      })
    </script>
  </body>
</html>
