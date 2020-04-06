<?php

namespace App;

use Illuminate\Database\Eloquent\BaseModel;

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
}
