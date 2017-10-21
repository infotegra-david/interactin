<?php

namespace App\Repositories\Admin;

use App\Models\Admin\DocumentosInstitucion;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentosInstitucionRepository
 * @package App\Repositories\Admin
 * @version September 29, 2017, 2:19 pm -05
 *
 * @method DocumentosInstitucion findWithoutFail($id, $columns = ['*'])
 * @method DocumentosInstitucion find($id, $columns = ['*'])
 * @method DocumentosInstitucion first($columns = ['*'])
*/
class DocumentosInstitucionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'institucion_id',
        'archivo_id',
        'tipo_documento_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DocumentosInstitucion::class;
    }
}
