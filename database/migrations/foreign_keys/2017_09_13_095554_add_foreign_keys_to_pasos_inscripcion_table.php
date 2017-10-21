<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosInscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_inscripcion', function(Blueprint $table)
		{
			$table->foreign('estado_id', 'fk_pasos_inscripcion_estado1')->references('id')->on('estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('inscripcion_id', 'fk_pasos_inscripcion_inscripcion1')->references('id')->on('inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_paso_id', 'fk_pasos_inscripcion_tipo_paso1')->references('id')->on('tipo_paso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_pasos_inscripcion_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_inscripcion', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_inscripcion_estado1');
			$table->dropForeign('fk_pasos_inscripcion_inscripcion1');
			$table->dropForeign('fk_pasos_inscripcion_tipo_paso1');
			$table->dropForeign('fk_pasos_inscripcion_users1');
		});
	}

}
