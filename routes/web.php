<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/setlanguage/{locale}',function($lang){
       \Session::put('locale',$lang);
       return redirect()->back();
});

// Route::get('/broadcasting/auth', function(){

// });

Auth::routes();

 Route::get('/', function () {

   return view('welcome');
  })->middleware('language');

  Route::get('/login', function () {
    return view('welcome');
   });

   Route::get('/user/login', function () {
    return view('welcome');
   })->name('login');

 Route::get('/dashboard','UserController@damydash')->middleware('language');
 Route::any('user/login', 'UserController@loginUser')->name('loginuser')->middleware('language');
 Route::get('user/signup', 'UserController@signUp')->name('signup')->middleware('language');
 Route::get('/anonymous-signup', 'UserController@anonymousSignup')->middleware('language');

 Route::get('verify-account', 'UserController@showVierificationForm')->middleware('language');
 Route::get('reset-password/{code}', 'UserController@verifyPasswordResetCode')->middleware('language');
 Route::get('forgotten-password', 'UserController@showPasswordResetForm')->middleware('language');
 Route::get('/reset-link','UserController@showResetLinkConfirmation');
 Route::get('/verify-set-code','UserController@showPasswordResetForm');
 Route::get('/user-password-reset','UserController@confirmReset');


 Route::post('user/addpatient', 'UserController@create')->name('onboardpatient')->middleware('language');
 Route::post('/account/verify', 'UserController@verify')->middleware('language');
 Route::post('/user/anonymous/signup', 'UserController@postAnonymousSignUp')->name('onboardanonymously');
 Route::post('/user/init', 'UserController@initiatePasswordReset')->middleware('language');
 Route::post('/user/password/reset', 'UserController@changeUserPassword')->middleware('language');


Route::group(['middleware'=>['auth','language']],function ()
{
	//Welcome Page

	Route::get('messages', 'ChatsController@fetchMessages');
	Route::post('messages', 'ChatsController@sendMessage');

  Route::get('/home', function () { return redirect()->to('/'); })->middleware('language');

    Route::get('patient/chathistory', 'PatientController@index');
    Route::get('/patient/get-questions', 'PatientController@fetchPatientQuestions');
    Route::get('/question/responses/{userid}/{quesid}', 'PatientController@fetchQuestionResponse');
    Route::get('/patient/covid/follow', 'PatientController@showFollowUpList');




    Route::post('/patient/submit-user-quetion', 'PatientController@submitUserQuestion')->name('ask');
    Route::post('/patient/addmedia', 'PatientController@addMedia')->name('addmedia');



    Route::post('/addmedia', 'PatientController@addMedia');

    Route::post('/user/replyquestion', 'PatientController@postUserQuestionReply');

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/user/logout', 'UserController@logout')->name('signout');
    Route::get('/patient/dashboard', 'UserController@showPatientDashboard');


    /* ********* Articles ******************/
    Route::get('/article-dashboard','ArticleController@index');
    Route::get('/article/category/{catid}/{catname}','ArticleController@getCategoryArticles');
    Route::get('/read/{articleid}/{catname}/{title}/{categoryId}','ArticleController@getArtticlesByCateggory');
    Route::get('/faq/{general}','ArticleController@showFaq');
    Route::get('/list-articles','ArticleController@listArticles');
    Route::get('/get-all-articles','ArticleController@listArticles');
    Route::get('/view-article/{articleid}','ArticleController@editArticle');
    Route::get('/article/publish','ArticleController@publishArticle');


    Route::post('/article/edit','ArticleController@updateArticle');
    Route::post('/post/publish','ArticleController@postArticle');
    Route::post('/remove-article','ArticleController@removeArticle');

    /* ********* Doctors ******************/
    Route::get('/doctor/dashboard','DoctorController@showDoctorDashboard');
    Route::get('/users/show-questions','DoctorController@showUsersQuestions');
    Route::get('/get-user-questions/{pagenumber}','DoctorController@fetchUserQuestions');
    Route::get('/doctor/reply/{questioncode}/{fullname}/{isfollowup}','DoctorController@showDoctorReplyForm');
    Route::get('/doctor-profile','DoctorController@showDoctorProfilePage');
    Route::get('/question-queue','QuestionsController@viewWorkFlow');
    Route::get('/fetchall-questions','QuestionsController@getQuestions');
    Route::get('/fetchall-unanweredquestions','QuestionsController@retriveUnansweredQuestions');
    Route::get('/covid-patient-review','QuestionsController@showUnanseredFollowQuestions');
    Route::get('/fetchall-patient-follow-up-questions','QuestionsController@getCovidFollowUpQuestions');
    Route::get('/view-all-questions','QuestionsController@viewAllUserQuestions');
    Route::get('doctor/fetch-all-questions','QuestionsController@fecthAllUserQuestions');
    Route::get('user/work-flow','DoctorController@showDoctorWorkFlow');
    Route::get('doctor/work-flow-items','QuestionsController@fetchDoctorWorkFlowItems');
    Route::get('/question-queue-covid-19','DoctorController@showCovidQuestion');
    Route::get('/questions/view/covid-19','QuestionsController@viewCovidQuestion');



    Route::post('/update-doctor-profile','DoctorController@updateDoctorProfile');
    Route::post('/close-question','DoctorController@closeCurrentQuestion');

    /* ********* Appointments ******************/
    Route::get('/new-appointment/{token}','AppointmentController@showAppointmentForm');
    Route::get('/my-appointment','AppointmentController@listUserAppointments');


    Route::post('/patient/book/appointment','AppointmentController@bookNewAppointment');

    Route::get('/corona/allcountries/','UserController@covidStatistics');
    Route::get('/corona/allcountries/{country}','UserController@covidStatisticsByCountry');


     /* ********* User Profile ******************/
     Route::get('/user-profile','UserController@showUserProfilePage');


     Route::post('/user/update-credentials','UserController@updatePassword');
     Route::post('/update-profile-image','UserController@uploadProfileImage');
     Route::post('/update-patient-profile', 'UserController@updatePatientDetails');


     /* ********* Hospital Profile ******************/
     Route::get('/hospital-list','HospitalController@index');

     Route::get('/pharmacies-list','PharmacyController@showPharmacyList');


     /* ********* Appointments ******************/
     Route::get('/admin/dashboard','AdminController@index');



     /* ********* Admin ******************/
     Route::get('/question-cat-stats-by-year/{period}','AdminController@getQuesCatStatsByYear');
     Route::get('/user-count','AdminController@fetchUserCount');
     Route::get('/question/list-questions','AdminController@viewQuestionReport');
     Route::get('/patient/messaging','AdminController@showMessagingBoard');
     Route::get('/view/doctor/questions/{doctorId}','AdminController@viewDoctorQuestions');


     Route::post('user/sendnotification', 'AdminController@sendNotifications')->name('sendusernotification')->middleware('language');

});
