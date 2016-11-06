<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormDeliverableItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_deliverable_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_deliverable_id');
			$table->string('name');
			$table->date('due_date');
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
		Schema::drop('form_deliverable_items');
	}

}
