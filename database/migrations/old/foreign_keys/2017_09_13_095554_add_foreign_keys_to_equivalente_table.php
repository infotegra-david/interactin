<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEquivalenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('equivalente', function(Blueprint $table)
		{
			$table->foreign('asignatura_origen_id', 'fk_equivalente_asignatura1')->references('id')->on('asignatura')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('asignatura_destino_id', 'fk_equivalente_asignatura2')->references('id')->on('asignatura')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('equivalente', function(Blueprint $table)
		{
			$table->dropForeign('fk_equivalente_asignatura1');
			$table->dropForeign('fk_equivalente_asignatura2');
		});
	}

}
