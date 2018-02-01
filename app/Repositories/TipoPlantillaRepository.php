<?php

namespace App\Repositories;

use App\Models\TipoPlantilla;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoPlantillaRepository
 * @package App\Repositories
 * @version January 27, 2018, 10:15 am -05
 *
 * @method TipoPlantilla findWithoutFail($id, $columns = ['*'])
 * @method TipoPlantilla find($id, $columns = ['*'])
 * @method TipoPlantilla first($columns = ['*'])
*/
class TipoPlantillaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'clasificacion_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoPlantilla::class;
    }
}
