<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasosAlianzaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pasos_alianza', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo_paso_id')->unsigned()->index('fk_pasos_alianza_tipo_paso1_idx');
			$table->integer('estado_id')->unsigned()->index('fk_pasos_alianza_estado1_idx');
			$table->integer('user_id')->unsigned()->index('fk_pasos_alianza_users1_idx');
			$table->integer('campus_id')->unsigned()->index('fk_pasos_alianza_campus1_idx');
			$table->string('observacion', 191)->nullable();
			$table->integer('alianza_id')->unsigned()->index('fk_pasos_alianza_alianza1_idx');
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
		Schema::drop('pasos_alianza');
	}

}
