<?php

namespace App;

use App\BaseModel;
use Illuminate\Support\Str;

class Question extends BaseModel
{
	//If you use a function name which is not the class name, you need to put the column name for the foreign key.
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
		//Remove . from title sentence
		$title = rtrim($title, ".");
		$this->attributes['title'] = $title;
		$this->attributes['slug'] = Str::slug($title);
	}
	
	/*
	 * Accessor:
	 * Getters are accessor and setters are mutators.
	 * Using accessor, we can create derived attributes.
	 * When $question->title is used, laravel internally calls getTitleAttribute method to get the value.
	 * Hence, when we call $question->created_date, laravel will definitely call getCreatedDateAttribute even if the attribute does not actually exist in db.
	 * If it doesn't find an accessor, it will throw an exception variable not found.
	 */
	public function getUrlAttribute() {
		return "questions/{$this->id}";
	}
	
	public function getCreatedDateAttribute() {
		//Since function call should not be done in the view, we created an accessor
		//For dates, there is a php package called carbon package.
		//The diffForHumans method returns date in format like (1 day ago), (10 minutes ago).
		return $this->created_at->diffForHumans();
	}
	
	public function getAnswersStyleAttribute() {
		if ($this->answers_count > 0) {
			if ($this->best_answer_id) {
				return "has-best-answer";
			} else {
				return "answered";
			}
		} else {
			return "unanswered";
		}
	}
}