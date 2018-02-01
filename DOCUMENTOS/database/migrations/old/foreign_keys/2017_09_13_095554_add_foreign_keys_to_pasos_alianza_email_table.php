<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosAlianzaEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_alianza_email', function(Blueprint $table)
		{
			$table->foreign('email_id', 'fk_pasos_alianza_email_email1')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasos_alianza_id', 'fk_pasos_alianza_email_pasos_alianza1')->references('id')->on('pasos_alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_alianza_email', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_alianza_email_email1');
			$table->dropForeign('fk_pasos_alianza_email_pasos_alianza1');
		});
	}

}
