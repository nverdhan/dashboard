<?php
class Subject extends Eloquent {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	protected $table = 'subject';
	// protected $appends = array('max_overallrank');
	protected $guarded = array('*');
	protected function getSubject()
	{
		return this->subjectname;
	}
	public function Question()
	{	
		return $this->hasMany('Question','subjectid','subjectid');
	}

}
