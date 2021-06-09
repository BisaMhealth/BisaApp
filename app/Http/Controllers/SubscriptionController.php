<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Core\GlobalService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Models\SubscriptionPlans;

class SubscriptionController extends Controller
{
    use GlobalService;

    public function index($planid=null){
        //Fetch all subscriptions
        try{
            if(isset($planid)){
                $subscriptions = SubscriptionPlans::where('plan_id', $planid)->first();
            }else{
                $subscriptions = SubscriptionPlans::all();
            }
            $response_message =  array('success' => true, 'message' => 'Subscription plan created','data'=>$subscriptions );
            return response()->json($response_message);

        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);
        }

    }

    public function addPlan(Request $request){
        //Add new subscription plan
        $now =  $this->longDate();
        $subscription = new SubscriptionPlans();
        
        $subscription->subscription_name = $request->subscriptionName;
        $subscription->amount = $request->amount;
        $subscription->cycle = $request->cycle;
        $subscription->created_at = $now;
        
        
        try{
                if($subscription->save()){
                    $response_message =  array('success' => true, 'message' => 'Subscription plan created' );
                    return response()->json($response_message); 
                }else{
                    $response_message =  array('success' => false, 'message' => 'Missing parameter' );
                    return response()->json($response_message);
                }
                
        
            }catch(\Exception $e){
                $response_message =  array('success' => false, 'message' => 'Internal Server Error');
                return response()->json($response_message);
        }
        
    }

    public function updatePlan(Request $request){
        
        $subscription = SubscriptionPlans::find($request->planId);
        $subscription->subscription_name = $request->subscriptionName;
        $subscription->amount = $request->amount;
        $subscription->cycle = $request->cycle;
        
        try{
            if($subscription->save()){
                $response_message =  array('success' => true, 'message' => 'Record updated' );
                return response()->json($response_message);
            }else{
                $response_message =  array('success' => false, 'message' => 'Missing parameter' );
                return response()->json($response_message);
            }
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);   
        }
        
    }

    public function deletePlan(Request $request){
        $subscription = SubscriptionPlans::find($request->planId);

        try{
            if($subscription->delete()){
                $response_message =  array('success' => true, 'message' => 'Record deleted' );
                return response()->json($response_message);
            }else{
                $response_message =  array('success' => false, 'message' => 'Cannot delete record' );
                return response()->json($response_message);
            }
        }catch(\Exception $e){
            $response_message =  array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message); 
        }
        
        
    }

    public function addPatientSubscriptionSignUp(Request $request){
        //Patient Subscription sign up
        $validator = Validator::make($request->all(), [
            'patientId' => 'required',
            'subscriptionId' => 'required',
        ]);

        if ($validator->fails()) {
           $response_message =  array('success' => false, 'message' => 'Missing Parameter Values');
           return response()->json($response_message);
           
        }      
       $patientId =  $this->sanitizeString($request->patientId);
       $subscriptionId =  $this->sanitizeString($request->subscriptionId);
        
       
    
    
    }

     

}
