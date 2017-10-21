<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdiomasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('idiomas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id')->unsigned()->index('fk_idiomas_users1_idx');
			$table->integer('tipo_idioma_id')->unsigned()->index('fk_idiomas_tipo_idioma1_idx');
			$table->boolean('certificado')->nullable();
			$table->string('nombre_examen', 100)->nullable();
			$table->integer('nivel_id')->unsigned()->index('fk_idiomas_nivel1_idx');
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
		Schema::drop('idiomas');
	}

}
