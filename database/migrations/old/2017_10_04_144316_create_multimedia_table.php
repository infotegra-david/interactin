<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMultimediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('multimedia', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('seccion_id')->unsigned()->index('fk_multimedia_seccion1_idx');
			$table->string('nombre', 100);
			$table->string('descripcion', 100)->nullable();
			$table->integer('archivo_id')->unsigned()->index('fk_multimedia_archivo1_idx');
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
		Schema::drop('multimedia');
	}

}
