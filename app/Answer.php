<?php

namespace App;


class Answer extends BaseModel
{
	public function question() {
		return $this->belongsTo(Question::class);
	}
	public function author() {
		return $this->belongsTo(User::class, 'user_id');
	}
	
	public function getCreatedDateAttribute() {
		//Since function call should not be done in the view, we created an accessor
		//For dates, there is a php package called carbon package.
		//The diffForHumans method returns date in format like (1 day ago), (10 minutes ago).
		return $this->created_at->diffForHumans();
	}
	
	//This concept is called Eloquent Events.
	//As soon as an answer object is created, this method will be called
	//and answer count will be incremented automatically while db seeding.
	//Hence the database remains consistent while db seeding.
	public static function boot() {
		parent::boot();
		static::created(function ($answer) {
			//$answer->question gives model object
			//$answer->question() gives QueryBuilder object.
			$answer->question->increment('answers_count');
		});
	}
}
