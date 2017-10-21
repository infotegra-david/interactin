<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFinanciacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('financiacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inscipcion_id')->unsigned()->index('fk_financiacion_inscripcion1_idx');
			$table->integer('fuente_financiacion_id')->unsigned()->index('fk_financiacion_fuente_financiacion1_idx');
			$table->boolean('tipo')->nullable();
			$table->integer('monto')->nullable();
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
		Schema::drop('financiacion');
	}

}
