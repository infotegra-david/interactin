<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserTipoPasoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_tipo_paso', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo_paso_id')->unsigned()->index('fk_user_tipo_paso_tipo_paso1_idx');
			$table->integer('user_id')->unsigned()->index('fk_user_tipo_paso_users1_idx');
			$table->integer('campus_id')->unsigned()->index('fk_user_tipo_paso_campus1_idx');
			$table->integer('orden')->default(1);
			$table->string('titulo', 100);
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
		Schema::drop('user_tipo_paso');
	}

}
