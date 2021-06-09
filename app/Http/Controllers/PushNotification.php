<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;
use App\Models\Client;
use App\Models\Device;
use App\Models\Doctor;
use App\Models\Question;
class PushNotification extends Controller
{
       public function sendPushNotification($docId,$questionId,$responseContent){


        $doctorResponse=$responseContent;
        //Fetch Doctor
        $doctor = Doctor::where('doctor_id', '=', $docId)->first();
        $firstName = $doctor->first_name;
        $lastName  = $doctor->last_name;

        $fullName = 'Dr. '.$firstName .' '.$lastName;

        //Fetch Questiondetails
        $question = Question::where('question_id', '=', $questionId)->first();
        $patientId = $question->patient_id;



        $device = Device::where('patient_id', '=', $patientId)->first();

        $questionData  = ['question_id'=>$questionId,'patient_id'=>$patientId,'question_response'=>$responseContent];
        $questionAsked = $question->question_content;


        if(!empty($device)){
           $deviceToken = $device->token;
           $firebase = new FirebaseService;
           //$response = $firebase->processNotification($deviceToken,$questionId,$patientId,$questionAsked,$fullName,$doctorResponse);
           $response = $firebase->processFCMNotification($deviceToken,$responseContent,$fullName,$questionId);

        }else{
            return "Device not found";
        }


    }


    public function sendFcm(){
      $firebase =  new FirebaseService;
      $token = 'ctupXD5hBFE:APA91bGBc2xrBJiikqDJi1n0ImRvQ7ifyFBVj3XqPW1qfdEd_3p0OYO5vo6Sui9LybmQF6wZQoxLEjfq8MyFqnTLQ0oMvDLjMK0Pn7CGwBVLHhEf-1PS9vMarWQatjMaEWs8Y3C2lEKe';
      $response =  $firebase->processFCMNotification($token,'Sample','Test123');
      return $response;
    }


}
