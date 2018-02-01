<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserTipoPasoEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_tipo_paso_email', function(Blueprint $table)
		{
			$table->foreign('user_tipo_paso_id', 'fk_user_tipo_paso_email_user_tipo_paso1')->references('id')->on('user_tipo_paso')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('email_id', 'fk_user_tipo_paso_emaill_email10')->references('id')->on('email')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_tipo_paso_email', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_tipo_paso_email_user_tipo_paso1');
			$table->dropForeign('fk_user_tipo_paso_emaill_email10');
		});
	}

}
