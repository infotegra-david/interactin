<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlianzaProgramaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alianza_programa', function(Blueprint $table)
		{
			$table->foreign('alianza_id', 'fk_alianza_programas_alianza1')->references('id')->on('alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('programa_id', 'fk_alianza_programas_programa1')->references('id')->on('programa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alianza_programa', function(Blueprint $table)
		{
			$table->dropForeign('fk_alianza_programas_alianza1');
			$table->dropForeign('fk_alianza_programas_programa1');
		});
	}

}
