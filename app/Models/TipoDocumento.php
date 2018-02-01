<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class TipoDocumento
 * @package App\Models
 * @version July 11, 2017, 9:57 am COT
 */
class TipoDocumento extends Model
{
    use SoftDeletes;

    public $table = 'tipo_documento';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'descripcion',
        'clasificacion_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'descripcion' => 'string',
        'clasificacion_id' => 'integer'
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
    public function Clasificacion()
    {
        return $this->belongsTo(\App\Models\Clasificacion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function datosPersonales()
    {
        return $this->hasMany(\App\Models\DatosPersonale::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosIniciativas()
    {
        return $this->hasMany(\App\Models\DocumentosIniciativa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosInscripcion()
    {
        return $this->hasMany(\App\Models\DocumentosInscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosInstitucion()
    {
        return $this->hasMany(\App\Models\DocumentosInstitucion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosOportunidad()
    {
        return $this->hasMany(\App\Models\DocumentosOportunidad::class);
    }
}
