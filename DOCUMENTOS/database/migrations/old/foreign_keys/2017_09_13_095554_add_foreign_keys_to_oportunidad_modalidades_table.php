<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOportunidadModalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('oportunidad_modalidades', function(Blueprint $table)
		{
			$table->foreign('modalidades_id', 'fk_oportunidad_modalidades_modalidades1')->references('id')->on('modalidades')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('oportunidad_id', 'fk_oportunidad_modalidades_oportunidad1')->references('id')->on('oportunidad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('oportunidad_modalidades', function(Blueprint $table)
		{
			$table->dropForeign('fk_oportunidad_modalidades_modalidades1');
			$table->dropForeign('fk_oportunidad_modalidades_oportunidad1');
		});
	}

}
