<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosAlianzaMailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_alianza_mail', function(Blueprint $table)
		{
			$table->foreign('mail_id', 'fk_pasos_alianza_mail_mail1')->references('id')->on('mail')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasos_alianza_id', 'fk_pasos_alianza_mail_pasos_alianza1')->references('id')->on('pasos_alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_alianza_mail', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_alianza_mail_mail1');
			$table->dropForeign('fk_pasos_alianza_mail_pasos_alianza1');
		});
	}

}
