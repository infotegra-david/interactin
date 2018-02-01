<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasosIniciativaEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pasos_iniciativa_email', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pasos_iniciativa_id')->unsigned()->index('fk_pasos_iniciativa_email_pasos_iniciativa1_idx');
			$table->integer('email_id')->unsigned()->index('fk_pasos_iniciativa_email_email1_idx');
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
		Schema::drop('pasos_iniciativa_email');
	}

}
