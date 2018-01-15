<?php

namespace App\Repositories\Admin;

use App\Models\Admin\TipoIdioma;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class TipoIdiomaRepository
 * @package App\Repositories\Admin
 * @version December 22, 2017, 5:50 pm -05
 *
 * @method TipoIdioma findWithoutFail($id, $columns = ['*'])
 * @method TipoIdioma find($id, $columns = ['*'])
 * @method TipoIdioma first($columns = ['*'])
*/
class TipoIdiomaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nombre'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return TipoIdioma::class;
    }
}
