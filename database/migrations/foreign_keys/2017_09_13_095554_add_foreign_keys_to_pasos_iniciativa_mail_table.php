<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosIniciativaMailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_iniciativa_mail', function(Blueprint $table)
		{
			$table->foreign('mail_id', 'fk_pasos_iniciativa_mail_mail1')->references('id')->on('mail')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasos_iniciativa_id', 'fk_pasos_iniciativa_mail_pasos_iniciativa1')->references('id')->on('pasos_iniciativa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_iniciativa_mail', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_iniciativa_mail_mail1');
			$table->dropForeign('fk_pasos_iniciativa_mail_pasos_iniciativa1');
		});
	}

}
