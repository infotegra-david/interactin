<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEquivalenteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('equivalente', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('asignatura_origen_id')->unsigned()->index('fk_equivalente_asignatura1_idx');
			$table->integer('asignatura_destino_id')->unsigned()->index('fk_equivalente_asignatura2_idx');
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
		Schema::drop('equivalente');
	}

}
