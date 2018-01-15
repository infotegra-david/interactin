<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToIniciativaActorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('iniciativa_actor', function(Blueprint $table)
		{
			$table->foreign('iniciativa_id', 'fk_iniciativa_actor_iniciativa1')->references('id')->on('iniciativa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('rol_iniciativa_id', 'fk_iniciativa_actor_rol_iniciativa1')->references('id')->on('rol_iniciativa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_actor_id', 'fk_iniciativa_actor_tipo_actor1')->references('id')->on('tipo_actor')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id', 'fk_iniciativa_actor_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('iniciativa_actor', function(Blueprint $table)
		{
			$table->dropForeign('fk_iniciativa_actor_iniciativa1');
			$table->dropForeign('fk_iniciativa_actor_rol_iniciativa1');
			$table->dropForeign('fk_iniciativa_actor_tipo_actor1');
			$table->dropForeign('fk_iniciativa_actor_users1');
		});
	}

}
