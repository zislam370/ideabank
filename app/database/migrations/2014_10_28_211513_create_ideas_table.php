<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdeasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ideas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('fullname');
			$table->integer('category_id');
			$table->text('prob_stmnt');
			$table->text('sol_stmnt');
			$table->text('attachments');
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
		Schema::drop('ideas');
	}

}
