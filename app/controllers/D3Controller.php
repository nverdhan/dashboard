<?php

class D3Controller extends BaseController {
	public function donut()
	{
		// show the form
		return View::make('d3.donut');
	}
}