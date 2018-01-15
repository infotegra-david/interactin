<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIniciativaActorTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iniciativa_actor', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->integer('tipo_actor_id')->unsigned()->index('fk_iniciativa_actor_tipo_actor1_idx');
			$table->integer('rol_iniciativa_id')->unsigned()->index('fk_iniciativa_actor_rol_iniciativa1_idx');
			$table->integer('usuario_id')->unsigned()->index('fk_iniciativa_actor_users1_idx');
			$table->integer('iniciativa_id')->unsigned()->index('fk_iniciativa_actor_iniciativa1_idx');
			$table->text('experiencia_area_iniciativa', 65535)->nullable();
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
		Schema::drop('iniciativa_actor');
	}

}
