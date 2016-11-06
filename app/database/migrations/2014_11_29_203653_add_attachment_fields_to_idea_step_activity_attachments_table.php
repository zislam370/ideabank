<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAttachmentFieldsToIdeaStepActivityAttachmentsTable extends Migration {

	/**
	 * Make changes to the table.
	 *
	 * @return void
	 */
	public function up()
	{	
		Schema::table('idea_step_activity_attachments', function(Blueprint $table) {		
			
			$table->string('attachment_file_name')->nullable();
			$table->integer('attachment_file_size')->nullable();
			$table->string('attachment_content_type')->nullable();
			$table->timestamp('attachment_updated_at')->nullable();

		});

	}

	/**
	 * Revert the changes to the table.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('idea_step_activity_attachments', function(Blueprint $table) {

			$table->dropColumn('attachment_file_name');
			$table->dropColumn('attachment_file_size');
			$table->dropColumn('attachment_content_type');
			$table->dropColumn('attachment_updated_at');

		});
	}

}
