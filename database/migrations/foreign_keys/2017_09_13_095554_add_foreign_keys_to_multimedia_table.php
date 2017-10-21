<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToMultimediaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('multimedia', function(Blueprint $table)
		{
			$table->foreign('archivo_id', 'fk_multimedia_archivo1')->references('id')->on('archivo')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('seccion_id', 'fk_multimedia_seccion1')->references('id')->on('seccion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('multimedia', function(Blueprint $table)
		{
			$table->dropForeign('fk_multimedia_archivo1');
			$table->dropForeign('fk_multimedia_seccion1');
		});
	}

}
