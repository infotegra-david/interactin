<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIniciativaTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iniciativa', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('oportunidad_id')->unsigned();
			$table->string('titulo', 100)->nullable();
			$table->text('objetivo', 65535)->nullable();
			$table->text('integracion_agenda_origen', 65535)->nullable();
			$table->text('responsabilidades_origen', 65535)->nullable();
			$table->text('beneficios_origen', 65535)->nullable();
			$table->boolean('recursos_origen')->nullable();
			$table->integer('presupuesto_costo_total')->nullable();
			$table->integer('presupuesto_otros_actores')->nullable();
			$table->integer('presupuesto_total_origen')->nullable();
			$table->integer('presupuesto_financieros')->nullable();
			$table->integer('presupuesto_personal')->nullable();
			$table->integer('presupuesto_infraestructura')->nullable();
			$table->integer('presupuesto_otro')->nullable();
			$table->text('instrumentos_monitoreo', 65535)->nullable();
			$table->boolean('firma_rectoria')->nullable();
			$table->integer('campus_id')->unsigned()->index('fk_iniciativa_campus1_idx');
			$table->integer('estado_id')->nullable()->default(1);
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
		Schema::drop('iniciativa');
	}

}
