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
use App\Models\HospitalBranch;
use App\Models\Appointment;
use App\Helpers\CustomSMS;
use App\Helpers\CustomMailer;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    use GlobalService;   
    public function addAppointment(Request $request){
        $now = $this->longDate();
       

        if(Hospital::where('hospital_id', $request->hospitalId)->exists() ){
             $appointment = new Appointment();
             $query = DB::table('patient_appointment')->select('*')->get();
             $countRow = count($query);
             $appointmentId = $countRow + 1 .rand(10,10000).'-'. date('d-m-y') ;
             
             $startDate = $this->formatCustomDate($request->startDate);
             $endDate = $this->formatCustomDate($request->endDate);
             
             $startTime =$this->formatCustomTime($request->startTime);
             $endTime =$this->formatCustomTime($request->endTime);
              
             $validator = Validator::make($request->all(), [
                'patientId' => 'required',
                'hospitalId'=>'required',
                'startDate'=>'required'
            ]);
            $errors = $validator->errors();

            if ($validator->fails()) {
                $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Required Parameter Values','errors'=>$errors);
                return response()->json($response_message);
                
             }
              try{
                $appointment->patient_id = $request->patientId;
                $appointment->hospital_id = $request->hospitalId;
                $appointment->appointment_id = $appointmentId;
                $appointment->branch_id   = $request->branchId;
                $appointment->doctor_id = $request->doctorId;
                $appointment->start_date = $startDate;
                $appointment->end_date = $endDate;
                $appointment->start_time = $startTime;
                $appointment->requested_by = $request->requestedBy;
                
                $appointment->reason = $request->reason;
                $appointment->appointment_type = $request->appointmentType;
                $appointment->status = 1;
                $appointment->created_at = $now;
                
                if($appointment->save()){

                    //Notify The Hospital / Patient

                    $response_message =  array('success' => true, 'message' => "Record saved");
                    return response()->json($response_message);
                }else{
                    $response_message =  array('success' => false, 'message' => "Unable to save record. Please try again ");
                    return response()->json($response_message); 
                }
                
              }catch(\Exception $e){
                $response_message =  array('success' => false, 'message' => "Internal Server Error ");
                return response()->json($response_message);
              }

            
             
        }else{

        }

    }


    public function editAppointment(Request $request){
        
        $validator = Validator::make($request->all(), [
            'appointmentId' => 'required'
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Required Parameter Values','errors'=>$errors);
            return response()->json($response_message);
            
         }
        try{
            $appointment = Appointment::find($request->appointmentId);
            if($appointment){
                    $startDate =$this->formatCustomDate($request->startDate);
                    $endDate =$this->formatCustomDate($request->endDate);

                    $startTime =$this->formatCustomTime($request->startTime);
                    $startTime =$this->formatCustomTime($request->startTime);
                    $appointment->doctor_id = $request->doctorId;
                    $appointment->branch_id = $request->branchId;
                    $appointment->start_date = $request->startDate;
                    $appointment->end_date = $request->endDate;
                    $appointment->start_time = $request->startTime;
                    $appointment->end_time = $request->endTime;
                    $appointment->details = $request->otherDetails;
                    $appointment->appointment_type = $request->appointmentType;

                    if($appointment->save()){
                        $response_message =  array('success' => true, 'message' => 'Record updated' );
                        return response()->json($response_message);
                    }else{
                        $response_message =  array('success' => false, 'message' => 'Unknown Resource' );
                        return response()->json($response_message);
                    }
            }else{
                $response_message =  array('success' => false, 'message' => 'Invalid appointment Id');
                return response()->json($response_message); 
            }
            
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);   
        }
    
    }

    public function changeAppointmentStatus(Request $request){
        $appointmentId = $this->sanitizeString($request->appointmentId);
        $status        = $this->sanitizeString($request->status);
        $validator = Validator::make($request->all(), [
            'appointmentId' => 'required',
            'status' => 'required |numeric | min:1 | max:3'
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Required Parameter Values','errors'=>$errors);
            return response()->json($response_message);
            
         }

         try{
            $updated = $affected = DB::update("update patient_appointment set status = '$status' where appointment_id = ?", [$appointmentId]);
                if($updated){
                    $response_message =  array('success' => true, 'message' => 'Record Update');
                    return response()->json($response_message);  
                }else{
                    $response_message =  array('success' => false, 'message' => 'Unable to update the requested resource');
                    return response()->json($response_message);  
                }
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Unable to delete record'.$e->getMessage());
            return response()->json($response_message); 
         }


    }

    public function fetchAppointmentsByUser($userId){
        
        try{
            
            $userAppointment = DB::table('patient_appointment')
            ->join('hospitals', 'hospitals.hospital_id', '=', 'patient_appointment.hospital_id')
            ->join('patients', 'patients.user_id', '=', 'patient_appointment.patient_id')
            ->leftJoin('doctors', 'doctors.doctor_id', '=', 'patient_appointment.doctor_id')->where('patient_appointment.patient_id','=',$userId)
            ->select('patient_appointment.appointment_id','patient_appointment.start_date'
            ,'patient_appointment.start_time','patient_appointment.details','patient_appointment.reason'
            ,'patient_appointment.appointment_type','patient_appointment.status','patient_appointment.created_at'
            ,'patient_appointment.requested_by','patient_appointment.requested_for','hospitals.hospital_name'
            ,DB::raw('CONCAT_WS(" ", doctors.first_name,doctors.last_name) AS doctor_name')
            ,DB::raw('CONCAT_WS(" ", patients.first_name,patients.last_name) AS patient_name')
            ,'patient_appointment.patient_id','patient_appointment.hospital_id','patient_appointment.doctor_id','patient_appointment.status')->get();
            
               
                    $response_message =  array('success' => true, 'message' => 'success','data'=>$userAppointment);
                    return response()->json($response_message); 
               
                
           

        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'success');
            return response()->json($response_message); 
        }
        

    }





    public function fetchAppointmentsByHospital($hospitalId){
            try{
            
            $userAppointment = DB::table('patient_appointment')
            ->join('hospitals', 'hospitals.hospital_id', '=', 'patient_appointment.hospital_id')
            ->join('patients', 'patients.user_id', '=', 'patient_appointment.patient_id')
            ->leftJoin('doctors', 'doctors.doctor_id', '=', 'patient_appointment.doctor_id')->where('patient_appointment.hospital_id','=',$hospitalId)
            ->select('patient_appointment.appointment_id','patient_appointment.start_date'
            ,'patient_appointment.start_time','patient_appointment.details','patient_appointment.reason'
            ,'patient_appointment.appointment_type','patient_appointment.status','patient_appointment.created_at'
            ,'patient_appointment.requested_by','patient_appointment.requested_for','hospitals.hospital_name'
            ,DB::raw('CONCAT_WS(" ", doctors.first_name,doctors.last_name) AS doctor_name')
            ,DB::raw('CONCAT_WS(" ", patients.first_name,patients.last_name) AS patient_name')
            ,'patient_appointment.patient_id','patient_appointment.hospital_id','patient_appointment.doctor_id','patient_appointment.status')->get();
            
                    $response_message =  array('success' => true, 'message' => 'success','data'=>$userAppointment);
                    return response()->json($response_message); 
               
                
           

        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'success');
            return response()->json($response_message); 
        }
        
    }

    public function destroy(Request $request){
        
        try{
            $appointmentId = $this->sanitizeString($request->appointmentId);
            $deleted = DB::table('patient_appointment')->where('appointment_id', $appointmentId)->delete();

            if($deleted){
              $response_message =  array('success' => true, 'message' => 'Record Deleted');
              return response()->json($response_message);   
            }else{
                $response_message =  array('success' => false, 'message' => 'Invalid appointment id. Request terminated');
                return response()->json($response_message); 
            }
            
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Unable to delete record');
            return response()->json($response_message); 
        }
    }


}
