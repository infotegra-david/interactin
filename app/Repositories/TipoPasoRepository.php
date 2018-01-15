<?php

namespace App\Repositories;

use App\Models\TipoPaso;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoPasoRepository
 * @package App\Repositories
 * @version January 15, 2018, 9:18 am -05
 *
 * @method TipoPaso findWithoutFail($id, $columns = ['*'])
 * @method TipoPaso find($id, $columns = ['*'])
 * @method TipoPaso first($columns = ['*'])
*/
class TipoPasoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre',
        'titulo',
        'seccion',
        'reglas'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoPaso::class;
    }
}
