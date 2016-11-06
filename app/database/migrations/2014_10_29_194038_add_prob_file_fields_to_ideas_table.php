<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddProbFileFieldsToIdeasTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('ideas', function(Blueprint $table) {		
			
			$table->string('prob_file_file_name')->nullable();
			$table->integer('prob_file_file_size')->nullable();
			$table->string('prob_file_content_type')->nullable();
			$table->timestamp('prob_file_updated_at')->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ideas', function(Blueprint $table) {

			$table->dropColumn('prob_file_file_name');
			$table->dropColumn('prob_file_file_size');
			$table->dropColumn('prob_file_content_type');
			$table->dropColumn('prob_file_updated_at');

		});
	}

}
