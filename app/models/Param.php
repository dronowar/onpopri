<?php

class Param extends Eloquent {

	public $timestamps = false;

	/*public static function getProductParamNames($fd, $product_id){
		DB::setFetchMode(PDO::FETCH_ASSOC);			
		$params = DB::table('productatributies')->leftJoin('params', 'productatributies.param_id','=','params.id')->select('name', 'description')->where('product_id','=',$product_id)->get();
		Debugbar::addMessage($params);
		foreach ($params as $row) {
			foreach ($row as $key => $value) {
				$dn[$row['name']] = $row['description'];
			}
		
		}
		//('select name, description from productatributies LEFT JOIN params ON productatributies.param_id=params.id where product_id = ?', array($product_id));

		Debugbar::addMessage($dn);
		
		//Debugbar::addMessage($dn);
		foreach ($dn as $origKey => $value) {
			if(!array_key_exists($origKey, $fd)) $fd[$origKey]=$origKey;
			$newArray[$dn[$origKey]] = $fd[$origKey];
		}
		//$params = Param::with('name, description')->whereIn('name', $keys)->lists('description');
		return $newArray;
	}*/

}