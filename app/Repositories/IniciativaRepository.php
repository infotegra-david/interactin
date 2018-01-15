<?php

namespace App\Repositories;

use App\Models\Iniciativa;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class IniciativaRepository
 * @package App\Repositories
 * @version October 31, 2017, 3:21 pm -05
 *
 * @method Iniciativa findWithoutFail($id, $columns = ['*'])
 * @method Iniciativa find($id, $columns = ['*'])
 * @method Iniciativa first($columns = ['*'])
*/
class IniciativaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'oportunidad_id',
        'titulo',
        'objetivo',
        'integracion_agenda_origen',
        'responsabilidades_origen',
        'beneficios_origen',
        'recursos_origen',
        'presupuesto_costo_total',
        'presupuesto_otros_actores',
        'presupuesto_total_origen',
        'presupuesto_financieros',
        'presupuesto_personal',
        'presupuesto_infraestructura',
        'presupuesto_otro',
        'instrumentos_monitoreo',
        'firma_rectoria'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Iniciativa::class;
    }
}
