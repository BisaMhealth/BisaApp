$( document ).ready(function() {
  $("#doctor-question-content").css("display","none");
  $("#doctor-send").css("display", "none");
  $("#patient-send").css("display", "none");
  $("#question-content").css("display","none");
    $('.fetch-question-response').on('click',function(){
      let currentEle = $(this);
      let userId =  currentEle.data("user");
      let questionId =  currentEle.data("quesid");

      $('#user-id').val(userId);
      $('#ques-id').val(questionId);

      $('#target-question-id').val(questionId);
      $('#target-user').val(userId);
      fetchQusetionResponse(userId,questionId);

      //Show paper clip
      $("#add-response-file").css("display", "block");
      $("#get-user-mic").css("display", "block");
      $("#patient-send").css("display","block");
      $("#question-content").css("display","block");
    });


       $('.fetch-question-with-doctor-response').on('click',function(){
          let currentEle = $(this);
          let userId =  currentEle.data("user");
          let questionId =  currentEle.data("quesid");

          $('#user-id').val(userId);
          $('#ques-id').val(questionId);

          $('#target-question-id').val(questionId);
          $('#target-user').val(userId);
          getDoctorWithUserQuetions(userId,questionId);

      //Show paper clip
      // $("#add-response-file").css("display", "block");
      $("#get-user-mic").css("display","block");
      $("#doctor-send").css("display","block");
      $("#doctor-question-content").css("display","block");

    });



    function fetchQusetionResponse(userId,questionId){

      //Fetch question responses
      loadProgressBar();
      axios.get(`/question/responses/${userId}/${questionId}`)
      .then(function (response) {

          let questionThread = response.data.question_threads;
          //Loop through the thread
          $('#chat-box').html(' ');
          questionThread.map((item, index) => {
              let responseDate = item.created_at;
              let responseTime = customTime(responseDate.date);
              let responseAvarta= setAvarta(item.creator_type);
              let mediaPort = ' ';

            mediaPort  = showAttachment(item.file_type,item.question_media_url,item.file_extension);
            textContent  =  (item.question_content == null)  ? ' ' : item.question_content;

            $('#chat-box').append(`<div class="chat-group-divider"><i class="fa fa-check-double"></i> </div>
            <div class="media my_row">
              <div class="avatar avatar-sm avatar-online">
              ${responseAvarta}
              </div>
              <div class="media-body response-body">
                <h6> ${item.creator} <small> ${responseDate}</small></h6>
                <p>${textContent}</p>
                <p>${mediaPort}</p>
              </div>`);


          });
      })
      .catch(function (error) {
        //console.log(error);
      });
    }



    function getDoctorWithUserQuetions(userId,questionId){
        //Fetch question responses
        loadProgressBar();
      axios.get(`/question/responses/${userId}/${questionId}`)
      .then(function (response) {

          let questionThread = response.data.question_threads;
          //Loop through the thread
          $('#chat-box').html(' ');
          questionThread.map((item, index) => {
              let responseDate = item.created_at;
              let responseTime = customTime(responseDate.date);
              let responseAvarta= setDoctorAvarta(item.creator_type);
              let mediaPort = ' ';

            mediaPort  = showAttachment(item.file_type,item.question_media_url,item.file_extension);

            textContent = (item.question_content == null) ? ' ' : item.question_content;

            $('#chat-box').append(`<div class="chat-group-divider">${responseDate}</div>
            <div class="media my_row">
              <div class="avatar avatar-sm avatar-online">
              ${responseAvarta}
              </div>
              <div class="media-body response-body">
                <h6> ${item.creator} <small> ${responseDate}</small></h6>
                <p>${textContent}</p>
                <p>${mediaPort}</p>
              </div>`);


          });
      })
      .catch(function (error) {
        //console.log(error);
      });
    }




    function setNotifier(){
      // Enable pusher logging - don't include this in production
    //Pusher.logToConsole = true;
    let userToken =  $('#q-user-token').val();
    var pusher = new Pusher('7606f1e71c3d7f7857ac', {
      cluster: 'eu',
      //encrypted: true,
      forceTLS: true
    });

    let channel = pusher.subscribe('user-chats-channel');
    channel.bind('question-reply', function(data) {
      let resultData = JSON.stringify(data);
      let item       = JSON.parse(resultData);

      if(item.flag == "reply"){
        $('#notify-doctor').text(item.responseCount);
      }else if(item.flag == "question"){
        $('#number-of-user-questions').text(item.responseCount);
        $('.set-unreadquestion').text(item.responseCount);
        loadUserQuestions()
      }

      //Append reply
      if(item.userToken == userToken){
            console.log(resultData);
            let responseAvarta = setDoctorAvarta(item.responderType);
            $('#chat-box').append(`<div class="chat-group-divider">${item.messageDate}</div>
                <div class="media my_row">
                  <div class="avatar avatar-sm avatar-online">
                  ${responseAvarta}
                  </div>
                  <div class="media-body response-body">
                    <h6> ${item.fullName} <small> Now </small></h6>
                    <p>${item.fmtReply}</p>
                    <p></p>
                  </div>`);
      }

    });

    //Doctor Channel
    let doctorChannel = pusher.subscribe('doctors-reply');
    doctorChannel.bind('doctor-question-reply', function(data) {
      let resultData = JSON.stringify(data);
      let item = JSON.parse(resultData);
      $('#user-unread-reply').text(item.responseCount);

       let doctorReplyToken =  $('#doctor-reply-token').val();

       if(doctorReplyToken == item.userToken){

          let responseAvarta = setDoctorAvarta(item.responderType);
          $('#chat-box').append(`<div class="chat-group-divider">${item.messageDate}</div>
          <div class="media my_row">
            <div class="avatar avatar-sm avatar-online">
            ${responseAvarta}
            </div>
            <div class="media-body response-body">
              <h6> ${item.fullName} <small> Now </small></h6>
              <p>${item.fmtReply}</p>
              <p></p>
            </div>`);
        }



    });

}// End notifier

setNotifier();

    function showQuestionFollowupIcon(replied){
       let userReplied = replied;
       let followUpIcon =  '';
       if(userReplied === 1){
         followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>'
       }else{
        followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
       }
       return followUpIcon;
    }

    function loadUserQuestions(num=null){
         //Fetch question responses
      loadProgressBar();
      axios.get(`/get-user-questions/${num}`)
      .then(function (response) {

          let questionData = response.data.message_body.data;
            //Loop through the thread
          $('#question-body').html(' ');
          $(`.question-paginations-links`).html(' ');
          questionData.map((item, index) => {
           _isAnswered =  quetionAnswerStatus(status);
           let fullName = '';
           if(item.first_name == null ||  item.first_name == 'n/a' || item.first_name=='n_a' ||  item.last_name == 'n/a' || item.last_name=='n_a'){
              fullName = 'Anonymous';
           }else {
             fullName = item.first_name +' '+ item.last_name;
           }

            letQuestionDate =  (item.replied == 0)  ? item.created_at: item.updated_at;

            let followUpIcon = showQuestionFollowupIcon(item.replied);

            $('#question-body').append(`<tr>
            <td>  ${fullName} </td>
            <td> ${followUpIcon}  ${item.question_content} </td>

            <td> <span class="badge badge-primary"> ${item.question_answered} </span></td>
            <td> ${letQuestionDate}</td>


            <td> <a href="/doctor/reply/${item.question_id}/${fullName}/0" type="button" class="btn btn-xs btn-dark"><i class="fa fa-edit"></i></button> </td>
             <td>
              <button data-questionid="${item.question_id}" data-patient=${item.patient_id} type="button" class="btn btn-xs btn-danger remove-questions"> <i class="fa fa-trash"></i> </button>
            </td>
          </tr>`);

          });
          let questionMetaData  = response.data.message_body;
          let currentPage       = questionMetaData.current_page;
          let lastPage          = questionMetaData.last_page;
          let nextPageUrl         = questionMetaData.next_page_url;
          let previousPage      = questionMetaData.prev_page_url;
          let totalRecords      = questionMetaData.total;
          let fromP             = questionMetaData.from;
          let toP               = questionMetaData.to;
          let perPage           = questionMetaData.per_page;


          let previuosPage = currentPage - 1;
          let nextPage     = currentPage + 1;
          if(previousPage <= 0){
            previuosPage = 0;
            isDisabled = 'disabled';
          }else{
              isDisabled = ' ';
          }

          if(nextPage >= currentPage){
            nextPage = currentPage;
          }
            $(`.question-paginations-links`).append(`<li class="page-item ${isDisabled}">
            <a data-pagenumber="${previuosPage}" class="page-link page-link-icon fetch-page" href="#">
            <i class="fa fa-arrow-left"></i></a></li>`);


          for(let x=1; x <= lastPage; x++){
              $(`.question-paginations-links`).append(`
               <li class="page-item "><a data-pagenumber="${x}" class="page-link fetch-page" href="#${x}">${x}</a></li>
                `);
           }

           $(`.question-paginations-links`).append(`<li class="page-item">
            <a data-pagenumber="${nextPage}" class="page-link page-link-icon fetch-page" href="#${nextPage}">
            <i class="fa fa-arrow-right"></i></a></a></li>`);

      })
      .catch(function (error) {
        //console.log(error);
      });
    }

    loadUserQuestions();

    $('body').on('click','.fetch-page',function(){
      let ele = $(this);
      let pageNumber =   ele.data("pagenumber");

      loadUserQuestions(pageNumber);
    });

    function quetionAnswerStatus(status){
        let quesStatus = status;
        let isAnswered = '';
           switch(quesStatus){
            case "yes":
                isAnswered =`<span class="badge badge-primary"> Yes </span>`;
            break;

            case "no":
                isAnswered =`<span class="badge badge-danger"> No </span>`;
            break;

            case "no":
                isAnswered =`<span class="badge badge-danger"> No </span>`;
            break;

        }

        return isAnswered;
    }

    $('.add-media').on('click',function(e){
        loadProgressBar();
        e.preventDefault(); // avoid to execute the actual submit of the form.
        let quesId = $('#target-question-id').val();
         let formData = new FormData();
          formData.append("target_question", quesId);
          formData.append("file_upload",  document.getElementById('file_upload').files[0]);
          let spinner = $('.hide-spinner');
          $(this).html('')
          $(this).html('<i class="fas fa-spinner fa-pulse "></i>')
         let config = {
            onUploadProgress: function(progressEvent) {
              var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );

            }
          };

          axios.post('/addmedia', formData, config,{
              headers: {
                'Content-Type': 'multipart/form-data'
              }
          }).then(function (response) {

            if(response.data.success == true){
                toastr.success('File uploaded ');
                $('#question-content').val(' ');
                let userId = $('#target-user').val()
                fetchQusetionResponse(userId,quesId)
                var objDiv = $(".my_row");
                objDiv.scrollTop = objDiv.scrollHeight;

                $(this).html(' ');
                $('.add-media').text('Upload');
                $('#modalFileAttachment').modal('hide');
            }else{
                toastr.error('Unable to upload file');
                $(this).html(' ');
                $('.add-media').text('Upload');
            }

        });

    });


    $('#question-content').keypress(function(e){
      var key = e.which;
      if(key == 13)  // the enter key code
        {
          let responderId= $('#user-id').val();
          let userQuesId= $('#ques-id').val();
          let userQuestionContent = $('#question-content').val();

      postReply(responderId,userQuesId,userQuestionContent)
        }
    });

    $('.send-question-response').on('click',function(){

      let responderId= $('#user-id').val();
      let userQuesId= $('#ques-id').val();
      let userQuestionContent = $('#question-content').val();

      postReply(responderId,userQuesId,userQuestionContent)

    });



    function postReply(responderId,userQuesId,userQuestionContent){

      responder=responderId;
      questionId=userQuesId
      questionContent = userQuestionContent ;

      if(questionContent == ''){
        toastr.error('Add a message')
        return false;
    }

    if(responder == '' || questionId == ''){
        toastr.error('Please select a question')
        return false;
    }

        loadProgressBar();
        axios.post('/user/replyquestion', {
            userId: responder,
            questionId: questionId,
            questionContent: questionContent,
            responderType: 'user',
            patientId:''
        })
        .then(function (response) {
            if(response.data.success == true){
                toastr.success('Message Sent');
                $('#question-content').val(' ');
                //fetchQusetionResponse(responder,questionId);

            }else{
                toastr.error('Unable to send message. Please try again later');
            }

        })
        .catch(function (error) {
            //toastr.error('Error sending message')
        });
    }



    $('.sesa').on('click',function(){

     let oldPassword =  $('#old-password').val();
     let newPassword =  $('#new-password').val();
     let confirmPassword  = $('#confirm-password').val();
      if(oldPassword == ''){
            toastr.error('Enter your old password');
            return false;
        }
     let passwordConfimation =  validateConfirmPassword(newPassword,confirmPassword);
      if(passwordConfimation == true){
         //toastr.info('Password does not match');
            loadProgressBar();
             axios.post('/user/update-credentials', {
                old_password: oldPassword,
                new_password: newPassword
            })
            .then(function (response) {
                  console.log(response)
                if(response.data == '201'){
                    toastr.info(response.message);
                    location.reload();
                }else if(response.data == '404'){
                    toastr.error('Invalid Password');
                }else{
                    toastr.error('General Error');
                }

            })
            .catch(function (error) {

            });
      }else{

      }

    });


    function validateConfirmPassword(password,confirm_password){
      if(password != confirm_password){
        toastr.error('Password does not match');
        return false;
      }else{
        return true;
      }
    }



    function sendDoctorReply(doctorId,quesId,quesContent,patId){
      let responder = doctorId;
      let questionId= quesId;
      let questionContent = quesContent;
      let patientId    = patId;
      if(questionContent == ''){
        toastr.error('Add a message')
        return false;
    }

    if(responder == '' || questionId == ''){
        toastr.error('Please select a question')
        return false;
    }
        //loadProgressBar();
         axios.post('/user/replyquestion', {
            userId: responder,
            questionId: questionId,
            questionContent: questionContent,
            responderType: 'doctor',
            patientId:patientId
        })
        .then(function (response) {
            if(response.data.success == true){
                toastr.info('Message Sent');
                $('#doctor-question-content').val(' ');

                //fetchQusetionResponse(patientId,questionId);

            }else{
                toastr.error('Unable to send message. Please try again later');
            }

        })
        .catch(function (error) {

        });
    }


    $('.send-doctor-question-response').on('click',function(){

        let responder = $(this).data("doctorid");
        let questionId= $('#ques-id').val();
        let questionContent = $('#doctor-question-content').val();
        let patientId    = $('#user-id').val();

        sendDoctorReply(responder,questionId,questionContent,patientId);


    });

    $('#doctor-question-content').keypress(function(event){
      var keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
        let responder = $('.send-doctor-question-response').data("doctorid");
        let questionId= $('#ques-id').val();
        let questionContent = $('#doctor-question-content').val();
        let patientId    = $('#user-id').val();

        sendDoctorReply(responder,questionId,questionContent,patientId);
      }
  });


    $('.verify-user-code').on('click',function(){
        let msisdn = $('#user-phone').val();
        let verificationCode = $('#verification-code').val();
        let _token  = $('#user-token').val();

         if(verificationCode == '' ){
            toastr.error('Please enter your verification code');
            return false;
        }

            loadProgressBar();
            axios.post('/account/verify', {
                phone: verificationCode,
                code: verificationCode,
                token: _token
            })
            .then(function (response) {
                if(response.data.success == true){
                    toastr.success('Verification Successful');
                }else{
                    toastr.error('Unable to verify code. Please try again later');
                }
            })
            .catch(function (error) {

            });
    });






    function setAvarta(responderType){
        let userAvarta ='<span class="avatar-initial  rounded-circle"><i class="fa fa-user"></i> </span>';
        let doctorAvarta ='<span class="avatar-initial bg-primary rounded-circle"><i class="fa fa-stethoscope"></i> </span>';
        let avatar = '';
        if(responderType === "user"){
            avatar = userAvarta;
            return avatar;
        }else{
            avatar  = doctorAvarta;
            return avatar;
        }

    }


        function setDoctorAvarta(responderType){
        let userAvarta ='<span class="avatar-initial bg-site-primary rounded-circle "> <i class="fa fa-user"></i> </span>';
        let doctorAvarta ='<span class="avatar-initial  rounded-circle "> <i class="fa fa-stethoscope"></i> </span>';
        let avatar = '';
        if(responderType === "user"){
            avatar = userAvarta;
            return avatar;
        }else{
            avatar  = doctorAvarta;
            return avatar;
        }

    }


    function showAttachment(mediaType,mediaUrl,fileExtension){
        let fileType = mediaType;
        let mediaPort = '';
        let portType  = '';
        switch(fileType){
            case "image":
                mediaPort =`<img src="${mediaUrl}" class="card-img-top" alt="Image not Found">`
            break;

            case "audio":
                mediaPort =`<audio controls>
                <source src="${mediaUrl}">
              Your browser does not support the audio element.
              </audio>`
            break;

            case "doc":
                mediaPort =`<object data="${mediaUrl}" type=”pdf/html” width=”30%″ height=”50″>`
            break;

        }

        let displayPort  = `<div class="card col-sm-5">${mediaPort}
        <div class="card-body">
            <a href="${mediaUrl}" class="btn btn-default"><i class="fa fa-download"></i> </a>
        </div>
        </div>`;
        if(mediaUrl == "" || mediaUrl == "n/a" || mediaUrl == null){
            return  " ";
        }else{
            return displayPort;
        }


    }

    $('.add-response-file').on('click',function(e){
        // let ele = $('.fetch-question-response');
        // let user = ele.data("user");
        // let questionId = ele.data("quesid");
         $('#target-question-id').val(questionId);
    });

    $("#get-user-mic").on('click',function(e){

      var player = document.getElementById('audio-tag');
      player.currentTime = 0;



      let constraintObj = {
       audio: true,
       video: false
   };

   //handle older browsers that might implement getUserMedia in some way
   if (navigator.mediaDevices === undefined) {
       navigator.mediaDevices = {};
       navigator.mediaDevices.getUserMedia = function(constraintObj) {
           let getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
           if (!getUserMedia) {
               return Promise.reject(new Error('getUserMedia is not implemented in this browser'));
           }
           return new Promise(function(resolve, reject) {
               getUserMedia.call(navigator, constraintObj, resolve, reject);
           });
       }
   }else{
       navigator.mediaDevices.enumerateDevices()
       .then(devices => {
           devices.forEach(device=>{
               console.log(device.kind.toUpperCase(), device.label);
               //, device.deviceId
           })
       })
       .catch(err=>{
           console.log(err.name, err.message);
       })
   }

   navigator.mediaDevices.getUserMedia(constraintObj)
   .then(function(mediaStreamObj) {
       //connect the media stream to the first video element
       let video = document.querySelector('audio');
       if ("srcObject" in video) {
           video.srcObject = mediaStreamObj;
       } else {
           //old version
           video.src = window.URL.createObjectURL(mediaStreamObj);
       }

       video.onloadedmetadata = function(ev) {
           //show in the video element what is being captured by the webcam
          //  video.play();
       };

       //add listeners for saving video/audio
       let start = document.getElementById('btnStart');
       let stop = document.getElementById('btnStop');
      //  let vidSave = document.getElementById('vid2');
       let lableState = document.getElementById('media-state');
      //  var options = {
      //   mimeType: 'audio/MP3'
      // }
       let mediaRecorder = new MediaRecorder(mediaStreamObj);
      //  let uploadRecordedMedia = document.getElementById('add-recorded-media');

       let chunks = [];


       start.addEventListener('click', (ev)=>{
           mediaRecorder.start();

           lableState.innerHTML  = mediaRecorder.state.slice(0, 1).toUpperCase() + mediaRecorder.state.slice(1, mediaRecorder.state.length) +'...';
           // console.log(mediaRecorder.state);
           start.disabled = true;
           stop.disabled  = false;
       })
       stop.addEventListener('click', (ev)=>{
           mediaRecorder.stop();
           lableState.innerHTML  =' ';
           lableState.innerHTML  ='Stopped'
           start.disabled = false;
           stop.disabled  = true;

       });
       mediaRecorder.ondataavailable = function(ev) {
           chunks.push(ev.data);
       }
       mediaRecorder.onstop = (ev)=>{
           let blob = new Blob(chunks, {type:'audio/m4a codecs=mpeg4'});

           chunks = [];
          //  let videoURL = window.URL.createObjectURL(blob);
          //  vidSave.src = videoURL;
            sendRecordedBlob(blob)

       }



   })
   .catch(function(err) {
       console.log(err.name, err.message);
   });

    });




    function sendRecordedBlob(file){
      loadProgressBar();

      let quesId = $('#target-question-id').val();

      let formData = new FormData();

      formData.append("target_question", quesId);
      formData.append("file_upload",file,"fileee");

      let config = {
         onUploadProgress: function(progressEvent) {
           var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
         }
       };

       console.log(formData);
       axios.post('/addmedia', formData, config,{
           headers: {
             'Content-Type': `multipart/form-data; boundary=${formData._boundary}`,
           }
       }).then(function (response) {

         if(response.data.success == true){
             toastr.success('File uploaded ');
             $('#question-content').val(' ');
             let userId = $('#target-user').val()
             fetchQusetionResponse(userId,quesId);
             $('#modalAudioRecord').modal('hide');
             $("#frm-uploadaudio")[0].reset();
             var objDiv = $(".my_row");
             objDiv.scrollTop = objDiv.scrollHeight;
             document.getElementById('vid2').load();
         }else{
             toastr.error('Unable to upload file');
               //console.log(response.data)
         }
       })


    }


    function customTime(data){
       let date = moment().format(data, "MMM Do YYYY");
        return date;
    }

    $('#appointment-type').val('video');
    $('.app-type').on('click',function(e){
       let currentVal = $(this).val();
       $('#appointment-type').val(currentVal);
       //console.log(ele)
    });



    //     $('.book-appointment').on('click',function(e){
    //     loadProgressBar();
    //     e.preventDefault(); // avoid to execute the actual submit of the form.

    //      let userToken = $('#user-t').val();
    //      let formData = new FormData();

    //       formData.append("target_question", quesId);
    //       formData.append("file_upload",  document.getElementById('file_upload').files[0]);
    //       let spinner = $('.hide-spinner');
    //       $(this).html('')
    //       $(this).html('<i class="fas fa-spinner fa-pulse "></i>')

    //       axios.post('/addmedia', formData,{
    //           headers: {
    //             'Content-Type': 'multipart/form-data'
    //           }
    //       }).then(function (response) {

    //         if(response.data.success == true){
    //             toastr.success('File uploaded ');
    //         }else{
    //             toastr.error('Unable to upload file');
    //         }

    //     });

    // });

    function getAllQuestions(){
      if ( $.fn.dataTable.isDataTable( '.question-list' ) ) {
            tab_page = $('.question-list').DataTable();
            tab_page.destroy();
          }
        $('.question-list').DataTable({
             processing: true,
             serverSide: true,
             "columnDefs": [
              { "searchable": false, "targets": 0 }
            ],
             "ordering": true,
             ajax: '/fetchall-questions',
                columns: [
                {data: 'fullname', name: 'fullname'},
                //{data: 'username', name: 'username'},
                {data: 'question_content', name: 'question_content'},
                {data: 'answered', name: 'answered'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'details', name: 'details'}
            ]

           });
     }



     function getFollowUpQuestions(){
       if ( $.fn.dataTable.isDataTable( '.question-list-covid-followup' ) ) {
             tab_page = $('.question-list-covid-followup').DataTable();
             tab_page.destroy();
           }

         $('.question-list-covid-followup').DataTable({
              processing: true,
              serverSide: true,
              "columnDefs": [
               { "searchable": false, "targets": 0 }
             ],
              "ordering": true,
              ajax: '/fetchall-patient-follow-up-questions',
                 columns: [
                 {data: 'fullname', name: 'fullname'},
                 //{data: 'username', name: 'username'},
                 {data: 'question_content', name: 'question_content'},
                 {data: 'answered', name: 'answered'},
                 {data: 'updated_at', name: 'updated_at'},
                 {data: 'details', name: 'details'}
             ]
            });
      }



     getAllQuestions();
     getFollowUpQuestions();


     function getUnansweredQuestions(){
      if ( $.fn.dataTable.isDataTable( '.question-list-0' ) ) {
        tab_page = $('.question-list-0').DataTable();
        tab_page.destroy();
      }
    $('.question-list-0').DataTable({
         processing: true,
         serverSide: true,
         "columnDefs": [
          { "searchable": false, "targets": 0 }
        ],
         "ordering": true,
         ajax: '/fetchall-unanweredquestions',
            columns: [
            {data: 'username', name: 'username'},
            {data: 'question_content', name: 'question_content'},
            {data: 'answered', name: 'answered'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'details', name: 'details'}
        ]

       });
     }

     getUnansweredQuestions();

    $('#datepicker5').datepicker({
      showButtonPanel: true
    });

    setInterval(function(){ $('.alert').alert('close') }, 5000);



});
