<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMailArchivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('mail_archivo', function(Blueprint $table)
		{
			$table->foreign('archivo_id', 'fk_mail_archivo_archivo1')->references('id')->on('archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('mail_id', 'fk_mail_archivo_mail1')->references('id')->on('mail')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('mail_archivo', function(Blueprint $table)
		{
			$table->dropForeign('fk_mail_archivo_archivo1');
			$table->dropForeign('fk_mail_archivo_mail1');
		});
	}

}
