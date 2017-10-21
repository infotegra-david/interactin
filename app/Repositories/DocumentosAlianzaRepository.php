<?php

namespace App\Repositories;

use App\Models\DocumentosAlianza;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class DocumentosAlianzaRepository
 * @package App\Repositories
 * @version October 4, 2017, 1:10 pm -05
 *
 * @method DocumentosAlianza findWithoutFail($id, $columns = ['*'])
 * @method DocumentosAlianza find($id, $columns = ['*'])
 * @method DocumentosAlianza first($columns = ['*'])
*/
class DocumentosAlianzaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'alianza_id',
        'archivo_id',
        'tipo_documento_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return DocumentosAlianza::class;
    }
}
