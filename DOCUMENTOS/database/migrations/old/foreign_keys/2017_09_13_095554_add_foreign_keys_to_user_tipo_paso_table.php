<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserTipoPasoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_tipo_paso', function(Blueprint $table)
		{
			$table->foreign('tipo_paso_id', 'fk_user_tipo_paso_tipo_paso1')->references('id')->on('tipo_paso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_user_tipo_paso_users10')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_tipo_paso', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_tipo_paso_tipo_paso1');
			$table->dropForeign('fk_user_tipo_paso_users10');
		});
	}

}
