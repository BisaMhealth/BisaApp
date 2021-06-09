<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('patient/signup/', 'PatientController@addNewPatient_Known');
Route::post('/user/role/login', 'UserManagementController@userRoleLogin');

Route::post('/test-sms', 'PatientController@sms');

Route::post('user/change-credentials', 'UserManagementController@changePasswordWithoutToken');

Route::get('test-fcm', 'PushNotification@sendFcm');

Route::middleware(['checkAPIUserToken'])->group(function () {

    // User
    Route::get('user/roles/{userid}', 'UserManagementController@userRoles');

    Route::post('user/update-credentials', 'UserManagementController@changePassword');
    Route::post('/user/update-profileimage', 'UserManagementController@updateUserImage');

    //Patients
    Route::get('patient/fetch/all', 'PatientController@index');
    Route::get('patient/fetch/{patientid}', 'PatientController@index');

    Route::get('patient/response/{flag}/{userid}/{quesid}', 'PatientController@patientUnreadMessages');
    Route::get('patient/response/unread/{all}', 'PatientController@allUnreadMessages');
    Route::get('patient/questions/unread/{all}', 'PatientController@allUnreadQuetions');
    Route::get('patient/response/read/{userid}', 'PatientController@patientReadMessage');
    Route::get('response/unread/{userid}', 'PatientController@fetchUserUnreadResponses');

    Route::post('patient/update/', 'PatientController@updatePatient');

    //Doctors
    Route::get('doctor/fetch/{doctorid}', 'DoctorController@getDoctorDetails');
    Route::get('doctor/fetch/workflow-items/{doctorid}', 'DoctorController@getDoctorWorkflowItems');

    Route::post('doctor/update/', 'DoctorController@updateDoctorDetails');
    Route::post('doctor/rate/', 'DoctorController@rateDoctor');

    //Hospitals
    Route::get('hospital/fetch/all', 'HospitalController@index');
    Route::get('hospital/fetch/{hospitalid}', 'HospitalController@index');

    Route::post('hospital/signup', 'HospitalController@addNewHospital');
    Route::post('hospital/update', 'HospitalController@updateHospital');
    Route::post('hospital/add/doctor', 'HospitalController@addNewDoctor');

    Route::post('hospital/add/branch', 'HospitalBranchController@create');
    Route::post('hospital/update/branch', 'HospitalBranchController@edit');

    //Appointments
    Route::get('appointments/{userid}/all', 'AppointmentController@fetchAppointmentsByUser');
    Route::get('hospital/appointments/{hospitid}', 'AppointmentController@fetchAppointmentsByHospital');

    Route::post('patient/bookappointment', 'AppointmentController@addAppointment');
    Route::post('patient/editappointment', 'AppointmentController@editAppointment');
    Route::post('patient/deleteappointment', 'AppointmentController@destroy');
    Route::post('appoint/status/change', 'AppointmentController@changeAppointmentStatus');

    //Subscription
    Route::get('subscription/fetch/', 'SubscriptionController@index');
    Route::get('subscription/fetch/{planid}', 'SubscriptionController@index');

    Route::post('subscription/add', 'SubscriptionController@addPlan');
    Route::post('subscription/update', 'SubscriptionController@updatePlan');
    Route::post('subscription/patient/register', 'SubscriptionController@addPatientSubscriptionSignUp');

    Route::get('question/today', 'ApiController@countDailyQuestionResponse');

    //Question
    //Route::get('/patient/count/{flag}/response','ApiController@');
    Route::post('/qusetion/status/read', 'ApiController@updateQuestionReadStatus');

    //Admin
    Route::get('/admin/question-category-by-year/{startDate}/{endDate}', 'AdminApiController@questionCategoryStatsByYear');
    Route::get('/admin/question-count-by-month/{startDate}/{endDate}', 'AdminApiController@quesCountByMonth');
    Route::get('/admin/user-count', 'AdminApiController@userCount');
    Route::get('/admin/response-stats/{startDate}/{endDate}', 'AdminApiController@responseStats');

    Route::post('/admin/create', 'AdminApiController@create');

    //**************STORE***********************

    //Categories
    Route::get('/store/list-category/{categoryId}', 'ProductCategoryController@index');
    Route::get('/store/list-category/', 'ProductCategoryController@index');

    Route::post('/store/create-product-category', 'ProductCategoryController@createProductCategory');
    Route::post('/store/update-product-category', 'ProductCategoryController@updateProductCategory');
    Route::post('/store/delete-product-category', 'ProductCategoryController@destroy');

    //Products
    Route::get('/store/product/{productid}', 'ProductsController@getProductDetails'); //Returns product details
    Route::get('/store/get-products-by-categoryid/{catid}', 'ProductsController@getProductsByCategory'); //Returns all products in a category

});

// Get Device token
Route::post('device/register', 'DeviceController@registerDeviceId')->middleware('checkAPIUserToken');

Route::get('pushnotification', 'ClientController@send');

Route::post('client/create', 'ClientController@create');

// create new user account
Route::post('/user/signup/', 'ApiController@createUserAccount');

// create new anonymous user account
Route::post('/user/anoymous-signup/', 'ApiController@createAnonymousUserAccount');

// log in user account
Route::post('/user/login/', 'ApiController@signInUserAccount');

// request user verification code
Route::post('/user/request-verification-code', 'ApiController@requestUserVerificationCode');

// verify user code
//Route::post('/user/verify-code/', 'ApiController@verifyCode');

Route::post('/user/verify-code/', 'ApiController@verifyAccount');

// request password reset
Route::post('/user/request-password-reset', 'ApiController@requestPasswordReset');

Route::get('/user/rest-code/{code}', 'ApiController@checkPasswordResetCode');

// get user details
Route::get('/user/{userId}/get-details', 'ApiController@getUserDetails')->middleware('checkAPIUserToken');

// reset user details
Route::post('/user/reset-details', 'ApiController@resetUserDetails')->middleware('checkAPIUserToken');

// delete user account
Route::get('/user/{userId}/delete', 'ApiController@deleteUserAccount');

// upload question file
Route::post('/user/upload-question-file', 'ApiController@uploadQuestionFile')->middleware('checkAPIUserToken');

// submit user question
Route::post('/user/submit-question', 'ApiController@submitUserQuestion')->middleware('checkAPIUserToken');

// reply user question
Route::post('/user/reply-question', 'ApiController@replyUserQuestion')->middleware('checkAPIUserToken');
Route::post('/user/rreply-question', 'ApiController@replyUserQuestiona');

Route::get('/users/fetch-all-questions', 'ApiController@fecthAllUnreadUserQuetions');

Route::get('/question/get-queued-questions', 'ApiController@getQueuedQueuedQuestions');

Route::get('users/fetch/questions/followup', 'ApiController@fetchAllFollowUpQuestions');

// gets user questions
Route::get('/user/{userId}/get-questions', 'ApiController@getUserQuestions')->middleware('checkAPIUserToken');

// get user question details with response
Route::get('/user/{userId}/get-question-details/{questionId}', 'ApiController@getUserQuestionDetails')->middleware('checkAPIUserToken');
// Route::get('/user/{userId}/delete-question-response/{questionId}', 'ApiController@deleteQuestionResponse')->middleware('checkAPIUserToken');
Route::post('/user/{userId}/delete-question-response/{questionId}', 'ApiController@deleteQuestionResponse');

// get article categories
Route::get('/articles/get-categories', 'ApiController@getArticleCategories')->middleware('checkAPIUserToken');

// get article categories with article  count
Route::get('/articles/get-categories/with-count', 'ApiController@getArticleCategoriesWithArticleCount')->middleware('checkAPIUserToken');

// get article categories
Route::get('/articles/fetch/all', 'ApiController@getAllArticles')->middleware('checkAPIUserToken');

// get article categories
Route::get('/articles/fetch/latest', 'ApiController@getLatestArticles')->middleware('checkAPIUserToken');

// get article by category name

Route::get('/articles/get-articles-by-category/{articleCategoryName}', 'ApiController@getArticlesByCategory')->middleware('checkAPIUserToken');

Route::get('/fetch/articles/bycategory', 'ApiController@getAllArticleByCategory')->middleware('checkAPIUserToken');

// fetches an article by id
Route::get('/article/fetch/{articleId}', 'ApiController@fetchArticleById')->middleware('checkAPIUserToken');

Route::get('/faq/category', 'ApiController@fetchFaqsCategory')->middleware('checkAPIUserToken');

Route::get('/faq/{catId}', 'ApiController@fetchFaqs')->middleware('checkAPIUserToken');

// upvote an article
Route::post('/article/upvote/{articleId}', 'ApiController@upvoteArticle')->middleware('checkAPIUserToken');

// downvote an article
Route::post('/article/downvote/{articleId}', 'ApiController@downvoteArticle')->middleware('checkAPIUserToken');

// increase the number of views of an article
Route::post('/article/increase-views/{articleId}', 'ApiController@increaseArticleViews')->middleware('checkAPIUserToken');

//get article stats
Route::get('/article/get-article-category-count', 'ApiController@getQuestionCategories')->middleware('checkAPIUserToken');

// get the categories of questions
Route::get('/questions/get-categories', 'ApiController@getQuestionCategories')->middleware('checkAPIUserToken');

// get the details of a health resource
Route::get('/health-resources/get-resource/{resourceId}', 'ApiController@getHealthResourceDetails')->middleware('checkAPIUserToken');

// get all health resources
Route::get('/health-resources/fetch', 'ApiController@getAllHealthResources')->middleware('checkAPIUserToken');

// get all doctors
Route::get('/doctors/fetch', 'ApiController@getAllDoctors')->middleware('checkAPIUserToken');

// get the details of a doctor
Route::get('/doctors/fetch-doctor/{doctorId}', 'ApiController@getDoctorDetials')->middleware('checkAPIUserToken');

Route::get('/doctor/reply-question', 'DoctorController@doctorReplyQuestion')->middleware('checkAPIUserToken');

// get all pharmacies
Route::get('/pharmacies/fetch', 'ApiController@getAllPharmacies')->middleware('checkAPIUserToken');

// get the details of a pharmacy
Route::get('/pharmacies/get/{resourceId}', 'ApiController@getPharmacyDetails')->middleware('checkAPIUserToken');

// get all videos
Route::get('/videos/fetch', 'ApiController@getVideos')->middleware('checkAPIUserToken');

// upvote a video
Route::post('/video/upvote/{videoId}', 'ApiController@upvoteVideo')->middleware('checkAPIUserToken');

// downvote a video
Route::post('/video/downvote/{videoId}', 'ApiController@downvoteVideo')->middleware('checkAPIUserToken');

// increase the views of a video
Route::post('/video/increase-views/{videoId}', 'ApiController@increaseVideoViews')->middleware('checkAPIUserToken');

Route::middleware(['cors'])->group(function () {
    Route::group(['prefix' => 'v1'], function () {

        Route::post('admin/auth/login', 'Api\DashboardController@login');

        Route::group(['prefix' => 'statistics'], function () {
            Route::get('counts', 'Api\DashboardController@counts');
            Route::get('question-counts', 'Api\DashboardController@Questioncounts');
            Route::get('patient-counts', 'Api\DashboardController@PatientsCounts');
            Route::get('average-response', 'Api\DashboardController@averageResponse');
            Route::get('question-categories', 'Api\DashboardController@questionCategory');
            Route::get('question-response', 'Api\DashboardController@totalResponseByDoctors');
            Route::get('all-question', 'Api\DashboardController@allQuestion');
            Route::get('all-doctors', 'Api\DashboardController@allDoctors');
            Route::get('all-patients', 'Api\DashboardController@allPatients');
        });

        Route::group(['prefix' => 'marketstatistics'], function () {
            Route::get('patient-counts', 'Api\MarketDashboardController@PatientsCounts');
            Route::get('question-counts', 'Api\MarketDashboardController@Questioncounts');
            Route::get('all-patients', 'Api\MarketDashboardController@allPatients');
            Route::get('all-questions', 'Api\MarketDashboardController@allQuestion');
            Route::get('question-categories', 'Api\MarketDashboardController@questionCategory');
            Route::get('signup-breakdown', 'Api\MarketDashboardController@SignupsBreak');
            Route::get('gender-breakdown', 'Api\MarketDashboardController@genderBreak');
            Route::get('get-webstats', 'Api\MarketDashboardController@getWebstats');

            Route::group(['prefix' => 'filter'], function () {
                Route::post('questions', 'Api\MarketDashboardController@filterQuestions');
                Route::post('patients', 'Api\MarketDashboardController@filterPatients');
                Route::post('questions-categories', 'Api\MarketDashboardController@filterQuestionsCategories');
                Route::post('signup-breakdown', 'Api\MarketDashboardController@filterSignupBreakdown');
            });

        });
        Route::group(['prefix' => 'gizstatistics'], function () {
            Route::get('patient-counts', 'Api\GizDashboardController@PatientsCounts');
            Route::get('question-counts', 'Api\GizDashboardController@Questioncounts');
            Route::get('all-patients', 'Api\GizDashboardController@allPatients');
            Route::get('all-questions', 'Api\GizDashboardController@allQuestion');
            Route::get('question-categories', 'Api\GizDashboardController@questionCategory');
            Route::get('signup-breakdown', 'Api\GizDashboardController@SignupsBreak');
            Route::get('gender-breakdown', 'Api\GizDashboardController@genderBreak');
            Route::get('doctors-response', 'Api\GizDashboardController@getDoctors');
            Route::get('get-doctors', 'Api\GizDashboardController@getDoclists');

            Route::group(['prefix' => 'filter'], function () {
                Route::post('questions', 'Api\GizDashboardController@filterQuestions');
                Route::post('patients', 'Api\GizDashboardController@filterPatients');
                Route::post('questions-categories', 'Api\GizDashboardController@filterQuestionsCategories');
                Route::post('signup-breakdown', 'Api\GizDashboardController@filterSignupBreakdown');
                Route::post('doctors', 'Api\GizDashboardController@filterDoctors');
                Route::post('doctor', 'Api\GizDashboardController@getDoctor');
            });

        });

        Route::group(['prefix' => 'filter'], function () {
            Route::post('questions', 'Api\DashboardController@filterQuestions');
            Route::post('patients', 'Api\DashboardController@filterPatients');

        });

        Route::group(['prefix' => 'usermanagement'], function () {
            Route::get('admins', 'Api\UserManagementController@Admins');
            Route::post('admin', 'Api\UserManagementController@RegisterAdmin');
            Route::get('hospitals', 'Api\UserManagementController@Hospitals');
            Route::post('hospital', 'Api\UserManagementController@RegisterHospital');
        });


        Route::post('/marketer/auth/login', 'Api\DashboardController@marketlogin');
        Route::post('/admin/publish-admin-article', 'Api\GeneralController@publishAdminArticle');
        Route::post('/admin/publish-admin-article/{id}', 'Api\GeneralController@updateArticle');

        Route::get('/admin/get-article', 'Api\GeneralController@getArticles');
        Route::get('/admin/get-article/{id}', 'Api\GeneralController@getArticle');
        Route::delete('/admin/get-article/{id}', 'Api\GeneralController@deleteRecord');

        Route::post('upload-image','Api\GeneralController@upImage');
    });
});
