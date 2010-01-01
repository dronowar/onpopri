<?php

class OrderController extends BaseController {

	public function postNew()
	{	

	Debugbar::addMessage(Session::all());
		
	$neworder = array(
		'user_id' => Auth::id(),
		'status' => 0,
		'delivery_provider_id' => Input::get('delivery_provider_id'),
		'delivery_adress' => Input::get('delivery_adress'),
		'days' => 3,
		//'payment_method_id' => Input::get('payment'),
		'price' => 2999,
	);
		//create order
	$order = Order::create($neworder);

	Debugbar::addMessage($order);

	foreach (Session::get('orderitem') as $neworderitem) {
		$orderitemdetails = array_pop($neworderitem);
		$neworderitem['order_id'] = $order->id;
		$orderitem = Orderitem::create($neworderitem);

		Debugbar::addMessage($orderitem);

		foreach ($orderitemdetails as $key => $value) {
			$newdetails = array(
				'param_key' => $key,
				'value' => $value,
				'orderitem_id' => $orderitem->id,
				);
			$details = Details::create($newdetails);

			Debugbar::addMessage($details);
		}
	}

	Session::pull('orderitem');

	return Redirect::to('neworder')->with('user', Auth::user())->with('order', $order);
	}
}
