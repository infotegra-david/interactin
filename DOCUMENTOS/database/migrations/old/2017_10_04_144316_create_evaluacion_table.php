<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEvaluacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('evaluacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id')->unsigned()->index('fk_evaluacion_users1_idx');
			$table->integer('inscripcion_id')->unsigned()->index('fk_evaluacion_inscripcion1_idx');
			$table->integer('calificacion_id')->unsigned()->index('fk_evaluacion_calificacion1_idx');
			$table->string('observacion', 191)->nullable();
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
		Schema::drop('evaluacion');
	}

}
