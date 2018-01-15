<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInscripcionAsignaturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inscripcion_asignatura', function(Blueprint $table)
		{
			$table->foreign('equivalente_id', 'fk_inscripcion_asignatura_equivalente1')->references('id')->on('equivalente')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('inscripcion_id', 'fk_inscripcion_asignatura_inscripcion1')->references('id')->on('inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inscripcion_asignatura', function(Blueprint $table)
		{
			$table->dropForeign('fk_inscripcion_asignatura_equivalente1');
			$table->dropForeign('fk_inscripcion_asignatura_inscripcion1');
		});
	}

}
