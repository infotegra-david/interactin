<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInscripcionTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('inscripcion', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned();
			$table->date('fecha')->nullable();
			$table->integer('periodo_id')->unsigned()->nullable()->index('fk_inscripcion_periodo1_idx');
			$table->integer('campus_id')->unsigned()->nullable()->index('fk_inscripcion_campus1_idx');
			$table->integer('modalidades_id')->unsigned()->nullable()->index('fk_inscripcion_modalidades1_idx');
			$table->integer('programa_origen_id')->unsigned()->nullable()->index('fk_inscripcion_programa1_idx');
			$table->integer('programa_destino_id')->unsigned()->nullable()->index('fk_inscripcion_programa2_idx');
			$table->date('fecha_inicio')->nullable();
			$table->date('fecha_fin')->nullable();
			$table->integer('presupuesto_hospedaje')->nullable();
			$table->integer('presupuesto_alimentacion')->nullable();
			$table->integer('presupuesto_transporte')->nullable();
			$table->integer('presupuesto_otros')->nullable();
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
		Schema::drop('inscripcion');
	}

}
