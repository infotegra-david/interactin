<?php

namespace App\Repositories;

use App\Models\Matricula;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class MatriculaRepository
 * @package App\Repositories
 * @version September 12, 2017, 3:42 pm -05
 *
 * @method Matricula findWithoutFail($id, $columns = ['*'])
 * @method Matricula find($id, $columns = ['*'])
 * @method Matricula first($columns = ['*'])
*/
class MatriculaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'usuario_id',
        'programa_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Matricula::class;
    }
}
