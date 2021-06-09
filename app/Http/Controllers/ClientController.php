<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Device;
use Illuminate\Support\Facades\Hash;
use App\Services\FirebaseService;


class ClientController extends Controller
{
    public function create(Request $request){
     $client  = new Client;
     $now	  = date("Y-m-d H:s:i");
     $token = bcrypt(implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6)));
     $client->client_name = $request->clientName;
     $client->api_key     = $token;
     $client->created_at  = $now;

     try{
     	$client->save();

     	$response_message =  array('status'=>'001','success' => true, 'message' => 'Client Created Successfully','token'=>$token);

    		return response()->json($response_message);

     }catch(\Exception $e){

     	$response_message =  array('status'=>'005','success' => false, 'message' => 'Request Failed');

    		return response()->json($response_message);
     }
     

    }



    public function send(){
        $firebase = new FirebaseService;

        $msg = $firebase->testfcm();

        return $msg;
    }



}
