<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosIniciativaEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_iniciativa_email', function(Blueprint $table)
		{
			$table->foreign('email_id', 'fk_pasos_iniciativa_email_email1')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasos_iniciativa_id', 'fk_pasos_iniciativa_email_pasos_iniciativa1')->references('id')->on('pasos_iniciativa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_iniciativa_email', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_iniciativa_email_email1');
			$table->dropForeign('fk_pasos_iniciativa_email_pasos_iniciativa1');
		});
	}

}
