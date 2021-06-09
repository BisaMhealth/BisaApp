<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
class GeneralController extends Controller
{

    public function closeQuestion(Request $request)
    {
        $question = Question::find($request->questionId);
        $question->question_closed = 'yes';
        if ($question->save()) {
            $response_message = array('success' => true, 'message' => 'question closed successfully');
            return response()->json($response_message);
        } else {
            $response_message = array('success' => false, 'message' => 'Could not close question. Please check your internet connection and try again');
            return response()->json($response_message);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
