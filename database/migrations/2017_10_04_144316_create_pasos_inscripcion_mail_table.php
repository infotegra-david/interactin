<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasosInscripcionMailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pasos_inscripcion_mail', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pasos_inscripcion_id')->unsigned()->index('fk_pasos_inscripcion_mail_pasos_inscripcion1_idx');
			$table->integer('mail_id')->unsigned()->index('fk_pasos_iniciativa_mail_mail1_idx');
			$table->integer('user_id')->unsigned()->nullable()->comment('Es el registro del id del usuario remitente del correo');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('pasos_inscripcion_mail');
	}

}
