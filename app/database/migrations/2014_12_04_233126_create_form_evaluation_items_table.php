<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormEvaluationItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_evaluation_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_evaluation_id');
			$table->string('task');
			$table->date('due_date');
			$table->string('target');
			$table->string('achieved');
			$table->text('remark');
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
		Schema::drop('form_evaluation_items');
	}

}
