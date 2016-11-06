<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormPaymentScheduleItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_payment_schedule_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_payment_schedule_id');
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
		Schema::drop('form_payment_schedule_items');
	}

}
