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
use DataTables;
use Carbon\Carbon;



class QuestionsController extends Controller
{
  use AuthenticatesUsers;
  use GlobalService;
  use MakesApiRequest;

  public function viewWorkFlow(){

    return view('layouts.doctor.workflow');
  }



  public function getQuestions(){
      $questions = $this->retriveUnansweredQuestions();

          return DataTables::of($questions)->addColumn('updated_at',function($questions){
            return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
      })->addColumn('question_content',function($questions){

        if($questions->replied === 1){
          $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>';
        }else{
         $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
        }
        $content = $followUpIcon.' '.$questions->question_content;

        return $content;

      })->addColumn('answered',function($questions){
        $_isAnswered = $questions->question_answered;
        ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
        return $badge;
      })->addColumn('details',function($questions){

        if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
          $fullName = $questions->first_name.' '.$questions->last_name;
        }else{
          $fullName = 'Anonymous';
        }

        return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/0"><span data-toggle="modal" title="View Details"
                        class="btn btn-xs btn-dark">  Reply</span> </a> ';
      })->addColumn('fullname',function($questions){

        $fullName = $questions->first_name.' '.$questions->last_name;
        return $fullName;
      })->rawColumns(['details','answered','question_content'])->make(true);


  }


  public function viewCovidQuestion(){
    $questions = $this->retriveUnansweredCovidQuestions();

        return DataTables::of($questions)->addColumn('updated_at',function($questions){
          return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
    })->addColumn('question_content',function($questions){

      if($questions->replied === 1){
        $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>';
      }else{
       $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
      }
      $content = $followUpIcon.' '.$questions->question_content;

      return $content;

    })->addColumn('answered',function($questions){
      $_isAnswered = $questions->question_answered;
      ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
      return $badge;
    })->addColumn('details',function($questions){

      if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
        $fullName = $questions->first_name.' '.$questions->last_name;
      }else{
        $fullName = 'Anonymous';
      }

      return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/0"><span data-toggle="modal" title="View Details"
                      class="btn btn-xs btn-dark">  Reply</span> </a>  <a href="#" class="btn btn-xs btn-danger"> Escalate</a>';
    })->addColumn('fullname',function($questions){

      $fullName = $questions->first_name.' '.$questions->last_name;
      return $fullName;
    })->rawColumns(['details','answered','question_content'])->make(true);

  }


  public function getFollowUpQuestions(){
    $questions = $this->retriveUnansweredFollowUpQuestions();

        return DataTables::of($questions)->addColumn('updated_at',function($questions){
          return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
    })->addColumn('question_content',function($questions){

      if($questions->replied === 1){
        $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>';
      }else{
       $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
      }
      $content = $followUpIcon.' '.$questions->question_content;

      return $content;

    })->addColumn('answered',function($questions){
      $_isAnswered = $questions->question_answered;
      ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
      return $badge;
    })->addColumn('details',function($questions){

      if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
        $fullName = $questions->first_name.' '.$questions->last_name;
      }else{
        $fullName = 'Anonymous';
      }

      return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/0"><span data-toggle="modal" title="View Details"
                      class="btn btn-xs btn-dark">  Reply</span> </a> ';
    })->addColumn('fullname',function($questions){

      // if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
      //   $fullName = $questions->first_name.' '.$questions->last_name;
      // }else{
      //   $fullName = 'Anonymous';
      // }
      $fullName = $questions->first_name.' '.$questions->last_name;
      return $fullName;
    })->rawColumns(['details','answered','question_content'])->make(true);
  }


  Public function getUnanweredQuestions(){
    $questions = $this->retriveUnansweredQuestions();
    return DataTables::of($questions)->addColumn('updated_at',function($questions){
      return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
})->addColumn('answered',function($questions){
  $_isAnswered = $questions->question_answered;
  ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
  return $badge;
})->addColumn('details',function($questions){
  $fullName = $questions->first_name.' '.$questions->last_name;
  return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/0"><span data-toggle="modal" title="View Details"
                  class="btn btn-xs btn-dark">  Reply</span> </a> ';
})->rawColumns(['details','answered'])->make(true);
  }


  public function showUnanseredFollowQuestions(){

    return view('layouts.doctor.covid_review');
  }


  public function getCovidFollowUpQuestions(){
    $questions = $this->retriveUnansweredFollowUpQuestions();
    return DataTables::of($questions)->addColumn('updated_at',function($questions){
      return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
})->addColumn('question_content',function($questions){

  if($questions->replied === 1){
    $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>';
  }else{
   $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
  }
  $content = $followUpIcon.' '.$questions->question_content;

  return $content;

})->addColumn('answered',function($questions){
  $_isAnswered = $questions->question_answered;
  ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
  return $badge;
})->addColumn('details',function($questions){

  if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
    $fullName = $questions->first_name.' '.$questions->last_name;
  }else{
    $fullName = 'Anonymous';
  }

  return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/1"><span data-toggle="modal" title="View Details"
                  class="btn btn-xs btn-dark">  Reply</span> </a> ';
})->addColumn('fullname',function($questions){

  // if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
  //   $fullName = $questions->first_name.' '.$questions->last_name;
  // }else{
  //   $fullName = 'Anonymous';
  // }
  $fullName = $questions->first_name.' '.$questions->last_name;
  return $fullName;
})->rawColumns(['details','answered','question_content'])->make(true);

  }


  public function viewAllUserQuestions(){
    return view('layouts.doctor.viewall_question');
  }


  public function fecthAllUserQuestions(){
    $questions = $this->retriveAllQuestions();

    return DataTables::of($questions)->addColumn('updated_at',function($questions){
              return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
        })->addColumn('question_content',function($questions){

          if($questions->replied === 1){
            $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>';
          }else{
           $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
          }
          $content = $followUpIcon.' '.$questions->question_content;

          return $content;

        })->addColumn('answered',function($questions){
          $_isAnswered = $questions->question_answered;
          ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
          return $badge;
        })->addColumn('details',function($questions){

          if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
            $fullName = $questions->first_name.' '.$questions->last_name;
          }else{
            $fullName = 'Anonymous';
          }

          if($questions->question_answered === 'yes'){
            $actionTxt = 'Details';
          }else{
            $actionTxt = 'Reply';
          }

          return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/1"><span data-toggle="modal" title="View Details"
                          class="btn btn-xs btn-dark">'.$actionTxt.'</span> </a> ';
        })->addColumn('fullname',function($questions){

          $fullName = $questions->first_name.' '.$questions->last_name;
          return $fullName;
        })->rawColumns(['details','answered','question_content'])->make(true);




  }


    public function fetchDoctorWorkFlowItems(){
      $userId   = Session::get('user_id');
      $questions = $this->getWorkflowItems($userId);

      return DataTables::of($questions)->addColumn('updated_at',function($questions){
                return $questions->updated_at ? with(new Carbon($questions->updated_at))->format('M-d-Y @ H:i a') : ' ';
          })->addColumn('question_content',function($questions){

            if($questions->replied === 1){
              $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comments cs-active"></span>';
            }else{
             $followUpIcon = '<span style="font-size:1.2em;" class="fa fa-comment"></span>';
            }
            $content = $followUpIcon.' '.$questions->question_content;

            return $content;

          })->addColumn('answered',function($questions){
            $_isAnswered = $questions->question_answered;
            ($_isAnswered == 'no') ? $badge = '<span class="badge badge-warning text-center">NO</span> ' : $badge = '<span class="badge badge-success">YES</span>';
            return $badge;
          })->addColumn('details',function($questions){

            if($questions->first_name != null || $questions->first_name != 'n_a' || $questions->first_name != 'n/a'){
              $fullName = $questions->first_name.' '.$questions->last_name;
            }else{
              $fullName = 'Anonymous';
            }

            if($questions->question_answered === 'yes'){
              $actionTxt = 'Details';
            }else{
              $actionTxt = 'Reply';
            }

            return '<a href="/doctor/reply/'.$questions->question_id.'/'.$fullName.'/1"><span data-toggle="modal" title="View Details"
                            class="btn btn-xs btn-dark">'.$actionTxt.'</span> </a> ';
          })->addColumn('fullname',function($questions){

            $fullName = $questions->first_name.' '.$questions->last_name;
            return $fullName;
          })->rawColumns(['details','answered','question_content'])->make(true);


    }



    public function avgResponseTime(){
           $avgResponseTime = $this->getAverageResponseTime();
           $fmtAvgResponseTime = date('H:i',strtotime($avgResponseTime));
           return ['avg_response_time'];
    }



}
