<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosInscripcionEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_inscripcion_email', function(Blueprint $table)
		{
			$table->foreign('email_id', 'fk_pasos_inscripcion_email_email10')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('pasos_inscripcion_id', 'fk_pasos_inscripcion_email_pasos_inscripcion1')->references('id')->on('pasos_inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_inscripcion_email', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_inscripcion_email_email10');
			$table->dropForeign('fk_pasos_inscripcion_email_pasos_inscripcion1');
		});
	}

}
