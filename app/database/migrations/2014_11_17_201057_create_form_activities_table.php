<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_activities', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_id');
			$table->integer('step_id');
			$table->integer('activity_id');
			$table->integer('duration');
			$table->date('due_date');
			$table->string('target');
			$table->string('achieve');
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
		Schema::drop('form_activities');
	}

}
