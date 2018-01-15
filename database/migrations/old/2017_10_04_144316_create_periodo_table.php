<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeriodoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('periodo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->date('fecha_desde')->nullable();
			$table->date('fecha_hasta')->nullable();
			$table->boolean('vigente')->nullable()->default(0);
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
		Schema::drop('periodo');
	}

}
