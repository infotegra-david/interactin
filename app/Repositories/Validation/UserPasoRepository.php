<?php

namespace App\Repositories\Validation;

use App\Models\Validation\UserPaso;
use InfyOm\Generator\Common\BaseRepository;

class UserPasoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo_paso_id',
        'user_id',
        'orden',
        'titulo'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return UserPaso::class;
    }
}
