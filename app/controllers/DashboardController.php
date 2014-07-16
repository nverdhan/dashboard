<?php

class DashboardController extends BaseController {
public function show()
{	
	Auth::user()->Parentlogin->Student->getAccuracyStats();
	Auth::user()->Parentlogin->Student->getSubjects();
	return View::make('pages.dashboard');
}
}