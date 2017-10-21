<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Archivo
 * @package App\Models
 * @version July 5, 2017, 12:01 pm COT
 */
class Archivo extends Model
{
    use SoftDeletes;

    public $table = 'archivo';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'path',
        'user_id',
        'formato_id',
        'tipo_archivo_id',
        'permisos_archivo'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'path' => 'string',
        'user_id' => 'integer',
        'formato_id' => 'integer',
        'tipo_archivo_id' => 'integer',
        'permisos_archivo' => 'integer'
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
    public function formato()
    {
        return $this->belongsTo(\App\Models\Formato::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function permisosArchivo()
    {
        return $this->belongsTo(\App\Models\PermisosArchivo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipoArchivo()
    {
        return $this->belongsTo(\App\Models\TipoArchivo::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
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
    public function documentosInscripcions()
    {
        return $this->hasMany(\App\Models\DocumentosInscripcion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosInstitucions()
    {
        return $this->hasMany(\App\Models\DocumentosInstitucion::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function documentosOportunidads()
    {
        return $this->hasMany(\App\Models\DocumentosOportunidad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function mail()
    {
        return $this->belongsToMany('\App\Models\Mail','mail_archivo','archivo_id','mail_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function multimedia()
    {
        return $this->hasMany(\App\Models\Multimedia::class);
    }
}
