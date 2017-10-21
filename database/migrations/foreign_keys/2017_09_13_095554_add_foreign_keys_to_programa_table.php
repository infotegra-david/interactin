<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToProgramaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('programa', function(Blueprint $table)
		{
			$table->foreign('facultad_id', 'fk_programa_facultad1')->references('id')->on('facultad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('programa', function(Blueprint $table)
		{
			$table->dropForeign('fk_programa_facultad1');
		});
	}

}
