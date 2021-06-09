<?php

namespace App\Http\Controllers;

use App;
use App\Core\GlobalService;
use App\Core\MakesApiRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    use AuthenticatesUsers;
    use GlobalService;
    use MakesApiRequest;

    public function __construct()
    {
        //$this->middleware('auth');
    }

    public function damydash(Request $request)
    {
        return view('layouts.dashboard');
    }

    public function showPatientDashboard()
    {
        $patientUnreadMessage = $this->getReponseCountAll();
        $allUnreadMessages = $patientUnreadMessage->messageCount;
        $userId = Session::get('user_id');

        $unreadMessages = $this->userUnreadMessages($userId);
        $userUnreadMessages = $unreadMessages->messageCount;

        $allArticles = $this->countAllArticles();
        $countArticles = $allArticles->article_count;

        $hospitals = $this->fetchAllHospitals();
        $countHospitals = $hospitals->record_count;

        $pharmacies = $this->fetchAllPharmacies();
        $countPharmacies = $pharmacies->record_count;

        $latestArticlesData = $this->latestArticles();
        $latestArticles = $latestArticlesData->data;

        $questionCategories = $this->getQuestionCategories();
        $getQuestionsCategory = $questionCategories->data;

        $getUserReadResponses = $this->countUserReadResponses($userId);

        $country = 'ghana';
        if (App::isLocale('fr')) {
            $country = 'senegal';
        }
        $fetchCoronaData = $this->getCoronaData($country);
        Session::put('user_unread_messagges', $userUnreadMessages);
        return view('layouts.patients.patient_home', compact('getQuestionsCategory', 'latestArticles', 'countPharmacies', 'allUnreadMessages', 'userUnreadMessages', 'countArticles', 'countHospitals', 'getUserReadResponses', 'fetchCoronaData'));
    }

    public function covidStatistics()
    {
        //Get Corona Data
        try {
            $fetchCoronaData = $this->getCoronaData();
            $response_message = array('success' => true, 'message' => $fetchCoronaData);
            return $response_message;

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => __('Internal Server Error'));
            return response()->json($response_message);
        }

    }

    public function covidStatisticsByCountry($country)
    {
        //Get Corona Data
        try {
            $fetchCoronaData = $this->getCoronaData($country);
            $response_message = array('success' => true, 'message' => $fetchCoronaData);
            return $response_message;

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => __('Internal Server Error'));
            return response()->json($response_message);
        }
    }

    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        $connectionType = $this->getLocalConnection();

        if ($validator->fails()) {
            return redirect('/')->withErrors($validator)->withInput();
        } else {
            $email = $this->sanitizeString($request->email);
            $password = $this->sanitizeString($request->password);

            //Fetch the user and retrive email field
            $getUser = \DB::connection($connectionType)->table('sys_users')->select('email')->where('username', '=', $email)->orWhere('email', '=', $email)->first();

            if (empty($getUser)) {
                Session::flash('message', __('User not found'));
                Session::flash('alert-class', 'alert-danger');
                return redirect()->to('/');
            } else {
                $userEmail = $getUser->email;
            }

            if (Auth::attempt(['email' => $userEmail, 'password' => $password])) {
                //Request user details and redirect accordingly
                $userData = $this->useRoles($userEmail);
                //  dd($userData);

                if ($userData->statusCode === 403) {
                    Session::flash('message', __('Invalid account'));
                    Session::flash('alert-class', 'alert-danger');
                    return redirect()->back();
                } elseif ($userData->statusCode === 201 && !empty($userData->data)) {

                    $value = $userData->data;

                    $userRole = $userData->data->role;

                    $fullname = $value->first_name . ' ' . $value->last_name;
                    if ($value->first_name == 'n_a' && $value->last_name == 'n_a' || $value->first_name == 'n/a' && $value->last_name == 'n/a') {
                        $fullname = ' ';
                    }
                    Session::put('user_role', $userRole);
                    Session::put('email', $value->email);
                    Session::put('full_name', $fullname);
                    Session::put('user_id', $value->user_id);
                    Session::put('user_token', $value->token);
                    Session::put('user_thumbnail', $value->user_thumbnail);
                    Session::put('is_follow_up', $value->is_follow_up);
                    ($userRole == 'doctor') ? (array_key_exists('permission', $value) ? Session::put('doctor_permission', $value->permission) : 'doctor') : '';

                    ($userRole == 'admin') ? Session::put('admin_type', $value->admin_type) : '';

                    $patientUnreadMessage = $this->getReponseCountAll();
                    $allUnreadMessages = $patientUnreadMessage->messageCount;
                    Session::put('user_unreadmessages', $allUnreadMessages);

                    switch ($userRole) {

                        case 'doctor':
                            Session::put('hospital_id', $value->hospital_id);
                            return redirect('/doctor/dashboard');

                            break;

                        case 'patient':
                            return redirect('/patient/dashboard');
                            break;

                        case 'hospital_admin':
                            return view('layouts.hospital.hospital_home');
                            break;

                        case 'admin':
                            return redirect('admin/dashboard');
                            break;

                        default:
                            return view('layouts.patients.patient_home');
                            break;
                    }
                } else {
                    Session::flash('message', __('Invalid account'));
                    Session::flash('alert-class', 'alert-danger');

                    return redirect()->back();
                }

            } else {

                //Flash Message to the session
                Session::flash('message', __('Invalid username or password'));
                Session::flash('alert-class', 'alert-danger');

                return redirect()->back();
            }
        }

    }

    public function signUp(Request $request)
    {
        $connectionType = $this->getLocalConnection();
        $countries = \DB::connection($connectionType)->table('tab_country')->select('ctryid', 'country')->get();

        return view('signup', compact('countries'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email',
            'phone' => 'required',
            'gender' => 'required',
            'country' => 'required',
            'password' => 'required|confirmed|min:6',
            'date_of_birth' => 'required',
        ]);

        if ($validator->fails()) {
            Session::flash('message_error', __('Submission failed. Please correct any errors on the form and try again'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $first_name = $this->sanitizeString($request->first_name);
        $last_name = $this->sanitizeString($request->last_name);
        $email = $this->sanitizeString($request->email);
        $userPhone = $this->sanitizeString($request->phone);
        $gender = $this->sanitizeString($request->gender);
        $country = $this->sanitizeString($request->country);
        $dof = $this->sanitizeString($request->date_of_birth);
        $password = $this->sanitizeString($request->password);
        $followUp = $this->sanitizeString($request->follow_up);
        $bloodGroup = $this->sanitizeString($request->blood_group);
        $knownConditions = $this->sanitizeString($request->known_condition);
        $location = $this->sanitizeString($request->location);

        // $phone = $this->formatPhone($userPhone);
        $phone = $userPhone;

        $data = [
            'firstName' => $first_name,
            'lastName' => $last_name,
            'phone' => $phone,
            'email' => $email,
            'password' => $password,
            'country' => $country,
            'address' => $location,
            'imageUrl' => '',
            'gender' => $gender,
            'dateOfBirth' => $dof,
            'followUp' => $followUp,
            'bloodGroup' => $bloodGroup,
            'knownCondition' => $knownConditions,
            'token' => "5c20d216f981585fe92e",
            'source' => 'web',
        ];

      $response = $this->addNewPatient($data);

   
        if ($response->success == true) {
            //Redirect to verification page
            $userEmail = $response->email;
            $userPhone = $response->phone;
            $username = $response->username;
            $token = $response->userToken;
            $verificationCode = $response->verificationCode;

            Session::flash('success', $response->message);
            if ($followUp == 0) {
                return redirect()->to('/');
            } else {
                return redirect()->to('/patient/covid/follow');
            }

            //return redirect()->action('UserController@showVierificationForm', ['ticket'=>$token,'phone'=>$userPhone]);
        } else {
            Session::flash('message', __("Invalid username or  password"));
            return redirect()->back();
        }

    }

    public function updatePatientDetails(Request $request)
    {

        $firstName = $this->sanitizeString($request->first_name);
        $lastName = $this->sanitizeString($request->last_name);
        $email = $this->sanitizeString($request->email);
        $phone = $this->sanitizeString($request->phone);
        $dob = $this->sanitizeString($request->dob);
        $gender = $this->sanitizeString($request->gender);
        $country = $this->sanitizeString($request->country);
        $address = $this->sanitizeString($request->address);

        $fullName = $firstName . ' ' . $lastName;
        Session::put('full_name', $fullName);
        $token = Session::get('user_token');
        $userId = Session::get('user_id');
        $data = [
            'patientId' => $userId,
            'firstName' => $firstName,
            'lastName' => $lastName,
            'phone' => $phone,
            'email' => $email,
            'country' => $country,
            'address' => $address,
            'gender' => $gender,
            'dateOfBirth' => $dob,
            'token' => $token,
        ];
        $response = $this->updatePatientData($data);

        if ($response->success == true) {
            Session::flash('message', __('Update Successful'));
            return redirect()->to('/user-profile');
        } else {
            Session::flash('error_message', __('Failed update'));
            return redirect()->to('/user-profile');
        }

    }

    public function anonymousSignup()
    {
        return view('anonymous_signup');
    }

    public function showVierificationForm(Request $request)
    {
        $phone = $request->phone;
        $ticket = $request->ticket;
        return view('layouts.verify_account', compact('phone', 'ticket'));
    }

    public function postAnonymousSignUp(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            Session::flash('message_error', __('Submission failed. Please correct any errors on the form and try again'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $username = $this->sanitizeString($request->username);
        $password = $this->sanitizeString($request->password);

        $data = [
            'username' => $username,
            'password' => $password,
        ];

        $response = $this->addAnonymousUser($data);
        $responseStatus = $response->success;

        switch ($responseStatus) {
            case true:
                Session::flash('success', __("Signup successful! Please login with your username and password"));
                return redirect()->to('/');
                break;

            case false:
                Session::flash('message_error', __('Unable to signup. Please again'));
                return redirect()->back();
                break;

            default:

                break;
        }
    }

    public function verify(Request $request)
    {
        $data = [
            'verificationCode' => $request->code,
            'token' => $request->token,
        ];

        $response = $this->verifyAccount($data);
        return $response;
    }

    public function showUserProfilePage()
    {
        $userId = Session::get('user_id');
        $response = $this->fetchPatientDetails($userId);
        $success = $response->success;

        if ($success == true) {
            $patientDetails = $response->data;

            return view('layouts.users.user_profile', compact('patientDetails'));
        } else {
            Session::flash('message_error', __('Unable to load your profile'));
            return redirect()->back();
        }

    }

    public function updatePassword(Request $request)
    {
        $userId = Session::get('user_id');
        $token = Session::get('user_token');
        $oldPassword = $this->sanitizeString($request->old_password);
        $newPassword = $this->sanitizeString($request->new_password);

        $data = [
            'userId' => $userId,
            'oldPassword' => $oldPassword,
            'newPassword' => $newPassword,
            'token' => $token,
        ];

        $response = $this->changePassword($data);

        switch ($response->statusCode) {
            case 201:
                Session::flash('message', __('Password successfully changed'));
                return '201';
                break;

            case 404:
                Session::flash('message', __('Invalid credentials'));
                return '404';
                break;

            case 500:
                Session::flash('message', __('General Error'));
                return '404';
                break;

            default:
                Session::flash('message', __('General Error'));
                return '404';
                break;
        }

    }

    public function uploadProfileImage(Request $request)
    {
        $userId = Session::get('user_id');
        $userRole = Session::get('user_role');
        $token = Session::get('user_token');
        $public_id = $userId . "_media_" . time();

        $patientController = new PatientController();

        if ($request->hasFile('file_upload')) {

            $extension = $request->file_upload->extension();
            $fileType = $patientController->getFileType($extension);
            switch ($fileType) {
                case "image":
                    \Cloudder::upload($request->file('file_upload')->getRealPath(), $public_id, array('folder' => 'user_profile'));
                    $c = \Cloudder::getResult();
                    $mediaUrl = $c['secure_url'];

                    $data = ['userId' => $userId, 'profileUrl' => $mediaUrl, 'userRole' => $userRole, 'token' => $token];
                    $response = $this->updateUserImage($data);
                    if ($response == true) {
                        Session::put('user_thumbnail', $mediaUrl);
                        Session::flash('message', __('Profile Updated'));
                        return redirect()->back();
                    }
                    break;

                case "audio":
                    Session::flash('message_error', __('Unsupported file format. Please select an image file and try again'));
                    return redirect('/user-profile');
                    break;

                case "file":
                    Session::flash('message_error', __('Unsupported file format. Please select an image file and try again'));
                    break;

                default:
                    Session::flash('message_error', __('Unsupported file format. Please select an image file and try again'));
                    return redirect('patient/chathistory');
            }
        }

    }

    public function initiatePasswordReset(Request $request)
    {
        $email = $request->email;
        $userAgent = $request->server('HTTP_USER_AGENT');
        $ip = $this->getclientip();

        $data = [
            'email' => $email,
            'requestDetails' => $ip . '**' . $userAgent,
        ];
        $response = $this->initiateUserPassword($data);

        if ($response->success == true) {
            Session::flash('success', $response->message);
            return redirect()->to('/reset-link');
        } else {
            Session::flash('message_error', __('Please verify your email address and resend'));
            return redirect()->back();
        }
    }

    public function confirmReset(Request $request)
    {

        return view('layouts.users.resetpassword');
    }

    public function showResetLinkConfirmation()
    {
        return view('layouts.users.reset_link');
    }

    public function showPasswordResetForm()
    {
        return view('layouts.users.password_reset_form');
    }

    public function verifyPasswordResetCode($code)
    {
        $requestCode = $code;

        //Check password code
        $response = $this->checkPasswordRestCode($requestCode);

        if ($response->statusCode == 201) {
            $email = $response->email;

            Session::put('temp_email', $email);
            return redirect('/user-password-reset')->with('email', $email);
        } else {
            Session::flash('message_error', __('Reset Code Expired. Please try again'));
            return redirect()->to('/forgotten-password');
        }

    }

    public function changeUserPassword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            // 'email' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails()) {
            Session::flash('message_error', __('Unable to reset password'));
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = Session::get('temp_email');
        $password = $this->sanitizeString($request->password);
        $data = ['email' => $email, 'password' => $password];
        $response = $this->changePasswordWithoutToken($data);

        switch ($response->statusCode) {
            case 201:
                Session::flash('success', __('Reset successful. Login with your new password'));
                session()->forget('temp_email');
                return redirect()->to('/');
                break;

            case 404:
                Session::flash('message', __('Email does not exist'));
                return redirect()->to('/user-password-reset');
                break;

            case 500:
                Session::flash('message', __('General Error. Please try again later'));
                return redirect()->to('/user-password-reset');
                break;

            default:
                Session::flash('message', __('General Error. Please try again later'));
                return redirect()->to('/forgotten-password');
                break;
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();
        Session::flash('success', __('You are now logged out'));
        return $this->loggedOut($request) ?: redirect('/');
    }

}
