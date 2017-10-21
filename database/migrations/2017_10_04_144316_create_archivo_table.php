<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArchivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('archivo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100)->nullable();
			$table->string('path', 191);
			$table->integer('user_id')->unsigned()->index('fk_archivo_users1_idx');
			$table->integer('formato_id')->unsigned()->index('fk_archivo_formato1_idx');
			$table->integer('tipo_archivo_id')->unsigned()->index('fk_archivo_tipo_archivo1_idx');
			$table->text('permisos_archivo', 65535);
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
		Schema::drop('archivo');
	}

}
