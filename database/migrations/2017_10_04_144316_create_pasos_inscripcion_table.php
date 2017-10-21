<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePasosInscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pasos_inscripcion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo_paso_id')->unsigned()->index('fk_pasos_inscripcion_tipo_paso1_idx');
			$table->integer('estado_id')->unsigned()->index('fk_pasos_inscripcion_estado1_idx');
			$table->integer('user_id')->unsigned()->index('fk_pasos_inscripcion_users1_idx');
			$table->string('observacion', 191)->nullable();
			$table->integer('inscripcion_id')->unsigned()->index('fk_pasos_inscripcion_inscripcion1_idx');
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
		Schema::drop('pasos_inscripcion');
	}

}
