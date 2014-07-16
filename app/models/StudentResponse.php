<?php
class StudentResponse extends Eloquent {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	protected $table = 'studentresponse';
	// protected $appends = array('max_overallrank');
	protected $guarded = array('*');

	public function Question()
	{
		return $this->belongsTo('Question','questionid','questionid')->select('questionid','subjectid');
	}
	public function Student()
	{
		return $this->belongsTo('Student','studentid','studentid');
	}

}
