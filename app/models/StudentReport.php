<?php
class StudentReport extends Eloquent {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	protected $table = 'studentreport';
	protected $appends = array('percentile');
	protected $guarded = array('*');
	
	
	public function getPercentileAttribute()
	{
		$maxoverallrank = Exam::where('examid',$this->examid)->get()->lists('max_overallrank');
		$percentile = round(100*($maxoverallrank[0]-$this->overallrank)/($maxoverallrank[0] - 1),2);
		return $percentile;
	}
	public function Exam()
	{	
		return $this->belongsTo('Exam','examid','examid')
					->select('examid','testtopic','examdate','subjectid');
	}
	public function Student()
	{
		return $this->belongsTo('Student','studentid','studentid');
	}
}