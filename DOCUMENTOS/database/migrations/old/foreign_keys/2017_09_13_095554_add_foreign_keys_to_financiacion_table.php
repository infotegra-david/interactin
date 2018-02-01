<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFinanciacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('financiacion', function(Blueprint $table)
		{
			$table->foreign('fuente_financiacion_id', 'fk_financiacion_fuente_financiacion1')->references('id')->on('fuente_financiacion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('inscipcion_id', 'fk_financiacion_inscripcion1')->references('id')->on('inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('financiacion', function(Blueprint $table)
		{
			$table->dropForeign('fk_financiacion_fuente_financiacion1');
			$table->dropForeign('fk_financiacion_inscripcion1');
		});
	}

}
