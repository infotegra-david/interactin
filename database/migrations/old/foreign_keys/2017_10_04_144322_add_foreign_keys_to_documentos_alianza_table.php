<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDocumentosAlianzaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('documentos_alianza', function(Blueprint $table)
		{
			$table->foreign('alianza_id', 'fk_documentos_alianza_alianza1')->references('id')->on('alianza')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('archivo_id', 'fk_documentos_alianza_archivo1')->references('id')->on('archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_documento_id', 'fk_documentos_alianza_tipo_documento1')->references('id')->on('tipo_documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('documentos_alianza', function(Blueprint $table)
		{
			$table->dropForeign('fk_documentos_alianza_alianza1');
			$table->dropForeign('fk_documentos_alianza_archivo1');
			$table->dropForeign('fk_documentos_alianza_tipo_documento1');
		});
	}

}
