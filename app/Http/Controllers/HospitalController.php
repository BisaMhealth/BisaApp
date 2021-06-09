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


class HospitalController extends Controller
{
	use GlobalService;
   	use MakesApiRequest;

    public function index(Request $request){
    	$response = $this->fetchHospitals();
    	
    	$responseData = $response->data;
    	return view('layouts.hospital.hospital_listings',compact('responseData'));
    }
}
