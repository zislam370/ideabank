<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkflowStepsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflow_steps', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('workflow_step_id');
			$table->string('name');
			$table->text('description');
			$table->integer('next_activity');
			$table->integer('num_of_activities');
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
		Schema::drop('workflow_steps');
	}

}
