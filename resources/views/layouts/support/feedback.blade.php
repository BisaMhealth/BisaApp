@extends('index')
    <!-- navbar-right -->
<!-- navbar -->

@section('content')

	      <div class="container ht-100p">
        <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
					<h4 class="tx-20 tx-sm-24">{{ __('Reset your password') }}</h4>
        		<p class="tx-color-03 mg-b-40">{{ __('Enter your email address and we will send you a link to reset your password') }}</p>
          <div class="wd-150 wd-sm-250 10 mg-b-10">


						<form action="/user/init" method="POST">
							{{ csrf_field() }}
          	<div class="row row-sm mg-b-5 ">
        	   <div class="form-group col-sm-10">
                <input type="email" name="email" id="user-email" class="form-control" placeholder="{{ __('Enter your email') }}">
              </div>

               <div class="form-group col-sm-2">
                 <button type="submit" style="color:#fff !important;" class="btn bg-site-primary border-site-primary initiate-password-reset">
                 {{ __('Reset') }}</button>
              </div>

            </div>
					</form>

          </div>
         <!--  <h4 class="tx-20 tx-sm-24">Verify your email address</h4> -->

          <!-- <div class="tx-13 tx-lg-14 mg-b-40">
            <a  href="#" class="btn btn-secondary d-inline-flex align-items-center">
            <i class="far fa-send"></i> Resend Verification</a>
            <a href="" class="btn btn-white d-inline-flex align-items-center mg-l-5">Contact Support</a>
          </div> -->
          <!-- <span class="tx-12 tx-color-03">Mailbox with envelope vector is created by <a href="https://www.freepik.com/free-photos-vectors/background">freepik (freepik.com)</a></span> -->
        </div>
      </div><!-- container -->



@endsection
