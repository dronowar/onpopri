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

    public static $payments = array(
    	'PayPal' => 1,
    	'Visa / Master Card' => 2,
    );


}