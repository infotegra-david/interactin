<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCiudadTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ciudad', function(Blueprint $table)
		{
			$table->foreign('departamento_id')->references('id')->on('departamento')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('ciudad', function(Blueprint $table)
		{
			$table->dropForeign('ciudad_departamento_id_foreign');
		});
	}

}
