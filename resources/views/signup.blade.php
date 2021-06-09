@extends('index')
    <!-- navbar-right -->
<!-- navbar -->

@section('content')
      <div class="container">
        <div class="media align-items-stretch justify-content-center ht-100p">
          <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
            <div class="pd-t-20 wd-100p">
              <h4 class="tx-color-01 mg-b-5 site-primary">{{ __('Create a new account')  }}</h4>
              <p class="tx-color-03 tx-16 mg-b-40 ">{{ __('Registration is free and only takes a minute')  }} .</p>
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
              <form action="{{ route('onboardpatient') }}" method="POST">
              @csrf
              <div class="form-group">
                <label>{{ __('First Name')  }} *</label>
                <input required type="text" value="{{ old('first_name') }}" name="first_name" class="form-control input-outline" placeholder="{{ __('First Name')  }}">
              </div>

              <div class="form-group">
                <label>{{ __('Last Name')  }} *</label>
                <input required type="text" value="{{ old('last_name') }}" name="last_name" class="form-control input-outline" placeholder="{{ __('Last Name')  }}">
              </div>


              <div class="row row-sm mg-b-10 ">
                <div class="form-group col-sm-6">
                  <label>{{ __('Email Address')  }} *</label>
                  <input required type="email" name="email" value="{{ old('email') }}" class="form-control input-outline" placeholder="{{ __('Email Address')  }}">
                </div>


                 <div class="form-group col-sm-6">
                  <label>{{ __('Phone')  }} *</label>
                  <input required type="text" value="{{ old('phone') }}" name="phone" class="form-control input-outline" placeholder="{{ __('Phone')  }}">

                </div>

                   <div class="form-group col-sm-6">
                      <label>{{ __('Gender')  }}</label>
                      <select name="gender" class="form-control">
                        <option value="Mâle">{{ __('Male')  }}</option>
                        <option value="Femelle">{{ __('Female')  }}</option>
                      </select>
                    </div>



                     <div class="form-group col-sm-6">
                      <label>{{ __('Country')  }} *</label>
                      <select name="country" class="form-control ">

                        <?php $defaultContry= (App::isLocale('en'))? 'Ghana':'Senegal'; ?>
                        <option value="{{$defaultContry}}">{{$defaultContry}}</option>

                        @if(isset($countries))
                          @foreach($countries as $countryData)
                              <option value="{{ $countryData->country}}">{{ $countryData->country}}</option>
                          @endforeach
                        @endif
                      </select>
                    </div>

                    <div class="col-sm-6">
                       <label>{{ __('Date of Birth') }} *</label>
                        <input  required name="date_of_birth" value="{{ old('date_of_birth') }}"  type="date" id="" class="form-control input-outline  bs-datepicker"  placeholder="{{ __('Date of Birth') }}">
                     </div>

                    <div class="form-group col-sm-6">
                       <label>{{ __('Blood Group')  }}</label>
                       <select name="blood_group" class="form-control">
                         <option value="A+">A+</option>
                         <option value="A-">A-</option>
                         <option value="B+">B+</option>
                         <option value="O+">O+</option>
                         <option value="O-">O-</option>
                         <option value="AB+">AB+</option>
                         <option value="AB-">AB-</option>

                       </select>
                     </div>

                     <div class="form-group col-sm-12">
                        <label>{{ __('Location')  }} *</label>
                        <input required type="text" value="{{ old('location') }}" name="location" class="form-control input-outline" placeholder="{{ __('Location')  }}">
                     </div>

                      <div class="form-group col-sm-12">
                        <label>{{ __('Any Chronic  / Known Condition ?')  }} </label>
                        <input type="text" name="known_condition" value="{{ old('known_condition') }}" class="form-control input-outline" placeholder="{{ __('Any Chronic  / Known Condition ?')  }}">
                      </div>

                    <input type="hidden" value="0"  name="follow_up">





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
              {{  __('Clicking on') }} <strong> {{  __('Create an account') }} </strong> {{ __('below, you accept our terms of use and our privacy statement') }}

              </div><!-- form-group -->

              <button type="submit" class="btn btn-brand-02  bg-site-primary border-site-primary btn-block">{{  __('Create an account') }}</button>
              <!-- <div class="divider-text">or</div>
              <button class="btn btn-outline-facebook btn-block">Sign Up With Facebook</button>
              <button class="btn btn-outline-twitter btn-block">Sign Up With Twitter</button> -->

              <div class="tx-13 mg-t-20 tx-center">{{ __('Already have an account') }} ? <a class="site-primary" href="/">{{ __('Sign In') }}</a></div>

            </form>

            </div>
          </div><!-- sign-wrapper -->

          <div style="margin-top: -150px;" class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
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
      alert("Error: Le nom d'utilisateur ne peut pas être vide!");
      form.username.focus();
      return false;
    }
    re = /^\w+$/;
    if(!re.test(form.username.value)) {
      alert("Error: Le nom d'utilisateur ne doit contenir que des lettres, des chiffres et des traits de soulignement!");
      form.username.focus();
      return false;
    }
    if(form.pwd1.value != "" && form.pwd1.value == form.pwd2.value) {
      if(!checkPassword(form.pwd1.value)) {
        alert("Le mot de passe que vous avez entré n'est pas valide!");
        form.pwd1.focus();
        return false;
      }
    } else {
      alert("Error: Veuillez vérifier que vous avez entré et confirmé votre mot de passe!");
      form.pwd1.focus();
      return false;
    }
    return true;
  }

</script>


@endpush
