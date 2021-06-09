@extends('index')
    <!-- navbar-right -->    
<!-- navbar -->

@section('content')

	      <div class="container ht-100p">
        <div class="ht-100p d-flex flex-column align-items-center justify-content-center">
        		<p class="tx-color-03 mg-b-40">Please check your phone and enter the verification code you received to verify your account.</p>
          <div class="wd-150 wd-sm-250 10 mg-b-10">

          

          	<div class="row row-sm mg-b-5 ">
        	   <div class="form-group col-sm-10">
                <input type="text" name="verification_code" id="verification-code" class="form-control" placeholder="Enter your verification code">
              </div>

               <div class="form-group col-sm-2">
               <button type="button" style="color:#fff !important;" class="btn bg-site-primary border-site-primary verify-user-code">Verify</button>
              </div>

            </div>

          </div>
         <!--  <h4 class="tx-20 tx-sm-24">Verify your email address</h4> -->
          
         	<input type="hidden" id="user-phone" value="<?php if(isset($phone)) echo $phone; ?>" name="">
         	<input type="hidden" id="user-token" value="<?php if(isset($ticket)) echo $ticket; ?>" name="">


          <div class="tx-13 tx-lg-14 mg-b-40">
            <a  href="#" class="btn btn-secondary d-inline-flex align-items-center">
            <i class="far fa-send"></i> Resend Verification</a>
            <a href="" class="btn btn-white d-inline-flex align-items-center mg-l-5">Contact Support</a>
          </div>
          <!-- <span class="tx-12 tx-color-03">Mailbox with envelope vector is created by <a href="https://www.freepik.com/free-photos-vectors/background">freepik (freepik.com)</a></span> -->
        </div>
      </div><!-- container -->



@endsection

  

 