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


trait GlobalService
{



    public function getRowCount($modelName){
        $model = $modelName;
        $key = mt_rand();
        $hospitals = $model::all()->count();
        $uniqueKey = implode('-', str_split(substr(strtolower(md5(microtime().$key)), 0, 16), 8));
        echo $hospitals;
        exit();
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

        public function getUserContact($userId){
          $userContact = DB::table('patients')->select('phone')->where('user_id','=',$userId)->first();
          if($userContact){
            return $userContact->phone;
          }else{
            return null;
          }

        }

        public function fetchUserWithRoles($userRole,$userId){
            try{
                $userDataArr =  [];
               switch($userRole){
                case 'patient':


                    $userData = DB::table('sys_users')->join('patients', 'sys_users.token', '=', 'patients.token')->select('patients.address','patients.country','patients.gender','sys_users.email','sys_users.username','sys_users.role', 'patients.first_name','patients.last_name','patients.user_id','sys_users.token','patients.follow_up' ,'patients.blood_group','patients.known_condition','patients.profile_image AS user_thumbnail')->where('sys_users.email','=',$userId)->orWhere('sys_users.username','=',$userId)->get();
                    //Get user unread responseStat

                    foreach($userData as $user){
                      $userDataArr['email'] =  $user->email;
                      $userDataArr['username'] =  $user->username;
                      $userDataArr['role'] =  $user->role;
                      $userDataArr['first_name'] =  $user->first_name;
                      $userDataArr['last_name'] =  $user->last_name;
                      $userDataArr['user_id'] =  $user->user_id;
                      $userDataArr['token'] =  $user->token;
                      $userDataArr['user_thumbnail'] =  $user->user_thumbnail;
                      $userDataArr['gender'] =  $user->gender;
                      $userDataArr['country'] =  $user->country;
                      $userDataArr['address'] =  $user->address;
                      $userDataArr['is_follow_up'] =  $user->follow_up;
                      $userDataArr['blood_group']  =  $user->blood_group;
                      $userDataArr['known_condition']  =  $user->known_condition;
                    }

                    $unreadResponses = DB::select("SELECT COUNT(question_response_id) counter FROM question_responses WHERE responder_type = 'doctor' AND patient_id = '$user->user_id' AND `read`=0 ");

                    foreach($unreadResponses as $questionCount){
                        $countMessages   =  $questionCount->counter;
                    }
                    $userDataArr['unread_responses'] = $countMessages;
                    return $userDataArr;

                break;

                case 'doctor':

                    $userData = DB::table('sys_users')->join('doctors', 'sys_users.token', '=', 'doctors.token')->select('sys_users.email','sys_users.username','sys_users.role', 'doctors.first_name','doctors.last_name','doctors.doctor_id AS user_id','sys_users.token','doctors.thumbnail AS user_thumbnail','hospital_id','sys_users.permission')->where('sys_users.email','=',$userId)->orWhere('sys_users.username','=',$userId)->get();

                    foreach($userData as $user){
                        $userDataArr['email'] =  $user->email;
                        $userDataArr['username'] =  $user->username;
                        $userDataArr['role'] =  $user->role;
                        $userDataArr['first_name'] =  $user->first_name;
                        $userDataArr['last_name'] =  $user->last_name;
                        $userDataArr['user_id'] =  $user->user_id;
                        $userDataArr['token'] =  $user->token;
                        $userDataArr['hospital_id'] = $user->hospital_id;
                        $userDataArr['user_thumbnail'] =  $user->user_thumbnail;
                        $userDataArr['is_follow_up'] =  '';
                        $userDataArr['permission']  = $user->permission;
                      }
                    return $userDataArr;

                case 'admin':
                    $userData = DB::table('sys_users')->join('admins', 'sys_users.token', '=', 'admins.token')->select('sys_users.email','sys_users.username','sys_users.role', 'admins.first_name','admins.last_name','admins.admin_id AS user_id','sys_users.token','admins.url AS user_thumbnail', 'admins.admin_type')->where('sys_users.email','=',$userId)->orWhere('sys_users.username','=',$userId)->get();

                    foreach($userData as $user){
                        $userDataArr['email'] =  $user->email;
                        $userDataArr['username'] =  $user->username;
                        $userDataArr['role'] =  $user->role;
                        $userDataArr['first_name'] =  $user->first_name;
                        $userDataArr['last_name'] =  $user->last_name;
                        $userDataArr['user_id'] =  $user->user_id;
                        $userDataArr['token'] =  $user->token;
                        $userDataArr['admin_type'] = $user->admin_type;
                        $userDataArr['user_thumbnail'] =  $user->user_thumbnail;
                        $userDataArr['is_follow_up'] =  '';
                      }

                    return $userDataArr;
                break;
            }
            }catch(\Exception $e){
                return 'General Error '.$e->getMessage();
            }



        }



}


?>
