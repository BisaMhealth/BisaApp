@extends('index')
    <!-- navbar-right -->
<!-- navbar -->

@section('content')
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
          <div class="media-body align-items-center d-none d-lg-flex ">
            <div class="mx-wd-600">
              <img src="../../assets/img/bisacvd.png" class="img-fluid" alt="">
            </div>

          </div><!-- media-body -->
          <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">


            <form method="POST" action="{{ route('loginuser') }}">
              @if(Session::has('message'))
                  <div class="alert alert-danger d-flex align-items-center alert-me" role="alert">
                       <i data-feather="alert-circle" class="mg-r-10"></i> {{ __(Session::get('message')) }}
                  </div>
              @endif

            <div class="wd-100p">
              <h3 class="tx-color-01 mg-b-5 site-primary">{{ __('Sign In') }}</h3>
              <!-- <p class="tx-color-03 tx-16 mg-b-40 ">{{ __('Welcome back! Please signin to continue') }}.</p> -->

                 @csrf
                  <div class="form-group">
                    <label>{{ __('Email address') }}</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('youremail@mail.com') }}" required autocomplete="email" name="email" value="{{ old('email') }}" autofocus />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>
                  <div class="form-group">
                    <div class="d-flex justify-content-between mg-b-5">
                      <label class="mg-b-0-f">{{ __('Password') }}</label>
                      <a href="/forgotten-password" class="tx-13 site-primary">{{ __('Forgotten Password ?') }}</a>
                    </div>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Enter your Password') }}" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                  </div>


              <button class="btn btn-brand-02 btn-block bg-site-primary border-site-primary">{{ __('Login') }}</button>

              <div class="divider-text">{{ __('or') }}</div>

              <div class="tx-13 mg-t-20 tx-center">{{ __("Don't have an account?") }}
                <a class="site-primary" href="{{ route('signup') }}">{{ __('Create an Account') }}</a>
              </div>

              <!-- <a href="/anonymous-signup" class="btn btn btn-outline-success btn-block border-site-primary mt-4">{{ __('Anonymous Signup') }}</a> -->

            </div>
          </form>

          </div><!-- sign-wrapper -->
        </div><!-- media -->
      </div><!-- container -->

@endsection
