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
use App\Helpers\CustomSMS;
use App\Helpers\CustomMailer;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\DB;

class HospitalBranchController extends Controller
{
    use GlobalService;
    public  function index(){

    }

    public function create(Request $request){
        $now = $this->longDate();

        if (Hospital::where('hospital_id', $request->hospitalId)->exists() ) {
            $branch = new HospitalBranch();

            $hospitalId = $request->hospitalId;
            $branch->hospital_id  = $hospitalId;
            $branch->branch_name =  $request->branchName;
            $branch->location  = $request->location;
            $branch->working_hours  = $request->workingHours;
            $branch->other_details = $request->otherDetails;
            $branch->created_at = $now;

            try{

                DB::transaction(function () use ($hospitalId,$branch) {
                    $branch->save();
                     
                    DB::table('hospital_branches')->insert([
                        ['branch_id' => $branch->branch_id, 'hospital_id' => $hospitalId]
                    ]);
                });

                $response_message =  array('success' => true, 'message' => "Record saved");
                return response()->json($response_message);

            }catch(\Exception $e){
                $response_message =  array('success' => false, 'message' => "Unable to save record. Please try again ".$e->getMessage());
                return response()->json($response_message);
            }
            

        }else{
            $response_message =  array('success' => false, 'message' => "Hospital Does not Exist");
            return response()->json($response_message);
        }
    }

    public function edit(Request $request){
        $branch = HospitalBranch::find($request->branchId);
        $branch->branch_name =  $request->branchName;
        $branch->location  = $request->location;
        $branch->working_hours  = $request->workingHours;
        $branch->other_details = $request->otherDetails;

        try{
            if($branch->save()){
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

    public function delete(Request $request){
        //  Dellete Branch
    }


}//
