<?php

class LoginController extends BaseController {
	public function showLogin()
	{
		// show the form
		return View::make('login.index');
	}
	public function store()
	{
		if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
		{
			if(Auth::user()->usertype=='parent'){
				Session::put('studentid',Auth::user()->Parentlogin->getStudentId());
				Session::put('studentname',Auth::user()->Parentlogin->Student->studentname);
				return Redirect::route('studentdashboard');
			}
		}
		return Redirect::route('login.index')
		->withInput()
		->with('login_errors', true);
	}
	public function doLogout()
	{
		Auth::logout(); // log the user out of our application
		return Redirect::route('login.index'); // redirect the user to the login screen
	}
}