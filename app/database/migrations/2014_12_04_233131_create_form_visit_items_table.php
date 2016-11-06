<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormVisitItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_visit_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_visit_id');
			$table->string('location');
			$table->text('purpose');
			$table->date('start');
			$table->date('end');
			$table->string('outcome');
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
		Schema::drop('form_visit_items');
	}

}
