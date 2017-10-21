<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserTipoPasoMailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_tipo_paso_mail', function(Blueprint $table)
		{
			$table->foreign('user_tipo_paso_id', 'fk_user_tipo_paso_mail_user_tipo_paso1')->references('id')->on('user_tipo_paso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('mail_id', 'fk_user_tipo_paso_maill_mail10')->references('id')->on('mail')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_tipo_paso_mail', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_tipo_paso_mail_user_tipo_paso1');
			$table->dropForeign('fk_user_tipo_paso_maill_mail10');
		});
	}

}
