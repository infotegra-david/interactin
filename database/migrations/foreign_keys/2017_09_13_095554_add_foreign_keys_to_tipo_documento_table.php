<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTipoDocumentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tipo_documento', function(Blueprint $table)
		{
			$table->foreign('clase_documento_id', 'fk_tipo_documento_clase_documento1')->references('id')->on('clase_documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tipo_documento', function(Blueprint $table)
		{
			$table->dropForeign('fk_tipo_documento_clase_documento1');
		});
	}

}
