<?php

class Institute extends Eloquent {

	protected $table = 'institute';

	protected $guarded = array('*');
	
	

	public function getBatchName()
	{
		return array('batchname'=>$this->batchname);
	}

	public function Batch()
	{
		return $this->hasMany('Batch','instituteid','instituteid');
	}
}