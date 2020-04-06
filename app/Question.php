<?php

namespace App;

use App\BaseModel;
use Illuminate\Support\Str;

class Question extends BaseModel
{
	//If you use a function name which is not the class name, you
	//need to put the column name for the foreign key.
	public function owner() {
		return $this->belongsTo(User::class, 'user_id');
	}
	
	/*public function user() {
		return $this->belongsTo(User::class);
	}*/
	
	
	/*
	 * This following concept is called mutator.
	 * When laravel maps each table to a class, it doesn't create actual variables in model class.
	 * It inserts each attribute in the attributes array. And by using php magic methods, it creates getters and setters for all attributes.
	 * So the format for these setter is setAttributeNameAttribute()
	 * Eg: setTitleAttribute(), setVotesCountAttribute()
	 * Whenever a programmer tries to set the title externally too, laravel internally calls this method to set the title.
	 * This method sets the attribute value in the attributes array.
	 *
	 * Hence, by the following method, whenever a title is set while seeding, a slug will be generated at the same time.
	 */
	public function setTitleAttribute($title) {
		$title = rtrim($title, ".");
		$this->attributes['title'] = $title;
		$this->attributes['slug'] = Str::slug($title);
	}
}