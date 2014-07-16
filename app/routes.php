<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('login', array(
	'uses' => 'LoginController@showLogin',
	'as' => 'login.index')
);

Route::post('login', array(
	'uses' => 'LoginController@store',
	'as' => 'login.store')
);

Route::get('dashboard', array(
	'before' => 'auth',
	'uses' => 'DashboardController@show',
	'as' => 'studentdashboard')
);

Route::get('profile', array(
	'before' => 'auth',
	'as' => 'studentprofile',
	function()
{
	return View::make('pages.profile');
	// return View::composer('pages.profile', function($view){
	// 	// $view-> with('profiledata', Auth::user()->Parentlogin->Student->getStudentProfile());
	// });
})
);
View::composer('profile', function($view){
		$view-> with('profiledata', Auth::user()->Parentlogin->Student->getStudentProfile());
	});

Route::get('logout', array(
	'uses' => 'LoginController@doLogout',
	'as' => 'logout')
);

Route::get('query',function(){
	return StudentReport::with(array('Exam'=>function($query)
	{
		$query->orderBy('examdate');
	}))
	->where('studentid',Auth::user()->Parentlogin->Student->studentid)
	->where('attendance',' P ')
	->select('examid','overallrank')
	->get();
});

Route::get('query1',function(){
	return Student::where('studentid',Session::get('studentid'))
	->with(array('Question'=>function($query)
	{
		$query->where('question.subjectid',2)->count();
	}));
});

Route::get('query2',function(){

	$allmarks = DB::table('studentreport')
					->join('exam','studentreport.examid','=','exam.examid')
					->where('studentid','=',Session::get('studentid'))
					->select('exam.examid','overallmarks','overallmaxmarks')
					->get();
	// foreach($allmarks as get_object_vars($allmarks))
					$abc= objectToArray($allmarks);//['exam.examid'];
					return $abc;
});

Route::get('d3donut', array(
	'uses' => 'D3Controller@donut',
	'as' => 'd3donut')
);


