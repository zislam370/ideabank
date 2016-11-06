<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormStackHolderItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_stack_holder_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_stack_holder_id');
			$table->string('name');
			$table->string('role');
			$table->text('remark');
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
		Schema::drop('form_stack_holder_items');
	}

}
