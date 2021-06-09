<?php

namespace App\Core;

use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Core\GlobalService;
use Carbon\Carbon;
use App\Models\User;
use App;
use Illuminate\Support\Facades\Session;


trait GlobalService
{



    // public function getRowCount($modelName){
    //     $model = $modelName;
    //     $key = mt_rand();
    //     $hospitals = $model::all()->count();
    //     $uniqueKey = implode('-', str_split(substr(strtolower(md5(microtime().$key)), 0, 16), 8));
    //     echo $hospitals;
    //     exit();
    // }

    public function getLocalConnection(){
        if (App::isLocale('en')) {
            $connection = "mysql";
         }elseif(App::isLocale('fr')){
            $connection = "mysql_sn";

         }else{
            $connection = "mysql";
         }
         return $connection;

    }

    public function formatPhone($number){
        $contact = substr($number,1);
        if (App::isLocale('en')) {
            $fmtContact = '233'.$contact;
         }elseif(App::isLocale('fr')){
            $fmtContact = '221'.$contact;

         }else{
            $fmtContact = '233'.$contact;
         }

        return $fmtContact;
    }

    public function getclientip(){

        $clientIP = \Request::getClientIp(true);
        return $clientIP;

    }


          public function logMessageRequest($data,$lable){
           date_default_timezone_set("Europe/London");
            $date = date('Y-m-d');

            $ipAddress = $this->getClientIp();

            $filename = "applogs/log".$date."."."log";
            $content = ['Info'=>$lable,'Message'=>$data,'Ip::'=>$ipAddress];
            $content_json = json_encode($content);
            $myfile = fopen($filename, "a") or die("Unable to open file!");
            fwrite($myfile, "\n". $content_json);
            fclose($myfile);

        }




           public function logUserActivities($data,$lable){
           date_default_timezone_set("Europe/London");
            $date = date('Y-m-d');
            $username = session()->get('userid');
            $filename = "../userActivitylogs/".$username.$date."."."log";
            $content = ['Activity'=>$lable,'Info'=>$data];
            $content_json = json_encode($content);
            $myfile = fopen($filename, "a") or die("Unable to open file!");
            fwrite($myfile, "\n". $content_json);
            fclose($myfile);

        }

        public function myDates(){
            date_default_timezone_set("Europe/London");
            $now = date('Y-m-d');
            return $now;
        }


        public function myDatesGregorian(){
            date_default_timezone_set("Europe/London");
            $now = date('M-d-Y');
            return $now;
        }

        public function longDate(){
            date_default_timezone_set("Europe/London");
            $nowWithTime = date('Y-m-d H:i:s');
            return $nowWithTime;

        }

        public function timeOnly(){
            date_default_timezone_set("Europe/London");
            $time = date('H:i:sa');
            return $time;
        }

        public function formatCustomDate($data){
            $date=date_create($data);
            $res=  date_format($date,"Y-m-d");
            return $res;
        }

        public function formatCustomDateOnly($data){
            $date=date_create($data);
            $res=  date_format($date,"Y-m-d");
            return $res;
        }

        public function formatCustomTime($data){
            $date=date_create($data);
            $res=  date_format($date,"H:i:sa");
            return $res;
        }


         public function formatCustomDateText($data){
            $date=date_create($data);
            $res=  date_format($date,"M-d-Y");
            return $res;
        }

        public function createDateFormatFromString($data){
            $datetimeobj = date('Y-m-d',$data);
            return $datetimeobj;
        }

        public function sanitizeString($string){
            $sanitizedString = filter_var($string, FILTER_SANITIZE_STRING);
            return $sanitizedString;
        }


        public function sendPushNotification(){

        }

        public function checkUserSubscription($userToken){
            //Get patient subscription details

        }

        public function fetchUserWithRoles($userRole,$userId){
            $connectionType=  $this->getLocalConnection();
            switch($userRole){
                case 'patient':
                    $userData = DB::connection($connectionType)->table('sys_users')->join('patients', 'sys_users.token', '=', 'patients.token')->select('sys_users.email','sys_users.username','sys_users.role', 'patients.first_name','patients.last_name')->where('sys_users.email','=',$userId)->orWhere('sys_users.username','=',$userId)->get();
                    return $userData;
                break;

                case 'hospital_admin':
                    // $userData = DB::table('sys_users')->join('patients', 'sys_users.token', '=', 'patients.token')->select('sys_users.email','sys_users.username','sys_users.role', 'patients.first_name','patients.last_name')->get();
                    // return $userData;
                break;
            }
        }


        public function fetchUsers($type){
            $connectionType=  $this->getLocalConnection();
            $userType =  $type;
            $userData = DB::connection($connectionType)->table('sys_users')->join('patients', 'sys_users.token', '=', 'patients.token')->select('sys_users.email','sys_users.username','sys_users.role', 'patients.first_name','patients.last_name','patients.email','patients.address','patients.phone')->where('patients.follow_up','=',$userType)->get();
            return $userData;
        }


				public function retriveAllQuestions(){
          $connectionType=  $this->getLocalConnection();

					$questions = DB::connection($connectionType)->table('questions')->join('patients', 'patients.user_id', '=', 'questions.patient_id')
        ->select('questions.*', 'patients.first_name', 'patients.last_name','patients.username','patients.date_of_birth')->orderByDesc('questions.updated_at')->get();

					return $questions;

          }

        public function retriveUnansweredQuestions(){
          $connectionType=  $this->getLocalConnection();
					$data = DB::connection($connectionType)->table('patients')->join('questions', 'patients.user_id', '=', 'questions.patient_id')
        ->select('questions.*', 'patients.first_name', 'patients.last_name','patients.username','patients.date_of_birth')->where('questions.question_answered','=','no')->where('questions.question_closed','=','no')->get();

					return $data;

          }

        public function retriveUnansweredCovidQuestions(){
          $connectionType=  $this->getLocalConnection();
           $data = DB::connection($connectionType)->table('patients')->join('questions', 'patients.user_id', '=', 'questions.patient_id')
                  ->select('questions.*', 'patients.first_name', 'patients.last_name','patients.username','patients.date_of_birth')->where([['questions.question_answered', '=', 'no'],['questions.question_content', 'LIKE', '%covid%']])->get();

           return $data;

          }



          public function getWorkflowItems($userId){
            $connectionType=  $this->getLocalConnection();
  					$data = DB::connection($connectionType)->table('patients')->join('questions', 'patients.user_id', '=', 'questions.patient_id')->join('pvt_workflow','pvt_workflow.ques_id','=','questions.question_id')
          ->select('questions.*', 'patients.first_name', 'patients.last_name','patients.username','patients.date_of_birth')->where('pvt_workflow.doctor_id','=',$userId)->orderBy('questions.updated_at','DESC')->get();

  					return $data;

            }


          public function retriveUnansweredFollowUpQuestions(){
          $connectionType=  $this->getLocalConnection();
          $data = DB::connection($connectionType)->table('patients')->join('questions', 'patients.user_id', '=', 'questions.patient_id')
        ->select('questions.*', 'patients.first_name', 'patients.last_name','patients.username')->where('questions.question_answered','=','no')->where('questions.is_follow_up','=',1)->get();

          return $data;

          }

          public function countQuestionGlobal(){
            $connectionType=  $this->getLocalConnection();
            $quesCount = \DB::connection($connectionType)->table('questions')->count();
            return $quesCount;
          }

          public function getAverageResponseTime(){
               $connectionType=  $this->getLocalConnection();
               $s_date = date('Y-01-01');  $e_date=date('Y-12-31');
               $userId   = Session::get('user_id');
               $avgResponseTime = \DB::connection($connectionType)->table('question_responses')->selectRaw('SEC_TO_TIME(AVG(TIME_TO_SEC(`created_at`))) AS avg_response_time')->where('responder_type','=','doctor')
               ->where('responder_id','=',$userId)->whereBetween('created_at', [$s_date, $e_date])->first();
               return $avgResponseTime->avg_response_time;

          }

}


?>
