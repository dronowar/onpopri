<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Order extends Eloquent {

	use SoftDeletingTrait;
    protected $dates = ['deleted_at'];

    protected $fillable = array(
    	'delivery_provider_id',
    	'delivery_adress',
    	'payment_method_id',
    	'days',
    	'status',
    	'user_id',
    	'price',
    );

    public static $status = array(
    	0 => 'maket_modaration',
    	1 => 'maket_rejected',
    	2 => 'payment_is_required',
    	3 => 'paid',
    	4 => 'completed',
    	5 => 'delivered',
    	6 => 'received',
    	7 => 'deleted',
    	);

    public static $payments = array(
    	 1 => 'PayPal',
    	 2 => 'Visa / Master Card',
    );

    public function user(){
		return $this->belongsTo('User');
	}
	public function orderitems(){
		return $this->hasMany('Orderitems');
	}


}