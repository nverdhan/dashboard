<?php
class Exam extends Eloquent {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	protected $table = 'exam';
	// protected $appends = array('max_overallrank');
	protected $guarded = array('*');
	
	public function Student()
	{
		return $this->belongsToMany('Student','StudentReport','examid','examid');
	}
	public function getMaxOverallrankAttribute()
	{
		$max_overallrank = DB::table('studentreport')
								->where('examid','=',$this->examid)
								->max('overallrank');
		return $max_overallrank;
	}
	public function StudentReport()
	{	
		return $this->hasMany('StudentReport','examid','examid');
	}
	public function Question()
	{
		return $this->hasMany('Question','examid','examid');
	}
}
