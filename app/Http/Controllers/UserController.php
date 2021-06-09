<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\Article;
use App\Models\User;
use App\Models\UserHealthInfo;
use App\Models\Doctor;
use App\Models\HealthResource;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\QuestionResponse;
use JD\Cloudder\Facades\Cloudder;
use App\Models\Device;
use App\Core\GlobalService;


class UserController extends Controller
{
    use GlobalService;
    /**
     * Renders anonymous user questions page
     */
    public function renderQuestionsPage()
    {
        $username = $_SESSION['username'];
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('user_views.questions', ['username' => $username, 'articleCategories' => $articleCategories]);
    }


    /**
     * Renders health info page
     *
     * @param string category_name
     */
    public function renderHealthInfoPage($category_name)
    {
        $username = $_SESSION['username'];
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('user_views.health_info', ['username' => $username, 'category_name' => $category_name, 'articleCategories' => $articleCategories]);
    }


    /**
     * Renders health resources page
     */
    public function renderHealthResourcesPage()
    {
        $username = $_SESSION['username'];
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('user_views.health_resources', ['username' => $username, 'articleCategories' => $articleCategories]);
    }


    /**
     * Renders doctors details page
     */
    public function renderDoctorsDetailsPage()
    {
        $username = $_SESSION['username'];
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('user_views.doctors_details', ['username' => $username, 'articleCategories' => $articleCategories]);
    }


    /**
     * Renders question details
     */
    public function renderQuestionDetailsPage($questionCode)
    {
        $username = $_SESSION['username'];
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('user_views.question_details', ['username' => $username, 'articleCategories' => $articleCategories, 'questionCode' => $questionCode]);
    }


    /**
     * Renders account settings page
     */
    public function renderAccountSettingsPage()
    {
        $username = $_SESSION['username'];
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        $userDetails = User::find($_SESSION['user_id']);
        $userHealthInfo = UserHealthInfo::where('uid', $_SESSION['user_id'])->latest()->first();
        return view('user_views.account_settings',['username' => $username, 'articleCategories' => $articleCategories, 'userDetails' => $userDetails, 'userHealthInfo' => $userHealthInfo]);
    }

    /**
     * Gets all articles by category
     *
     * @param Illuminate\Http\Request;
     */
    public function getArticlesByCategory(Request $request)
    {
        $category_id = ArticleCategory::where('category_name', $request->articleCategory)->first()['category_id'];
        $articles = Article::where('article_cat_id', $category_id)->get();
        $data = array();
        $articleArray = array();

        if (count($articles) > 0) {
            foreach ($articles as $key => $value) {
                $articleArray['article_id'] = $value['article_id'];
                $articleArray['article_cat_id'] = $value['article_cat_id'];
                $articleArray['article_title'] = $value['article_title'];
                $articleArray['article_thumbnail'] = $value['article_thumbnail'];
                $articleArray['article_content'] = $value['article_content'];
                $articleArray['article_upvotes'] = $value['article_upvotes'];
                $articleArray['article_downvotes'] = $value['article_downvotes'];
                $articleArray['article_views'] = $value['article_views'];
                $articleArray['article_author'] = $value['article_author'];
                $articleArray['article_publication_date'] = explode(" ", $value['updated_at'])[0];
                $articleArray['article_publication_time'] = explode(" ", $value['updated_at'])[1];
                $articleArray['article_author'] = Article::find($value['article_id'])->articleAuthor['admin_username'];
                $articleArray['article_category'] = Article::find($value['article_id'])->articleCategory['category_name'];

                array_push($data, $articleArray);
            }
        }

        $response_message =  array('success' => true, 'message' => 'articles gots', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Gets an article by title
     */
    public function getArticleByTitle($articleTitle) {
        $article = Article::where('article_title', $articleTitle)->first();
        $articleId = $article['article_id'];
        $articleViews = $article['article_views'];

        # update the number of views for the article
        $updateArticle = Article::find($articleId);
        $updateArticle->article_views = $articleViews + 1;
        $updateArticle->save();

        $article = Article::where('article_title', $articleTitle)->first();

        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
        } else {
            $username = 'anonymous';
        }
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('user_views.article_details', ['username' => $username, 'articleCategories' => $articleCategories, 'article' => $article]);
    }


    /**
     * Upvote an article
     *
     * @param Illuminate\Http\Request;
     */
    public function upvoteArticle(Request $request)
    {
        $articleId = $request->articleId;
        $article = Article::find($articleId);
        $numberOfUpvotes = $article->article_upvotes;
        $updateUpvotes = $numberOfUpvotes + 1;
        $article->article_upvotes = $updateUpvotes;
        if ($article->save()) {
            $response_message =  array('success' => true, 'message' => 'article upvote successful', 'num_of_upvotes' => $updateUpvotes );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'article upvote unsuccessful');
            return response()->json($response_message);
        }
    }



    /**
     * Downvote an article
     *
     * @param Illuminate\Http\Request;
     */
    public function downvoteArticle(Request $request)
    {
        $articleId = $request->articleId;
        $article = Article::find($articleId);
        $numberOfDownvotes = $article->article_downvotes;
        $updateDownvotes = $numberOfDownvotes + 1;
        $article->article_downvotes = $updateDownvotes;
        if ($article->save()) {
            $response_message =  array('success' => true, 'message' => 'article downvote successful', 'num_of_downvotes' => $updateDownvotes );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'article downvote unsuccessful');
            return response()->json($response_message);
        }
    }


    /**
     * Gets all doctors accounts
     */
    public function getDoctorsDetails(Request $request)
    {
        $data = Doctor::all();
        $response_message =  array('success' => true, 'message' => 'doctors details got', 'data' => $data);
        return response()->json($response_message);
    }


    /**
     * Gets all health resources
     */
    public function getHealthResources()
    {
        $data = HealthResource::all();
        $response_message =  array('success' => true, 'message' => 'doctors details got', 'data' => $data);
        return response()->json($response_message);
    }


    /**
     * Adds user question
     */
    public function addQuestion(Request $request)
    {
        if ($request->hasFile('questionMedia')) {
            $public_id = "bisa_question_media_".time();
            Cloudder::upload($request->file('questionMedia')->getRealPath(),$public_id , array('folder'=> 'question_media'));
            $upload_result = Cloudder::getResult();


            if ($upload_result) {
                session_start();
                $question = new Question();
                $question->patient_id = $_SESSION['user_id'];
                $question->question_cat_id = $request->questionCategory;
                $question->question_content = $request->questionContent;
                $question->question_media_url = $upload_result['secure_url'];
                $question->question_code = substr(md5(intval(time()) + rand()), 0, 10);

                if ($question->save()) {
                    $response_message =  array('success' => true, 'message' => 'question submitted successfully' );
                    return response()->json($response_message);
                } else {
                    $response_message =  array('success' => false, 'message' => 'Could not submit question. Please check your internet connection and try again' );
                    return response()->json($response_message);
                }
            } else {
                $response_message =  array('success' => false, 'message' => 'Could submit question. Please check your internet connection' );
                return response()->json($response_message);
            }

        } else {
            session_start();
            $question = new Question();
            $question->patient_id = $_SESSION['user_id'];
            $question->question_cat_id = $request->questionCategory;
            $question->question_content = $request->questionContent;
            $question->question_media_url = "n/a";
            $question->question_code = substr(md5(intval(time()) + rand()), 0, 10);

            if ($question->save()) {
                $response_message =  array('success' => true, 'message' => 'question submitted successfully' );
                return response()->json($response_message);
            } else {
                $response_message =  array('success' => false, 'message' => 'Could not submit question. Please check your internet connection and try again' );
                return response()->json($response_message);
            }
        }
    }


    /**
     * Replies user question
     */
    public function replyQuestion(Request $request)
    {
        if ($request->hasFile('questionMedia')) {
            $public_id = "bisa_question_media_".time();
            Cloudder::upload($request->file('questionMedia')->getRealPath(),$public_id , array('folder'=> 'question_media'));
            $upload_result = Cloudder::getResult();


            if ($upload_result) {
                session_start();
                $questionResponse = new QuestionResponse();
                $questionResponse->ques_id = $request->questionId;
                $questionResponse->responder_id = $_SESSION['user_id'];
                $questionResponse->responder_type = 'user';
                $questionResponse->question_response_media_url = $upload_result['secure_url'];
                $questionResponse->question_response_content = $request->questionContent; 
                

                if ($questionResponse->save()) {
                 
                    $response_message =  array('success' => true, 'message' => 'reply submitted successfully' );
                    return response()->json($response_message);
                } else {
                    $response_message =  array('success' => false, 'message' => 'Could not submit reply. Please check your internet connection and try again' );
                    return response()->json($response_message);
                }
            } else {
                $response_message =  array('success' => false, 'message' => 'Could submit reply. Please check your internet connection' );
                return response()->json($response_message);
            }

        } else {
            session_start();
            $questionResponse = new QuestionResponse();
            $questionResponse->ques_id = $request->questionId;
            $questionResponse->responder_id = $_SESSION['user_id'];
            $questionResponse->responder_type = 'user';
            $questionResponse->question_response_media_url = "n/a";
            $questionResponse->question_response_content = $request->questionContent;

            if ($questionResponse->save()) {
                $response_message =  array('success' => true, 'message' => 'reply submitted successfully' );
                return response()->json($response_message);
            } else {
                $response_message =  array('success' => false, 'message' => 'Could not submit reply. Please check your internet connection and try again' );
                return response()->json($response_message);
            }
        }
    }


    /**
     * Gets all user questions
     */
    public function getUserQuestions()
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        $data = array();

        $userQuestions = Question::where('patient_id', $user_id)->get();
        foreach ($userQuestions as $key => $value) {
            $temp_array['question_id'] = $value['question_id'];
            $temp_array['patient_id'] = $value['patient_id'];
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
                $temp_array['question_threads'] = 1;
                $temp_array['response_doctor'] = "n/a";
            } else {
                $getQuestionAnswerStatus = QuestionResponse::where('ques_id', $value['question_id'])->get();
                $temp_array['question_threads'] = count($getQuestionAnswerStatus) + 1;

                $getDoctorAnsweringStatus = QuestionResponse::where('ques_id', $value['question_id'])->where('responder_type', 'doctor')->first();
                if ($getDoctorAnsweringStatus) {
                    $doctorDetails = Doctor::find($getDoctorAnsweringStatus['responder_id']);
                    $temp_array['response_doctor'] = $doctorDetails->first_name." ".$doctorDetails->last_name;
                } else {
                    $temp_array['response_doctor'] = "n/a";
                }
            }

            array_push($data, $temp_array);
        }

        $response_message =  array('success' => true, 'message' => 'user question got successfully', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Gets user question details
     */
    public function getUserQuestionDetails(Request $request)
    {
        session_start();
        $user_id = $_SESSION['user_id'];
        $data = array();
        $questionsArray = array();

        $userQuestion = Question::where('patient_id', $user_id)->where('question_code', $request->questionCode)->first();

        if ($userQuestion) {
            $data['question_code'] = $userQuestion['question_code'];
            $questionCategoryDetails = $userQuestion['question_cat_id'];
            $data['question_category'] = QuestionCategory::find($userQuestion['question_cat_id'])->category_name;
            $data['question_id'] =  $userQuestion['question_id'];
            $data['question_closed'] =  $userQuestion['question_closed'];
            $data['question_closed'] =  $userQuestion['question_closed'];
            $data['patient_id'] = $userQuestion['patient_id'];

            $question_temp_array['question_content'] = $userQuestion['question_content'];
            $question_temp_array['question_media_url'] = $userQuestion['question_media_url'];
            $question_temp_array['created_at'] = $userQuestion['created_at'];
            $question_temp_array['creator'] = 'Me';

            array_push($questionsArray, $question_temp_array);

            $questionResponses = QuestionResponse::where('ques_id', $userQuestion['question_id'])->get();
            if (count($questionResponses) > 0) {

                foreach ($questionResponses as $k => $v) {
                    $question_temp_array['question_content'] = $v['question_response_content'];
                    $question_temp_array['question_media_url'] = $v['question_response_media_url'];
                    $question_temp_array['created_at'] = $v['created_at'];

                    if ($v['responder_type'] == 'doctor') {
                        $doctorDetails = Doctor::find($v['responder_id']);
                        $doctorName = $doctorDetails->first_name." ".$doctorDetails->last_name;
                        $question_temp_array['creator'] = $doctorName;
                    } else {
                        $question_temp_array['creator'] = 'Me';
                    }

                    $question_temp_array['created_at'] = $v['created_at'];

                    array_push($questionsArray, $question_temp_array);
                }
            }

            $data['question_threads'] =  $questionsArray;
        }

        $response_message =  array('success' => true, 'message' => 'user question got successfully', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Resets user password
     */
    public function resetUserPassword(Request $request) {
        session_start();
        $userId = $_SESSION['user_id'];
        $currentUser = User::find($userId);
        if ($currentUser) {
            $oldUserPassword = $currentUser->password;
            if (password_verify($request->currentPassword, $oldUserPassword)) {
                $newUserPassword = password_hash($request->newPassword, PASSWORD_DEFAULT);
                $currentUser->password = $newUserPassword;
                $currentUser->save();
                $response_message =  array('success' => true, 'message' => 'Password changed successfully');
                return response()->json($response_message);
            } else {
                $response_message =  array('success' => false, 'message' => 'Your current password is incorrect');
                return response()->json($response_message);
            }
        } else {
            $response_message =  array('success' => false, 'message' => 'user does not exist' );
            return response()->json($response_message);
        }
    }

    /**
     * Reset user health info
     */
    public function resetUserHealthInfo(Request $request)
    {
        session_start();
        $userId = $_SESSION['user_id'];
        $userHealthInfo = UserHealthInfo::where('uid', $userId)->first();
        $userHealthInfo->height = $request->weight;
        $userHealthInfo->weight = $request->height;
        $userHealthInfo->health_conditions = $request->healthConditions;
        $userHealthInfo->allergies = $request->allergies;
        $userHealthInfo->current_medication = $request->currentMedication;
        $userHealthInfo->other_notes = $request->otherNotes;

        if ($userHealthInfo->save()) {
            $response_message =  array('success' => true, 'message' => 'User health info changed');
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Unable to change user health info');
            return response()->json($response_message);
        }
        
    }


    /**
     * Reset user personal info
     */

     public function resetUserPersonalInfo(Request $request)
     {
        session_start();
        $userId = $_SESSION['user_id'];

        if (User::where('email', $request->email)->where('user_id', '<>', $userId)->exists() || Admin::where('admin_email', $request->email)->exists() || Doctor::where('email', $request->email)->exists()) {
            $response_message =  array('success' => false, 'message' => 'Email already exists');
            return response()->json($response_message);
        } else {
            if (User::where('username', $request->username)->where('user_id', '<>', $userId)->exists() || Admin::where('admin_username', $request->username)->exists() || Doctor::where('username', $request->username)->exists()) {
                $response_message =  array('success' => false, 'message' => 'Username already exists');
                return response()->json($response_message);
            } else {
                $user = User::find($userId);
                $user->first_name = $request->firstName;
                $user->last_name = $request->lastName;
                $user->username = $request->username;
                $user->email = $request->email;
                $user->phone = $request->phone;
                $user->address = $request->address;

                $_SESSION['username'] = $request->username;

                if ($user->save()) {
                    $response_message =  array('success' => true, 'message' => 'User info updated');
                    return response()->json($response_message);
                }
            }
        }
        
    }




}
