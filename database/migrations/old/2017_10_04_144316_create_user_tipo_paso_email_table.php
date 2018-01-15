<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTipoPasoEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_tipo_paso_email', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_tipo_paso_id')->unsigned()->index('fk_user_tipo_paso_email_user_tipo_paso1_idx');
			$table->integer('email_id')->unsigned()->index('fk_user_tipo_paso_email_email1_idx');
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
		Schema::drop('user_tipo_paso_email');
	}

}
