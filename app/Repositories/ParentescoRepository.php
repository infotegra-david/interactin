<?php

namespace App\Repositories;

use App\Models\Parentesco;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class ParentescoRepository
 * @package App\Repositories
 * @version February 1, 2018, 4:48 pm -05
 *
 * @method Parentesco findWithoutFail($id, $columns = ['*'])
 * @method Parentesco find($id, $columns = ['*'])
 * @method Parentesco first($columns = ['*'])
*/
class ParentescoRepository extends BaseRepository
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
        return Parentesco::class;
    }
}
