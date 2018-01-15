<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Alianza
 * @package App\Models
 * @version June 28, 2017, 10:07 am COT
 */
class Alianza extends Model
{
    use SoftDeletes;

    public $table = 'alianza';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['created_at','updated_at','deleted_at'];


    public $fillable = [
        'objetivo',
        'tipo_tramite_id',
        'duracion',
        'responsable_arl',
        'estado',
        'token',
        'fecha_inicio',
        'campus_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'objetivo' => 'string',
        'tipo_tramite_id' => 'integer',
        'duracion' => 'string',
        'responsable_arl' => 'boolean',
        'estado' => 'boolean',
        'token' => 'string',
        'fecha_inicio' => 'date',
        'campus_id' => 'integer',
        'created_at' => 'date',
        'updated_at' => 'date',
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
    public function tipoTramite()
    {
        return $this->belongsTo(\App\Models\TipoTramite::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function user()
    {
        return $this->belongsToMany('\App\User','alianza_user','alianza_id','user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function facultad()
    {
        return $this->belongsToMany(\App\Models\Admin\Facultad::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function Modalidades()
    {
        return $this->belongsToMany('\App\Models\Modalidades','alianza_modalidades','alianza_id','modalidad_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function Aplicaciones()
    {
        return $this->belongsToMany(\App\Models\Aplicaciones::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function programa()
    {
        return $this->belongsToMany(\App\Models\Admin\Programa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function institucion()
    {
        return $this->belongsToMany('\App\Models\Admin\Institucion','alianza_institucion','alianza_id','institucion_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    /*
    public function alianzaModalidad()
    {
        return $this->hasMany(\App\Models\AlianzaModalidad::class);
    }
    */
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pasosAlianza()
    {
        return $this->hasMany(\App\Models\Validation\PasosAlianza::class);
    }
}
