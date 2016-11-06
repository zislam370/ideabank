<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdeaCapitalizationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('idea_capitalizations', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('idea_id');
			$table->integer('step_id');
			$table->integer('activity_id');
			$table->boolean('is_opened');
			$table->boolean('is_closed');
			$table->decimal('a2i_contribution');
			$table->decimal('initiator_contribution');
			$table->decimal('third_party_contribution');
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
		Schema::drop('idea_capitalizations');
	}

}
