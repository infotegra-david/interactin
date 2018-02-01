<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasosIniciativaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pasos_iniciativa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo_paso_id')->unsigned()->index('fk_pasos_iniciativa_tipo_paso1_idx');
			$table->integer('estado_id')->unsigned()->index('fk_pasos_iniciativa_estado1_idx');
			$table->integer('user_id')->unsigned()->index('fk_pasos_iniciativa_users1_idx');
			$table->integer('campus_id')->unsigned()->index('fk_pasos_iniciativa_campus1_idx');
			$table->string('observacion', 191)->nullable();
			$table->integer('iniciativa_id')->unsigned()->index('fk_pasos_iniciativa_iniciativa1_idx');
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
		Schema::drop('pasos_iniciativa');
	}

}
