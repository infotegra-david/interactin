<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailArchivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email_archivo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('email_id')->unsigned()->index('fk_email_archivo_email1_idx');
			$table->integer('archivo_id')->unsigned()->index('fk_email_archivo_archivo1_idx');
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
		Schema::drop('email_archivo');
	}

}
