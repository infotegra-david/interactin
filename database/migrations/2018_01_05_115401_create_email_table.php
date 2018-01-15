<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmailTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('email', function(Blueprint $table)
		{
			$table->increments('id');
			$table->text('to', 65535);
			$table->text('cc', 65535)->nullable();
			$table->text('bcc', 65535)->nullable();
			$table->text('replyto', 65535)->nullable();
			$table->string('subject', 100)->nullable();
			$table->text('content', 65535)->nullable();
			$table->boolean('estado')->nullable()->default(0)->comment('estado: 0 sin enviar, 1 enviado');
			$table->string('tokenemail', 200)->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('email');
	}

}
