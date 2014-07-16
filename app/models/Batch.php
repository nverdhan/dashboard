<?php

class Batch extends Eloquent {

	protected $table = 'ib';

	protected $guarded = array('*');
	

	
// Relationships
	public function Student()
	{
		return $this->hasMany('Student','ibid','ibid');
	}
	public function Institute()
	{
		return $this->belongsTo('Institute','instituteid','instituteid');
	}
	public function getBatchDetails()
	{
		return array(	'batchname'=>$this->batchname,
						'institutename' => $this->Institute->institutename,
						'instituteaddress' => $this->Institute->instituteaddress);
	}
}