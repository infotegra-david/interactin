<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Estado
 * @package App\Models
 * @version July 5, 2017, 11:08 am COT
 */
class Estado extends Model
{
    use SoftDeletes;

    public $table = 'estado';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'uso'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'uso' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pasosAlianzas()
    {
        return $this->hasMany(\App\Models\Validation\PasosAlianza::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pasosIniciativas()
    {
        return $this->hasMany(\App\Models\PasosIniciativa::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function pasosInscripcions()
    {
        return $this->hasMany(\App\Models\PasosInscripcion::class);
    }
}
