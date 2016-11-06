<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvertisementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('advertisements', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('workflow_category_id');
			$table->string('link_title');
			$table->text('advert');
			$table->string('name');
			$table->date('start');
			$table->date('end');
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
		Schema::drop('advertisements');
	}

}
