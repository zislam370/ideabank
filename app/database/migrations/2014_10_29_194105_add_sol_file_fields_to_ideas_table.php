<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddSolFileFieldsToIdeasTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('ideas', function(Blueprint $table) {		
			
			$table->string('sol_file_file_name')->nullable();
			$table->integer('sol_file_file_size')->nullable();
			$table->string('sol_file_content_type')->nullable();
			$table->timestamp('sol_file_updated_at')->nullable();

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

			$table->dropColumn('sol_file_file_name');
			$table->dropColumn('sol_file_file_size');
			$table->dropColumn('sol_file_content_type');
			$table->dropColumn('sol_file_updated_at');

		});
	}

}
