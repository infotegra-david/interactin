<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCampusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('campus', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->integer('institucion_id')->unsigned()->index('fk_campus_institucion1_idx');
			$table->string('telefono', 45)->nullable();
			$table->string('direccion', 150)->nullable();
			$table->string('codigo_postal', 10)->nullable();
			$table->string('email', 191)->nullable();
			$table->integer('ciudad_id')->unsigned()->index('fk_campus_ciudad1_idx');
			$table->boolean('principal')->default(0);
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
		Schema::drop('campus');
	}

}
