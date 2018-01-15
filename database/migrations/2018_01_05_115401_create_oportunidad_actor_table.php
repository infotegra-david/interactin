<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOportunidadActorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oportunidad_actor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->integer('tipo_actor_id')->unsigned()->index('fk_oportunidad_actor_tipo_actor1_idx');
			$table->integer('oportunidad_id')->unsigned()->index('fk_oportunidad_actor_oportunidad1_idx');
			$table->boolean('nativo')->nullable();
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
		Schema::drop('oportunidad_actor');
	}

}
