<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('order', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->index()->unsigned();
			$table->tinyInteger('status')->unsigned();
			$table->float('price');
			$table->integer('delivery_provaider_id')->index()->unsigned();;
			$table->text('delivery_adress');
			$table->tinyInteger('days')->unsigned()->nullable();
			$table->integer('payment_method_id')->index()->unsigned();
			$table->timestamps();
			$table->softDeletes();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order');
	}

}
