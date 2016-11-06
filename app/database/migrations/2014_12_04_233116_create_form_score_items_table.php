<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormScoreItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_score_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_score_item_id');
			$table->string('head');
			$table->string('comment');
			$table->integer('score');
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
		Schema::drop('form_score_items');
	}

}
