<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAplicacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('aplicaciones', function(Blueprint $table)
		{
			$table->foreign('tipo_alianza_id', 'fk_aplicacion_tipo_alianza1')->references('id')->on('tipo_alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('aplicaciones', function(Blueprint $table)
		{
			$table->dropForeign('fk_aplicacion_tipo_alianza1');
		});
	}

}
