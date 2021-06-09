<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
	public function index()
	{
	  return view('layouts.patients.charthistory');
	}

    public function fetchMessages()
	{
	  return Message::with('user')->get();
	}

	/**
 * Persist message to database
 *
 * @param  Request $request
 * @return Response
 */
	public function sendMessage(Request $request)
	{
	  $user = Auth::user();

	  $message = $user->messages()->create([
	    'message' => $request->input('message')
	  ]);

	  broadcast(new MessageSent($user, $message))->toOthers();

	  return ['status' => __('Message Sent!') ];
	}



}
