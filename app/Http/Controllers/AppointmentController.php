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
use App\Events\QuestionRead;


class AppointmentController extends Controller
{
    //
    use AuthenticatesUsers;
   	use GlobalService;
   	use MakesApiRequest;

    public function showAppointmentForm($token){

    	$userId = Session::get('user_id');
    	$fullname = Session::get('full_name');

    	$response = $this->hospitalList();
    	$hospitalList = $response->data;
    	return view('layouts.patients.book_appointment',compact('fullname','userId','token','hospitalList'));
    }


    public function bookNewAppointment(Request $request){

    	$validator = Validator::make($request->all(), [
            'user_t' => 'required',
            'appointment_date' => 'required',
            'hospital_id' => 'required',
            'appointment_date' => 'required',
            'appointment_time' => 'required',
            'appointment_type' => 'required',
        ]);

        if ($validator->fails()) {
         Session::flash('message_error', __('Submission failed. Please correct any errors on the form and try again'));

            return redirect()->back()->withErrors($validator)->withInput();
      }


            $userId      =	$this->sanitizeString($request->user_t);
            $hospitalId      = 	$this->sanitizeString($request->hospital_id);
          	$reason          =	$this->sanitizeString($request->reason);
          	$appointmentDate = 	$this->sanitizeString($request->appointment_date);
          	$appointmentTime =	$this->sanitizeString($request->appointment_time);
          	$type            =  $this->sanitizeString($request->appointment_type);
          	$requestedBy     = Session::get('full_name');

            	$data = [
        					'patientId' => $userId,
        					'hospitalId' => $hospitalId,
        					'startDate' => $appointmentDate,
        					'startTime'=>$appointmentTime,
        					'appointmentType'=>$type,
        					'reason'=> $reason,
        					'requestedBy'=>$requestedBy,
        					'token' => $this->token
        				];


       $response = $this->bookAppointment($data);

       if($response->success == true){
       	    Session::flash('message', __('Request submitted pending confirmation. Please note: an SMS will be sent to you upon confirmation'));
       	    	return redirect()->back();

       }else{
       		Session::flash('message_error', __('Unable to submit request. Please change the date of the appointment and try again'));

            return redirect()->back();
       }

    }


    public function listUserAppointments(){
      $userId = Session::get('user_id');
      $response = $this->fetchAppointByPatientId($userId);

      $appiontmentData = $response->data;
      return view('layouts.patients.list_appointment',compact('appiontmentData'));
    }



}
