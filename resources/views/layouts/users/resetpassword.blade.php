@extends('index')
    <!-- navbar-right -->
<!-- navbar -->

@section('content')

	      <div class="container ht-100p">
        <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
					<h5 class="tx-20 tx-sm-24">{{ __('Reset your password') }}</h5>
          <div class="wd-150 wd-sm-250 10 mg-b-10">
						@if (count($errors) > 0)
													<div class = "alert alert-danger">
															<ul>
																@foreach ($errors->all() as $error)
																		<li>{{ $error }}</li>
																@endforeach
															</ul>
													</div>
							@endif

						<form action="/user/password/reset" method="POST">
							{{ csrf_field() }}
          	<div class="row row-sm mg-b-5 ">
        	   <div class="form-group col-sm-12">
							 	<label class="label-control">{{ __('Enter Password') }}</label>
                <input value="{{ old('password') }}" type="password" name="password" id="user-email" class="form-control" placeholder="Password">
              </div>
							<!-- <input type="text"  value="{{ old("session('email')") }}" name="email" /> -->
							<div class="form-group col-sm-12">
 							 	<label class="label-control">{{ __('Confirm Password') }}</label>
                 <input value="{{ old('password_confirmation') }}" type="password" name="password_confirmation" id="user-email" class="form-control" placeholder="{{ __('Confirm Password') }}">
               </div>

               <div class="form-group col-sm-12">
                 <button type="submit" style="color:#fff !important;" class="btn bg-site-primary btn-block border-site-primary initiate-password-reset">{{ __('Reset Password') }}</button>
								 <div class="tx-13 tx-lg-14 mg-b-40">
									 <a  href="/forgotten-password" class="d-inline-flex align-items-center btn-white float-right mt-4">
									 <i class="far fa-send"></i> {{ __('Resend Verification') }}</a>
									 <!-- <a href="" class="btn btn-white d-inline-flex align-items-center mg-l-5">Contact Support</a> -->
								 </div>
						  </div>

            </div>
					</form>

          </div>
         <!--  <h4 class="tx-20 tx-sm-24">Verify your email address</h4> -->


          <!-- <span class="tx-12 tx-color-03">Mailbox with envelope vector is created by <a href="https://www.freepik.com/free-photos-vectors/background">freepik (freepik.com)</a></span> -->
        </div>
      </div><!-- container -->



@endsection
