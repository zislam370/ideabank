<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormPaymentDisbursmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_payment_disbursments', function(Blueprint $table) {
			$table->increments('id');
			$table->string('Installment');
			$table->date('disburse_date');
			$table->decimal('amount');
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
		Schema::drop('form_payment_disbursments');
	}

}
