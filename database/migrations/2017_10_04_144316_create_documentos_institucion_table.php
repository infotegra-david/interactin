<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosInstitucionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos_institucion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('institucion_id')->unsigned()->index('fk_documentos_institucion_institucion1_idx');
			$table->integer('archivo_id')->unsigned()->index('fk_documentos_institucion_archivo1_idx');
			$table->integer('tipo_documento_id')->unsigned()->index('fk_documentos_institucion_tipo_documento1_idx');
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
		Schema::drop('documentos_institucion');
	}

}
