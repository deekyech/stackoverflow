<?php

namespace App;


class Answer extends BaseModel
{
	public function question() {
		return $this->belongsTo(Question::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
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
