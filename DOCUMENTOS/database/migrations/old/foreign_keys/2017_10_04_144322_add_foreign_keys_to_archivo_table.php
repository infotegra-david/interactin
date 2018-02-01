<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToArchivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('archivo', function(Blueprint $table)
		{
			$table->foreign('formato_id', 'fk_archivo_formato1')->references('id')->on('formato')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('tipo_archivo_id', 'fk_archivo_tipo_archivo1')->references('id')->on('tipo_archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('user_id', 'fk_archivo_users1')->references('id')->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('archivo', function(Blueprint $table)
		{
			$table->dropForeign('fk_archivo_formato1');
			$table->dropForeign('fk_archivo_tipo_archivo1');
			$table->dropForeign('fk_archivo_users1');
		});
	}

}
