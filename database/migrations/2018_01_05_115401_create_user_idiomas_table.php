<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserIdiomasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_idiomas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('fk_user_idiomas_users1_idx');
			$table->integer('tipo_idioma_id')->unsigned()->index('fk_user_idiomas_tipo_idioma1_idx');
			$table->boolean('certificado')->nullable();
			$table->string('nombre_examen', 100)->nullable();
			$table->integer('nivel_id')->unsigned()->index('fk_user_idiomas_nivel1_idx');
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
		Schema::drop('user_idiomas');
	}

}
