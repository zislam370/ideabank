<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormFundItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_fund_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_fund_item_id');
			$table->string('head');
			$table->string('comment');
			$table->decimal('amount');
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
		Schema::drop('form_fund_items');
	}

}
