<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderitemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('orderitem', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->index()->unsigned();
			$table->integer('order_id')->index()->unsigned();
			$table->integer('quantity')->unsigned();
			$table->float('price');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('orderitem');
	}

}
