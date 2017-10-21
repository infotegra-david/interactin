<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlianzaUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alianza_user', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alianza_id')->unsigned()->index('fk_alianza_users_alianza1_idx');
			$table->integer('user_id')->unsigned()->index('fk_alianza_users_users1_idx');
			$table->timestamps();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alianza_user');
	}

}
