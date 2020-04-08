<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Http\Requests\Answers\CreateAnswerRequest;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, CreateAnswerRequest $request)
    {
        $question->answers()->create([
        	'body'      =>      $request->body,
	        'user_id'   =>      auth()->id()
        ]);
        session()->flash('success', 'Your answer has been posted successfully!');
        return redirect($question->url);
    }
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Answer $answer
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function edit(Question $question, Answer $answer)
    {
    	$this->authorize('update', $answer);
    	return view('answers.edit', compact(['question', 'answer']));
    }
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \App\Answer $answer
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function update(CreateAnswerRequest $request, Question $question, Answer $answer)
    {
	    $this->authorize('update', $answer);
	    $answer->update([
	    	'body' => $request->body
	    ]);
	    session()->flash('success', 'Your answer was updated successfully.');
	    return redirect($question->url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Answer $answer)
    {
        //
    }
}
