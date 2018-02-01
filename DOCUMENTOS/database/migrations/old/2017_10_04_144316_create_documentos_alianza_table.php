<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDocumentosAlianzaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('documentos_alianza', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alianza_id')->unsigned()->index('fk_documentos_alianza_iniciativa1_idx');
			$table->integer('archivo_id')->unsigned()->index('fk_documentos_alianza_archivo1_idx');
			$table->integer('tipo_documento_id')->unsigned()->index('fk_documentos_alianza_tipo_documento1_idx');
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
		Schema::drop('documentos_alianza');
	}

}
