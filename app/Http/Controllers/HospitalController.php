<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\SubscriptionPlans;
use App\Core\GlobalService;
use App\Models\User;
use App\Models\Hospital;
use App\Models\Doctor;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\SmsVerficication;
use App\Helpers\CustomSMS;
use App\Helpers\CustomMailer;
use App\Http\Controllers\UserController;


class HospitalController extends Controller
{
    use GlobalService;
    public function index($hospitalId = null){
        
        try{
            if(isset($hospitalId)){
                //Fetch Single patient records
                $hospitals = Hospital::where('hospital_id', $hospitalId)->first();
                $recordCount = Hospital::where('hospital_id', $hospitalId)->count();
            }else{
                //All Patients
                $hospitals = Hospital::all();
                $recordCount = count($hospitals);     
            }
  
            if($recordCount > 0){
                $statusCode  = 201;
                $message = 'Success';
            }else{
                $statusCode  = 404;
                $message = 'Resouces not found';
            }

            $response_message =  array('status'=>$statusCode,'success' => true, 'message' => $message,'record_count'=>$recordCount,'data'=>$hospitals);
            return response()->json($response_message);

        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error '.$e->getMessage());
            return response()->json($response_message);
        }
    }


    public function addNewHospital(Request $request){
        $now = $this->longDate();
        if (Hospital::where('email', $request->email)->exists() ) {
          $response_message =  array('success' => false, 'message' => "Email already taken");
          return response()->json($response_message);
      }else{
          //Save details and create a user account
        $validator = Validator::make($request->all(), [
            'hospitalName' => 'required',
            'country'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'category'=>'required',
            'password'=>'required'
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Parameter Values','errors'=>$errors);
            return response()->json($response_message);
            
         }


         try{
            $token =  bin2hex(random_bytes(64));
            $recordId =  uniqid();
            $hospital = new Hospital();

            //$hospital->hospital_id = $recordId;
            $hospital->hospital_name = $this->sanitizeString($request->hospitalName);
            $hospital->address = $this->sanitizeString($request->address);
            $hospital->country = $this->sanitizeString($request->country);
            $hospital->phone = $this->sanitizeString($request->phone); 
            $hospital->email = $this->sanitizeString($request->email);
            $hospital->website_url = $this->sanitizeString($request->websiteUrl);
            $hospital->image_url = $this->sanitizeString($request->imageUrl);
            $hospital->category = $this->sanitizeString($request->category);
            $hospital->speciality = $this->sanitizeString($request->speciality);
            $hospital->other_details = $this->sanitizeString($request->otherDetails);
         
            $hospital->other_details = $this->sanitizeString($request->password);
            $hospital->token = $token;
            $hospital->enabled = 0;

            //Profile User/ Hospital Admin
            $userProfile =  new User();
            
            $username = substr($request->hospitalName, 0, 3)."_".substr(md5(time() + rand()), 0, 4);
            $hashedPassword  = Hash::make($request->password);
           
            if($hospital->save()){
                
                $activateAccount= $userProfile->createUser($username,$request->email,$hashedPassword,'hospital_admin',$hospital->hospital_id,$token,'1');
                
           
                $response_message =  array('success' => true, 'message' => 'Signup successful',  'UserType' => 'Hospital Admin', 'userToken'=> $token, 'hospitalId' => $hospital->hospital_id, 'username'=> $username );
                return response()->json($response_message);
            }
            // Send Welcome Email

            
        }catch(\Exception $e){
            $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'Intenrnal Server Error'.$e->getMessage());
            return response()->json($response_message);
         }
    
    }   

      

    }


    public function addNewDoctor(Request $request){
        $now = $this->longDate();
        if (Doctor::where('email', $request->email)->exists() ) {
          $response_message =  array('success' => false, 'message' => "Email already taken");
          return response()->json($response_message);
      }

         //Save details and create a user account
         $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'gender'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'hospitalId'=>'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Parameter Values');
            return response()->json($response_message);
         }

         try{
            $token =  bin2hex(random_bytes(64));
            $doctor = new Doctor();
 
            $doctor->first_name = $this->sanitizeString($request->firstName);
            $doctor->title = 'Dr';
            $doctor->last_name = $this->sanitizeString($request->lastName); 
            $doctor->gender = $this->sanitizeString($request->gender);
            $doctor->email = $this->sanitizeString($request->email); 
            $doctor->country = $this->sanitizeString($request->country);
            $doctor->address = $this->sanitizeString($request->address);
            $doctor->phone = $this->sanitizeString($request->phone);
            $doctor->bio = $this->sanitizeString($request->bio);
            $doctor->thumbnail = $this->sanitizeString($request->thumbNail); 
            $doctor->token = $token;
            $doctor->hospital_id = $this->sanitizeString($request->hospitalId);
            

            //Profile User/ Hospital Admin
              $userProfile =  new User();
            
              $username = substr($request->firstName, 0, 3).substr($request->lastName, 0, 3)."_".substr(md5(time() + rand()), 0, 4);
              $password  =  $request->password;
              $hashedPassword  = Hash::make($password);
              
              if($doctor->save()){  
                 $userId  = $doctor->doctor_id;
                $verificationCode = rand(1000, 9999);          
                $activateAccount= $userProfile->createUser($username,$request->email,$hashedPassword,'doctor',$userId,$token,'1',$verificationCode);
                
                //Send email
                $mailer = new CustomMailer();
                $fullName =  $request->firstName.' '. $request->lastName;
                $mailer->newDoctorCreated($request->email,$fullName,$request->password);

                $response_message =  array('success' => true, 'message' => 'Signup successful',  'UserType' => 'Doctor', 'userToken'=> $token, 'username'=> $username );
                return response()->json($response_message);
            }
           
         }catch(\Exception $e){
            $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'Intenrnal Server Error'.$e->getMessage());
            return response()->json($response_message);
         }

    }


    public function updateHospital(Request $request){
        $hospital = Hospital::find($request->hospitalId);
        $hospital->hospital_name = $this->sanitizeString($request->hospitalName);
        $hospital->address = $this->sanitizeString($request->address);
        $hospital->location = $this->sanitizeString($request->location); 
        $hospital->country = $this->sanitizeString($request->country);
        $hospital->phone = $this->sanitizeString($request->phone); 
        $hospital->website_url = $this->sanitizeString($request->websiteUrl);
        $hospital->image_url = $this->sanitizeString($request->imageUrl);
        $hospital->category = $this->sanitizeString($request->category);
        $hospital->speciality = $this->sanitizeString($request->speciality);
        $hospital->working_hours = $this->sanitizeString($request->workingHours); 
        $hospital->other_details = $this->sanitizeString($request->otherDetails);

        
        try{
            if($hospital->save()){
                $response_message =  array('success' => true, 'message' => 'Record updated' );
                return response()->json($response_message);
            }else{
                $response_message =  array('success' => false, 'message' => 'Unknown Resource' );
                return response()->json($response_message);
            }
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);   
        }
    }

  

    public function deleteHospital(Request $request){
        $hospital = Hospital::find($request->hospitalId);
        //Perform a soft delete
        $hospital->enabled = 0;
        try{
            if($hospital->save()){
                $response_message =  array('success' => true, 'message' => 'Record Deleted' );
                return response()->json($response_message);
            }else{
                $response_message =  array('success' => false, 'message' => 'Unknown Resource' );
                return response()->json($response_message);
            }
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);   
        }
    }


}
