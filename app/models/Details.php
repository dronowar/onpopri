<?php

class Details extends Eloquent {

	public $timestamps = false;

    protected $fillable = array(
    	'orderitem_id',
    	'param_key',
    	'value',
    );

	public function orderitem(){
		return $this->belongsTo('Orderitem');
	}
}