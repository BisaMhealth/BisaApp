<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use JD\Cloudder\Facades\Cloudder;
use App\Helpers\CustomSMS;
use App\Helpers\CustomMailer;
use App\Helpers\HelperFunctions;
use App\Core\GlobalService;

use App\Models\User;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\Question;
use App\Models\UserHealthInfo;
use App\Models\ArticleCategory;
use App\Models\QuestionCategory;
use App\Models\QuestionResponse;
use App\Models\HealthResource;
use App\Models\Pharmacy;
use App\Models\Video;
use App\Models\SmsVerficication;
use App\Models\PasswordRequest;
use App\Models\Device;
use App\Models\Client;
class DeviceController extends Controller
{


    use GlobalService;
    public function registerDeviceId(Request $request){

        $now      = date("Y-m-d H:s:i");

    	  $patientId   = $request->input('patientId');
    	  $deviceType = $request->input('deviceType');
        $deviceLocation = $request->input('deviceLocation'); //optional
    	  $token		= $request->input('regToken');
    	  $device = new Device();

            $ipaddress = $_SERVER['REMOTE_ADDR'];

            // Check if device exsist
            $userDevice = Device::where('patient_id', '=', $patientId)->first();

                if($userDevice){
                //Update if record exsist
                Device::where('patient_id',$patientId)->update(['token'=>$token]);
                $response_message =  array('status'=>1,'success' => true, 'message' => "Token  Registered ");

                $this->logMessageRequest($request->all(),'Device Registration');

                    return response()->json($response_message);
            }else{
               //Make a new entry
                $device->patient_id   = $patientId;
                $device->token       = $token;
                $device->device_type = $deviceType;
                $device->device_location = $deviceLocation;
                $device->created_at  = $now;

                try{
                    $device->save();
                    $response_message =  array('status'=>1,'success' => true, 'message' => "Token  Registered ");

                    $this->logMessageRequest($request->all(),'Device Registration');

                    return response()->json($response_message);
                }catch(\Exception $e){
                    $response_message =  array('status'=>0,'success' => false, 'message' => 'Unable To Token Registration.Please check your internet connection');

                    return response()->json($response_message);
                }


            }

        }
}
