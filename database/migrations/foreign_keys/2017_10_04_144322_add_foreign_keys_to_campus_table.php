<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCampusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('campus', function(Blueprint $table)
		{
			$table->foreign('ciudad_id', 'fk_campus_ciudad1')->references('id')->on('ciudad')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('institucion_id', 'fk_campus_institucion1')->references('id')->on('institucion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('campus', function(Blueprint $table)
		{
			$table->dropForeign('fk_campus_ciudad1');
			$table->dropForeign('fk_campus_institucion1');
		});
	}

}
