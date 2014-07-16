<?php
class Question extends Eloquent {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	protected $primaryKey = 'questionid';
	protected $table = 'question';
	protected $guarded = array('*');
	
	public function Exam()
	{	
		return $this->belongsTo('Exam','examid','examid');
	}
	public function Student()
	{
		return $this->belongsToMany('Student','studentresponse','questionid','studentid')->wherePivot('studentid',Session::get('studentid'))->withPivot('studentresponseid','response','markedans');
	}
	public function Subject()
	{
		return $this->belongsTo('Subject','subjectid','subjectid');
	}
	// public function StudentResponse()
	// {
	// 	return $this->hasMany('StudentResponse','questionid','questionid');
	// }
}
