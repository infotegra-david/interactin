<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAlianzaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alianza', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('objetivo', 1000)->nullable();
			$table->integer('tipo_tramite_id')->unsigned()->index('fk_alianza_tipo_tramite1_idx');
			$table->string('duracion', 10)->nullable();
			$table->boolean('responsable_arl')->nullable()->default(0);
			$table->integer('estado_id')->nullable()->default(1);
			$table->string('token', 200)->nullable();
			$table->date('fecha_inicio')->nullable();
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
		Schema::drop('alianza');
	}

}
