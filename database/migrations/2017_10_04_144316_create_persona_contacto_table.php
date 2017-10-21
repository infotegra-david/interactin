<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaContactoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('persona_contacto', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('usuario_id')->unsigned()->index('fk_persona_contacto_users1_idx');
			$table->integer('contacto_id')->unsigned()->default(1)->index('fk_persona_contacto_users2_idx');
			$table->string('parentesco', 45)->nullable();
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
		Schema::drop('persona_contacto');
	}

}
