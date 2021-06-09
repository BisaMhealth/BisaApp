<?php

namespace App\Http\Controllers;

use App\Core\GlobalService;
use App\Http\Controllers\PushNotification;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use JD\Cloudder\Facades\Cloudder;

class DoctorController extends Controller
{
    use GlobalService;
    public function getDoctorDetails($doctorid)
    {
        try {
            if (isset($doctorid)) {
                //Fetch Single patient records
                $doctor = Doctor::where('doctor_id', $doctorid)->first();
            } else {
                //All Patients
                $doctor = Doctor::all();
            }

            $response_message = array('success' => true, 'data' => $doctor);
            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error');
            return response()->json($response_message);
        }
    }

    public function updateDoctorDetails(Request $request)
    {
        $doctor = Doctor::find($request->doctorId);

        $validator = Validator::make($request->all(), [
            'bio' => 'required',
        ]);

        if ($validator->fails()) {
            $response_message = array('success' => false, 'message' => 'Missaing Params');
            return response()->json($response_message);
        }

        $doctor->first_name = $request->firstName;
        $doctor->last_name = $request->lastName;
        $doctor->phone = $request->phone;
        $doctor->email = $request->email;
        $doctor->country = $request->country;
        $doctor->address = $request->address;
        $doctor->gender = $request->gender;
        $doctor->bio = $request->bio;

        try {
            if ($doctor->save()) {
                $response_message = array('statusCode' => 201, 'success' => true, 'message' => 'Record updated');
                return response()->json($response_message);
            } else {
                $response_message = array('statusCode' => 404, 'success' => false, 'message' => 'Unknown Resource');
                return response()->json($response_message);
            }
        } catch (\Exception $e) {
            $response_message = array('statusCode' => 500, 'success' => false, 'message' => 'Internal Server Error ');
            return response()->json($response_message);
        }

    }

    /********************************
     * Renders doctor questions page
     */
    public function renderDoctorQuestionsPage()
    {
        $username = $_SESSION['doctor_username'];
        $thumbnail = $_SESSION['thumbnail'];
        return view('doctor_views.questions', ['username' => $username, 'thumbnail' => $thumbnail]);
    }

    /**
     * Renders doctor answered questions page
     */
    public function renderDoctorAnsweredQuestionsPage()
    {
        $username = $_SESSION['doctor_username'];
        $thumbnail = $_SESSION['thumbnail'];
        return view('doctor_views.answered_questions', ['username' => $username, 'thumbnail' => $thumbnail]);
    }

    /**
     * Renders doctor account settings page
     */
    public function renderAccountSettingsPage()
    {
        $username = $_SESSION['doctor_username'];
        $thumbnail = $_SESSION['thumbnail'];
        $doctorDetails = Doctor::find($_SESSION['doctor_id']);
        return view('doctor_views.account_settings', ['username' => $username, 'thumbnail' => $thumbnail, 'doctorDetails' => $doctorDetails]);
    }

    /**
     * Renders doctor question details page
     */
    public function renderQuestionDetailsPage($questionCode)
    {
        $username = $_SESSION['doctor_username'];
        $thumbnail = $_SESSION['thumbnail'];
        $questionId = Question::where('question_code', $questionCode)->first()['question_id'];
        return view('doctor_views.question_details', ['username' => $username, 'thumbnail' => $thumbnail, 'questionCode' => $questionCode, 'questionId' => $questionId]);
    }

    /**
     * Gets Doctor Questions
     */
    public function getDoctorsQuestions()
    {
        $data = array();

        $userQuestions = Question::where('question_answered', 'no')->where('question_closed', 'no')->orderBy('question_id', 'desc')->get();
        foreach ($userQuestions as $key => $value) {
            $temp_array['question_id'] = $value['question_id'];
            $temp_array['patient_id'] = $value['patient_id'];
            $temp_array['patient_username'] = User::find($value['patient_id'])->username;
            $temp_array['question_cat_id'] = $value['question_cat_id'];
            $temp_array['question_closed'] = $value['question_closed'];
            $temp_array['question_answered'] = $value['question_answered'];
            $temp_array['question_content'] = $value['question_content'];
            $temp_array['question_code'] = $value['question_code'];
            $temp_array['question_media_url'] = $value['question_media_url'];
            $temp_array['created_at'] = $value['created_at'];
            $questionCategoryDetails = QuestionCategory::find($value['question_cat_id']);
            $temp_array['question_category'] = $questionCategoryDetails->category_name;

            if ($value['question_answered'] == 'no') {
                $temp_array['response_doctor'] = "n/a";
            } else {
                $getQuestionAnswerStatus = QuestionResponse::where('ques_id', $value['question_id'])->get();

                $getDoctorAnsweringStatus = QuestionResponse::where('ques_id', $value['question_id'])->where('responder_type', 'doctor')->first();
                if ($getDoctorAnsweringStatus) {
                    $doctorDetails = Doctor::find($getDoctorAnsweringStatus['responder_id']);
                    $temp_array['response_doctor'] = $doctorDetails->first_name . " " . $doctorDetails->last_name;
                } else {
                    $temp_array['response_doctor'] = "n/a";
                }
            }

            array_push($data, $temp_array);
        }

        $response_message = array('success' => true, 'message' => 'user question got successfully', 'data' => $data);
        return response()->json($response_message);
    }

    /**
     * Gets Doctor Answered Questions
     */
    public function getDoctorAnsweredQuestions()
    {
        session_start();
        $doctorId = $_SESSION['doctor_id'];
        $data = array();

        $userQuestions = DB::select("SELECT * FROM questions WHERE question_id IN (SELECT DISTINCT ques_id FROM question_responses  WHERE responder_type = 'doctor' AND responder_id = $doctorId)");

        $userQuestions = (array) $userQuestions;

        foreach ($userQuestions as $value) {
            $temp_array['question_id'] = $value->question_id;
            $temp_array['patient_id'] = $value->patient_id;
            $temp_array['patient_username'] = User::find($value->patient_id)->username;
            $temp_array['question_cat_id'] = $value->question_cat_id;
            $temp_array['question_closed'] = $value->question_closed;
            $temp_array['question_answered'] = $value->question_answered;
            $temp_array['question_content'] = $value->question_content;
            $temp_array['question_code'] = $value->question_code;
            $temp_array['question_media_url'] = $value->question_media_url;
            $temp_array['created_at'] = $value->created_at;
            $questionCategoryDetails = QuestionCategory::find($value->question_cat_id);
            $temp_array['question_category'] = $questionCategoryDetails->category_name;

            if ($value->question_answered == 'no') {
                $temp_array['response_doctor'] = "n/a";
            } else {
                $getQuestionAnswerStatus = QuestionResponse::where('ques_id', $value->question_id)->get();

                $getDoctorAnsweringStatus = QuestionResponse::where('ques_id', $value->question_id)->where('responder_type', 'doctor')->first();
                if ($getDoctorAnsweringStatus) {
                    $doctorDetails = Doctor::find($getDoctorAnsweringStatus['responder_id']);
                    $temp_array['response_doctor'] = $doctorDetails->first_name . " " . $doctorDetails->last_name;
                } else {
                    $temp_array['response_doctor'] = "n/a";
                }
            }

            array_push($data, $temp_array);
        }

        $response_message = array('success' => true, 'message' => 'doctor questions got successfully', 'data' => $data);
        return response()->json($response_message);
    }

    /**
     * Gets question details
     */
    public function getQuestionDetails(Request $request)
    {
        session_start();
        $doctor_id = $_SESSION['doctor_id'];
        $data = array();
        $questionsArray = array();

        $userQuestion = Question::where('question_code', $request->questionCode)->first();

        if ($userQuestion) {
            $data['question_code'] = $userQuestion['question_code'];
            $questionCategoryDetails = $userQuestion['question_cat_id'];
            $data['question_category'] = QuestionCategory::find($userQuestion['question_cat_id'])->category_name;
            $data['question_id'] = $userQuestion['question_id'];
            $data['question_closed'] = $userQuestion['question_closed'];
            $data['question_answered'] = $userQuestion['question_answered'];
            $data['patient_id'] = $userQuestion['patient_id'];
            $data['patient_username'] = User::find($userQuestion['patient_id'])->username;

            $question_temp_array['question_content'] = $userQuestion['question_content'];
            $question_temp_array['question_media_url'] = $userQuestion['question_media_url'];
            $question_temp_array['created_at'] = $userQuestion['created_at'];
            $question_temp_array['creator'] = User::find($userQuestion['patient_id'])->username;

            array_push($questionsArray, $question_temp_array);

            $questionResponses = QuestionResponse::where('ques_id', $userQuestion['question_id'])->get();
            if (count($questionResponses) > 0) {

                foreach ($questionResponses as $k => $v) {
                    $question_temp_array['question_content'] = $v['question_response_content'];
                    $question_temp_array['question_media_url'] = $v['question_response_media_url'];
                    $question_temp_array['created_at'] = $v['created_at'];

                    if ($v['responder_type'] == 'user') {
                        $question_temp_array['creator'] = User::find($v['responder_id'])->username;
                    } else {
                        $question_temp_array['creator'] = 'Me';
                    }

                    $question_temp_array['created_at'] = $v['created_at'];

                    array_push($questionsArray, $question_temp_array);
                }
            }

            $data['question_threads'] = $questionsArray;
        }

        $response_message = array('success' => true, 'message' => 'user question got successfully', 'data' => $data);
        return response()->json($response_message);
    }

    public function doctorReplyQuestion(Request $request)
    {

        if ($request->hasFile('questionMedia')) {
            $public_id = "bisa_question_media_" . time();
            Cloudder::upload($request->file('questionMedia')->getRealPath(), $public_id, array('folder' => 'question_media'));
            $upload_result = Cloudder::getResult();

            if ($upload_result) {
                session_start();
                $questionResponse = new QuestionResponse();
                $questionResponse->ques_id = $request->questionId;
                $questionResponse->responder_id = $request->doctorId;
                $questionResponse->responder_type = 'doctor';
                $questionResponse->question_response_media_url = $request->mediaUrl;
                $questionResponse->question_response_content = $request->questionContent;

                $questionResponse->file_type = $request->fileType;
                $questionResponse->file_extension = $request->fileExtention;

                if ($questionResponse->save()) {

                    $question = Question::find($request->questionId);
                     $question->question_answered = 'yes';
                    //$question->question_answered = 'not known';
                    $question->save();

                    /* send message to the customers */
                    // $replyPatientId = $question->patient_id;
                    // $findPatient = Patient::find($replyPatientId);
                    // if ($findPatient) {
                    //     $getNumber = $findPatient->phone;
                    //     if ($getNumber) {
                    //         $message = 'A doctor  has replied your message';
                    //         sendSMS($getNumber, $message);
                    //     }
                    // }
                    /**end of send message */
                    $updateQuestionStatus = DB::table('questions')->where('question_id', $request->questionId)->update(['read' => 0]);

                    $data = array('userId' => $_SESSION['doctor_id'], 'questionId' => $request->questionId, 'responderType' => 'doctor', 'questionContent' => $request->questionContent, 'questionMedia' => $upload_result['secure_url']);

                    $response_message = array('success' => true, 'message' => 'reply submitted successfully', 'data' => $data);
                    //Push Notifitcation

                    $notification = new PushNotification();
                    //$sendPush = $notification->sendPushNotification($request->doctorId,$request->questionId,$request->questionContent);

                    return response()->json($response_message);
                } else {
                    $response_message = array('success' => false, 'message' => 'Could not submit reply. Please check your internet connection and try again');
                    return response()->json($response_message);
                }
            } else {
                $response_message = array('success' => false, 'message' => 'Could submit reply. Please check your internet connection');
                return response()->json($response_message);
            }

        } else {
            //session_start();
            $questionResponse = new QuestionResponse();
            $questionResponse->ques_id = $request->questionId;
            $questionResponse->responder_id = $request->doctorId;
            $questionResponse->responder_type = 'doctor';
            $questionResponse->question_response_media_url = $request->mediaUrl;
            $questionResponse->question_response_content = $request->questionContent;

            $questionResponse->file_type = $request->fileType;
            $questionResponse->file_extension = $request->fileExtention;

            if ($questionResponse->save()) {

                $question = Question::find($request->questionId);
                $question->question_answered = 'yes';
                $question->save();

                // /* send message to the customers */
                // $replyPatientId = $question->patient_id;
                // $findPatient = Patient::find($replyPatientId);
                // if ($findPatient) {
                //     $getNumber = $findPatient->phone;
                //     if ($getNumber) {
                //         $message = 'A doctor  has replied your message';
                //         sendSMS($getNumber, $message);
                //     }
                // }
                /**end of send message */
                $data = array('userId' => $request->doctorId, 'questionId' => $request->questionId, 'responderType' => 'doctor', 'questionContent' => $request->questionContent, 'questionMedia' => $request->mediaUrl);

                $response_message = array('success' => true, 'message' => 'reply submitted successfully', 'data' => $data);

                //Push Notifitcation
                $notification = new PushNotification();
                //$sendPush = $notification->sendPushNotification($request->doctorId,$request->questionId,$request->questionContent);

                //return $sendPush;

                return response()->json($response_message);

            } else {
                $response_message = array('success' => false, 'message' => 'Could not submit reply. Please check your internet connection and try again');
                return response()->json($response_message);
            }
        }
    }

    /**
     * Close question thread
     */
    public function closeQuestion(Request $request)
    {
        $question = Question::find($request->questionId);
        $question->question_closed = 'yes';
        if ($question->save()) {
            $response_message = array('success' => true, 'message' => 'question closed successfully');
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'Could not close question. Please check your internet connection and try again');
            return response()->json($response_message);
        }
    }

    /**
     * Reset doctor profile photo
     */
    public function resetDoctorProfilePhoto(Request $request)
    {
        if ($request->hasFile('doctorThumbnail')) {
            $public_id = "bisa_doctor_thumbnail_" . time();
            Cloudder::upload($request->file('doctorThumbnail')->getRealPath(), $public_id, array('folder' => 'doctor_thumbnails'));
            $upload_result = Cloudder::getResult();

            if ($upload_result) {
                session_start();
                $currentDoctor = Doctor::find($_SESSION['doctor_id']);
                $currentDoctor->thumbnail = $upload_result['secure_url'];

                if ($currentDoctor->save()) {
                    $response_message = array('success' => true, 'message' => 'Profile Photo Updated Successfully');
                    return response()->json($response_message);
                } else {
                    $response_message = array('success' => false, 'message' => 'Unable to update profile photo. Please check your internet connection');
                    return response()->json($response_message);
                }
            } else {
                $response_message = array('success' => false, 'message' => 'Unable to update profile photo. Please check your internet connection');
                return response()->json($response_message);
            }
        }
    }

    /**
     * Reset doctor password
     */
    public function resetDoctorPassword(Request $request)
    {
        session_start();
        $doctorId = $_SESSION['doctor_id'];
        $currentDoctor = Doctor::find($doctorId);
        if ($currentDoctor) {
            $oldUserPassword = $currentDoctor->password;
            if (password_verify($request->currentPassword, $oldUserPassword)) {
                $newUserPassword = password_hash($request->newPassword, PASSWORD_DEFAULT);
                $currentDoctor->password = $newUserPassword;
                $currentDoctor->save();
                $response_message = array('success' => true, 'message' => 'Password changed successfully');
                return response()->json($response_message);
            } else {
                $response_message = array('success' => false, 'message' => 'Your current password is incorrect');
                return response()->json($response_message);
            }
        } else {
            $response_message = array('success' => false, 'message' => 'user does not exist');
            return response()->json($response_message);
        }
    }

    /**
     * Reset doctor personal info
     */

    public function resetDoctorPersonalInfo(Request $request)
    {
        session_start();
        $doctorId = $_SESSION['doctor_id'];

        if (Doctor::where('email', $request->email)->where('doctor_id', '<>', $doctorId)->exists() || Admin::where('admin_email', $request->email)->exists() || User::where('email', $request->email)->exists()) {
            $response_message = array('success' => false, 'message' => 'Email already exists');
            return response()->json($response_message);
        } else {
            if (Doctor::where('username', $request->username)->where('doctor_id', '<>', $doctorId)->exists() || Admin::where('admin_username', $request->username)->exists() || User::where('username', $request->username)->exists()) {
                $response_message = array('success' => false, 'message' => 'Username already exists');
                return response()->json($response_message);
            } else {
                $doctor = Doctor::find($doctorId);
                $doctor->first_name = $request->firstName;
                $doctor->last_name = $request->lastName;
                $doctor->username = $request->username;
                $doctor->email = $request->email;
                $doctor->phone = $request->phone;
                $doctor->address = $request->address;
                $doctor->bio = $request->bio;

                $_SESSION['username'] = $request->username;

                if ($doctor->save()) {
                    $response_message = array('success' => true, 'message' => 'Doctor info updated');
                    return response()->json($response_message);
                }
            }
        }

    }

    public function getDoctorWorkflowItems($doctorId)
    {

        $data = DB::table('patients')->join('questions', 'patients.user_id', '=', 'questions.patient_id')->join('pvt_workflow', 'pvt_workflow.ques_id', '=', 'questions.question_id')
            ->select('questions.*', 'patients.first_name', 'patients.last_name', 'patients.username', 'patients.date_of_birth')->where('pvt_workflow.doctor_id', '=', $doctorId)->orderBy('questions.updated_at', 'DESC')->get();

        return $data;
    }

    public function rateDoctor(Request $request)
    {

        $now = $this->longDate();
        $patientId = $this->sanitizeString($request->patientId);
        $doctorId = $this->sanitizeString($request->doctorId);
        $numberOfStarts = $this->sanitizeString($request->numberOfStarts);
        $comments = $this->sanitizeString($request->comments);

        $validator = Validator::make($request->all(), [
            'patientId' => 'required',
            'doctorId' => 'required',
            'numberOfStars' => 'required|max:5|int|min:1',
            'comments' => 'required',
        ]);
        $errors = $validator->errors();
        if ($validator->fails()) {
            //Failed validation
            $response_message = array('statusCode' => 422, 'success' => false, 'message' => 'Missing Parameter Values', 'errors' => $errors);
            return response()->json($response_message);
        } else {
            //Valadation passed
            try {

            } catch (\Exception $e) {

            }
        }

    }

}
