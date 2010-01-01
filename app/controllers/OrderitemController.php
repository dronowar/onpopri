<?php

class OrderitemController extends BaseController {
	
	public function getNew()
	{	
		Debugbar::addMessage(Session::all());
		return View::make('neworderitem')->with('user', Auth::user());
	}
	public function getDelete($index){
		$orderitem = Session::get('orderitem');
		if (count($orderitem) > 1) {
			unset($orderitem[$index]);
			Session::put('orderitem', $orderitem);
		}
		else {
			Session::forget('orderitem');
		}
		
		return Redirect::to('/home');
	}
	public function postNew($product_id)
	{
		$neworderitem = array(
			//'order_id' => 0,
			'product_id' => $product_id,
			'quantity' => Input::get('copies'),
			'price' => '1111',
		);
		//$form = Input::except('_token', 'copies');
		//$details = Param::getProductParamNames($form, $product_id);

		$neworderitem['details'] = Input::except('_token', 'copies');
		$orderitem = Session::get('orderitem');
		$orderitem[] = $neworderitem;
		Session::put('orderitem', $orderitem);

		/******/
		/*
		$orderitem = Orderitem::create($neworderitem);
		
		DB::setFetchMode(PDO::FETCH_ASSOC);			
		$atributes = DB::select('select atribute_id, name  from productatributies LEFT JOIN atribute ON productatributies.atribute_id=atribute.id where product_id = ?', array($product_id));
		foreach ($atributes as $key => $value) {
			$newdetails[$value['name']] = Input::get($value['name']);
			$details = Details::create(array('orderitem_id' => $orderitem->id, 'value' => Input::get($value['name']), 'atribute_id' => $value['atribute_id']));
		}
		*/

		return Redirect::to('/home');

		/*
		$newdetails = array(
			'maket_url' => Input::get('maket_url'),
			'paper_id' => Input::get('paper_id'),
			'colors' => Input::get('colors'),
			'paper_size_w' => Input::get('paper_size_w'),
			'paper_size_h' => Input::get('paper_size_h'),
		);
		
		foreach ($newdetails as $key => $value) {
			$atribute_id = DD::select('select id from atribute where name = ?', array($key));
			$details = Details::create(array('orderitem_id' => $orderitem->id, 'value' => $value, 'atribete_id' => $atribete_id));
		}
		*/
	}

}