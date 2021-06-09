<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class GeneralController extends Controller
{
    use ResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getArticles(Request $request)
    {
        $records = Article::all();
        return $this->successResponse('', $records);
    }
    public function getArticle($id)
    {
        $records = Article::where('article_id', $id)->first();
        return $this->successResponse('', $records);
    }

    public function updateArticle(Request $request, $id)
    {

        $record = Article::where('article_id', $id)->first();

        if (!$record) {
            return $this->errorResponse('Article not found');
        }

        if ($request->file('article_thumbnail')) {

            $webImage = $request->file('article_thumbnail');
            $uploadResult = $this->uploadItemImage($webImage, $request->article_title, 'articles');
            if ($uploadResult) {
                $record->article_thumbnail = $uploadResult->path;
            }
        } else {
            $record->article_thumbnail = '';
        }
        $record->article_cat_id = $request->article_cat_id;
        $record->article_title = $request->article_title;
        $record->article_content = $request->article_content;

        if ($record->save()) {
            return $this->successResponse('Article Published Successfully');
        } else {
            return $this->errorResponse('There was an error in processsing your request');
        }

    }
    public function deleteRecord($id)
    {

        $record = Article::where('article_id', $id)->first();

        if (!$record) {
            return $this->errorResponse('Article not found');
        }

        $record->delete();

        return $this->successResponse('Article deleted Successfully');

    }
    public function publishAdminArticle(Request $request)
    {

        $rules = [
            'article_title' => 'required',
            'article_content' => 'required',
            'article_cat_id' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return $this->validationResponse($errors);
        }
        $articleCheck = Article::where('article_title', $request->article_title)->where('article_cat_id', $request->article_category)->where('article_content', $request->article_content)->get();

        if (count($articleCheck) > 0) {
            $response_message = array('success' => false, 'message' => 'Article already exists');
            return response()->json($response_message);
        } else {
            $article = new Article();
            if ($request->file('article_thumbnail')) {

                $webImage = $request->file('article_thumbnail');
                $uploadResult = $this->uploadItemImage($webImage, $request->article_title, 'articles');
                if ($uploadResult) {
                    $article->article_thumbnail = $uploadResult->path;
                }
            } else {
                $article->article_thumbnail = '';
            }
            $article->article_cat_id = $request->article_cat_id;
            $article->article_title = $request->article_title;

            $article->article_content = $request->article_content;
            $article->article_author = 1;

            if ($article->save()) {
                return $this->successResponse('Article Published Successfully');
            } else {
                return $this->errorResponse('There was an error in processsing your request');
            }

        }}

    public function upImage(Request $request)
    {

        $webImage = $request->file('featured_image');

        if ($webImage) {

            $uploadResult = $this->uploadItemImage($webImage, 'article-iamge', 'articles');
            if ($uploadResult) {
                return $uploadResult->path;

            }
        }
    }
    public function uploadItemImage($file, $name, $folder, $subfix = null)
    {

        try {
            /***/
            $extension = $file->getClientOriginalExtension();
            $originalName = Str::slug($name) . $subfix;
            $imageName = $originalName . '.' . $extension;
            $file->move(($folder), $imageName);
            $url = url('/');
            $path = $url . '/' . $folder . '/' . $imageName;
            $result = new \stdClass();
            $result->filename = $imageName;
            $result->path = $path;
            return $result;

        } catch (Exception $e) {
            return $this->errorResponse($e);
        }
    }

}
