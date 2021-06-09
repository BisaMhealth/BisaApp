@extends('layouts.apptheme_innerpage')

@section('title', __('Profile'))

@section('pageinfo')
          <div>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="/patient/dashboard">{{  __('Home') }}</a></li>
                <li class="breadcrumb-item cs-active" aria-current="page">{{ __('User Profile') }}</li>
              </ol>
            </nav>
            <!-- <h3 style="color:#5c5b5b !important;" class="mg-b-0 tx-spacing mt-5">New Appointment</h3> -->
          </div>
        </div>
@endsection


@section('content')

<div class="content-body">
        <div class="container pd-x-0 tx-13">
          <div class="media d-block d-lg-flex">
            <div class="profile-sidebar profile-sidebar-two pd-lg-r-15">

              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg">
                  <div class="avatar avatar-xxl avatar-online">

                    @if(isset($patientDetails->profile_image) && $patientDetails->profile_image  != '' && $patientDetails->profile_image != 'n_a' && $patientDetails->profile_image != 'n/a')

                    <img src="{{ $patientDetails->profile_image }}" alt="Profile Image" class="rounded-circle" alt="...">
                      @else
                        <img src="https://via.placeholder.com/500" class="rounded-circle" alt="">

                    @endif

                  </div>
                </div><!-- col -->
                <div class="col-sm-12 col-md-12 col-lg mg-t-20 mg-sm-t-0 mg-lg-t-25">
                  <h5 class="mg-b-2 tx-spacing--1"> {{ $patientDetails->first_name }} {{ $patientDetails->last_name }}</h5>
                 <!--  <p class="tx-color-03 mg-b-25">@fenchiumao</p> -->

                  <div class="col-sm-12 mg-b-25">
                    <button data-toggle="modal" data-target="#modalFileAttachment" class="btn btn-block btn-xs btn-white flex-fill">{{ __('Update Image')  }}</button>

                    <button data-toggle="modal" data-target="#modalChangePassword" class="btn btn-block btn-xs btn-secondary flex-fill">{{ __('Change  Password')  }}</button>
                 <!--    <button style="color: #fff;" class="btn btn-xs bg-site-primary border-site-primary flex-fill mg-l-10">Change Password</button> -->
                  </div>



                  <div class="d-flex">
                <!--     <div class="profile-skillset flex-fill">
                      <h4><a href="" class="link-01">1.4k</a></h4>
                      <label>Stars</label>
                    </div>
                    <div class="profile-skillset flex-fill">
                      <h4><a href="" class="link-01">2.8k</a></h4>
                      <label>Followers</label>
                    </div> -->

                  </div>
                </div><!-- col -->






              </div><!-- row -->

            </div><!-- profile-sidebar -->
            <div class="media-body mg-t-40 mg-lg-t-0 pd-lg-x-10">

<!--
              <div class="card mg-b-20 mg-lg-b-25">
                <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                  <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">Login History</h6>

                  <nav class="nav nav-icon-only">
                    <a href="" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></a>

                  </nav>
                </div>
                <div class="card-body pd-20 pd-lg-25">



                  <div class="bd bg-gray-50 pd-y-15 pd-x-15 pd-sm-x-20">
                    <h6 class="tx-15 mg-b-3">We're hiring of Product Manager</h6>
                    <p class="mg-b-0 tx-14">Full-time, $60,000 - $80,000 annual</p>
                    <span class="tx-13 tx-color-03">Bay Area, San Francisco, CA</span>
                  </div>
                </div>

              </div> -->

              <div class="card mg-b-20 mg-lg-b-25">
                <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                  <h6 class="tx-13 tx-spacing-1 tx-uppercase tx-semibold mg-b-0">{{ __('Personal Information') }}</h6>
                 <!--  <nav class="nav nav-with-icon tx-13">
                    <a href="" class="nav-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Add New</a>
                  </nav> -->
                </div><!-- card-header -->
                <div class="card-body pd-25">

                  <form action="/update-patient-profile" method="POST">
                    {{ csrf_field() }}
                  <div class="row row-sm mg-b-10 mt-3 pl-4">
                   <div class="form-group col-md-8">
                      <label>{{ __('First Name') }}</label>
                      <input type="text" value="{{ $patientDetails->first_name }}" class="form-control" name="first_name">
                   </div>

                     <div class="form-group col-md-8">
                      <label>{{ __('Last Name') }}e</label>
                      <input type="text" value="{{ $patientDetails->last_name }}" class="form-control" name="last_name">
                   </div>
                 </div>

                 <div class="row row-sm mg-b-10 mt-3 pl-4">
                   <div class="form-group col-md-8">
                      <label>{{ __('Username') }}</label>
                      <input type="text" readonly="" value="{{ $patientDetails->username }}" class="form-control" name="username">
                   </div>

                   <div class="form-group col-md-8">
                      <label>{{ __('Email') }}</label>
                      <input type="text" value="{{ $patientDetails->email }}" class="form-control" name="email">
                   </div>



                     <div class="form-group col-md-8">
                      <label>{{ __('Phone') }}</label>
                      <input type="text" value="{{ $patientDetails->phone }}" class="form-control" name="phone">
                   </div>


                 </div>


                    <div class="row row-sm mg-b-10 mt-3 pl-4">

                        <div class="form-group col-md-8">
                            <label>{{ __('Date of Birth') }}</label>
                             <input value="{{ $patientDetails->date_of_birth }}" type="text" id="" class="form-control  datepicker-single" name="dob" placeholder="Pick a Date">
                         </div>

                         <div class="form-group col-md-8">
                            <label>{{ __('Gender') }}</label>
                            <input type="text" value="{{ $patientDetails->gender }}" class="form-control" name="gender">
                         </div>

                         <div class="form-group col-md-8">
                            <label>{{ __('Country') }}</label>
                            <select name="country" class="form-control">

                              <option value="{{ $patientDetails->country }}">{{ $patientDetails->country }}</option>
                              <option value=""></option>


                            </select>
                         </div>




                    </div>


                      <div class="row row-sm mg-b-10 mt-3 pl-4">

                      <div class="form-group col-md-8">
                      <label>{{ __('Address') }}</label>
                      <textarea  name="address" class="form-control">{{ $patientDetails->address }}</textarea>
                      </div>

                         <div class="form-group col-md-8">
                            <button type="submit" class="btn btn-block  btn-success flex-fill"> {{ __('Update') }} </button>
                         </div>

                     </div>


                  </form>


                </div>
               <!--  <div class="card-footer bg-transparent pd-y-15 pd-x-20">
                  <nav class="nav nav-with-icon tx-13">
                    <a href="" class="nav-link">
                      Show More Experiences (4)
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down mg-l-2 mg-r-0 mg-t-2"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                  </nav>
                </div> -->
              </div>




            </div><!-- media-body -->

            </div><!-- profile-sidebar -->
          </div><!-- media -->
        </div><!-- container -->
      </div>




  <div class="modal fade effect-scale" id="modalFileAttachment" tabindex="-1" role="dialog" aria-hidden="true">

    <form  action="/update-profile-image" method="POST" id="frm-uploadmedia" enctype=multipart/form-data >
    @csrf
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body pd-20 pd-sm-30">
            <button type="button" class="close pos-absolute t-20 r-20" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
            </button>

            <h6 class="tx-18 tx-sm-20 mg-b-5">{{ __('Update Profile Image') }}</h6>

            <input type="hidden" id="target-user"  name="target_question" value="{{ $patientDetails->user_id }}">

            <div class="form-group mg-b-5 text-center">
              <input onchange="uploadFile(event)" type="file" id="file_upload" ref="file_upload" name="file_upload" class="form-control input-lg inputfile" value="">
              <label for="file_upload"><strong> <i class="fa fa-paperclip"></i> </strong></label>

                </div>


                <div class="form-group col-md-12">
                    <img style="width:150px" id="output-single"/>
                </div>

            <div class="form-group">
            <button type="submit" class="btn btn-outline-light btn-block update-prifile-image" type="button" id="button-addon2">
            {{ __('Update') }}
            </button>
            </div>



          </div>
        </div>
      </div>
    </form>


    </div>





      <div class="modal fade effect-scale" id="modalChangePassword" tabindex="-1" role="dialog" aria-hidden="true">

    <form  action="" onsubmit="" id="">
    @csrf
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body pd-20 pd-sm-30">
            <button type="button" class="close pos-absolute t-20 r-20" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
            </button>

            <h6 class="tx-18 tx-sm-20 mg-b-5">{{ __('Change Password') }}</h6>

                        <div class="row row-sm mg-b-10 mt-3 pl-4">

                        <div class="form-group col-md-12">
                            <label>{{ __('Old Password') }}</label>
                             <input  type="password" id="old-password" class="form-control" name="" placeholder="{{ __('Old Password') }}">
                         </div>

                         <div class="form-group col-md-12">
                            <label>{{ __('New Password') }}</label>
                            <input type="password" id="new-password"  class="form-control" placeholder="{{ __('New Password') }}" name="password">
                         </div>

                         <div class="form-group col-md-12">
                            <label>{{ __('Confirm Password') }}</label>
                            <input type="password"  class="form-control" id="confirm-password" placeholder="{{ __('Confirm Password') }}" name="confirm_password">
                         </div>


                           <div class="form-group col-md-12">
                              <button type="button" class="btn btn-secondary btn-block sesa" type="button" id="button-addon2">  {{ __('Change') }} </button>
                         </div>


                    </div>

          </div>
        </div>
      </div>
    </form>


    </div>

@endsection




@push('scripts')


<script>

  var uploadFile = function(event) {
    var reader = new FileReader();
    reader.onload = function(){
      var output = document.getElementById('output-single');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };


</script>

@endpush
