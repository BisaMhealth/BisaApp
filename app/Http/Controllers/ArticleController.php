<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Core\GlobalService;
use App\Core\MakesApiRequest;
use Illuminate\Support\Facades\Session;
use DataTables;

class ArticleController extends Controller
{
    use  MakesApiRequest;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Show Article dashboard
        $categoryData = $this->fetchArticleCategoriesWithArticleCount();
        $categories   = $categoryData->data;


        return view('layouts.articles.article_dashboard',compact('categories'));
    }

    public function getCategoryArticles($catid,$catname){
        //Show category articles
        $categoryName =  $catname;
        $categoryData = $this->fetchArticleCategoriesWithArticleCount();
        $categories   = $categoryData->data;
        $categoryId   = $catid;

        $articlesData =  $this->fetchArticlesByCateggory($categoryName);
        $articles     =  $articlesData->data;

        return view('layouts.articles.category_articles',compact('categoryName','categories','articles','categoryId'));
    }

    public function getArtticlesByCateggory($articleid,$catname,$title,$categoryId){
        //Show articles by category
        $response = $this->fetchArticleById($articleid);
        $article  = $response->data;

        $categoryData =  $this->fetchArticlesByCateggory($catname);
        $categories   = $categoryData->data;

        return view('layouts.articles.read_article',compact('catname','title','categoryId','article','categories'));
    }



    public function showFaq($category=null){
        $catId = $this->fetchFaqCategory();
        $categoryData = $catId->data;
        $listQuestions = '';
        if($category == 'general'){
           $listQuestions = $this->fetchFaqList(1);
        }else{
           $listQuestions = $this->fetchFaqList($category);
        }

        return view('layouts.articles.faqs',compact('categoryData','listQuestions'));
    }


    public function listArticles(){
      $getArticles   = $this->countAllArticles();
      $responseData  = $getArticles->data;

      return view('layouts.articles.list_articles',compact('responseData'));
    }

    public function fetchAllArticles(){
       $getArticles  = $this->countAllArticles();
       $responseData  = $getArticles->data;
       return DataTables::of($responseData)->make(true);
    }

    public function editArticle($articleid){
      $response  = $this->fetchArticleById($articleid);
      $responseData = $response->data;
      $categoryResponse = $this->fetchArticleCategoriesWithArticleCount();
      $category         = $categoryResponse->data;

      return view('layouts.articles.edit_article',compact('responseData','category'));
    }

    public function postArticle(Request $request){
      $userId = Session::get('user_id');

      $thumbnail='n/a';
      try{
        if($request->hasFile('new_image')){
            $public_id = "article_".time();
               \Cloudder::upload($request->file('new_image')->getRealPath(),$public_id,array('folder'=>'questions_media'));
               $c=\Cloudder::getResult();

               $thumbnail = $c['secure_url'];
        }
        $articles = \DB::table('articles')->insert(
          ['article_cat_id' => $request->cat_id,
            'article_title'=> $request->title,
            'slug'=>$request->title,
            'article_content'=>$request->content,
            'article_thumbnail'=>$thumbnail,
            'article_author'=>$userId

          ]
        );

        Session::flash('message', __('Article Added successfully'));
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();
      }catch(\Exception $e){
        Session::flash('message', __('Unable to added article'));
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
      }

    }

    public function publishArticle(){
      $categoryResponse  = $this->fetchArticleCategories();
      $category          = $categoryResponse->data;
  
      return view('layouts.articles.publish_article',compact('category'));
    }


    public function updateArticle(Request $request){
      // Update user state
      $thumbnail = $request->old_url;
      try{
        if($request->hasFile('new_image')){
            $public_id = "article_".time();
               \Cloudder::upload($request->file('new_image')->getRealPath(),$public_id,array('folder'=>'questions_media'));
               $c=\Cloudder::getResult();

               $thumbnail = $c['secure_url'];
        }
        $articles = \DB::table('articles')->where('article_id', $request->article_id)->update(
          ['article_cat_id' => $request->cat_id,
            'article_title'=> $request->title,
            'slug'=>$request->title,
            'article_content'=>$request->content,
            'article_thumbnail'=>$thumbnail

          ]
        );
        Session::flash('message', __('User not found'));
        Session::flash('alert-class', 'alert-success');
        //dd($request->old_url);
        return redirect()->back();
      }catch(\Exception $e){
        Session::flash('message', __('Unable to update article'));
        Session::flash('alert-class', 'alert-danger');
        return redirect()->back();
      }


    }


    public function removeArticle(Request $request){
      try{

        $article_id  =  $request->article_id;
        \DB::table('articles')->where('article_id', '=', $article_id)->delete();

        Session::flash('message', __('Article deleted'));
        Session::flash('alert-class', 'alert-success');

        return 1;
      }catch(\Exception $e){
        Session::flash('message', __('Unable to delete record'));
        Session::flash('alert-class', 'alert-danger');
        return 0;
      }
    }



}
