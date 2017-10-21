<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailArchivoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mail_archivo', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('mail_id')->unsigned()->index('fk_mail_archivo_mail1_idx');
			$table->integer('archivo_id')->unsigned()->index('fk_mail_archivo_archivo1_idx');
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
		Schema::drop('mail_archivo');
	}

}
