<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use LaravelBook\Ardent\Ardent;

class Parentlogin extends Ardent implements UserInterface, RemindableInterface {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	use UserTrait, RemindableTrait;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table = 'parentlogins';
	
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
	/**
	* Get studentid for the user.
	*
	* @return string
	*/
	public function getStudentId()
	{
		return $this->studentid;
	}
	
	/**
	* Get the e-mail address where password reminders are sent.
	*
	* @return string
	*/
	
	/**
	* Post relationship
	*/
	public function Student()
	{
		return $this->hasOne('Student','studentid','studentid');
	}
	public function User()
	{
		return $this->belongsTo('User','loginname','username');
	}
}