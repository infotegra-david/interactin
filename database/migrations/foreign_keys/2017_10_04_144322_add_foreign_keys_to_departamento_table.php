<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToDepartamentoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('departamento', function(Blueprint $table)
		{
			$table->foreign('pais_id')->references('id')->on('pais')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('departamento', function(Blueprint $table)
		{
			$table->dropForeign('departamento_pais_id_foreign');
		});
	}

}
