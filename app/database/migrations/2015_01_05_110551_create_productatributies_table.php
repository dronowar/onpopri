<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductatributiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('productatributies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('product_id')->index()->unsigned();
			$table->integer('atribute_id')->index()->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('productatributies');
	}

}
