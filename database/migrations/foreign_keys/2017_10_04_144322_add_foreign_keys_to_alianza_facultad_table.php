<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlianzaFacultadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alianza_facultad', function(Blueprint $table)
		{
			$table->foreign('alianza_id', 'fk_alianza_facultades_alianza1')->references('id')->on('alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('facultad_id', 'fk_alianza_facultades_facultad1')->references('id')->on('facultad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alianza_facultad', function(Blueprint $table)
		{
			$table->dropForeign('fk_alianza_facultades_alianza1');
			$table->dropForeign('fk_alianza_facultades_facultad1');
		});
	}

}
