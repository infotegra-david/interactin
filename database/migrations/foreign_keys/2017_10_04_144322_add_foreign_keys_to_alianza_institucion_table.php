<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlianzaInstitucionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alianza_institucion', function(Blueprint $table)
		{
			$table->foreign('alianza_id', 'fk_alianza_institucion_alianza1')->references('id')->on('alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('institucion_id', 'fk_alianza_institucion_institucion1')->references('id')->on('institucion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alianza_institucion', function(Blueprint $table)
		{
			$table->dropForeign('fk_alianza_institucion_alianza1');
			$table->dropForeign('fk_alianza_institucion_institucion1');
		});
	}

}
