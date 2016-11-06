<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImgFieldsToPostImagesTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('post_images', function(Blueprint $table) {		
			
			$table->string('img_file_name')->nullable();
			$table->integer('img_file_size')->nullable();
			$table->string('img_content_type')->nullable();
			$table->timestamp('img_updated_at')->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('post_images', function(Blueprint $table) {

			$table->dropColumn('img_file_name');
			$table->dropColumn('img_file_size');
			$table->dropColumn('img_content_type');
			$table->dropColumn('img_updated_at');

		});
	}

}
