<?php

namespace App\Repositories;

use App\Models\Inscripcion;
use InfyOm\Generator\Common\BaseRepository;

class InscripcionRepository extends BaseRepository
{
    /**
     * @var array
     * @method InterChange findWithoutFail($id, $columns = ['*'])
     * @method InterChange find($id, $columns = ['*'])
     * @method InterChange first($columns = ['*'])
     */
    protected $fieldSearchable = [
        'usuario_id',
        'fecha',
        'periodo_id',
        'programa_origen_id',
        'programa_destino_id',
        'fecha_inicio',
        'fecha_fin',
        'presupuesto_hospedaje',
        'presupuesto_alimentacion',
        'presupuesto_transporte',
        'presupuesto_otros'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Inscripcion::class;
    }
}
