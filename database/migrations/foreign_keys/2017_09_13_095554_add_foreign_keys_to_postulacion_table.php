<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPostulacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('postulacion', function(Blueprint $table)
		{
			$table->foreign('inscripcion_id', 'fk_postulacion_inscripcion1')->references('id')->on('inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_postulacion_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('postulacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_postulacion_inscripcion1');
			$table->dropForeign('fk_postulacion_users1');
		});
	}

}
