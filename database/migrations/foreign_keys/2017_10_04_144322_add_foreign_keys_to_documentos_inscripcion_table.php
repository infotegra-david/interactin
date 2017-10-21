<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentosInscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documentos_inscripcion', function(Blueprint $table)
		{
			$table->foreign('archivo_id', 'fk_documentos_inscripcion_archivo1')->references('id')->on('archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('inscripcion_id', 'fk_documentos_inscripcion_inscripcion1')->references('id')->on('inscripcion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_documento_id', 'fk_documentos_inscripcion_tipo_documento1')->references('id')->on('tipo_documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documentos_inscripcion', function(Blueprint $table)
		{
			$table->dropForeign('fk_documentos_inscripcion_archivo1');
			$table->dropForeign('fk_documentos_inscripcion_inscripcion1');
			$table->dropForeign('fk_documentos_inscripcion_tipo_documento1');
		});
	}

}
