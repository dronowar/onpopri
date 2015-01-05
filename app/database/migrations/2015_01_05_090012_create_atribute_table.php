<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtributeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('atribute', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->index()->unsigned();
			$table->string('name');
			$table->text('description');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('atribute');
	}

}
