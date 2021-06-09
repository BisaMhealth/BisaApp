<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use Illuminate\Support\Facades\DB;

use App\Models\Admin;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\QuestionCategory;
use App\Models\Question;
use App\Models\QuestionResponse;
use App\Models\HealthResource;
use App\Models\Video;
use App\Models\Pharmacy;

class AdminController extends Controller
{

    /**
     * Render dashboard page
     */
    public function renderDashboardPage()
    {
        return view('admin_views.dashboard', ['username' => $_SESSION['admin_username'], 'users' => User::all()->count(), 'doctors' => Doctor::all()->count(), 'questions' => Question::all()->count(), 'articles' => Article::all()->count()]);
    }


    /**
     * Render article categories page
     */
    public function renderArticleCategoriesPage()
    {
        return view('admin_views.article_categories', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render articles page
     */
    public function renderArticlesPage()
    {
        $articles = Article::paginate(13);
        $username = $_SESSION['admin_username'];
        return view('admin_views.articles', compact('username','articles'));
    }

    /**
     * Admin edit,edit article page
     * custom methods
     */

        public function updateAdminArticle(Request $request,$articleId)
        {
            $public_id = "bisa_article__media_".time();
            $article_id = $articleId;
            if(!empty($request->input('article_title')))
            {
            $request->article_title = Article::where('article_id', $article_id)->update([
                'article_title' => $request->input('article_title')
            ]);
            }

            if(!empty($request->input('article_content')))
            {
            $request->article_content = Article::where('article_id', $article_id)->update([
                'article_content' => $request->input('article_content')
            ]);
            }

            if(!empty($request->input('category_name')))
            {
            $request->article_cat_id = Article::where('article_id', $article_id)->update([
                'article_cat_id' => $request->input('category_name')
            ]);
            }

            if($request->hasFile('article_thumbnail'))
            {
                \Cloudder::upload($request->file('article_thumbnail')->getRealPath(),$public_id,array('folder'=>'questions_media'));
                $file_uploaded = \Cloudder::getResult();
                $article_img = $file_uploaded['secure_url'];
                $request->article_thumbnail = Article::where('article_id', $article_id)->update([
                    'article_thumbnail' => $article_img
                ]);
            }
            return back()->withMessage('Article was updated  successfully');
        }

        public function renderAdminEditionPage(Request $request, $articleId)
        {
            $article_edit_id = Article::findorfail($articleId);
            $username =  $_SESSION['admin_username'];
            $categories = ArticleCategory::get();
            return view('admin_views/admin_edit_article',compact('article_edit_id','username','categories'));
        }

        public function renderAdminViewPage(Request $request, $articleId)
        {
                $article_view_id = Article::findorfail($articleId);
                $username =  $_SESSION['admin_username'];
                $categories = ArticleCategory::get();
                return view('admin_views/admin_view_article',compact('article_view_id','username','categories'));

        }

        public function deleteAdminArticle($articleId)
        {
            $article_delete_id = $articleId;
            $article_to_delete = Article::findorfail($article_delete_id);
            $username =  $_SESSION['admin_username'];
            return view('admin_views/admin_delete_article',compact('article_to_delete','username'));
        }

        public function confirmDeleteAdminArticle(Request $request)
        {
            if(!empty($request->input('delete_id')))
            {
            $deleteId = $request->input('delete_id');
            $delete_action = Article::where('article_id',$deleteId)->delete();
                    if($delete_action)
                    {
                      return redirect()->route('admin.articles')->withMessage('Article was deleted successfully');
                    }

            }
        }
    //end of custom admin article CRUD




    /**
     * Render question categories
     */
    public function renderQuestionCategoriesPage()
    {
        return view('admin_views.question_categories', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render questions page
     */
    public function renderQuestionsPage()
    {
        return view('admin_views.questions', ['username' => $_SESSION['admin_username']]);
    }

    /**
     * Renders question details
     */
    public function renderQuestionDetailsPage($questionCode)
    {
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
        return view('admin_views.question_details', ['username' => $_SESSION['admin_username'], 'questionCode' => $questionCode]);
    }


    /**
     * Render admins accounts page
     */
    public function renderAdminsAccountsPage()
    {
        return view('admin_views.admin_accounts', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render doctors accounts page
     */
    public function renderDoctorsAccountsPage()
    {
        return view('admin_views.doctors_accounts', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render users accounts page
     */
    public function renderUsersAccountsPage()
    {

        return view('admin_views.users_accounts', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render general stats page
     */
    public function renderGeneralStatsPage()
    {
        return view('admin_views.general_stats', ['username' => $_SESSION['admin_username']]);
    }

    /**
     * Render doctors stats page
     */
    public function renderDoctorsStatsPage()
    {
        return view('admin_views.doctors_stats', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render users stats page
     */
    public function renderUsersStatsPage()
    {
        return view('admin_views.users_stats', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render the publish article page
     */
    public function renderPublishArticlePage()
    {
        return view('admin_views.publish_article', ['username' => $_SESSION['admin_username']]);
    }

    /**
     * Render videos page
     */
    public function renderVideosPage()
    {
        return view('admin_views.videos', ['username' => $_SESSION['admin_username']]);
    }

    /**
     * Render the health resources page
     */
    public function renderHealthResourecesPage()
    {
        return view('admin_views.health_resources', ['username' => $_SESSION['admin_username']]);
    }

    /**
     * Render the pharmacies page
     */
    public function renderPharmaciesPage()
    {
        return view('admin_views.pharmacies', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render the publisher page
     */
    public function renderPublisherArticlesPage()
    {
        return view('admin_views.publisher_articles', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render the publisher page
     */
    public function renderPublisherCategoriesPage()
    {
        return view('admin_views.publisher_article_categories', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Render the publisher publication page
     */
    public function renderPublisherPublicationPage()
    {
        return view('admin_views.publisher_publish_article', ['username' => $_SESSION['admin_username']]);
    }


    /**
     * Get dashboard summary graph data
     */
    public function getDashboardSummaryGraphData()
    {
        $yearMonthData = array();
        $yearMonthNumberData = array();

        $yearMonth = DB::select("SELECT DISTINCT YEAR(created_at) AS yr, MONTH(created_at) AS mn FROM users ORDER BY YEAR(created_at) DESC LIMIT 10");
        foreach ($yearMonth as $key => $value) {
            $year = $value->yr;
            $month = $value->mn;

            $dateObj   = \DateTime::createFromFormat('!m', intval($month));
            $monthName = $dateObj->format('M');

            $numberOfUsersForYearMonthQuery = DB::select("SELECT COUNT(*) AS num_of_users FROM users WHERE YEAR(created_at) = '$year' AND MONTH(created_at) = '$month'");

            array_push($yearMonthData, "$monthName $year");
            array_push($yearMonthNumberData, $numberOfUsersForYearMonthQuery[0]->num_of_users);
        }

        $data = array('label' => $yearMonthData, 'data' => $yearMonthNumberData);

        $response_message =  array('success' => true, 'message' => 'Data retreived', 'data' => $data);
    	return response()->json($response_message);
    }

    /**
     * Add admin article category
     */
    public function addArticleCategory(Request $request)
    {
        $articleCategoryCheck = ArticleCategory::where('category_name', $request->articleCategoryName)->get();

    	if (count($articleCategoryCheck) > 0 ) {
    		$response_message =  array('success' => false, 'message' => 'Category already exists' );
    		return response()->json($response_message);

    	} else {
    		$articleCategory = new ArticleCategory();
    		$articleCategory->category_name = $request->articleCategoryName;

    		if ($articleCategory->save()) {
    			$response_message =  array('success' => true, 'message' => 'Category added successfully' );
    			return response()->json($response_message);
    		} else {
    			$response_message =  array('success' => false, 'message' => 'Could not add category. Please try again' );
    			return response()->json($response_message);
    		}
    	}
    }


    /**
     * Edit admin article category
     *

     */
    public function editArticleCategory(Request $request)
    {
        $articleCategoryCheck = ArticleCategory::where('category_name', $request->articleCategoryName)->get();

    	if (count($articleCategoryCheck) > 0 ) {
    		$response_message =  array('success' => false, 'message' => 'Category already exists' );
    		return response()->json($response_message);

    	} else {
    		$articleCategory = ArticleCategory::find($request->articleCategoryId);
    		$articleCategory->category_name = $request->articleCategoryName;

    		if ($articleCategory->save()) {
    			$response_message =  array('success' => true, 'message' => 'Category updated successfully' );
    			return response()->json($response_message);
    		} else {
    			$response_message =  array('success' => false, 'message' => 'Could not update category. Please try again' );
    			return response()->json($response_message);
    		}
    	}
    }


    /**
     * Get article categories
     */
    public function getArticleCategories()
    {
        $articleCategories =  ArticleCategory::orderBy('category_name', 'asc')->get();
    	$response_message =  array('success' => true, 'message' => 'article category fetched', 'data' => $articleCategories );
    	return response()->json($response_message);
    }


    /**
     * Delete article category
     *

     */
    public function deleteArticleCategory(Request $request)
    {
        $articleCategory = ArticleCategory::find($request->articleCategoryId);
        if ($articleCategory->delete()) {
            $response_message =  array('success' => true, 'message' => 'Category deleted successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not delete category' );
            return response()->json($response_message);
        }
    }



    /**
     * Add admin question category
     *

     */
    public function addQuestionCategory(Request $request)
    {
        $questionCategoryCheck = QuestionCategory::where('category_name', $request->questionCategoryName)->get();

    	if (count($questionCategoryCheck) > 0 ) {
    		$response_message =  array('success' => false, 'message' => 'Category already exists' );
    		return response()->json($response_message);

    	} else {
    		$questionCategory = new QuestionCategory();
    		$questionCategory->category_name = $request->questionCategoryName;

    		if ($questionCategory->save()) {
    			$response_message =  array('success' => true, 'message' => 'Category added successfully' );
    			return response()->json($response_message);
    		} else {
    			$response_message =  array('success' => false, 'message' => 'Could not add category. Please try again' );
    			return response()->json($response_message);
    		}
    	}
    }


    /**
     * Edit admin question category
     *

     */
    public function editQuestionCategory(Request $request)
    {
        $questionCategoryCheck = QuestionCategory::where('category_name', $request->questionCategoryName)->get();

    	if (count($questionCategoryCheck) > 0 ) {
    		$response_message =  array('success' => false, 'message' => 'Category already exists' );
    		return response()->json($response_message);

    	} else {
    		$questionCategory =  QuestionCategory::find($request->questionCategoryId);
    		$questionCategory->category_name = $request->questionCategoryName;

    		if ($questionCategory->save()) {
    			$response_message =  array('success' => true, 'message' => 'Category updated successfully' );
    			return response()->json($response_message);
    		} else {
    			$response_message =  array('success' => false, 'message' => 'Could not update category. Please try again' );
    			return response()->json($response_message);
    		}
    	}
    }


    /**
     * Get question categories
     */
    public function getQuestionCategories()
    {
        $questionCategories =  QuestionCategory::orderBy('category_name', 'asc')->get();
    	$response_message =  array('success' => true, 'message' => 'article category fetched', 'data' => $questionCategories );
    	return response()->json($response_message);
    }


    /**
     * Delete question category
     *
     */
    public function deleteQuestionCategory(Request $request)
    {
        $questionCategory =  QuestionCategory::find($request->questionCategoryId);
        if ($questionCategory->delete()) {
            $response_message =  array('success' => true, 'message' => 'Category deleted successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not delete category' );
            return response()->json($response_message);
        }
    }

    /**
     * Get all questions
     */
    public function getAllQuestions()
    {
        $data = array();
        $userQuestions = Question::orderBy("question_id", "desc")->get();
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
            $temp_array['patient_username'] = User::find($value['patient_id'])['username'];

            if ($value['question_answered'] == 'no') {
                $temp_array['question_threads'] = 1;
                $temp_array['response_doctor'] = "n/a";
            } else {
                $getQuestionAnswerStatus = QuestionResponse::where('ques_id', $value['question_id'])->get();
                $temp_array['question_threads'] = count($getQuestionAnswerStatus) + 1;

                $getDoctorAnsweringStatus = QuestionResponse::where('ques_id', $value['question_id'])->where('responder_type', 'doctor')->first();
                if ($getDoctorAnsweringStatus) {
                    $doctorDetails = Doctor::find($getDoctorAnsweringStatus['responder_id']);
                    if ($doctorDetails) {
                        $temp_array['response_doctor'] = $doctorDetails->first_name." ".$doctorDetails->last_name;
                    } else{
                        $temp_array['response_doctor'] = "N/A";
                    }
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
     * Gets question details
     */
    public function getQuestionDetails(Request $request)
    {
        $data = array();
        $questionsArray = array();

        $userQuestion = Question::where('question_code', $request->questionCode)->first();

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
            $question_temp_array['creator'] = User::find($userQuestion['patient_id'])['username'];
            $question_temp_array['creator_type'] = 'user';

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
                        $question_temp_array['creator_type'] = 'doctor';
                    } else {
                        $userDetails = User::find($v['responder_id']);
                        $username = $userDetails->username;
                        $question_temp_array['creator'] = $username;
                        $question_temp_array['creator_type'] = 'user';
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
     * Publish admin article
     *
     */
    public function publishAdminArticle(Request $request)
    {
        $articleCheck = Article::where('article_title',$request->articleTitle)->where('article_cat_id',$request->articleCategory)->where('article_content',$request->articleContent)->get();

        if (count($articleCheck) > 0) {
            $response_message =  array('success' => false, 'message' => 'Article already exists' );
            return response()->json($response_message);
        } else {

            if ($request->hasFile('articleThumbnail')) {
                $public_id = "bisa_article_thumbnail_".time();
                Cloudder::upload($request->file('articleThumbnail')->getRealPath(),$public_id , array('folder'=> 'article_thumbnails'));
                $upload_result = Cloudder::getResult();

                if ($upload_result) {
                    $article = new Article();
                    session_start();
                    $article_author = $_SESSION['admin_id'];

                    $article->article_cat_id = $request->articleCategory;
                    $article->article_title = $request->articleTitle;
                    $article->article_thumbnail = $upload_result['secure_url'];
                    $article->article_content = $request->articleContent;
                    $article->article_author = $article_author;

                    if ($article->save()) {
                        $response_message =  array('success' => true, 'message' => 'Article published successfully' );
                        return response()->json($response_message);
                    } else {
                        $response_message =  array('success' => false, 'message' => 'Could not publish article. Please check your internet connection and try again' );
                        return response()->json($response_message);
                    }
                } else {
                    $response_message =  array('success' => false, 'message' => 'Could not publish article. Please check your internet connection' );
                    return response()->json($response_message);
                }

            } else {
                $response_message =  array('success' => false, 'message' => 'Please select article thumbnail' );
                return response()->json($response_message);
            }
        }
    }


    /**
     * Edit admin article
     *

     */
    // public function editAdminArticle(Request $request)
    // {
    //     $articleCheck = Article::where('article_title',$request->articleTitle)->where('article_cat_id',$request->articleCategory)->where('article_content',$request->articleContent)->where('article_id', '<>', $request->articleId)->get();

    //     if (count($articleCheck) > 0) {
    //         $response_message =  array('success' => false, 'message' => 'Article already exists' );
    //         return response()->json($response_message);
    //     } else {

    //         if ($request->hasFile('editArticleThumbnail')) {
    //             $public_id = "bisa_article_thumbnail_".time();
    //             Cloudder::upload($request->file('editArticleThumbnail')->getRealPath(),$public_id , array('folder'=> 'article_thumbnails'));
    //             $upload_result = Cloudder::getResult();

    //             if ($upload_result) {
    //                 $article = Article::find($request->articleId);

    //                 $article->article_cat_id = $request->articleCategory;
    //                 $article->article_title = $request->articleTitle;
    //                 $article->article_thumbnail = $upload_result['secure_url'];
    //                 $article->article_content = $request->articleContent;

    //                 if ($article->save()) {
    //                     $response_message =  array('success' => true, 'message' => 'Article updated successfully' );
    //                     return response()->json($response_message);
    //                 } else {
    //                     $response_message =  array('success' => false, 'message' => 'Could not update article. Please check your internet connection and try again' );
    //                     return response()->json($response_message);
    //                 }
    //             } else {
    //                 $response_message =  array('success' => false, 'message' => 'Could not update article. Please check your internet connection' );
    //                 return response()->json($response_message);
    //             }

    //         } else {
    //             $article = Article::find($request->articleId);

    //             $article->article_cat_id = $request->articleCategory;
    //             $article->article_title = $request->articleTitle;
    //             $article->article_content = $request->articleContent;

    //             if ($article->save()) {
    //                 $response_message =  array('success' => true, 'message' => 'Article updated successfully' );
    //                 return response()->json($response_message);
    //             } else {
    //                 $response_message =  array('success' => false, 'message' => 'Could not update article. Please check your internet connection and try again' );
    //                 return response()->json($response_message);
    //             }
    //         }
    //     }
    // }


    /**
     * Gets all the published articles from the database
     */
    public function getArticles()
    {
        $articles = Article::all();
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

        $response_message =  array('success' => true, 'message' => 'Articles got', 'data' => $data );
        return response()->json($response_message);
    }



    /**
     * Delete admin article
     *

     */
    // public function deleteAdminArticle(Request $request)
    // {
    //     $article =  Article::find($request->articleId);
    //     if ($article->delete()) {
    //         $response_message =  array('success' => true, 'message' => 'Article deleted successfully' );
    //         return response()->json($response_message);
    //     } else {
    //         $response_message =  array('success' => false, 'message' => 'Could not delete article' );
    //         return response()->json($response_message);
    //     }
    // }


    /**
     * Add video
     */
    public function addVideo(Request $request)
    {
        if ($request->hasFile('video')) {
            $public_id = "bisa_video_".time();
            Cloudder::uploadVideo($request->file('video')->getRealPath(),$public_id , array('folder'=> 'videos'));
            $upload_result = Cloudder::getResult();

            if ($upload_result) {
                $video = new Video();
                $video->title = $request->title;
                $video->description = $request->description;
                $video->video_url = $upload_result['secure_url'];

                if ($video->save()) {
                    $response_message =  array('success' => true, 'message' => 'Video uploaded successfully' );
                    return response()->json($response_message);
                } else {
                    $response_message =  array('success' => false, 'message' => 'Unable to upload video' );
                    return response()->json($response_message);
                }
            } else {
                $response_message =  array('success' => false, 'message' => 'Could upload video. Please check your internet connection' );
                return response()->json($response_message);
            }
        } else {
            $response_message =  array('success' => false, 'message' => 'Please select video' );
            return response()->json($response_message);
        }
    }

    /**
     * Edit video details
     */
    public function editVideoDetails(Request $request)
    {
        $video = Video::find($request->videoId);
        $video->title = $request->title;
        $video->description = $request->description;
        if ($video->save()) {
            $response_message =  array('success' => true, 'message' => 'Video details updated successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Unable to update video details' );
            return response()->json($response_message);
        }
    }

    /**
     * Delete video
     */
    public function deleteVideo(Request $request)
    {
        $video = Video::find($request->videoId);
        if ($video->delete()) {
            $response_message =  array('success' => true, 'message' => 'Video deleted' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Unable to delete video' );
            return response()->json($response_message);
        }
    }

    /**
     * Get all videos
     */
    public function getVideos()
    {
        $videos = Video::all();
        $response_message =  array('success' => true, 'message' => 'data retrieved', 'data' => $videos);
        return response()->json($response_message);
    }

    /**
     * Add health resource
     *
     */
    public function addHealthResource(Request $request)
    {
        $resourceCheck = HealthResource::where('name',$request->resourceName)->where('type',$request->resourceType)->where('country',$request->resoresourceCountry)->where('address', $request->resourceAddress)->get();

        if (count($resourceCheck) > 0) {
            $response_message =  array('success' => false, 'message' => 'Health resource already exists' );
            return response()->json($response_message);
        } else {

            if ($request->hasFile('resourceThumbnail')) {
                $public_id = "bisa_health_resource_thumbnail_".time();
                Cloudder::upload($request->file('resourceThumbnail')->getRealPath(),$public_id , array('folder'=> 'health_resource_thumbnails'));
                $upload_result = Cloudder::getResult();

                if ($upload_result) {
                    $healthResource = new HealthResource();

                    $healthResource->name = $request->resourceName;
                    $healthResource->type = $request->resourceType;
                    $healthResource->country = $request->resourceCountry;
                    $healthResource->address = $request->resourceAddress;
                    $healthResource->phone = $request->resourcePhone;
                    $healthResource->email = $request->resourceEmail;
                    $healthResource->longitude = $request->resourceLongitude;
                    $healthResource->latitude = $request->resourceLatitude;
                    $healthResource->description = $request->resourceDescription;
                    $healthResource->speciality = $request->resourceSpeciality;
                    $healthResource->thumbnail = $upload_result['secure_url'];

                    if ($healthResource->save()) {
                        $response_message =  array('success' => true, 'message' => 'Health resource added successfully' );
                        return response()->json($response_message);
                    } else {
                        $response_message =  array('success' => false, 'message' => 'Could not add health resource. Please check your internet connection and try again' );
                        return response()->json($response_message);
                    }
                } else {
                    $response_message =  array('success' => false, 'message' => 'Could add health resource. Please check your internet connection' );
                    return response()->json($response_message);
                }

            } else {
                $response_message =  array('success' => false, 'message' => 'Please select resource thumbnail' );
                return response()->json($response_message);
            }
        }
    }

    /**
     * Edit health resource
     */
    public function editHealthResource(Request $request)
    {
        $healthResource = HealthResource::find($request->resourceId);

        $healthResource->name = $request->resourceName;
        $healthResource->type = $request->resourceType;
        $healthResource->country = $request->resourceCountry;
        $healthResource->address = $request->resourceAddress;
        $healthResource->phone = $request->resourcePhone;
        $healthResource->email = $request->resourceEmail;
        $healthResource->longitude = $request->resourceLongitude;
        $healthResource->latitude = $request->resourceLatitude;
        $healthResource->description = $request->resourceDescription;
        $healthResource->speciality = $request->resourceSpeciality;

        if ($request->hasFile('resourceThumbnail')) {
            $public_id = "bisa_health_resource_thumbnail_".time();
            Cloudder::upload($request->file('resourceThumbnail')->getRealPath(),$public_id , array('folder'=> 'health_resource_thumbnails'));
            $upload_result = Cloudder::getResult();

            if ($upload_result) {
                $healthResource->thumbnail = $upload_result['secure_url'];
            }
        }

        if ($healthResource->save()) {
            $response_message =  array('success' => true, 'message' => 'Health resource updated successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => true, 'message' => 'Unable to update health resource. Please check your internet connection and try again' );
            return response()->json($response_message);
        }

    }


    /**
     * Gets all health resources
     */
    public function getHealthResources()
    {
        $data = HealthResource::all();
        $response_message =  array('success' => true, 'message' => 'Health resources got', 'data' => $data );
        return response()->json($response_message);
    }

    /**
     * Delete admin health resource
     */
    public function deleteHealthResource(Request $request)
    {
        $healthResource =  HealthResource::find($request->healthResourceId);
        if ($healthResource->delete()) {
            $response_message =  array('success' => true, 'message' => 'Health resource deleted successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not delete health resource' );
            return response()->json($response_message);
        }
    }

    /**
     * Add pharmacy
     *
     */
    public function addPharmacy(Request $request)
    {
        $resourceCheck = Pharmacy::where('name',$request->resourceName)->where('country',$request->resoresourceCountry)->where('address', $request->resourceAddress)->get();

        if (count($resourceCheck) > 0) {
            $response_message =  array('success' => false, 'message' => 'Pharmacy details already exists' );
            return response()->json($response_message);
        } else {

            if ($request->hasFile('resourceThumbnail')) {
                $public_id = "bisa_health_resource_thumbnail_".time();
                Cloudder::upload($request->file('resourceThumbnail')->getRealPath(),$public_id , array('folder'=> 'pharmacy_thumbnails'));
                $upload_result = Cloudder::getResult();

                if ($upload_result) {
                    $pharmacy = new Pharmacy();

                    $pharmacy->name = $request->resourceName;
                    $pharmacy->country = $request->resourceCountry;
                    $pharmacy->address = $request->resourceAddress;
                    $pharmacy->phone = $request->resourcePhone;
                    $pharmacy->email = $request->resourceEmail;
                    $pharmacy->longitude = $request->resourceLongitude;
                    $pharmacy->latitude = $request->resourceLatitude;
                    $pharmacy->description = $request->resourceDescription;
                    $pharmacy->thumbnail = $upload_result['secure_url'];

                    if ($pharmacy->save()) {
                        $response_message =  array('success' => true, 'message' => 'Pharmacy added successfully' );
                        return response()->json($response_message);
                    } else {
                        $response_message =  array('success' => false, 'message' => 'Could not add pharmacy. Please check your internet connection and try again' );
                        return response()->json($response_message);
                    }
                } else {
                    $response_message =  array('success' => false, 'message' => 'Could add pharmacy. Please check your internet connection' );
                    return response()->json($response_message);
                }

            } else {
                $response_message =  array('success' => false, 'message' => 'Please select thumbnail' );
                return response()->json($response_message);
            }
        }
    }

    /**
     * Update pharmacy details
     */
    public function editPharmacy(Request $request)
    {
        $pharmacy = Pharmacy::find($request->resourceId);

        $pharmacy->name = $request->resourceName;
        $pharmacy->country = $request->resourceCountry;
        $pharmacy->address = $request->resourceAddress;
        $pharmacy->phone = $request->resourcePhone;
        $pharmacy->email = $request->resourceEmail;
        $pharmacy->longitude = $request->resourceLongitude;
        $pharmacy->latitude = $request->resourceLatitude;
        $pharmacy->description = $request->resourceDescription;

        if ($request->hasFile('resourceThumbnail')) {
            $public_id = "bisa_health_resource_thumbnail_".time();
            Cloudder::upload($request->file('resourceThumbnail')->getRealPath(),$public_id , array('folder'=> 'pharmacy_thumbnails'));
            $upload_result = Cloudder::getResult();

            if ($upload_result) {
                $pharmacy->thumbnail = $upload_result['secure_url'];
            }
        }

        if ($pharmacy->save()) {
            $response_message =  array('success' => true, 'message' => 'Pharmacy updated successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not update pharmacy details. Please check your internet connection and try again' );
            return response()->json($response_message);
        }
    }

    /**
     * Get all pharmacy resources
     */
    public function getPharmacyResources()
    {
        $data = Pharmacy::all();
        $response_message =  array('success' => true, 'message' => 'Pharmacy resources got', 'data' => $data );
        return response()->json($response_message);
    }

    /**
     * Delete pharmacy resource
     */
    public function deletePharmacyResource(Request $request)
    {
        $pharmacy =  Pharmacy::find($request->pharmacyId);
        if ($pharmacy->delete()) {
            $response_message =  array('success' => true, 'message' => 'Pharmacy resource deleted successfully' );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not delete pharmacy resource' );
            return response()->json($response_message);
        }
    }


    /**
     * Add doctor details
     */
    public function addDoctorDetails(Request $request)
    {
        $doctorEmailCheck = Doctor::where('email',$request->doctorEmail)->get();

        if (count($doctorEmailCheck) > 0) {
            $response_message =  array('success' => false, 'message' => 'Email already exists' );
            return response()->json($response_message);
        } else {

            $doctorUsernameCheck = Doctor::where('username',$request->doctorUsername)->get();

            if (count($doctorUsernameCheck) > 0) {
                $response_message =  array('success' => false, 'message' => 'Username already chosen' );
                return response()->json($response_message);
            } else {

                if ($request->hasFile('doctorThumbnail')) {
                    $public_id = "bisa_doctor_thumbnail_".time();
                    Cloudder::upload($request->file('doctorThumbnail')->getRealPath(),$public_id , array('folder'=> 'doctor_thumbnails'));
                    $upload_result = Cloudder::getResult();

                    if ($upload_result) {
                        $doctor = new Doctor();

                        $doctor->title = $request->doctorTitle;
                        $doctor->first_name = $request->doctorFirstName;
                        $doctor->last_name = $request->doctorLastName;
                        $doctor->gender = $request->doctorGender;
                        $doctor->country = $request->doctorCountry;
                        $doctor->address = $request->doctorAddress;
                        $doctor->phone = $request->doctorPhone;
                        $doctor->email = $request->doctorEmail;
                        $doctor->username = $request->doctorUsername;
                        $doctor->password = password_hash($request->doctorPassword, PASSWORD_DEFAULT);
                        $doctor->bio = $request->doctorBio;
                        $doctor->thumbnail = $upload_result['secure_url'];

                        if ($doctor->save()) {
                            $response_message =  array('success' => true, 'message' => 'Doctor added successfully' );
                            return response()->json($response_message);
                        } else {
                            $response_message =  array('success' => false, 'message' => 'Could not add doctor. Please check your internet connection and try again' );
                            return response()->json($response_message);
                        }
                    } else {
                        $response_message =  array('success' => false, 'message' => 'Could not add doctor. Please check your internet connection' );
                        return response()->json($response_message);
                    }

                } else {
                    $response_message =  array('success' => false, 'message' => 'Please select doctor thumbnail' );
                    return response()->json($response_message);
                }
            }
        }
    }


    /**
     * Add doctor details
     */
    public function editDoctorDetails(Request $request)
    {
        $doctorEmailCheck = Doctor::where('email',$request->doctorEmail)->where('doctor_id', '<>', $request->doctorId)->get();

        if (count($doctorEmailCheck) > 0) {
            $response_message =  array('success' => false, 'message' => 'Email already exists' );
            return response()->json($response_message);
        } else {

            $doctorUsernameCheck = Doctor::where('username',$request->doctorUsername)->where('doctor_id', '<>', $request->doctorId)->get();

            if (count($doctorUsernameCheck) > 0) {
                $response_message =  array('success' => false, 'message' => 'Username already chosen' );
                return response()->json($response_message);
            } else {

                if ($request->hasFile('doctorThumbnail')) {
                    $public_id = "bisa_doctor_thumbnail_".time();
                    Cloudder::upload($request->file('doctorThumbnail')->getRealPath(),$public_id , array('folder'=> 'doctor_thumbnails'));
                    $upload_result = Cloudder::getResult();

                    if ($upload_result) {
                        $doctor = Doctor::find($request->doctorId);

                        $doctor->title = $request->doctorTitle;
                        $doctor->first_name = $request->doctorFirstName;
                        $doctor->last_name = $request->doctorLastName;
                        $doctor->gender = $request->doctorGender;
                        $doctor->country = $request->doctorCountry;
                        $doctor->address = $request->doctorAddress;
                        $doctor->phone = $request->doctorPhone;
                        $doctor->email = $request->doctorEmail;
                        $doctor->username = $request->doctorUsername;
                        $doctor->bio = $request->doctorBio;
                        $doctor->thumbnail = $upload_result['secure_url'];

                        if ($doctor->save()) {
                            $response_message =  array('success' => true, 'message' => 'Doctor updated successfully' );
                            return response()->json($response_message);
                        } else {
                            $response_message =  array('success' => false, 'message' => 'Could not update doctor. Please check your internet connection and try again' );
                            return response()->json($response_message);
                        }
                    } else {
                        $response_message =  array('success' => false, 'message' => 'Could not update doctor. Please check your internet connection' );
                        return response()->json($response_message);
                    }

                } else {
                    $doctor = Doctor::find($request->doctorId);

                    $doctor->title = $request->doctorTitle;
                    $doctor->first_name = $request->doctorFirstName;
                    $doctor->last_name = $request->doctorLastName;
                    $doctor->gender = $request->doctorGender;
                    $doctor->country = $request->doctorCountry;
                    $doctor->address = $request->doctorAddress;
                    $doctor->phone = $request->doctorPhone;
                    $doctor->email = $request->doctorEmail;
                    $doctor->username = $request->doctorUsername;
                    $doctor->bio = $request->doctorBio;

                    if ($doctor->save()) {
                        $response_message =  array('success' => true, 'message' => 'Doctor updated successfully' );
                        return response()->json($response_message);
                    } else {
                        $response_message =  array('success' => false, 'message' => 'Could not update doctor. Please check your internet connection and try again' );
                        return response()->json($response_message);
                    }
                }
            }
        }
    }


    /**
     * Gets all doctor accounts
     */
    public function getDoctorAccounts()
    {
        $data = Doctor::all();
        $response_message =  array('success' => true, 'message' => 'Doctors got', 'data' => $data );
        return response()->json($response_message);
    }

    /**
     * Toggle doctor active status
     */
    public function toggleDoctorActiveStatus(Request $request)
    {
        $newDoctorStatus = ($request->doctorStatus == 1) ? 0 : 1;
        $doctor = Doctor::find($request->doctorId);
        $doctor->active = $newDoctorStatus;
        if ($doctor->save()) {
            $response_message =  array('success' => true, 'message' => 'Doctor active status changed');
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not change doctor active status' );
            return response()->json($response_message);
        }
    }


    /**
     * Deletes doctor details
     */
    public function deleteDoctorDetails(Request $request)
    {
        $doctor = Doctor::find($request->doctorId);
        if ($doctor->delete()) {
            $response_message =  array('success' => true, 'message' => 'Doctor Details deleted');
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not delete doctor details' );
            return response()->json($response_message);
        }
    }


    /**
     * Adds admin account
     */
    public function addAdminAccount(Request $request)
    {
        $emailRequest = Admin::where('admin_email', $request->adminEmail)->get();

    	if (count($emailRequest) > 0 ) {
    		$response_message =  array('success' => false, 'message' => 'Email address already exists' );
    		return response()->json($response_message);
    	} else {
			$usernameRequest = Admin::where('admin_username', $request->adminUsername)->get();
			if (count($usernameRequest) > 0 ) {
				$response_message =  array('success' => false, 'message' => 'Username already exists' );
				return response()->json($response_message);
			} else {
				$hashedPassword = password_hash($request->adminPassword, PASSWORD_DEFAULT);
				$admin = new Admin();

				$admin->admin_username = $request->adminUsername;
				$admin->admin_password = $hashedPassword;
				$admin->admin_type = $request->adminType;
				$admin->admin_email = $request->adminEmail;

				if ($admin->save()) {
					$response_message =  array('success' => true, 'message' => 'Account created successful' );
					return response()->json($response_message);
				} else {
					$response_message =  array('success' => false, 'message' => 'Unable to create account' );
					return response()->json($response_message);
				}
			}
    	}
    }

    /**
     * Gets all admin accounts
     */
    public function getAdminAccounts()
    {
        $data = Admin::all();
        $response_message =  array('success' => true, 'message' => 'Admins got', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Gets all user accounts
     */
    public function getUserAccounts()
    {
        $data = User::all();
        $response_message =  array('success' => true, 'message' => 'Users got', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Toggles user active status
     *

     */
    public function toggleUserActiveStatus(Request $request)
    {
        $userNewStatus = ($request->userStatus == 1) ? 0 : 1;
        $user = User::find($request->userId);
        $user->active = $userNewStatus;
        if ($user->save()) {
            $response_message =  array('success' => true, 'message' => 'User active status changed');
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not change user active status' );
            return response()->json($response_message);
        }
    }

    /**
     * Toggles admin active status
     */
    public function toggleAdminStatus(Request $request)
    {
        $adminNewStatus = ($request->adminStatus == 1) ? 0 : 1;
        $admin = Admin::find($request->adminId);
        $admin->admin_active = $adminNewStatus;
        if ($admin->save()) {
            $response_message =  array('success' => true, 'message' => 'Admin active status changed');
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'Could not change admin active status' );
            return response()->json($response_message);
        }
    }
}
