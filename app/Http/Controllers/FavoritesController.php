<?php

namespace App\Http\Controllers;

use App\Question;

class FavoritesController extends Controller
{
    public function store(Question $question) {
    	//To add in bridging table, use attach method
	    //Always use attach method for many to many relationships.
        $question->favorites()->attach(auth()->id());
        return redirect()->back();
    }
    
    public function destroy(Question $question) {
        $question->favorites()->detach(auth()->id());
	    return redirect()->back();
    }
}
