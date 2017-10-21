<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class DocumentosAlianza
 * @package App\Models
 * @version October 4, 2017, 1:10 pm -05
 *
 * @property \App\Models\Alianza alianza
 * @property \App\Models\Archivo archivo
 * @property \App\Models\TipoDocumento tipoDocumento
 * @property \Illuminate\Database\Eloquent\Collection alianzaAplicaciones
 * @property \Illuminate\Database\Eloquent\Collection alianzaFacultad
 * @property \Illuminate\Database\Eloquent\Collection alianzaInstitucion
 * @property \Illuminate\Database\Eloquent\Collection alianzaModalidades
 * @property \Illuminate\Database\Eloquent\Collection alianzaPrograma
 * @property \Illuminate\Database\Eloquent\Collection alianzaUser
 * @property \Illuminate\Database\Eloquent\Collection campus
 * @property integer alianza_id
 * @property integer archivo_id
 * @property integer tipo_documento_id
 */
class DocumentosAlianza extends Model
{
    use SoftDeletes;

    public $table = 'documentos_alianza';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'alianza_id',
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
        'alianza_id' => 'integer',
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
    public function alianza()
    {
        return $this->belongsTo(\App\Models\Alianza::class);
    }

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
    public function tipoDocumento()
    {
        return $this->belongsTo(\App\Models\TipoDocumento::class);
    }
}
