<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFuenteFinanciacionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fuente_financiacion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->boolean('tipo')->comment('tipo: 0 Nacional, 1 Internacional');
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
		Schema::drop('fuente_financiacion');
	}

}
