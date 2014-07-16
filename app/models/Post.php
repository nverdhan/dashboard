<?php

//use Illuminate\Auth\UserTrait;
//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableTrait;
//use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Post extends Ardent {

	//use UserTrait, RemindableTrait;
	
	protected $table = 'posts';
 
	protected $fillable = array('body');
 
	public function user()
	{
		return $this->belongsTo('User');
	}
	/**
	 * Ardent validation rules
	 */
	public static $rules = array(
	  'body' => 'required',
	  'user_id' => 'required'
	);
	/**
	 * Factory
	 */
	public static $factory = array(
	  'body' => 'text',
	  'user_id' => 'factory|User',
	);
}