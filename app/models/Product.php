<?php

class Product extends Eloquent {

public $timestamps = false;

/*public static $color_count = array(
	4 => 'цветное 4 краски',
	8 => 'цветное 8 красок',
	1 => 'чернобелое 1 краска',
 );

public static function getPapers(){
	DB::setFetchMode(PDO::FETCH_ASSOC);
	$papers = DB::select('select id, name from papertype');
	//$papers = array('1' => 1);
	//DB::setFetchMode(PDO::FETCH_CLASS);
	foreach ($papers as $key => $value) {
		$p[$value['id']] = $value['name'];
	}
	return $p;
}
*/
}