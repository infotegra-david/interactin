<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTipoDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tipo_documento', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->integer('clase_documento_id')->unsigned()->index('fk_tipo_documento_clase_documento1_idx');
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
		Schema::drop('tipo_documento');
	}

}
