<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToAlianzaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('alianza', function(Blueprint $table)
		{
			$table->foreign('tipo_tramite_id', 'fk_alianza_tipo_tramite1')->references('id')->on('tipo_tramite')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('alianza', function(Blueprint $table)
		{
			$table->dropForeign('fk_alianza_tipo_tramite1');
		});
	}

}
