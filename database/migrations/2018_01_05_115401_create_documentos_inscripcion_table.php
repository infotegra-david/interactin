<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosInscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos_inscripcion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('inscripcion_id')->unsigned()->index('fk_documentos_inscripcion_inscripcion1_idx');
			$table->integer('archivo_id')->unsigned()->index('fk_documentos_inscripcion_archivo1_idx');
			$table->integer('tipo_documento_id')->unsigned()->index('fk_documentos_inscripcion_tipo_documento1_idx');
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
		Schema::drop('documentos_inscripcion');
	}

}
