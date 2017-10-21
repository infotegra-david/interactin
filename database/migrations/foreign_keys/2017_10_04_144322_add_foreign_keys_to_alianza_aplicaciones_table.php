<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlianzaAplicacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alianza_aplicaciones', function(Blueprint $table)
		{
			$table->foreign('alianza_id', 'fk_alianza_aplicacion_alianza1')->references('id')->on('alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('aplicaciones_id', 'fk_alianza_aplicacion_aplicacion1')->references('id')->on('aplicaciones')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alianza_aplicaciones', function(Blueprint $table)
		{
			$table->dropForeign('fk_alianza_aplicacion_alianza1');
			$table->dropForeign('fk_alianza_aplicacion_aplicacion1');
		});
	}

}
