<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSeccionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seccion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('pagina_id')->unsigned()->index('fk_seccion_pagina1_idx');
			$table->string('nombre', 100);
			$table->text('contenido', 65535)->nullable();
			$table->dateTime('fecha')->nullable();
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
		Schema::drop('seccion');
	}

}
