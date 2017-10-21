<?php

namespace App\Models\Admin;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentosInstitucion
 * @package App\Models\Admin
 * @version September 29, 2017, 2:19 pm -05
 *
 * @property integer institucion_id
 * @property integer archivo_id
 * @property integer tipo_documento_id
 */
class DocumentosInstitucion extends Model
{
    use SoftDeletes;

    public $table = 'documentos_institucion';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'institucion_id',
        'archivo_id',
        'tipo_documento_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'institucion_id' => 'integer',
        'archivo_id' => 'integer',
        'tipo_documento_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function archivo()
    {
        return $this->belongsTo(\App\Models\Archivo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function institucion()
    {
        return $this->belongsTo(\App\Models\Admin\Institucion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoDocumento()
    {
        return $this->belongsTo(\App\Models\TipoDocumento::class);
    }
    
}
