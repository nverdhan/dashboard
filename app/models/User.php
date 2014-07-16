<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class User extends Ardent implements UserInterface, RemindableInterface {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	use UserTrait, RemindableTrait;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'users';

	/**
	* The attributes excluded from the model's JSON form.
	*
	* @var array
	*/
	protected $hidden = array('password', 'remember_token');

	
	/** 
	* These properties can be mass-assigned.
	* We do not want the user to change his user id
	* Fillable are those which can be mass-assigned
	* Guarded are those which cannot be mass-assigned
	*/
	
	protected $guarded = array('*');
	/**
	* Get the unique identifier for the user.
	*
	* @return mixed
	*/
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}
	
	/**
	* Get the password for the user.
	*
	* @return string
	*/
	public function getAuthPassword()
	{
		return $this->password;
	}
	public function getUserType()
	{
		return $this->usertype;
	}
	/**
	* Get the e-mail address where password reminders are sent.
	*
	* @return string
	*/
	/**
	* Ardent validation rules
	*/
	public static $rules = array(
		'username' => 'required|between:4,16',
		'password' => 'required|alpha_num|min:6|confirmed',
		);
	
	/** We do not want password confirmation data 
	* It was just for validation
	*/
	public $autoPurgeRedundantAttributes = true;
	/**
	* Post relationship
	*/
	public function Parentlogin()
	{	
		return $this->hasOne('Parentlogin','loginname','username');
	}
}