<?php

class IndexController extends BaseController {
	public function getIndex() {
		$user = array();

    	if (Auth::check()) {
        $user = Auth::user();
    }
		return View::make('index', array('user' => $user));
	}
}