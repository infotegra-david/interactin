<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlianzaModalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alianza_modalidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alianza_id')->unsigned()->index('fk_alianza_modalidad_alianza1_idx');
			$table->integer('modalidades_id')->unsigned()->index('fk_alianza_modalidad_modalidad1_idx');
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
		Schema::drop('alianza_modalidades');
	}

}
