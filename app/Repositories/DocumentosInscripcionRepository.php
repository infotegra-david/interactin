<?php

namespace App\Repositories;

use App\Models\DocumentosInscripcion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentosInscripcionRepository
 * @package App\Repositories
 * @version November 24, 2017, 4:07 pm -05
 *
 * @method DocumentosInscripcion findWithoutFail($id, $columns = ['*'])
 * @method DocumentosInscripcion find($id, $columns = ['*'])
 * @method DocumentosInscripcion first($columns = ['*'])
*/
class DocumentosInscripcionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'inscripcion_id',
        'archivo_id',
        'tipo_documento_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DocumentosInscripcion::class;
    }
}
