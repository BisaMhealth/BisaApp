@extends('index')
    <!-- navbar-right -->
<!-- navbar -->

@section('content')
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p">
              <h4 class="tx-color-01 mg-b-5 site-primary">{{ __('Create a new account')  }}</h4>
              <p class="tx-color-03 tx-16 mg-b-40 ">
              {{ __('Registration is free and only takes a minute')  }} .</p>
                <div class="col-sm-12">
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
              <form action="{{ route('onboardanonymously') }}" method="POST">
              @csrf
              <div class="form-group">
                <label>{{ __('Username') }}</label>
                <input type="text" value="{{ old('username') }}" required="" name="username" class="form-control input-outline" placeholder="{{ __('Username') }}">
              </div>


               <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">{{ __('Password') }}</label>
                </div>
                <input required="" value="{{ old('password') }}" name="password" type="password" class="form-control input-outline" placeholder="{{ __('Password') }}">
              </div>

               <div class="form-group">
                <div class="d-flex justify-content-between mg-b-5">
                  <label class="mg-b-0-f">{{ __('Confirm Password') }}</label>
                </div>
                <input required="" value="{{ old('password_confirmation') }}" name="password_confirmation" type="password" class="form-control input-outline" placeholder="{{ __('Confirm Password') }}">
              </div>

              <div class="form-group tx-12">
                {{  __('Clicking on') }} <strong> {{  __('Create an account') }} </strong> {{ __('below, you accept our terms of use and our privacy statement') }} .

              </div><!-- form-group -->

              <button type="submit" class="btn btn-brand-02  bg-site-primary border-site-primary btn-block">{{ __('Create an account') }}</button>
              <!-- <div class="divider-text">or</div>
              <button class="btn btn-outline-facebook btn-block">Sign Up With Facebook</button>
              <button class="btn btn-outline-twitter btn-block">Sign Up With Twitter</button> -->

              <div class="tx-13 mg-t-20 tx-center">{{ __('Already have an account') }} ? 
              <a class="site-primary" href="/"> {{ __('Sign In') }}</a></div>

            </form>

            </div>
          </div><!-- sign-wrapper -->

          <div class="mt-4 media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
            <div class="mx-lg-wd-500 mx-xl-wd-550">
              <img src="../../assets/img/bisacvd.png" class="img-fluid" alt="">
            </div>
            <div class="pos-absolute b-0 r-0 tx-12">
            <!--   Social media marketing vector is created by <a href="https://www.freepik.com/pikisuperstar" target="_blank">pikisuperstar (freepik.com)</a> -->
            </div>
          </div><!-- media-body -->
        </div><!-- media -->
      </div><!-- container -->

@endsection



@push('script')

   <script type="text/javascript">

  function checkPassword(str)
  {
    var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/;
    return re.test(str);
  }

  function checkForm(form)
  {
    if(form.username.value == "") {
      alert("Error: Username cannot be blank!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Error: Username must contain only letters, numbers and underscores!");
      form.username.focus();
      return false;
    }
    if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
      if(!checkPassword(form.pwd1.value)) {
        alert("The password you have entered is not valid!");
        form.pwd1.focus();
        return false;
      }
    } else {
      alert("Error: Please check that you've entered and confirmed your password!");
      form.pwd1.focus();
      return false;
    }
    return true;
  }

</script>


@endpush
