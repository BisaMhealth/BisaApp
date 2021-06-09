<?php

namespace App\Http\Controllers;

use App\Core\GlobalService;
use App\Helpers\CustomSMS;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PatientController extends Controller
{
    use GlobalService;
    //Fetch Patients
    public function index($patientid = null)
    {

        try {
            if (isset($patientid)) {
                //Fetch Single patient records
                $patients = Patient::where('user_id', $patientid)->first();
            } else {
                //All Patients
                $patients = Patient::all();
            }

            $response_message = array('success' => true, 'message' => 'Subscription plan created', 'data' => $patients);
            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);
        }
    }
    //Known Patient type
    public function addNewPatient_Known(Request $request)
    {
        //Check if patient exist
        $now = $this->longDate();
        if (isset($request->phone) && (strlen($request->phone) > 9)) {
            $msisdn = '233' . substr($request->phone, -9);
        } else {
            $msisdn = '233' . $request->phone;
        }

        if (Patient::where('email', $request->email)->exists() || Patient::where('phone', $msisdn)->exists()) {
            $response_message = array('success' => false, 'message' => "Email or phone number already taken");
            return response()->json($response_message);
        } else {
            //Save details and create a user account
            try {
                $validator = Validator::make($request->all(), [
                    'lastName' => 'required',
                    'firstName' => 'required',
                    'email' => 'required',
                    'phone' => 'required',
                    'password' => 'required',
                    'dateOfBirth' => 'date',
                ]);
                $errors = $validator->errors();
                if ($validator->fails()) {
                    $response_message = array('statusCode' => 422, 'success' => false, 'message' => 'Missing Parameter Values', 'errors' => $errors);
                    return response()->json($response_message);

                }

                //Format phone number

                $patient = new Patient();
                $hashedPassword = Hash::make($request->password);
                $token = substr(md5(time()), 0, 20);
                $username = substr($request->firstName, 0, 3) . substr($request->lastName, 0, 3) . "_" . substr(md5(time() + rand()), 0, 4);
                $fmtDateOfBirth = $this->formatCustomDateOnly($request->dateOfBirth);

                $patient->first_name = $this->sanitizeString($request->firstName);
                $patient->last_name = $this->sanitizeString($request->lastName);
                $patient->username = $username;
                $patient->phone = $msisdn;
                $patient->email = $this->sanitizeString($request->email);
                $patient->country = $this->sanitizeString($request->country);
                $patient->address = $this->sanitizeString($request->address);
                $patient->profile_image = $request->imageUrl;
                $patient->gender = $request->gender;
                $patient->date_of_birth = $fmtDateOfBirth;
                $patient->type = 'known';
                $patient->active = 1;
                $patient->follow_up = $request->followUp;
                $patient->token = $token;
                $patient->blood_group = $this->sanitizeString($request->bloodGroup);
                $patient->known_condition = $this->sanitizeString($request->knownCondition);
                $patient->created_at = $now;
                $source = $request->source ?: 'mobile';

                //Profile User
                $userProfile = new User();
                $userStatus = 0;

                if ($patient->save()) {

                    $verificationCode = rand(1000, 9999);
                    $activateAccount = $userProfile->createUser($username, $request->email, $hashedPassword, 'patient', $patient->user_id, $token, $userStatus, $verificationCode, $source);

                    //Send SMS//$verificationCode = rand(1000, 9999);
                    $messageBody = "Hi, " . $request->firstName . " it's fantastic to have you join Bisa. Your verification code  is " . $verificationCode;
                    $customSMS = new CustomSMS();
                    $send_sms = $customSMS->sendSMS($msisdn, $messageBody);

                    $response_message = array('success' => true, 'message' => 'Signup successful', 'userType' => 'known', 'userToken' => $token, 'userId' => $patient->user_id, 'phone' => $patient->phone, 'email' => $patient->email, 'verificationCode' => $verificationCode, 'smsVerificationSent' => false, 'username' => $username);

                    return response()->json($response_message);

                } else {
                    $response_message = array('statusCode' => 501, 'success' => false, 'message' => 'Unable to signup.Please check internet connection');
                    $this->logMessageRequest($request->all(), 'Error Registring User');
                    return response()->json($response_message);
                }

            } catch (\Exception $e) {
                $response_message = array('statusCode' => 500, 'success' => false, 'message' => 'Intenrnal Server Error' . $e->getMessage());
                return response()->json($response_message);
            }

        }

    }

    public function sms(Request $request)
    {
        $customSMS = new CustomSMS();
        $messageBody = 'Test sms...';
        $send_sms = $customSMS->sendSMS($request->phone, $messageBody);
        var_dump($send_sms);
    }

    public function updatePatient(Request $request)
    {
        $patient = Patient::find($request->patientId);
        $patient->first_name = $this->sanitizeString($request->firstName);
        $patient->last_name = $this->sanitizeString($request->lastName);
        $patient->phone = $request->phone;
        $patient->email = $this->sanitizeString($request->email);
        $patient->country = $this->sanitizeString($request->country);
        $patient->address = $this->sanitizeString($request->address);
        $patient->gender = $request->gender;

        $dateOfBirth = $this->formatCustomDate($request->dateOfBirth);
        $patient->date_of_birth = $dateOfBirth;
        $patient->blood_group = $request->bloodGroup;
        $patient->known_condition = $request->knownCondition;

        try {
            if ($patient->save()) {
                $response_message = array('success' => true, 'message' => 'Record updated');
                return response()->json($response_message);
            } else {
                $response_message = array('success' => false, 'message' => 'Unknown Resource');
                return response()->json($response_message);
            }
        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);
        }

    }

    public function patientReadMessage($userId)
    {
        try {
            $readQusestions = DB::table('question_responses')->join('questions', 'questions.question_id', '=', 'question_responses.ques_id')
                ->select('questions.question_content', 'question_responses.question_response_content')
                ->where([['questions.patient_id', '=', $userId], ['question_responses.read', '=', 1]])
                ->get();

            $messageCount = count($readQusestions);
            $response_message = array('success' => true, 'messageCount' => $messageCount);

            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error ' . $e->getMessage());
            return response()->json($response_message);
        }
    }

    public function fetchUserUnreadResponses($userId)
    {
        $unredQusestions = DB::table('questions')->join('question_responses', 'questions.question_id', '=', 'question_responses.ques_id')
            ->select('questions.question_content', 'question_responses.question_response_content')
            ->where([['questions.patient_id', '=', $userId], ['question_responses.read', '=', 0]])->get();
        $messageCount = count($unredQusestions);
        $response_message = array('success' => true, 'messageCount' => $messageCount);
        return response()->json($response_message);

    }

    public function patientUnreadMessages($flag = null, $user = null, $questionid = null)
    {
        //Fetch unread responses for a question

        try {
            switch ($flag) {
                case 0:
                    $unreadResponses = DB::table('question_responses')->where([['ques_id', '=', $questionid],
                        ['responder_id', '=', $user], ['read', '=', 0]])->get();
                    $messageCount = count($unreadResponses);
                    break;
                case 1:
                    $readResponses = DB::table('question_responses')->where([['ques_id', '=', $questionid],
                        ['responder_id', '=', $user], ['read', '=', 1]])->get();
                    $messageCount = count($readResponses);
                    break;

                default:
                    $readResponses = DB::table('question_responses')->where([['read', '=', 0]])->get();
                    $messageCount = count($readResponses);
                    $messageCount = 0;
                    break;
            }

            $response_message = array('success' => true, 'messageCount' => $messageCount);
            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error ' . $e->getMessage());
            return response()->json($response_message);
        }

    }

    public function allUnreadMessages($user = null)
    {
        //Fetch unread responses for a question
        try {
            if ($user == 'all') {
                $readResponses = DB::table('question_responses')
                    ->where('read', '=', 0)->get();
            } else {
                $readResponses = DB::table('question_responses')
                    ->where('read', '=', 0)->where('responder_id', '=', $user)->get();
            }

            $messageCount = count($readResponses);

            $response_message = array('success' => true, 'messageCount' => $messageCount);
            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error ' . $e->getMessage());
            return response()->json($response_message);
        }

    }

    public function allUnreadQuetions($user = null)
    {
        try {
            if ($user == 'all') {
                $readResponses = DB::table('questions')->where('question_answered', '=', 'no')->get();
            } else {
                $readResponses = DB::table('questions')
                    ->where(allUnreadQuetions)->where('patient_id', '=', $user)->get();
            }

            $messageCount = count($readResponses);

            $response_message = array('success' => true, 'messageCount' => $messageCount);
            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error ' . $e->getMessage());
            return response()->json($response_message);
        }
    }

    public function deletePatient(Request $request)
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::statement("DELETE from patients WHERE user_id = $request->patientId");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $response_message = array('success' => true, 'message' => "Patient deleted successfully");
        return response()->json($response_message);
    }

}
