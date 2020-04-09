<?php

namespace App;


class Answer extends BaseModel
{
	public function question()
	{
		return $this->belongsTo(Question::class);
	}
	
	public function author()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	
	public function getCreatedDateAttribute()
	{
		//Since function call should not be done in the view, we created an accessor
		//For dates, there is a php package called carbon package.
		//The diffForHumans method returns date in format like (1 day ago), (10 minutes ago).
		return $this->created_at->diffForHumans();
	}
	
	public function getBestAnswerStatusAttribute()
	{
		if ($this->id === $this->question->best_answer_id) {
			return "text-success";
		}
		return "text-dark";
	}
	
	public function getIsBestAttribute()
	{
		return $this->id === $this->question->best_answer_id;
	}
	
	//This concept is called Eloquent Events.
	//As soon as an answer object is created, this method will be called
	//and answer count will be incremented automatically while db seeding.
	//Hence the database remains consistent while db seeding.
	public static function boot()
	{
		parent::boot();
		static::created(function ($answer) {
			//$answer->question gives model object
			//$answer->question() gives QueryBuilder object.
			$answer->question->increment('answers_count');
		});
		
		static::deleted(function ($answer) {
			$answer->question->decrement('answers_count');
		});
	}
	
	
	public function votes() {
		return $this->morphToMany(User::class, 'vote')->withTimestamps();
	}
	
	public function vote(int $vote)
	{
		$this->votes()->attach(auth()->id(), ['vote' => $vote]);
		if ($vote < 0) {
			$this->decrement('votes_count');
		} else {
			$this->increment('votes_count');
		}
	}
	
	public function updateVote($vote)
	{
		$this->votes()->updateExistingPivot(auth()->id(), ['vote' => $vote]);
		if ($vote < 0) {
			$this->decrement('votes_count');
			$this->decrement('votes_count');
		} else {
			$this->increment('votes_count');
			$this->increment('votes_count');
		}
	}
}
