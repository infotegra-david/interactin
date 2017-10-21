<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosInscripcionMailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_inscripcion_mail', function(Blueprint $table)
		{
			$table->foreign('mail_id', 'fk_pasos_inscripcion_mail_mail10')->references('id')->on('mail')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasos_inscripcion_id', 'fk_pasos_inscripcion_mail_pasos_inscripcion1')->references('id')->on('pasos_inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_inscripcion_mail', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_inscripcion_mail_mail10');
			$table->dropForeign('fk_pasos_inscripcion_mail_pasos_inscripcion1');
		});
	}

}
