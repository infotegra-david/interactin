<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFacultadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('facultad', function(Blueprint $table)
		{
			$table->foreign('campus_id', 'fk_facultad_campus1')->references('id')->on('campus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_facultad_id', 'fk_facultad_tipo_facultad1')->references('id')->on('tipo_facultad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('facultad', function(Blueprint $table)
		{
			$table->dropForeign('fk_facultad_campus1');
			$table->dropForeign('fk_facultad_tipo_facultad1');
		});
	}

}
