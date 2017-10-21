<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToInstitucionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('institucion', function(Blueprint $table)
		{
			$table->foreign('tipo_institucion_id', 'fk_institucion_tipo_institucion1')->references('id')->on('tipo_institucion')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('institucion', function(Blueprint $table)
		{
			$table->dropForeign('fk_institucion_tipo_institucion1');
		});
	}

}
