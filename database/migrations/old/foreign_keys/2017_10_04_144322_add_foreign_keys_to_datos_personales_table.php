<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDatosPersonalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('datos_personales', function(Blueprint $table)
		{
			$table->foreign('ciudad_residencia_id', 'fk_datos_personales_ciudad1')->references('id')->on('ciudad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('lugar_expedicion_id', 'fk_datos_personales_ciudad2')->references('id')->on('ciudad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('nacionalidad_id', 'fk_datos_personales_pais1')->references('id')->on('pais')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_documento_id', 'fk_datos_personales_tipo_documento1')->references('id')->on('tipo_documento')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('datos_personales', function(Blueprint $table)
		{
			$table->dropForeign('fk_datos_personales_ciudad1');
			$table->dropForeign('fk_datos_personales_ciudad2');
			$table->dropForeign('fk_datos_personales_pais1');
			$table->dropForeign('fk_datos_personales_tipo_documento1');
		});
	}

}
