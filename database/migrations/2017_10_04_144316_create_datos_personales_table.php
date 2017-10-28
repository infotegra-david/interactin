<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDatosPersonalesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('datos_personales', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombres', 100);
			$table->string('apellidos', 100)->nullable();
			$table->integer('ciudad_residencia_id')->unsigned()->nullable()->index('fk_datos_personales_ciudad1_idx');
			$table->string('direccion', 150)->nullable();
			$table->string('email_personal', 191)->nullable();
			$table->string('telefono', 45)->nullable();
			$table->string('celular', 45)->nullable();
			$table->integer('genero')->default(3)->comment('1: Hombre, 2: Mujer, 3: No responde');
			$table->string('codigo_postal', 10)->nullable();
			$table->integer('tipo_documento_id')->unsigned()->nullable()->index('fk_datos_personales_tipo_documento1_idx');
			$table->string('numero_documento', 45)->nullable();
			$table->date('fecha_expedicion')->nullable();
			$table->date('fecha_vencimiento')->nullable();
			$table->integer('lugar_expedicion_id')->unsigned()->nullable()->index('fk_datos_personales_ciudad2_idx');
			$table->integer('nacionalidad_id')->unsigned()->nullable()->index('fk_datos_personales_pais1_idx');
			$table->string('nro_pasaporte', 45)->nullable();
			$table->float('porcentaje_aprobado', 10, 0)->nullable();
			$table->float('promedio_acumulado', 10, 0)->nullable();
			$table->string('codigo_institucion', 20)->nullable();
			$table->string('cargo', 45)->nullable();
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
		Schema::drop('datos_personales');
	}

}
