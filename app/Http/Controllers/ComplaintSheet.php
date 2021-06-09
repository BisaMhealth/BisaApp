<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
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


class ComplaintSheet extends Controller
{
    //
    public function fillComplaintSheet(Request $request){
        $complaint = new ComplaintSheet();
        try{
            $validator = Validator::make($request->all(), [
                'quesId' => 'required',
                'chiefComplaint' => 'required'
            ]);

            $errors = $validator->errors();
            if ($validator->fails()) {
                $response_message =  array('statusCode'=>422,'success' => false, 'message' => 'Missing Params','errors'=>$errors);
                return response()->json($response_message);
    
             }else{
                $complaint->question_id         = $request->quesId;
                $complaint->visit_id            = rand(1000, 9999);
                $complaint->cheif_complaint     = $request->chiefComplaint;
                $complaint->patient_description = $request->description ;
                $complaint->weight              = $request->weight;
                $complaint->height              = $request->height;
                $complaint->save();
             }
           
        }catch(\Exception $e){
            $response_message =  array('statusCode'=>500,'success' => false, 'message' => 'General Failure');
            return response()->json($response_message);
        }
    }


}
