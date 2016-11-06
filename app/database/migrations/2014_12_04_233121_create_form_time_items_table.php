<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormTimeItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_time_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_time_item_id');
			$table->string('head');
			$table->string('comment');
			$table->integer('duration');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('form_time_items');
	}

}
