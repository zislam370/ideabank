<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFormSpPanelItemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_sp_panel_items', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('form_sp_panel_id');
			$table->string('name');
			$table->string('designation');
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
		Schema::drop('form_sp_panel_items');
	}

}
