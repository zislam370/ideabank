<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdeaStepActivityAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('idea_step_activity_attachments', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_step_activity_id');
			$table->integer('head_id');
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
		Schema::drop('idea_step_activity_attachments');
	}

}
