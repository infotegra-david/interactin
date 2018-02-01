<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEvaluacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('evaluacion', function(Blueprint $table)
		{
			$table->foreign('calificacion_id', 'fk_evaluacion_calificacion1')->references('id')->on('calificacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('inscripcion_id', 'fk_evaluacion_inscripcion1')->references('id')->on('inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id', 'fk_evaluacion_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('evaluacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_evaluacion_calificacion1');
			$table->dropForeign('fk_evaluacion_inscripcion1');
			$table->dropForeign('fk_evaluacion_users1');
		});
	}

}
