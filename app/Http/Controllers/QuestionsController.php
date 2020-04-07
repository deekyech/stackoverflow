<?php

namespace App\Http\Controllers;

use App\Http\Requests\Questions\CreateQuestionRequest;
use App\Question;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
	
	public function __construct()
	{
		//There is an except() method too.
		//This could be done directly in the route too in web.php
		$this->middleware(['auth'])->only(['create', 'store']);
	}
	
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	//Latest function always uses created_at attribute not updated_at
	    //oldest() function is also there.
	    //with('owner') is used for Eager Loading.
	    /*
	     * In eager loading, all questions will be selected from database and all users of the question will also be selected.
	     * If this is not used, then while printing the author of each question, a new query will be fired to database just to get the user from the question id.
	     * This makes a lot of queries and this is called lazy loading.
	     * Hence this makes a lot of difference in performance.
	     * You can check the queries used by installing the laravel debugbar
	     * To install use command:
	     * composer require barryvdh/laravel-debugbar --dev
	     */
    	$questions = Question::with('owner')->latest()->paginate(10);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	//To disable debugbar for create
    	app('debugbar')->disable();
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        auth()->user()->questions()->create([
        	'title'     =>      $request->title,
	        'body'      =>      $request->body
        ]);
        session()->flash("success", "Question has been posted successfully!");
        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
