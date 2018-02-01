<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePlantillasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('plantillas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('tipo_plantilla_id')->unsigned()->index('fk_plantillas_tipo_plantilla1_idx')->comment('se define como una llave que sera usada por el sistema para obtener los datos');
			$table->string('descripcion', 100)->nullable()->comment('Una descripcion que ayudara al que quiera editarlo para entender que esta afectando');
			$table->binary('contenido', 65535)->nullable()->comment('el contenido puede estar en varios formatos, html, json o solo texto, dependera de para que se use');
			$table->integer('campus_id')->unsigned()->index('fk_plantillas_campus1_idx')->comment('debera estar por lo menos asociado al campus principal de la institucion');
			$table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('plantillas');
	}

}
