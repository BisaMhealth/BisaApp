<?php
use Illuminate\Support\Facades\Route;
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

Route::get('/', 'AuthController@renderLoginPage');

Route::get('/login', 'AuthController@renderLoginPage');

Route::post('/login-user', 'AuthController@loginUserAccount');

Route::get('/signup', 'AuthController@renderSignupPage');

Route::get('/anonymous-signup', 'AuthController@renderAnonymousSignupPage');

Route::post('/anonymous-user-signup', 'AuthController@createAnonymousUserAccount');

Route::post('/user-signup', 'AuthController@createUserAccount');

Route::get('/forgot-password', 'AuthController@renderForgotPasswordPage');

Route::get('/reset-password', 'AuthController@renderForgotPasswordResetPage');

Route::post('/reset-password', 'AuthController@resetPassword');

/**
 * Routes for the /user path
 */
Route::prefix('user')->group(function () {
    Route::get('/questions', 'UserController@renderQuestionsPage')->middleware('checkUserAuth');

    Route::get('/logout', 'AuthController@logoutUser');

    Route::get('/health-resources', 'UserController@renderHealthResourcesPage')->middleware('checkUserAuth');

    Route::get('/doctors-details', 'UserController@renderDoctorsDetailsPage')->middleware('checkUserAuth');

    Route::get('/health-info/{category_name}', 'UserController@renderHealthInfoPage')->middleware('checkUserAuth');

    Route::get('/account-settings', 'UserController@renderAccountSettingsPage')->middleware('checkUserAuth');

    Route::post('/get-articles-by-title', 'UserController@getArticlesByCategory');

    Route::get('/article/{article_title}', 'UserController@getArticleByTitle');

    Route::post('/upvote-article', 'UserController@upvoteArticle');

    Route::post('/downvote-article', 'UserController@downvoteArticle');

    Route::get('/get-doctor-details', 'UserController@getDoctorsDetails');

    Route::get('/get-health-resources', 'UserController@getHealthResources');

    Route::get('/get-question-categories', 'AdminController@getQuestionCategories');

    Route::post('/add-question', 'UserController@addQuestion');

    Route::post('/user-reply-question', 'UserController@replyQuestion');

    Route::get('/get-user-questions', 'UserController@getUserQuestions');

    Route::get('/question/{question_code}', 'UserController@renderQuestionDetailsPage')->middleware('checkUserAuth');

    Route::post('/get-user-question-details', 'UserController@getUserQuestionDetails');

    Route::post('/reset-password', 'UserController@resetUserPassword');

    Route::post('/request-new-password', 'AuthController@requestNewUserPassword');

    Route::post('/reset-user-health-info', 'UserController@resetUserHealthInfo');

    Route::post('/reset-user-personal-info', 'UserController@resetUserPersonalInfo');
});

/**
 * Routes for the /doctor path
 */
Route::prefix('doctor')->group(function () {
    Route::get('/questions', 'DoctorController@renderDoctorQuestionsPage')->middleware('checkDoctorAuth');

    Route::get('/answered-questions', 'DoctorController@renderDoctorAnsweredQuestionsPage')->middleware('checkDoctorAuth');

    Route::get('/account-settings', 'DoctorController@renderAccountSettingsPage')->middleware('checkDoctorAuth');

    Route::get('/question/{question_code}', 'DoctorController@renderQuestionDetailsPage')->middleware('checkDoctorAuth');

    Route::get('/get-doctors-questions', 'DoctorController@getDoctorsQuestions');

    Route::get('/get-doctor-answered-questions', 'DoctorController@getDoctorAnsweredQuestions');

    Route::post('/get-question-details', 'DoctorController@getQuestionDetails');

    Route::post('/doctor-reply-question', 'DoctorController@doctorReplyQuestion');

    Route::post('/doctor-close-question', 'DoctorController@closeQuestion');

    Route::post('/reset-password', 'DoctorController@resetDoctorPassword');

    Route::post('/reset-doctor-personal-details', 'DoctorController@resetDoctorPersonalInfo');

    Route::post('/reset-profile-photo', 'DoctorController@resetDoctorProfilePhoto');

    Route::get('/logout', 'AuthController@logoutDoctor');
});

/**
 * Routes for the /admin path
 */
Route::prefix('admin')->group(function () {
    Route::get('/', 'AuthController@renderAdminSignupPage');

    Route::get('/signup', 'AuthController@renderAdminSignupPage');

    Route::get('/login', 'AuthController@renderAdminLoginPage');

    Route::post('/signup', 'AuthController@createAdminAccount');

    Route::post('/login', 'AuthController@loginAdminAccount');

    Route::get('/logout', 'AuthController@logoutAdminAccount');

    Route::get('/dashboard', 'AdminController@renderDashboardPage')->middleware('checkAdminAuth');

    Route::get('/article-categories', 'AdminController@renderArticleCategoriesPage')->middleware('checkAdminAuth');

    Route::get('/articles', 'AdminController@renderArticlesPage')->middleware('checkAdminAuth');

    Route::get('/question-categories', 'AdminController@renderQuestionCategoriesPage')->middleware('checkAdminAuth');

    Route::get('/questions', 'AdminController@renderQuestionsPage')->middleware('checkAdminAuth');

    Route::get('/admins-accounts', 'AdminController@renderAdminsAccountsPage')->middleware('checkAdminAuth');

    Route::get('/doctors-accounts', 'AdminController@renderDoctorsAccountsPage')->middleware('checkAdminAuth');

    Route::get('/users-accounts', 'AdminController@renderUsersAccountsPage')->middleware('checkAdminAuth');

    Route::get('/general-stats', 'AdminController@renderGeneralStatsPage')->middleware('checkAdminAuth');

    Route::get('/doctors-stats', 'AdminController@renderDoctorsStatsPage')->middleware('checkAdminAuth');

    Route::get('/users-stats', 'AdminController@renderUsersStatsPage')->middleware('checkAdminAuth');

    Route::get('/publish-article', 'AdminController@renderPublishArticlePage')->middleware('checkAdminAuth');

    Route::get('/videos', 'AdminController@renderVideosPage')->middleware('checkAdminAuth');

    Route::get('/health-resources', 'AdminController@renderHealthResourecesPage')->middleware('checkAdminAuth');

    Route::get('/pharmacies', 'AdminController@renderPharmaciesPage')->middleware('checkAdminAuth');

    Route::get('/question/{question_code}', 'AdminController@renderQuestionDetailsPage')->middleware('checkAdminAuth');

    Route::post('/add-article-category', 'AdminController@addArticleCategory');

    Route::get('/get-article-categories', 'AdminController@getArticleCategories');

    Route::post('/edit-article-category', 'AdminController@editArticleCategory');

    Route::post('/delete-article-category', 'AdminController@deleteArticleCategory');

    Route::post('/add-question-category', 'AdminController@addQuestionCategory');

    Route::get('/get-question-categories', 'AdminController@getQuestionCategories');

    Route::post('/edit-question-category', 'AdminController@editQuestionCategory');

    Route::post('/delete-question-category', 'AdminController@deleteQuestionCategory');

    Route::get('/get-all-questions', 'AdminController@getAllQuestions');

    Route::post('/get-question-details', 'AdminController@getQuestionDetails');

    Route::post('/publish-admin-article', 'AdminController@publishAdminArticle');

    Route::get('/get-all-articles', 'AdminController@getArticles');

    Route::post('/edit-admin-article', 'AdminController@editAdminArticle');

    Route::post('/delete-admin-article', 'AdminController@deleteAdminArticle');

    //custom admin CRUD routes
    Route::get('/article-view/{articleId}', 'AdminController@renderAdminViewPage')->name('view-article')->middleware('checkAdminAuth');

    Route::post('/article/update/{articleId}', 'AdminController@updateAdminArticle')->name('adminArticleupdate')->middleware('checkAdminAuth');

    Route::get('/article-edit/{articleId}', 'AdminController@renderAdminEditionPage')->name('edit-article')->middleware('checkAdminAuth');

    Route::get('/article/delete/{articleId}', 'AdminController@deleteAdminArticle')->name('delete-article')->middleware('checkAdminAuth');

    Route::post('/article/confirm-delete/', 'AdminController@confirmDeleteAdminArticle')->name('confirmdeleteArticle')->middleware('checkAdminAuth');
    //end of custom admin article CRUD routes

    Route::post('/add-video', 'AdminController@addVideo');

    Route::get('/get-videos', 'AdminController@getVideos');

    Route::post('/edit-video-details', 'AdminController@editVideoDetails');

    Route::post('/delete-video', 'AdminController@deleteVideo');

    Route::post('/add-health-resource', 'AdminController@addHealthResource');

    Route::post('/edit-health-resource', 'AdminController@editHealthResource');

    Route::get('/get-health-resources', 'AdminController@getHealthResources');

    Route::post('/delete-health-resource', 'AdminController@deleteHealthResource');

    Route::post('/add-pharmacy-resource', 'AdminController@addPharmacy');

    Route::get('/get-pharmacy-resources', 'AdminController@getPharmacyResources');

    Route::post('/delete-pharmany-resource', 'AdminController@deletePharmacyResource');

    Route::post('/edit-pharmacy-resource', 'AdminController@editPharmacy');

    Route::post('/add-doctor-details', 'AdminController@addDoctorDetails');

    Route::get('/get-doctor-accounts', 'AdminController@getDoctorAccounts');

    Route::post('/edit-doctor-accounts', 'AdminController@editDoctorDetails');

    Route::post('/toggle-doctor-active-status', 'AdminController@toggleDoctorActiveStatus');

    Route::post('/delete-doctor-details', 'AdminController@deleteDoctorDetails');

    Route::post('/add-admin-account', 'AdminController@addAdminAccount');

    Route::get('/get-admin-accounts', 'AdminController@getAdminAccounts');

    Route::get('/get-user-accounts', 'AdminController@getUserAccounts');

    Route::post('/toggle-admin-active-status', 'AdminController@toggleAdminStatus');

    Route::post('/toggle-user-active-status', 'AdminController@toggleUserActiveStatus');

    Route::get('/get-dashboard-user-summary-graph-data', 'AdminController@getDashboardSummaryGraphData');
});

Route::prefix('publisher')->group(function () {
    Route::get('/articles', 'AdminController@renderPublisherArticlesPage')->middleware('checkPublisherAuth');

    Route::get('/publish-article', 'AdminController@renderPublisherPublicationPage')->middleware('checkPublisherAuth');

    Route::get('/article-categories', 'AdminController@renderPublisherCategoriesPage')->middleware('checkPublisherAuth');
});

Route::post('/close-question', 'GeneralController@closeQuestion');

Route::prefix('stat')->group(function () {
    Route::get('/get-user-statistics', 'StatisticsController@getUserStatistics');

    Route::get('/get-doctor-statistics', 'StatisticsController@getDoctorStatistics');

    Route::get('/get-admin-statistics', 'StatisticsController@getAdminStatistics');

    Route::get('/get-user-signup-statistics', 'StatisticsController@getUserSignupStatistics');

    Route::get('/get-questions-statistics', 'StatisticsController@getQuestionsStatistics');

    Route::get('/get-article-misc-statistics', 'StatisticsController@getArticlesMiscStatistics');

    Route::get('/get-top-users-statistics', 'StatisticsController@getTopUsersStatistics');

    Route::get('/get-top-doctors-statistics', 'StatisticsController@getTopDoctorStatistics');

    Route::get('/get-doctors-all-statistics', 'StatisticsController@getDoctorsAllStatistics');
});
