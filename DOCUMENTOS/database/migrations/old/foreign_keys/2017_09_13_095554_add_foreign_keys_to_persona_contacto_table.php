<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPersonaContactoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('persona_contacto', function(Blueprint $table)
		{
			$table->foreign('usuario_id', 'fk_persona_contacto_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('contacto_id', 'fk_persona_contacto_users2')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('persona_contacto', function(Blueprint $table)
		{
			$table->dropForeign('fk_persona_contacto_users1');
			$table->dropForeign('fk_persona_contacto_users2');
		});
	}

}
