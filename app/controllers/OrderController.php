<?php
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
//use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

use PayPal\Api\FundingInstrument;
use PayPal\Api\CreditCard;


class OrderController extends BaseController {

	private $_api_context;

    public function __construct()
    {
    	$paypal_conf = Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

	public function getIndex(){
		$userorders = array();
		$orders = Auth::user()->orders()->where('status', '<', '5')->take(10)->get();
		foreach ($orders as $order) {
			$userorders[] = $order->toArray();
		}
		//Product::find($orderitem['product_id'])->name

		Debugbar::addMessage($userorders);
		//return 'test';
		return View::make('orders')->with('user', Auth::user())->with('orders', $userorders);
	}

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

	return Redirect::to('/order');
	}

public function postPayment($order_str)
	{	
		parse_str($order_str, $order);

		$payer = new Payer();
		$amount = new Amount();
		$transaction = new Transaction();
		$payment = new Payment();

		if (Input::get('payment_method_id') == 2) {
			
			$card = new CreditCard();
			$card->setType("visa");

			$card->setNumber("4446283280247004");
			$card->setExpire_month("11");
			$card->setExpire_year("2018");
			$card->setFirst_name("Joe");
			$card->setLast_name("Shopper");

			$fundingInstrument = new FundingInstrument();
			$fundingInstrument->setCredit_card($card);

			$payer->setPayment_method("credit_card");
			$payer->setFunding_instruments(array($fundingInstrument));
		}
		elseif (Input::get('payment_method_id') == 1) {
			$payer->setPaymentMethod('paypal');
	    	$redirect_urls = new RedirectUrls();
	    	$redirect_urls->setReturnUrl(URL::to('/order/payment-status'))
	        	->setCancelUrl(URL::to('/order/payment-status'));

		    $item_1 = new Item();
		    $item_1->setName('Номер заказа: #'.$order['id'].' от '.$order['created_at']) // item name
		        ->setCurrency('RUB')
		        ->setQuantity(1)
		        ->setPrice(10); // unit price		
		     	    // add item to list
		    $item_list = new ItemList();
		    $item_list->setItems(array($item_1));

		    $transaction->setItemList($item_list);

		    $payment->setRedirectUrls($redirect_urls);

		}


   
	    $amount->setCurrency('USD')
	        ->setTotal(100);

	    
	    $transaction->setAmount($amount)
	        //->setItemList($item_list)
	        ->setDescription('Оплата заказа Onpopri');
	        //->setInvoiceNumber(uniqid());

	    
	    $payment->setIntent('Sale')
	        ->setPayer($payer)
	        //->setRedirectUrls($redirect_urls)
	        ->setTransactions(array($transaction));

	    try {
	        $payment->create($this->_api_context);
	    } catch (\PayPal\Exception\PPConnectionException $ex) {
	        if (\Config::get('app.debug')) {
	            echo "Exception: " . $ex->getMessage() . PHP_EOL;
	            //dd($payment);
	            $err_data = json_decode($ex->getData(), true);
	            dd($err_data);
	            exit;
	        } else {
	            die('Some error occur, sorry for inconvenient');
	        }
	    }

	    foreach($payment->getLinks() as $link) {
	        if($link->getRel() == 'approval_url') {
	            $redirect_url = $link->getHref();
	            break;
	        }
	    }

	    if(isset($redirect_url)) {
	    	// add payment ID to session
	    	Session::put('paypal_payment_id', $payment->getId());
	        // redirect to paypal
	        return Redirect::away($redirect_url);
	    }
	    if ($payment->getState() == 'approved') { // payment made
	        return Redirect::to('/order')
	            ->with('success', 'Payment success');
	    }
	    return Redirect::to('/order')
	        ->with('error', 'Payment failed');

	    //return Redirect::to('/order')
	    //   ->with('error', 'Unknown error occurred');
	}

	public function getPaymentStatus()
	{
	    // Get the payment ID before session clear
	    $payment_id = Session::get('paypal_payment_id');

	    // clear the session payment ID
	    Session::forget('paypal_payment_id');

	    if (empty(Input::get('token'))) {
	        return Redirect::to('/order')
	            ->with('error', 'Payment failed');
	    }
	    if (empty(Input::get('PayerID'))) {
	        return Redirect::to('/order')
	            ->with('info', 'Payment canceled');
	    }

	    $payment = Payment::get($payment_id, $this->_api_context);

	    // PaymentExecution object includes information necessary 
	    // to execute a PayPal account payment. 
	    // The payer_id is added to the request query parameters
	    // when the user is redirected from paypal back to your site
	    $execution = new PaymentExecution();
	    $execution->setPayerId(Input::get('PayerID'));

	    //Execute the payment
	    $result = $payment->execute($execution, $this->_api_context);

	    //echo '<pre>';print_r($result);echo '</pre>';exit; // DEBUG RESULT, remove it later

	    if ($result->getState() == 'approved') { // payment made
	        return Redirect::to('/order')
	            ->with('success', 'Payment success');
	    }
	    return Redirect::to('/order')
	        ->with('error', 'Payment failed');
	}

}
