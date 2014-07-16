<?php
require_once('ModelUtils.php');
class Student extends Eloquent {
	/*
	* all of Eloquent’s methods are still available through Ardent because Ardent is a direct decadent from Eloquent.
	*/
	protected $table = 'student';
	protected $primaryKey = 'studentid';
	protected $guarded = array('*');

	

	public function getStudentProfile()
	{
		$profiledata = 	array(	'studentname' => $this->studentname, 
								'contactdetails' => $this->contactdetails,
								'fathername' => $this->fathername,
								'address' => $this->address,
								'city' => $this->city,
								'parentemail' => $this->parentemail);
		$batchdata = $this->Batch->getBatchDetails();
		return array_merge($profiledata,$batchdata);
	}

	public function getSubjects()
	{
		if($this->Batch->streamid == 1)
		{
			JavaScript::put([
				'Subject'	=>	array(	['num' => 0, 'long'=>'All Subjects', 'short' => 'Overall'],
										['num' => 1, 'long'=>'Physics','short'=>'Phy'],
										['num' => 2, 'long'=>'Chemistry','short'=>'Chem'],
										['num' => 3, 'long'=>'Mathematics','short'=>'Math'],)]);
		}elseif($this->Batch->streamid == 2)
		{
			JavaScript::put([
				'Subject'	=>	array(	['num' => 0, 'long'=>'All Subjects', 'short' => 'Overall'],
										['num' => 1,'long'=>'Physics','short'=>'Phy'],
										['num' => 2,'long'=>'Chemistry','short'=>'Chem'],
										['num' => 3,'long'=>'Biology','short'=>'Bio'],)]);
		}
	}

	public function getBestMarks()
	{	
		
		$allmarks = DB::table('studentreport')
					->join('exam','studentreport.examid','=','exam.examid')
					->where('studentid','=',$this->studentid)
					->select('overallmarks','overallmaxmarks')
					->get();
		$allmarks = objectToArray($allmarks);
		$bestmark = 0;
		$bestpercentage = 0;
		foreach($allmarks as $marksExam){
			$percentage = $marksExam['overallmarks'] / $marksExam['overallmaxmarks'];
			if($percentage >= $bestpercentage)
			{	
				$bestpercentage = $percentage;
				$bestmark = $marksExam['overallmarks'];
			}

		}
		return array('bestoverallmark' => $bestmark);

	}

	public function getAccuracyStats()
	{
		$studentstats = $this->getStudentStats();
		$ColorCorrect = '#71d398';
		$ColorIncorrect = '#f68484';
		$ColorLeftout	= '#75b9e6';
		if($this->Batch->streamid == 1)
		{
			JavaScript::put(['accuracystats' => array(	'Overall' => array(
														[	'label' => 'Correct', 	'data'	=>	100*($studentstats['qcorrectPhy'] + $studentstats['qcorrectChem'] + $studentstats['qcorrectMath'])/$studentstats['qfacedOverall'],		'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*($studentstats['qincorrectPhy'] + $studentstats['qincorrectChem'] + $studentstats['qincorrectMath'])/$studentstats['qfacedOverall'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*($studentstats['qleftoutPhy'] + $studentstats['qleftoutChem'] + $studentstats['qleftoutMath'])/$studentstats['qfacedOverall'],		'color'	=>	$ColorLeftout]),
														'Phy' => array(
														[	'label' => 'Correct', 	'data'	=>	100*$studentstats['qcorrectPhy']/$studentstats['qfacedPhy'],	'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*$studentstats['qincorrectPhy']/$studentstats['qfacedPhy'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*$studentstats['qleftoutPhy']/$studentstats['qfacedPhy'],	'color'	=>	$ColorLeftout]),
														'Chem' => array(
														[	'label' => 'Correct', 	'data'	=>	100*$studentstats['qcorrectChem']/$studentstats['qfacedChem'],	'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*$studentstats['qincorrectChem']/$studentstats['qfacedChem'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*$studentstats['qleftoutChem']/$studentstats['qfacedChem'],	'color'	=>	$ColorLeftout]),
														'Math' => array(
														[	'label' => 'Correct', 	'data'	=>	100*$studentstats['qcorrectMath']/$studentstats['qfacedMath'],	'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*$studentstats['qincorrectMath']/$studentstats['qfacedMath'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*$studentstats['qleftoutMath']/$studentstats['qfacedMath'],	'color'	=>	$ColorLeftout])
													)
							]);
		}elseif($this->Batch->streamid == 2)
		{
			JavaScript::put(['accuracystats' => array(	'Overall' => array(
														[	'label' => 'Correct', 	'data'	=>	100*($studentstats['qcorrectPhy'] + $studentstats['qcorrectChem'] + $studentstats['qcorrectBio'])/$studentstats['qfacedOverall'],		'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*($studentstats['qincorrectPhy'] + $studentstats['qincorrectChem'] + $studentstats['qincorrectBio'])/$studentstats['qfacedOverall'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*($studentstats['qleftoutPhy'] + $studentstats['qleftoutChem'] + $studentstats['qleftoutBio'])/$studentstats['qfacedOverall'],		'color'	=>	$ColorLeftout]),
														'Phy' => array(
														[	'label' => 'Correct', 	'data'	=>	100*$studentstats['qcorrectPhy']/$studentstats['qfacedPhy'],	'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*$studentstats['qincorrectPhy']/$studentstats['qfacedPhy'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*$studentstats['qleftoutPhy']/$studentstats['qfacedPhy'],	'color'	=>	$ColorLeftout]),
														'Chem' => array(
														[	'label' => 'Correct', 	'data'	=>	100*$studentstats['qcorrectChem']/$studentstats['qfacedChem'],	'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*$studentstats['qincorrectChem']/$studentstats['qfacedChem'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*$studentstats['qleftoutChem']/$studentstats['qfacedChem'],	'color'	=>	$ColorLeftout]),
														'Bio' => array(
														[	'label' => 'Correct', 	'data'	=>	100*$studentstats['qcorrectBio']/$studentstats['qfacedBio'],	'color' =>	$ColorCorrect],
														[	'label' => 'Incorrect',	'data'	=>	100*$studentstats['qincorrectBio']/$studentstats['qfacedBio'],	'color'	=>	$ColorIncorrect],
														[	'label'	=>	'Left Out',	'data'	=>	100*$studentstats['qleftoutBio']/$studentstats['qfacedBio'],	'color'	=>	$ColorLeftout])
													)
							]);
		}
	}

	public function getStudentStats()
	{
		$stats = array(	'qfacedOverall'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid') -> count(),
						'qfacedPhy'		=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Phy')-> count(),
						'qfacedChem'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Chem')-> count(),
						'qfacedMath'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Math')-> count(),
						'qfacedBio'		=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Bio')-> count(),
						'qcorrectPhy'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Phy')		
											->where('response','=',' ALPHA') -> count(),
						'qcorrectChem'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Chem')
											->where('response','=',' ALPHA') -> count(),
						'qcorrectMath'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Math')		
											->where('response','=',' ALPHA') -> count(),
						'qcorrectBio'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Bio')		
											->where('response','=',' ALPHA') -> count(),
						'bestrankOverall'=>DB::table('studentreport')
											->where('studentid','=',$this->studentid)
											->where('overallrank','>','0')
											->min('overallrank'),
						'bestrankPhy'	=> DB::table('studentreport')
											->where('studentid','=',$this->studentid)
											->where('phyrank','>','0')
											->min('phyrank'),
						'bestrankChem'	=> DB::table('studentreport')
											->where('studentid','=',$this->studentid)
											->where('chemrank','>','0')
											->min('chemrank'),
						'bestrankMath'	=> DB::table('studentreport')
											->where('studentid','=',$this->studentid)
											->where('mathrank','>','0')
											->min('mathrank'),
						'bestrankBio'	=> DB::table('studentreport')
											->where('studentid','=',$this->studentid)
											->where('biorank','>','0')
											->min('biorank'),
						'qincorrectPhy'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Phy')		
											->where('response','=',' BETA') -> count(),
						'qincorrectChem'=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Chem')
											->where('response','=',' BETA') -> count(),
						'qincorrectMath'=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Math')		
											->where('response','=',' BETA') -> count(),
						'qincorrectBio'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Bio')		
											->where('response','=',' BETA') -> count(),
						'qleftoutPhy'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')
											-> where('subject.subjectname','=','Phy')		
											->where('response','=',' GAMMA') -> count(),
						'qleftoutChem'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Chem')
											->where('response','=',' GAMMA') -> count(),
						'qleftoutMath'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Math')		
											->where('response','=',' GAMMA') -> count(),
						'qleftoutBio'	=> DB::table('studentresponse')
											->join('question','question.questionid','=','studentresponse.questionid')
											->join('subject','question.subjectid','=','subject.subjectid')
											->where('studentid','=',$this->studentid)
											->select('studentresponse.questionid')-> where('subject.subjectname','=','Bio')		
											->where('response','=',' GAMMA') -> count()
											);
						$bestoverallmark = $this-> getBestMarks();
						$studentstats = array_merge($bestoverallmark, $stats);
		return $studentstats;
	}


	// Relationships
	public function Batch()
	{
		return $this->belongsTo('Batch','ibid','ibid');
	}
	public function Parentlogin()
	{
		return $this->belongsTo('Parentlogin','studentid','studentid');
	}
	public function Exam()
	{
		return $this->belongsToMany('Exam','StudentReport','studentid','studentid');
	}
	public function Question()
	{
		return $this->belongsToMany('Question','studentresponse','studentid','questionid')->withPivot('studentresponseid','response','markedans');
	}
	public function StudentReport()
	{
		return $this->hasMany('StudentReport','studentid','studentid');
	}
	// public function StudentResponse()
	// {
	// 	return $this->hasMany('StudentResponse','studentid','studentid');
	// }
}