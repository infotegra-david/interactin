<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Aplicaciones
 * @package App\Models
 * @version September 10, 2017, 6:30 pm COT
 *
 * @property string nombre
 * @property integer tipo_alianza_id
 */
class Aplicaciones extends Model
{
    use SoftDeletes;

    public $table = 'aplicaciones';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'nombre',
        'tipo_alianza_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nombre' => 'string',
        'tipo_alianza_id' => 'integer'
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
    public function tipoAlianza()
    {
        return $this->belongsTo(\App\Models\TipoAlianza::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function alianzaAplicacions()
    {
        return $this->hasMany(\App\Models\AlianzaAplicacion::class);
    }
}
