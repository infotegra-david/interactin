<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMatriculaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('matricula', function(Blueprint $table)
		{
			$table->foreign('programa_id', 'fk_matricula_programa1')->references('id')->on('programa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_matricula_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('matricula', function(Blueprint $table)
		{
			$table->dropForeign('fk_matricula_programa1');
			$table->dropForeign('fk_matricula_users1');
		});
	}

}
