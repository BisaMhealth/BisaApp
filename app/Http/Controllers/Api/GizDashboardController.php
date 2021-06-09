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
use Crypt;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GizDashboardController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

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
        // $thisYearCount = Question::whereYear('created_at', Carbon::now()->year)->count();
        $from = date('2020-09-01');
        $thisYearCount = Question::whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();
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

        $thisDayCount = User::whereDate('created_at', Carbon::today())->count();
        $thisMonthCount = User::whereYear('created_at', Carbon::now()->year)->whereMonth('created_at', Carbon::now()->month)->count();
        // $thisYearCount = User::whereYear('created_at', Carbon::now()->year)->count();
        $from = date('2020-09-01');
        $thisYearCount = User::whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();
        $thisWeekCount = User::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();

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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function filterQuestionsCategories(Request $request)
    {
        $from = $request->start_date;
        $to = $request->end_date;

        $quesCategories = array();
        $values = array();
        Question::all();

        $questionCategory = QuestionCategory::all();
        if ($questionCategory->isNotEmpty()) {
            foreach ($questionCategory as $key => $singCategory) {
                $quesCategories[] = Str::limit($singCategory->category_name, 15, $end = '...');
                $from = date('2020-09-01');
                $count = Question::where("question_cat_id", $singCategory->category_id)->whereBetween('created_at', [$from, $to])->count();
                $values[] = $count;
            }
        }
        $data = array(
            'questionsCategories' => $quesCategories,
            'values' => $values,
        );
        return $this->successResponse('', $data);
    }
    public function questionCategory()
    {

        $quesCategories = array();
        $values = array();
        Question::all();

        $questionCategory = QuestionCategory::all();
        if ($questionCategory->isNotEmpty()) {
            foreach ($questionCategory as $key => $singCategory) {
                $quesCategories[] = Str::limit($singCategory->category_name, 15, $end = '...');
                $from = date('2020-09-01');
                $count = Question::where("question_cat_id", $singCategory->category_id)->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();
                $values[] = $count;
            }
        }
        $data = array(
            'questionsCategories' => $quesCategories,
            'values' => $values,
        );
        return $this->successResponse('', $data);
    }
    public function filterSignupBreakdown(Request $request)
    {
        $from = $request->start_date;
        $to = $request->end_date;

        $mobileCount = User::where('source', 'mobile')->whereBetween('created_at', [$from, $to])->count();
        $webCount = User::where('source', 'web')->whereBetween('created_at', [$from, $to])->count();

        $sources = ['Mobile', 'Website'];
        $values = [
            $mobileCount,
            $webCount,
        ];

        $data = array(
            'sources' => $sources,
            'values' => $values,
        );
        return $this->successResponse('', $data);
    }
    public function SignupsBreak()
    {
        $from = date('2020-09-01');
        $mobileCount = User::where('source', 'mobile')->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();
        $webCount = User::where('source', 'web')->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();

        $sources = ['Mobile', 'Website'];
        $values = [
            $mobileCount,
            $webCount,
        ];

        $data = array(
            'sources' => $sources,
            'values' => $values,
        );
        return $this->successResponse('', $data);
    }
    public function genderBreak()
    {

        $from = date('2020-09-01');
        // $male = User::where('gender', 'male')->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();
        // $female = User::where('gender', 'female')->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->count();

        // $customer = Customer::select('leads.fname', 'leads.lname')
        // ->leftJoin('leads', 'customers.leadid', '=', 'leads.id')
        // ->where('customers.accountnumber', $lead->referredby)
        // ->first();

        $male = User::leftJoin('patients', 'sys_users.user_id', '=', 'patients.user_id')->where('patients.gender', 'male')->whereBetween('sys_users.created_at', [$from, Carbon::now()->endOfWeek()])->count();

        $female = User::leftJoin('patients', 'sys_users.user_id', '=', 'patients.user_id')->where('patients.gender', 'female')->whereBetween('sys_users.created_at', [$from, Carbon::now()->endOfWeek()])->count();

        $data = array(
            'male' => $male,
            'female' => $female,
        );
        return $this->successResponse('', $data);
    }

    public function allQuestion()
    {

        $total = 0;
        $returnResponse = array();
        // $getQuestions = Question::all();
        $from = date('2020-09-01');
        $getQuestions = Question::select('question_answered', 'question_content', 'question_closed', 'question_cat_id', 'patient_id', 'question_id', 'created_at')->orderBy('created_at', 'DESC')->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->get();
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

    public function allPatients()
    {

        $from = date('2020-09-01');
        $patients = User::whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->get();
        // $patients = Patient::orderBy('created_at', 'DESC')->get();

        $returnArray = [];
        if ($patients->isNotEmpty()) {
            foreach ($patients as $key => $sing) {

                $getUser = Patient::select('user_id', 'email', 'first_name', 'last_name', 'gender', 'country', 'address', 'created_at', 'date_of_birth')->where('user_id', $sing->user_id)->first();
                if ($getUser) {

                    $hashed = Crypt::encrypt($getUser->first_name);
                    $getUser->hashname = substr($hashed, 0, 10);

                    $years = \Carbon::parse($getUser->date_of_birth)->age;
                    $getUser->age = $years;
                    $getUser->registered_on = $sing->first_name;
                    $getUser->source = $sing->source;
                    $getUser->registered_on = (string) $sing->created_at;

                    $returnArray[] = $getUser;
                }
            }
        }
        $total = count($patients);
        return $this->successResponse('', ['patients' => $returnArray, 'total' => $total]);

    }

    public function filterPatients(Request $request)
    {
        $total = 0;
        $returnResponse = array();
        $from = $request->start_date;
        $to = $request->end_date;
        $patients = User::whereBetween('created_at', [$from, $to])->get();
        $returnArray = [];
        if ($patients->isNotEmpty()) {
            foreach ($patients as $key => $sing) {
                $getUser = Patient::select('user_id', 'email', 'first_name', 'last_name', 'gender', 'country', 'address', 'created_at', 'date_of_birth')->where('user_id', $sing->user_id)->first();
                if ($getUser) {
                    $hashed = Crypt::encrypt($getUser->first_name);
                    $getUser->hashname = substr($hashed, 0, 10);

                    $years = \Carbon::parse($getUser->date_of_birth)->age;
                    $getUser->age = $years;

                    $getUser->registered_on = $sing->first_name;
                    $getUser->source = $sing->source;
                    $getUser->registered_on = (string) $sing->created_at;
                    $returnArray[] = $getUser;
                }
            }
        }
        $total = count($patients);
        return $this->successResponse('', ['patients' => $returnArray, 'total' => $total]);
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

    public function getDoclists()
    {
        $returnArray = [];
        $id = [

            1,
            2,
            7,
            8,

        ];

        $getDoctors = Doctor::select('doctor_id', 'first_name', 'last_name')->WhereIn('doctor_id', $id)->get();
        if ($getDoctors->isNotEmpty()) {
            foreach ($getDoctors as $key => $doc) {
                $doc->fullname = $doc->first_name . ' ' . $doc->last_name;
                $returnArray[] = $doc;
            }
        }
        return $this->successResponse('', $returnArray);
    }

    public function getDoctors()
    {

        $end = (string) Carbon::now()->format('Y-m-d');
        $from = (string) date('2020-09-01');

        $period = $from . ' to ' . $end;
        $returnArray = [];

        $id = [

            1,
            2,
            7,
            8,

        ];

        $getDoctors = Doctor::WhereIn('doctor_id', $id)->get();

        if ($getDoctors->isNotEmpty()) {

            foreach ($getDoctors as $key => $singDoctor) {
                $timeofResponse = 0;
                $getCount = QuestionResponse::select('responder_id', 'ques_id', 'question_response_id', 'responder_type', 'created_at')->where('responder_type', 'doctor')->where('responder_id', $singDoctor->doctor_id)->whereBetween('created_at', [$from, Carbon::now()->endOfWeek()])->distinct()->count();

                $doctors[] = $singDoctor->first_name . ' ' . $singDoctor->last_name;

                $returnArray[] = array(
                    'doctor' => $singDoctor->first_name . ' ' . $singDoctor->last_name,
                    'total' => $getCount,
                    'period' => $period,
                );
            }
        }
        return $this->successResponse('', $returnArray);

    }
    public function filterDoctors(Request $request)
    {

        // $end = (string) Carbon::now()->format('Y-m-d');
        // $from = (string) date('2020-09-01');

        $from = $request->start_date;
        $end = $request->end_date;

        $period = $from . ' to ' . $end;
        $returnArray = [];

        $id = [

            1,
            2,
            7,
            8,

        ];

        $getDoctors = Doctor::WhereIn('doctor_id', $id)->get();

        if ($getDoctors->isNotEmpty()) {

            foreach ($getDoctors as $key => $singDoctor) {
                $timeofResponse = 0;
                $getCount = QuestionResponse::select('responder_id', 'ques_id', 'question_response_id', 'responder_type', 'created_at')->where('responder_type', 'doctor')->where('responder_id', $singDoctor->doctor_id)->whereBetween('created_at', [$from, $end])->distinct()->count();

                $doctors[] = $singDoctor->first_name . ' ' . $singDoctor->last_name;

                $returnArray[] = array(
                    'doctor' => $singDoctor->first_name . ' ' . $singDoctor->last_name,
                    'total' => $getCount,
                    'period' => $period,
                );
            }
        }
        return $this->successResponse('', $returnArray);

    }
    public function getDoctor(Request $request)
    {

        // $end = (string) Carbon::now()->format('Y-m-d');
        // $from = (string) date('2020-09-01');

        $from = $request->start_date;
        $end = $request->end_date;
        $doctor = $request->doctor;

        $period = $from . ' to ' . $end;

        $getCount = QuestionResponse::select('responder_id', 'ques_id', 'question_response_id', 'responder_type', 'created_at')->where('responder_type', 'doctor')->where('responder_id', $doctor)->whereBetween('created_at', [$from, $end])->distinct()->count();

        return $this->successResponse('', $getCount);

    }
}
