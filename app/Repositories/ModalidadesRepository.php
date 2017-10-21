<?php

namespace App\Repositories;

use App\Models\Modalidades;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ModalidadesRepository
 * @package App\Repositories
 * @version September 10, 2017, 6:49 pm COT
 *
 * @method Modalidades findWithoutFail($id, $columns = ['*'])
 * @method Modalidades find($id, $columns = ['*'])
 * @method Modalidades first($columns = ['*'])
*/
class ModalidadesRepository extends BaseRepository
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
        return Modalidades::class;
    }

}
