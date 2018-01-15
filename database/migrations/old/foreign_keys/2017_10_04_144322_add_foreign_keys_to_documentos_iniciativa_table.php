<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentosIniciativaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documentos_iniciativa', function(Blueprint $table)
		{
			$table->foreign('archivo_id', 'fk_documentos_iniciativa_archivo1')->references('id')->on('archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('iniciativa_id', 'fk_documentos_iniciativa_iniciativa1')->references('id')->on('iniciativa')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_documento_id', 'fk_documentos_iniciativa_tipo_documento1')->references('id')->on('tipo_documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documentos_iniciativa', function(Blueprint $table)
		{
			$table->dropForeign('fk_documentos_iniciativa_archivo1');
			$table->dropForeign('fk_documentos_iniciativa_iniciativa1');
			$table->dropForeign('fk_documentos_iniciativa_tipo_documento1');
		});
	}

}
