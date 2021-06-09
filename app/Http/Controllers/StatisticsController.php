<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use App\Models\Pharmacy;

class StatisticsController extends Controller
{
    /**
     * Gets user statistics
     */
    public function getUserStatistics()
    {
        $numberOfUsers = User::all()->count();
        $numberOfMaleUsers = User::where('gender', 'male')->count();
        $numberOfFemaleUsers = User::where('gender', 'female')->count();
        $numberOfUnknownGenderUsers = User::where('gender', 'n/a')->count();
        $percentageOfMaleUsers = ($numberOfMaleUsers / $numberOfUsers) * 100 | 0;
        $percentageOfFemaleUsers = ($numberOfFemaleUsers / $numberOfUsers) * 100  | 0;
        $percentageOfUnknownGenderUsers = ($numberOfUnknownGenderUsers / $numberOfUsers) * 100 | 0;

        $labels = ["Males: $numberOfMaleUsers ($percentageOfMaleUsers%)", "Females: $numberOfFemaleUsers ($percentageOfFemaleUsers%)", "Unknown: $numberOfUnknownGenderUsers ($percentageOfUnknownGenderUsers%)"];
        $data = [$numberOfMaleUsers, $numberOfFemaleUsers, $numberOfUnknownGenderUsers];

        $data = array(
            'label' => $labels,
            'data' => $data,
            'title'=> "User Statistics: [$numberOfUsers Users]"
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Get doctor statistics
     */
    public function getDoctorStatistics()
    {
        $numberOfDoctors = Doctor::all()->count();
        $numberOfMaleDoctors = Doctor::where('gender', 'male')->count();
        $numberOfFemaleDoctors = Doctor::where('gender', 'female')->count();
        $numberOfUnknownGenderDoctors = Doctor::where('gender', 'n/a')->count();
        $percentageOfMaleDoctors = ($numberOfMaleDoctors / $numberOfDoctors) * 100 | 0;
        $percentageOfFemaleDoctors = ($numberOfFemaleDoctors / $numberOfDoctors) * 100  | 0;
        $percentageOfUnknownGenderDoctors = ($numberOfUnknownGenderDoctors / $numberOfDoctors) * 100 | 0;

        $labels = ["Males: $numberOfMaleDoctors ($percentageOfMaleDoctors%)", "Females: $numberOfFemaleDoctors ($percentageOfFemaleDoctors%)", "Unknown: $numberOfUnknownGenderDoctors ($percentageOfUnknownGenderDoctors%)"];
        $data = [$numberOfMaleDoctors, $numberOfFemaleDoctors, $numberOfUnknownGenderDoctors];

        $data = array(
            'label' => $labels,
            'data' => $data,
            'title'=> "Doctor Statistics: [$numberOfDoctors Doctors]"
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Get admin statistics
     */
    public function getAdminStatistics()
    {
        $numberOfAdmins = Admin::all()->count();
        $numberOfSuperAdmins = Admin::where('admin_type', 'admin')->count();
        $numberOfPublishers = Admin::where('admin_type', 'publisher')->count();

        $percentageOfSuperAdmins = ($numberOfSuperAdmins / $numberOfAdmins) * 100 | 0;
        $percentageOfPublishers= ($numberOfPublishers / $numberOfAdmins) * 100 | 0;

        $labels = ["Super Admins: $numberOfSuperAdmins ($percentageOfSuperAdmins%)", "Publishers: $numberOfPublishers ($percentageOfPublishers%)"];
        $data = [$numberOfSuperAdmins, $numberOfPublishers];

        $data = array(
            'label' => $labels,
            'data' => $data,
            'title'=> "Admin Statistics: [$numberOfAdmins Admins]"
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }

    public function getTopUsersStatistics()
    {
        $topUserQuery = DB::select("SELECT username, COUNT(patient_id) AS question_count FROM users INNER JOIN questions ON user_id = patient_id GROUP BY username ORDER BY question_count DESC LIMIT 5");

        $usernameArray = array();
        $questionCountArray = array();

        foreach ($topUserQuery as $key => $value) {
            array_push($usernameArray, $value->username);
            array_push($questionCountArray, $value->question_count);
        }

        $data = array(
            'label' => $usernameArray,
            'data' => $questionCountArray,
            'title'=> "Top 5 Users"
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }

    public function getTopDoctorStatistics()
    {
        $topDoctorQuery = DB::select("SELECT username, COUNT(responder_id) AS question_count FROM doctors INNER JOIN question_responses ON doctor_id = responder_id WHERE responder_type = 'doctor' GROUP BY username ORDER BY question_count DESC LIMIT 5");

        $usernameArray = array();
        $questionCountArray = array();

        foreach ($topDoctorQuery as $key => $value) {
            array_push($usernameArray, $value->username);
            array_push($questionCountArray, $value->question_count);
        }

        $data = array(
            'label' => $usernameArray,
            'data' => $questionCountArray,
            'title'=> "Top 5 Doctors"
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }

    /**
     * Get user signup statistics
     */
    public function getUserSignupStatistics()
    {
        $firstDayOfTheWeek = date( 'Y-m-d', strtotime( 'monday this week' ) );
        $lastDayOfTheWeek = date( 'Y-m-d', strtotime( 'sunday this week' ) );
        $thisMonth = date('m');
        $thisYear = date('Y');

        // get number of users today
        $numberOfUsersToday = User::whereDate('created_at', \Carbon::today())->count();
        
        // get number of users this week
        $numberOfUsersThisWeek = User::whereRaw("created_at >= ? AND created_at <= ?", 
            array($firstDayOfTheWeek." 00:00:00", $lastDayOfTheWeek." 23:59:59")
        )->count();

        // get number of users this month
        $numberOfUsersThisMonthQuery = DB::select("SELECT * FROM users WHERE MONTH(created_at) = $thisMonth AND YEAR(created_at) = $thisYear");
        $numberOfUsersThisMonth = count($numberOfUsersThisMonthQuery);

        // get number of users this year
        $numberOfUsersThisYearQuery = DB::select("SELECT * FROM users WHERE YEAR(created_at) = $thisYear");
        $numberOfUsersThisYear = count($numberOfUsersThisYearQuery);

        $data = array(
            'numberOfUsersToday' => $numberOfUsersToday,
            'numberOfUsersThisWeek' => $numberOfUsersThisWeek,
            'numberOfUsersThisMonth'=> $numberOfUsersThisMonth,
            'numberOfUsersThisYear' => $numberOfUsersThisYear
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);

    }

    /**
     * Get questions statistics
     */
    public function getQuestionsStatistics()
    {
        $firstDayOfTheWeek = date( 'Y-m-d', strtotime( 'monday this week' ) );
        $lastDayOfTheWeek = date( 'Y-m-d', strtotime( 'sunday this week' ) );
        $thisMonth = date('m');
        $thisYear = date('Y');

        // get total number of questions
        $numberOfQuestions = Question::all()->count();

        // get number of questions posted today
        $numberOfQuestionsToday = Question::whereDate('created_at', \Carbon::today())->count();
        
        // get number of questions posted this week
        $numberOfQuestionsThisWeek = Question::whereRaw("created_at >= ? AND created_at <= ?", 
            array($firstDayOfTheWeek." 00:00:00", $lastDayOfTheWeek." 23:59:59")
        )->count();

        // get number of questions posted this month
        $numberOfQuestionsThisMonthQuery = DB::select("SELECT * FROM questions WHERE MONTH(created_at) = $thisMonth AND YEAR(created_at) = $thisYear");
        $numberOfQuestionsThisMonth = count($numberOfQuestionsThisMonthQuery);

        // get number of questions posted this year
        $numberOfQuestionsThisYearQuery = DB::select("SELECT * FROM questions WHERE YEAR(created_at) = $thisYear");
        $numberOfQuestionsThisYear = count($numberOfQuestionsThisYearQuery);

        // get number of new questions
        $numberOfNewQuestions = Question::where('question_answered', 'no')->count();

        // get number of answered questions
        $numberOfAnsweredQuestions = Question::where('question_answered', 'yes')->count();

        // get number of open questions
        $numberOfOpenQuestions = Question::where('question_closed', 'no')->count();

        // get number of closed questions
        $numberOfClosedQuestions = Question::where('question_closed', 'yes')->count();

        $data = array(
            'numberOfQuestions' => $numberOfQuestions,
            'numberOfQuestionsToday' => $numberOfQuestionsToday,
            'numberOfQuestionsThisWeek'=> $numberOfQuestionsThisWeek,
            'numberOfQuestionsThisMonth' => $numberOfQuestionsThisMonth,
            'numberOfQuestionsThisYear' => $numberOfQuestionsThisYear,
            'numberOfNewQuestions' => $numberOfNewQuestions,
            'numberOfAnsweredQuestions' => $numberOfAnsweredQuestions,
            'numberOfOpenQuestions' => $numberOfOpenQuestions,
            'numberOfClosedQuestions' => $numberOfClosedQuestions,
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }

    /**
     * Get articles and miscelleneous statistics
     */

    public function getArticlesMiscStatistics()
    {
        // get number of health resources
        $numberOfHealthResources = HealthResource::all()->count();

        // get number of pharmacies
        $numberOfPharmacies = Pharmacy::all()->count();

        // get number of article categories
        $numberOfArticleCategories = ArticleCategory::all()->count();

        // get number of articles
        $numberOfArticles = Article::all()->count();

        // get number of article views
        $numberOfArticleViews = DB::table('articles')->sum('article_views');

        // get number of article upvotes
        $numberOfArticleUpvotes = DB::table('articles')->sum('article_upvotes');

        // get number of article downvotes
        $numberOfArticleDownvotes = DB::table('articles')->sum('article_downvotes');

        $data = array(
            'numberOfHealthResources' => $numberOfHealthResources,
            'numberOfPharmacies' => $numberOfPharmacies,
            'numberOfArticleCategories'=> $numberOfArticleCategories,
            'numberOfArticles' => $numberOfArticles,
            'numberOfArticleViews' => $numberOfArticleViews,
            'numberOfArticleUpvotes' => $numberOfArticleUpvotes,
            'numberOfArticleDownvotes' => $numberOfArticleDownvotes
        );

        $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
        return response()->json($response_message);
    }


    /**
     * Get doctors statistics
     */
    public function getDoctorsAllStatistics()
    {
        $data = array();
        $doctors = Doctor::all();

        if (count($doctors) > 0) {
            foreach ($doctors as $key => $value) {
                
                $doctorId = $value['doctor_id'];

                $numberOfAnsweredQuestions = DB::table('question_responses')->select(DB::raw('count(responder_id) as total_questions'))->where('responder_type','doctor')->where('responder_id', $doctorId)->groupBy('ques_id')->count();

                $temp_data['country'] = $value['country'];
                $temp_data['numberOfAnsweredQuestions'] = $numberOfAnsweredQuestions;

                array_push($data, $temp_data);
            }
            $response_message =  array('success' => true, 'message' => 'data retreived', 'data' => $data );
            return response()->json($response_message);
        } else {
            $response_message =  array('success' => false, 'message' => 'no doctor data available');
            return response()->json($response_message);
        }
        
    }
}
