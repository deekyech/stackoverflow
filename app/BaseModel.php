<?php
	/**
	 * Created by PhpStorm.
	 * User: admin
	 * Date: 06-04-2020
	 * Time: 11:21
	 */
	
	namespace App;
	
	
	use Illuminate\Database\Eloquent\Model;
	
	class BaseModel extends Model
	{
		
		//For mass assignment using create(['']), you need to either of two things:
		//1. Initialise guarded with no values.
		//2. Insert the mass assignable column names in fillable array.
		
		protected $guarded = [];
	}