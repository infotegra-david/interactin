<?php

namespace App\Repositories;

use App\Models\Plantillas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class PlantillasRepository
 * @package App\Repositories
 * @version December 7, 2017, 6:13 pm -05
 *
 * @method Plantillas findWithoutFail($id, $columns = ['*'])
 * @method Plantillas find($id, $columns = ['*'])
 * @method Plantillas first($columns = ['*'])
*/
class PlantillasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_plantilla_id',
        'descripcion',
        'content',
        'campus_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Plantillas::class;
    }
}
