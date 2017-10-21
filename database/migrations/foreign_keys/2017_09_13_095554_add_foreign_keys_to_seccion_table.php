<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSeccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('seccion', function(Blueprint $table)
		{
			$table->foreign('pagina_id', 'fk_seccion_pagina1')->references('id')->on('pagina')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('seccion', function(Blueprint $table)
		{
			$table->dropForeign('fk_seccion_pagina1');
		});
	}

}
