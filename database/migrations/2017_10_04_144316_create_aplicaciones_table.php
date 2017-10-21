<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAplicacionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aplicaciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->integer('tipo_alianza_id')->unsigned()->index('fk_modalidad_tipo_alianza1_idx');
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
		Schema::drop('aplicaciones');
	}

}
