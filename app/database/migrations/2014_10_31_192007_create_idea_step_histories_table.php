<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdeaStepHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('idea_step_histories', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_id');
			$table->integer(' workflow_step_id');
			$table->integer('next_step');
			$table->integer('num_of_steps');
			$table->integer('status');
			$table->date('due_date');
			$table->date('initiate_date');
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
		Schema::drop('idea_step_histories');
	}

}
