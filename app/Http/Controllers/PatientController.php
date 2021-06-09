<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Core\GlobalService;
use App\Core\MakesApiRequest;
use Illuminate\Support\Facades\Session;
use App\Events\UserReply;
use App\Events\DoctorReplay;
use App\Events\QuestionRead;

class PatientController extends Controller
{
   use AuthenticatesUsers;
   use GlobalService;
   use MakesApiRequest;

   public function index(Request $request){
      $userId        = Session::get('user_id');
      $userQuestions = $this->getUserQuestions($userId);
      $questionCategories = $this->getQuestionCategories();
      $getQuestionsCategory = $questionCategories->data;

      $questions  =  $userQuestions->data;
      return view('layouts.patients.charthistory',compact('questions','getQuestionsCategory'));

   }



  public function fetchQuestionResponse($userid,$quesid){
      $response = $this->getQuetionResponses($userid,$quesid);
      echo json_encode($response);

      $patientUnreadMessage = $this->getReponseCountAll();
      $allUnreadMessages = $patientUnreadMessage->messageCount;
      Session::put('user_unreadmessages',$allUnreadMessages);

      $countUserQuestions = $this->countAllUserQuestions();
      $countAllQuestionsGlobal = $countUserQuestions->messageCount;
      Session::put('number_unread_question_global',$countAllQuestionsGlobal);

      $unreadMessages =  $this->userUnreadMessages($userid);
      $userUnreadMessages = $unreadMessages->messageCount;

      event(new QuestionRead($allUnreadMessages,$countAllQuestionsGlobal,$userUnreadMessages));
  }

  public function submitUserQuestion(Request $request){
         $validator = Validator::make($request->all(), [
            'question_category' => 'required',
            'question' => 'required',
      ]);

      if ($validator->fails()) {
         Session::flash('message_error', __('Submission failed. Please correct any errors on the form and try again'));
            return redirect('patient/chathistory')
                        ->withErrors($validator)
                        ->withInput();
      }else{
         $questionCategory = $this->sanitizeString($request->question_category);
         $question = $this->sanitizeString($request->question);
         $userId = Session::get('user_id');
         $userToken = Session::get('user_token');
         $isFollowUp = Session::get('is_follow_up');
         $mediaUrl = 'n/a';
         $fileType = 'n/a';
         $extension = 'n/a';
            try{
            //Check for file attachment and add to bucket

            if($request->hasFile('image')){

               $public_id = "bisa_question_media_".time();
               $extension = $request->image->extension();

               $fileType  = $this->getFileType($extension);
               $public_id = $userId."_media_".time();
               switch ($fileType) {
                        case "image":
                           \Cloudder::upload($request->file('image')->getRealPath(),$public_id,array('folder'=>'questions_media'));
                           break;

                        case "audio":
                           \Cloudder::upload($request->file('image')->getRealPath(),$public_id ,array("resource_type" => "video",'folder'=>'media_av'));
                           break;

                        case "file":
                           \Cloudder::upload($request->file('image')->getRealPath(),$public_id ,array("resource_type" => "raw",'folder'=>'media_av'));
                           break;

                        case "doc":
                           \Cloudder::upload($request->file('image')->getRealPath(),$public_id ,array("resource_type" => "raw",'folder'=>'media_av'));
                           break;

                        default:
                        Session::flash('message_error', __('Unsupported file format') );
                        return redirect('patient/chathistory');
                  }

                  $c=\Cloudder::getResult();

                  $mediaUrl = $c['secure_url'];


                  }
            //Add question
            $data  = [
               'userId'=> $userId,
               'questionCategoryId'=>$questionCategory,
               'questionContent'=>$question,
               'mediaUrl'=>$mediaUrl,
               'fileType'=>$fileType,
               'fileExtension'=>$extension,
               'isFollowUp'=>$isFollowUp
               ];

               $response =  $this->submitQuestion($data);
                  if($response->success == true){
                     Session::flash('message', $response->message);
                     $fullName = Session::get('full_name');
                           $messageDate = date('M d, Y h:i a');

                           $message = $this->countAllUnreadQuestions();
                           $responseCount = $message->messageCount;
                           if(strlen($question) >= 80){
                              $fmtReply = substr($question, 0, 99). " ... " ;
                           }else{
                              $fmtReply = $question;
                           }
                           $flag = 'question';
                           $quesId = '0';
                           // event(new UserReply($fullName,$fmtReply,$responseCount,$messageDate,$flag));
                           $responderType='user';
                          event(new UserReply($fullName,$fmtReply,$responseCount,$messageDate,$flag,$quesId,$responderType,$userToken));


                     return redirect('patient/chathistory');

                  }else{
                     Session::flash('message_error', $response->message);
                     return redirect('patient/chathistory');
                  }

                }catch(\Exception $e){
                   Session::flash('message_error', __('Unable to save request! ... Please check your Internet connection and try again'));
                   return redirect('patient/chathistory');
                 }


      }
  }

  public function addMedia(Request $request){
   $userId     = Session::get('user_id');
   $userRole =  Session::get('user_role');
   $questionId = $request->target_question;
   $public_id  = $userId."_media_".time();
   $mediaUrl = 'n/a';
   $fileType = 'n/a';
   $extension = 'n/a';
   $questionContent = ' ';
   $responderType = 'user';

    if($userRole == 'doctor'){
      $responderType = 'doctor';
    }

      try{
         if($request->hasFile('file_upload')){
            $public_id = "bisa_question_media_".time();
            $extension = $request->file_upload->extension();
            $responder = 'user';
            $fileType  = $this->getFileType($extension);

            switch ($fileType) {
                     case "image":
                        \Cloudder::upload($request->file('file_upload')->getRealPath(),$public_id,array('folder'=>'questions_media'));
                        break;

                     case "audio":
                        \Cloudder::upload($request->file('file_upload')->getRealPath(),$public_id ,array("resource_type" => "video",'folder'=>'media_av'));
                        break;

                     case "file":
                        \Cloudder::upload($request->file('file_upload')->getRealPath(),$public_id ,array("resource_type" => "raw",'folder'=>'media_av'));
                        break;

                     case "doc":
                        \Cloudder::upload($request->file('file_upload')->getRealPath(),$public_id ,array("resource_type" => "raw",'folder'=>'media_av'));
                        break;

                     default:
                     Session::flash('message_error', __('Unsupported file format') );
                     return redirect('patient/chathistory');
               }

               $c=\Cloudder::getResult();
               $public_id = $userId."media_".time();
               $mediaUrl = $c['secure_url'];

               $response = $this->userQuestionMediaUpload($userId,$questionId,$questionContent,$mediaUrl,$fileType,$extension,$responderType);
               return $response;

               }else{
                  $response_message =  array('success' => false, 'message' => __('Unable to upload file Please check your Internet connection and try again') );
                  return response()->json($response_message);
               }
      }catch(\Exception $e){
         $response_message =  array('success' => false, 'message' => __('Unable to download file Please check your Internet connection and try again') );
         return response()->json($response_message);
      }



      }



  public function getFileType($fileExtenttion){
     $extension  = $fileExtenttion;
     $imageTypes = array("png", "PNG", "jpg", "JPG","gif","GIF","bmp","BMP","jpeg","JPEG");
     $docTypes   = array("pdf", "PDF", "doc", "DOC","docx","DOCX","xlsx","XLSX","xls","XLS");
     $audio      = array("oga","M4A", "m4a", "MP3", "mp3","flac","FLAC","WAV","wav","aac","AAC","mpga","MPGA","webm");
     //$video      = array("FLV","flv","MOV","QT","qt","WEBM", "webm", "MPG", "mpg","MPEG","mpeg","mp4","MP4","AVI","avi","WMV","wmv");

          if($extension == "oga"){
            return "audio";
          }

         if (in_array($extension, $imageTypes))
         {
            return "image";
         }
         elseif(in_array($extension, $docTypes))
         {
            return "doc";
         }
         elseif(in_array($extension, $audio)){
            return "audio";
         }
         else{
            return  "n/a";
         }
  }

  public function postUserQuestionReply(Request $request){
    $responder = $this->sanitizeString($request->userId);
    $quesId = $this->sanitizeString($request->questionId);
    $questionContent = $this->sanitizeString($request->questionContent);
    $responderType = $this->sanitizeString($request->responderType);
    $patientId = $this->sanitizeString($request->patientId);

    $responseData = $this->userQuestionReply($responder,$quesId,$questionContent,$responderType,$patientId);
     if(strlen($questionContent) >= 80){
      $fmtReply = substr($questionContent, 0, 99). " ... " . substr($questionContent, -1);
    }else{
      $fmtReply = $questionContent;
    }
      echo $responseData;

      $eventHandler = $this->userReplyEvent($fmtReply,$questionContent,$quesId,$responderType,$responder,$patientId);

   }


   public function userReplyEvent($fmtReply,$questionContent,$quesId,$responderType,$responder,$patientId){

    $fullName = Session::get('full_name');
    $userToken = Session::get('user_token');
    $messageDate = date('M d, Y h:i a');

    $flag = 0;
    $message = $this->getReponseCountAll();
    $responseCount = $message->messageCount;

    $flag = 'reply';


      switch ($responderType) {
        case 'user':
           event(new UserReply($fullName,$questionContent,$responseCount,$messageDate,$flag,$quesId,$responderType,$userToken));
          break;

        case 'doctor':
            $drName = 'Dr '.$fullName;
            $unreadMessages =  $this->userUnreadMessages($patientId);
            $responseCount = $unreadMessages->messageCount;
            event(new DoctorReplay($drName,$questionContent,$responseCount,$messageDate,$flag,$quesId,$responderType,$userToken));
          break;

        default:

          break;
      }
   }




   public function showFollowUpList(){
     $userData  =  $this->fetchUsers(1);

     return view('layouts.patients.covid_followup',compact('userData'));
   }






}
