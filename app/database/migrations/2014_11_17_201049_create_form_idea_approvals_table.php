<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormIdeaApprovalsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_idea_approvals', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_id');
			$table->integer('step_id');
			$table->integer('activity_id');
			$table->integer('approval_id');
			$table->string('comment');
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
		Schema::drop('form_idea_approvals');
	}

}
