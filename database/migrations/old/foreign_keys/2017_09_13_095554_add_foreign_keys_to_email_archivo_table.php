<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEmailArchivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('email_archivo', function(Blueprint $table)
		{
			$table->foreign('archivo_id', 'fk_email_archivo_archivo1')->references('id')->on('archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('email_id', 'fk_email_archivo_email1')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('email_archivo', function(Blueprint $table)
		{
			$table->dropForeign('fk_email_archivo_archivo1');
			$table->dropForeign('fk_email_archivo_email1');
		});
	}

}
