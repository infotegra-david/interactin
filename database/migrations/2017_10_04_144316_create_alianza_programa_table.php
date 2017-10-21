<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlianzaProgramaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alianza_programa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alianza_id')->unsigned()->index('fk_alianza_programas_alianza1_idx');
			$table->integer('programa_id')->unsigned()->index('fk_alianza_programas_programa1_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alianza_programa');
	}

}
