<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateModalidadesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('modalidades', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 100);
			$table->boolean('tipo')->nullable()->default(0)->comment('este campo diferenciara a las modalidades que pertenezcan a interout (0) o interin (1)');
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
		Schema::drop('modalidades');
	}

}
