<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToUserCampusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_campus', function(Blueprint $table)
		{
			$table->foreign('campus_id', 'fk_user_campus_campus1')->references('id')->on('campus')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_user_campus_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_campus', function(Blueprint $table)
		{
			$table->dropForeign('fk_user_campus_campus1');
			$table->dropForeign('fk_user_campus_users1');
		});
	}

}
