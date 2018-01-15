<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlianzaModalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alianza_modalidades', function(Blueprint $table)
		{
			$table->foreign('alianza_id', 'fk_alianza_modalidad_alianza1')->references('id')->on('alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('modalidades_id', 'fk_alianza_modalidad_modalidad1')->references('id')->on('modalidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alianza_modalidades', function(Blueprint $table)
		{
			$table->dropForeign('fk_alianza_modalidad_alianza1');
			$table->dropForeign('fk_alianza_modalidad_modalidad1');
		});
	}

}
