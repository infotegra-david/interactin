<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPasosIniciativaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pasos_iniciativa', function(Blueprint $table)
		{
			$table->foreign('estado_id', 'fk_pasos_iniciativa_estado1')->references('id')->on('estado')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('iniciativa_id', 'fk_pasos_iniciativa_iniciativa1')->references('id')->on('iniciativa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_paso_id', 'fk_pasos_iniciativa_tipo_paso1')->references('id')->on('tipo_paso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_pasos_iniciativa_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pasos_iniciativa', function(Blueprint $table)
		{
			$table->dropForeign('fk_pasos_iniciativa_estado1');
			$table->dropForeign('fk_pasos_iniciativa_iniciativa1');
			$table->dropForeign('fk_pasos_iniciativa_tipo_paso1');
			$table->dropForeign('fk_pasos_iniciativa_users1');
		});
	}

}
