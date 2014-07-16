<?php 
View::composer('pages.profile', function($view){
	$view-> with('student', Auth::user()->Parentlogin->Student->getStudentProfile());
	});

View::composer('pages.dashboard',function($view){
	$view-> with('percentileplot',StudentReport::with('Exam')
						->join('exam','studentreport.examid','=','exam.examid')
						->where('studentid',Auth::user()->Parentlogin->Student->studentid)
						->where('attendance',' P ')
						->select('studentreport.examid','overallrank')
						->orderBy('exam.examdate')
						->get());
});

View::composer('pages.dashboard',function($view){
	$view->with('studentstats', Auth::user()->Parentlogin->Student->getStudentStats());
});

// View::composer('pages.dashboard',function($view){
// 	$view->with('accuracystats', Auth::user()->Parentlogin->Student->getAccuracyStats());
// });

// View::composer('pages.dashboard',function($view){
// 	$view->with('subjects', Auth::user()->Parentlogin->Student->getSubjects());
// });
