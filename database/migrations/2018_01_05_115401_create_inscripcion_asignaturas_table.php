<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInscripcionAsignaturasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inscripcion_asignaturas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inscripcion_id')->unsigned()->index('fk_inscripcion_asignatura_inscripcion1_idx');
			$table->integer('equivalentes_id')->unsigned()->index('fk_inscripcion_asignatura_equivalentes1_idx');
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
		Schema::drop('inscripcion_asignaturas');
	}

}