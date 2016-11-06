<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateWorkflowStepActivitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('workflow_step_activities', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('workflow_step_id');
			$table->string('name');
			$table->text('description');
			$table->integer('activity_no');
			$table->string('forms');
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
		Schema::drop('workflow_step_activities');
	}

}
