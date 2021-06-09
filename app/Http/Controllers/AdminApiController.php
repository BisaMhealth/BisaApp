<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Admin;
use App\Models\SubscriptionPlans;
use App\Core\GlobalService;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\SmsVerficication;
use App\Helpers\CustomSMS;
use App\Helpers\CustomMailer;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;


class AdminApiController extends Controller
{
  use GlobalService;
    public function create(Request $request){

      try{
        if (Admin::where('admin_email', $request->email)->exists() ) {
          $response_message =  array('success' => false, 'message' => "Email already taken");
          return response()->json($response_message);
        }else{
                $validator = Validator::make($request->all(), [
                    'firstName' => 'required',
                    'lastName' => 'required',
                    'email'=>'required',
                    'password'=>'required',
                    'country'=>'required',
                    'phone'=> 'required',
                    'adminType'=>'required'
                ]);

                $errors = $validator->errors();
                if ($validator->fails()) {
                    $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Parameter Values','errors'=>$errors);
                    return response()->json($response_message);

                 }

                 $admin = new Admin();
                 $hashedPassword  = Hash::make($request->password);
                 $token = substr(md5(time()),0, 60);
                 $username = substr($request->firstName, 0, 3).substr($request->lastName,0,3)."_".substr(md5(time() + rand()), 0, 4);
                 $now = $this->longDate();
                 $admin->first_name       =   $this->sanitizeString($request->firstName);
                 $admin->last_name        =   $this->sanitizeString($request->lastName);
                 $admin->admin_username   =   $username;
                 $admin->phone            =   $this->sanitizeString($request->phone);
                 $admin->admin_email      =   $this->sanitizeString($request->email);
                 $admin->admin_password   =   $hashedPassword;
                 $admin->admin_type       =   $this->sanitizeString($request->adminType);
                 $admin->created_at       =   $now;
                 $admin->token            =   $token;

                 $userProfile = new User();
                 $userStatus = 0;
                 if($admin->save()) {
                   $verificationCode = rand(1000, 9999);
                   $activateAccount = $userProfile->createUser($username,$request->email,$hashedPassword,'admin',$admin->admin_id,$token,$userStatus,$verificationCode);

                   $response_message =  array('success' => true, 'message' => 'Signup successful',
                   'userType' => 'admin', 'adminType'=>$admin->admin_type, 'userToken'=> $token, 'userId' => $admin->admin_id,'phone'=>$admin->phone,
                   'email'=>$admin->admin_email,'verificationCode'=>$verificationCode ,'username'=> $username);

                   return response()->json($response_message);
                 }

        }
      }catch(\Exception $e){
        $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Error '.$e->getMessage());
        $data = ['ERROR INFO'=>$e->getMessage(), 'REQUEST DATA'=>$request->all()];
        $this->logMessageRequest($data,'Error Inserting Records');
        return response()->json($response_message);
      }

    }

    public function questionCategoryStatsByYear($startDate,$endDate){
      try{
          $data = DB::select("SELECT C.category_name, count(Q.question_id) AS question_count FROM questions AS Q
          JOIN question_categories AS C ON C.category_id = Q.question_cat_id
          WHERE Q.created_at BETWEEN '$startDate' AND '$endDate'
          GROUP BY Q.question_cat_id,C.category_name ");

          $response_message =  array('statusCode'=>201,'success' => true, 'data' =>$data);
          return response()->json($response_message);
      }catch(\Exception $e){
        $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Error ');
        $this->logMessageRequest($e->getMessage(),'Error Fetching Records');
        return response()->json($response_message);
      }

    }


    public function quesCountByMonth($startDate,$endDate){
      try{
          $data = DB::select("SELECT DATE_FORMAT(Q.created_at, '%M') AS month, count(*) AS question_count FROM questions AS Q
          JOIN question_categories AS C ON C.category_id = Q.question_cat_id
          WHERE Q.created_at BETWEEN '$startDate' AND '$endDate'
          GROUP BY  MONTH(Q.created_at)");

          $response_message =  array('statusCode'=>201,'success' => true, 'data' =>$data);
          return response()->json($response_message);
      }catch(\Exception $e){
        $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Error ');
        $this->logMessageRequest($e->getMessage(),'Error Fetching Records');
        return response()->json($response_message);
      }
    }


    public function userCount(){
      try{
          $userCounntArr = [];
          $userCountByRole = DB::select("SELECT SUM(IF(role = 'admin', 1, 0)) AS admins,SUM(IF(role = 'doctor', 1, 0)) AS doctors,
SUM(IF(role = 'patient', 1, 0)) AS patients
FROM sys_users;");

          foreach ($userCountByRole as $key => $value) {
            $userCounntArr['admins'] =  $value->admins;
            $userCounntArr['patients'] =  $value->patients;
            $userCounntArr['doctors'] =  $value->doctors;
          }

          $patientCountArr=[];
          $countPatientsByGender = DB::select("SELECT SUM(IF(gender LIKE 'male', 1, 0 )) AS males,SUM(IF(gender = 'female', 1, 0)) AS females,
          SUM(IF(gender = 'n_a' || gender = 'n/a' , 1, 0)) AS anonymous FROM patients");
          foreach ($countPatientsByGender as $key => $patientValue) {
            $patientCountArr['males'] = $patientValue->males;
            $patientCountArr['females'] = $patientValue->females;
            $patientCountArr['anonymous'] = $patientValue->anonymous;
          }

          $countDoctorsByGender = DB::select("SELECT SUM(IF(gender = 'male', 1, 0)) AS males,SUM(IF(gender = 'female', 1, 0)) AS females,
SUM(IF(gender = 'n_a' || gender = 'n/a' , 1, 0)) AS anonymous
FROM doctors");
          $docCountArr=[];
          foreach ($countDoctorsByGender as $key => $doctorValue) {
            $docCountArr['males'] = $doctorValue->males;
            $docCountArr['females'] = $doctorValue->females;
            $docCountArr['anonymous'] = $doctorValue->anonymous;
          }

          $countAdminsByGender = DB::select("SELECT SUM(IF(gender = 'male', 1, 0)) AS males,SUM(IF(gender = 'female', 1, 0)) AS females,
SUM(IF(gender = 'n_a' || gender = 'n/a' , 1, 0)) AS anonymous
FROM admins");

        $adminsCountArr=[];
        foreach ($countAdminsByGender as $key => $adminValue) {
          $adminsCountArr['males'] = $adminValue->males;
          $adminsCountArr['females'] = $adminValue->females;
          $adminsCountArr['anonymous'] = $adminValue->anonymous;
        }

          $data = ['userCountByRole'=>$userCounntArr,'countPatientsByGender'=>$patientCountArr,
          'countDoctorsByGender'=>$docCountArr,'adminsCountArr'=>$adminsCountArr];
          $response_message =  array('statusCode'=>201,'success' => true,'data'=>$data);

          return response()->json($response_message);
      }catch(\Exception $e){
        $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Error ');
        $this->logMessageRequest($e->getMessage(),'Error Fetching Records');
        return response()->json($response_message);
      }
    }


    public function responseStats($startDate,$endDate){
      try{
                $data = DB::select("SELECT CONCAT_WS(' ',D.first_name,D.last_name) As fullname,R.responder_id,R.responder_type,COUNT(R.question_response_id) questions_answered
        FROM question_responses AS R
        JOIN doctors AS D ON D.doctor_id = R.responder_id
        WHERE R.responder_type = 'doctor' AND R.created_at BETWEEN '$startDate' AND '$endDate'
        GROUP BY R.responder_id");

        $response_message =  array('statusCode'=>201,'success' => true,'data'=>$data);
        return response()->json($response_message);

      }catch(\Exception $e){
        $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Error '.$e->getMessage());
        $this->logMessageRequest($e->getMessage(),'Error Fetching Records');
        return response()->json($response_message);
      }
    }


}
