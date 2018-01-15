<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAsignaturaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('asignatura', function(Blueprint $table)
		{
			$table->foreign('programa_id', 'fk_asignatura_programa1')->references('id')->on('programa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('asignatura', function(Blueprint $table)
		{
			$table->dropForeign('fk_asignatura_programa1');
		});
	}

}
