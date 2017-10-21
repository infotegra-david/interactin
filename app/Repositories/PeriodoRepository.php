<?php

namespace App\Repositories;

use App\Models\Periodo;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PeriodoRepository
 * @package App\Repositories
 * @version September 11, 2017, 11:59 am COT
 *
 * @method Periodo findWithoutFail($id, $columns = ['*'])
 * @method Periodo find($id, $columns = ['*'])
 * @method Periodo first($columns = ['*'])
*/
class PeriodoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'fecha_desde',
        'fecha_hasta',
        'vigente'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Periodo::class;
    }
}
