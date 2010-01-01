<?php

class IndexController extends BaseController {
	public function getTest() {
		//$s = Session::get('orderitem');
		//$p = Param::getProductParam($s['details']);
		//Debugbar::addMessage($p);
		$f = array(
			'url' => 'www.a.ru',
			'paper' => '1',
			'color' => '2',
			);
		$dn = array(
			'url' => 'ссылка',
			'paper' => 'бумага',
			'size' => 'размер'
			);
		foreach( $dn as $origKey => $value ){
			if(!array_key_exists($origKey, $f)) $f[$origKey]=$origKey;
  			$newArray[$dn[$origKey]] = $f[$origKey];
		}
		var_dump($newArray);
		return 'test';
	}
	public function getIndex() {
/*
		if ($ss = Session::all()){
			foreach ($ss as $s) {
				Debugbar::addMessage($s);
			}
		}
*/
		Debugbar::addMessage(Session::all());
		if (Auth::check()) return View::make('home')->with('user', Auth::user());
		
		return View::make('index')->with('user', Auth::user());
	}
}