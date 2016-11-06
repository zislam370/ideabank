<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdeaStepActivityHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('idea_step_activity_histories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_step_id');
			$table->integer('workflow_activity_id');
			$table->integer('status');
			$table->date('due_date');
			$table->date('initiate_date');
			$table->integer('next_activity');
			$table->integer('num_of_activities');
			$table->string(' activity_form_ids');
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
		Schema::drop('idea_step_activity_histories');
	}

}
