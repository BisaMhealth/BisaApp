@extends('layouts.apptheme_innerpage')
@section('title','Chat History')


@section('content') 
        <div class="chat-wrapper chat-wrapper-two">

          <div class="chat-sidebar">

            <div class="chat-sidebar-header">
              <a href="#" data-toggle="dropdown" class="dropdown-link">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm mg-r-8"><span class="avatar-initial rounded-circle">D</span></div>
                  <span class="tx-color-01 tx-semibold">Doctors</span>
                </div>
                <span><i data-feather="chevron-down"></i></span>
              </a>
              <div class="dropdown-menu dropdown-menu-right tx-13">
                <!-- <a href="" class="dropdown-item"><i data-feather="user-plus"></i> Invite People</a> -->
                <!-- <a href="" class="dropdown-item"><i data-feather="plus-square"></i> Create Channel</a>
                <a href="" class="dropdown-item"><i data-feather="server"></i> Server Settings</a>
                <a href="" class="dropdown-item"><i data-feather="bell"></i> Notification Settings</a>
                <a href="" class="dropdown-item"><i data-feather="zap"></i> Privacy Settings</a>
                <div class="dropdown-divider"></div>
                <a href="" class="dropdown-item"><i data-feather="edit-3"></i> Edit Team Details</a>
                <a href="" class="dropdown-item"><i data-feather="shield-off"></i> Hide Muted Channels</a> -->
              </div><!-- dropdown-menu -->
            </div><!-- chat-sidebar-header -->

            <!-- start sidebar body -->
            <div class="chat-sidebar-body">

              <div class="flex-fill pd-y-20 pd-x-10 bd-t">
               
                <p class="tx-10 tx-uppercase tx-medium tx-color-03 tx-sans tx-spacing-1 pd-l-10 mg-b-10">Questions</p>

             
                <div id="chatDirectMsg" class="chat-msg-list">
                  
                  @if(!empty($questions))
                      @foreach($questions as $userQuestions)
                      <a href="#" data-user="{{ $userQuestions->patient_id }}" data-quesid="{{ $userQuestions->question_id }}" class="media fetch-question-response">
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
                      </a>
                      @endforeach
                              <input type="hidden" id="user-id" name="" value="">
                              <input type="hidden" id="ques-id" name="" value="">
                      @else
                             <a href="#" class="media">
                                <div class="media-body mg-l-10">
                                  <h6 class="mg-b-0">No Questions Found</h6>
                                </div>
                              </a>
                              
                  @endif
                  
                  <!-- <a href="#" class="media">
                    <div class="avatar avatar-sm avatar-online"><span class="avatar-initial bg-primary rounded-circle">k</span></div>
                    <div class="media-body mg-l-10">
                      <h6 class="mg-b-0">k.billie</h6>
                      <small class="d-block tx-color-04">3 hours ago</small>
                    </div>
                  </a> -->
             
                  <div id='app'>

                  </div>
          
                </div><!-- media-list -->
              </div>
            </div><!-- chat-sidebar-body -->

            <div class="chat-sidebar-footer">
              <div class="d-flex align-items-center">
                <div class="avatar avatar-sm avatar-online mg-r-8"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                <h6 class="tx-semibold mg-b-0">{{ Session::get('full_name') }}</h6>
              </div>
              <div class="d-flex align-items-center">
                <a href=""><i data-feather="mic"></i></a>
                <a href=""><i class="fa fa-sync"></i></a>
              </div>
            </div>

          </div><!-- chat-sidebar -->

          <div class="chat-content">
            <div class="chat-content-header">

              <h6 id="channelTitle" class="mg-b-0"></h6>
              <div id="directTitle" class="d-none">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm avatar-online"><span class="avatar-initial rounded-circle">b</span></div>
                  <h6 class="mg-l-10 mg-b-0">@dfbot</h6>
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
                   <a href="#" data-toggle="tooltip" title="Call A Doctor"><i data-feather="phone"></i></a>
                   <!-- <a href="#" data-toggle="tooltip" title="Add to Favorites"><i data-feather="star"></i></a> -->
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalNewQuestion"  title="Start A Chart" data-placement="left">
                  <i class="fa fa-question-circle"></i> Ask New Question</button>

                <!--   <a href="#" data-toggle="tooltip" title="Channel Settings" data-placement="left"><i data-feather="more-vertical"></i></a> -->
                </nav>
              </div>
            

            </div><!-- chat-content-header -->

            <div class="chat-content-body">
              <div id="chat-box" class="chat-group">
                  <p> Select a question in the right pane to view responses</p>
                <!-- <div class="chat-group-divider">February 20, 2019</div>
                <div class="media">
                  <div class="avatar avatar-sm avatar-online"><span class="avatar-initial rounded-circle">k</span></div>
                  <div class="media-body">
                    <h6>katherine <small>Today at 1:30am</small></h6>

                    <p>Hello everyone, this is my first message to this channel</p>
                    <p>anybody here?</p>
                  </div>
                </div> -->
              </div>
 
            </div><!-- chat-content-body -->


            <div class="chat-content-footer">
              <!-- <a href="" data-toggle="tooltip" title="Add File" class="chat-plus"><i class="fa fa-edit"></i></a> -->
              <input type="text" id="question-content" class="form-control align-self-center bd-0" placeholder="Message">
              <nav>
                <a href="#" class="send-question-response" data-toggle="tooltip" title="Send Message"><i data-feather="send"></i></a>
                
                <a href="#" data-toggle="modal" data-target="#modalFileAttachment" id="add-response-file" title="Add file"><i class="fa fa-paperclip"></i></a>
               
              </nav>
            </div><!-- chat-content-footer -->
          </div><!-- chat-content -->
        </div><!-- chat-wrapper -->
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

            <h6 class="tx-uppercase tx-spacing-1 tx-semibold mg-b-20">Ask New Question</h6>
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
                      <label for="lable-controlg">Question Category</label>
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
                      <label for="lable-controlg">Question</label>
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
            <button type="button" class="btn btn-secondary tx-13" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success tx-13">Submit</button>
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

            <h6 class="tx-18 tx-sm-20 mg-b-5">File Upload</h6>
            <p class="tx-color-03 mg-b-20">Attach a file to the selected question</p>
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
              Upload
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


  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('7606f1e71c3d7f7857ac', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('update-notification-channel');
    channel.bind('question-read', function(data) {
      let resultData = JSON.stringify(data);
       let item = JSON.parse(resultData);
      $('#notify-doctor').text(item.allUnreadMessages);

      $('#number-of-user-questions').text(item.countAllQuestionsGlobal);
      
      $('#doctors-reply').text();
    });
  </script>
@endpush