<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPlantillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('plantillas', function(Blueprint $table)
		{
			$table->foreign('campus_id', 'fk_plantillas_campus1')->references('id')->on('campus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_plantilla_id', 'fk_plantillas_tipo_plantilla1')->references('id')->on('tipo_plantilla')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('plantillas', function(Blueprint $table)
		{
			$table->dropForeign('fk_plantillas_campus1');
			$table->dropForeign('fk_plantillas_tipo_plantilla1');
		});
	}

}
