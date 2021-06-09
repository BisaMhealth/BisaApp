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


class AdminController extends Controller
{
    use MakesApiRequest;
    use GlobalService;

    public function index(){
      $curretYear = date('Y');
      $startDate  = $curretYear.'-01-01';
      $endDate    = $curretYear.'-12-31';
      $totalQuestion = 0;
      $response = $this->fetchQuestionCountByMonth($startDate,$endDate);
      $questionCount = $response->data;

      foreach($questionCount as $key => $value){
        $totalQuestion += $value->question_count;

      }

      $responseStats =  $this->responseStats($startDate,$endDate);

      $totalResponse = 0;
      $doctorResponseCount = $responseStats->data;

      foreach ($responseStats->data as $responses) {
        $totalResponse += $responses->questions_answered;
      }


      $articleStats     = $this->articleStatsWithData();
      $countCategories  = count($articleStats->data->categories);

      $articles    = $this->countAllArticles();

      $articleCount = $articles->article_count;

      //$questionGlobalCount = $this->countQuestionGlobal();

      return view('layouts.admin.admin_home',compact('totalQuestion','questionCount','totalResponse','doctorResponseCount','countCategories','articleCount'));

    }

    public function getQuesCatStatsByYear($year=null){
      try{

              if($year != null){
                $curretYear = $year;
              }else{
                $curretYear = date('Y');
              }
              $startDate  = $curretYear.'-01-01';
              $endDate    = $curretYear.'-12-31';
              $lableArr   =  array();
              $dataArr    =  array();

              $response   =  $this->fetchQuestionsStatsCatByYear($startDate,$endDate);
              foreach ($response->data as $key => $value) {
                array_push($lableArr, $value->category_name);
                array_push($dataArr, $value->question_count);
              }

              $responseData =  array('success'=>true,'requestLabels' => $lableArr, 'requestData'=>$dataArr);
              return $responseData;
      }catch(\Exception $e){
              $responseData =  array('success'=>false,'error'=>$e->getMessage());
              return $responseData;
      }

    }


    public function fetchUserCount(){
      try{
          $response   =  $this->userCount();
          echo json_encode($response->data);
      }catch(\Exception $e){
        $responseData =  array('success'=>false,'error'=>'Error fetching record '.$e->getMessage());
        return $responseData;
      }

    }

    public function viewQuestionReport(){
      return view('layouts.admin.list_question');
    }

    public function showMessagingBoard(){
      return view('layouts.admin.messaging');
    }


    public function sendNotifications(Request $request){
      Session::flash('message', __('Message Added to notification queue successfully'));
      Session::flash('alert-class', 'alert-success');

      return redirect()->back();
    }

    public function viewDoctorQuestions($doctorId){
      return view('layouts.admin.doctor_question_list');
    }

}
