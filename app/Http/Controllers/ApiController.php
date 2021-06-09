<?php
namespace App\Http\Controllers;

use App\Core\GlobalService;
use App\Helpers\CustomMailer;
use App\Helpers\CustomSMS;
use App\Helpers\HelperFunctions;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PushNotification;
use App\Models\Admin;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Doctor;
use App\Models\HealthResource;
use App\Models\PasswordRequest;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionResponse;
use App\Models\SmsVerficication;
use App\Models\User;
use App\Models\UserHealthInfo;
use App\Models\Video;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\Validator;
use App\Traits\ResponseTrait;
class ApiController extends Controller
{
    /**
     * Create new user account
     */
    use GlobalService;
    use ResponseTrait;
    public function createUserAccount(Request $request)
    {

        if (User::where('email', $request->email)->exists() || Doctor::where('email', $request->email)->exists() || Admin::where('admin_email', $request->email)->exists()) {
            $response_message = array('success' => false, 'message' => "Email already taken");
            return response()->json($response_message);
        } else {
            if (User::where('phone', $request->phone)->exists() || Doctor::where('phone', $request->phone)->exists()) {
                $response_message = array('success' => false, 'message' => "Phone number already taken");
                return response()->json($response_message);
            } else {
                $hashedPassword = password_hash($request->password, PASSWORD_DEFAULT);
                $user = new User();
                $userToken = substr(md5(time()), 0, 20);
                $username = substr($request->firstName, 0, 3) . substr($request->lastName, 0, 3) . "_" . substr(md5(time() + rand()), 0, 4);

                $user->first_name = $request->firstName;
                $user->last_name = $request->lastName;
                $user->username = $username;
                $user->phone = $request->phone;
                $user->email = $request->email;
                $user->password = $hashedPassword;
                $user->country = $request->country;
                $user->type = 'known';
                $user->active = 1;
                $user->token = $userToken;

                if ($user->save()) {
                    // generate code and send sms to user
                    $verificationCode = rand(1000, 9999);
                    $messageBody = $verificationCode . " is your Bisa Fr activation code. Thank you for joining us.";
                    $customSMS = new CustomSMS();
                    $send_sms = $customSMS->sendSMS($request->phone, $messageBody);
                    if ($send_sms) {
                        $smsVerification = new SmsVerficication();
                        $smsVerification->uid = $user->user_id;
                        $smsVerification->phone_number = $request->phone;
                        $smsVerification->code = $verificationCode;
                        $smsVerification->save();

                        $response_message = array('success' => true, 'message' => 'Signup successful', 'userType' => 'known', 'userToken' => $userToken, 'userId' => $user->user_id, 'smsVerificationSent' => true, 'username' => $username);
                        return response()->json($response_message);
                    }

                    $response_message = array('success' => true, 'message' => 'Signup successful', 'userType' => 'known', 'userToken' => $userToken, 'userId' => $user->user_id, 'smsVerificationSent' => false, 'username' => $username);
                    return response()->json($response_message);

                } else {
                    $response_message = array('success' => false, 'message' => 'Unable to signup.Please check internet connection');
                    return response()->json($response_message);
                }
            }

        }
    }

    /**
     * Create new anonymous user account
     */
    public function createAnonymousUserAccount(Request $request)
    {
        try {
            if (User::where('username', $request->username)->exists() || Doctor::where('username', $request->username)->exists() || Admin::where('admin_username', $request->username)->exists()) {
                $response_message = array('success' => false, 'message' => "Username already taken");
                return response()->json($response_message);
            } else {
                $patient = new Patient();
                $hashedPassword = Hash::make($request->password);
                $token = substr(md5(time()), 0, 20);
                $username = $request->username;
                $fmtDateOfBirth = 'n/a';
                $now = $this->longDate();

                $rand = rand();
                $patient->first_name = 'n_a';
                $patient->last_name = 'n_a';
                $patient->username = $username;
                $patient->phone = 'n_a';
                $patient->email = $username . rand();
                $patient->country = 'n_a';
                $patient->address = 'n_a';
                $patient->profile_image = 'n_a';
                $patient->gender = 'n_a';
                $patient->date_of_birth = 'n_a';
                $patient->type = 'anonymous';
                $patient->active = 1;
                $patient->token = $token;
                $patient->created_at = $now;

                //Profile User
                $userProfile = new User();
                $userStatus = 1;
                if ($patient->save()) {
                    $activateAccount = $userProfile->createUser($username, $rand, $hashedPassword, 'patient', $patient->user_id, $token, $userStatus, $rand);
                    $response_message = array('success' => true, 'message' => 'Signup successful', 'userType' => 'anonymous', 'userToken' => $token, 'userId' => $patient->user_id, 'username' => $request->username);
                    return response()->json($response_message);
                } else {
                    $response_message = array('success' => false, 'message' => 'Unable to signup');
                    return response()->json($response_message);
                }
                // $hashedPassword = password_hash($request->password, PASSWORD_DEFAULT);
                // $user = new User();
                // $userToken = substr(md5(time()),0, 20);

                // $user->username = $request->username;
                // $user->password = $hashedPassword;
                // $user->token = $userToken;

            }
        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'General Error');
            return response()->json($response_message);
        }

    }

    /**
     * Sign in user account
     */
    public function signInUserAccount(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->latest()->first();
            $hashedPassword = $user['password'];
            if (password_verify($request->password, $hashedPassword)) {

                $userType = $user['type'];
                $userToken = $user['token'];
                $userId = $user['user_id'];
                $username = $user['username'];

                $userCodeCheck = SmsVerficication::where('uid', $userId)->latest()->first();
                if ($userCodeCheck) {
                    if ($userCodeCheck->status == 'pending') {
                        $response_message = array('success' => true, 'message' => 'Login successful', 'userType' => $userType, 'userToken' => $userToken, 'userId' => $userId, 'PhoneVerified' => false, 'username' => $username);
                        return response()->json($response_message);
                    } else if ($userCodeCheck->status == 'verified') {
                        $response_message = array('success' => true, 'message' => 'Login successful', 'userType' => $userType, 'userToken' => $userToken, 'userId' => $userId, 'PhoneVerified' => true, 'username' => $username);
                        return response()->json($response_message);
                    }

                } else {
                    $response_message = array('success' => true, 'message' => 'Login successful', 'userType' => $userType, 'userToken' => $userToken, 'userId' => $userId, 'PhoneVerified' => false, 'username' => $username);
                    return response()->json($response_message);
                }
            } else {
                $response_message = array('success' => false, 'message' => "Wrong username or password");
                return response()->json($response_message);
            }
        } else {
            $response_message = array('success' => false, 'message' => "Wrong username or password");
            return response()->json($response_message);
        }
    }

    /**
     * Requests user verification code
     */
    public function requestUserVerificationCode(Request $request)
    {
        if (User::where('user_id', $request->userId)->exists()) {
            $userPhoneNumber = "";

            if ($request->phoneNumber) {
                $userPhoneNumber = $request->phoneNumber;
            } else {
                $userPhoneNumber = User::find($request->userId)['phone'];
            }

            $verificationCode = rand(1000, 9999);
            $messageBody = "Your Bisa Fr activation code is $verificationCode";
            $customSMS = new CustomSMS();
            $send_sms = $customSMS->sendSMS($userPhoneNumber, $messageBody);
            if ($send_sms) {
                $smsVerification = new SmsVerficication();
                $smsVerification->uid = $request->userId;
                $smsVerification->phone_number = $userPhoneNumber;
                $smsVerification->code = $verificationCode;

                if ($smsVerification->save()) {
                    $response_message = array('success' => true, 'message' => 'SMS verification code sent');
                    return response()->json($response_message);
                } else {
                    $response_message = array('success' => false, 'message' => 'SMS verification code not sent. Wrong number or internet error');
                    return response()->json($response_message);
                }
            }
        } else {
            $response_message = array('success' => false, 'message' => "Unknown user");
            return response()->json($response_message);
        }
    }

    /**
     * verifies user code
     */
    public function verifyCode(Request $request)
    {
        $userCodeCheck = SmsVerficication::where('uid', $request->userId)->latest()->first();
        if ($userCodeCheck) {
            if ($userCodeCheck->status == 'verified') {
                $response_message = array('success' => false, 'message' => "Code is already verified");
                return response()->json($response_message);
            } else {
                if ($request->verificationCode == $userCodeCheck->code) {
                    $verification = SmsVerficication::find($userCodeCheck->id);
                    $verification->status = 'verified';

                    if ($verification->save()) {

                        // Update user state
                        $affected = \DB::table('sys_users')->where('user_code', $request->userId)->update(['active' => 1]);

                        $response_message = array('success' => true, 'message' => "Code Verified successfully");
                        return response()->json($response_message);
                    }
                } else {
                    $response_message = array('success' => false, 'message' => "Wrong verification code");
                    return response()->json($response_message);
                }
            }

        } else {
            $response_message = array('success' => false, 'message' => "No verification code requested");
            return response()->json($response_message);
        }
    }

    public function verifyAccount(Request $request)
    {
        $fetchUser = User::where('token', $request->token)->latest()->first();
        if ($fetchUser) {
            if ($fetchUser->active == 1) {
                $response_message = array('status' => 409, 'success' => false, 'message' => "Account is already verified");
                return response()->json($response_message);
            } else {
                $verificationCode = $request->verificationCode;
                //
                if ($verificationCode == $fetchUser->remember_token) {
                    //Valid code
                    $affected = \DB::table('sys_users')->where('token', $request->token)->update(['active' => 1, 'remember_token' => ' ']);
                    $response_message = array('status' => 201, 'success' => true, 'message' => "Code Verified successfully");
                    return response()->json($response_message);
                } else {
                    $response_message = array('status' => 309, 'success' => false, 'message' => "Invalid Verification Code");
                    return response()->json($response_message);
                }

            }
        } else {
            $response_message = array('status' => 404, 'success' => false, 'message' => "Account does not exist");
            return response()->json($response_message);
        }

    }

    /**
     * Requests user password
     */
    public function requestPasswordReset(Request $request)
    {
        if (User::where('email', $request->email)->exists()) {
            $user = User::where('email', $request->email)->first();

            $userId = $user->user_id;
            $username = $user->username;
            $userEmail = $user->email;

            $code = substr(md5(time() + rand()), 0, 30);
            $helperFunction = new HelperFunctions();
            $serverName = $helperFunction->getBaseUrl();

            $requestLink = "https://www.app.bisa.com.gh" . "/reset-password/$code";
            //$mailText = '<a href="https:www.app.bisa.com.gh/reset-password/'.$code.'">Reset Password</a>';

            $newTime = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +5 minutes"));

            $mailer = new CustomMailer();

            try {
                $mailer->sendPasswordResetEmail($request->email, $username, $requestLink);
                $passwordRequest = new PasswordRequest();
                $passwordRequest->uid = $userId;
                $passwordRequest->email = $request->email;
                $passwordRequest->request_details = $request->requestDetails;
                $passwordRequest->code = $code;
                $passwordRequest->expires_at = $newTime;
                $passwordRequest->save();
            } catch (\Exception $e) {
                $response_message = array('success' => false, 'message' => "Request Failed. Please try again");
                return response()->json($response_message);
            }

            $response_message = array('success' => true, 'message' => "A password reset link has been sent to $request->email");
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => "Email Address Does Not Exist");
            return response()->json($response_message);
        }
    }

    public function checkPasswordResetCode($code)
    {
        $resetCode = $code;
        $now = date("Y-m-d H:i:s");
        try {
            $user = PasswordRequest::where('code', $resetCode)->first();
            $expireTime = $user->expires_at;
            $userEmail = $user->email;
            if ($now < $expireTime) {
                //Code is valid
                $response_message = array('statusCode' => 201, 'success' => true, 'message' => "Reset your password", 'email' => $userEmail);
                return response()->json($response_message);
            } else {
                $response_message = array('statusCode' => 404, 'success' => false, 'message' => "Reset Code Expired. Please resend code");
                return response()->json($response_message);
            }
        } catch (\Exception $e) {
            $response_message = array('statusCode' => 500, 'success' => false, 'message' => "Request Failed. Please try again");
            return response()->json($response_message);
        }

    }

    /**
     * Get user details
     */
    public function getUserDetails($userId)
    {
        $user = User::find($userId);
        if ($user) {
            if ($user->type == "anonymous") {
                $response_message = array('success' => false, 'message' => "Anonymous user");
                return response()->json($response_message);
            } else {
                $userData = array();

                $userHealthInfo = UserHealthInfo::where('uid', $userId)->first();

                $userData['firstName'] = $user->first_name;
                $userData['lastName'] = $user->last_name;
                $userData['username'] = $user->username;
                $userData['email'] = $user->email;
                $userData['phone'] = $user->phone;
                $userData['gender'] = $user->gender;
                $userData['dateOfBirth'] = $user->date_of_birth;
                $userData['country'] = $user->country;
                $userData['address'] = $user->address;
                $userData['height'] = $userHealthInfo->height;
                $userData['weight'] = $userHealthInfo->weight;
                $userData['health_conditions'] = $userHealthInfo->health_conditions;
                $userData['allergies'] = $userHealthInfo->allergies;
                $userData['current_medication'] = $userHealthInfo->current_medication;
                $userData['other_notes'] = $userHealthInfo->other_notes;

                $data = array("data" => $userData);
                return response()->json($data);
            }

        } else {
            $response_message = array('success' => false, 'message' => "Unknown User");
            return response()->json($response_message);
        }

    }

    /**
     * Reset user details
     */
    public function resetUserDetails(Request $request)
    {
        $userId = $request->userId;
        $user = User::find($userId);
        if ($user) {
            if (User::where('email', $request->email)->where('user_id', '<>', $userId)->exists() || Admin::where('admin_email', $request->email)->exists() || Doctor::where('email', $request->email)->exists()) {
                $response_message = array('success' => false, 'message' => 'Email already exists');
                return response()->json($response_message);
            } else {
                if (User::where('username', $request->username)->where('user_id', '<>', $userId)->exists() || Admin::where('admin_username', $request->username)->exists() || Doctor::where('username', $request->username)->exists()) {
                    $response_message = array('success' => false, 'message' => 'Username already exists');
                    return response()->json($response_message);
                } else {
                    $user = User::find($userId);
                    $user->first_name = $request->firstName;
                    $user->last_name = $request->lastName;
                    $user->username = $request->username;
                    $user->email = $request->email;
                    $user->phone = $request->phone;
                    $user->address = $request->address;
                    $user->gender = $request->gender;
                    $user->country = $request->country;
                    $user->date_of_birth = $request->dateOfBirth;
                    $user->save();

                    $userHealthInfo = UserHealthInfo::where('uid', $userId)->first();
                    $userHealthInfo->height = $request->weight;
                    $userHealthInfo->weight = $request->height;
                    $userHealthInfo->health_conditions = $request->healthConditions;
                    $userHealthInfo->allergies = $request->allergies;
                    $userHealthInfo->current_medication = $request->currentMedication;
                    $userHealthInfo->other_notes = $request->otherNotes;
                    $userHealthInfo->save();

                    $response_message = array('success' => true, 'message' => 'User info updated');
                    return response()->json($response_message);
                }
            }
        } else {
            $response_message = array('success' => false, 'message' => "Unknown User");
            return response()->json($response_message);
        }
    }

    /**
     * Delete user account (for testing only)
     */
    public function deleteUserAccount($userId)
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0");
        DB::statement("DELETE from users WHERE user_id = $userId");
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $response_message = array('success' => true, 'message' => "User deleted successfully");
        return response()->json($response_message);
    }

    /**
     * Gets all health resources
     */
    public function getAllHealthResources()
    {
        $data = HealthResource::all();
        $response_data = array('data' => $data);
        return response()->json($response_data);
    }

    /**
     * Gets details of a health resource
     */
    public function getHealthResourceDetails($resourceId)
    {
        $data = HealthResource::find($resourceId);
        $response_data = array('data' => $data);
        return response()->json($response_data);
    }

    /**
     * Gets all doctors
     */
    public function getAllDoctors()
    {
        $data = Doctor::all();
        $response_message = array('data' => $data);
        return response()->json($response_message);
    }

    /**
     ** Gets all pharmacies
     **/
    public function getAllPharmacies()
    {
        $data = Pharmacy::all();
        $recordCount = count($data);
        $response_message = array('status' => 201, 'success' => true, 'record_count' => $recordCount, 'data' => $data);
        return response()->json($response_message);
    }

    /**
     * Gets details of a pharmacy
     */
    public function getPharmacyDetails($resourceId)
    {
        $data = Pharmacy::find($resourceId);
        $response_data = array('data' => $data);
        return response()->json($response_data);
    }

    /**
     * Get the details of a doctor
     */
    public function getDoctorDetials($doctorId)
    {
        $data = Doctor::find($doctorId);
        $response_message = array('data' => $data);
        return response()->json($response_message);
    }

    /**
     * Gets article categories
     */
    public function getArticleCategories()
    {
        $articleCategories = ArticleCategory::select('category_id', 'category_name')->get();
        $response_data = array('data' => $articleCategories);

        return response()->json($response_data);
    }

    public function getArticleCategoriesWithArticleCount()
    {

        $data = DB::select("SELECT C.category_name, A.article_cat_id,count(*) as number_of_articles FROM articles AS A RIGHT JOIN article_categories AS C ON C.category_id = A.article_cat_id GROUP BY  A.article_cat_id");
        $response_data = array('data' => $data);

        return $response_data;

    }

    public function articleStatistics()
    {
        $articleCount = DB::select("SELECT count(*) number_of_articles FROM articles");

    }

    /**
     * Get articles by category
     */
    public function getArticlesByCategory($articleCategoryName)
    {
        $data = array();
        $articleCategoryId = ArticleCategory::where('category_id', $articleCategoryName)->orWhere('category_name', $articleCategoryName)->first()['category_id'];
        $categoryArticles = Article::where('article_cat_id', $articleCategoryId)->orderBy('article_id', 'desc')->get();

        foreach ($categoryArticles as $key => $value) {
            $tempArray['id'] = $value['article_id'];
            $tempArray['title'] = $value['article_title'];
            $tempArray['thumbnail'] = $value['article_thumbnail'];
            $tempArray['content'] = $value['article_content'];
            $tempArray['upvotes'] = $value['article_upvotes'];
            $tempArray['downvotes'] = $value['article_downvotes'];
            $tempArray['views'] = $value['article_views'];
            $tempArray['category'] = $articleCategoryName;

            array_push($data, $tempArray);
        }

        $response_data = array('data' => $data);
        return response()->json($response_data);
    }

    public function getAllArticleByCategory()
    {
        $categoriesData = array();
        $articlesArr = array();

        $categories = ArticleCategory::select('category_id', 'category_name')->get();

        foreach ($categories as $key => $category) {
            $category_array['category_id'] = $category['category_id'];
            $category_array['category_name'] = $category['category_name'];

            $categoryArticles = Article::select('article_id', 'article_title', 'article_thumbnail', 'article_content')->where('article_cat_id', $category['category_id'])->orderBy('article_cat_id', 'desc')->get();

            $category_array['articles'] = $categoryArticles;
            array_push($categoriesData, $category_array);

        }

        $response_data = array('success' => true,
            'data' => ['categories' => $categoriesData]);
        return response()->json($response_data);

    }

    /**
     * Fetches article by id
     */
    public function fetchArticleById($articleId)
    {
        $article = Article::find($articleId);
        $data = array();

        if ($article) {
            $data['id'] = $article->article_id;
            $data['title'] = $article->article_title;
            $data['thumbnail'] = $article->article_thumbnail;
            $data['content'] = $article->article_content;
            $data['upvotes'] = $article->article_upvotes;
            $data['downvotes'] = $article->article_downvotes;
            $data['views'] = $article->article_views;
            $data['category_id'] = $article->article_cat_id;
            $data['category'] = ArticleCategory::find($article->article_cat_id)->category_name;
        }

        $response_data = array('data' => $data);
        return response()->json($response_data);
    }

    /**
     * Latest articles
     */
    public function getLatestArticles()
    {

        try {
            $latestArticles = Article::orderBy('created_at', 'desc')->limit(5)->get();

            $latestArticles = DB::table('articles')
                ->join('article_categories', 'article_categories.category_id', '=', 'articles.article_id')
                ->select('articles.*', 'article_categories.category_name')->orderBy('articles.created_at', 'DESC')->limit(5)
                ->get();

            $response_data = array('data' => $latestArticles);
            return response()->json($response_data);
        } catch (\Exception $e) {
            $response_data = array('success' => false, 'message' => 'General failure');
            return response()->json($response_data);
        }

    }

    /**
     * Upvotes an article
     */
    public function upvoteArticle($articleId)
    {
        $article = Article::find($articleId);
        $numberOfUpvotes = $article->article_upvotes;
        $updatedUpvotes = $numberOfUpvotes + 1;
        $article->article_upvotes = $updatedUpvotes;

        if ($article->save()) {
            $response_message = array('success' => true, 'message' => 'article upvote successful', 'numberOfUpvotes' => $updatedUpvotes);
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'article upvote unsuccessful', 'numberOfUpvotes' => $numberOfUpvotes);
            return response()->json($response_message);
        }
    }

    /**
     * Downvotes an article
     */
    public function downvoteArticle($articleId)
    {
        $article = Article::find($articleId);
        $numberOfDownvotes = $article->article_downvotes;
        $updatedDownVotes = $numberOfDownvotes + 1;
        $article->article_downvotes = $updatedDownVotes;

        if ($article->save()) {
            $response_message = array('success' => true, 'message' => 'article downvote successful', 'numberOfDownvotes' => $updatedDownVotes);
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'article downvote unsuccessful', 'numberOfDownvotes' => $numberOfDownvotes);
            return response()->json($response_message);
        }
    }

    /**
     * Increases the views of an article
     */
    public function increaseArticleViews($articleId)
    {
        $article = Article::find($articleId);
        $articleViews = $article->article_views;
        $updatedViews = $articleViews + 1;
        $article->article_views = $updatedViews;

        if ($article->save()) {
            $response_message = array('success' => true, 'message' => 'article view increase successful', 'numberOfViews' => $updatedViews);
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'article view increase unsuccessful', 'numberOfViews' => $articleViews);
            return response()->json($response_message);
        }
    }

    /**
     * Gets questions categories
     */
    public function getQuestionCategories()
    {
        $questionCategories = QuestionCategory::select('category_id', 'category_name')->get();
        $response_data = array('data' => $questionCategories);
        return response()->json($response_data);
    }

    /**
     * Uploads question file
     */
    public function uploadQuestionFile(Request $request)
    {
        if ($request->hasFile('questionAttachedFile')) {
            $public_id = "bisa_question_media_" . time();
            Cloudder::upload($request->file('questionAttachedFile')->getRealPath(), $public_id, array('folder' => 'question_media'));
            $upload_result = Cloudder::getResult();

            if ($upload_result) {
                $response_message = array('success' => true, 'message' => 'upload successful', 'url' => $upload_result['secure_url']);
                return response()->json($response_message);
            } else {
                $response_message = array('success' => false, 'message' => 'upload failed');
                return response()->json($response_message);
            }
        }
    }

    public function verifySubscription($userToken)
    {
        //Verify Users Subscription Status
    }

    /**
     * Submits user question
     */
    public function submitUserQuestion(Request $request)
    {
        $question = new Question();
        $question->patient_id = $request->userId;
        $question->question_cat_id = $request->questionCategoryId;
        $question->question_content = $request->questionContent;
        $question->question_media_url = $request->mediaUrl;
        $question->file_type = $request->fileType;
        $question->file_extension = $request->fileExtension;
        $question->question_code = substr(md5(intval(time()) + rand()), 0, 10);
        $question->is_follow_up = $request->isFollowUp;

        try {
            if ($request->hasFile('questionAttachedFile')) {
                $public_id = "bisa_question_media_" . time();

                Cloudder::upload($request->file('questionAttachedFile')->getRealPath(), $public_id, array('folder' => 'question_media'));
                $upload_result = Cloudder::getResult();

                if ($upload_result) {
                    $question->question_media_url = $upload_result['secure_url'];
                } else {
                    $question->question_media_url = "n/a";
                }
            } else {
                $question->question_media_url = $request->mediaUrl;
            }

            //Check Payment Status

            if ($question->save()) {
                $response_message = array('success' => true, 'message' => 'question submitted successfully', 'questionId' => $question->question_id);

                //

                return response()->json($response_message);
            } else {
                $response_message = array('success' => false, 'message' => 'Could not submit question. Please check your internet connection and try again');
                return response()->json($response_message);
            }

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Could not submit question');
            return response()->json($response_message);
        }

    }

    /**
     ** Replies user question
     */
    public function replyUserQuestiona(Request $request)
    {
        $getNumber = '233241849088';

        $customSMS = new CustomSMS();
        $message = 'A doctor  has replied your message';

        $send_sms = $customSMS->sendSMS($getNumber, $message);
        // var_dump($send_sms);
        // if ($getNumber) {

        //     try {
        //         //code...
        //         var_dump(sendSMS($getNumber, $message));

        //     } catch (Exception $e) {

        //         return $e;
        //     }
        // }
    }
    public function replyUserQuestion(Request $request)
    {
        $questionResponse = new QuestionResponse();
        $questionResponse->ques_id = $request->questionId;
        $questionResponse->responder_id = $request->userId;
        $questionResponse->responder_type = $request->responderType;
        $questionResponse->patient_id = $request->patientId;
        $questionResponse->question_response_content = $request->questionContent;
        $questionResponse->file_type = $request->fileType;
        $questionResponse->read = 0;
        $questionResponse->file_extension = $request->fileExtension;
        $questionResponse->question_response_media_url = $request->mediaUrl;

        $patientId = $request->patientId;

        try {
            if ($request->hasFile('questionAttachedFile')) {
                $public_id = "bisa_question_media_" . time();
                Cloudder::upload($request->file('questionAttachedFile')->getRealPath(), $public_id, array('folder' => 'question_media'));
                $upload_result = Cloudder::getResult();

                if ($upload_result) {
                    $questionResponse->question_response_media_url = $upload_result['secure_url'];
                } else {
                    $questionResponse->question_response_media_url = "n/a";
                }
            } else {
                $questionResponse->question_response_media_url = $request->mediaUrl;
            }
            $responderDetails = $this->responderDetails($request->userId, $request->responderType);
            $getResponderName = $responderDetails['firstName'] . ' ' . $responderDetails['lastName'];
            if ($questionResponse->save()) {
                //Update Uread Status
                switch ($request->responderType) {
                    case 'doctor':

                      //  $getNumber = '233241849088';
                        //$message = 'A doctor  has replied your message';
                        //$send_sms = $customSMS->sendSMS($getNumber, $message);
                        //     $findPatient = Patient::find($patientId);
                        // if ($findPatient) {
                        //     $getNumber = $findPatient->phone;

                        //     if ($getNumber) {
                        //         $message = 'A doctor  has replied your message';
                        //         $send_sms = $customSMS->sendSMS($getNumber, $message);

                        //     }
                        // }
                        // $getNumber = '233241849088';
                        // $customSMS = new CustomSMS();
                        // $message = 'A doctor  has replied your message';
                        // $send_sms = $customSMS->sendSMS($getNumber, $message);

                        $updateQuestionStatus = DB::table('questions')->where('question_id', $request->questionId)->update(['read' => 1, 'question_answered' => 'yes']);
                        // Send push notification
                        $notify = new PushNotification();
                        $notifier = $notify->sendPushNotification($request->userId, $request->questionId, $request->questionContent);

                        //Send SMS
                        $contact = $this->getUserContact($patientId);
                        if ($contact != null) {
                            $customSMS = new CustomSMS();
                            $send_sms = $customSMS->sendSMS($contact, 'New Message From DR. ' . $getResponderName);
                        }

                        //Check if question exist in the workflow. If yes ignore insertion else insert
                        $quesExist = DB::table('pvt_workflow')->select('ques_id')->where('ques_id', '=', $request->questionId)->count();

                        if ($quesExist === 0) {

                            DB::table('pvt_workflow')->insert(
                                ['ques_id' => $request->questionId, 'doctor_id' => $request->userId]
                            );
                        }

                        break;

                    case 'user':

                        // $getNumber = '233241849088';
                        // $customSMS = new CustomSMS();
                        // $message = 'A patient  has replied your message';
                        // $send_sms = $customSMS->sendSMS($getNumber, $message);

                        $updateQuestionStatus = DB::table('questions')->where('question_id', $request->questionId)->update(['read' => 0, 'question_answered' => 'no', 'replied' => 1]);
                        break;
                }

                $lastId = QuestionResponse::max('question_response_id');
                $updateQuestionStatus = DB::table('question_responses')->where('question_response_id', $lastId)->update(['read' => 0]);

                $replyDate = date("M-d-Y @ H:s");

                $sendeDetails = ['userId' => $request->userId, 'type' => $request->responderType,
                    'firstName' => $responderDetails['firstName'], 'lastName' => $responderDetails['lastName'],
                    'picture' => $responderDetails['thumbnail']];

                $response_message = array('success' => true, 'message' => 'reply submitted successfully',
                    'question_thread' => ['question_id' => $request->questionId, 'question_content' => $request->questionContent, 'question_media' => $request->mediaUrl, 'file_type' => $request->fileType,
                        'file_extention' => $request->fileExtension,
                        'creator' => $getResponderName,
                        'creator_type' => 'user',
                        'create_at' => $replyDate], 'sender' => $sendeDetails);

                return response()->json($response_message);

            } else {
                $response_message = array('success' => false, 'message' => 'Could not submit reply. Please check your internet connection and try again');
                return response()->json($response_message);
            }

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Could not submit reply. Missing Params ' . $e->getMessage());
            return response()->json($response_message);
        }

    }

    public function responderDetails($userId, $responderType)
    {
        $fullName = '';
        if ($responderType == 'user') {

            $user = Patient::select('user_id', 'first_name', 'last_name', 'profile_image AS thumbnail')->where('user_id', '=', $userId)->first();
            $fullName = $user->first_name . ' ' . $user->last_name;
        } else {
            $user = Doctor::select('doctor_id', 'first_name', 'last_name', 'thumbnail AS thumbnail')->where('doctor_id', '=', $userId)->first();
            $fullName = $user->first_name . ' ' . $user->last_name;
        }

        $userData = ['firstName' => $user->first_name, 'lastName' => $user->last_name, 'thumbnail' => $user->thumbnail];
        return $userData;
    }

    public function getUserWithId($userId, $responderType)
    {
        $fullName = '';
        if ($responderType == 'user') {

            $user = Patient::select('user_id', 'first_name', 'last_name')->where('user_id', '=', $userId)->first();
            $fullName = $user->first_name . ' ' . $user->last_name;
        } else {
            $user = Doctor::select('doctor_id', 'first_name', 'last_name')->where('doctor_id', '=', $userId)->first();
            $fullName = $user->first_name . ' ' . $user->last_name;
        }
        return $fullName;

    }

    public function userReplyEvent($questionContent, $quesId, $responderType, $responder, $questionUser)
    {

        $fullName = $responder;
        $messageDate = date('M d, Y h:i a');

        $flag = 0;
        $patientController = new PatientController();
        $messageCount = $this->allUnreadResponses('all');

        $responseCount = $messageCount;

        $flag = 'reply';

    }

    public function allUnreadResponses($user = null)
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
            return $messageCount;

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Internal Server Error ' . $e->getMessage());
            return response()->json($response_message);
        }

    }

    public function getUserUnreadResponses($userId)
    {
        $unredQusestions = DB::table('questions')->join('question_responses', 'questions.question_id', '=', 'question_responses.ques_id')
            ->select('questions.question_content', 'question_responses.question_response_content')
            ->where([['questions.patient_id', '=', $userId], ['question_responses.read', '=', 0]])->get();
        $messageCount = count($unredQusestions);

        return $messageCount;

    }

    public function countDailyQuestionResponse()
    {
        try {
            $now = date('Y-m-d');
            $dailyQusestions = DB::table('questions')->select('question_id')->whereDate('questions.created_at', '=', $now)->get();
            $countQuestion = count($dailyQusestions);

            $dailyResponses = DB::table('question_responses')->select('question_response_id')->whereDate('created_at', '=', $now)->get();
            $countResponses = count($dailyResponses);

            $response_message = array('success' => true, 'data' => ['totalQuestions' => $countQuestion, 'responses' => $countResponses]);
            return $response_message;
        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'General Error');
            return response()->json($response_message);
        }

    }

    public function responseUserMedia(Request $request)
    {
        $questionResponse = new QuestionResponse();
        $questionResponse->ques_id = $request->questionId;
        $questionResponse->responder_id = $request->userId;
        $questionResponse->responder_type = 'user';
        $questionResponse->question_response_content = 'n/a';
        $questionResponse->question_response_media_url = $request->mediaUrl;

        try {
            if ($questionResponse->save()) {
                $response_message = array('success' => true, 'message' => 'Reply submitted successfully');
                return response()->json($response_message);
            } else {

                $response_message = array('success' => false, 'message' => 'Could not upload file. Please check your internet connection and try again');
                return response()->json($response_message);
            }

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'Unsupported file format');
            return response()->json($response_message);
        }

    }

    /**
     * Gets user questions
     */
    public function getUserQuestions($userId)
    {
        $data = array();
        $userQuestions = Question::where('patient_id', $userId)->orderBy('updated_at', 'DESC')->get();
        foreach ($userQuestions as $key => $value) {
            $temp_array['question_id'] = $value['question_id'];
            $temp_array['patient_id'] = $value['patient_id'];
            $temp_array['question_code'] = $value['question_code'];
            $temp_array['question_cat_id'] = $value['question_cat_id'];
            $temp_array['question_closed'] = $value['question_closed'];
            $temp_array['question_answered'] = $value['question_answered'];
            $temp_array['question_content'] = $value['question_content'];
            $temp_array['question_code'] = $value['question_code'];
            $temp_array['question_media_url'] = $value['question_media_url'];
            $temp_array['file_type'] = $value['file_type'];
            $temp_array['created_at'] = $value['created_at'];

            $questionCategoryDetails = QuestionCategory::find($value['question_cat_id']);
            $temp_array['question_category'] = $questionCategoryDetails->category_name;

            ////
            $quesId = $value['question_id'];
            $quesStatus = DB::select("SELECT COUNT(question_response_id) counter FROM question_responses WHERE ques_id ='$quesId' AND `read` ='0' AND responder_type='doctor' ");
            foreach ($quesStatus as $key => $quesCount) {
                $count = $quesCount->counter;
            }

            if ($value['question_answered'] == 'no') {
                $temp_array['question_threads'] = 1;
                $temp_array['response_doctor'] = "n/a";
            } else {
                $getQuestionAnswerStatus = QuestionResponse::where('ques_id', $value['question_id'])->orderBy('question_response_id', 'DESC')->get();

                $temp_array['question_threads'] = count($getQuestionAnswerStatus) + 1;

                $getDoctorAnsweringStatus = QuestionResponse::where('ques_id', $value['question_id'])->where('responder_type', 'doctor')->first();

                if ($getDoctorAnsweringStatus) {
                    $doctorDetails = Doctor::find($getDoctorAnsweringStatus['responder_id']);
                    if (!empty($doctorDetails)) {
                        $temp_array['response_doctor'] = "Dr. " . $doctorDetails->first_name . " " . $doctorDetails->last_name;
                    }

                } else {
                    $temp_array['response_doctor'] = "n/a";
                }
            }
            $temp_array['unread_responses'] = $count;
            array_push($data, $temp_array);
        }

        $response_message = array('data' => $data);
        return response()->json($response_message);
    }

    /**
     * Gets user question details
     */

    public function getUserQuestionDetails($userId, $questionId)
    {
        $data = array();
        $questionsArray = array();

        $userQuestion = Question::where('patient_id', $userId)->where('question_id', $questionId)->first();

        $userDetails = User::where('user_code', $userId)->first();
        $username = $userDetails['username'];
        $docFirstName = '';
        $docLastName = '';

        $patientFirstName = '';
        $patientLastName = '';
        if ($userQuestion) {
            $data['question_code'] = $userQuestion['question_code'];
            $questionCategoryDetails = $userQuestion['question_cat_id'];
            $data['question_category'] = QuestionCategory::find($userQuestion['question_cat_id'])->category_name;
            $data['question_id'] = $userQuestion['question_id'];
            $data['question_closed'] = $userQuestion['question_closed'];
            $data['question_closed'] = $userQuestion['question_closed'];
            $data['patient_id'] = $userQuestion['patient_id'];

            $question_temp_array['question_content'] = $userQuestion['question_content'];
            $question_temp_array['question_media_url'] = $userQuestion['question_media_url'];
            $question_temp_array['file_type'] = $userQuestion['file_type'];
            $question_temp_array['file_extension'] = $userQuestion['file_extension'];
            $userDate = $this->fmtDate($userQuestion['created_at']);
            $question_temp_array['created_at'] = $userDate;
            $question_temp_array['creator_type'] = 'user';

            $patientDetails = Patient::where('user_id', $userQuestion['patient_id'])->get();
            foreach ($patientDetails as $patient) {
                $patientFirstName = $patient->first_name;
                $patientLastName = $patient->last_name;
                $dof = $patient->date_of_birth;
                $knownCondition = $patient->known_condition;
                $bloodGroup = $patient->blood_group;
                $age = date_diff(date_create($dof), date_create('now'))->y;
            }

            $data['age'] = $age;
            $data['blood_group'] = $patient->blood_group;
            $data['known_condition'] = $patient->known_condition;
            $data['location'] = $patient->address;

            $question_temp_array['creator'] = $patientFirstName . ' ' . $patientLastName;

            array_push($questionsArray, $question_temp_array);

            $questionResponses = QuestionResponse::where('ques_id', $userQuestion['question_id'])->get();
            if (count($questionResponses) > 0) {

                foreach ($questionResponses as $k => $v) {

                    $question_temp_array['question_content'] = $v['question_response_content'];
                    $question_temp_array['question_media_url'] = $v['question_response_media_url'];
                    $question_temp_array['file_type'] = $v['file_type'];
                    $question_temp_array['file_extension'] = $v['file_extension'];
                    $question_temp_array['read'] = $v['read'];
                    $question_temp_array['question_response_id'] = $v['question_response_id'];
                    $quesDate = $this->fmtDate($v['created_at']);
                    $question_temp_array['created_at'] = $quesDate;

                    if ($v['responder_type'] == 'doctor') {
                        $doctorDetails = Doctor::where('doctor_id', $v['responder_id'])->get();
                        foreach ($doctorDetails as $doc) {
                            $docFirstName = $doc->first_name;
                            $docLastName = $doc->last_name;
                        }

                        $doctorName = $docFirstName . " " . $docLastName;
                        $question_temp_array['creator'] = 'Dr. ' . $doctorName;
                        $question_temp_array['question_id'] = $userQuestion->question_id;
                        $question_temp_array['creator_type'] = 'doctor';

                    } else {

                        $question_temp_array['creator'] = $patientFirstName . ' ' . $patientLastName;
                        $question_temp_array['creator_type'] = 'user';
                        $question_temp_array['question_id'] = $userQuestion->question_id;
                    }

                    array_push($questionsArray, $question_temp_array);
                }
            }

            $data['question_threads'] = $questionsArray;
        }

        //Mark question  as read transaction

        $transactUpdate = DB::transaction(function () use ($questionId) {
            $updateQuestionStatus = DB::table('questions')->where('question_id', $questionId)->update(['read' => 1]);
            $updateQuestionStatus = DB::table('question_responses')->where('ques_id', $questionId)->update(['read' => 1]);
        });

        $response_message = array('data' => $data);
        return response()->json($response_message);
    }

    public function fmtDate($data)
    {
        $date = date_create($data);
        return date_format($date, "M-d-y @ H:i:s");
    }

    public function updateQuestionReadStatus(Request $request)
    {
        $questionId = $request->questionId;
        $read = $request->read;

        $validator = \Validator::make($request->all(), [
            'questionId' => 'required',
        ]);
        if ($validator->fails()) {
            $response_message = array('success' => false, 'message' => 'Missing question id');
            return response()->json($response_message);
        } else {
            //Check if the question exists
            $question = QuestionResponse::where('ques_id', $questionId)->first();
            if ($question != null) {

                try {
                    DB::table('question_responses')->where('ques_id', $questionId)->update(['read' => 1]);
                    $response_message = array('success' => true, 'message' => 'Qusetion status updated');

                    return response()->json($response_message);

                } catch (\Exception $e) {
                    $response_message = array('success' => false, 'message' => 'Unable  to update question');
                    return response()->json($response_message);
                }

            } else {
                $response_message = array('success' => false, 'message' => 'Question not found');
                return response()->json($response_message);
            }
        }

    }

    /**
     * Gets all videos
     */
    public function getVideos()
    {
        $data = Video::all();
        $response_message = array('data' => $data);
        return response()->json($response_message);
    }

    /**
     * Upvote video
     */
    public function upvoteVideo($videoId)
    {
        $video = Video::find($videoId);
        $numberOfUpvotes = $video->upvotes;
        $updatedUpvotes = $numberOfUpvotes + 1;
        $video->upvotes = $updatedUpvotes;

        if ($video->save()) {
            $response_message = array('success' => true, 'message' => 'video upvote successful', 'numberOfUpvotes' => $updatedUpvotes);
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'video upvote unsuccessful', 'numberOfUpvotes' => $numberOfUpvotes);
            return response()->json($response_message);
        }
    }

    /**
     * Downvotes a video
     */
    public function downvoteVideo($videoId)
    {
        $video = Video::find($videoId);
        $numberOfDownvotes = $video->downvotes;
        $updatedDownvotes = $numberOfDownvotes + 1;
        $video->downvotes = $updatedDownvotes;

        if ($video->save()) {
            $response_message = array('success' => true, 'message' => 'video downvote successful', 'numberOfDownvotes' => $updatedDownvotes);
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'video downvote unsuccessful', 'numberOfDownvotes' => $numberOfDownvotes);
            return response()->json($response_message);
        }
    }

    /**
     * Increases number of views of a video
     */
    public function increaseVideoViews($videoId)
    {
        $video = Video::find($videoId);
        $numberOfViews = $video->views;
        $updatedViews = $numberOfViews + 1;
        $video->views = $updatedViews;

        if ($video->save()) {
            $response_message = array('success' => true, 'message' => 'video view number increase successful', 'numberOfViews' => $updatedViews);
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'video view number increase unsuccessful', 'numberOfViews' => $numberOfViews);
            return response()->json($response_message);
        }
    }

    public function getAllArticles()
    {
        $articles = DB::table('articles')->select('*')->orderBy('article_cat_id', 'DESC')->get();
        $articleCount = count($articles);
        $response_message = array('success' => true, 'article_count' => $articleCount, 'data' => $articles);
        return response()->json($response_message);

    }

    public function fecthAllUnreadUserQuetions()
    {
        try {
            $questions = DB::table('questions')->leftJoin('patients', 'patients.user_id', '=', 'questions.patient_id')
                ->select('questions.*', 'patients.first_name', 'patients.last_name', 'patients.username')->where('questions.question_answered', '=', 'no')->orderBy('updated_at', 'desc')->paginate(10);

            $response_message = array('success' => true, 'message_body' => $questions);
            return response()->json($response_message);
        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message_body' => 'Error requesting data');
            return response()->json($response_message);
        }

    }

    public function getQueuedQueuedQuestions()
    {
        try {
            $questions = DB::table('questions')->leftJoin('patients', 'patients.user_id', '=', 'questions.patient_id')
                ->select('questions.*', 'patients.first_name', 'patients.last_name', 'patients.username')->where('questions.question_answered', '=', 'no')->orderBy('updated_at', 'desc')->get();

            $response_message = array('success' => true, 'message_body' => $questions);
            return response()->json($response_message);
        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message_body' => 'Error requesting data');
            return response()->json($response_message);
        }

    }

    public function fetchAllFollowUpQuestions(Request $request)
    {
        $dataArr = [];
        $questions = DB::table('questions')->leftJoin('patients', 'patients.user_id', '=', 'questions.patient_id')
            ->select('questions.*', 'patients.first_name', 'patients.last_name', 'patients.username')->where('questions.question_answered', '=', 'no')->orderBy('updated_at', 'desc')->get();

        foreach ($questions as $question) {
            $temp['first_name'] = $question->first_name;
            $temp['first_name'] = $question->first_name;
            $temp['first_name'] = $question->first_name;
            $temp['first_name'] = $question->first_name;
            $temp['first_name'] = $question->first_name;
            $temp['first_name'] = $question->first_name;

            array_push($dataArr, $temp);
        }

        return $questions;
    }

    public function fetchFaqsCategory()
    {
        try {
            $faqsCategory = DB::table('faq_categories')->select('cat_id', 'cat_name', 'slug')->get();
            $response_message = array('success' => true, 'message' => 'success', 'data' => $faqsCategory);
            return response()->json($response_message);
        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'request failed', 'data' => 'Error requesting data');
            return response()->json($response_message);
        }

    }

    public function fetchFaqs($catId)
    {
        try {
            $faqs = DB::table('faqs')->select('faqs.*')->where('faq_cat_id', '=', $catId)->get();

            $response_message = array('success' => true, 'message' => 'success', 'data' => $faqs);
            return response()->json($response_message);

        } catch (\Exception $e) {
            $response_message = array('success' => false, 'message' => 'request failed', 'data' => 'Error requesting data');
            return response()->json($response_message);
        }

    }

    public function deleteQuestionResponse($userId, $questionId, Request $request){


        $rules = [
            'question_response_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }
        QuestionResponse::where('question_response_id', $request->question_response_id)->delete();
         return     $this->getUserQuestionDetails($userId, $questionId);
    }

}
