<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Input;
use App\Feedback;
use App\Http\Requests;
use App\Http\Requests\FeedbackFormRequest;
use App\Http\Controllers\Controller;

class FeedbacksController extends Controller
{
    public function storeFeedback(FeedbackFormRequest $request)
    {
    	$user_id = $request->input('user_id');
    	$product_id = $request->input('product_id');
    	$nickname = $request->input('nickname');
    	$heading = $request->input('heading');
    	$content = $request->input('content');

    	Feedback::create([
    		'user_id' => $user_id,
    		'product_id' => $product_id,
    		'nickname' => $nickname,
    		'heading' => $heading,
    		'content' => $content
    		]);

    	return redirect()->route('detail', compact('product_id'));
    }
}
