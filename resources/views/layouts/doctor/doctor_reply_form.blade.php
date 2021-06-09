@extends('layouts.apptheme_innerpage')
@section('title', __('Questions') )


@section('content')
<div class="content-body0 pd-0">
        <div class="chat-wrapper chat-wrapper-two">
          <div class="chat-sidebar">

            <div class="chat-sidebar-header">
              <a href="#" data-toggle="dropdown" class="dropdown-link">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm mg-r-8"><span class="avatar-initial rounded-circle">C</span></div>
                  <span class="tx-color-01 tx-semibold">{{ Session::get('full_name') }}</span>
                </div> <input type="hidden" id="doctor-reply-token" name="" value="{{ Session::get('user_token') }}">

             <!--    <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down"><polyline points="6 9 12 15 18 9"></polyline></svg></span> -->
              </a>

            </div><!-- chat-sidebar-header -->

            <!-- start sidebar body -->
            <div class="chat-sidebar-body ps ps--active-y">

          <!--     <div class="flex-fill pd-y-20 pd-x-10">
                <div class="d-flex align-items-center justify-content-between pd-x-10 mg-b-10">
                  <span class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1">All Channels</span>
                  <a href="#modalCreateChannel" class="chat-btn-add" data-toggle="modal"><span data-toggle="tooltip" title="" data-original-title="Create Channel"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg></span></a>
                </div>
                <nav id="allChannels" class="nav flex-column nav-chat mg-b-20">
                  <a href="#general" class="nav-link"># general</a>
                  <a href="#engineering" class="nav-link"># engineering</a>
                  <a href="#products" class="nav-link"># products <span class="badge badge-danger">2</span></a>
                </nav>
              </div> -->

              <div class="flex-fill pd-y-20 pd-x-10 bd-t">
                <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1 pd-l-10 mg-b-10">  {{ __('Patient History') }}</p></p>

                <div id="chatDirectMsg" class="chat-msg-list">

                  @if(!empty($questions))
                      @foreach($questions as $userQuestions)
                      <a href="#" data-user="{{ $userQuestions->patient_id }}" data-quesid="{{ $userQuestions->question_id }}" class="media fetch-question-with-doctor-response">

                        <div class="avatar avatar-sm avatar-online0">
                          <span class="avatar-initial bg-dark rounded-circle"><i class="fa fa-comment-alt"></i> </span>
                        </div>
                        <div class="media-body mg-l-10">
                          <h6 style="font-weight:normal;" class="mg-b-0">

                            @if(strlen($userQuestions->question_content) >= 20)
                                  {{ substr($userQuestions->question_content, 0, 49). " ... " }}

                                  @else
                                  {{ $userQuestions->question_content }}
                            @endif


                          </h6>
                          <?php $questionDate =  $userQuestions->created_at ?>
                          <small class="d-block tx-color-04">
                          {{ Carbon\Carbon::parse($questionDate->date)->diffForHumans() }}
                          </small>
                        </div>

                        @if($userQuestions->unread_responses != 0)

                        <span class="badge badge-danger id-response-indicator">
                         {{ $userQuestions->unread_responses }}
                        </span>
                        @endif

                      </a>
                      @endforeach
                              <input type="hidden" id="user-id" name="" value="{{ $userId }}">
                              <input type="hidden" id="ques-id" name="" value="{{ $questionId }}">
                      @else
                             <a href="#" class="media">
                                <div class="media-body mg-l-10">
                                  <h6 class="mg-b-0">
                                  {{ __('No questions found') }}
                                  </h6>
                                </div>
                              </a>

                  @endif


                  <div id='app'>

                  </div>

                </div><!-- media-list -->


              </div>
            <div class="ps__rail-x" style="left: 0px; top: 129px;">
              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
              </div></div><div class="ps__rail-y" style="top: 129px; height: 539px; right: 0px;">
                <div class="ps__thumb-y" tabindex="0" style="top: 89px; height: 374px;">
                </div></div>
              </div><!-- chat-sidebar-body -->

            <div class="chat-sidebar-footer">
              <div class="d-flex align-items-center">
                <!-- href="" <div class="avatar avatar-sm avatar-online mg-r-8"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div> -->

            <?php

              $link  = (Session::get('doctor_permission')== 'student') ?  '/question-queue-covid-19' : '/view-all-questions';

             ?>
            <a href="<?php echo $link;  ?>">
              <h6 class="tx-semibold mg-b-0 btn btn-secondary btn-block"> <i class="fa fa-arrow-left"></i> Back </h6>
            </a>

              </div>
              <div class="d-flex align-items-center">

                <!-- <a href=""><i class="fa fa-sync"></i></a> -->

              </div>
            </div><!-- chat-sidebar-footer -->

          </div><!-- chat-sidebar -->

          <div class="chat-content">
            <div class="chat-content-header">
                 <ol class="breadcrumb breadcrumb-style1 mg-b-10 float-left">
                   <?php
                       if(isset($isfollowup) && $isfollowup == 1){
                         $home  =  '/covid-patient-review';
                       }else{
                         $home  =  '/users/show-questions';
                       }

                    ?>
                    <!-- <li class="breadcrumb-item"><a href="<?php echo $home; ?>">{{  __('Questions') }}</a></li> -->
                    <li style="font-size:.8em" class="breadcrumb-item cs-active" aria-current="page">
                    {{ $fullName }} Age:({{ Arr::exists($response,'age') ? $response->age : '' }}), Location: {{ Arr::exists($response,'location') ? $response->location : '' }} , Known Condition ? :{{  Arr::exists($response,'known_condition') ? $response->known_condition : '' }}
                    </li>
                    
                  <!-- </li> -->

                  </ol>

                  <button  class="tx-semibold mg-b-0 btn btn-secondary pull-right close-current-question">
                    {{ __('Close Question')  }}
                  </button>

              <h6 id="channelTitle" class="mg-b-0"></h6>
              <div id="directTitle" class="d-none">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm avatar-online"><span class="avatar-initial rounded-circle">b</span></div>
                  <h6 class="mg-l-10 mg-b-0">@{{ $fullName }}</h6>
                </div>
              </div>
              <div class="d-flex">

                <nav id="directNav" class="d-none">
                 <!--  <a href="#" data-toggle="tooltip" title="Call User"><i data-feather="phone"></i></a> -->
                  <!-- <a href="#" data-toggle="tooltip" title="User Details"><i data-feather="info"></i></a> -->
                  <!-- <a href="#" data-toggle="tooltip" title="Add to Favorites"><i data-feather="star"></i></a> -->
                  <!-- <a href="" data-toggle="tooltip" title="Flag User"><i data-feather="flag"></i></a> -->
                </nav>

                <nav class="mg-sm-l-10">

                <!--   <a href="#" data-toggle="tooltip" title="Channel Settings" data-placement="left"><i data-feather="more-vertical"></i></a> -->
                </nav>
              </div>


            </div><!-- chat-content-header -->

            <div class="chat-content-body">
              <div id="chat-box" class="chat-group">
                @if(isset($response))
                        <!-- @foreach($response->question_threads as $responseData)
                          <div class="chat-group-divider">{{ $responseData->created_at }}</div>
                          <div class="media">
                            <div class="avatar avatar-sm avatar-online ">
                              @switch($responseData->creator_type)
                        @case('user')
                            <span class="avatar-initial bg-site-primary rounded-circle "> <i class="fa fa-user"></i> </span>
                            @break

                        @case('doctor')
                            <span class="avatar-initial  rounded-circle "> <i class="fa fa-stethoscope"></i> </span>
                            @break

                        @default
                            <span>{{ __('An error has occurred. Try Again') }}</span>
                  @endswitch
                      </div> -->

                    

                  <!-- </div>
                  @endforeach -->

                  <!-- <div id="chat-box" class="chat-group"> -->

                    <h5 style=" margin: auto;"> {{ __('Select a question in the left pane to view the details') }}</h5>

                  <!-- </div> -->

                  <div class="ps__rail-x" style="left: 0px; top: 29px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;">
                    </div>
                  </div>
                  <!-- <div class="ps__rail-y" style="top: 29px; height: 539px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 23px; height: 444px;">
                    </div>
                  </div> -->

                @endif

              </div>


            </div><!-- chat-content-body -->

            <div class="chat-sidebar-right ps">
              <div class="pd-y-20 pd-x-10">
                <div class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1 pd-l-10">
                  {{ __('List of members')}}
                </div>
                <div class="chat-member-list">




                  <a href="#" class="media">
                    <div class="avatar avatar-sm avatar-online"><span class="avatar-initial rounded-circle">C</span></div>
                    <div class="media-body mg-l-10">
                      <h6 class="mg-b-0">avendula</h6>
                    </div><!-- media-body -->
                  </a><!-- media -->
                </div><!-- chat-msg-list -->
              </div>
            <div class="ps__rail-x" style="left: 0px; top: 0px;">

              <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div>

          </div>

          <div class="chat-content-footer">
            <!-- <a href="" data-toggle="tooltip" title="Add File" class="chat-plus"><i class="fa fa-edit"></i></a> -->
            <input type="text" id="doctor-question-content" class="form-control align-self-center bd-0" placeholder="Message">
            <nav>
              <a href="#" data-doctorid="{{ Session::get('user_id') }}" class="send-doctor-question-response" data-toggle="model" title="Send Message" id="doctor-send"><i data-feather="send"></i> </a>

              <!-- <a href="#" data-toggle="modal" data-target="#modalFileAttachment" id="add-response-file" title="Add file"><i class="fa fa-paperclip"></i></a> -->

              <button class="btn" type="button" href="#" id="get-user-mic" data-toggle="modal" data-target="#modalAudioRecord"><i data-feather="mic"></i></button>



            </nav>
          </div><!-- chat-content-footer -->


          </div><!-- chat-content -->


        </div><!-- chat-wrapper -->



      </div>


      <div class="modal fade effect-scale" id="modalAudioRecord" tabindex="-1" role="dialog" aria-hidden="true">

<form  action="" onsubmit="return false;" id="frm-uploadaudio" >
@csrf
<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-body pd-20 pd-sm-30">
        <button type="button" class="close pos-absolute t-20 r-20" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
        </button>

        <h6 class="tx-18 tx-sm-20 mg-b-5">{{ __('Audio Recorder') }}</h6>
        <p class="tx-color-03 mg-b-20">{{ __('Attach an audio file to the selected question') }}</p>
        <input type="hidden" id="target-question-id"  name="target_question" value="{{ old('target_question') }}">
          <input type="hidden" id="target-user" >

        <div class="form-group mg-b-5 text-center">

           <h3 id="media-state"> </h3>
                <div class="audio-container">
                  <button id="btnStart" class="btn btn-primary"><i class="fa fa-play-circle"></i> Start</button>
                  <button disabled="true" id="btnStop" class="btn btn-warning"><i class="fa fa-stop-circle"></i> Stop / Upload</button>
                    <audio controls id="audio-tag" muted=true class="hidden"></audio>
                </div>
            </div>
            <div class="form-group col-md-12">
                <img style="width:150px" id="output-single"/>
            </div>

        <div class="form-group">
        <!-- <button  class="btn btn-outline-light btn-block " type="button" id="button-addon2">
          {{ __('Upload File') }}
        </button> -->
        </div>
      </div>
    </div>
  </div>
</form>


</div>




<div class="modal fade effect-scale" id="modalNewQuestion" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="{{ route('ask') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
          <div class="modal-body pd-20">
            <button type="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
            </button>

            <h6 class="tx-uppercase tx-spacing-1 tx-semibold mg-b-20">
            {{ __('Ask a new question') }}</h6>
                @if (count($errors) > 0)
                  <div class = "alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                  </div>
                @endif


                  <div class="form-group">
                      <label for="lable-controlg">{{ __('Question Category') }}</label>
                      <select class="form-control" name="question_category">
                        @if(isset($getQuestionsCategory))

                          @foreach($getQuestionsCategory as $category)

                           <option value="{{ $category->category_id }}">{{ $category->category_name  }}</option>
                           @endforeach
                        @endif

                      </select>
                      @error('question_category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                @enderror
                    </div>

                  <div class="form-group">
                      <label for="lable-controlg">{{ __('Question') }}</label>
                      <textarea require name="question" class="form-control" id="" cols="30" rows="4">{{ old('question') }}</textarea>
                               @error('question')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $error }}</strong>
                                    </span>
                                @enderror
                  </div>

                  <div class="row">
                        <!-- <div class="col-sm">
                         <label for="">Select File Type</label>
                          <select name="media_type" id="" class="form-control">
                            <option value="image">Image</option>
                            <option value="Doc">Document</option>
                            <option value="av">Video/Auio</option>
                          </select>
                        </div> -->
                        <div class="col-sm">
                          <input  id="file" name="image" ref="file"  onchange="loadFile(event)" class="form-control input-lg inputfile" data-multiple-caption="{count} files selected" placeholder="Upload Image" type="file">
                          <label for="file"><strong> <i class="fa fa-paperclip"></i> </strong></label>
                        </div>

                  </div>

                  <div class="form-group">
                    <!-- <input type="file" name="file" id="file" class="inputfile" data-multiple-caption="{count} files selected" multiple />
                     -->
                    <div class="form-group col-md-5">
                            <img style="width:150px" id="output"/>
                    </div>
                  </div>



          </div>
          <div class="modal-footer pd-x-20 pd-b-20 pd-t-0 bd-t-0">
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">{{ __('Close') }}</button>
            <button type="submit" class="btn btn-success tx-13">{{ __('Submit')}}</button>
          </div>
        </div>
      </div>
      </form>
    </div>

    <div class="modal fade effect-scale" id="modalFileAttachment" tabindex="-1" role="dialog" aria-hidden="true">

    <form  action="" onsubmit="return false;" id="frm-uploadmedia" >
    @csrf
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body pd-20 pd-sm-30">
            <button type="button" class="close pos-absolute t-20 r-20" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i data-feather="x" class="wd-20"></i></span>
            </button>

            <h6 class="tx-18 tx-sm-20 mg-b-5">{{ __('Upload File') }}</h6>
            <p class="tx-color-03 mg-b-20">{{ __('Attach a file to the selected question') }}</p>
            <input type="hidden" id="target-question-id"  name="target_question" value="{{ old('target_question') }}">
              <input type="hidden" id="target-user" >

            <div class="form-group mg-b-5 text-center">
              <input onchange="uploadFile(event)" type="file" id="file_upload" ref="file_upload" name="file_upload" class="form-control input-lg inputfile" value="">
              <label for="file_upload"><strong> <i class="fa fa-paperclip"></i> </strong></label>

                </div>


                <div class="form-group col-md-12">
                    <img style="width:150px" id="output-single"/>
                </div>

            <div class="form-group">
            <button  class="btn btn-outline-light btn-block add-media" type="button" id="button-addon2">
              {{ __('Upload File') }}
            </button>
            </div>



          </div>
        </div>
      </div>
    </form>


    </div>
@endsection


@push('scripts')

<script>
  var loadFile = function(event) {
      var reader = new FileReader();
      reader.onload = function(){
      var output = document.getElementById('output');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };


  var uploadFile = function(event) {
      var reader = new FileReader();
      reader.onload = function(){
      var output = document.getElementById('output-single');
      output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
  };


</script>

<script src="{{ asset('../../assets/js/doctor/doctor.js') }}"></script>
<!-- <script src="{{ asset('../../assets/js/patient/patient.js')}}"></script> -->


  <script>
    // Enable pusher logging - don't include this in production
    // Pusher.logToConsole = true;

    // var pusher = new Pusher('7606f1e71c3d7f7857ac', {
    //   cluster: 'eu',
    //   forceTLS: true
    // });

    // var channel = pusher.subscribe('update-notification-channel');
    // channel.bind('question-read', function(data) {
    //   let resultData = JSON.stringify(data);
    //    let item = JSON.parse(resultData);
    //   $('#notify-doctor').text(item.allUnreadMessages);

    //   $('#number-of-user-questions').text(item.countAllQuestionsGlobal);

    //   //$('#doctors-reply').text();


    // });





  </script>
@endpush
