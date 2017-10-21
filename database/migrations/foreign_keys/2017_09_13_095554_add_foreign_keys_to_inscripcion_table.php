<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('inscripcion', function(Blueprint $table)
		{
			$table->foreign('campus_id', 'fk_inscripcion_campus1')->references('id')->on('campus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('modalidades_id', 'fk_inscripcion_modalidades1')->references('id')->on('modalidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('periodo_id', 'fk_inscripcion_periodo1')->references('id')->on('periodo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('programa_origen_id', 'fk_inscripcion_programa1')->references('id')->on('programa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('programa_destino_id', 'fk_inscripcion_programa2')->references('id')->on('programa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('inscripcion', function(Blueprint $table)
		{
			$table->dropForeign('fk_inscripcion_campus1');
			$table->dropForeign('fk_inscripcion_modalidades1');
			$table->dropForeign('fk_inscripcion_periodo1');
			$table->dropForeign('fk_inscripcion_programa1');
			$table->dropForeign('fk_inscripcion_programa2');
		});
	}

}
