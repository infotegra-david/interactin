<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosOportunidadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos_oportunidad', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('oportunidad_id')->unsigned()->index('fk_documentos_oportunidad_oportunidad1_idx');
			$table->integer('archivo_id')->unsigned()->index('fk_documentos_oportunidad_archivo1_idx');
			$table->integer('tipo_documento_id')->unsigned()->index('fk_documentos_oportunidad_tipo_documento1_idx');
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
		Schema::drop('documentos_oportunidad');
	}

}
