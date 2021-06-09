<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionResponse;
use App\Models\User;
use App\Traits\ResponseTrait;
use Carbon\Carbon;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //   return   Admin::all();

        try {
            $rules = [

                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $password = $request->password;
            $email = $request->email;
            $admin = Admin::where('admin_email', (string) $email)->first();
            if (!$admin) {
                return $this->wrongCredentialsResponse();
                //  return $this->errorResponse('You have entered an invalid email or password');
            }

            if (Hash::check($password, $admin->admin_password)) {

                // $roleId = $admin->role_id;
                //$userpemissions = array();

                // $getPermission = RolePermission::where('role_id', $roleId)->get();
                // if (!empty($getPermission)) {
                //     foreach ($getPermission as $key => $pem) {

                //         $userpemissions[] = $pem->permission;
                //     }
                // }

                $payload = [
                    "iss" => url("/"),
                    "iat" => time(),
                    "id" => $admin->id,
                ];
                // Generate token
                if ($token = JWT::encode($payload, config("app.key"))) {

                    //$admin->last_login = new DateTime();
                    //$admin->save();

                    if ($admin->role == 0) {
                        $userpemissions = 'dash, questions, doctors,patients,admins,hospitals';
                    }
                    if ($admin->role == 2) {
                        $userpemissions = 'dash,doctors,patients';
                    }
                    if ($admin->role == 1) {
                        $userpemissions = 'dash';
                    }

                    return $this->successResponse("Login Successful", [
                        "user" => $admin,
                        "token" => $token,
                        'permissions' => $userpemissions,
                    ]);
                }
            }
            return $this->wrongCredentialsResponse();
            return $this->errorResponse('You have entered an invalid email or password');
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function Questioncounts()
    {

        $thisDayCount = Question::whereDate('created_at', Carbon::today())->count();
        $thisMonthCount = Question::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $thisYearCount = Question::whereYear('created_at', Carbon::now()->year)->count();
        $thisWeekCount = Question::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        return $this->successResponse(
            '',
            [
                'thisDayCount' => $thisDayCount,
                'thisMonthCount' => $thisMonthCount,
                'thisYearCount' => $thisYearCount,
                'thisWeekCount' => $thisWeekCount,
            ]
        );
    }
    public function PatientsCounts()
    {

        $thisDayCount = Patient::whereDate('created_at', Carbon::today())->count();
        $thisMonthCount = Patient::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        $thisYearCount = Patient::whereYear('created_at', Carbon::now()->year)->count();
        $thisWeekCount = Patient::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

        return $this->successResponse(
            '',
            [
                'thisDayCount' => $thisDayCount,
                'thisMonthCount' => $thisMonthCount,
                'thisYearCount' => $thisYearCount,
                'thisWeekCount' => $thisWeekCount,
            ]
        );
    }
    public function counts(Request $request)
    {

        $getDoctoresCoung = Doctor::count();
        $getUsersCount = User::count();
        $getQuestionCount = Question::count();
        $getQuestionPerDay = Question::whereDate('created_at', Carbon::today())->count();

        return $this->successResponse("", [
            "doctorsCount" => $getDoctoresCoung,
            "userCount" => $getUsersCount,
            "totalQuestion" => $getQuestionCount,
            "questionPerToday" => $getQuestionPerDay,
            //    "average" => $averageResponse,

        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function questionCategory()
    {

        $quesCategories = array();
        $values = array();
        Question::all();

        $questionCategory = QuestionCategory::all();
        if ($questionCategory->isNotEmpty()) {
            foreach ($questionCategory as $key => $singCategory) {
                $quesCategories[] = Str::limit($singCategory->category_name, 15, $end = '...');
                $count = Question::where("question_cat_id", $singCategory->category_id)->count();
                $values[] = $count;
            }
        }
        $data = array(
            'questionsCategories' => $quesCategories,
            'values' => $values,
        );
        return $this->successResponse('', $data);
    }
    public function averageResponse()
    {
        //  $averageResponse = array();
        $doctors = array();
        $values = array();
        $getDoctors = Doctor::all();
        if ($getDoctors->isNotEmpty()) {

            foreach ($getDoctors as $key => $singDoctor) {

                $timeofResponse = 0;
                $getResponses = QuestionResponse::select('responder_id', 'ques_id', 'question_response_id', 'responder_type', 'created_at')->where('responder_type', 'doctor')->where('responder_id', $singDoctor->doctor_id)->distinct()->get();

                $countofQuestion = Count($getResponses);
                if (!empty($getResponses->isNotEmpty())) {

                    foreach ($getResponses as $key => $singResponse) {

                        $getQuest = Question::where('question_id', $singResponse->ques_id)->first();

                        //   return $data =array(
                        //       'question'=>$getQuest,
                        //       'response'=>$singResponse
                        //   );
                        if (!empty($getQuest)) {

                            $startTime = Carbon::parse($getQuest->created_at);
                            $endTime = Carbon::parse($singResponse->created_at);

                            $reponseTime = $endTime->diffInMinutes($startTime);

                            // $respondedOn = new DateTime($singResponse->created_at);
                            // $createdAt = new DateTime($getQuest->created_at);
                            // $interval =$createdAt->diff($respondedOn);
                            //  $elapsed = $interval->format('%y years %m months %a days %h hours %i minutes %s seconds');
                            // $data = array(
                            //     'question_id' =>$singResponse->ques_id,
                            //     'question_response_id'=> $singResponse->question_response_id,
                            //     'start_time' => $startTime,
                            //     'end_time' =>  $endTime,
                            //     'response' =>$reponseTime
                            // );

                            //  $quetionCreatedOn = $getQuest->created_at;
                            // $reponseTime = $singResponse->created_at->diffInMinutes($quetionCreatedOn);
                            $timeofResponse += $reponseTime;
                        }
                    }
                }
                if ((int) $countofQuestion > 0) {
                    $doctorTime = ($timeofResponse / $countofQuestion);
                    $doctorTime = $doctorTime / 60;
                }
                $doctors[] = $singDoctor->first_name . ' ' . $singDoctor->last_name;
                $values[] = number_format((float) $doctorTime, 2, '.', '');
            }
        }

        $data = array(
            'doctors' => $doctors,
            'values' => $values,
        );
        return $this->successResponse('', $data);

    }
    public function totalResponseByDoctors()
    {
        //  $averageResponse = array();
        $doctors = array();
        $values = array();
        $getDoctors = Doctor::all();
        if ($getDoctors->isNotEmpty()) {

            foreach ($getDoctors as $key => $singDoctor) {

                $timeofResponse = 0;
                $getResponsesCount = QuestionResponse::select('responder_id', 'ques_id', 'question_response_id', 'responder_type', 'created_at')->where('responder_type', 'doctor')->where('responder_id', $singDoctor->doctor_id)->count();
                $doctors[] = $singDoctor->first_name . ' ' . $singDoctor->last_name;
                $values[] = $getResponsesCount;
            }
        }

        $data = array(
            'doctors' => $doctors,
            'values' => $values,
        );
        return $this->successResponse('', $data);

    }

    public function allQuestion()
    {
        $total = 0;
        $returnResponse = array();
        // $getQuestions = Question::all();
        $getQuestions = Question::select('question_answered', 'question_content', 'question_closed', 'question_cat_id', 'patient_id', 'question_id', 'created_at')->orderBy('created_at', 'DESC')->get();
        $total = count($getQuestions);
        if (!empty($getQuestions)) {

            foreach ($getQuestions as $key => $singQuestions) {

                $getResponse = QuestionResponse::where('ques_id', $singQuestions->question_id)->get();
                $singQuestions->questionreponses = $getResponse;
                $returnResponse[] = $singQuestions;
            }
        }
        //  return $returnResponse;

        return $this->successResponse('', ['questions' => $returnResponse, 'total' => $total]);
        //   return $this->successResponse('', $returnResponse);

    }

    public function allDoctors()
    {

        $doctors = Doctor::orderBy('created_at', 'DESC')->get();

        return $this->successResponse('', $doctors);

    }
    public function allPatients()
    {

        $patients = Patient::orderBy('created_at', 'DESC')->get();

        $total = count($patients);
        return $this->successResponse('', ['patients' => $patients, 'total' => $total]);

    }

    public function getResponses($id)
    {

    }

    public function filterQuestions(Request $request)
    {
        $total = 0;
        $returnResponse = array();
        $from = $request->start_date;
        $to = $request->end_date;
        $getQuestions = Question::select('question_answered', 'question_content', 'question_closed', 'question_cat_id', 'patient_id', 'question_id', 'created_at')->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'DESC')->get();

        $total = count($getQuestions);

        if (!empty($getQuestions)) {

            foreach ($getQuestions as $key => $singQuestions) {

                $getResponse = QuestionResponse::where('ques_id', $singQuestions->question_id)->get();
                $singQuestions->questionreponses = $getResponse;
                $returnResponse[] = $singQuestions;
            }
        }
        //  return $returnResponse;
        return $this->successResponse('', ['questions' => $returnResponse, 'total' => $total]);
    }

    public function filterPatients(Request $request)
    {
        $total = 0;
        $returnResponse = array();
        $from = $request->start_date;
        $to = $request->end_date;
        $patients = Patient::whereBetween('created_at', [$from, $to])->orderBy('created_at', 'DESC')->get();

        $total = count($patients);

        //  return $returnResponse;
        return $this->successResponse('', ['patients' => $patients, 'total' => $total]);
    }

    public function marketlogin(Request $request)
    {
        //   return   Admin::all();

        try {
            $rules = [

                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $errors = $validator->errors()->all();
                return $this->validationResponse($errors);
            }

            $password = $request->password;
            $email = $request->email;
            $admin = Admin::where('admin_email', (string) $email)->first();
            if (!$admin) {
                return $this->wrongCredentialsResponse();
                //  return $this->errorResponse('You have entered an invalid email or password');
            }

            if (Hash::check($password, $admin->admin_password)) {

                // $roleId = $admin->role_id;
                //$userpemissions = array();

                // $getPermission = RolePermission::where('role_id', $roleId)->get();
                // if (!empty($getPermission)) {
                //     foreach ($getPermission as $key => $pem) {

                //         $userpemissions[] = $pem->permission;
                //     }
                // }

                $payload = [
                    "iss" => url("/"),
                    "iat" => time(),
                    "id" => $admin->id,
                ];
                // Generate token
                if ($token = JWT::encode($payload, config("app.key"))) {

                    //$admin->last_login = new DateTime();
                    //$admin->save();

                    if ($admin->role == 0) {
                        $userpemissions = 'dash, questions, doctors,patients,admins,hospitals';
                    }
                    if ($admin->role == 2) {
                        $userpemissions = 'dash,doctors,patients';
                    }
                    if ($admin->role == 1) {
                        $userpemissions = 'dash';
                    }

                    return $this->successResponse("Login Successful", [
                        "user" => $admin,
                        "token" => $token,
                        //                        'permissions' => $userpemissions
                    ]);
                }
            }
            return $this->wrongCredentialsResponse();
            return $this->errorResponse('You have entered an invalid email or password');
        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

}
