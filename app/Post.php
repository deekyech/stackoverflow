<?php

namespace App;

use Illuminate\Support\Str;

class Post extends BaseModel
{
    public function author() {
    	return $this->belongsTo(User::class, 'user_id');
    }
    
    public function setTitleAttribute($title) {
	    //Remove . from title sentence
	    $title = rtrim($title, ".");
	    $this->attributes['title'] = $title;
	    $this->attributes['slug'] = Str::slug($title);
    }
}
