<?php

class Orderitem extends Eloquent {
	
	public $timestamps = false;

    protected $fillable = array(
    	'order_id',
    	'product_id',
    	'quantity',
    	'price',
    );

    public function order(){
        return $this->belongsTo('Order');
    }

    public function details(){
		return $this->hasMany('Details');
	}

}