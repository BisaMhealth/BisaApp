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
use App\Events\DoctorReplay;
use App\Events\QuestionRead;

class PharmacyController extends Controller
{
    use GlobalService;
    use MakesApiRequest;
    
    public function showPharmacyList(){
        $response = $this->fetchPharmacies();
        $pharmaciesData = $response->data;
        return view('layouts.pharmacies.pharmacy_list',compact('pharmaciesData'));
        
    }
    
}
