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
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
   use AuthenticatesUsers;
   use GlobalService;
   use MakesApiRequest;

  public function showDoctorDashboard(){

     $countUserQuestions = $this->countAllUserQuestions();
     $ureadQuestionsGlobal = $countUserQuestions->messageCount;

     $questionDailyCount  =  $this->getQuestionDailyCount();

     $totalDailQues  = $questionDailyCount->data->totalQuestions;
     $toatalResponses = $questionDailyCount->data->responses;

     $allArticles    =  $this->countAllArticles();
 		 $countArticles  =  $allArticles->article_count;

     $hospitalId     =  Session::get('hospital_id');
     $appointments   = $this->fetchAppointmentByHospitalId($hospitalId);
     $hospitalAppointments= $appointments->data;

     $allQuestions = count($this->retriveAllQuestions());
     $allCovidQuestions = count($this->retriveUnansweredCovidQuestions());


     $avgResponseTime = $this->getAverageResponseTime();
     $fmtAvgResponseTime = date('H:i',strtotime($avgResponseTime));



     Session::put('number_unread_question_global',$countUserQuestions->messageCount);

	   return view('layouts.doctor.doctor_home',compact('allCovidQuestions','allQuestions','hospitalAppointments','countArticles','ureadQuestionsGlobal','totalDailQues','toatalResponses','fmtAvgResponseTime'));
	}

  public function showUsersQuestions(){

  	 return view('layouts.doctor.show_users_questions');
  }

  public function fetchUserQuestions($pagenumber=null){
  	 $responseData = $this->fetchAllUserQuestions($pagenumber);
  	 $results = $responseData;
  	 return $results;
  }

  public function showCovidQuestion(){
     return view('layouts.doctor.view_covid');
  }

  public function showDoctorReplyForm($questioncode,$fullname,$isfollowup=null){
     $connectionType= $this->getLocalConnection();
     $fullName = $fullname;
  	 $questions = DB::connection($connectionType)->table('questions')->where('question_code','=',$questioncode)->orWhere('question_id','=',$questioncode)->get();



     $userId ='';
     $questionId='';
     foreach ($questions as $key => $value) {
     	 $userId     = $value->patient_id;
     	 $questionId = $value->question_id;
     }

     $response =  $this->getQuetionResponses($userId,$questionId);
     
    //  dd($response);

  	 $userQuestions = $this->getUserQuestions($userId);


     $questions  =  $userQuestions->data;


  	 return view('layouts.doctor.doctor_reply_form',compact('questionId','userId','fullName','response','questions','isfollowup'));


	}


  public function showDoctorProfilePage(){
    $connectionType= $this->getLocalConnection();
    $userId   = Session::get('user_id');
    $response  = $this->fetchDoctorDetails($userId);


    $countries = \DB::connection($connectionType)->table('tab_country')->select('ctryid','country')->get();

    if($response->success == true){
      $doctorDetails = $response->data;
      return view('layouts.doctor.doctor_profile',compact('doctorDetails','countries'));
    }else{
        Session::flash('message_error', 'Impossible de charger votre profil');
        return redirect()->back();
    }

  }



  public function showDoctorWorkFlow(){

    return view('layouts.doctor.my_workflow');
  }



  public function updateDoctorProfile(Request $request){
        $validator = Validator::make($request->all(), [
          'first_name' => 'required',
          'last_name' => 'required',
          'email' => 'email',
          'phone' => 'required',
          'gender' => 'required',
          'country' => 'required'
      ]);
     if ($validator->fails()) {
          Session::flash('message_error', __('Submission failed. Please correct any errors on the form and try again'));
          return redirect()->back()->withErrors($validator)->withInput();
      }
      $first_name  =	$this->sanitizeString($request->first_name);
      $last_name  =	$this->sanitizeString($request->last_name);
      $email  =	$this->sanitizeString($request->email);
      $phone  =	$this->sanitizeString($request->phone);
      $gender  =	$this->sanitizeString($request->gender);
      $country  =	$this->sanitizeString($request->country);
      $address  =	$this->sanitizeString($request->address);
      $bio  =	$this->sanitizeString($request->bio);

        $data = [
          'doctorId'=>Session::get('user_id'),
          'firstName'=>$first_name,
          'lastName'=>$last_name,
          'phone'=>$phone,
          'email'=>$email,
          'country'=>$country,
          'gender'=>$gender,
          'bio'=>$bio,
          'address'=>$address,
          'token'=> Session::get('user_token')
        ];

        $response = $this->updateDoctorDetails($data);
        if($request->statusCode == 201){
           Session::flash('message', __('Record successfully updated'));
           return redirect()->back();
        }else{
          Session::flash('error_message', __('Unable to update record'));
          return redirect()->back();
        }

  }



  public function closeCurrentQuestion(Request $request){

    $response = $this->closeCurrentQuestionThread($request->questionId);
    if($response->statusCode == 200){
       Session::flash('message', __('Question closed successfully'));
       return '200';
    }else{
      Session::flash('error_message', __('Unable to close the current  question'));
      return '500';
    }


  }





}//End
