<?php

namespace App\Repositories\Admin;

use App\Models\Admin\UserIdiomas;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class UserIdiomasRepository
 * @package App\Repositories\Admin
 * @version December 22, 2017, 11:16 pm -05
 *
 * @method UserIdiomas findWithoutFail($id, $columns = ['*'])
 * @method UserIdiomas find($id, $columns = ['*'])
 * @method UserIdiomas first($columns = ['*'])
*/
class UserIdiomasRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'tipo_idioma_id',
        'certificado',
        'nombre_examen',
        'nivel_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserIdiomas::class;
    }
}
