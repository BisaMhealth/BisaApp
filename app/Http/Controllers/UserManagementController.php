<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\Article;
use App\Models\User;
use App\Models\UserHealthInfo;
use App\Models\Doctor;
use App\Models\HealthResource;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionResponse;
use JD\Cloudder\Facades\Cloudder;
use App\Models\Device;
use App\Core\GlobalService;
use Illuminate\Support\Facades\Hash;


class UserManagementController extends Controller
{
    use GlobalService;
    public function index(Request $request){

    }

    public function userRoles($userId){
        //Check user role
        try{
            $user = User::select('user_id','email','type','role','token','last_login','active')->where('email', '=', $userId)->orWhere('username','=',$userId)->first();

            if(empty($user)){
                $response_message =  array('statusCode'=>402,'success' => false, 'message' => 'User not found');
                return response()->json($response_message);
            }else{
                    $userRole = $user->role;
                    $userStatus = $user->active;


                if($userStatus == 0){
                    $response_message =  array('statusCode'=>403,'success' => true, 'message' => 'Invalid account');
                    return response()->json($response_message);
                }
                $userData = $this->fetchUserWithRoles($userRole,$userId);


                if($user){
                    $response_message =  array('statusCode'=>201,'success' => true, 'data' => $userData);
                    return response()->json($response_message);

                }else{
                    $response_message =  array('statusCode'=>404,'success' => false, 'message' => 'Invalid username or password');
                    return response()->json($response_message);
                }
            }

        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error '.$e->getMessage());
            return response()->json($response_message);
        }


    }

    public function userRoleLogin(Request $request){
        $userId = $this->sanitizeString($request->userId);
        $password = $this->sanitizeString($request->password);
        $userStatus = '';
        try{
            $user = User::select('user_id','email','type','role','token','last_login','active','password')->where('email', '=', $userId)->orWhere('username','=',$userId)->first();

            if(empty($user)){
                $response_message =  array('statusCode'=>402,'success' => false, 'message' => 'User not found');
                return response()->json($response_message);
            }else{

                $userRole = $user->role;
                $userStatus = $user->active;
                $userPassword = $user->password;
                if($userStatus == 0){
                    $response_message =  array('statusCode'=>403,'success' => true, 'message' => 'Invalid account');
                    return response()->json($response_message);
                }

            if (Hash::check($password, $userPassword)) {
                $userData = $this->fetchUserWithRoles($userRole,$userId);

                //

                $response_message =  array('statusCode'=>201,'success' => true, 'message' => 'success','data'=>$userData);
                return response()->json($response_message);
            }else{

                $response_message =  array('statusCode'=>404,'success' => false, 'message' => 'Invalid credentials');
                return response()->json($response_message);
            }

        }


        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error '.$e->getMessage());
            return response()->json($response_message);
        }



    }


    public function changePassword(Request $request){
        $userId      = $this->sanitizeString($request->userId);
        $oldPassword = $this->sanitizeString($request->oldPassword);
        $newPassword = $this->sanitizeString($request->newPassword);
        $token       = $request->token;

         $user = User::select('email','password')->where('token', '=', $token)->first();
         try{
                  $userPassword = $user->password;

                        if (Hash::check($oldPassword, $userPassword)) {
                            $hashedPassword  = Hash::make($newPassword);

                            try{
                                \DB::table('sys_users')->where('token', $token)->update(['password' => $hashedPassword,]);
                                    $response_message =  array('statusCode'=>201,'success' => true, 'message' => 'Password Changed');
                                    return response()->json($response_message);
                            }catch(\Exception $e){
                                    $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'Internal Server Error');
                                    return response()->json($response_message);
                            }


                        }else{
                            $response_message =  array('statusCode'=>404,'success' => false, 'message' => 'Invalid password');
                            return response()->json($response_message);
                        }
         }catch(\Exception $e){
            $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Error');
            return response()->json($response_message);
         }




    }

    public function changePasswordWithoutToken(Request $request){
        $email      = $this->sanitizeString($request->email);
        $password = $this->sanitizeString($request->password);
        if($email == ''){
            $response_message =  array('statusCode'=>404,'success' => true, 'message' => 'Email does not exist');
            return response()->json($response_message);
        }

        $hashedPassword  = Hash::make($password);
             try{
                  \DB::table('sys_users')->where('email', $email)->update(['password' => $hashedPassword,]);
                    $response_message =  array('statusCode'=>201,'success' => true, 'message' => 'Password Changed');
                    return response()->json($response_message);
             }catch(\Exception $e){
                    $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'Unable to process request');
                    return response()->json($response_message);
            }



    }


    public function updateUserImage(Request $request){
        $userType = $request->userRole;
        $url      = $request->profileUrl;
        $userId   = $request->userId;
        try{
            switch($userType){
                case "patient":
                  \DB::table('patients')->where('user_id', $userId)->update(['profile_image' => $url]);
                break;

                case "doctor":
                  \DB::table('doctors')->where('doctor_id', $userId)->update(['thumbnail' => $url]);
                break;

                case "admin":
                  \DB::table('admins')->where('admin_id', $userId)->update(['url' => $url,]);
                break;

            }
            $response_message =  array('success' => true, 'message' => 'Image Updated Successfully');
            return response()->json($response_message);
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error '.$e->getMessage());
            return response()->json($response_message);
        }



    }



} //End
