<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToOportunidadActorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('oportunidad_actor', function(Blueprint $table)
		{
			$table->foreign('oportunidad_id', 'fk_oportunidad_actor_oportunidad1')->references('id')->on('oportunidad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_actor_id', 'fk_oportunidad_actor_tipo_actor1')->references('id')->on('tipo_actor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('oportunidad_actor', function(Blueprint $table)
		{
			$table->dropForeign('fk_oportunidad_actor_oportunidad1');
			$table->dropForeign('fk_oportunidad_actor_tipo_actor1');
		});
	}

}
