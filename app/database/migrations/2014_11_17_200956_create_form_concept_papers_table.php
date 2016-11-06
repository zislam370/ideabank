<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormConceptPapersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_concept_papers', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_id');
			$table->integer('step_id');
			$table->integer('activity_id');
			$table->boolean('is_opened');
			$table->boolean('is_closed');
			$table->text('concept');
			$table->text('background');
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
		Schema::drop('form_concept_papers');
	}

}
