<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserIdiomasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_idiomas', function(Blueprint $table)
		{
			$table->foreign('nivel_id', 'fk_user_idiomas_nivel1')->references('id')->on('nivel')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_idioma_id', 'fk_user_idiomas_tipo_idioma1')->references('id')->on('tipo_idioma')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('usuario_id', 'fk_user_idiomas_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_idiomas', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_idiomas_nivel1');
			$table->dropForeign('fk_user_idiomas_tipo_idioma1');
			$table->dropForeign('fk_user_idiomas_users1');
		});
	}

}
