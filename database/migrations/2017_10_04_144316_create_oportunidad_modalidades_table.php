<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOportunidadModalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oportunidad_modalidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('oportunidad_id')->unsigned()->index('fk_modalidad_oportunidad_oportunidad1_idx');
			$table->integer('modalidades_id')->unsigned()->index('fk_oportunidad_modalidades_modalidades1_idx');
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
		Schema::drop('oportunidad_modalidades');
	}

}
